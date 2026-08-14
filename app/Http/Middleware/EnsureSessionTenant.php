<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSessionTenant
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $currentTenantId = (string) tenant('id');

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Faça login novamente para esta empresa.',
                ]);
        }

        $sessionTenantId = (string) $request->session()
            ->get('authenticated_tenant_id');


        if (!$sessionTenantId || $sessionTenantId !== $currentTenantId) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();


            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Faça login novamente para esta empresa.',
                ]);
        }

        if ((string) $user->tenant_id !== $currentTenantId) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            abort(403, 'Esta sessão não pertence à empresa atual.');
        }

        return $next($request);
    }
}
