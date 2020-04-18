<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Month\BulkDestroyMonth;
use App\Http\Requests\Admin\Month\DestroyMonth;
use App\Http\Requests\Admin\Month\IndexMonth;
use App\Http\Requests\Admin\Month\StoreMonth;
use App\Http\Requests\Admin\Month\UpdateMonth;
use App\Models\Month;
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

class MonthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMonth $request
     * @return array|Factory|View
     */
    public function index(IndexMonth $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Month::class)->processRequestAndGet(
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

        return view('admin.month.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.month.create');

        return view('admin.month.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMonth $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMonth $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Month
        $month = Month::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/months'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/months');
    }

    /**
     * Display the specified resource.
     *
     * @param Month $month
     * @throws AuthorizationException
     * @return void
     */
    public function show(Month $month)
    {
        $this->authorize('admin.month.show', $month);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Month $month
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Month $month)
    {
        $this->authorize('admin.month.edit', $month);


        return view('admin.month.edit', [
            'month' => $month,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMonth $request
     * @param Month $month
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMonth $request, Month $month)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Month
        $month->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/months'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/months');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMonth $request
     * @param Month $month
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMonth $request, Month $month)
    {
        $month->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMonth $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMonth $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Month::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
