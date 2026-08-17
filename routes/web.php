<?php

use App\Http\Controllers\AcceptTenantInvitationController;
use App\Http\Controllers\TenantInvitationController;
use App\Services\Tenancy\TenantContextService;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});


Route::middleware(['auth', 'tenant.default'])->group(function () {
    Route::get('/teste', function () {
        $context = app(TenantContextService::class);

        $context->user();
        $context->tenant();
        $context->tenantId();
        $context->role();
        $context->isSuperAdministrator();

        dd([
            "user" => $context->user()->toArray(),
            "tenant" => $context->tenant()->toArray(),
            "tenantId" =>$context->tenantId(),
            "role" => $context->role(),
            "isSuperAdministrator" =>$context->isSuperAdministrator()

        ]);
    })->name('teste');

    Route::get('/tenant/invitations/create',[TenantInvitationController::class, 'create'])->name('tenant-invitations.create');


    Route::post('/tenant/invitations',[TenantInvitationController::class, 'store'])->name('tenant-invitations.store');
});

Route::get('/convidado/{token}',[AcceptTenantInvitationController::class,'show'])->name('convidado');
Route::post(
    '/tenant-invitations/accept',
    [AcceptTenantInvitationController::class, 'accept']
)
    ->middleware('auth')
    ->name('tenant-invitations.accept.store');

Route::post(
    '/convidado/{token}/aceitar',
    [
        AcceptTenantInvitationController::class,
        'accept',
    ]
)
    ->middleware('auth')
    ->name('convidado.accept');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
