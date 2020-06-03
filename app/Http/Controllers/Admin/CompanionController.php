<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Companion\BulkDestroyCompanion;
use App\Http\Requests\Admin\Companion\DestroyCompanion;
use App\Http\Requests\Admin\Companion\IndexCompanion;
use App\Http\Requests\Admin\Companion\StoreCompanion;
use App\Http\Requests\Admin\Companion\UpdateCompanion;
use App\Models\Companion;
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

class CompanionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCompanion $request
     * @return array|Factory|View
     */
    public function index(IndexCompanion $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Companion::class)->processRequestAndGet(
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

        return view('admin.companion.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.companion.create');

        return view('admin.companion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanion $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCompanion $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Companion
        $companion = Companion::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/companions'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/companions');
    }

    /**
     * Display the specified resource.
     *
     * @param Companion $companion
     * @throws AuthorizationException
     * @return void
     */
    public function show(Companion $companion)
    {
        $this->authorize('admin.companion.show', $companion);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Companion $companion
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Companion $companion)
    {
        $this->authorize('admin.companion.edit', $companion);


        return view('admin.companion.edit', [
            'companion' => $companion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanion $request
     * @param Companion $companion
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCompanion $request, Companion $companion)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Companion
        $companion->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/companions'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/companions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCompanion $request
     * @param Companion $companion
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCompanion $request, Companion $companion)
    {
        $companion->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCompanion $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCompanion $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Companion::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
