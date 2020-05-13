<?php

namespace App\Models;

use Khsing\World\Models\City;
use Khsing\World\Models\Continent;
use Khsing\World\Models\Country;
use Khsing\World\Models\CountryLocale;
use Khsing\World\Models\Division;

/**
 * Class MeCountry
 * @package App\Models
 */
class MeCountry extends Country
{
    /**
     * @var array
     */
    protected $supported_locales = [
        'en',
        'ru'
    ];

    /**
     * MeCountry constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function divisions()
    {
        return $this->hasMany(Division::class, 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locales()
    {
        return $this->hasMany(CountryLocale::class, 'country_id');
    }

    /**
     * Continent of country
     *
     * @return Continent
     */
    public function continent()
    {
        return $this->belongsTo(Continent::class, 'country_id');
    }

}
