<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;
use Illuminate\Support\Facades\Config;

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
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getList()
    {
        return $this->article
            ->with('articleType')
            ->where('publish', 1)
            ->where('moderation', 1)
            ->paginate(Config::get('constants.showListArticle.count'));
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
