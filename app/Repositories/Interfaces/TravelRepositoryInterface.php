<?php
namespace App\Repositories\Interfaces;
use App\User;

/**
 * Interface TravelRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface TravelRepositoryInterface
{
    public function all();

    public function fill($attr);

    public function save();

    public function users();

    public function getByUser(User $user);
}
