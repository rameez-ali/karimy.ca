<?php

namespace App\Http\Controllers\Api\Auth;

use DB;
use Mail; 
use App\Role;
use App\Plan;
use App\User;
use App\Device;
use App\Subscription;
use App\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Session;
use \stdClass;

class AuthenticationController
{
  
      public function register(Request $request)
      {
        $data = $request->all();
        
        $validate = $this->validateRegisterationRequest($request->all());
            if($validate->fails()) return response()->json([
                'success'   => false,
                'error'     => $validate->errors(),
                'message'   => 'Invalid input, please check the errors.'
            ], 422);

            // dd($request);

        // $request['role'] = "3";
        
        // Media

        // if ($request->hasFile('profile_photo')) {
        //   // Save image to folder
        //   $loc = '/public/user_profile_photos';
        //   $fileData = $request->file('profile_photo');
        //   $fileNameToStore = $this->uploadImage($fileData, $loc);
        // } else {
        //   $fileNameToStore = 'no_img.jpg';
        // }


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = Role::USER_ROLE_ID;
        $user->user_suspended = User::USER_NOT_SUSPENDED;
        $user->device_token = $request->device_token;
        $user->save();
        
        DB::table('devices')->insert([
                    ['user_id' => $user->id,'user_email' => $user->email, 'device_id' => $request->device_id],
                ]);
                
        $free_plan = Plan::where('plan_type', Plan::PLAN_TYPE_FREE)->first();

        $user_subscription = new Subscription;
        $user_subscription->user_id = $user->id;
        $user_subscription->plan_id =  $free_plan->id;
        $user_subscription->subscription_start_date = Carbon::now()->toDateString();
        $user_subscription->save();

        $token = Str::random(64);

        $verifyuser = new UserVerify;
        $verifyuser->user_id = $user->id;
        $verifyuser->token = $token;
        $verifyuser->save();

        $url=URL::to('https://karimy.ca/api/v1/auth/account/verify/'.$token);
        
        User::find($user->id)->update(['email_verification_link'=> $url]);

        $hello = Mail::send('email.userregistered', ['url' => $url, 'name' => $request->name,'email' => $request->email], function($message) use($request){
          $message->to($request->email);
          $message->subject('New User Registered');
        });

        if (Mail::failures()) {
            return response(['status' => '0', 'message' => 'User did not register'], 404);
        } else {
            return response(["result" => $user, 'status' => '1', 'message' => 'User Registration Successfully Completed'], 201);

        }
        
      }

      protected function validateRegisterationRequest($data) {
          $validate = Validator::make($data, [
              'name'    => 'required|string|max:255',
              'email'         => 'required|string|email|max:255|unique:users',
              'password'      => 'required',
              'device_id'      => 'required',
          ]);

          return $validate;
      }

      public function login(Request $request)
      {
        
        $userAccountStatus = DB::table('users')
                    ->where('email', $request->email)
                    ->value('user_suspended');
                    
        if($userAccountStatus==1) {
             return response()->json([
                'message' => 'You have been blocked for too many attempts. Please contact admin at info@karimy.ca',
                'status'  => 0
             ], 200);
        }
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
          // Get authenticated user
          $user = Auth::user();
          
         $user->user_image = env('APP_URL') . '/storage/user/user_image/' . $user->user_image;
         $user->user_background_image = env('APP_URL') . '/storage/user/user_background_image/' . $user->user_background_image;
         
          // create token
          $token =  $user->createToken('MyApp')->accessToken;
          
          User::where('id',$user->id)->update(['device_token'=> $request->device_token]);
          
          $trial_taken = Subscription::where('user_id',$user->id)->value('trial_taken');
          
          $subscription_end_date = Subscription::where('user_id',$user->id)->value('subscription_end_date');
          
          $TodayDate = date('d-m-Y H:i:s');
          
          if($subscription_end_date < $TodayDate )
          {
              Subscription::where('user_id',$user->id)->update(['plan_id'=> 1]);
          }

          $plan_id = Subscription::where('user_id',$user->id)->value('plan_id');
          
          $subscription = Plan::where('id',$plan_id)->get();
          
          $device_tokens = DB::table('devices')->select('device_id')->where('user_id',Auth::user()->id)->get();


          $result = new stdClass;
          $result->user = $user;
          $result->subscription = $subscription;
          $result->trial_taken = $trial_taken;
          $result->device_ids = $device_tokens;
          $result->token = $token;

          return response()->json([
            'result' => $result,
            'message' => 'Logged In Successfully',
            'status'  => 1
          ], 200);
        }
        
