<?php

namespace App\Http\Controllers;

use App\Models\MeWorld;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Khsing\World\Models\City;


class LocationController extends BaseController
{


    public function getCountries(Request $request)
    {
        $countries = MeWorld::Countries();
        return response()->json($countries, 200);
    }

    /**
     * @param $countryId
     * @return JsonResponse
     */
    public function getCitiesByCountries(Request $request)
    {
        $countryCities = City::whereIn('country_id', $request->country_id)->with('country')->get();
        return response()->json($countryCities, 200);
    }

}
