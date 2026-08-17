<?php

use App\Http\Middleware\EnsureSessionTenant;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\GuestCustom;
use App\Http\Middleware\RedirectAuthenticatedUser;
use App\Http\Middleware\ResolveDefaultTenant;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'tenant.session' => EnsureSessionTenant::class,
            'role' => EnsureUserHasRole::class,
            'tenant.guest' => RedirectAuthenticatedUser::class,
            'guest.custom' => GuestCustom::class,
            'tenant.default' => ResolveDefaultTenant::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
