<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;


Route::group([
	'prefix' => '/{tenant}',
	'middleware' => [InitializeTenancyByPath::class],
], function () {
	Route::get('/', function () {
		User::all();

		return view('welcome');
		// dd('tenant.php executed and tenant found:' . tenant('id'));
	});

	Route::get('/signup', function () {
		dd('signup page executed and tenant found:' . tenant('id'));
	});
});

InitializeTenancyByPath::$onFail = function ($exception, $request, $next) {
	dd('error');
};