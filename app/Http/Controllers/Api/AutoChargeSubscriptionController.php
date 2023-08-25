<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Subscription;
use Auth;
use DB;


class AutoChargeSubscriptionController extends Controller
{
    
    public function update_auto_charge_status($auto_charge)
    {
        $user = Auth::user();
        
        if($auto_charge == 1)
        {
            $result = Subscription::where('user_id',$user->id)->update(['auto_charge'=> 1]);
            return response()->json([
            'message' => 'Auto Charge Enabled',
            'status'  => 1
          ], 200);
        }
        else if($auto_charge == 0)
        {
            $result = Subscription::where('user_id',$user->id)->update(['auto_charge'=> 0]);
            return response()->json([
            'message' => 'Auto Charge Disabled',
            'status'  => 1
          ], 200);
        }
    
        
    }
}