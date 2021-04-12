<?php

namespace App\Repositories;

use App\Models\Month;
use App\Models\Travel;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class MonthRepository
 * @package App\Repositories
 */
class MonthRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var Month
     */
    private $month;

    /**
     * MonthRepository constructor.
     * @param Month $month
     */
    public function __construct(Month $month)
    {
        $this->month = $month;
    }

    /**
     * @return Month[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->month->all();
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->month->get($param);
    }

    /**
     * @param $attr
     * @return Month
     */
    public function fill($attr)
    {
        return $this->month->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->month->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travels()
    {
        return $this->month->travels();
    }

}
