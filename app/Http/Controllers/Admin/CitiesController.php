<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\BulkDestroyCity;
use App\Http\Requests\Admin\City\DestroyCity;
use App\Http\Requests\Admin\City\IndexCity;
use App\Http\Requests\Admin\City\StoreCity;
use App\Http\Requests\Admin\City\UpdateCity;
use App\Models\CityWorlt;
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

class CitiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCity $request
     * @return array|Factory|View
     */
    public function index(IndexCity $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CityWorlt::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'state_id', 'country_id'],

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

        return view('admin.city.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.city.create');

        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCity $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCity $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the City
        $city = CityWorlt::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/cities'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/cities');
    }

    /**
     * Display the specified resource.
     *
     * @param CityWorlt $city
     * @return void
     *@throws AuthorizationException
     */
    public function show(CityWorlt $city)
    {
        $this->authorize('admin.city.show', $city);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CityWorlt $city
     * @return Factory|View
     *@throws AuthorizationException
     */
    public function edit(CityWorlt $city)
    {
        $this->authorize('admin.city.edit', $city);


        return view('admin.city.edit', [
            'city' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCity $request
     * @param CityWorlt $city
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCity $request, CityWorlt $city)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values City
        $city->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/cities'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/cities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCity $request
     * @param CityWorlt $city
     * @return ResponseFactory|RedirectResponse|Response
     *@throws Exception
     */
    public function destroy(DestroyCity $request, CityWorlt $city)
    {
        $city->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCity $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCity $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    CityWorlt::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
