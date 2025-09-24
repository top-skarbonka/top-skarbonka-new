<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CompanyPointsController;
use App\Http\Controllers\ClientRegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminCompanyController;

// ------------------- Company Auth -------------------
Route::get('/company/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
Route::post('/company/login', [CompanyAuthController::class, 'login'])->name('company.login.submit');

Route::middleware('auth:company')->group(function () {
    Route::get('/company/dashboard', [CompanyAuthController::class, 'dashboard'])->name('company.dashboard');
    Route::post('/company/logout', [CompanyAuthController::class, 'logout'])->name('company.logout');

    // --------- Przyznawanie punktów ----------
    Route::get('/company/points/new', [CompanyPointsController::class, 'create'])->name('company.points.create');
    Route::post('/company/points', [CompanyPointsController::class, 'store'])->name('company.points.store');
});

// ------------------- Admin Auth -------------------
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Firmy
    Route::get('/admin/companies', [AdminCompanyController::class, 'index'])->name('admin.companies.index');
    Route::get('/admin/companies/create', [AdminCompanyController::class, 'create'])->name('admin.companies.create');
    Route::post('/admin/companies', [AdminCompanyController::class, 'store'])->name('admin.companies.store');
    Route::get('/admin/companies/{id}', [AdminCompanyController::class, 'show'])->name('admin.companies.show');

    // Wylogowanie
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// ------------------- Client Panel -------------------
Route::get('/client/register', [ClientRegisterController::class, 'showForm'])->name('client.register.form');
Route::post('/client/register', [ClientRegisterController::class, 'register'])->name('client.register.submit');
