<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository implements TravelRelationRepositoryInterface
{

    private $article;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->article->all();
    }

    /**
     * @param $attr
     * @return Article
     */
    public function fill($attr)
    {
        return $this->article->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->article->save();
    }

    /**
     * @return mixeds
     */
    public function travels()
    {
        return $this->article->travels();
    }

}
