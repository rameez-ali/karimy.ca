<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon; 
use App\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use DB;

class NewPasswordController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submitForgetPasswordForm(Request $request)
    {
      $data = $request->all();

      $validator = Validator::make($data, [
         'email' => 'required|email|exists:users',
       ]);

       $email_check=User::where('email',$request->email)->value('id');

       
       if (!isset($email_check)) {
        return response()->json([
          'message' => 'Email Not Found',
          'status'  => 0
        ], 200);
       }

      $otp = random_int(100000, 999999);

      DB::table('password_resets')->insert([
        'email' => $request->email, 
        'otp' => $otp, 
        'created_at' => Carbon::now()
      ]);


      $hello=Mail::send('email.forgetpassword', ['otp' => $otp], function($message) use($request){
        $message->to($request->email);
        $message->subject('Reset Password Notification');
      });

      if (Mail::failures()) {
          return response()->json([
            'message' => 'Email Failed to send',
            'status'  => 0
          ], 200);
      }
      else{
          return response()->json([
            'result' => $request->email,
            'message' => 'Email has been sent to email the users email address',
            'status'  => 1
          ], 200);
      }
          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function submitResetPasswordForm(Request $request, $token)
      {
          $data = $request->all();
          
          $validator = Validator::make($data, [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
          ]);
          
          
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $token
                              ])
                              ->first();
  
          if(!$updatePassword){
            return response()->json([
              'message' => 'Invalid Token',
              'status'  => 0
            ], 200);
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return response()->json([
            'result' => $user,
            'message' => 'Password Reset Successfully Done',
            'status'  => 1
          ], 200);

      }
}
