<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Transport\BulkDestroyTransport;
use App\Http\Requests\Admin\Transport\DestroyTransport;
use App\Http\Requests\Admin\Transport\IndexTransport;
use App\Http\Requests\Admin\Transport\StoreTransport;
use App\Http\Requests\Admin\Transport\UpdateTransport;
use App\Models\Transport;
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

class TransportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTransport $request
     * @return array|Factory|View
     */
    public function index(IndexTransport $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Transport::class)->processRequestAndGet(
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

        return view('admin.transport.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.transport.create');

        return view('admin.transport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransport $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTransport $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Transport
        $transport = Transport::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/transports'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/transports');
    }

    /**
     * Display the specified resource.
     *
     * @param Transport $transport
     * @throws AuthorizationException
     * @return void
     */
    public function show(Transport $transport)
    {
        $this->authorize('admin.transport.show', $transport);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transport $transport
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Transport $transport)
    {
        $this->authorize('admin.transport.edit', $transport);


        return view('admin.transport.edit', [
            'transport' => $transport,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTransport $request
     * @param Transport $transport
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTransport $request, Transport $transport)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Transport
        $transport->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/transports'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/transports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTransport $request
     * @param Transport $transport
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTransport $request, Transport $transport)
    {
        $transport->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTransport $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTransport $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Transport::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
