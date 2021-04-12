<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTravelAddress extends Model
{
    protected $table = 'category_travel_address';

    protected $fillable = [
        'name',
        'status',
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/category-travel-addresses/'.$this->getKey());
    }

    public function travelsAddress()
    {
        return $this->belongsToMany(Travel::class);
    }
}
