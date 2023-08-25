<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Plan;
use App\User;
use App\Tax;
use DB;
use App\Setting;
use App\StripeWebhookLog;
use App\Subscription;
use App\Mail\Notification;
use App\Mail\EmailNotifications;
use DateTime;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;

class StripeController extends Controller
{
    protected $stripe_published_key;
    protected $stripe_secret_key;
    protected $stripe_webhook_signing_secret;
    protected $stripe_currency;
    
    private $stripe;
    public function __construct()
    {
        $settings = Setting::first();
        $this->stripe = new StripeClient($settings->setting_site_stripe_secret_key);
    }

    public function initialStripe()
    {
        $settings = app('site_global_settings');

        if($settings->setting_site_stripe_enable == Setting::SITE_PAYMENT_STRIPE_DISABLE)
        {
            \Session::flash('flash_message', __('stripe.alert.stripe-disable'));
            \Session::flash('flash_type', 'danger');

            return redirect()->route('user.subscriptions.index');
        }

        $this->stripe_published_key = $settings->setting_site_stripe_publishable_key;
        $this->stripe_secret_key = $settings->setting_site_stripe_secret_key;
        $this->stripe_webhook_signing_secret = $settings->setting_site_stripe_webhook_signing_secret;
        $this->stripe_currency = $settings->setting_site_stripe_currency;
    }

    public function doCheckout(int $plan_id, int $subscription_id)
    {
        try
        {
            $this->initialStripe();

            $login_user = Auth::user();
            $current_subscription = new Subscription();
            if(!$current_subscription->planSubscriptionValidation($plan_id, $subscription_id, $login_user->id))
            {
                \Session::flash('flash_message', __('alert.paypal-plan-subscription-error'));
                \Session::flash('flash_type', 'danger');

                return redirect()->route('user.subscriptions.index');
            }

            $current_subscription = Subscription::find($subscription_id);

            if($current_subscription->plan()->first()->plan_type != Plan::PLAN_TYPE_FREE)
            {
                \Session::flash('flash_message', __('alert.paypal-free-plan-upgrade'));
                \Session::flash('flash_type', 'danger');

                return redirect()->route('user.subscriptions.index');
            }

            $stripe_published_key = $this->stripe_published_key;
            $stripe_secret_key = $this->stripe_secret_key;

            $future_plan = Plan::find($plan_id);
            $stripe_product_name = $future_plan->plan_name;
            $stripe_price_unit_amount = $future_plan->plan_price * 100;
            $stripe_price_currency = $this->stripe_currency;
            $stripe_interval_count = 1;
            $stripe_product_description = "";
            
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

            $update_plan_price = $future_plan->plan_price + number_format(($tax_percentage / 100) * $future_plan->plan_price, 2, '.', '');
            
            $stripe_price_unit_amount = $update_plan_price * 100;
            
            if($future_plan->plan_period == Plan::PLAN_MONTHLY)
            {
                $stripe_product_description = 'Monthly Subscription';
                $stripe_interval_count = 1;
            }
            if($future_plan->plan_period == Plan::PLAN_QUARTERLY)
            {
                $stripe_product_description = 'Quarterly Subscription';
                $stripe_interval_count = 3;
            }
            if($future_plan->plan_period == Plan::PLAN_YEARLY)
            {
                $stripe_product_description = 'Yearly Subscription';
                $stripe_interval_count = 12;
            }

            $stripe = new \Stripe\StripeClient($stripe_secret_key);

            // #1 - create a product record in Stripe
            $stripe_product = $stripe->products->create([
                'name' => $stripe_product_name,
                'description' => $stripe_product_description,
            ]);

            // #2 - create a price record for the product in Stripe
            $stripe_price = $stripe->prices->create([
                'unit_amount' => $stripe_price_unit_amount,
                'currency' => $stripe_price_currency,
                'recurring' => ['interval' => 'month', 'interval_count' => $stripe_interval_count],
                'product' => $stripe_product['id'],
            ]);

            // #3 - create a customer record in Stripe
            $stripe_customer = $stripe->customers->create([
                'name' => $login_user->name,
                'email' => $login_user->email,
            ]);

            
            $stripe_session = $stripe->checkout->sessions->create([
                'customer' => $stripe_customer['id'],
                'success_url' => route('user.stripe.checkout.success', ['plan_id' => $plan_id, 'subscription_id' => $subscription_id, 'subscription_stripe_customer_id' => $stripe_customer['id'] ]),
                'cancel_url' => route('user.stripe.checkout.cancel'),
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $stripe_price['id'],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'subscription',
            ]);
            
          // edit above code by zeeshan
          
            $stripe_session_id = $stripe_session['id'];
            
            // if($stripe_session['subscription']){
            //     $subs = $stripe->subscriptions->retrieve(
            //       $stripe_session['subscription'],
            //       []
            //     );
            //     dd($subs); exit;
            // $subscription_start_Date = date('Y-m-d H:i:s', $subs->current_period_start);
            // $subscription_end_Date = date('Y-m-d H:i:s', $subs->current_period_end);
            
            // $current_subscription->subscription_stripe_customer_id = $stripe_customer['id'];
            // $current_subscription->subscription_stripe_subscription_id = $stripe_session['subscription'];
            // $current_subscription->subscription_start_date = $subscription_start_Date;
            // $current_subscription->subscription_end_date = $subscription_end_Date;
            // $current_subscription->subscription_pay_method = Subscription::PAY_METHOD_STRIPE;
            // $current_subscription->save();
            // }
            
            

            
            
            return view('backend.user.subscription.payment.stripe.do-checkout',
                compact('stripe_published_key', 'stripe_session_id'));

        }
        catch (Exception $e) {

            Log::error($e);

            \Session::flash('flash_message', $e->getMessage());
            \Session::flash('flash_type', 'danger');

            return redirect()->route('user.subscriptions.index');
        }
    }

