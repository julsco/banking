<?php

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CardTypeController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PaymentCategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {
//        Route::post('/bank-account/create', [BankAccountController::class, 'create']);
    });
Route::post('/bank-account/create', [BankAccountController::class, 'create']);
Route::get('/banks', [BankController::class, 'index']);
Route::get('/currencies', [CurrencyController::class, 'index']);
Route::get('/card-types', [CardTypeController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/payment-categories', [PaymentCategoryController::class, 'index']);
Route::post('/payment/create', [PaymentController::class, 'create']);
