<?php

namespace App\Http\Controllers\Travels;

use App\Http\Controllers\Controller;
use App\Repositories\TravelRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use App\Http\Requests\Travel\IndexTravel;
use App\Http\Requests\Travel\StoreTravel;
use App\Http\Requests\Travel\UpdateTravel;

class TravelsController extends Controller
{
    /**
     * @var TravelRepository
     */
    private $travelRepository;

    /**
     * TravelsController constructor.
     * @param TravelRepository $travelRepository
     */
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
        $travels = $this->travelRepository->all();
        return view('travels.index', ['data' => $travels]);
    }

    public function detail($id)
    {
        $travels = $this->travelRepository->getByUser(Auth::user()->id);
        return view('travels.metravel')->withTravels($travels);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('travels.create');
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

        $this->travelRepository->fill($sanitized);
        $this->travelRepository->save();
        $this->travelRepository->users()->sync(auth()->user()->id);
        if ($request->ajax()) {
            return ['redirect' => url('travels'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('travels');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Travel $travel
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(Travel $travel)
    {
        return view('travels.edit', [
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
        return redirect('travels');
    }

}
