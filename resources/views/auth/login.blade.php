<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

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
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.14), transparent 35%),
                var(--background);
            color: var(--text);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 38px 34px;
            background: var(--card);
            border: 1px solid rgba(229, 231, 235, 0.9);
            border-radius: 20px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08), 0 4px 12px rgba(15, 23, 42, 0.04);
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
            font-size: 1.45rem;
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

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #374151;
            font-size: 0.84rem;
            font-weight: 650;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            min-height: 45px;
            padding: 0 12px;
            color: var(--text);
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 9px;
            outline: none;
            font: inherit;
            font-size: 0.92rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.13);
        }

        input.is-invalid {
            border-color: var(--danger);
        }

        .error-message {
            margin-top: 5px;
            color: var(--danger);
            font-size: 0.78rem;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 10px;
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .alert-error {
            color: #991b1b;
            background: var(--danger-light);
            border: 1px solid #fecaca;
        }

        .alert-success {
            color: #166534;
            background: var(--success-light);
            border: 1px solid #bbf7d0;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
        }

        .remember-row input {
            width: 16px;
            height: 16px;
        }

        .remember-row label {
            margin-bottom: 0;
            color: #4b5563;
            font-size: 0.85rem;
            font-weight: 400;
        }

        button[type="submit"] {
            width: 100%;
            min-height: 45px;
            padding: 0 18px;
            color: #ffffff;
            background: var(--primary);
            border: 1px solid var(--primary);
            border-radius: 9px;
            font: inherit;
            font-size: 0.92rem;
            font-weight: 650;
            cursor: pointer;
            transition: background-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        }

        button[type="submit"]:hover:not(:disabled) {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        button[type="submit"]:disabled {
            cursor: not-allowed;
            opacity: 0.65;
        }

        .footer-note {
            margin-top: 24px;
            color: var(--muted);
            font-size: 0.82rem;
            line-height: 1.5;
            text-align: center;
        }

        .footer-note a {
            color: var(--primary);
            font-weight: 650;
            text-decoration: none;
        }

        .footer-note a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 22px;
                border-radius: 16px;
            }
        }
    </style>
</head>

<body>
    <main class="login-card">
        <header class="header">
            <div class="logo">↪</div>

            <h1>Entrar</h1>

            <p class="subtitle">Acesse sua conta para continuar.</p>
        </header>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="form-group">
                <label for="email">E-mail</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror"
                    required
                    autofocus
                >

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Senha</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="@error('password') is-invalid @enderror"
                    required
                >

                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Manter conectado</label>
            </div>

            <button type="submit">
                Entrar
            </button>
        </form>

        <p class="footer-note">
            Ainda não possui uma conta?
            <a href="{{ route('register') }}">
                Criar cadastro
            </a>
        </p>
    </main>
</body>
</html>
