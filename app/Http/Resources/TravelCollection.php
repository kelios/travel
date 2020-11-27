<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class TravelCollection
 * @package App\Http\Resources
 */
class TravelCollection extends ResourceCollection
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
        $res = $this->resource->map(function ($item) {
            return [
                'name' => $item->name,
                'url' => $item->url,
                'publish' => $item->publish,
                'moderation' => $item->moderation,
                'countryName' => $item->countryName,
                'slug' => $item->slug,
                'cityName' => $item->cityName,
                'travel_image_thumb_url' => $item->travel_image_thumb_url,
                //'travelAddressAdress' => $item->travelAddressAdress,
               // 'coordsMeTravelArr' => $item->coordsMeTravelArr,
                'id' => $item->id,
                'userName' => $item->userName,

            ];
        })->toArray();
        //dd($res);

        return [
            'data' => $res,
            'current_page' => $this->resource->currentPage(),
            'first_page_url' => $this->resource->url(1),
            'from' => $this->resource->firstItem(),
            'last_page' => $this->resource->lastPage(),
            'last_page_url' => $this->resource->url($this->resource->lastPage()),
            'next_page_url' => $this->resource->nextPageUrl(),
            'path' => $this->resource->path(),
            'per_page' => $this->resource->perPage(),
            'prev_page_url' => $this->resource->previousPageUrl(),
            'to' => $this->resource->lastItem(),
            'total' => $this->resource->total(),
        ];
    }
}

