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
use App\Repositories\TravelAddressRepository;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CompanionRepository;
use App\Repositories\TravelViewRepository;
use App\Repositories\CategoryTravelAddressRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Travel\IndexTravel;
use App\Http\Requests\Travel\StoreTravel;
use App\Http\Requests\Travel\UpdateTravel;
use App\Http\Requests\Travel\MeTravel;
use App\Events\SearchEvent;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\TravelSave;

class TravelsController extends Controller
{
    /**
     * @var TravelRepository
     */
    private $travelRepository;

    /**
     * @var TravelRepository
     */
    public $travelAddressRepository;

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

    private $categoryTravelAddressRepository;

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
                                CompanionRepository $companionRepository,
                                TravelViewRepository $travelViewRepository,
                                TravelAddressRepository $travelAddressRepository,
                                CategoryTravelAddressRepository $categoryTravelAddressRepository
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
        $this->travelViewRepository = $travelViewRepository;
        $this->travelAddressRepository = $travelAddressRepository;
        $this->categoryTravelAddressRepository = $categoryTravelAddressRepository;

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
        $whereSearch = $request->all();
        $where = array_merge($whereSearch, ['publish' => 1, 'moderation' => 1]);
        $filter_hide = ['countries' => true];
        return view('travels.index', [
                'where' => $where,
                'isBy' => false,
                'isFavorite' => false,
                'filter_hide' => $filter_hide,
            ]
        );
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
        $where = ['publish' => 1, 'countries' => [3], 'moderation' => 1];
        $filter_hide = ['countries' => false];
        return view('travels.index', [
            'where' => $where,
            'isBy' => true,
            'isFavorite' => false,
            'filter_hide' => $filter_hide
        ]);
    }

    public function get(IndexTravel $request)
    {
        $where = [];
        if ($request->query('where')) {
            $where = json_decode($request->query('where'), true);
        }
        $query = '';
        if ($request->query('query')) {
            $query = $request->query('query');
        }
        $perPage = Config::get('constants.showListTravel.count');
        if ($request->query('perPage')) {
            $perPage = json_decode($request->query('perPage'), true);
        }
        if (Arr::get($where, 'belTravels')) {
            unset($where['belTravels']);
            $travels = $this->travelRepository->getListBy($perPage, $where, $query);

        } else {
            $travels = $this->travelRepository->getList($perPage, $where, $query);
        }
        $travels->getCollection()->transform(function ($value) {
            return $value->only([
                'name',
                'url',
                'publish',
                'moderation',
                'countryName',
                'cityName',
                'travel_image_thumb_url',
                'travel_image_thumb_small_url',
                'travelAddressAdress',
                'coordsMeTravelArr',
                'slug',
                'id',
                'userName',
                'countUnicIpView',
                'youtube_link'
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
                'moderation',
                'countryName',
                'travel_image_thumb_url',
                'travel_image_thumb_small_url',
                'slug',
                'id'
            ]);
        });
        return response()->json($travels);
    }

    public function getTravelsPopular(Request $request)
    {
        $travels = $this->travelRepository->getPopular();
        $travels->transform(function ($value) {
            return $value->only([
                'name',
                'url',
                'publish',
                'moderation',
                'countryName',
                'travel_image_thumb_url',
                'travel_image_thumb_small_url',
                'slug',
                'id'
            ]);
        });
        return response()->json($travels);
    }

    public function getTravelsNear(Request $request)
    {
        $travel = $this->travelRepository->getById($request->travel_id);
        $coord = $travel->travelAddress->pluck('coords')->toArray();
        if (array_get($coord, 0)) {
            $travelsIds = $this->travelAddressRepository->getNear('60', array_get($coord, 0));
            unset($travelsIds[array_search($request->travel_id, $travelsIds)]);
            $travels = $this->travelRepository->getById($travelsIds);

            $travels->transform(function ($value) {
                return $value->only([
                    'name',
                    'url',
                    'publish',
                    'moderation',
                    'countryName',
                    'travel_image_thumb_url',
                    'travel_image_thumb_small_url',
                    'slug',
                    'id'
                ]);
            });
            return response()->json($travels);
        } else {
            return response()->json();
        }
    }

    public function search(IndexTravel $request)
    {
        $query = $request->query('query');
        $where = [];
        if ($request->query('where')) {
            $where = json_decode($request->query('where'), true);
        }
        $perPage = Config::get('constants.showListTravel.count');
        if ($request->query('perPage')) {
            $perPage = json_decode($request->query('perPage'), true);
        }
        $travels = $this->travelRepository->search($perPage, $query, $where);
        $travels->transform(function ($value) {
            return $value->only([
                'name',
                'url',
                'publish',
                'moderation',
                'countryName',
                'travel_image_thumb_url',
                'travel_image_thumb_small_url',
                'slug',
                'id'
            ]);
        });
        return response()->json($travels);
        //broadcast search results with Pusher channels
       // event(new SearchEvent($travels, [], $query));
        //return response()->json("ok");
    }

    /**
     * @param IndexTravel $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchExtended(IndexTravel $request)
    {
        $query = $request->query('query');
        $where = [];
        if ($request->query('where')) {
            $where = json_decode($request->query('where'), true);
        }
        $perPage = Config::get('constants.showListTravel.count');
        if ($request->query('perPage')) {
            $perPage = json_decode($request->query('perPage'), true);
        }

        $travels = $this->travelRepository->searchExtended($perPage, $query, $where);
        $travels->appends($where)->links();

        //broadcast search results with Pusher channels (was removed)
       // event(new SearchEvent($travels, $where));
      //  return response()->json("ok");
        $travels->transform(function ($value) {
            return $value->only([
                'name',
                'url',
                'publish',
                'moderation',
                'countryName',
                'travel_image_thumb_url',
                'travel_image_thumb_small_url',
                'slug',
                'id'
            ]);
        });
        return response()->json($travels);
    }

    public function metravel(MeTravel $request)
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $where = ['user_id' => Auth::user()->id];
        $filter_hide = ['countries' => false];
        return view('travels.metravel', [
            'where' => $where,
            'filter_hide' => $filter_hide
        ]);
    }

    /**
     * @param MeTravel $request
     * @return Factory|View
     */
    public function favoriteTravel(MeTravel $request)
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $where = ['id' => Auth::user()->travelsFavorite()->pluck('travels.id')->toArray(),
            'publish' => 1,
            'moderation' => 1,
        ];
        $filter_hide = ['countries' => true];
        return view('travels.index', [
            'where' => $where,

            'filter_hide' => $filter_hide,
            'isBy' => false,
            'isFavorite' => true
        ]);
    }

    public function friendTravel(MeTravel $request)
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $user_ids = Auth::user()->getFriends()->pluck('id')->toArray();
        $where = ['users' => $user_ids, 'publish' => 1, 'moderation' => 1];
        $filter_hide = ['countries' => true];
        return view('travels.index', [
            'where' => $where,
            'filter_hide' => $filter_hide,
            'isBy' => false,
            'isFavorite' => false
        ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(IndexTravel $request)
    {
        return view('travels.create',
            $this->getFiltersTravel($request)
        );
    }


    /**
     * @param Travel $travel
     * @return Factory|View
     */
    public function edit($slug)
    {

        $travel = $this->travelRepository->getBySlug($slug);
        if (Auth::id() == $travel->users[0]->id || Auth::id() == 1) {
            $travel->coordsMeTravel = $travel->travelAddress->pluck('coords')->toArray();

            $travel->travelImageThumbUrlArr = $travel->travelAddress->pluck('travelImageThumbUrl')->toArray();
            $travel->thumbs200ForCollectionArr = $travel->travelAddress->pluck('thumbs200Collection')->toArray();
            $travel->categoryTravelAddressArr = $travel->travelAddress->pluck('categories')->toArray();

            SEOMeta::setTitle($travel->name);
            SEOMeta::setDescription($travel->meta_description);
            SEOMeta::addMeta('travel:published_time', $travel->created_at->toW3CString(), 'property');
            SEOMeta::addKeyword($travel->meta_keywords);
            return view('travels.edit', [
                'travel' => $travel,
                'categories' => $this->categoryRepository->get(['id', 'name']),
                'transports' => $this->transportRepository->get(['id', 'name']),
                'month' => $this->monthRepository->get(['id', 'name']),
                'complexity' => $this->complexityRepository->get(['id', 'name']),
                'companion' => $this->companionRepository->get(['id', 'name']),
                'overNightStay' => $this->overNightStayRepository->get(['id', 'name']),
                'categoryTravelAddress' => $this->categoryTravelAddressRepository->get(['id', 'name']),
            ]);
        }else{
            return redirect()->back();
        }
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

        if (auth()->user()) {
            $travel['isFriend'] = auth()->user()->isFriendWith(Arr::get($travel->users, 0)) ||
                auth()->user()->hasSentFriendRequestTo(Arr::get($travel->users, 0));
        }

        $where = ['id' => $travel->id];

        $this->travelViewRepository->map($travel);

        SEOMeta::setTitle($travel->name);
        SEOMeta::setDescription($travel->meta_description);
        SEOMeta::addMeta('travel:published_time', $travel->created_at->toW3CString(), 'property');
        SEOMeta::addKeyword($travel->meta_keywords);

        $travelMenu = [
            'gallery' => (boolean)$travel['gallery'],
            'description' => (boolean)$travel['description'],
            'plus' => (boolean)$travel['plus'],
            'minus' => (boolean)$travel['minus'],
            'recommendation' => (boolean)$travel['recommendation'],
            'travelRoad' => (boolean)$travel['travelRoad'],
            'travelAddressAdress' => (boolean)$travel['travelAddressAdress'],
            'youtube_link' => (boolean)$travel['youtube_link'],
        ];
        $travel = (object)$travel->only(
            'id',
            'totalLikes',
            'userIds',
            'userName',
            'countUnicIpView',
            'url',
            'travel_image_thumb_url',
            'travel_image_thumb_small_url',
            'isFriend',
            'year',
            'monthName',
            'countryName',
            'cityName',
            'number_days',
            'name'
        );

        return view('travels.show', [
            'travel' => $travel,
            'travelMenu' => $travelMenu,
            'where' => $where
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findById(\Illuminate\Http\Request $request)
    {
        $traveldata = $this->travelRepository->getById($request->id);

        $addr = $traveldata->travelAddress->map(function ($addr) {
            return $addr->only('id', 'travelImageThumbUrl', 'address', 'coord', 'categoryName');
        });

        $traveldata->travelAddress = $addr;
        $travel = (object)$traveldata->only(
            'id',
            'totalLikes',
            'userIds',
            'userName',
            'countUnicIpView',
            'url',
            'travel_image_thumb_url',
            'travel_image_thumb_small_url',
            'isFriend',
            'year',
            'monthName',
            'countryName',
            'cityName',
            'number_days',
            'name',
            'gallery',
            'description',
            'categoryName',
            'complexityName',
            'transportName',
            'overNightStayName',
            'budget',
            'number_peoples',
            'plus',
            'minus',
            'recommendation',
            'travelRoadFilename',
            'travelRoadUrl',
            'travelAddress',
            'reply',
            'youtube_link'
        );

//dd( collect($travel->travelAddress->all()));
        //  $travel->travelAddress = Arr::only($travel->travelAddress->all(),['address','coord']);
        //    dd((object)$traveldata->only(['travelAddress']));
        return response()->json($travel);
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


    public function isFavoritedByMe($id)
    {
        $travel = $this->travelRepository->getById($id);
        if (TravelSave::whereUserId(Auth::id())->whereTravelId($travel->id)->exists()) {
            return response(['res' => false]);
        }
        return response(['res' => true]);
    }

    /**
     * @param $travelId
     * @return ResponseFactory|Response
     */
    public function addFavorite($travelId)
    {
        $existing_favorite = TravelSave::withTrashed()->whereTravelId($travelId)->whereUserId(Auth::id())->first();
        if (is_null($existing_favorite)) {
            TravelSave::create([
                'travel_id' => $travelId,
                'user_id' => Auth::id()
            ]);
            return response(['count' => 1]);
        } else {
            if (is_null($existing_favorite->deleted_at)) {
                $existing_favorite->delete();
                return response(['count' => 0]);
            } else {
                $existing_favorite->restore();
                return response(['count' => 1]);
            }
        }
    }


    public function getFiltersTravel(\Illuminate\Http\Request $request)
    {
        $filtersTravel = [
            'categories' => $this->categoryRepository->all(),
            'transports' => $this->transportRepository->all(),
            'month' => $this->monthRepository->all(),
            'complexity' => $this->complexityRepository->all(),
            'overNightStay' => $this->overNightStayRepository->all(),
            'companion' => $this->companionRepository->all(),
            'categoryTravelAddress' => $this->categoryTravelAddressRepository->all(),
        ];
        if ($request->ajax()) {
            return response()->json($filtersTravel);
        } else {
            return $filtersTravel;
        }
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
        $this->saveTravel($sanitized, $relations, $travelAddr, $travel);

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
        $travelId = array_get($sanitized, 'id');
        if ($travelId) {
            $travel = $this->travelRepository->getById($travelId);
        } else {
            $travel = $this->travelRepository;
        }

        // Store the Travel
        $this->saveTravel($sanitized, $relations, $travelAddr, $travel);

        if ($request->ajax()) {
            return ['redirect' => url('/travels/metravel'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('travels');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTravel $request
     * @return array|RedirectResponse|Redirector
     */
    public function save(StoreTravel $request)
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
        if (array_get($sanitized, 'name')) {
            foreach ($relations as $relation => $publickey) {
                $sanitized[$relation . 'Ids'] = $request->getRelationIds($relation, $publickey);
            }

            $travelAddr = $request->getRelationAddress();
            $travelId = array_get($sanitized, 'id');

            if ($travelId) {
                $travel = $this->travelRepository->getById($travelId);
            } else {
                $travel = $this->travelRepository;
            }
            $this->saveTravel($sanitized, $relations, $travelAddr, $travel);
            if (!$travelId) {
                $travelId = $travel->travel->id;
                $travelAddressIds = $travel->travel->travelAddressIds;
            } else {
                $travelAddressIds = $travel->travelAddressIds;
            }
            return response(['id' => $travelId, 'travelAddressIds' => $travelAddressIds], 200);
        } else {
            return response(['res' => 'noname', 'id' => '', 'travelAddressIds' => []], 200);
        }
    }

    /**
     * @param $sanitized
     * @param $relations
     * @param $travel
     */
    public function saveTravel($sanitized, $relations, $travelAddr, $travel)
    {
        // Store the Travel
        $travel->fill($sanitized);
        $travel->save();
        $ids = Arr::pluck($travelAddr, 'id');
        if ($travel->travelAddress()->exists()) {
            foreach ($travel->travelAddress as $oldAddr) {
                if (!in_array($oldAddr->id, $ids)) {
                    $currentTravelAddr = $travel->travelAddress()->findOrFail($oldAddr->id);
                    $currentTravelAddr->delete();
                }
            }
        }

        foreach ($travelAddr as $addr) {
            if (!array_get($addr, 'id')) {
                $travelAddrNew = $travel->travelAddress()->create($addr);
                $travelAddrNew->categories()->sync($addr['categoriesIds']);
                $addr['id'] = $travelAddrNew->id;
                $travelAddrNew->processMedia(collect(['travelImageAddress' => $addr['travelAddrMedia']]));
            } else {
                $currentTravelAddr = $travel->travelAddress()->findOrFail(array_get($addr, 'id'));
                $currentTravelAddr->save();
                $currentTravelAddr->categories()->sync($addr['categoriesIds']);
                $currentTravelAddr->processMedia(collect(['travelImageAddress' => $addr['travelAddrMedia']]));
            }
        }

        $travel->users()->sync(auth()->user()->id);
        foreach ($relations as $relation => $publickey) {
            $relationFormat = str_replace('_', '', $relation);
            $travel->$relationFormat()->sync($sanitized[$relation . 'Ids']);
        }
    }


    public function searchTravelsForMap(Request $request)
    {
        if ($request->query('where')) {
            $where = json_decode($request->query('where'), true);
            $lat = array_get($where, 'lat');
            $lng = array_get($where, 'lng');
            $radius = array_get($where, 'radius.id');
            $address = array_get($where, 'address');
            $categories_ids = Arr::pluck(array_get($where, 'categories', []), 'id');
            // dd($radius);
        }

        if ($lat) {
            $coords = [
                'lat' => $lat,
                'lng' => $lng,
            ];
            $travelsAddress = $this->travelAddressRepository->getNearAddress($radius, $coords, $categories_ids, $address);
            $travelsAddress->transform(function ($value) {
                return $value->only([
                    'lat',
                    'lng',
                    'coord',
                    'address',
                    'urlTravel',
                    'travelImageThumbUrl',
                    'categoryName',
                    'coord'

                ]);
            });
            return response()->json($travelsAddress);
        } else {
            return response()->json();
        }
    }

    public function getFilterForMap(Request $request)
    {
        $filtersForMap = [
            'categories' => $this->categoryTravelAddressRepository->get(['id', 'name']),
            'radius' => Config::get('constants.radius')
        ];
        if ($request->ajax()) {
            return response()->json($filtersForMap);
        } else {
            return $filtersForMap;
        }
    }

}
