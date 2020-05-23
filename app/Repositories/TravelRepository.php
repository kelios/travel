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

    public function getList($where = [])
    {
        return $this->travel->with('categories')->paginate();
    }

    public function getLast($where = [])
    {
        return $this->travel->orderBy('id', 'desc')->take(3)->get();
    }

    public function search($query)
    {
        return $this->travel->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orWhere('recommendation', 'like', '%' . $query . '%')
            ->orWhere('plus', 'like', '%' . $query . '%')
            ->orWhere('minus', 'like', '%' . $query . '%')
            ->paginate();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getByUser(User $user)
    {
        return $this->travel->with(["users" => function ($q) use ($user) {
            $q->where('users.id', '=', $user->id);
        },
            'categories',
        ])->paginate(500);
    }

    public function get($columns = [])
    {
        return $this->travel->get($columns);
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function month()
    {
        return $this->travel->month();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function transports()
    {
        return $this->travel->transports();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function complexity()
    {
        return $this->travel->complexity();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function overNightStay()
    {
        return $this->travel->overNightStay();
    }

    public function cities()
    {
        return $this->travel->cities();
    }

    public function countries()
    {
        return $this->travel->countries();
    }

    public function travelAddress()
    {
        return $this->travel->travelAddress();
    }

    public function getById($id)
    {
        return $this->travel->with([
            'categories',
            'transports',
            'month',
            'complexity',
            'overNightStay',
            'cities',
            'countries',
            'travelAddress'
        ])->find($id);
    }

    public function mapAddress(Travel $travel)
    {

    }
}
