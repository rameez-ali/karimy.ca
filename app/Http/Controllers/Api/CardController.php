<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Subscription;
use App\Card;
use App\Setting;
use Auth;


class CardController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $settings = Setting::first();
        $this->stripe = new StripeClient($settings->setting_site_stripe_secret_key);
    }
    
    public function index()
    {
        $user = Auth::user();
        
        $subscription = Subscription::select('id', 'subscription_stripe_customer_id')
                  ->where('user_id', $user->id)
                  ->first();
                  
            
        if ($subscription->subscription_stripe_customer_id != null) {
            $cards = $this->stripe->customers->allSources(
                    $subscription->subscription_stripe_customer_id,
                    ['object' => 'card']
            );
            return response(["result" => $cards, 'status' => '1', 'message' => 'All Cards'], 200);
        } else {
            return response(['status' => '0', 'message' => 'No Data Found'], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_holder' => 'required',
            'card_number' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvv' => 'required'
        ]);
        
        if($validator->fails()) return response()->json([
            'success'   => false,
            'error'     => $validator->errors(),
            'message'   => 'Invalid input, please check the errors.'
        ], 422);
        
        
        $token = $this->createToken($request);
        
        if (!empty($token['error'])) {
            return response()->json([
                'message' => $token['error'],
                'status'  => 0
              ], 200);
        }
        
        if (empty($token['id'])) {
            return response()->json([
                'message' => "Payment Failed",
                'status'  => 0
              ], 200);
        }
        
        $user = Auth::user();
        
        $subscription = Subscription::select('id', 'subscription_stripe_customer_id')
                  ->where('user_id', $user->id)
                  ->first();
                  
       if($subscription->subscription_stripe_customer_id == null){
        // #3 - create a customer record in Stripe
        $stripe_customer = $this->stripe->customers->create([
            'name' => $user->name,
            'email' => $user->email,
        ]);
        Subscription::where('user_id', $user->id)->update(['subscription_stripe_customer_id' => $stripe_customer['id']]);
       }
       else{
           $stripe_customer['id'] = $subscription->subscription_stripe_customer_id;
       }          
        
        $card = $this->stripe->customers->createSource(
            $stripe_customer['id'],
            ['source' => $token['id']]
        );
        
        
        if ($card) {
          return response()->json([
            'result'  => $card,
            'message' => 'Card Added Successfully',
            'status'  => 1
          ], 200);
        } else {
          return response()->json([
            'message' => 'Something went wrong.',
            'status'  => 0
          ], 400);
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

}