<?php

use Illuminate\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

# Home page
Route::get('/', function (Redirector $redirector) {
    return $redirector->to('/login')
        ->withHeaders(['X-Inertia-Location' => '/login']);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {
        # Dashboard
        Route::get('/dashboard', function () {
            return Inertia::render('banking/dashboard/Dashboard');
        })->name('dashboard');

        # Bank Accounts
        Route::get('/bank-accounts', function () {
            return Inertia::render('banking/bank-accounts/BankAccounts');
        })->name('bankAccounts');

        # Team Dashboard
        Route::get('/team-dashboard', function () {
            return Inertia::render('banking/team-dashboard/TeamDashboard');
        })->name('teamDashboard');

        # All Payments
        Route::get('/payments', function () {
            return Inertia::render('global/shared/AllPayments');
        })->name('payments');
});
