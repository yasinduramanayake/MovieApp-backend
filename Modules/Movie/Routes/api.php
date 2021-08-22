<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Movie\Http\Controllers\MovieController;

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

Route::middleware('auth:api')->get('/movie', function (Request $request) {
    return $request->user();
});

Route::post('addmovie', [MovieController::class, 'store']);
Route::get('getmovies', [MovieController::class, 'index']);
Route::put('updatemovie/{id}', [MovieController::class, 'update']);
Route::delete('deletemovie/{id}', [MovieController::class, 'destroy']);
Route::get('showmovie/{id}', [MovieController::class, 'show']);
