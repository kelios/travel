<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\BulkDestroyArticle;
use App\Http\Requests\Admin\Article\DestroyArticle;
use App\Http\Requests\Admin\Article\IndexArticle;
use App\Http\Requests\Admin\Article\StoreArticle;
use App\Http\Requests\Admin\Article\UpdateArticle;
use App\Models\Article;
use App\Repositories\ArticleTypeRepository;
use App\Repositories\ArticleRepository;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use stdClass;

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
     * Display a listing of the resource.
     *
     * @param IndexArticle $request
     * @return array|Factory|View
     */
    public function index(IndexArticle $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Article::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'article_type_id', 'publish'],

            // set columns to searchIn
            ['id', 'name', 'description']
        );
        $data->load('articleType');

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.article.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.article.create');

        return view('admin.article.create', ['articleType' => $this->articleTypeRepository->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticle $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreArticle $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Article
        $article = Article::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/articles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return void
     * @throws AuthorizationException
     */
    public function show(Article $article)
    {

        $this->authorize('admin.article.show', $article);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(Article $article)
    {
        $this->authorize('admin.article.edit', $article);
        $article = $article->with('articleType')->first();
         $articleType = $this->articleTypeRepository->all();

        return view('admin.article.edit', [
            'article' => $article,
            'articleType' => $articleType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticle $request
     * @param Article $article
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateArticle $request, Article $article)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Article
        $article->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/articles'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyArticle $request
     * @param Article $article
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyArticle $request, Article $article)
    {
        $article->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyArticle $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(BulkDestroyArticle $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Article::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
