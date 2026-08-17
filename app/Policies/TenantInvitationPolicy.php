<?php

namespace App\Policies;

use App\Models\TenantInvitation;
use App\Models\User;
use App\Services\Tenancy\TenantContextService;

class TenantInvitationPolicy
{
    public function create(User $user): bool
    {
        $context = app(
            TenantContextService::class
        );

        return $context->isSuperAdministrator()
            || $context->hasRole([
                'owner',
                'admin',
            ]);
    }

    public function revoke(
        User $user,
        TenantInvitation $invitation
    ): bool {
        $context = app(
            TenantContextService::class
        );

        if ($context->isSuperAdministrator()) {
            return true;
        }

        return $invitation->tenant_id ===
            $context->tenantId()
            && $context->hasRole([
                'owner',
                'admin',
            ]);
    }
}
