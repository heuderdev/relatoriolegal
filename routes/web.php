<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';


Route::get('/test', function () {
    $tenant = \App\Models\Tenant::find('empresa1');

    tenancy()->initialize($tenant);

    dd(User::all()->toArray());

    
});