    public function showCheckoutSuccess(int $plan_id, int $subscription_id, $subscription_stripe_customer_id )
    {
        $this->initialStripe();
        $login_user = Auth::user();
        $future_plan = Plan::find($plan_id);
         
        //Here we will add confirmation email of subscrition
        
         /*
            Here we will add email notification to customer about purchasing listing.
            */
    // to customer
     $settings = app('site_global_settings');
     if($settings->settings_site_smtp_enabled == Setting::SITE_SMTP_ENABLED)
        {
            // config SMTP
            config_smtp(
                $settings->settings_site_smtp_sender_name,
                $settings->settings_site_smtp_sender_email,
                $settings->settings_site_smtp_host,
                $settings->settings_site_smtp_port,
                $settings->settings_site_smtp_encryption,
                $settings->settings_site_smtp_username,
                $settings->settings_site_smtp_password
            );
        }
        
        if(!empty($settings->setting_site_name))
        {
            // set up APP_NAME
            config([
                'app.name' => $settings->setting_site_name,
            ]);
        }
        
        $email_user = $login_user;
        $email_subject = __('email.premium_service.subject');
        
        $email_notify_message = [
            //__('email.premium_service.body.body-1'),
            "Thank you for signing up with our ".$future_plan->plan_name." subscription",
            __('email.premium_service.body.body-3'),
            "You can now add your business details through the following link:"
        ];
        
        $routeURL = Auth::user()->hasPaidSubscription() ? route('user.items.create') : route('page.pricing');
         try
        {
            // to user
            Mail::to($email_user)->send(
                new Notification(
                    $email_subject,
                    $email_user->name,
                    null,
                    $email_notify_message,
                    "Create Business Listing Now",
                    "",
                    $routeURL
                )
            );

            \Session::flash('flash_message', __('alert.message-send'));
            \Session::flash('flash_type', 'success');

        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            \Session::flash('flash_message', __('theme_directory_hub.email.alert.sending-problem'));
            \Session::flash('flash_type', 'danger');
        }
        
        
            
            /* end
            */
            
        $all_subscription = $this->stripe->subscriptions->all(['customer' => $subscription_stripe_customer_id]);
        
        foreach($all_subscription as $subscription)
        {
            // #5 - insert the stripe customer_id, subscription id and updated plan_id to the subscription
            
            $subs = $this->stripe->subscriptions->retrieve(
                  $subscription->id,
                  []
                );
            
            $subscription_start_Date = date('Y-m-d H:i:s', $subs->current_period_start);
            $subscription_end_Date = date('Y-m-d H:i:s', $subs->current_period_end);
            
            $current_subscription = Subscription::find($subscription_id);
            $current_subscription->subscription_stripe_customer_id = $subscription_stripe_customer_id;
            $current_subscription->plan_id = $plan_id;
            $current_subscription->subscription_start_date = $subscription_start_Date;
            $current_subscription->subscription_end_date = $subscription_end_Date;
            $current_subscription->subscription_stripe_subscription_id = $subscription->id;
            $current_subscription->subscription_pay_method = "Stripe";
            $current_subscription->save();
            
            DB::table('transactions')->insert([
                                'user_id' => $login_user->id,
                                'subscription_id' => $subscription->id,
                                'subscription_name' => $future_plan->plan_name,
                                'subscription_price' => $future_plan->plan_price,
                                'invoice_id' => $subscription->latest_invoice,
                                'payment_method' => $subscription->default_payment_method,
                                ]);  
        }
        

        // We will verify the payment in notify function, here just simple redirect to subscription page with a
        // success message.
        \Session::flash('flash_message', __('stripe.alert.payment-success'));
        \Session::flash('flash_type', 'success');

        return redirect()->route('user.subscriptions.index');
    }

