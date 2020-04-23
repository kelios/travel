<?php

namespace App\Repositories\Interfaces;

interface TravelRelationRepositoryInterface
{
    public function all();

    public function fill($attr);

    public function save();

    public function travels();

}
