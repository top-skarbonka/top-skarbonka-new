<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\AdminAuthController;

// ------------------- Company Auth -------------------
Route::get('/company/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
Route::post('/company/login', [CompanyAuthController::class, 'login'])->name('company.login.submit');

Route::middleware('auth:company')->group(function () {
    Route::get('/company/dashboard', [CompanyAuthController::class, 'dashboard'])->name('company.dashboard');
    Route::post('/company/logout', [CompanyAuthController::class, 'logout'])->name('company.logout');
});

// ------------------- Admin Auth -------------------
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/register-company', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/admin/register-company', [AdminAuthController::class, 'registerCompany'])->name('admin.register.submit');
});
