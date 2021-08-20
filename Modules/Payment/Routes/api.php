<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\PaymentController;
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

Route::middleware('auth:api')->get('/payment', function (Request $request) {
    return $request->user();
});

Route::post('addpayment', [PaymentController::class, 'store']);
Route::get('getpayments', [TheaPaymentController::class, 'index']);
Route::put('updatepayment/{id}', [PaymentController::class, 'update']);
Route::delete('deletepayment/{id}', [PaymentController::class, 'destroy']);