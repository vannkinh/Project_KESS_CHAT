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
Route::get('rooms', 'RoomController@allrooms');
Route::get('room/{room}', 'RoomController@roomdetail');
Route::post('room', 'RoomController@createroom');
Route::put('room/{id}', 'RoomController@updateroom');
Route::delete('room/{id}', 'RoomController@destroyroom');


// table
Route::get('tables', 'RoomController@alltable');
Route::get('table/{table}', 'RoomController@tabledetail');
Route::post('table', 'RoomController@createtable');
Route::put('table/{id}', 'RoomController@updatetable');
Route::delete('table/{id}', 'RoomController@destroytable');


//booking
Route::get('bookings', 'BookingController@allbooking');
Route::get('booking/{booking}', 'BookingController@bookingdetail');
Route::post('booking', 'BookingController@createbooking');


//bookingItem
Route::get('bookingItem', 'BookingItemController@index');


//shop
Route::get('shops', 'BookingController@listshop');
Route::get('shop/{shop}', 'BookingController@shopdetail');



//user's booking history
Route::get('users', 'BookingController@listalluser');
Route::get('user/{user}', 'BookingController@userbookinghistory');


//shop's booking history
Route::get('shophistory/{shophistory}', 'BookingController@shopbookinghistory');