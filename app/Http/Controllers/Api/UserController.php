<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Plan;
use App\Tax;
use App\Item;
use App\ItemClaim;
use Auth;
use DB;
use Storage;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Setting;
use \stdClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  private $stripe;
  public function __construct()
  {
    $settings = Setting::first();
    $this->stripe = new StripeClient($settings->setting_site_stripe_secret_key);
  }
    
  public function get_user_profile(Request $request)
  {
    // Get user data
    $user_id = Auth::user()->id;
    $user = User::where('id',$user_id)->first();
    
    $user->user_image = env('APP_URL') . '/storage/user/user_image/' . $user->user_image;
    $user->user_background_image = env('APP_URL') . '/storage/user/user_background_image/' . $user->user_background_image;
      
    $plan_details = User::find(auth()->user()->id)->plans;
      
    // show subscription information for current user
    $login_user = Auth::user();
    $subscription = $login_user->subscription()->first();
    
    if($subscription->subscription_stripe_subscription_id != null){
    $subscription_details = $this->stripe->subscriptions->retrieve(
      $subscription->subscription_stripe_subscription_id,
      []
    );
    }
    else{
        $subscription_details = null;
    }
    
    //dd($subscription_details->items->data->id);
    
    $business_listings = Item::where('user_id', $login_user->id)->get();
    
    foreach($business_listings as $business_listing){
        if($business_listing->hasOpened()){
            $business_listing->shopStatus = "Opened";
        }
        else{
            $business_listing->shopStatus = "Closed";
        }
        $business_listing->item_image = config('app.url') . '/storage/item/' . $business_listing->item_image;
    }
    
    
        $item_claim_status = $request->item_claim_status;

        if($item_claim_status == ItemClaim::ITEM_CLAIM_FILTER_REQUESTED)
        {
            $all_item_claims = ItemClaim::where('user_id', $login_user->id)
                ->where('item_claim_status', ItemClaim::ITEM_CLAIM_STATUS_REQUESTED)
                ->get();
        }
        elseif($item_claim_status == ItemClaim::ITEM_CLAIM_FILTER_DISAPPROVED)
        {
            $all_item_claims = ItemClaim::where('user_id', $login_user->id)
                ->where('item_claim_status', ItemClaim::ITEM_CLAIM_STATUS_DISAPPROVED)
                ->get();
        }
        elseif($item_claim_status == ItemClaim::ITEM_CLAIM_FILTER_APPROVED)
        {
            $all_item_claims = ItemClaim::where('user_id', $login_user->id)
                ->where('item_claim_status', ItemClaim::ITEM_CLAIM_STATUS_APPROVED)
                ->get();
        }
        else
        {
            // if no data filter value get, then show all item claims of the login user.
            $all_item_claims = ItemClaim::where('user_id', $login_user->id)
                ->get();
        }
        
    $saved_items = $login_user->savedItems()->get();
    
    $businesslistingCount = count($business_listings);
    $claimlistingCount = count($all_item_claims);
    $savedlistingcount = count($saved_items);
    
    $result = new stdClass;
    $result->user = $user;
    $result->subscription = $subscription;
    $result->plan_details = $plan_details;
    $result->no_of_business_listings = $businesslistingCount;
    $result->no_of_claim_listings = $claimlistingCount;
    $result->no_of_saved_listings = $savedlistingcount;
    $result->business_listings = $business_listings;
    $result->claim_listings = $all_item_claims;
    $result->trial_taken = $subscription->trial_taken;
    
    if($subscription_details != null){
        $result->expiration_date = $subscription_details->current_period_end;
        $result->subscription_details = $subscription_details->status;
    }
    else{
        $result->expiration_date = null;
        $result->subscription_details = null;
    }

    if ($result) {
      return response()->json([
        'result'  => $result,
        'message' => 'User Details',
        'status'  => 1
      ], 200);
    } else {
      return response()->json([
        'message' => 'Something went wrong during order.',
        'status'  => 0
      ], 400);
    }
  }
  
  public function uploadImage($fileData, $loc)
  {
    // Get file name with extension
    $fileNameWithExt = $fileData->getClientOriginalName();
    // Get just file name
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    // Get just extension
    $fileExtension = $fileData->extension();
    // File name to store
    $fileNameToStore = time() . '.' . $fileExtension;
    // Finally Upload Image
    $fileData->storeAs($loc, $fileNameToStore);

    return $fileNameToStore;
  }
  
    public function get_states_list()
    {

        $result = Tax::select('id','city_name')->get();
        
        if ($result) {

            return response()->json([
                'result'  => $result,
                'message' => 'success',
                'status'  => 1
            ], 200);
        } else {
            return response()->json([
                'message' => 'No State Found',
                'status'  => 0
            ], 400);
        }
    }
  
