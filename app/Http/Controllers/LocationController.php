<?php

namespace App\Http\Controllers;

use App\Events\SearchCityEvent;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function getCountriesForSearch(Request $request)
    {
        $countries = $this->countryRep->allhastravels();
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchCities(Request $request)
    {
        $query = $request->query('query');
        $whereIn = [];
        if ($request->query('countryIds')) {
            $whereIn = $request->query('countryIds');
        }
        $location = $this->cityRep->getLocale();
        $cities = $this->cityRep->search($query, $whereIn)->
        map->only(['local_name',
            'country_id',
            'city_id',
            'title_en',
            'country_title_en',
            'title_' . $location,
            'country_local_name',
            'region_local_name',
            'area_local_name'
        ]);
        return response()->json($cities);
        //broadcast search results with Pusher channels
      //  event(new SearchCityEvent($cities));
       // return response()->json("ok");
    }

}
