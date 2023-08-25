<?php

namespace App\Http\Controllers\Api\Auth;

use DB;
use Hash;
use App\User;
use App\Theme;
use App\Setting;
use Carbon\Carbon; 
use App\Customization;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Password;
use App\Mail\SendOPTForPasswordResetMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
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
    use SendsPasswordResetEmails;
    
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
     
    // public function submitForgetPasswordForm(Request $request) {
        
    //     $otp =  123456;
    //     $settings = Setting::first();

    //     /**
    //      * Start initial SMTP settings
    //      */
    //     if($settings->settings_site_smtp_enabled == Setting::SITE_SMTP_ENABLED) {
    //         // config SMTP
    //         config_smtp(
    //             $settings->settings_site_smtp_sender_name,
    //             $settings->settings_site_smtp_sender_email,
    //             $settings->settings_site_smtp_host,
    //             $settings->settings_site_smtp_port,
    //             $settings->settings_site_smtp_encryption,
    //             $settings->settings_site_smtp_username,
    //             $settings->settings_site_smtp_password
    //         );
    //     }
    //     /**
    //      * End initial SMTP settings
    //      */

    //     if(!empty($settings->setting_site_name))
    //     {
    //         // set up APP_NAME
    //         config([
    //             'app.name' => $settings->setting_site_name,
    //         ]);
    //     }
        
    //     $user = Password::getUser($request->only('email'));
    //     $this->validateEmail($request);
    //     $request->merge([
    //         'settings'  => $settings,
    //         'user'      => $user,
    //         'OTP'       => $otp,
    //     ]);
        
    //     Mail::send(new SendOPTForPasswordResetMail($request->all()));
    // }
    
    public function verifyOTP(Request $request)
    {
        $data = $request->all();
          
          $validator = Validator::make($data, [
            'email' => 'required',
            'otp' => 'required'
          ]);
          
          
  
          $verifyOTP = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'otp' => $request->otp
                              ])
                              ->first();
  
          if(isset($verifyOTP)){
            return response()->json([
              'message' => 'Invalid OTP',
              'status'  => 0
            ], 200);
          }
  
          return response()->json([
            'message' => 'Your Otp is Verified',
            'status'  => 1
          ], 200);

  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitResetPasswordForm(Request $request)
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
                                'otp' => $request->otp
                              ])
                              ->first();
  
          if(!$updatePassword){
            return response()->json([
              'message' => 'Invalid OTP',
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
