<?php

namespace App\Http\Controllers;

//use App\Models\MeWorld;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Khsing\World\Models\Country;

//use Khsing\World\Models\City;


class LocationController extends BaseController
{
    protected $countryRep;
    protected $cityRep;

    public function __construct(CountryRepository $countryRep, CityRepository $cityRep)
    {
        $this->countryRep = $countryRep;
        $this->cityRep = $cityRep;

    }

    public function getCountries(Request $request)
    {
        $countries = $this->countryRep->all();
        return response()->json($countries, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCitiesByCountries(Request $request)
    {
        $countryCities = $this->cityRep->getCityByCountry($request->country_id)->
        map->only(['local_name', 'country_id', 'city_id', 'title_en', 'country_title_en']);
        return response()->json($countryCities, 200);
    }

}
