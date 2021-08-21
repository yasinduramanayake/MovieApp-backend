<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Theater\Http\Controllers\TheaterController;

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

Route::middleware('auth:api')->get('/theater', function (Request $request) {
    return $request->user();
});

Route::post('addtheater', [TheaterController::class, 'store']);
Route::get('gettheaters', [TheaterController::class, 'index']);
Route::put('updatetheater/{id}', [TheaterController::class, 'update']);
Route::delete('deletetheater/{id}', [TheaterController::class, 'destroy']);