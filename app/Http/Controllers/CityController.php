<?php

namespace App\Http\Controllers;

use Ichtrojan\Location\Http\Controllers\LocationController;
use Ichtrojan\Location\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends LocationController
{

    /**
     * @param $countryId
     * @return JsonResponse
     */
    public function getCitiesByCountries(Request $request)
    {
        $countryCities = City::whereIn('country_id', $request->country_id)->get(['id', 'name']);
        return response()->json($countryCities, 200);
    }

}
