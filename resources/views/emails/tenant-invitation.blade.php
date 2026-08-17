<h1>Você recebeu um convite</h1>

<p>
    Você foi convidado para participar da empresa:
    <strong>{{ $invitation->tenant->name }}</strong>
</p>

<p>
    Perfil: {{ $invitation->role }}
</p>

<p>
    O convite expira em:
    {{ $invitation->expires_at->format('d/m/Y H:i') }}
</p>

<a href="{{ $url }}">
    Aceitar convite
</a>