    public function cancelCheckout()
    {
        $this->initialStripe();

        \Session::flash('flash_message', __('stripe.alert.payment-canceled'));
        \Session::flash('flash_type', 'success');

        return redirect()->route('user.subscriptions.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ApiErrorException
     */
    public function cancelRecurring(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|max:255',
        ]);

        $subscription_id = $request->subscription_id;

        $subscription = Subscription::find($subscription_id);

        if($subscription)
        {
            $this->initialStripe();

            $login_user = Auth::user();

            if($login_user->id == $subscription->user_id)
            {
                if(!empty($subscription->subscription_stripe_subscription_id)
                    && $subscription->subscription_pay_method == Subscription::PAY_METHOD_STRIPE)
                {
                    $stripe_secret_key = $this->stripe_secret_key;
                    $stripe = new \Stripe\StripeClient($stripe_secret_key);

                    $stripe->subscriptions->cancel(
                        $subscription->subscription_stripe_subscription_id,
                        []
                    );
                }

                $subscription->plan_id = Plan::where('plan_type', Plan::PLAN_TYPE_FREE)
                    ->first()->id;

//                $subscription->subscription_pay_method = null;
//                $subscription->subscription_stripe_customer_id = null;
//                $subscription->subscription_stripe_subscription_id = null;
//                $subscription->subscription_stripe_future_plan_id = null;
                $subscription->save();

                \Session::flash('flash_message', __('alert.paypal-subscription-canceled'));
                \Session::flash('flash_type', 'success');

                return redirect()->route('user.subscriptions.index');
            }
            else
            {
                \Session::flash('flash_message', __('alert.paypal-subscription-user-not-match'));
                \Session::flash('flash_type', 'danger');

                return redirect()->route('user.subscriptions.index');
            }
        }
        else
        {
            \Session::flash('flash_message', __('alert.paypal-subscription-not-found'));
            \Session::flash('flash_type', 'danger');

            return redirect()->route('user.subscriptions.index');
        }
    }

