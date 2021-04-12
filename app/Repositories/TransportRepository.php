<?php

namespace App\Repositories;

use App\Models\Transport;
use App\Models\Travel;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class TransportRepository
 * @package App\Repositories
 */
class TransportRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var Transport
     */
    private $transport;

    /**
     * TransportRepository constructor.
     * @param Transport $transport
     */
    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @return Transport[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->transport->all();
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->transport->get($param);
    }

    /**
     * @param $attr
     * @return Transport\
     */
    public function fill($attr)
    {
        return $this->transport->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->transport->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travels()
    {
        return $this->transport->travels();
    }

}
