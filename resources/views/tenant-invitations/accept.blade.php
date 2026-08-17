
    <div class="container">
        <h1>Aceitar convite</h1>

        <p>
            Você foi convidado para participar de:
        </p>

        <p>
            <strong>{{ $invitation->tenant->name }}</strong>
        </p>

        <p>
            Perfil:
            <strong>{{ $invitation->role }}</strong>
        </p>

        <p>
            Convite válido até:
            <strong>
                {{ $invitation->expires_at->format('d/m/Y H:i') }}
            </strong>
        </p>

        @if ($invitation->isExpired())
            <div class="alert alert-danger">
                Este convite expirou.
            </div>
        @elseif ($invitation->isAccepted())
            <div class="alert alert-warning">
                Este convite já foi aceito.
            </div>
        @elseif ($invitation->isRevoked())
            <div class="alert alert-danger">
                Este convite foi revogado.
            </div>
        @else
            @auth
                @if (strtolower(auth()->user()->email) !== strtolower($invitation->email))
                    <div class="alert alert-danger">
                        Este convite foi enviado para
                        <strong>{{ $invitation->email }}</strong>,
                        mas você está autenticado como
                        <strong>{{ auth()->user()->email }}</strong>.
                    </div>
                @else
                    <form
                        method="POST"
                        action="{{ route('convidado.accept', [
                            'token' => $token,
                        ]) }}"
                    >
                        @csrf

                        <input
                            type="hidden"
                            name="token"
                            value="{{ $token }}"
                        >

                        <button type="submit">
                            Aceitar convite
                        </button>
                    </form>
                @endif
            @else
                <p>
                    Para aceitar este convite, entre na sua conta
                    ou crie uma nova conta usando o e-mail:
                </p>

                <p>
                    <strong>{{ $invitation->email }}</strong>
                </p>

                <div>
                    <a
                        href="{{ route('login', [
                            'invitation_token' => $token,
                        ]) }}"
                    >
                        Entrar na minha conta
                    </a>

                    <a
                        href="{{ route('register', [
                            'invitation_token' => $token,
                        ]) }}"
                    >
                        Criar uma conta
                    </a>
                </div>
            @endauth
        @endif
    </div>

