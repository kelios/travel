<?php

namespace App\Repositories\Interfaces;

use App\Models\Travel;

/**
 * Interface TravelRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface CategoryRepositoryInterface
{
    public function all();

    public function fill($attr);

    public function save();

    public function travels();

}
