<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestCustom
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Visitante: continua para a página de login/registro
        if (!$user) {
            return $next($request);
        }

        $currentTenantId = (string) $request->session()->get('authenticated_tenant_id');


        // Usuário autenticado no tenant atual
        if ((string) $user->tenant_id === $currentTenantId) {
            return redirect()->route('tenant.dashboard', [
                'tenant' => $currentTenantId,
            ]);
        }

        // Usuário autenticado em outro tenant:
        // encerra a sessão para exigir novo login.
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $next($request);
    }
}
