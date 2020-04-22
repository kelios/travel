<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = [
        'name',
        'budget',
        'year',
        'number_peoples',
        'number_days',
        'minus',
        'plus',
        'recommendation',
        'description',
        'publish',
        'visa',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/travels/'.$this->getKey());
    }
}
