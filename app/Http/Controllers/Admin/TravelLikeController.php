<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelLike\BulkDestroyTravelLike;
use App\Http\Requests\Admin\TravelLike\DestroyTravelLike;
use App\Http\Requests\Admin\TravelLike\IndexTravelLike;
use App\Http\Requests\Admin\TravelLike\StoreTravelLike;
use App\Http\Requests\Admin\TravelLike\UpdateTravelLike;
use App\Models\TravelLike;
use Brackets\AdminListing\Facades\AdminListing;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TravelLikeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTravelLike $request
     * @return array|Factory|View
     */
    public function index(IndexTravelLike $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TravelLike::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'travel_id', 'user_id'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.travel-like.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.travel-like.create');

        return view('admin.travel-like.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTravelLike $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTravelLike $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the TravelLike
        $travelLike = TravelLike::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/travel-likes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/travel-likes');
    }

    /**
     * Display the specified resource.
     *
     * @param TravelLike $travelLike
     * @throws AuthorizationException
     * @return void
     */
    public function show(TravelLike $travelLike)
    {
        $this->authorize('admin.travel-like.show', $travelLike);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TravelLike $travelLike
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(TravelLike $travelLike)
    {
        $this->authorize('admin.travel-like.edit', $travelLike);


        return view('admin.travel-like.edit', [
            'travelLike' => $travelLike,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTravelLike $request
     * @param TravelLike $travelLike
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTravelLike $request, TravelLike $travelLike)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values TravelLike
        $travelLike->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/travel-likes'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/travel-likes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTravelLike $request
     * @param TravelLike $travelLike
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTravelLike $request, TravelLike $travelLike)
    {
        $travelLike->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTravelLike $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTravelLike $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    DB::table('travelLikes')->whereIn('id', $bulkChunk)
                        ->update([
                            'deleted_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]);

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
