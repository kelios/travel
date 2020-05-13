<?php

namespace App\Repositories;

use App\Models\MeCountry;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class MeCountryRepository
 * @package App\Repositories
 */
class MeCountryRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var Country
     */
    private $country;

    /**
     * CountryRepository constructor.
     * @param Country $country
     */
    public function __construct(MeCountry $country)
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
