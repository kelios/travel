<?php

namespace App\Http\Controllers\Travels;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use App\Repositories\CategoryRepository;
use App\Repositories\MonthRepository;
use App\Repositories\OverNightStayRepository;
use App\Repositories\TransportRepository;
use App\Repositories\ComplexityRepository;
use App\Repositories\TravelRepository;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
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
       /* foreach ($travels as $travel) {
            dd($travel->categories[0]->getCategoryImageThumbUrlAttribute());
        }*/
        //dd(json_encode($travels));
        return view('travels.index')->with('travels', $travels);
    }

    public function indexapi()
    {
        $data = $this->travelRepository->getList();
        return response()->json($data);
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
            'categories',
            'transports',
            'month',
            'complexity',
            'overNightStay',
            'countries',
            'cities'
        ];

        foreach ($relations as $relation) {
            $sanitized[$relation . 'Ids'] = $request->getRelationIds($relation);
        }

        // Store the Travel
        $this->travelRepository->fill($sanitized);
        $this->travelRepository->save();
        $this->travelRepository->users()->sync(auth()->user()->id);
        foreach ($relations as $relation) {
            $this->travelRepository->$relation()->sync($sanitized[$relation . 'Ids']);
        }

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
     //   dd($travel);
        return view('travels.edit', [
            'travel' => $travel,
            'categories' => $this->categoryRepository->all(),
            'transports' => $this->transportRepository->all(),
            'month' => $this->monthRepository->all(),
            'complexity' => $this->complexityRepository->all(),
            'overNightStay' => $this->overNightStayRepository->all()
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
