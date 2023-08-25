<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating',
        'recommend',
        'department',
        'body',
        'approved',
        'reviewrateable_type',
        'reviewrateable_id',
        'author_type',
        'author_id',
        
    ];
    
    public function items()
    {
        return $this->belongsTo('App\Item','reviewrateable_id','id');
    }
    
    public function users()
    {
        return $this->belongsTo('App\User','author_id','id');
    }

}
