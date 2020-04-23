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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travels()
    {
        return $this->city->travels();
    }

}
