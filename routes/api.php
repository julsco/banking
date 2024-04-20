<?php

use App\Http\Controllers\BankAccountController;
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
