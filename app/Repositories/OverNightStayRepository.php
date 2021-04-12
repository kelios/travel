<?php

namespace App\Repositories;

use App\Models\OverNightStay;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class OverNightStayRepository
 * @package App\Repositories\
 */
class OverNightStayRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var OverNightStay
     */
    private $overNightStay;

    /**
     * OverNightStayRepository constructor.
     * @param OverNightStay $overNightStay
     */
    public function __construct(OverNightStay $overNightStay)
    {
        $this->overNightStay = $overNightStay;
    }

    /**
     * @return OverNightStay[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->overNightStay->all();
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->overNightStay->get($param);
    }

    /**
     * @param $attr
     * @return OverNightStay
     */
    public function fill($attr)
    {
        return $this->overNightStay->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->overNightStay->save();
    }

    /**
     * @return mixeds
     */
    public function travels()
    {
        return $this->overNightStay->travels();
    }

}
