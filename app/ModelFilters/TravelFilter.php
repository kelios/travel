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

    /**
     * @param $id
     * @return TravelFilter
     */
    public function id($id)
    {
        return $this->where('id', $id);
    }

    /**
     * @param $status
     * @return TravelFilter
     */
    public function publish($status)
    {
        return $this->where('publish', $status);
    }


    public function year($year)
    {
        return $this->where('year', $year);
    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function countries($ids)
    {
        if ($ids) {
            return $this->whereHas('countries', function ($query) use ($ids) {
                return $query->whereIn('countries.country_id', $ids);
            });
        }

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function users($ids = [])
    {
        return $this->whereHas('users', function ($query) use ($ids) {
            return $query->whereIn('users.id', $ids);
        });

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builders
     */
    public function cities($ids)
    {
        if ($ids) {
            return $this->whereHas('cities', function ($query) use ($ids) {
                return $query->whereIn('cities.city_id', $ids);
            });
        }

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function categories($ids)
    {
        if ($ids) {
            return $this->whereHas('categories', function ($query) use ($ids) {
                return $query->whereIn('categories.id', $ids);
            });
        }

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function transports($ids)
    {
        if ($ids) {
            return $this->whereHas('transports', function ($query) use ($ids) {
                return $query->whereIn('transport.id', $ids);
            });
        }

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function month($ids)
    {
        if ($ids) {
            return $this->whereHas('month', function ($query) use ($ids) {
                return $query->whereIn('month.id', $ids);
            });
        }
    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function complexity($ids)
    {
        if ($ids) {
            return $this->whereHas('complexity', function ($query) use ($ids) {
                return $query->whereIn('complexity.id', $ids);
            });
        }

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function companion($ids)
    {
        if ($ids) {
            return $this->whereHas('companion', function ($query) use ($ids) {
                return $query->whereIn('companion.id', $ids);
            });
        }

    }

    /**
     * @param $ids
     * @return TravelFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function overNightStay($ids)
    {
        if ($ids) {
            return $this->whereHas('overNightStay', function ($query) use ($ids) {
                return $query->whereIn('over_night_stay.id', $ids);
            });
        }

    }

}
