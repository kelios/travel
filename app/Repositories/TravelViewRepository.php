<?php

namespace App\Repositories;

use App\Models\TravelView;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;
use App\User;
use App\Repositories\Interfaces\TravelRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

/**
 * Class TravelRepository
 * @package App\Repositories
 */
class TravelViewRepository implements TravelRelationRepositoryInterface
{
    private $travelView;

    /**
     * TravelViewRepository constructor.
     * @param TravelView $travelView
     */
    public function __construct(TravelView $travelView)
    {
        $this->travelView = $travelView;
    }

    /**
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->travelView->all();
    }

    /**
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getList()
    {
        return $this->travelView
            ->paginate(Config::get('constants.showListArticle.count'));
    }

    /**
     * @param $attr
     * @return Article
     */
    public function fill($attr)
    {
        return $this->travelView->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->travelView->save();
    }

    public function map($travel){
        $this->travelView->travel_id = $travel->id;
        $this->travelView->titleslug = $travel->slug;
        $this->travelView->url = \Request::url();
        $this->travelView->session_id = \Request::getSession()->getId();
        $this->travelView->user_id = (\Auth::check()) ? \Auth::id() : null; //this check will either put the user id or null, no need to use \Auth()->user()->id as we have an inbuild function to get auth id
        $this->travelView->ip = \Request::getClientIp();
        $this->travelView->agent = \Request::header('User-Agent');
        return $this->save();
    }

    /**
     * @return mixeds
     */
    public function travels()
    {
        return $this->article->travels();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getById($id)
    {
        return $this->article->with([
            'articleType'
        ])->find($id);
    }
}
