<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;

class WebhookController extends Controller
{
    
  public function update_subscription(Request $request)
  {
      $subscription_object = $request->data;
      $subscription = $subscription_object['object'];
      $subscription_id = $subscription['id'];
      $subscription_status = $subscription['status'];
      
      
      if($subscription_status == "canceled"){
            $result = DB::table('subscriptions')
                      ->where('subscription_stripe_subscription_id', $subscription_id)
                       ->update(['plan_id' => 1, 'subscription_stripe_subscription_id' => NULL ]);
      }
      else if($subscription_status == "active"){
          
          $subscription_start_date = date('d-m-Y H:i:s', $subscription['current_period_start']);
          $subscription_end_date = date('d-m-Y H:i:s', $subscription['current_period_end']);
      
          $result = DB::table('subscriptions')
                      ->where('subscription_stripe_subscription_id', $subscription_id)
                       ->update(['subscription_start_date' => $subscription_start_date, 'subscription_end_date' => $subscription_end_date ]);
      }

              
    if(isset($result)) {
      return response()->json([
        'message' => 'success',
        'status'  => 1
      ], 200);
    } else {
      return response()->json([
        'message' => 'Something went wrong',
        'status'  => 0
      ], 400);
    }
              
  }

}
