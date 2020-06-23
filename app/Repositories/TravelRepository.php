<?php

namespace App\Repositories;

use App\Models\Travel;
use App\User;
use App\Repositories\Interfaces\TravelRepositoryInterface;
use Illuminate\Support\Arr;

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
        $travels = $this->travel;
        if (Arr::get($where, 'user_id')) {
            $for_user = Arr::get($where, 'user_id');
            unset($where['user_id']);
            $travels = $travels->whereHas('users', function ($query) use ($for_user) {
                $query->whereIn('users.id', [$for_user]);
            });
        }
        return $travels
            ->where($where)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    }

    public function getListBy($where = [])
    {
        $travels = $this->travel;
        if (Arr::get($where, 'user_id')) {
            $for_user = Arr::get($where, 'user_id');
            unset($where['user_id']);
            $travels = $travels->whereHas('users', function ($query) use ($for_user) {
                $query->whereIn('users.id', [$for_user]);
            });
        }
        return $travels->whereHas('belTravels')
            ->where($where)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    }

    public function getLast($where = [])
    {
        return $this->travel->where('publish', 1)->orderBy('id', 'desc')->take(3)->get();
    }

    public function search($search, $where = [])
    {
        $searchTravel = $this->travel;
        if (Arr::get($where, 'user_id')) {
            $for_user = Arr::get($where, 'user_id');
            unset($where['user_id']);
            $searchTravel = $searchTravel->whereHas('users', function ($query) use ($for_user) {
                $query->whereIn('users.id', [$for_user]);
            });
        }
        if ($where) {
            $searchTravel = $searchTravel->where($where);
        }

        $searchTravel = $searchTravel->where(function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('recommendation', 'like', '%' . $search . '%')
                ->orWhere('plus', 'like', '%' . $search . '%')
                ->orWhere('minus', 'like', '%' . $search . '%');
        });
        return $searchTravel->paginate(6);
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
        ])
            ->paginate(500);
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

    public function companion()
    {
        return $this->travel->companion();
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
            'travelAddress',
            'companion'
        ])->find($id);
    }

    public function getBySlug($slug)
    {
        return $this->travel->with([
            'categories',
            'transports',
            'month',
            'complexity',
            'overNightStay',
            'cities',
            'countries',
            'travelAddress',
            'companion',
            'users'
        ])
            ->where('slug', '=', $slug)
            ->firstOrFail();
    }

}
