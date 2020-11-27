<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Travel\BulkDestroyTravel;
use App\Http\Requests\Admin\Travel\DestroyTravel;
use App\Http\Requests\Admin\Travel\IndexTravel;
use App\Http\Requests\Admin\Travel\StoreTravel;
use App\Http\Requests\Admin\Travel\UpdateTravel;
use App\Models\Travel;
use App\Repositories\TravelRepository;
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

class TravelsController extends Controller
{
    /**
     * @var TravelRepository
     */
    private $travelRepository;

    public function __construct(TravelRepository $travelRepository)
    {
        $this->travelRepository = $travelRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexTravel $request
     * @return array|Factory|View
     */
    public function index(IndexTravel $request)
    {
        if (!$request['orderBy']) {
            $request['orderBy'] = 'id';
            $request['orderDirection'] = 'desc';
        }
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Travel::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'publish', 'moderation','sitemap','slug'],

            // set columns to searchIn
            ['id', 'name', 'minus', 'plus', 'recommendation', 'description']
        );
        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.travel.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.travel.create');

        return view('admin.travel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTravel $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTravel $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Travel
        $travel = Travel::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/travels'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/travels');
    }

    /**
     * Display the specified resource.
     *
     * @param Travel $travel
     * @return void
     * @throws AuthorizationException
     */
    public function show(Travel $travel)
    {
        $this->authorize('admin.travel.show', $travel);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Travel $travel
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit($slug)
    {
        $travel = $this->travelRepository->getBySlug($slug);
        $this->authorize('admin.travel.edit', $travel);
        $travel->coordsMeTravel = $travel->travelAddress->pluck('coords')->toArray();


        return view('admin.travel.edit', [
            'travel' => $travel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTravel $request
     * @param Travel $travel
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTravel $request, Travel $travel)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Travel
        $travel->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/travels'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/travels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTravel $request
     * @param Travel $travel
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyTravel $request, Travel $travel)
    {
        $travel->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTravel $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(BulkDestroyTravel $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Travel::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
