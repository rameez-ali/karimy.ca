<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Carbon\Carbon;
use App\Plan;
use App\Tax;
use App\User;
use App\Card;
use App\Setting;
use App\Subscription;
use Auth;
use DB;


class SubscriptionController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $settings = Setting::first();
        $this->stripe = new StripeClient($settings->setting_site_stripe_secret_key);
    }

    public function subscriptionHistory()
    {
        $user = Auth::user();  
        
        $subscription = Subscription::select('id', 'subscription_stripe_customer_id')
                  ->where('user_id', $user->id)
                  ->first();
                  

        if($subscription->subscription_stripe_customer_id != null){
            
        $all_subscription = $this->stripe->subscriptions->all(['customer' => $subscription->subscription_stripe_customer_id]);
        
        //dd($all_subscription);
              
        $transactions = DB::table('transactions')->where('user_id',$user->id)->get();
        
        //dd($transactions);
        
        foreach($transactions as $transaction)
        {
            $subscription_id = $transaction->subscription_id;
            $card_id = $transaction->card_id;
            
            if($card_id == NULL){
                
            }
            
            $subscription = $this->stripe->subscriptions->retrieve(
                $subscription_id
            );
            
            if($card_id != NULL){
                $card_number = $this->stripe->customers->retrieveSource(
                    $subscription->customer,
                    $card_id
                );
              $transaction->card_number = $card_number->last4;
            }
            else{
                $card_number = $this->stripe->paymentMethods->retrieve(
                  $transaction->payment_method,
                  []
                );
                
                $transaction->card_number = $card_number->card->last4;
                
            }
            
            $transaction->status = $subscription->status;
            
        }
        
            return response()->json([
                'result' => $transactions,
                'message' => "All Subscription",
                'status'  => 1
              ], 200);
        }
        else{
            return response()->json([
                'message' => "No Record Found",
                'status'  => 0
              ], 200);
        }
    }

    public function pay(Request $request)
    {
        $user = Auth::user();
        
        $state_name = User::where('id',$user->id)->value('state');
            
        if($state_name == NULL){
            
            return response()->json([
                'message' => "Please update your profile and select the state.",
                'status'  => 0
              ], 404);
        }
        
        $plan = Plan::select('id', 'plan_price', 'plan_name','plan_period')
                  ->where('id', $request->plan_id)
                  ->first();
        
        $subscription = Subscription::select('id', 'subscription_stripe_customer_id','trial_taken')
                  ->where('user_id', $user->id)
                  ->first();  
                  
                  
        $validator = Validator::make($request->all(), [
                'plan_id' => 'required',
        ]);
            
        if($validator->fails()) return response()->json([
                'success'   => false,
                'error'     => $validator->errors(),
                'message'   => 'Invalid input, please check the errors.'
            ], 422);
        
            
        if($plan->plan_period == Plan::PLAN_MONTHLY)
        {
            $stripe_product_description = 'Monthly Subscription';
            $stripe_interval_count = 1;
        }
        if($plan->plan_period == Plan::PLAN_QUARTERLY)
        {
            $stripe_product_description = 'Quarterly Subscription';
            $stripe_interval_count = 3;
        }
        if($plan->plan_period == Plan::PLAN_YEARLY)
        {
            $stripe_product_description = 'Yearly Subscription';
            $stripe_interval_count = 12;
        }

        
        // #1 - create a product record in Stripe
        $stripe_product = $this->stripe->products->create([
            'name' => $plan->plan_name,
            'description' => $stripe_product_description,
        ]);
        
            $login_user = Auth::user();
            $user_state_name = User::where('id',$login_user->id)->value('state');
            $tax = Tax::where('city_name',$user_state_name)->first();
            
            if($tax != null){
                $total_tax = $tax->pst + $tax->gst + $tax->hst;
                $tax_percentage = number_format($total_tax, 2, '.', '');
            }
            else{
                $tax_percentage = 5;
            }

            $update_plan_price = $plan->plan_price + number_format(($tax_percentage / 100) * $plan->plan_price, 2, '.', '');
            
            $stripe_price_unit_amount = $update_plan_price * 100;

        // #2 - create a price record for the product in Stripe
        $stripe_price = $this->stripe->prices->create([
            'unit_amount' => $stripe_price_unit_amount,
            'currency' => 'cad',
            'recurring' => ['interval' => 'month', 'interval_count' => $stripe_interval_count],
            'product' => $stripe_product['id'],
        ]);
        
        
        $stripe_customer['id'] = $subscription->subscription_stripe_customer_id;
       
        $card = $this->stripe->customers->update($stripe_customer['id'], ['default_source' => $request->card_id]);
        $card_id = $card->default_source;
       
        $trial_end_date = strtotime(Carbon::now()->addDay(30));
        
        if($subscription->trial_taken == 0){
        $charge = $this->stripe->subscriptions->create([
            'customer' => $stripe_customer['id'],
            'items' => [
                         ['price' => $stripe_price['id']],
                       ],
            'trial_end' => $trial_end_date,
            ]);
        }
        else{
            $charge = $this->stripe->subscriptions->create([
            'customer' => $stripe_customer['id'],
            'items' => [
                         ['price' => $stripe_price['id']],
                       ],
            ]);
        }
            
        if($charge['status'] == 'active' || $charge['status'] == 'trialing') {    
            
        $subscription_start_Date = date('Y-m-d H:i:s', $charge->current_period_start);
        $subscription_end_Date = date('Y-m-d H:i:s', $charge->current_period_end);
        

            Subscription::where('user_id', $user->id)->update([
                                'plan_id' => $plan->id,
                                'subscription_start_date' => $subscription_start_Date,
                                'subscription_end_date' => $subscription_end_Date,
                                'trial_taken' => "1",
                                'subscription_stripe_subscription_id' => $charge->id,
                                'subscription_pay_method' => "Stripe"
                                ]);
            
            DB::table('transactions')->insert([
                                'user_id' => $user->id,
                                'subscription_id' => $charge->id,
                                'subscription_name' => $plan->plan_name,
                                'subscription_price' => $plan->plan_price,
                                'card_id' => $card_id
                                ]);       
        
            $expiration_date = $charge->current_period_end;
            
            $auto_charge = Subscription::where('user_id', $user->id)->value('auto_charge');
            
            if($auto_charge == 0){
                $this->stripe->subscriptions->update(
                      $charge->id,
                      ['pause_collection' => ['behavior' => 'void']]
                    );
            }
            
            return response()->json([
                'expiration_date'  => $expiration_date,
                'message' => "Payment Completed",
                'status'  => 1
              ], 200);
        } else {
            return response()->json([
                'message' => "Payment Failed",
                'status'  => 0
              ], 200);
        }
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['card_number'],
                    'exp_month' => $cardData['exp_month'],
                    'exp_year' => $cardData['exp_year'],
                    'cvc' => $cardData['cvv'],
                    'address_country' => "CA",
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($amount, $stripe_customer_id)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'customer' => $stripe_customer_id,
                'amount' => $amount,
                'currency' => 'cad',
                'description' => 'Karimy Subscription Purchase'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
        
        //dd($charge);
    }
    
    public function cancelSubscription()
    {
        $login_user = Auth::user();
        
        $subscription = Subscription::select('id')
                  ->where('user_id', $login_user->id)
                  ->first();
        

        $subscription_id = $subscription->id;

        $subscription = Subscription::find($subscription_id);

        if($subscription)
        {
            if($login_user->id == $subscription->user_id)
            {
                
                if(!empty($subscription->subscription_stripe_subscription_id)
                    && $subscription->subscription_pay_method == Subscription::PAY_METHOD_STRIPE)
                {

                    $hello = $this->stripe->subscriptions->cancel(
                        $subscription->subscription_stripe_subscription_id,
                        []
                    );
                    
                }

                $subscription->plan_id = Plan::where('plan_type', Plan::PLAN_TYPE_FREE)
                    ->first()->id;
                $subscription->subscription_stripe_subscription_id = NULL;
                $subscription->save();

                 return response()->json([
                    'message' => "Subscription Cancelled Succesfully",
                    'status'  => 1
                  ], 200);
            }
            else
            {
                return response()->json([
                    'message' => "Subscription did not Cancel",
                    'status'  => 0
                  ], 200);
            }
        }
        else
        {
            return response()->json([
                    'message' => "Subscription not found",
                    'status'  => 0
                  ], 200);
        }
    }
}