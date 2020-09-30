<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use Illuminate\Support\Str;

class Country extends Model
{

    /**
     * current locale setting
     *
     * @var string
     */
    public $locale = "en";

    protected $table = 'countries';

    protected $primaryKey = 'country_id';
    public $timestamps = false;

    protected $fillable = [
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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setLocale(config('app.locale'));
    }

    protected $appends = ['resource_url', 'local_name'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/countries/' . $this->getKey());
    }

    /**
     * @return mixed
     */
    public function getLocalNameAttribute()
    {
        $local_name = 'title_' . $this->locale;
        return $this->$local_name;
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

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travels()
    {
        return $this->belongsToMany(Travel::class, 'travel_country','country_id', 'travel_id')->withTimestamps();
    }


}
