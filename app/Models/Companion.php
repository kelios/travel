<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    protected $table = 'companion';

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
        return url('/admin/companions/'.$this->getKey());
    }

    public function travels()
    {
        return $this->belongsToMany(Travel::class);
    }
}
