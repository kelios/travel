<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleType\BulkDestroyArticleType;
use App\Http\Requests\Admin\ArticleType\DestroyArticleType;
use App\Http\Requests\Admin\ArticleType\IndexArticleType;
use App\Http\Requests\Admin\ArticleType\StoreArticleType;
use App\Http\Requests\Admin\ArticleType\UpdateArticleType;
use App\Models\ArticleType;
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

class ArticleTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexArticleType $request
     * @return array|Factory|View
     */
    public function index(IndexArticleType $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ArticleType::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'status'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.article-type.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.article-type.create');

        return view('admin.article-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleType $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreArticleType $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ArticleType
        $articleType = ArticleType::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/article-types'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/article-types');
    }

    /**
     * Display the specified resource.
     *
     * @param ArticleType $articleType
     * @throws AuthorizationException
     * @return void
     */
    public function show(ArticleType $articleType)
    {
        $this->authorize('admin.article-type.show', $articleType);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ArticleType $articleType
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ArticleType $articleType)
    {
        $this->authorize('admin.article-type.edit', $articleType);


        return view('admin.article-type.edit', [
            'articleType' => $articleType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleType $request
     * @param ArticleType $articleType
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateArticleType $request, ArticleType $articleType)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ArticleType
        $articleType->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/article-types'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/article-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyArticleType $request
     * @param ArticleType $articleType
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyArticleType $request, ArticleType $articleType)
    {
        $articleType->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyArticleType $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyArticleType $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ArticleType::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
