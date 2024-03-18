<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UsersController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\TariffController;

Route::apiResource('/users', UsersController::class);
Route::apiResource('/vehicles', VehiclesController::class);
Route::get('/vehicles/{vehicle_id}', 'VehiclesController@show');
Route::put('/vehicles/{vehicle_id}', 'VehiclesController@update');


Route::apiResource('/tariffs', TariffController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
