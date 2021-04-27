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
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->travelAddress->get($param);
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
        $travelAddress = $this->travelAddress->сloseTo($radius, $coord);
        foreach ($travelAddress as $travelAdd) {
            $ids[] = $travelAdd->travel_id;
        }
        return array_unique($ids);
        // return $this->travelAddress->сloseTo($radius, $coord);
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getNearAddress($radius, $coord, $categories_ids=[],$address='')
    {
        return $this->travelAddress->сloseTo($radius, $coord,$categories_ids,$address);
    }

}