        $hello = User::where('email',$request->email)->where('role_id','!=', 1)->increment('login_attempt');
    
        $attemp_no = User::where('email',$request->email)->where('role_id','!=', 1)->value('login_attempt');
        
        $account_blocked = User::where('email',$request->email)->where('role_id','!=', 1)->value('user_suspended');
        
        if($account_blocked == 1 || $attemp_no == 3)
        {
            User::where('email', $request->email)->update(['user_suspended' => 1]);
            return response()->json([
                'message' => 'You have been blocked for too many attempts. Please contact admin at info@karimy.ca',
                'status'  => 0
            ], 200);
        }
        
        return response()->json([
                'message' => 'Incorrect Login Credentials',
                'status'  => 0
            ], 200);
        
      }
      
      public function send_deviceid_otp(Request $request)
      {
                $otp = random_int(100000, 999999);
                
                DB::table('device_verfication_otp')->insert([
                    ['user_id' => $request->user_id,'user_email' => $request->email, 'otp' => $otp],
                ]);
                
                $mail = Mail::send('email.device_verification', ['otp' => $otp], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Device Verification Alert');
                });
                
                if(!$otp)
                {
                    return response()->json([
                        'message' => 'Something went wrong !',
                        'status'  => 0
                    ], 200);
                }
                else
                {
                    return response()->json([
                            'message' => 'OTP Sent Succesfully',
                            'status'  => 1
                        ], 200);
                
              }
      }
      
      public function save_device_token(Request $request)
      {
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
            
            $hello = DB::table('device_verfication_otp')->where('user_id',$user_id)->where('user_email',$user_email)->where('otp',$request->otp)->value('id');
            
            if (DB::table('device_verfication_otp')->where('user_id',$user_id)->where('user_email',$user_email)->where('otp',$request->otp)->value('id')!=null) {
                
                $device = new Device();
                $devices = $device->device_id = $request->device_id;
                $devices = $device->user_id = $user_id;
                $devices = $device->user_email = $user_email;
                $devices = $device->save();
            
                return response()->json([
                        'status' => 1,
                        'message' => "Device ID Saved Succesfully !.",
                      ], 200);
            }
            else{
                return response()->json([
                        'status' => 0,
                        'message' => "OTP is incorrect !",
                      ], 200);
            }
            
        
      }
      
      public function logout()
      {
         
          if (Auth::check()) {
            $token = Auth::user()->token();
            $token->revoke();
            User::where('id',Auth::user()->id)->update(['device_token'=> NULL]);
            return response()->json([
                    'status' => 1,
                    'message' => "You have been successfully logged out !.",
                  ], 200);
          }
          else{
              return response()->json([
                    'status' => 0,
                    'message' => "Something Went Wrong !",
                  ], 200);
          }
              
          
      }

      public function verifyAccount($token)
      {
          $verifyUser = UserVerify::where('token', $token)->first();
          
    
    
          if(!is_null($verifyUser) ){
              $user = $verifyUser->user;
                
              if(!$user->email_verified_at) {
                  $verifyUser->user->email_verified_at = Carbon::now();
                  $verifyUser->user->save();
                  $status_check = $verifyUser->user->email_verified_at;
                   return response()->view('email.emailverificationtemplate',compact('status_check'));
              } else {
                  $status_check = $verifyUser->user->email_verified_at;
                   return response()->view('email.emailverificationtemplate',compact('status_check'));
              }
          }

      }
      
}
