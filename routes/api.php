<?php

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

Route::post('bid', 'App\Http\Controllers\ApiController@bid');
Route::post('signin', 'App\Http\Controllers\ApiController@signin');
Route::post('review', 'App\Http\Controllers\ApiController@review');
Route::post('getBids', 'App\Http\Controllers\ApiController@getBids');
Route::post('vehicles', 'App\Http\Controllers\ApiController@vehicles');
Route::post('addMoney', 'App\Http\Controllers\ApiController@addMoney');
Route::post('bookRide', 'App\Http\Controllers\ApiController@bookRide');
Route::post('acceptBid', 'App\Http\Controllers\ApiController@acceptBid');
Route::post('userRides', 'App\Http\Controllers\ApiController@userRides');
Route::post('cancelRide', 'App\Http\Controllers\ApiController@cancelRide');
Route::post('getDetails', 'App\Http\Controllers\ApiController@getDetails');
Route::post('uploadFile', 'App\Http\Controllers\ApiController@uploadFile');
Route::post('driverRides', 'App\Http\Controllers\ApiController@driverRides');
Route::post('ongoingRide', 'App\Http\Controllers\ApiController@ongoingRide');
Route::post('driverPayout', 'App\Http\Controllers\ApiController@driverPayout');
Route::post('driverRating', 'App\Http\Controllers\ApiController@driverRating');
Route::post('driverStatus', 'App\Http\Controllers\ApiController@driverStatus');
Route::post('fetchSettings', 'App\Http\Controllers\ApiController@fetchSettings');
Route::post('driverDetails', 'App\Http\Controllers\ApiController@driverDetails');
Route::post('driverPayouts', 'App\Http\Controllers\ApiController@driverPayouts');
Route::post('getDriverBids', 'App\Http\Controllers\ApiController@getDriverBids');
Route::post('updateBooking', 'App\Http\Controllers\ApiController@updateBooking');
Route::post('updateProfile', 'App\Http\Controllers\ApiController@updateProfile');
Route::post('vehicleDetails', 'App\Http\Controllers\ApiController@vehicleDetails');
Route::post('getTransactions', 'App\Http\Controllers\ApiController@getTransactions');
Route::post('bookOutdoorRide', 'App\Http\Controllers\ApiController@bookOutdoorRide');
Route::post('getOutdoorOrders', 'App\Http\Controllers\ApiController@getOutdoorOrders');
Route::post('sendNotification', 'App\Http\Controllers\ApiController@sendNotification');
Route::post('checkCouponStatus', 'App\Http\Controllers\ApiController@checkCouponStatus');
Route::post('upcomingUserRides', 'App\Http\Controllers\ApiController@upcomingUserRides');
Route::post('vehicleCategories', 'App\Http\Controllers\ApiController@vehicleCategories');
Route::post('checkBookingStatus', 'App\Http\Controllers\ApiController@checkBookingStatus');
Route::post('upcomingDriverRides', 'App\Http\Controllers\ApiController@upcomingDriverRides');
Route::post('updateDriverDetails', 'App\Http\Controllers\ApiController@updateDriverDetails');
Route::post('getUserOutdoorOrders', 'App\Http\Controllers\ApiController@getUserOutdoorOrders');
Route::post('DriverOverallTraveled', 'App\Http\Controllers\ApiController@DriverOverallTraveled');
