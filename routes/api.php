<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Travels\TravelsController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/user', 'Admin/UsersController@AuthRouteAPI');
Route::get('search', [TravelsController::class, 'search']);
Route::get('searchextended', [TravelsController::class, 'searchExtended']);
Route::get('travels', [TravelsController::class, 'get']);
Route::get('travel', [TravelsController::class, 'findById']);
Route::get('travelComments', [TravelsController::class, 'getTravelComment']);
Route::get('travelsLast', [TravelsController::class, 'getLast']);
Route::get('travelsPopular', [TravelsController::class, 'getTravelsPopular']);
Route::get('travelsNear', [TravelsController::class, 'getTravelsNear']);
Route::get('searchCities', [LocationController::class, 'searchCities']);
Route::get('getFiltersTravel', [TravelsController::class, 'getFiltersTravel']);
Route::get('searchTravelsForMap', [TravelsController::class, 'searchTravelsForMap']);
Route::get('getFilterForMap', [TravelsController::class, 'getFilterForMap']);
Route::middleware('auth:api')->post('travels/save', [TravelsController::class, 'save']);

Route::middleware('auth:api')->get('messages/{id}', [MessageController::class, 'get']);
Route::middleware('auth:api')->get('messagesUsers', [MessageController::class, 'getUsers']);
Route::middleware('auth:api')->post('messages', [MessageController::class, 'store']);
Route::middleware('auth:api')->put('messages/markUsRead/{id}', [MessageController::class, 'markUsRead']);
Route::middleware('auth:api')->get('messages', [MessageController::class, 'list']);

Route::middleware('auth:api')->get('friends', [FriendController::class, 'getAllFriends']);
Route::middleware('auth:api')->get('friendsPending', [FriendController::class, 'getPendingFriendships']);
Route::middleware('auth:api')->post('sendreqfriends', [FriendController::class, 'sendReqFriends']);
Route::middleware('auth:api')->post('unfriend', [FriendController::class, 'unfriend']);
Route::middleware('auth:api')->post('acceptFriendRequest', [FriendController::class, 'acceptFriendRequest']);
Route::middleware('auth:api')->post('denyFriendRequest', [FriendController::class, 'denyFriendRequest']);

Route::middleware('auth:api')->get('users', [UserController::class, 'getAllUsers']);

