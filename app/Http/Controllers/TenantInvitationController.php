<?php

namespace App\Http\Controllers;

use App\Actions\Tenancy\CreateTenantInvitation;
use App\Http\Requests\StoreTenantInvitationRequest;
use App\Mail\TenantInvitationMail;
use App\Services\Tenancy\TenantContextService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TenantInvitationController
{
    public function create(): View
    {
        return view('tenant-invitations.create');
    }


    public function store(
        StoreTenantInvitationRequest $request,
        CreateTenantInvitation $action,
        TenantContextService $context
    ): RedirectResponse {
        $result = $action->execute(
            inviter: $request->user(),
            tenantId: $context->tenantId(),
            email: $request->string('email')->toString(),
            role: $request->string('role')->toString(),
        );

        Mail::to(
            $result['invitation']->email
        )->queue(
            new TenantInvitationMail(
                $result['invitation'],
                $result['token']
            )
        );

        return back()->with(
            'success',
            'Convite enviado com sucesso.'
        );
    }
}
