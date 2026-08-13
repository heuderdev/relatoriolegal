<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

InitializeTenancyByPath::$onFail = function ($exception, $request, $next) {
    abort(404, 'Empresa não encontrada.');
};



Route::group([
    'prefix' => '/{tenant}',
    'middleware' => ['web',InitializeTenancyByPath::class],
], function () {

    Route::get('/login', [LoginController::class, 'index'])->middleware('tenant.guest')->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::middleware(['tenant.session','role:tenant_administrator'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('tenant.dashboard');
    });

});


