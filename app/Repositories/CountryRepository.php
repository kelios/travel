<?php

namespace App\Repositories;

use App\Models\Country;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class CountryRepository
 * @package App\Repositories
 */
class CountryRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var
     */
    private $country;

    /**
     * CountryRepository constructor.
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * @return Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->country->orderBy('title_' . $this->getLocale(), 'asc')->get();
    }

    public function get($param = [])
    {
        return $this->country->get($param);
    }

    /**
     * @return Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allhastravels()
    {
        return $this->country->has('travels')->orderBy('title_' . $this->getLocale(), 'asc')->get();
    }


    /**
     * @param $attr
     * @return Country
     */
    public function fill($attr)
    {
        return $this->country->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->country->save();
    }

    /**
     * @return mixed
     */
    public function travels()
    {
        return $this->country->travels();
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->country->locale;
    }

}
