<?php

namespace App\Http\Controllers;

use App\Models\TenantInvitation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AcceptTenantInvitationController
{
    public function show(
        Request $request,
        string $token
    ): View {
        $invitation = TenantInvitation::query()
            ->where(
                'token_hash',
                hash('sha256', $token)
            )
            ->firstOrFail();

        abort_unless(
            $invitation->isUsable(),
            410,
            'Este convite expirou ou não está disponível.'
        );

        return view(
            'tenant-invitations.accept',
            [
                'invitation' => $invitation,
                'token' => $token,
            ]
        );
    }

    public function accept(
        Request $request,
        string $token
    ): RedirectResponse {
        $invitation = DB::transaction(function () use (
            $request,
            $token
        ): TenantInvitation {
            $invitation = TenantInvitation::query()
                ->where(
                    'token_hash',
                    hash('sha256', $token)
                )
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $invitation->isUsable(),
                410,
                'Este convite expirou, foi revogado ou já foi aceito.'
            );

            $user = $request->user();

            abort_unless(
                $user,
                401
            );

            abort_unless(
                strtolower($user->email) ===
                strtolower($invitation->email),
                403,
                'Este convite não pertence ao usuário autenticado.'
            );

            $invitation->tenant->users()
                ->syncWithoutDetaching([
                    $user->id => [
                        'role' => $invitation->role,
                        'status' => 'active',
                        'joined_at' => now(),
                    ],
                ]);

            if (!$user->tenant_default_id) {
                $user->forceFill([
                    'tenant_default_id' => $invitation->tenant_id,
                ])->saveQuietly();
            }

            $invitation->update([
                'accepted_at' => now(),
            ]);

            return $invitation;
        });

        return to_route('teste')
            ->with(
                'success',
                'Convite aceito com sucesso.'
            );
    }
}
