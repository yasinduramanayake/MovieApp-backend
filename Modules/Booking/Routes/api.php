<?php

use Illuminate\Http\Request;
use Modules\Booking\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\PdfController;

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

Route::middleware('auth:api')->get('/booking', function (Request $request) {
    return $request->user();
});

Route::post('addbooking', [BookingController::class, 'store']);
Route::get('getbookings', [BookingController::class, 'index']);
Route::put('updatebooking/{id}', [BookingController::class, 'update']);
Route::delete('deletebooking/{id}', [BookingController::class, 'destroy']);

// PDF Genaration

Route::post('genaratebookingreport', [PdfController::class, 'generatePDF']);