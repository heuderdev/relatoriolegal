<?php

namespace App\Actions\Tenancy;

use App\Models\TenantInvitation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateTenantInvitation
{
    public function execute(
        User $inviter,
        int $tenantId,
        string $email,
        string $role
    ): array {
        return DB::transaction(function () use (
            $inviter,
            $tenantId,
            $email,
            $role
        ): array {
            $existingMembership = $inviter
                ->tenants()
                ->whereKey($tenantId)
                ->wherePivot('status', 'active')
                ->exists();

            abort_unless(
                $existingMembership,
                403
            );

            $alreadyMember = User::query()
                ->where('email', $email)
                ->whereHas(
                    'tenants',
                    function ($query) use ($tenantId) {
                        $query->whereKey($tenantId)
                            ->where(
                                'tenant_user.status',
                                'active'
                            );
                    }
                )
                ->exists();

            abort_if(
                $alreadyMember,
                422,
                'Este usuário já pertence ao tenant.'
            );

            TenantInvitation::query()
                ->where('tenant_id', $tenantId)
                ->where('email', $email)
                ->whereNull('accepted_at')
                ->whereNull('revoked_at')
                ->update([
                    'revoked_at' => now(),
                ]);

            $plainToken = Str::random(64);

            $invitation = TenantInvitation::create([
                'tenant_id' => $tenantId,
                'invited_by' => $inviter->id,
                'email' => $email,
                'role' => $role,
                'token_hash' => hash(
                    'sha256',
                    $plainToken
                ),
                'expires_at' => now()->addDays(3),
            ]);

            return [
                'invitation' => $invitation,
                'token' => $plainToken,
            ];
        });
    }
}