//   public function update_user_profile(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'location' => 'required'
//         ]);
  
//         $input = $request->all();
  
//         if ($request->hasFile('user_image')) {


//         $number_435x220 = rand(1,999);
  
//         $numb_435x220 = $number_435x220 / 7 ;
  
//         $extension      = $request->user_image->extension();
//         $filenamenew_435x220    = date('Y-m-d')."_.".$numb_435x220."_.".$extension;

        
//         $filenamepath_435x220   = date('Y-m-d').'/'.'img/user1/'.$filenamenew_435x220;
//         $filename_435x220       = $request->user_image->move(public_path(date('Y-m-d').'/'.'img/user1/'),$filenamenew_435x220);


//         }else{
//           $filenamepath_435x220  = $subcategory->image_435x220; 
//         }
          
//         $result = User::where('id', auth()->user()->id)->update($input);
        
//         if ($result) {
//             return response()->json([
//                     'result'  => $result,
//                     'message' => 'success',
//                     'status'  => 1
//             ], 200);
//         }
//         else {
//             return response()->json([
//                 'message' => 'Something went wrong during order.',
//                 'status'  => 0
//             ], 400);
//         }

//     }

  /**
   * Get faqs
   *
   */
  public function update_user_profile(Request $request)
  {
    if($request->hasFile('user_image')) {
      // Save image to folder
      $extension      = $request->user_image->extension();
      $random_number = rand(10000000, 99999999);
      $filenamenew    = $random_number.".".$extension;
      $path = '/user/user_image';
      $ext = $request->user_image->getClientOriginalExtension();
      $fileName = $random_number.'.'.$ext;
      $request->user_image->storeAs($path, $filenamenew);
      $data1 = [
        'user_image' =>   $fileName,
      ];

      // Delete previous file
      $user = User::where('id', auth()->user()->id)->first();
      Storage::delete('storage/user/user_image/' . $user->user_image);
    }
    
    if($request->hasFile('user_background_image')) {
      // Save image to folder
      $extension      = $request->user_background_image->extension();
      $random_number = rand(10000000, 99999999);
      $filenamenew    = $random_number.".".$extension;
      $path = '/user/user_background_image';
      $ext = $request->user_background_image->getClientOriginalExtension();
      $fileName = $random_number.'.'.$ext;
      $request->user_background_image->storeAs($path, $filenamenew);
      $data2 = [
        'user_background_image' =>   $fileName,
      ];

      // Delete previous file
      $user = User::where('id', auth()->user()->id)->first();
      Storage::delete('storage/user/user_background_image/' . $user->user_background_image);
    }
    
    // store data in array
    $data = [
      'name' => $request->name,
      'user_about' => $request->description,
      'phone' => $request->phone,
      'dob' => $request->dob,
      'city' => $request->city,
      'state' => $request->state,
      'location' => $request->location
    ];

    // Merge all data arrays
    if ($request->hasFile('user_image') && $request->hasFile('user_background_image')) {
      $data = array_merge($data1, $data2, $data);
    } else if ($request->hasFile('user_image') && !$request->hasFile('user_background_image')) {
      $data = array_merge($data1, $data);
    } else if (!$request->hasFile('user_image') && $request->hasFile('user_background_image')) {
      $data = array_merge($data2, $data);
    } else {
      $data = $data;
    }

    // Update data into db
    $result = User::where('id', auth()->user()->id)->update($data);
    
    $users1 = DB::table('users')->where('id',auth()->user()->id)
            ->first();

    if ($result) {
      return response()->json([
        'result'  => $users1,
        'message' => 'success',
        'status'  => 1
      ], 200);
    } else {
      return response()->json([
        'message' => 'Something went wrong during order.',
        'status'  => 0
      ], 400);
    }
  }

}
