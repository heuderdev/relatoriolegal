<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Criar conta - {{ tenant('id') }}</title>

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --text: #111827;
            --muted: #6b7280;
            --border: #d1d5db;
            --background: #f3f4f6;
            --card: #ffffff;
            --danger: #dc2626;
            --danger-light: #fef2f2;
            --success: #15803d;
            --success-light: #f0fdf4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background:
                radial-gradient(
                    circle at top left,
                    rgba(37, 99, 235, 0.14),
                    transparent 35%
                ),
                var(--background);
            color: var(--text);
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        .register-card {
            width: 100%;
            max-width: 800px;
            padding: 38px 34px;
            background: var(--card);
            border: 1px solid rgba(229, 231, 235, 0.9);
            border-radius: 20px;
            box-shadow:
                0 20px 45px rgba(15, 23, 42, 0.08),
                0 4px 12px rgba(15, 23, 42, 0.04);
        }

        .header {
            margin-bottom: 28px;
            text-align: center;
        }

        .logo {
            width: 62px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            border-radius: 16px;
            font-size: 1.5rem;
            font-weight: 800;
        }

        h1 {
            margin-bottom: 8px;
            font-size: 1.7rem;
            line-height: 1.2;
        }

        .subtitle {
            color: var(--muted);
            font-size: 0.92rem;
        }

        .tenant-label {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            color: var(--primary-dark);
            background: #eff6ff;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 10px;
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .alert-danger {
            color: #991b1b;
            background: var(--danger-light);
            border: 1px solid #fecaca;
        }

        .alert-success {
            color: #166534;
            background: var(--success-light);
            border: 1px solid #bbf7d0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 14px;
        }

        .form-group {
            min-width: 0;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #374151;
            font-size: 0.84rem;
            font-weight: 650;
        }

        .required {
            color: var(--danger);
        }

        input {
            width: 100%;
            min-height: 44px;
            padding: 0 12px;
            color: var(--text);
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 9px;
            outline: none;
            font: inherit;
            font-size: 0.92rem;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.13);
        }

        input.is-invalid {
            border-color: var(--danger);
        }

        .field-error {
            margin-top: 5px;
            color: var(--danger);
            font-size: 0.78rem;
        }

        .password-hint {
            margin-top: 5px;
            color: var(--muted);
            font-size: 0.75rem;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 28px;
        }

        .button {
            min-height: 45px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 18px;
            border-radius: 9px;
            font-size: 0.9rem;
            font-weight: 650;
            text-decoration: none;
            cursor: pointer;
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .button-primary {
            flex: 1;
            color: #ffffff;
            background: var(--primary);
            border: 1px solid var(--primary);
        }

        .button-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .button-secondary {
            color: #374151;
            background: #ffffff;
            border: 1px solid var(--border);
        }

        .button-secondary:hover {
            background: #f9fafb;
        }

        .footer {
            margin-top: 24px;
            color: var(--muted);
            font-size: 0.82rem;
            text-align: center;
        }

        .footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 520px) {
            .register-card {
                padding: 30px 22px;
                border-radius: 16px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>
    <main class="register-card">
        <header class="header">
            <div class="logo">+</div>

            <h1>Criar sua conta</h1>

            <p class="subtitle">
                Preencha os dados para criar seu acesso.
            </p>

            <span class="tenant-label">
                Empresa: {{ tenant('id') }}
            </span>
        </header>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('errors'))
            <div class="alert alert-danger">
                {{ session('errors')->first() }}
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('register.store', [
                'tenant' => tenant('id'),
            ]) }}"
        >
            @csrf

            <div class="form-grid">
                <div class="form-group full">
                    <label for="name">
                        Nome completo <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="{{ session('errors')?->has('name') ? 'is-invalid' : '' }}"
                        placeholder="Digite seu nome completo"
                        required
                        autofocus
                    >

                    @if (session('errors')?->has('name'))
                        <div class="field-error">
                            {{ session('errors')->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">
                        E-mail <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="{{ session('errors')?->has('email') ? 'is-invalid' : '' }}"
                        placeholder="voce@exemplo.com"
                        required
                    >

                    @if (session('errors')?->has('email'))
                        <div class="field-error">
                            {{ session('errors')->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="cpf_cnpj">CPF/CNPJ</label>

                    <input
                        type="text"
                        id="cpf_cnpj"
                        name="cpf_cnpj"
                        value="{{ old('cpf_cnpj') }}"
                        class="{{ session('errors')?->has('cpf_cnpj') ? 'is-invalid' : '' }}"
                        placeholder="Opcional"
                    >

                    @if (session('errors')?->has('cpf_cnpj'))
                        <div class="field-error">
                            {{ session('errors')->first('cpf_cnpj') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">
                        Senha <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="{{ session('errors')?->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Mínimo de 8 caracteres"
                        required
                    >

                    <p class="password-hint">
                        Use pelo menos 8 caracteres.
                    </p>

                    @if (session('errors')?->has('password'))
                        <div class="field-error">
                            {{ session('errors')->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        Confirmar senha <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repita sua senha"
                        required
                    >
                </div>
            </div>

            <div class="actions">
                <a
                    href="{{ route('login', [
                        'tenant' => tenant('id'),
                    ]) }}"
                    class="button button-secondary"
                >
                    Já tenho conta
                </a>

                <button type="submit" class="button button-primary">
                    Criar conta
                </button>
            </div>
        </form>

        <p class="footer">
            O cadastro será criado na empresa
            <strong>{{ tenant('id') }}</strong>.
        </p>
    </main>
</body>
</html>
