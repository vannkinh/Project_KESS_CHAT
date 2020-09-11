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

// room
Route::get('room', 'RoomController@index');
Route::get('room/{room}', 'RoomController@show');
Route::post('room', 'RoomController@store');
Route::put('room/{id}', 'RoomController@update');
Route::delete('room/{id}', 'RoomController@destroy');
Route::delete('room/{id}', 'RoomController@destroy');

//booking
Route::get('booking', 'BookingController@allbooking');
Route::get('booking/{booking}', 'BookingController@bookingdetail');
Route::post('booking', 'BookingController@store');
//bookingItem
Route::get('bookingItem', 'BookingItemController@index');
//shop
Route::get('shop', 'BookingController@listshop');
Route::get('shop/{shop}', 'BookingController@shopdetail');
