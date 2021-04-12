<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Travel;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var
     */
    private $category;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Travel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->category->all();
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->category->get($param);
    }

    /**
     * @param $attr
     * @return Travel
     *
     */
    public function fill($attr)
    {
        return $this->category->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->category->save();
    }

    public function travels()
    {
        return $this->category->travels();
    }

}
