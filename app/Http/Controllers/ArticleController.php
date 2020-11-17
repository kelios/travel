<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Repositories\ArticleTypeRepository;
use App\Repositories\ArticleRepository;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Config;
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
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $articles = $this->articleRepository->getList();

        // dd($articles[0]);
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * @param Article $article
     * @return Factory|View
     */
    public function show($id)
    {
        $article = $this->articleRepository->getById($id);
        return view('article.show', ['article' => $article]);
    }


}
