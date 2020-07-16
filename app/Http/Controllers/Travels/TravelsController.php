<?php

namespace App\Http\Controllers\Travels;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\DestroyTravel;
use App\Models\Travel;
use App\Models\TravelLike;
use App\Repositories\CategoryRepository;
use App\Repositories\MonthRepository;
use App\Repositories\OverNightStayRepository;
use App\Repositories\TransportRepository;
use App\Repositories\ComplexityRepository;
use App\Repositories\TravelRepository;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CompanionRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use App\Http\Requests\Travel\IndexTravel;
use App\Http\Requests\Travel\StoreTravel;
use App\Http\Requests\Travel\UpdateTravel;
use App\Http\Requests\Travel\MeTravel;
use App\Events\SearchEvent;
use Artesaos\SEOTools\Facades\SEOMeta;

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
     * @var
     */
    private $companionRepository;

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
                                countryRepository $countryRepository,
                                CompanionRepository $companionRepository
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
        $this->companionRepository = $companionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexTravel $request
     * @return array|Factory|View
     */
    public function index(IndexTravel $request)
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $where = ['publish' => 1];
        return view('travels.index', ['where' => $where]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexTravel $request
     * @return array|Factory|View
     */
    public function indexby(IndexTravel $request)
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $where = ['publish' => 1, 'belTravels' => 'true'];
        return view('travels.index', ['where' => $where]);
    }

    public function get(IndexTravel $request)
    {

        $where = [];
        if ($request->query('where')) {
            $where = json_decode($request->query('where'), true);
        }
        if (Arr::get($where, 'belTravels')) {
            unset($where['belTravels']);
            $travels = $this->travelRepository->getListBy($where);

        } else {
            $travels = $this->travelRepository->getList($where);
        }
        $travels->getCollection()->transform(function ($value) {
            return $value->only([
                'name',
                'url',
                'publish',
                'countryName',
                'cityName',
                'travel_image_thumb_url',
                'travelAddressAdress',
                'coordsMeTravelArr',
                'slug',
                'id',
                'userName',
            ]);
        });
        return response()->json($travels);
    }

    public function getTravelComment(IndexTravel $request)
    {
        $where = [];
        if ($request->query('where')) {
            $where = json_decode($request->query('where'), true);
        }
        $travel = $this->travelRepository->getByWhere($where);
        $travel['comments'] = $travel->getThreadedComments();
        return response()->json($travel['comments']);
    }

    public function getLast(Request $request)
    {
        $travels = $this->travelRepository->getLast();
        $travels->transform(function ($value) {
            return $value->only([
                'name',
                'url',
                'publish',
                'countryName',
                'travel_image_thumb_url',
                'slug',
                'id'
            ]);
        });
        return response()->json($travels);
    }

    public function search(IndexTravel $request)
    {
        $query = $request->query('query');
        $where = [];
        if ($request->query('where')) {
            $where = json_decode($request->query('where'), true);
        }
        $travels = $this->travelRepository->search($query, $where);
        //broadcast search results with Pusher channels
        event(new SearchEvent($travels));
        return response()->json("ok");
    }

    public function metravel(MeTravel $request)
    {
        //dd(Auth::user()->getFriendRequests());
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $where = ['user_id' => Auth::user()->id];
        return view('travels.metravel', ['where' => $where]);
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
            'overNightStay' => $this->overNightStayRepository->all(),
            'companion' => $this->companionRepository->all(),
        ]);
    }


    /**
     * @param Travel $travel
     * @return Factory|View
     */
    public function edit($slug)
    {

        $travel = $this->travelRepository->getBySlug($slug);
        $travel->coordsMeTravel = $travel->travelAddress->pluck('coords')->toArray();

        SEOMeta::setTitle($travel->name);
        SEOMeta::setDescription($travel->meta_description);
        SEOMeta::addMeta('travel:published_time', $travel->created_at->toW3CString(), 'property');
        SEOMeta::addKeyword($travel->meta_keywords);
        return view('travels.edit', [
            'travel' => $travel,
            'categories' => $this->categoryRepository->all(),
            'transports' => $this->transportRepository->all(),
            'month' => $this->monthRepository->all(),
            'complexity' => $this->complexityRepository->all(),
            'companion' => $this->companionRepository->all(),
            'overNightStay' => $this->overNightStayRepository->all(),
        ]);
    }

    /**
     * @param Travel $travel
     * @return Factory|View
     */
    public function show($slug)
    {
        $travel = $this->travelRepository->getBySlug($slug);
        $travel['comments'] = $travel->getThreadedComments();
        $travel['reply'] = '';
        $travel['isFriend'] = true;
        //dd(auth()->user());
        if (auth()->user()) {
            $travel['isFriend'] = auth()->user()->isFriendWith(Arr::get($travel->users, 0)) ||
                auth()->user()->hasSentFriendRequestTo(Arr::get($travel->users, 0));
        }
        $where = ['id' => $travel->id];
        SEOMeta::setTitle($travel->name);
        SEOMeta::setDescription($travel->meta_description);
        SEOMeta::addMeta('travel:published_time', $travel->created_at->toW3CString(), 'property');
        SEOMeta::addKeyword($travel->meta_keywords);
        return view('travels.show', [
            'travel' => $travel,
            'where' => $where
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
            'companion' => 'id',
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
            return ['redirect' => url('/travels/metravel'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }
        return redirect()->back();
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
            'companion' => 'id',
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
            return ['redirect' => url('/travels/metravel'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
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

    public function isLikedByMe($id)
    {
        $travel = $this->travelRepository->getById($id);
        if (TravelLike::whereUserId(Auth::id())->whereTravelId($travel->id)->exists()) {
            return response(['res' => false]);
        }
        return response(['res' => true]);
    }

    /**
     * @param $travelId
     * @return ResponseFactory|Response
     */
    public function like($travelId)
    {
        $existing_like = TravelLike::withTrashed()->whereTravelId($travelId)->whereUserId(Auth::id())->first();
        if (is_null($existing_like)) {
            TravelLike::create([
                'travel_id' => $travelId,
                'user_id' => Auth::id()
            ]);
            return response(['count' => 1]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
                return response(['count' => 0]);
            } else {
                $existing_like->restore();
                return response(['count' => 1]);
            }
        }
    }
}
