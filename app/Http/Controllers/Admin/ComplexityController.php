<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Complexity\BulkDestroyComplexity;
use App\Http\Requests\Admin\Complexity\DestroyComplexity;
use App\Http\Requests\Admin\Complexity\IndexComplexity;
use App\Http\Requests\Admin\Complexity\StoreComplexity;
use App\Http\Requests\Admin\Complexity\UpdateComplexity;
use App\Models\Complexity;
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

class ComplexityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexComplexity $request
     * @return array|Factory|View
     */
    public function index(IndexComplexity $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Complexity::class)->processRequestAndGet(
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

        return view('admin.complexity.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.complexity.create');

        return view('admin.complexity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreComplexity $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreComplexity $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Complexity
        $complexity = Complexity::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/complexities'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/complexities');
    }

    /**
     * Display the specified resource.
     *
     * @param Complexity $complexity
     * @throws AuthorizationException
     * @return void
     */
    public function show(Complexity $complexity)
    {
        $this->authorize('admin.complexity.show', $complexity);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Complexity $complexity
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Complexity $complexity)
    {
        $this->authorize('admin.complexity.edit', $complexity);


        return view('admin.complexity.edit', [
            'complexity' => $complexity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateComplexity $request
     * @param Complexity $complexity
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateComplexity $request, Complexity $complexity)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Complexity
        $complexity->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/complexities'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/complexities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyComplexity $request
     * @param Complexity $complexity
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyComplexity $request, Complexity $complexity)
    {
        $complexity->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyComplexity $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyComplexity $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Complexity::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
