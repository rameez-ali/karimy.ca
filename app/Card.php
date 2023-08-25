<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','card_holder', 'card_number', 'exp_month', 'exp_year', 'cvv'
    ];
   
}
