<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class CityRepository
 * @package App\Repositories
 */
class CityRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var City
     */
    private $city;

    /**
     * CityRepository constructor.
     * @param City $city
     */
    public function __construct(City $city)
    {
        $this->city = $city;
    }

    /**
     * @return City[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->city->all();
    }

    /**
     * @param $whereIn
     * @return mixed
     */
    public function getCityByCountry($whereIn = [])
    {
        return $this->city->whereIn('country_id', $whereIn)->where('important', 1)->with('country')->get();

    }

    /**
     * @param $attr
     * @return City
     */
    public function fill($attr)
    {
        return $this->city->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->city->save();
    }

    /**
     * @return mixed
     */
    public function travels()
    {
        return $this->city->travels();
    }

    /**
     * @param $search
     * @param $where
     * @return mixed
     */
    public function search($search, $whereIn)
    {
        $searchCities = $this->city;
        if ($whereIn) {
            $searchCities = $searchCities->whereIn('country_id', $whereIn);
        }
        $searchCities = $searchCities->where(function ($query) use ($search) {
            return $query->where('title_' . $this->getLocale(), 'like', $search . '%');
        });
        return $searchCities->with('country')->limit(10)->get();
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->city->locale;
    }

}
