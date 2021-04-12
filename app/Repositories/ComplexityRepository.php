<?php

namespace App\Repositories;

use App\Models\Complexity;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class ComplexityRepository
 * @package App\Repositories
 */
class ComplexityRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var Complexity
     */
    private $complexity;

    /**
     * ComplexityRepository constructor.
     * @param Complexity $complexity
     */
    public function __construct(Complexity $complexity)
    {
        $this->complexity = $complexity;
    }

    /**
     * @return Complexity[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->complexity->all();
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->complexity->get($param);
    }

    /**
     * @param $attr
     * @return Complexity
     */
    public function fill($attr)
    {
        return $this->complexity->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->complexity->save();
    }

    /**
     * @return mixeds
     */
    public function travels()
    {
        return $this->complexity->travels();
    }

}
