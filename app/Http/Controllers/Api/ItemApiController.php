<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\ItemImageGallery;
use App\City;
use App\Review;
use App\ReviewImageGallery;
use App\ItemClaim;
use App\Comment;
use App\Category;
use App\CategoryItem;
use App\CustomField;
use App\ItemFeature;
use App\Subscription;
use App\ItemHour;
use QrCode;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemApiController extends Controller
{
  /**
   * Get featured items
   *
   */
  public function getFeaturedItems()
  {
    $site_prefer_country_id = app('site_prefer_country_id');
    $subscription_obj = new Subscription();
    $paid_items_query = Item::query();

    // get paid users id array
    $paid_user_ids = $subscription_obj->getPaidUserIds();

    $paid_items_query->where("items.item_status", Item::ITEM_PUBLISHED)
      ->where(function ($query) use ($site_prefer_country_id) {
        $query->where('items.country_id', $site_prefer_country_id)
          ->orWhereNull('items.country_id');
      })
      ->where('items.item_featured', Item::ITEM_FEATURED)
      ->where(function ($query) use ($paid_user_ids) {

        $query->whereIn('items.user_id', $paid_user_ids)
          ->orWhere('items.item_featured_by_admin', Item::ITEM_FEATURED_BY_ADMIN);
      });

    $paid_items_query->orderBy('items.created_at', 'DESC')->distinct('items.id');

    $paid_items = Item::where('item_featured',1)->where('item_status',2)->get();

    // Add base url to images url
    $paid_items->transform(function ($q) {
      $q->item_image = config('app.url') . '/storage/item/' . $q->item_image;
      $q->item_image_medium = config('app.url') . '/storage/item/' . $q->item_image_medium;
      $q->item_image_small = config('app.url') . '/storage/item/' . $q->item_image_small;
      $q->item_image_tiny = config('app.url') . '/storage/item/' . $q->item_image_tiny;

      return $q;
    });

    $result = $paid_items->shuffle();
    
    foreach ($result as $result1) {
        if($result1->hasOpened()){
            $result1->shopStatus = "Opened";
        }
        else{
            $result1->shopStatus = "Closed";
        }
        $result1->item_average_rating = Review::where('reviewrateable_id',$result1->id)->where('approved',1)->avg('rating');
    }
    
    

    if ($result) {
      return response()->json([
        'result'  => $result,
        'count'   => count($result),
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
  
  public function saveItemListing(Request $request)
  {
        /**
         * Start check plan quota
         */
        $login_user = Auth::user();
        
        if($request->item_featured == Item::ITEM_FEATURED)
        {
            if(!$login_user->canFeatureItem())
            {
                return response()->json([
                    'message' => 'You have reached max featured business listing quota.',
                    'status'  => 0
                  ], 400);
            }
        }
        else
        {

            if(!$login_user->canFreeItem())
            {
                return response()->json([
                    'message' => 'You have reached max free business listing quota.',
                    'status'  => 0
                  ], 400);
            }
        }
        /**
         * End check plan quota
         */
        $item_slug = str_slug($request->item_title);
        
        if(Item::where('item_slug',$item_slug)->value('id'))
        {
            return response()->json([
                'message' => 'You cant add second listing',
                'status'  => 1
              ], 200);
        }
        
      if ($request->hasFile('item_image')) {
        // Save image to folder
        $extension      = $request->item_image->extension();
        $random_number = rand(10000000, 99999999);
        $filenamenew    = $random_number.".".$extension;
        $path = '/item';
        $ext = $request->item_image->getClientOriginalExtension();
        $fileName = $random_number.'.'.$ext;
        $request->item_image->storeAs($path, $filenamenew);
        $item_image = $filenamenew;
    }
    else{
        $item_image = NULL; 
    }
         
        //start saving category string to item_categories_string column of items table
        $item_categories_string = "";
        foreach($request->select_categories as $select_categories_key => $select_category)
        {
            $item_categories_string = $item_categories_string . " " . Category::find($select_category)->category_name;
        }
        
        
        $item_featured = $request->item_featured == Item::ITEM_FEATURED ? Item::ITEM_FEATURED : Item::ITEM_NOT_FEATURED;
        
        $item = new Item();
        $item->user_id = $login_user->id;
        $item->item_featured = $item_featured;
        $item->item_title = $request->item_title;
        $item->item_slug = $item_slug;
        $item->item_description = $request->item_description;
        $item->item_image = $item_image;
        $item->item_address = $request->item_address;
        $item->city_id = $request->city_id;
        $item->state_id = $request->state_id;
        $item->country_id = $request->country_id;
        $item->item_status = "1";
        $item->item_website = $request->item_website;
        $item->item_phone = $request->item_phone;
        $item->item_categories_string = $item_categories_string;
        $item->item_lat = $request->item_lat;
        $item->item_lng = $request->item_lng;
        $item->terms_condition = $request->terms_condition;
        $item->save();
        
        $item->allCategories()->sync($request->select_categories);
        
        // start to save custom fields data
        $category_custom_fields = new CustomField();
        $category_custom_fields = $category_custom_fields->getDistinctCustomFieldsByCategories($request->select_categories);
        
        if($category_custom_fields->count() > 0)
        {
            foreach($category_custom_fields as $category_custom_fields_key => $custom_field)
            {
                if($custom_field->custom_field_type == CustomField::TYPE_MULTI_SELECT)
                {
                    $multi_select_values = $request->get(str_slug($custom_field->custom_field_name . $custom_field->id), '');
                    $multi_select_str = '';
                    if(is_array($multi_select_values))
                    {
                        foreach($multi_select_values as $multi_select_values_key => $value)
                        {
                            $multi_select_str .= $value . ', ';
                        }
                    }
                    $new_item_feature = new ItemFeature(array(
                        'custom_field_id' => $custom_field->id,
                        'item_feature_value' => empty($multi_select_str) ? '' : substr(trim($multi_select_str), 0, -1),
                    ));
                }
                else
                {
                    $new_item_feature = new ItemFeature(array(
                        'custom_field_id' => $custom_field->id,
                        'item_feature_value' => $request->get(str_slug($custom_field->custom_field_name . $custom_field->id), ''),
                    ));
                }

                $created_item_feature = $item->features()->save($new_item_feature);

                $item->item_features_string = $item->item_features_string . $created_item_feature->item_feature_value . " ";
                $item->save();
            }
        }
        
        /**
         * Start save item hours
         */
        $item_hours = empty($request->item_hours) ? array() : $request->item_hours;

        foreach($item_hours as $item_hours_key => $item_hour)
        {
            $item_hour_record = explode(' ', $item_hour);

            if(count($item_hour_record) == 3)
            {
                $item_hour_day_of_week = intval($item_hour_record[0]);

                if($item_hour_day_of_week >= ItemHour::DAY_OF_WEEK_MONDAY && $item_hour_day_of_week <= ItemHour::DAY_OF_WEEK_SUNDAY)
                {
                    $item_hour_open_hour = intval(substr($item_hour_record[1], 0, 2));
                    $item_hour_close_hour = intval(substr($item_hour_record[2], 0, 2));

                    if($item_hour_open_hour <= $item_hour_close_hour)
                    {
                        $item_hour_open_time = $item_hour_record[1] . ':00';
                        $item_hour_close_time = $item_hour_record[2] . ':00';

                        if($item_hour_open_hour == 24)
                        {
                            $item_hour_open_time = '24:00:00';
                        }

                        if($item_hour_close_hour == 24)
                        {
                            $item_hour_close_time = '24:00:00';
                        }

                        if($item_hour_open_time != $item_hour_close_time)
                        {
                            $create_item_hour = new ItemHour(array(
                                'item_id' => $new_item->id,
                                'item_hour_day_of_week' => $item_hour_day_of_week,
                                'item_hour_open_time' => $item_hour_open_time,
                                'item_hour_close_time' => $item_hour_close_time,
                            ));
                            $create_item_hour->save();
                        }
                    }
                }
            }
        }
        /**
         * End save item hours
         */

        /**
         * Start save item hour exceptions
         */
        $item_hour_exceptions = empty($request->item_hour_exceptions) ? array() : $request->item_hour_exceptions;

        foreach($item_hour_exceptions as $item_hour_exceptions_key => $item_hour_exception)
        {
            $item_hour_exception_record = explode(' ', $item_hour_exception);

            $item_hour_exception_date = $item_hour_exception_record[0];

            if(DateTime::createFromFormat('Y-m-d', $item_hour_exception_date) !== false)
            {
                $item_hour_exception_open_time = null;
                $item_hour_exception_close_time = null;

                if(count($item_hour_exception_record) == 3)
                {
                    $item_hour_exception_open_time = $item_hour_exception_record[1] . ':00';
                    $item_hour_exception_close_time = $item_hour_exception_record[2] . ':00';

                    $item_hour_exception_open_hour = intval(substr($item_hour_exception_record[1], 0, 2));
                    $item_hour_exception_close_hour = intval(substr($item_hour_exception_record[2], 0, 2));

                    if($item_hour_exception_open_hour == 24)
                    {
                        $item_hour_exception_open_time = '24:00:00';
                    }

                    if($item_hour_exception_close_hour == 24)
                    {
                        $item_hour_exception_close_time = '24:00:00';
                    }

                    if($item_hour_exception_open_hour > $item_hour_exception_close_hour || $item_hour_exception_open_time == $item_hour_exception_close_time)
                    {
                        continue;
                    }
                }

                $create_item_hour_exception = new ItemHourException(array(
                    'item_id' => $new_item->id,
                    'item_hour_exception_date' => $item_hour_exception_date,
                    'item_hour_exception_open_time' => $item_hour_exception_open_time,
                    'item_hour_exception_close_time' => $item_hour_exception_close_time,
                ));
                $create_item_hour_exception->save();
            }
        }
        /**
         * End save item hour exceptions
         */
         
      if($item) {
      return response()->json([
        'result'  => $item,
        'message' => 'Your listing has been submitted for review and it will be post once the admin will approve it',
        'status'  => 1
      ], 200);
    } else {
      return response()->json([
        'message' => 'Something went wrong during order.',
        'status'  => 0
      ], 400);
    }
  }
  
  /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Item $item
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updateItemListing(Request $request)
    {
        /**
         * Start check plan quota
         */
        $login_user = Auth::user();


        if ($request->hasFile('item_image')) {
        // Save image to folder
        $extension      = $request->item_image->extension();
        $random_number = rand(10000000, 99999999);
        $filenamenew    = $random_number.".".$extension;
        $path = '/item';
        $ext = $request->item_image->getClientOriginalExtension();
        $fileName = $random_number.'.'.$ext;
        $request->item_image->storeAs($path, $filenamenew);
        $item_image = $filenamenew;
        }
        else{
            $item_image = NULL; 
        }
        
        $item = Item::find($request->item_id);
        $item->item_featured = $request->featured;
        $item->item_title = $request->item_title;
        $item->item_description = $request->item_description;
        $item->item_image = $item_image;
        $item->item_address = $request->item_address;
        $item->item_status = "2";
        $item->item_website = $request->item_website;
        $item->item_phone = $request->item_phone;
        $item->item_lat = $request->item_lat;
        $item->item_lng = $request->item_lng;
        $item->save();
        
        // start to upload image galleries
        $image_gallery = $request->file('image_gallery');
        if($image_gallery)
        // if(is_array($image_gallery) && count($image_gallery) > 0)
        {
            ItemImageGallery::where('item_id',$request->item_id)->delete();
            
            $total_item_image_gallery = $item->galleries()->count();
            foreach($image_gallery as $image_gallery_key => $gallery_image)
            {
                // check if the listing's gallery images reach the max number of gallery images
                 if ($gallery_image != NULL) {
                        // Save image to folder
                        $extension      = $gallery_image->extension();
                        $random_number = rand(10000000, 99999999);
                        $filenamenew    = $random_number.".".$extension;
                        $path = '/item/gallery';
                        $ext = $gallery_image->getClientOriginalExtension();
                        $fileName = $random_number.'.'.$ext;
                        $gallery_image->storeAs($path, $filenamenew);
                        $gallery_image_name = $filenamenew;
                    
                        $item_gallery = new ItemImageGallery();
                        $item_gallery->item_image_gallery_name = $gallery_image_name;
                        $item_gallery->item_id = $request->item_id;
                        $item_gallery->save();
            }
          }
        }
        
        /**
         * Start save item hours
         */
        $item_hours = empty($request->item_hours) ? array() : $request->item_hours;
        
        if($item_hours)
        {
            ItemHour::where('item_id',$request->item_id)->delete();
            
        foreach($item_hours as $item_hours_key => $item_hour)
        {
            $item_hour_record = explode(' ', $item_hour);

            if(count($item_hour_record) == 3)
            {
                $item_hour_day_of_week = intval($item_hour_record[0]);

                if($item_hour_day_of_week >= ItemHour::DAY_OF_WEEK_MONDAY && $item_hour_day_of_week <= ItemHour::DAY_OF_WEEK_SUNDAY)
                {
                    $item_hour_open_hour = intval(substr($item_hour_record[1], 0, 2));
                    $item_hour_close_hour = intval(substr($item_hour_record[2], 0, 2));

                    if($item_hour_open_hour <= $item_hour_close_hour)
                    {
                        $item_hour_open_time = $item_hour_record[1] . ':00';
                        $item_hour_close_time = $item_hour_record[2] . ':00';

                        if($item_hour_open_hour == 24)
                        {
                            $item_hour_open_time = '24:00:00';
                        }

                        if($item_hour_close_hour == 24)
                        {
                            $item_hour_close_time = '24:00:00';
                        }

                        if($item_hour_open_time != $item_hour_close_time)
                        {
                            $create_item_hour = new ItemHour(array(
                                'item_id' => $item->id,
                                'item_hour_day_of_week' => $item_hour_day_of_week,
                                'item_hour_open_time' => $item_hour_open_time,
                                'item_hour_close_time' => $item_hour_close_time,
                            ));
                            $create_item_hour->save();

                        }
                    }
                }
            }
        }
        /**
         * End save item hours
         */
        }
    

        if($item) {
          return response()->json([
            'result'  => $item,
            'message' => 'Your listing has been Updated',
            'status'  => 1
          ], 200);
        } else {
          return response()->json([
            'message' => 'Something went wrong during order.',
            'status'  => 0
          ], 400);
        }
    }

  /**
   * Get featured items
   *
   */
  public function getRecentItems()
  {
    $site_prefer_country_id = app('site_prefer_country_id');

    /**
     * get first 6 latest items
     */
    $latest_items = Item::latest('created_at')
      ->where(function ($query) use ($site_prefer_country_id) {
        $query->where('items.country_id', $site_prefer_country_id)
          ->orWhereNull('items.country_id');
      })
      ->where('item_status', Item::ITEM_PUBLISHED)
      ->with('state')
      ->with('city')
      ->with('user')
      ->with('itemHours')
      ->take(6)
      ->get();

    // Add base url to images url
    $latest_items->transform(function ($q) {
      $q->item_image = config('app.url') . '/storage/item/' . $q->item_image;
      $q->item_image_medium = config('app.url') . '/storage/item/' . $q->item_image_medium;
      $q->item_image_small = config('app.url') . '/storage/item/' . $q->item_image_small;
      $q->item_image_tiny = config('app.url') . '/storage/item/' . $q->item_image_tiny;

      return $q;
    });
    
    foreach ($latest_items as $latest_item) {
        if($latest_item->hasOpened()){
            $latest_item->shopStatus = "Opened";
        }
        else{
            $latest_item->shopStatus = "Closed";
        }
    }

    if ($latest_items) {
      return response()->json([
        'result'  => $latest_items,
        'count'   => count($latest_items),
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

  /**
   * Get featured items
   *
   */
  public function getNearbyItems(Request $request)
  {
    // Validate data
    $validator = Validator::make($request->all(), [
      'latitude'  => 'required',
      'longitude' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    $site_prefer_country_id = app('site_prefer_country_id');

    // Get nearby items
    $nearbyItems = Item::selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( item_lat ) ) * cos( radians( item_lng ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( item_lat ) ) ) ) AS distance', [$request->latitude, $request->longitude, $request->latitude])
      ->where('country_id', $site_prefer_country_id)
      ->where('item_status', Item::ITEM_PUBLISHED)
      ->orderBy('distance')
      ->orderBy('created_at', 'DESC')
      ->with('state')
      ->with('city')
      ->with('user')
      ->with('itemHours')
      ->take(9)->get();

    $nearbyItems = $nearbyItems->shuffle();

    // Add base url to images url
    $nearbyItems->transform(function ($q) {
      $q->item_image = config('app.url') . '/storage/item/' . $q->item_image;
      $q->item_image_medium = config('app.url') . '/storage/item/' . $q->item_image_medium;
      $q->item_image_small = config('app.url') . '/storage/item/' . $q->item_image_small;
      $q->item_image_tiny = config('app.url') . '/storage/item/' . $q->item_image_tiny;

      return $q;
    });
    
     foreach ($nearbyItems as $result1) {
        if($result1->hasOpened()){
            $result1->shopStatus = "Opened";
        }
        else{
            $result1->shopStatus = "Closed";
        }
        $result1->item_average_rating = Review::where('reviewrateable_id',$result1->id)->where('approved',1)->avg('rating');
    }
    
    

    if ($nearbyItems) {
      return response()->json([
        'result'  => $nearbyItems,
        'count'   => count($nearbyItems),
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

  /**
   * Get items by state
   *
   */
  public function getItemsByState(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'state_id'  => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    $site_prefer_country_id = app('site_prefer_country_id');

    // Get items by state
    $latest_items = Item::latest('created_at')
      ->where(function ($query) use ($site_prefer_country_id) {
        $query->where('items.country_id', $site_prefer_country_id)
          ->orWhereNull('items.country_id');
      })
      ->where('item_status', Item::ITEM_PUBLISHED)
      ->where('state_id', $request->state_id)
      ->with('state')
      ->with('city')
      ->with('user')
      ->with('itemHours')
      ->get();
      
    foreach ($latest_items as $latest_item) {
        if($latest_item->hasOpened()){
            $latest_item->shopStatus = "Opened";
        }
        else{
            $latest_item->shopStatus = "Closed";
        }
      $latest_item->item_average_rating = Review::where('reviewrateable_id',$latest_item->id)->where('approved',1)->avg('rating');
    }

    // Add base url to images url
    $latest_items->transform(function ($q) {
      $q->item_image = config('app.url') . '/storage/item/' . $q->item_image;
      $q->item_image_medium = config('app.url') . '/storage/item/' . $q->item_image_medium;
      $q->item_image_small = config('app.url') . '/storage/item/' . $q->item_image_small;
      $q->item_image_tiny = config('app.url') . '/storage/item/' . $q->item_image_tiny;

      return $q;
    });
    
    
    if ($latest_items) {
      return response()->json([
        'result'  => $latest_items,
        'count'   => count($latest_items),
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
  
  /**
   * Get items by city
   *
   */
  public function getItemsByCity(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'city_id'  => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    $site_prefer_country_id = app('site_prefer_country_id');

    // Get items by state
    $latest_items = Item::latest('created_at')
      ->where(function ($query) use ($site_prefer_country_id) {
        $query->where('items.country_id', $site_prefer_country_id)
          ->orWhereNull('items.country_id');
      })
      ->where('item_status', Item::ITEM_PUBLISHED)
      ->where('city_id', $request->city_id)
      ->with('state')
      ->with('city')
      ->with('user')
      ->with('itemHours')
      ->get();

    // Add base url to images url
    $latest_items->transform(function ($q) {
      $q->item_image = config('app.url') . '/storage/item/' . $q->item_image;
      $q->item_image_medium = config('app.url') . '/storage/item/' . $q->item_image_medium;
      $q->item_image_small = config('app.url') . '/storage/item/' . $q->item_image_small;
      $q->item_image_tiny = config('app.url') . '/storage/item/' . $q->item_image_tiny;

      return $q;
    });
    
    foreach ($latest_items as $latest_item) {
        if($latest_item->hasOpened()){
            $latest_item->shopStatus = "Opened";
        }
        else{
            $latest_items->shopStatus = "Closed";
        }
    $latest_item->item_average_rating = Review::where('reviewrateable_id',$latest_item->id)->where('approved',1)->avg('rating');
    }

    if ($latest_items) {
      return response()->json([
        'result'  => $latest_items,
        'count'   => count($latest_items),
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
  
  /**
   * Get cities by state
   *
   */
  public function getCitiesByState(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'state_id'  => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    // Get cities by state
    $cities = City::latest('created_at')
      ->where('state_id', $request->state_id)
      ->get();

    if ($cities) {
      return response()->json([
        'result'  => $cities,
        'count'   => count($cities),
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
  
  /**
   * Get items by category
   *
   */
  public function getItemsByCategoryList(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_id'  => 'required'
    ]);
    
    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }
    
    $item_ids = CategoryItem::select('item_id')->where('category_id', $request->category_id)->get();
    
    $items = Item::whereIn('id', $item_ids)->get();
    
    // Add base url to images url
    $items->transform(function ($q) {
      $q->item_image = config('app.url') . '/storage/item/' . $q->item_image;
      $q->item_image_medium = config('app.url') . '/storage/item/' . $q->item_image_medium;
      $q->item_image_small = config('app.url') . '/storage/item/' . $q->item_image_small;
      $q->item_image_tiny = config('app.url') . '/storage/item/' . $q->item_image_tiny;

      return $q;
    });
    
    foreach ($items as $item) {
        if($item->hasOpened()){
            $item->shopStatus = "Opened";
        }
        else{
            $item->shopStatus = "Closed";
        }
        $item->item_average_rating = Review::where('reviewrateable_id',$item->id)->where('approved',1)->avg('rating');
    }
    
    
    if ($items) {
      return response()->json([
        'result'       => $items,
        'message' => 'success',
        'status'  => 1
      ], 200);
    } else {
      return response()->json([
        'message' => 'Something went wrong during order.',
        'status'  => 0
      ], 200);
    }

    
  }
  /**
   * Get items by category
   *
   */
  public function getItemsByCategory(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_id'  => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    $site_prefer_country_id = app('site_prefer_country_id');

    $category = Category::where('id', $request->category_id)->first();

    $category_obj = new Category();
    $all_child_categories = collect();
    $all_child_categories_ids = array();
    $category->allChildren($category, $all_child_categories);
    foreach ($all_child_categories as $key => $all_child_category) {
      $all_child_categories_ids[] = $all_child_category->id;
    }

    $item_ids = $category_obj->getItemIdsByCategoryIds($all_child_categories_ids);

    // Paid user listings
    $subscription_obj = new Subscription();
    $paid_user_ids = $subscription_obj->getPaidUserIds();
    $paid_items_query = Item::query();

    $paid_items_query->whereIn('id', $item_ids);

    $paid_items_query->where("items.item_status", Item::ITEM_PUBLISHED)
      ->where(function ($query) use ($site_prefer_country_id) {
        $query->where('items.country_id', $site_prefer_country_id)
          ->orWhereNull('items.country_id');
      })
      ->where('items.item_featured', Item::ITEM_FEATURED)
      ->where(function ($query) use ($paid_user_ids) {

        $query->whereIn('items.user_id', $paid_user_ids)
          ->orWhere('items.item_featured_by_admin', Item::ITEM_FEATURED_BY_ADMIN);
      });

    $paid_items_query->orderBy('items.created_at', 'DESC')
      ->distinct('items.id')
      ->with('state')
      ->with('city')
      ->with('user');

    $paidItems =  $paid_items_query->get();

    // Add base url to images url
    $paidItems->transform(function ($q) {
      $q->item_image = config('app.url') . '/storage/item/' . $q->item_image;
      $q->item_image_medium = config('app.url') . '/storage/item/' . $q->item_image_medium;
      $q->item_image_small = config('app.url') . '/storage/item/' . $q->item_image_small;
      $q->item_image_tiny = config('app.url') . '/storage/item/' . $q->item_image_tiny;

      return $q;
    });

    $resultPaidItems = $paidItems->shuffle();
    // END / Paid user listings

    // Free user listings
    $free_items_query = Item::query();
    $free_user_ids = $subscription_obj->getActiveUserIds();
    $free_items_query->whereIn('id', $item_ids);
    $free_items_query->where("items.item_status", Item::ITEM_PUBLISHED)
      ->where(function ($query) use ($site_prefer_country_id) {
        $query->where('items.country_id', $site_prefer_country_id)
          ->orWhereNull('items.country_id');
      })
      ->where('items.item_featured', Item::ITEM_NOT_FEATURED)
      ->where('items.item_featured_by_admin', Item::ITEM_NOT_FEATURED_BY_ADMIN)
      ->whereIn('items.user_id', $free_user_ids);

    /**
     * Start filter sort by for free listing
     */
    $filter_sort_by = empty($request->filter_sort_by) ? Item::ITEMS_SORT_BY_NEWEST_CREATED : $request->filter_sort_by;
    if ($filter_sort_by == Item::ITEMS_SORT_BY_NEWEST_CREATED) {
      $free_items_query->orderBy('items.created_at', 'DESC');
    } elseif ($filter_sort_by == Item::ITEMS_SORT_BY_OLDEST_CREATED) {
      $free_items_query->orderBy('items.created_at', 'ASC');
    } elseif ($filter_sort_by == Item::ITEMS_SORT_BY_HIGHEST_RATING) {
      $free_items_query->orderBy('items.item_average_rating', 'DESC');
    } elseif ($filter_sort_by == Item::ITEMS_SORT_BY_LOWEST_RATING) {
      $free_items_query->orderBy('items.item_average_rating', 'ASC');
    } elseif ($filter_sort_by == Item::ITEMS_SORT_BY_NEARBY_FIRST) {
      $free_items_query->selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( item_lat ) ) * cos( radians( item_lng ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( item_lat ) ) ) ) AS distance', [$this->getLatitude(), $this->getLongitude(), $this->getLatitude()])
        ->where('items.item_type', Item::ITEM_TYPE_REGULAR)
        ->orderBy('distance', 'ASC');
    }
    /**
     * End filter sort by for free listing
     */

    $free_items_query->distinct('items.id')
      ->with('state')
      ->with('city')
      ->with('user');

    $freeItems =  $free_items_query->get();

    // Add base url to images url
    $freeItems->transform(function ($q) {
      $q->item_image = config('app.url') . '/storage/item/' . $q->item_image;
      $q->item_image_medium = config('app.url') . '/storage/item/' . $q->item_image_medium;
      $q->item_image_small = config('app.url') . '/storage/item/' . $q->item_image_small;
      $q->item_image_tiny = config('app.url') . '/storage/item/' . $q->item_image_tiny;

      return $q;
    });

    $resultFreeItems = $freeItems->shuffle();
    // END / Free user listings
    
    foreach ($resultPaidItems as $resultPaidItem) {
                if($resultPaidItem->hasOpened()){
                    $resultPaidItem->shopStatus = "Opened";
                }
                else{
                    $resultPaidItem->shopStatus = "Closed";
                }
            $resultPaidItem->item_average_rating = Review::where('reviewrateable_id',$resultPaidItem->id)->where('approved',1)->avg('rating');
            }
    
    foreach ($resultFreeItems as $resultFreeItem) {
                if($resultFreeItem->hasOpened()){
                    $resultFreeItem->shopStatus = "Opened";
                }
                else{
                    $resultFreeItem->shopStatus = "Closed";
                }
            $resultFreeItem->item_average_rating = Review::where('reviewrateable_id',$resultFreeItem->id)->where('approved',1)->avg('rating');
            }

    if ($resultPaidItems) {
      return response()->json([
        'paid_items'       => $resultPaidItems,
        'count_paid_items' => count($resultPaidItems),
        'free_items'        => $resultFreeItems,
        'count_free_items' => count($resultFreeItems),
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

    /**
   * Get Parent Category
   *
   */
  public function getParentCategory()
  {
    $categories = Category::
                  where('category_parent_id', null)
                  ->get();


    if($categories) {
      return response()->json([
        'result'  => $categories,
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
  
   /**
   * Get Child Category
   *
   */
  public function getChildCategory($parent_cat_id)
  {
    $categories = Category::
                  where('category_parent_id', $parent_cat_id)
                  ->get();


    if($categories) {
      return response()->json([
        'result'  => $categories,
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
  /**
   * Get item categories
   *
   */
  public function getItemCategories()
  {
    $site_prefer_country_id = app('site_prefer_country_id');
    $subscription_obj = new Subscription();

    $active_user_ids = $subscription_obj->getActiveUserIds();
    $categories = Category::withCount(['allItems' => function ($query) use ($active_user_ids, $site_prefer_country_id) {
      $query->whereIn('items.user_id', $active_user_ids)
        ->where('items.item_status', Item::ITEM_PUBLISHED)
        ->where(function ($query) use ($site_prefer_country_id) {
          $query->where('items.country_id', $site_prefer_country_id)
            ->orWhereNull('items.country_id');
        });
    }])
      ->where('category_parent_id', null)
      ->orderBy('all_items_count', 'desc')
      ->get();

    // Add base url to images url
    $categories->transform(function ($q) {
      if ($q->category_image === "0" || $q->category_image == null) {
        $q->category_image = null;
      } else {
        $q->category_image = config('app.url') . '/storage/category/' . $q->category_image;
      }

      if ($q->category_header_background_image == 0 || $q->category_header_background_image == null) {
        $q->category_header_background_image = null;
      } else {
        $q->category_header_background_image = config('app.url') . '/storage/category/' . $q->category_header_background_image;
      }
    
        
      return $q;
    });

    if ($categories) {
      return response()->json([
        'result'  => $categories,
        'count'   => count($categories),
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

  /**
   * Get item subcategories
   *
   */

  public function getItemSubcategories(Request $request)
  {
    // Validate data
    $validator = Validator::make($request->all(), [
      'category_slug' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    $category = Category::where('category_slug', $request->category_slug)->first();
    // get one level down sub-categories
    $subcategories = $category->children()->orderBy('category_name')->get();

    // Add base url to images url
    $subcategories->transform(function ($q) {
      if ($q->category_image === "0" || $q->category_image == null) {
        $q->category_image = null;
      } else {
        $q->category_image = config('app.url') . '/storage/category/' . $q->category_image;
      }

      if ($q->category_header_background_image == 0 || $q->category_header_background_image == null) {
        $q->category_header_background_image = null;
      } else {
        $q->category_header_background_image = config('app.url') . '/storage/category/' . $q->category_header_background_image;
      }

      return $q;
    });

    if ($subcategories) {
      return response()->json([
        'result'  => $subcategories,
        'count'   => count($subcategories),
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

  /**
   * Check item status
   *
   */
  public function checkItemStatus(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'item_id'  => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    $item = Item::where('id', $request->item_id)->first();

    if($item->hasOpened()) {
      $result = "Now open";
    } else {
      $result = "Closed";
    }

    if($result) {
      return response()->json([
        'result'  => $result,
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

  /**
   * Get item
   *
   */
  public function getItem(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'item_id'  => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    $result = Item::with('itemHours')
            ->with('galleries')
            ->with('comments')
            ->with('features.customField:id,custom_field_name')
            ->where('id', $request->item_id)
            ->first();
            
    $item_features_string_break =  explode(" ",$result->item_features_string);
    
    if(isset($item_features_string_break[6])){
        $result->item_features_website_1 = $item_features_string_break[6];
    }
    
    if(isset($item_features_string_break[7])){
        $result->item_features_website_2 = $item_features_string_break[7];
    }
        
            
            
    $reviews = Review::where('reviewrateable_id',$request->item_id)->where('approved',1)->get();
    $no_of_reviews = count($reviews);
    
    $comments = DB::table('comments')->where('commentable_id',$request->item_id)
            ->get();
            
    $result->item_average_rating = Review::where('reviewrateable_id',$request->item_id)->where('approved',1)->avg('rating');
            
    $no_of_comments = count($comments);
    $result->no_of_comments = $no_of_comments;
    $result->no_of_reviews = $no_of_reviews;
    $result->qr_code = config('app.url') . '/listing/' . $result->item_slug;
    
    
            
    //Item has a relationship with features and features also has a relationship with custom field         
    //Fetching custom_field_name value from custom field and attaching it features to reduce the complexity      
    foreach ($result->features as $result2) {
        $result2->custom_field_name = $result2->customField->custom_field_name;
    }
            
    $variable = ItemFeature::with('customField')->where('item_id',$request->item_id)->get(); //This will load the product with the related designs

    // Add base url to images url
    $result->item_image = config('app.url') . '/storage/item/' . $result->item_image;
    $result->item_image_medium = config('app.url') . '/storage/item/' . $result->item_image_medium;
    $result->item_image_small = config('app.url') . '/storage/item/' . $result->item_image_small;
    $result->item_image_tiny = config('app.url') . '/storage/item/' . $result->item_image_tiny;

    if ($result) {
      return response()->json([
        'result'  => $result,
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
  
  /**
    * Save item comment
    *
    */
  public function saveItemComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|max:255',
            'comment' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $login_user = Auth::user();

        $comment = new Comment();
        $comment->commenter_id = $login_user->id;
        $comment->commenter_type = "App\User";
        $comment->commentable_type = "App\Item";
        $comment->commentable_id = $request->item_id;
        $comment->createdAt = $request->createdAt;
        $comment->comment = $request->comment;
        $comment->save();
        
        if ($comment) {
            return response()->json([
                'result'  => $comment,
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
    
    /**
    * Get My Reviews
    *
    */
    public function getMyReviews()
    {
       
        $login_user = Auth::user();
        
        $reviews = Review::with('items')->where('author_id',$login_user->id)->get();
        
        foreach($reviews as $review){
            $review->items->item_image = config('app.url') . '/storage/item/' . $review->items->item_image;
        }
        
        if ($reviews) {
            return response()->json([
                'result'  => $reviews,
                'message' => 'All Reviews',
                'status'  => 1
             ], 200);
            } else {
              return response()->json([
                'message' => 'Something went wrong during order.',
                'status'  => 0
            ], 400);
        }

    }
    
    /**
    * Get Listing Reviews
    *
    */
    public function getListingReviews($item_id)
    {
       
        $reviews = Review::with('users')->where('reviewrateable_id',$item_id)->get();
        
        foreach($reviews as $review){
            $review->users->user_image = config('app.url') . '/storage/user/user_image/' . $review->users->user_image;
        }
        
        if ($reviews) {
            return response()->json([
                'result'  => $reviews,
                'message' => 'All Reviews',
                'status'  => 1
             ], 200);
            } else {
              return response()->json([
                'message' => 'Something went wrong during order.',
                'status'  => 0
            ], 400);
        }

    }
    
    /**
    * Get Listing Comments
    *
    */
    public function getListingComments($item_id)
    {
        
        $comments = Comment::with('users')->where('commentable_id',$item_id)->get();
        
        if(isset($comments)){
            foreach($comments as $comment){
                    $comment->users->user_image = config('app.url') . '/storage/user/user_image/' . $comment->users->user_image;
            }
        }
        
        if($comments) {
            return response()->json([
                'result'  => $comments,
                'message' => 'All Comments',
                'status'  => 1
             ], 200);
            } else {
              return response()->json([
                'message' => 'Something went wrong during order.',
                'status'  => 0
            ], 400);
        }

    }
    
    /**
    * Save item comment
    *
    */
  public function saveItemReview(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'overall_rating' => 'required|numeric|max:5',
            'body' => 'required|max:65535',
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $login_user = Auth::user();
        

        $review = new Review();
        $review->rating = $request->overall_rating;
        $review->recommend = "Yes";
        $review->department = "Sales";
        $review->approved = "1";
        $review->body = $request->body;
        $review->reviewrateable_type = "App\Item";
        $review->reviewrateable_id = $request->item_id;
        $review->author_type = "App\User";
        $review->author_id = $login_user->id;
        $review->save();
        
        
        // if($request->hasfile('image'))
        //  {
        //     foreach($request->file('image') as $file)
        //     {
        //         $image_name = time().rand(1,100).'.'.$file->extension();
        //         $file->move(public_path('storage/item/itemreview'), $image_name);  
        //         $files = $image_name; 
                
        //         $review_images= new ReviewImageGallery();
        //         $review_images->review_id = $review->id;
        //         $review_images->review_image_gallery_name = $files;
        //         $review_images->save();
        //     }
        //  }
         
        
        if ($review) {
            return response()->json([
                'result'  => $review,
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
    
    /**
    * Save item comment
    *
    */
  public function claimItem(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'full_name' => 'required',
            'additional_proof' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $login_user = Auth::user();
        

        if($request->hasfile('additional_upload'))
         {
            $file = $request->file('additional_upload');
            $image_name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path('storage/item/itemclaim'), $image_name);  
            $file = $image_name; 
        }
        else{
            $file = "NULL"; 
        }
        
        $item_claim = new ItemClaim();
        $item_claim->user_id = $login_user->id;
        $item_claim->item_id = $request->item_id;
        $item_claim->item_claim_full_name = $request->full_name;
        $item_claim->item_claim_phone = $request->phone;
        $item_claim->item_claim_email = $request->email;
        $item_claim->item_claim_additional_proof = $request->additional_proof;
        $item_claim->item_claim_additional_upload = $file;
        $item_claim->item_claim_status = "1";
        $item_claim->save();
        
        
        if ($item_claim) {
            return response()->json([
                'result'  => $item_claim,
                'message' => 'success',
                'status'  => 1
              ], 200);
            } else {
              return response()->json([
                'message' => 'Something went wrong.',
                'status'  => 0
            ], 400);
        }

    }
    
    public function saveItem(Request $request)
    {
            $login_user = Auth::user();
            
            $check_item_status = DB::table('item_user')->where('user_id',$login_user->id)->where('item_id',$request->item_id)->value('id');
            
            if ($check_item_status == null) {
                $result = $login_user->savedItems()->attach($request->item_id);
                return response()->json([
                    'message' => 'success',
                    'status'  => 1
                  ], 200);
            } else {
                  return response()->json([
                    'message' => 'Item Already Exists.',
                    'status'  => 0
                ], 200);
            }
            
    }
    
    public function getallListings()
    {
            $login_user = Auth::user();
            
            $business_items = $login_user->items()->get();
            
            foreach($business_items as $business_item){
                if($business_item->hasOpened()){
                    $business_item->shopStatus = "Opened";
                }
                else{
                    $business_item->shopStatus = "Closed";
                }
                $business_item->item_image = config('app.url') . '/storage/item/' . $business_item->item_image;
            }
            
            $saved_items = $login_user->savedItems()->get();
            
            foreach($saved_items as $saved_item){
                if($saved_item->hasOpened()){
                    $saved_item->shopStatus = "Opened";
                }
                else{
                    $saved_item->shopStatus = "Closed";
                }
                $saved_item->item_image = config('app.url') . '/storage/item/' . $saved_item->item_image;
            }

            $claimed_items = $login_user->claimitems()->get();

            foreach($claimed_items as $claimed_item){
                if($claimed_item->hasOpened()){
                    $claimed_item->shopStatus = "Opened";
                }
                else{
                    $claimed_item->shopStatus = "Closed";
                }
                $claimed_item->item_image = config('app.url') . '/storage/item/' . $claimed_item->item_image;
            }
            
            
            $result = new \Stdclass();
            $result->business_listings = $business_items;
            $result->saved_listings = $saved_items;
            $result->claimed_listings = $claimed_items;
            

            if ($result) {
                return response()->json([
                    'result' => $result,
                    'message' => 'success',
                    'status'  => 1
                  ], 200);
            } else {
                  return response()->json([
                    'message' => 'No Data Found.',
                    'status'  => 0
                ], 400);
            }
            
    }
    
    public function unSaveItem(Request $request)
    {
            $login_user = Auth::user();
            
            $result = $login_user->savedItems()->detach($request->item_id);
            

            if ($result) {
                return response()->json([
                    'message' => 'success',
                    'status'  => 1
                  ], 200);
            } else {
                  return response()->json([
                    'message' => 'Something went wrong.',
                    'status'  => 0
                ], 400);
            }
            
    }
    
    public function getclaimItems()
    {
            $login_user = Auth::user();

            $claimed_items = $login_user->claimitems()->get();

            foreach($claimed_items as $claimed_item){
                $claimed_item->item_image = config('app.url') . '/storage/item/' . $claimed_item->item_image;
            }
            
            foreach ($claimed_items as $result1) {
                if($result1->hasOpened()){
                    $result1->shopStatus = "Opened";
                }
                else{
                    $result1->shopStatus = "Closed";
                }
            }
            
            
            if ($claimed_items) {
                return response()->json([
                    'result' => $claimed_items,
                    'message' => 'success',
                    'status'  => 1
                  ], 200);
            } else {
                  return response()->json([
                    'message' => 'No Data Found.',
                    'status'  => 0
                ], 400);
            }
            
    }
    
    
    public function SavedItems(Request $request)
    {
            $login_user = Auth::user();
            
            $result = $login_user->savedItems()->get();
            
            foreach($result as $imageresult){
                $imageresult->item_image = config('app.url') . '/storage/item/' . $imageresult->item_image;
            }
            
            foreach ($result as $result1) {
                if($result1->hasOpened()){
                    $result1->shopStatus = "Opened";
                }
                else{
                    $result1->shopStatus = "Closed";
                }
            }
            
            if (count($result) > 0) {
                return response()->json([
                    'result' => $result,
                    'message' => 'success',
                    'status'  => 1
                  ], 200);
            } else {
                  return response()->json([
                    'message' => 'No Data found.',
                    'status'  => 0
                ], 200);
            }
            
    }

  /**
   * Send validation errors
   *
   */
  public function sendError($message)
  {
    $message = $message->all();
    $response['error'] = "validation_error";
    $response['message'] = implode('', $message);
    $response['status'] = "0";
    return response()->json($response, 422);
  }
}
