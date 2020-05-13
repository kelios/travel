<?php

namespace App\Models;

use Khsing\World\Models\Country;
use Khsing\World\World;

class MeWorld extends World
{

    public function __construct()
    {
        parent::__construct();
    }

    public static function Countries()
    {
        return MeCountry::get();
    }

    public static function getCountryByCodes($codes)
    {
        foreach ($codes as $code) {
            $countries[] = MeCountry::getByCode($code);
        }
        return $countries;
    }
}
