<?php

namespace App\Repositories;

use App\Models\CategoryTravelAddress;
use App\Models\TravelAddress;

/**
 * Class MonthRepository
 * @package App\Repositories
 */
class CategoryTravelAddressRepository
{
    /**
     * @var
     */
    private $categoryTravelAddress;

    /**
     * CategoryTravelAddressRepository constructor.
     * @param CategoryTravelAddress $categoryTravelAddress
     */
    public function __construct(CategoryTravelAddress $categoryTravelAddress)
    {
        $this->categoryTravelAddress = $categoryTravelAddress;
    }

    /**
     * @return Month[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->categoryTravelAddress->all();
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->categoryTravelAddress->get($param);
    }

    /**
     * @param $attr
     * @return Month
     */
    public function fill($attr)
    {
        return $this->categoryTravelAddress->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->categoryTravelAddress->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travelsAddress()
    {
        return $this->categoryTravelAddress->travelsAddress();
    }

}
