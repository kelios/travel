<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use Illuminate\Support\Str;

class City extends Model
{
    /**
     * current locale setting
     *
     * @var string
     */
    protected $locale = "en";

    protected $primaryKey = 'city_id';
    public $timestamps = false;

    protected $table = 'cities';

    protected $fillable = [
        'city_id',
        'country_id',
        'important',
        'region_id',
        'title_ru',
        'area_ru',
        'region_ru',
        'title_ua',
        'area_ua',
        'region_ua',
        'title_be',
        'area_be',
        'region_be',
        'title_en',
        'area_en',
        'region_en',
        'title_es',
        'area_es',
        'region_es',
        'title_pt',
        'area_pt',
        'region_pt',
        'title_de',
        'area_de',
        'region_de',
        'title_fr',
        'area_fr',
        'region_fr',
        'title_it',
        'area_it',
        'region_it',
        'title_pl',
        'area_pl',
        'region_pl',
        'title_ja',
        'area_ja',
        'region_ja',
        'title_lt',
        'area_lt',
        'region_lt',
        'title_lv',
        'area_lv',
        'region_lv',
        'title_cz',
        'area_cz',
        'region_cz'

    ];

    protected $appends = ['resource_url', 'local_name', 'country_title_en'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setLocale(config('app.locale'));
    }

    /* ************************ ACCESSOR ************************* */
    public function getResourceUrlAttribute()
    {
        return url('/admin/cities/' . $this->getKey());
    }

    public function getCountryTitleEnAttribute()
    {
        return $this->country->title_en;
    }

    public function getLocalNameAttribute()
    {
        $local_name = 'title_' . $this->locale;
        return $this->$local_name;
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }

    /**
     * setting locale
     *
     * @param string $locale
     * @return void
     */
    public function setLocale($locale)
    {
        $locale = str_replace('_', '-', strtolower($locale));
        if (Str::startsWith($locale, 'en')) {
            $locale = 'en';
        }

        $this->locale = $locale;
        return $this;
    }
}
