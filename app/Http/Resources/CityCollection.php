<?php

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class TravelCollection
 * @package App\Http\Resources
 */
class CityCollection extends ResourceCollection
{
    protected $pagination;

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $locale = $this->setLocale(config('app.locale'));
        $res = $this->resource->map(function ($item) use ($locale) {
            return [
                'title_'.$locale => 'title_'.$locale,
                'url' => $item->url,
                'travel_image_thumb_url' => $item->travel_image_thumb_url,
                'travel_image_thumb_small_url' => $item->travel_image_thumb_small_url,
                'cityName' => $item->cityName,
                'countryName' => $item->countryName,
                'countries' => new Country($item->country),
            ];
        })->toArray();

    }
}

