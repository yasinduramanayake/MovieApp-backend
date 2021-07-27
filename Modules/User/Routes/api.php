<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;

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

Route::middleware("auth:api")->get("/users", function (Request $request) {
    return $request->user();
});

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::get("profile", [AuthController::class, "profile"]);
Route::get("logout", [AuthController::class, "logout"]);
