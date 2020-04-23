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
     * @var Country
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
        return $this->country->all();
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travels()
    {
        return $this->country->travels();
    }
}
