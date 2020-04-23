<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverNightStay extends Model
{
    protected $table = 'over_night_stay';

    protected $fillable = [
        'name',
        'status',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/over-night-stays/'.$this->getKey());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travels()
    {
        return $this->belongsToMany(Travel::class);
    }
}
