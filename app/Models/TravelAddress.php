<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class TravelAddress extends Model
{
    protected $table = 'travel_address';

    protected $fillable = [
        'travel_id',
        'country_id',
        'city_id',
        'coord',
        'address'
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['lat', 'lng', 'coords'];

    /* ************************ ACCESSOR ************************* */
    public function getLatAttribute()
    {
        return Arr::get($this->coords,'lat');
    }

    public function getCoordsAttribute()
    {
        if ($this->coord) {
            $coords = explode(',', $this->coord);

            return [
                'lat' => Arr::get($coords,0),
                'lng' => Arr::get($coords,1)
            ];
        } else {
            return [];
        }
    }

    public function getlngAttribute()
    {
        return Arr::get($this->coords,'lng');
    }


    public function travels()
    {
        return $this->belongsTo(Travel::class);
    }
}
