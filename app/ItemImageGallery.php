<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemImageGallery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'item_image_gallery_name',
        'item_image_gallery_thumb_name',
        'item_image_gallery_size',
    ];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];
    
    /**
     * Determine if the user is an administrator.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function getImageUrlAttribute() 
    {
        return $this->attributes = config('app.url') . '/storage/item/gallery/' .$this->item_image_gallery_name;
    }

    /**
     * Get the item that owns the gallery image.
     */
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