    /**
     * Stripe webhooks
     * @param Request $request
     * @throws Exception
     */
    public function notify(Request $request)
    {
        $this->initialStripe();

        //$stripe_secret_key = "sk_test_51HUNfIGwHz6tXHDfGoIJCd6PK3WYA7VtZ77e3OqE8K9GQemk8LMa1LrZQe2glJ1J8PfRJAeFJ45skzXB8ZRfey7k00xJiT3ggz";
        //$stripe = new \Stripe\StripeClient($stripe_secret_key);

        // You can find your endpoint's secret in your webhook settings
        $endpoint_secret = $this->stripe_webhook_signing_secret;

        $payload = @file_get_contents("php://input");
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try
        {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        }
        catch(\UnexpectedValueException $e)
        {
            // Invalid payload
            http_response_code(400);
            exit();
        }
        catch(\Stripe\Exception\SignatureVerificationException $e)
        {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        if($event)
        {
            // save raw webhook to database
            $stripe_webhook_log = new StripeWebhookLog();
            $stripe_webhook_log->stripe_webhook_log_value = $payload;
            $stripe_webhook_log->save();

            if($event->type == 'checkout.session.completed')
            {
                // Handle the checkout.session.completed event.
                // This event is sent when a customer clicks the Pay button in Checkout, informing you of a new purchase.

                $stripe_subscription_id = $event->data->object->subscription;
                $stripe_customer_id = $event->data->object->customer;

                // find the subscription record in subscriptions table
                $subscription = Subscription::where('subscription_stripe_customer_id', $stripe_customer_id)->get();

                if($subscription->count() == 0)
                {
                    http_response_code(404);
                    exit();
                }

                $subscription = $subscription->first();
                $subscription->subscription_stripe_subscription_id = $stripe_subscription_id;
                $subscription->save();
            }

            if($event->type == 'invoice.paid')
            {
                // The status of the invoice will show up as paid. Store the status in your
                // database to reference when a user accesses your service to avoid hitting rate
                // limits.

                // This event is sent each billing interval when a payment succeeds.

                // #1 - get the stripe customer_id
                $stripe_customer_id = $event->data->object->customer;
                $stripe_invoice_id = $event->data->object->id;
                $stripe_subscription_id = $event->data->object->subscription;

                $current_subscription = Subscription::where('subscription_stripe_customer_id', $stripe_customer_id)
                    ->where('subscription_stripe_subscription_id', $stripe_subscription_id)
                    ->where('subscription_pay_method', Subscription::PAY_METHOD_STRIPE)
                    ->get();

                if($current_subscription->count() == 0)
                {
                    http_response_code(404);
                    exit();
                }
                $current_subscription = $current_subscription->first();

                // #2 - create a new invoice in invoices table
                $future_plan = Plan::findOrFail($current_subscription->subscription_stripe_future_plan_id);

                $invoice_num = strtoupper('invoice_' . uniqid());
                $invoice = new Invoice();
                $invoice->subscription_id = $current_subscription->id;
                $invoice->invoice_num = $invoice_num;
                $invoice->invoice_item_title = $future_plan->plan_name;
                $invoice->invoice_item_description = $future_plan->plan_features;
                $invoice->invoice_amount = $future_plan->plan_price;
                $invoice->invoice_status = 'Paid';
                $invoice->invoice_pay_method = Subscription::PAY_METHOD_STRIPE;
                $invoice->invoice_stripe_invoice_id = $stripe_invoice_id;
                $invoice->save();

                // #3 - update subscription
                $today = new DateTime('now');
                if(!empty($current_subscription->subscription_end_date))
                {
                    $today = new DateTime($current_subscription->subscription_end_date);
                }
                if($future_plan->plan_period == Plan::PLAN_MONTHLY)
                {
                    $today->modify("+1 month");
                    $current_subscription->subscription_end_date = $today->format("Y-m-d");
                }
                if($future_plan->plan_period == Plan::PLAN_QUARTERLY)
                {
                    $today->modify("+3 month");
                    $current_subscription->subscription_end_date = $today->format("Y-m-d");
                }
                if($future_plan->plan_period == Plan::PLAN_YEARLY)
                {
                    $today->modify("+12 month");
                    $current_subscription->subscription_end_date = $today->format("Y-m-d");
                }
                $current_subscription->plan_id = $future_plan->id;

//                $current_subscription->subscription_max_free_listing = is_null($future_plan->plan_max_free_listing) ? null : $future_plan->plan_max_free_listing;
//                $current_subscription->subscription_max_featured_listing = is_null($future_plan->plan_max_featured_listing) ? null : $future_plan->plan_max_featured_listing;

                $current_subscription->save();
            }

            if($event->type == 'invoice.payment_failed')
            {
                // This event is sent each billing interval if there is an issue with your customer’s payment method.

                $stripe_customer_id = $event->data->object->customer;
                $stripe_invoice_id = $event->data->object->id;
                $stripe_subscription_id = $event->data->object->subscription;

                $current_subscription = Subscription::where('subscription_stripe_customer_id', $stripe_customer_id)
                    ->where('subscription_stripe_subscription_id', $stripe_subscription_id)
                    ->where('subscription_pay_method', Subscription::PAY_METHOD_STRIPE)
                    ->get();

                if($current_subscription->count() == 0)
                {
                    http_response_code(404);
                    exit();
                }
                $current_subscription = $current_subscription->first();

                // #2 - create a new invoice in invoices table
                $future_plan = Plan::findOrFail($current_subscription->subscription_stripe_future_plan_id);

                $invoice_num = strtoupper('invoice_' . uniqid());
                $invoice = new Invoice();
                $invoice->subscription_id = $current_subscription->id;
                $invoice->invoice_num = $invoice_num;
                $invoice->invoice_item_title = $future_plan->plan_name;
                $invoice->invoice_item_description = $future_plan->plan_features;
                $invoice->invoice_amount = $future_plan->plan_price;
                $invoice->invoice_status = 'Failed';
                $invoice->invoice_pay_method = Subscription::PAY_METHOD_STRIPE;
                $invoice->invoice_stripe_invoice_id = $stripe_invoice_id;
                $invoice->save();
            }
        }

        http_response_code(200);
        exit();
    }
}
