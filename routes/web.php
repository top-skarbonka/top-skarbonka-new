<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyAuthController;

// Strona startowa (opcjonalnie testowa)
Route::get('/', function () {
    return view('welcome');
});

// --------------- Company Auth ---------------
Route::get('/company/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
Route::post('/company/login', [CompanyAuthController::class, 'login'])->name('company.login.submit');

Route::middleware('auth:company')->group(function () {
    Route::get('/company/dashboard', [CompanyAuthController::class, 'dashboard'])->name('company.dashboard');
    Route::post('/company/logout', [CompanyAuthController::class, 'logout'])->name('company.logout');
});
