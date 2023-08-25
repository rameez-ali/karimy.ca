<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'commenter_id',
        'commenter_type',
        'guest_name',
        'guest_email',
        'commentable_type',
        'commentable_id',
        'comment',
        'createdAt',
        'approved',
        'child_id',
    ];
    
    public function users()
    {
        return $this->belongsTo('App\User','commenter_id','id');
    }

}
