<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectAuthenticatedUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            $this->removeSession($request);
            return $next($request);
        }

        $currentTenantId = (string) tenant('id');
        $sessionTenantId = (string) $request->session()->get('authenticated_tenant_id');


        if (!$sessionTenantId || $sessionTenantId !== $currentTenantId || (string) $user->tenant_id !== $currentTenantId) {
            $this->removeSession($request);
            return $next($request);
        }

        return redirect()->route('tenant.dashboard', [
            'tenant' => $currentTenantId,
        ]);
    }

    private function removeSession(Request $request): void
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
