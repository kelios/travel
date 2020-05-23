<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $fillable = [
        'region_id',
        'country_id',
        'title_ru',
        'title_ua',
        'title_be',
        'title_en',
        'title_es',
        'title_pt',
        'title_de',
        'title_fr',
        'title_it',
        'title_pl',
        'title_ja',
        'title_lt',
        'title_lv',
        'title_cz'

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/regions/' . $this->getKey());
    }
}
