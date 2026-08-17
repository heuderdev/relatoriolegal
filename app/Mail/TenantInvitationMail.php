<?php

namespace App\Mail;

use App\Models\TenantInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantInvitationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public TenantInvitation $invitation,
        public string $plainToken
    ) {
    }

    public function build(): self
    {
        $url = route(
            'convidado',
            [
                'token' => $this->plainToken,
            ]
        );

        return $this
            ->subject(
                'Convite para participar de '
                . $this->invitation->tenant->name
            )
            ->view('emails.tenant-invitation', [
                'invitation' => $this->invitation,
                'url' => $url,
            ]);
    }
}
