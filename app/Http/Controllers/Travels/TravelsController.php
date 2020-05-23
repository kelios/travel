<?php

namespace App\Http\Controllers\Travels;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\DestroyTravel;
use App\Models\Travel;
use App\Repositories\CategoryRepository;
use App\Repositories\MonthRepository;
use App\Repositories\OverNightStayRepository;
use App\Repositories\TransportRepository;
use App\Repositories\ComplexityRepository;
use App\Repositories\TravelRepository;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use App\Http\Requests\Travel\IndexTravel;
use App\Http\Requests\Travel\StoreTravel;
use App\Http\Requests\Travel\UpdateTravel;
use App\Http\Requests\Travel\MeTravel;
use App\Events\SearchEvent;

class TravelsController extends Controller
{
    /**
     * @var TravelRepository
     */
    private $travelRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var MonthRepository
     */
    private $monthRepository;

    /**
     * @var ComplexityRepository
     */
    private $complexityRepository;

    /**
     * @var TransportRepository
     */
    private $transportRepository;

    /**
     * @var OverNightStayRepository
     */
    private $overNightStayRepository;

    /**
     * @var cityRepository
     */
    private $cityRepository;
    /**
     * @var countryRepository
     */
    private $countryRepository;

    /**
     * TravelsController constructor.
     * @param TravelRepository $travelRepository
     */
    public function __construct(TravelRepository $travelRepository,
                                CategoryRepository $categoryRepository,
                                TransportRepository $transportRepository,
                                MonthRepository $monthRepository,
                                ComplexityRepository $complexityRepository,
                                OverNightStayRepository $overNightStayRepository,
                                cityRepository $cityRepository,
                                countryRepository $countryRepository
    )
    {
        $this->travelRepository = $travelRepository;
        $this->categoryRepository = $categoryRepository;
        $this->transportRepository = $transportRepository;
        $this->monthRepository = $monthRepository;
        $this->complexityRepository = $complexityRepository;
        $this->overNightStayRepository = $overNightStayRepository;
        $this->cityRepository = $cityRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexTravel $request
     * @return array|Factory|View
     */
    public function index(IndexTravel $request)
    {
        $travels = $this->travelRepository->getList();
        if ($request->ajax()) {
            return response()->json($travels);
        }
        return view('travels.index')->with('travels', $travels);
    }

    public function get(Request $request)
    {
        $travels = $this->travelRepository->getList();
        return response()->json($travels);
    }

    public function getLast(Request $request)
    {
        $travels = $this->travelRepository->getLast();
        return response()->json($travels);
    }

    public function search(IndexTravel $request)
    {
        $query = $request->query('query');
        $travels = $this->travelRepository->search($query);
        //broadcast search results with Pusher channels
        event(new SearchEvent($travels));
        return response()->json("ok");
    }

    public function metravel(MeTravel $request)
    {
        $travels = $this->travelRepository->getByUser(Auth::user());
        return view('travels.metravel')->withTravels($travels);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('travels.create', [
            'categories' => $this->categoryRepository->all(),
            'transports' => $this->transportRepository->all(),
            'month' => $this->monthRepository->all(),
            'complexity' => $this->complexityRepository->all(),
            'overNightStay' => $this->overNightStayRepository->all()
        ]);
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
        $relations = [
            'categories' => 'id',
            'transports' => 'id',
            'month' => 'id',
            'complexity' => 'id',
            'over_night_stay' => 'id',
            'countries' => 'country_id',
            'cities' => 'city_id',
        ];
        foreach ($relations as $relation => $publickey) {
            $sanitized[$relation . 'Ids'] = $request->getRelationIds($relation, $publickey);
        }

        $travelAddr = $request->getRelationAddress();
        // Store the Travel
        $this->travelRepository->fill($sanitized);
        $this->travelRepository->save();
        $this->travelRepository->users()->sync(auth()->user()->id);
        foreach ($relations as $relation => $publickey) {
            $relationFormat = str_replace('_', '', $relation);
            $this->travelRepository->$relationFormat()->sync($sanitized[$relation . 'Ids']);
        }
        $this->travelRepository->travelAddress()->delete();
        $this->travelRepository->travelAddress()->createMany($travelAddr);

        if ($request->ajax()) {
            return ['redirect' => url('travels'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('travels');
    }


    /**
     * @param Travel $travel
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $travel = $this->travelRepository->getById($id);
        $travel->coordsMeTravel = $travel->travelAddress->pluck('coords')->toArray();
        $optionsCities = $this->cityRepository->getCityByCountry($travel->countryIds)->
        map->only(['local_name', 'country_id', 'city_id', 'title_en', 'country_title_en']);
        return view('travels.edit', [
            'travel' => $travel,
            'categories' => $this->categoryRepository->all(),
            'transports' => $this->transportRepository->all(),
            'month' => $this->monthRepository->all(),
            'complexity' => $this->complexityRepository->all(),
            'overNightStay' => $this->overNightStayRepository->all(),
            'optionsCities' => $optionsCities,
        ]);
    }

    /**
     * @param Travel $travel
     * @return Factory|View
     */
    public function show(int $id)
    {
        $travel = $this->travelRepository->getById($id);
        $travel->coordsMeTravel = $travel->travelAddress->pluck('coords')->toArray();
        $optionsCities = $this->cityRepository->getCityByCountry($travel->countryIds)->
        map->only(['local_name', 'country_id', 'city_id', 'title_en', 'country_title_en']);
        return view('travels.show', [
            'travel' => $travel,
            'categories' => $this->categoryRepository->all(),
            'transports' => $this->transportRepository->all(),
            'month' => $this->monthRepository->all(),
            'complexity' => $this->complexityRepository->all(),
            'overNightStay' => $this->overNightStayRepository->all(),
            'optionsCities' => $optionsCities,
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
        $relations = [
            'categories' => 'id',
            'transports' => 'id',
            'month' => 'id',
            'complexity' => 'id',
            'over_night_stay' => 'id',
            'countries' => 'country_id',
            'cities' => 'city_id',
        ];
        foreach ($relations as $relation => $publickey) {
            $sanitized[$relation . 'Ids'] = $request->getRelationIds($relation, $publickey);
        }

        $travelAddr = $request->getRelationAddress();

        // Store the Travel
        $travel->fill($sanitized);
        $travel->update($sanitized);
        $travel->users()->sync(auth()->user()->id);
        foreach ($relations as $relation => $publickey) {
            $relationFormat = str_replace('_', '', $relation);
            $travel->$relationFormat()->sync($sanitized[$relation . 'Ids']);
        }
        $travel->travelAddress()->delete();
        $travel->travelAddress()->createMany($travelAddr);

        if ($request->ajax()) {
            return ['redirect' => url('travels'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }
        return redirect('travels');
    }

    /**
     * @param DestroyTravel $request
     * @param Travel $travel
     * @return ResponseFactory|RedirectResponse|Response
     * @throws \Exception
     *
     */
    public function destroy(DestroyTravel $request, Travel $travel)
    {
        $travel->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
