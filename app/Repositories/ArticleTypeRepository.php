<?php

namespace App\Repositories;

use App\Models\ArticleType;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class ArticleTypeRepository
 * @package App\Repositories
 */
class ArticleTypeRepository implements TravelRelationRepositoryInterface
{

    private $articleType;

    /**
     * ArticleTypeRepository constructor.
     * @param ArticleType $articleType
     */
    public function __construct(ArticleType $articleType)
    {
        $this->articleType = $articleType;
    }

    /**
     * @return ArticleType[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->articleType->all();
    }

    /**
     * @param $attr
     * @return ArticleType
     */
    public function fill($attr)
    {
        return $this->articleType->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->articleType->save();
    }

    /**
     * @return mixeds
     */
    public function travels()
    {
        return $this->articleType->travels();
    }

}
