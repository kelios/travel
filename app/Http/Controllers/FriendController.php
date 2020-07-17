<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

/**
 * Class FriendController
 * @package App\Http\Controllers
 */
class FriendController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * FriendController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllFriends(Request $request)
    {
        $page = $request->get('page');
        $friends = Auth::user()->getFriends($page);
        return response()->json($friends,200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPendingFriendships(Request $request)
    {
        $friends = Auth::user()->getPendingFriendships()->load('recipient', 'sender');
        return response()->json($friends,200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendReqFriends(Request $request)
    {
        $friend_id = $request->get('friend_id');
        $friend = $this->userRepository->getById($friend_id);
        auth()->user()->befriend($friend);
        return response()->json(true, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptFriendRequest(Request $request)
    {
        $friend_id = $request->get('friend_id');
        $friend = $this->userRepository->getById($friend_id);
        auth()->user()->acceptFriendRequest($friend);
        return response()->json(true, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function denyFriendRequest(Request $request)
    {
        $friend_id = $request->get('friend_id');
        $friend = $this->userRepository->getById($friend_id);
        auth()->user()->denyFriendRequest($friend);
        return response()->json(true, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfriend(Request $request)
    {
        $friend_id = $request->get('friend_id');
        $friend = $this->userRepository->getById($friend_id);
        auth()->user()->unfriend($friend);
        return response()->json(true, 200);
    }
}
