<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class CategoryItem extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    protected $table = 'category_item';
     
    // protected $fillable = [
        
    // ];

}
