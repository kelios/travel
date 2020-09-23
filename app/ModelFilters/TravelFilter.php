<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TravelFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function id($id)
    {
        return $this->where('id',$id);
    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function countries($ids)
    {
        return $this->whereHas('countries', function ($query) use ($ids) {
            return $query->whereIn('countries.country_id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function users($ids=[])
    {

        return $this->whereHas('users', function ($query) use ($ids) {
            return $query->whereIn('users.user_id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builders
     */
    public function cities($ids)
    {
        return $this->whereHas('cities', function ($query) use ($ids) {
            return $query->whereIn('cities.city_id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function categories($ids)
    {
        return $this->whereHas('categories', function ($query) use ($ids) {
            return $query->whereIn('categories.category_id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function transports($ids)
    {
        return $this->whereHas('transports', function ($query) use ($ids) {
            return $query->whereIn('transports.transport_id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function month($ids)
    {
        return $this->whereHas('month', function ($query) use ($ids) {
            return $query->whereIn('month.month_id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function complexity($ids)
    {
        return $this->whereHas('complexity', function ($query) use ($ids) {
            return $query->whereIn('complexity.complexity_id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function companion($ids)
    {
        return $this->whereHas('companion', function ($query) use ($ids) {
            return $query->whereIn('companion.companion_id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function overNightStay($ids)
    {
        return $this->whereHas('overNightStay', function ($query) use ($ids) {
            return $query->whereIn('overNightStay.over_night_stay_id', $ids);
        });

    }

}
