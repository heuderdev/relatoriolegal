<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request,  Closure $next, ...$roles): Response
    {
        $user = $request->user();

        abort_unless($user, 401);

        $currentTenantId = (string) tenant('id');
        $userTenantId = (string) $user->tenant_id;

        // Garante que a sessão/usuário pertence à empresa da URL
        if ($userTenantId !== $currentTenantId) {
            return $this->viewMessage('Usuário não pertence a esta empresa.', $currentTenantId, $userTenantId);

        }

        // Garante que a sessão também foi criada para esta empresa
        $sessionTenantId = (string) $request->session()->get('authenticated_tenant_id');

        abort_unless($sessionTenantId === $currentTenantId, 403, 'Sessão inválida para esta empresa.');

        // Verifica se a role do usuário está entre as roles permitidas
        if (!in_array((string) $user->role, $roles, true)) {
            return $this->viewMessage('Usuário não tem permissão para acessar esta área.', $currentTenantId, $userTenantId);
        }


        return $next($request);
    }

    private function viewMessage(string $message, string $currentTenantId, string $userTenantId): Response
    {
        return response()->view('errors.tenant-forbidden',
            [
                'message' => $message,
                'currentTenantId' => $currentTenantId,
                'userTenantId' => $userTenantId,
            ],
            403
        );
    }
}
