<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewImageGallery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'review_id',
        'review_image_gallery_name',
        'review_image_gallery_thumb_name',
        'review_image_gallery_size',
    ];

}
