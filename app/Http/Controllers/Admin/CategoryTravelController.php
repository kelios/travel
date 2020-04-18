<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryTravel\BulkDestroyCategoryTravel;
use App\Http\Requests\Admin\CategoryTravel\DestroyCategoryTravel;
use App\Http\Requests\Admin\CategoryTravel\IndexCategoryTravel;
use App\Http\Requests\Admin\CategoryTravel\StoreCategoryTravel;
use App\Http\Requests\Admin\CategoryTravel\UpdateCategoryTravel;
use App\Models\CategoryTravel;
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

class CategoryTravelController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategoryTravel $request
     * @return array|Factory|View
     */
    public function index(IndexCategoryTravel $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CategoryTravel::class)->processRequestAndGet(
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

        return view('admin.category-travel.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.category-travel.create');

        return view('admin.category-travel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryTravel $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCategoryTravel $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the CategoryTravel
        $categoryTravel = CategoryTravel::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/category-travels'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/category-travels');
    }

    /**
     * Display the specified resource.
     *
     * @param CategoryTravel $categoryTravel
     * @throws AuthorizationException
     * @return void
     */
    public function show(CategoryTravel $categoryTravel)
    {
        $this->authorize('admin.category-travel.show', $categoryTravel);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CategoryTravel $categoryTravel
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(CategoryTravel $categoryTravel)
    {
        $this->authorize('admin.category-travel.edit', $categoryTravel);


        return view('admin.category-travel.edit', [
            'categoryTravel' => $categoryTravel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryTravel $request
     * @param CategoryTravel $categoryTravel
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCategoryTravel $request, CategoryTravel $categoryTravel)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values CategoryTravel
        $categoryTravel->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/category-travels'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/category-travels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCategoryTravel $request
     * @param CategoryTravel $categoryTravel
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCategoryTravel $request, CategoryTravel $categoryTravel)
    {
        $categoryTravel->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCategoryTravel $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCategoryTravel $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    CategoryTravel::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
