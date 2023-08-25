<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;


class NotificationController extends Controller
{
    
    public function index()
    {
        // All Notifications of user
        $notifications = DB::table('notifications')->where('user_id',Auth::user()->id)->get();

        if($notifications)
        {
            return response()->json([
                'result' => $notifications,
                'message' => 'All Notifications',
                'status'  => 0
              ], 200);
        }
        else{
           return response()->json([
                'message' => 'Something Went Wrong',
                'status'  => 0
              ], 200); 
        }
    }
    

}