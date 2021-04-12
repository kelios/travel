<?php

namespace App\Repositories;

use App\Models\Companion;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class СompanionRepository
 * @package App\Repositories
 */
class CompanionRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var Companion
     */
    private $companion;

    /**
     * СompanionRepository constructor.
     * @param Companion $companion
     */
    public function __construct(Companion $companion)
    {
        $this->companion = $companion;
    }

    /**
     * @return Companion[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->companion->all();
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->companion->get($param);
    }

    /**
     * @param $attr
     * @return Companion
     */
    public function fill($attr)
    {
        return $this->companion->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->companion->save();
    }

    /**
     * @return mixeds
     */
    public function travels()
    {
        return $this->companion->travels();
    }

}
