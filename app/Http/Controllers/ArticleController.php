<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Repositories\ArticleTypeRepository;
use App\Repositories\ArticleRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ArticleController extends Controller
{
    private $articleTypeRepository;
    private $articleRepository;


    public function __construct(ArticleTypeRepository $articleTypeRepository,
                                articleRepository $articleRepository)
    {
        $this->articleTypeRepository = $articleTypeRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index()
    {
        $articles = $this->articleRepository->all();
        $articles->load('articleType');
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * @param Article $article
     * @return Factory|View
     */
    public function show(Article $article)
    {
        return view('article.show', ['article' => $article]);
        // TODO your code goes here
    }


}
