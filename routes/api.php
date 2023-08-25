<?php

use App\Http\Controllers\Api\GeneralApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemApiController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\TaxController;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Api\Auth\ChangePasswordController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\AutoChargeSubscriptionController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\WebhookController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('webhook/event_cancelled', [WebhookController::class, 'update_subscription']);

Route::post('/v1/auth/register', [AuthenticationController::class, 'register']);
Route::post('/v1/auth/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/v1/auth/account/verify/{token}', [AuthenticationController::class, 'verifyAccount'])->name('user.verify');
Route::post('/v1/otp/verify', [ForgotPasswordController::class, 'verifyOTP'])->name('otp.verify');

Route::post('/v1/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']); 

Route::post('/v1/new-password', [NewPasswordController::class, 'submitForgetPasswordForm']); 

Route::post('/v1/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.get');

// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
//     Route::post('/v1/auth/logout', [AuthController::class, 'logout']);
// });


Route::prefix('/user')->middleware(['auth:api'])->group(function () {
    
    Route::get('/v1/auth/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::post('/v1/change-password', [ChangePasswordController::class, 'store'])->name('change.password');
    Route::get('/v1/get-user-profile', [UserController::class, 'get_user_profile'])->name('get.user.profile');
    Route::get('/v1/get-states-list', [UserController::class, 'get_states_list'])->name('get.user.state');
    Route::post('/v1/update-user-profile', [UserController::class, 'update_user_profile'])->name('update.user.profile');
    
    Route::post('/v1/send-deviceid-otp', [AuthenticationController::class, 'send_deviceid_otp'])->name('send.deviceid.otp');
    Route::post('/v1/save-device-token', [AuthenticationController::class, 'save_device_token'])->name('save.device.token');

    
    Route::post('/v1/subscribe', [SubscriptionController::class, 'pay']);
    Route::get('/v1/cancel-subscription', [SubscriptionController::class, 'cancelSubscription']);
    Route::get('/v1/auto-charge/{id}', [AutoChargeSubscriptionController::class, 'update_auto_charge_status']);
    Route::get('/v1/subscription-history', [SubscriptionController::class, 'subscriptionHistory']);

    Route::get('/v1/my-state-tax', [TaxController::class, 'my_state_tax']);
    
    Route::get('/v1/get-all-notifications', [NotificationController::class, 'index']);
    
    Route::get('/v1/cards', [CardController::class, 'index']);
    Route::post('/v1/card/save', [CardController::class, 'store']);
    Route::delete('/v1/card/delete/{id}', [CardController::class, 'destroy']);
    
    Route::get('/v1/my-messages', [MessageController::class, 'my_messages']);
    Route::get('/v1/message-details/{thread_id}', [MessageController::class, 'message_details']);
    Route::post('/v1/message-reply', [MessageController::class, 'message_reply']);
    Route::post('/v1/message/send', [MessageController::class, 'send_message']);
    
    Route::post('/v1/contact/admin', [MessageController::class, 'send_message_to_admin']);
    
    Route::post('/v1/item/listing/save', [ItemApiController::class, 'saveItemListing']);
    
    Route::post('/v1/item/listing/update', [ItemApiController::class, 'updateItemListing']);
    
    Route::get('/v1/item/get-my-reviews', [ItemApiController::class, 'getMyReviews']);
    Route::post('/v1/item/review/save', [ItemApiController::class, 'saveItemReview']);
    Route::post('/v1/item/comment/save', [ItemApiController::class, 'saveItemComment']);
    Route::post('/v1/item/claim/save', [ItemApiController::class, 'claimItem']);
    
   Route::get('/v1/item/claims', [ItemApiController::class, 'getclaimItems']);

    
    Route::get('/v1/all/items', [ItemApiController::class,'getallListings']);
    
    Route::post('/v1/item/save', [ItemApiController::class, 'saveItem']);
    Route::post('/v1/item/unsave', [ItemApiController::class, 'unSaveItem']);
    Route::get('/v1/saved/items', [ItemApiController::class, 'SavedItems']);
    
});

Route::middleware(['installed', 'demo', 'global_variables', 'maintenance'])->group(function () {
  Route::get('/v1/item/featured/list', [ItemApiController::class, 'getFeaturedItems']);
  Route::get('/v1/item/latest/list', [ItemApiController::class, 'getRecentItems']);
  Route::post('/v1/item/nearby/list', [ItemApiController::class, 'getNearbyItems']);
  Route::get('/v1/item/category/list', [ItemApiController::class, 'getItemCategories']);
  Route::post('/v1/item/subcategory/list', [ItemApiController::class, 'getItemSubcategories']);
  Route::post('/v1/item/by-state/list', [ItemApiController::class, 'getItemsByState']);
  Route::post('/v1/item/by-city/list', [ItemApiController::class, 'getItemsByCity']);
  Route::post('/v1/item/cities-by-state/list', [ItemApiController::class, 'getCitiesByState']);
  Route::post('/v1/item/by-category/list', [ItemApiController::class, 'getItemsByCategory']);
  Route::post('/v1/item-by-category/list', [ItemApiController::class, 'getItemsByCategoryList']);
  Route::post('/v1/item/status', [ItemApiController::class, 'checkItemStatus']);
  Route::post('/v1/item', [ItemApiController::class, 'getItem']);
  
  Route::get('/v1/parent-category', [ItemApiController::class, 'getParentCategory']);
  Route::get('/v1/child-category/{parent_cat_id}', [ItemApiController::class, 'getChildCategory']);

  Route::get('/v1/canada-states', [GeneralApiController::class, 'getCanadaStates']);
  
  Route::get('/v1/item/get-listing-reviews/{item_id}', [ItemApiController::class, 'getListingReviews']);
  Route::get('/v1/item/get-listing-comments/{item_id}', [ItemApiController::class, 'getListingComments']);

  // pages
  Route::get('/v1/faqs', [GeneralApiController::class, 'getFaqs']);
  Route::get('/v1/privacy-policy', [GeneralApiController::class, 'getPrivacyPolicy']);
  Route::get('/v1/about-us', [GeneralApiController::class, 'getAboutUs']);
  Route::get('/v1/plan', [GeneralApiController::class, 'getPlans']);
  
  Route::get('/v1/blogs', [GeneralApiController::class, 'getBlogs']);
  Route::get('/v1/blog/{id}', [GeneralApiController::class, 'getBlogById']);
  
});
