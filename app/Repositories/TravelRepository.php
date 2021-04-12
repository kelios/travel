<?php

namespace App\Repositories;

use App\Models\Travel;
use App\User;
use App\Repositories\Interfaces\TravelRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

/**
 * Class TravelRepository
 * @package App\Repositories
 */
class TravelRepository implements TravelRepositoryInterface
{
    /**
     * @var Travel
     */
    public $travel;

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
     * @param array $where
     * @return mixed
     */
    public function getList($perPage, $where = [], $search = '')
    {
        $travels = $this->travel;
        if (Arr::get($where, 'user_id')) {
            $for_user = Arr::get($where, 'user_id');
            unset($where['user_id']);
            $travels = $travels->whereHas('users', function ($query) use ($for_user) {
                $query->whereIn('users.id', [$for_user]);
            });
        }
        if (is_array(Arr::get($where, 'id'))) {
            $travels = $travels->whereIn('id', Arr::get($where, 'id'));
            unset($where['id']);
        }
        if ($search) {
            $travels = $travels->where(function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('recommendation', 'like', '%' . $search . '%')
                    ->orWhere('plus', 'like', '%' . $search . '%')
                    ->orWhere('minus', 'like', '%' . $search . '%');
            });
        }

        return $travels
            ->filter($where)
            // ->where($where)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getListBy($perPage, $where = [], $search = '')
    {
        $travels = $this->travel;
        if (Arr::get($where, 'user_id')) {
            $for_user = Arr::get($where, 'user_id');
            unset($where['user_id']);
            $travels = $travels->whereHas('users', function ($query) use ($for_user) {
                $query->whereIn('users.id', [$for_user]);
            });
        }
        if ($search) {
            $travels = $travels->where(function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('recommendation', 'like', '%' . $search . '%')
                    ->orWhere('plus', 'like', '%' . $search . '%')
                    ->orWhere('minus', 'like', '%' . $search . '%');
            });
        }
        return $travels
            ->has('countries', '=', '1')
            ->filter($where)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getLast($where = [])
    {
        return $this->travel->where('publish', 1)->where('moderation', 1)->orderBy('id', 'desc')->take(3)->get();
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getPopular($where = [])
    {
        return $this->travel
            ->where('publish', 1)
            ->where('moderation', 1)
            ->get()->sortByDesc('countUnicIpView')
            ->take(6);
    }

    /**
     * @param $search
     * @param array $where
     * @return mixed
     */
    public function search($perPage, $search, $where = [])
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
            $searchTravel = $searchTravel->filter($where);
        }

        return $searchTravel->where(function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('recommendation', 'like', '%' . $search . '%')
                ->orWhere('plus', 'like', '%' . $search . '%')
                ->orWhere('minus', 'like', '%' . $search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * @param $search
     * @param array $where
     * @return mixed
     */
    public function searchExtended($perPage, $search, $where = [])
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
            $searchTravel = $searchTravel->filter($where);
        }
        return $searchTravel->orderBy('created_at', 'desc')
            ->paginate($perPage);
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

    /**
     * @param array $columns
     * @return mixed
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cities()
    {
        return $this->travel->cities();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function views()
    {
        return $this->travel->views();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function countries()
    {
        return $this->travel->countries();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function travelAddress()
    {
        return $this->travel->travelAddress();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getById($id)
    {
        return $this->travel->find($id);
        /*   ->load([
           'categories',
           'transports',
           'month',
           'complexity',
           'overNightStay',
           'cities',
           'countries',
           'travelAddress',
           'companion',
           'users',
           'travelLike',
           'views'
       ])*/
        //   ->find($id);
    }

    /**
     * @param $where
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getByWhere($where)
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
            'users',
            'views'
        ])->where($where)
            ->firstOrFail();
    }

    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getBySlug($slug)
    {
        return $this->travel
            ->with([
                'categories',
                'transports',
                'month',
                'complexity',
                'overNightStay',
                'cities',
                'countries',
                'travelAddress',
                'travelAddress.categories',
                'companion',
                'users',
                'travelLike',
                'views'
            ])
            ->where('slug', '=', $slug)
            ->firstOrFail();
        /*->with([
        'categories',
        'transports',
        'month',
        'complexity',
        'overNightStay',
        'cities',
        'countries',
        'travelAddress',
        'companion',
        'users',
        'travelLike',
        'views'
    ])*/

    }

}
