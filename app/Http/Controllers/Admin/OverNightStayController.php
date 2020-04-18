<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OverNightStay\BulkDestroyOverNightStay;
use App\Http\Requests\Admin\OverNightStay\DestroyOverNightStay;
use App\Http\Requests\Admin\OverNightStay\IndexOverNightStay;
use App\Http\Requests\Admin\OverNightStay\StoreOverNightStay;
use App\Http\Requests\Admin\OverNightStay\UpdateOverNightStay;
use App\Models\OverNightStay;
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

class OverNightStayController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexOverNightStay $request
     * @return array|Factory|View
     */
    public function index(IndexOverNightStay $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(OverNightStay::class)->processRequestAndGet(
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

        return view('admin.over-night-stay.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.over-night-stay.create');

        return view('admin.over-night-stay.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOverNightStay $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreOverNightStay $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the OverNightStay
        $overNightStay = OverNightStay::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/over-night-stays'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/over-night-stays');
    }

    /**
     * Display the specified resource.
     *
     * @param OverNightStay $overNightStay
     * @throws AuthorizationException
     * @return void
     */
    public function show(OverNightStay $overNightStay)
    {
        $this->authorize('admin.over-night-stay.show', $overNightStay);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OverNightStay $overNightStay
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(OverNightStay $overNightStay)
    {
        $this->authorize('admin.over-night-stay.edit', $overNightStay);


        return view('admin.over-night-stay.edit', [
            'overNightStay' => $overNightStay,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOverNightStay $request
     * @param OverNightStay $overNightStay
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateOverNightStay $request, OverNightStay $overNightStay)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values OverNightStay
        $overNightStay->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/over-night-stays'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/over-night-stays');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyOverNightStay $request
     * @param OverNightStay $overNightStay
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyOverNightStay $request, OverNightStay $overNightStay)
    {
        $overNightStay->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyOverNightStay $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyOverNightStay $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    OverNightStay::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
