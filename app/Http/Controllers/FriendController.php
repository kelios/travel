<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class FriendController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllFriends(Request $request)
    {
        $friends = Auth::user()->getFriends();
        return response()->json($friends);
    }

    public function getPendingFriendships(Request $request)
    {
        $friends = Auth::user()->getPendingFriendships()->load('recipient','sender');
       // dd($friends[0]->recipient);
        return response()->json($friends);
    }

    public function sendReqFriends(Request $request)
    {
        $friend_id = $request->get('friend_id');
        $friend = $this->userRepository->getById($friend_id);
        auth()->user()->befriend($friend);
        return response()->json(true, 200);
    }
}
