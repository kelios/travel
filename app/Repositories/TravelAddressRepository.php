<?php

namespace App\Repositories;

use App\Models\TravelAddress;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class CountryRepository
 * @package App\Repositories
 */
class TravelAddressRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var TravelAddress
     */
    public $travelAddress;

    /**
     * TravelAddressRepository constructor.
     * @param TravelAddress $travelAddresss
     */
    public function __construct(TravelAddress $travelAddress)
    {
        $this->travelAddress = $travelAddress;
    }

    /**
     * @return Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->travelAddress->orderBy('title_' . $this->getLocale(), 'asc')->get();
    }


    /**
     * @param $attr
     * @return Country
     */
    public function fill($attr)
    {
        return $this->travelAddress->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->travelAddress->save();
    }

    /**
     * @return mixed
     */
    public function travels()
    {
        return $this->travelAddress->travels();
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getNear($radius, $coord)
    {
        return $this->travelAddress->сloseTo($radius, $coord);
    }

}
