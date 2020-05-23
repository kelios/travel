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
                'travel_image_thumb_url' => $item->travel_image_thumb_url,
                'cityName' => $item->cityName,
                'countryName' => $item->countryName,
                'categories' => new Category($item->categories),
            ];
        })->toArray();

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

