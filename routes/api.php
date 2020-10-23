<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('search', 'Travels\TravelsController@search');
Route::get('searchextended', 'Travels\TravelsController@searchExtended');
Route::get('travels', 'Travels\TravelsController@get');
Route::get('travel', 'Travels\TravelsController@findById');
Route::get('travelComments', 'Travels\TravelsController@getTravelComment');
Route::get('travelsLast', 'Travels\TravelsController@getLast');
Route::get('searchCities', 'LocationController@searchCities');
Route::get('getFiltersTravel', 'Travels\TravelsController@getFiltersTravel');
Route::middleware('auth:api')->get('messages/{id}', 'MessageController@get');
Route::middleware('auth:api')->get('messagesUsers', 'MessageController@getUsers');
Route::middleware('auth:api')->post('messages', 'MessageController@store');
Route::middleware('auth:api')->get('messages', 'MessageController@list');
Route::middleware('auth:api')->get('friends', 'FriendController@getAllFriends');
Route::middleware('auth:api')->get('friendsPending', 'FriendController@getPendingFriendships');
Route::middleware('auth:api')->post('sendreqfriends', 'FriendController@sendReqFriends');
Route::middleware('auth:api')->post('unfriend', 'FriendController@unfriend');
Route::middleware('auth:api')->post('acceptFriendRequest', 'FriendController@acceptFriendRequest');
Route::middleware('auth:api')->post('denyFriendRequest', 'FriendController@denyFriendRequest');

