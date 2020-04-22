<?php

namespace App\Repositories;

use App\Models\Travel;
use App\User;
use App\Repositories\Interfaces\TravelRepositoryInterface;

/**
 * Class TravelRepository
 * @package App\Repositories
 */
class TravelRepository implements TravelRepositoryInterface
{
    /**
     * @var Travel
     */
    private $travel;

    /**
     * TravelRepository constructor.
     * @param Travel $travel
     */
    public function __construct(Travel $travel)
    {
        $this->travel = $travel;
    }

    /**
     * @return Travel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->travel->all();
    }

    /**
     * @param $attr
     * @return Travel
     *
     */
    public function fill($attr)
    {
        return $this->travel->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->travel->save();
    }

    public function users()
    {
        return $this->travel->users();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->travel->categories();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getByUser(User $user)
    {
        return $this->travel->where('user_id' . $user->id)->get();
    }
}
