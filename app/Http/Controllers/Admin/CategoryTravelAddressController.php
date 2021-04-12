<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryTravelAddress\BulkDestroyCategoryTravelAddress;
use App\Http\Requests\Admin\CategoryTravelAddress\DestroyCategoryTravelAddress;
use App\Http\Requests\Admin\CategoryTravelAddress\IndexCategoryTravelAddress;
use App\Http\Requests\Admin\CategoryTravelAddress\StoreCategoryTravelAddress;
use App\Http\Requests\Admin\CategoryTravelAddress\UpdateCategoryTravelAddress;
use App\Models\CategoryTravelAddress;
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

class CategoryTravelAddressController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategoryTravelAddress $request
     * @return array|Factory|View
     */
    public function index(IndexCategoryTravelAddress $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CategoryTravelAddress::class)->processRequestAndGet(
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

        return view('admin.category-travel-address.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.category-travel-address.create');

        return view('admin.category-travel-address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryTravelAddress $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCategoryTravelAddress $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the CategoryTravelAddress
        $categoryTravelAddress = CategoryTravelAddress::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/category-travel-addresses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/category-travel-addresses');
    }

    /**
     * Display the specified resource.
     *
     * @param CategoryTravelAddress $categoryTravelAddress
     * @throws AuthorizationException
     * @return void
     */
    public function show(CategoryTravelAddress $categoryTravelAddress)
    {
        $this->authorize('admin.category-travel-address.show', $categoryTravelAddress);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CategoryTravelAddress $categoryTravelAddress
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(CategoryTravelAddress $categoryTravelAddress)
    {
        $this->authorize('admin.category-travel-address.edit', $categoryTravelAddress);


        return view('admin.category-travel-address.edit', [
            'categoryTravelAddress' => $categoryTravelAddress,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryTravelAddress $request
     * @param CategoryTravelAddress $categoryTravelAddress
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCategoryTravelAddress $request, CategoryTravelAddress $categoryTravelAddress)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values CategoryTravelAddress
        $categoryTravelAddress->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/category-travel-addresses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/category-travel-addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCategoryTravelAddress $request
     * @param CategoryTravelAddress $categoryTravelAddress
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCategoryTravelAddress $request, CategoryTravelAddress $categoryTravelAddress)
    {
        $categoryTravelAddress->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCategoryTravelAddress $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCategoryTravelAddress $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    CategoryTravelAddress::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
