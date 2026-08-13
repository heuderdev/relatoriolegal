<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ tenant('id') ?? 'Empresa' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f4f5f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 380px;
            padding: 2.5rem 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .login-card h1 {
            font-size: 1.4rem;
            margin-bottom: 0.25rem;
            color: #1f2933;
            text-align: center;
        }

        .login-card .tenant-label {
            text-align: center;
            color: #6b7280;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.35rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: border-color 0.15s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        input.is-invalid {
            border-color: #dc2626;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 0.65rem 0.85rem;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-bottom: 1.1rem;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-bottom: 1.25rem;
        }

        .remember-row label {
            margin-bottom: 0;
            font-weight: 400;
            color: #4b5563;
            font-size: 0.85rem;
        }

        button[type="submit"] {
            width: 100%;
            padding: 0.7rem;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }

        button[type="submit"]:hover {
            background-color: #1d4ed8;
        }

        .footer-note {
            text-align: center;
            font-size: 0.78rem;
            color: #9ca3af;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Entrar</h1>
        <p class="tenant-label">Empresa: {{ tenant('id') }}</p>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login', ['tenant' => tenant('id')]) }}">
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
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Manter conectado</label>
            </div>

            <button type="submit">Entrar</button>
        </form>

        <p class="footer-note">Acesso restrito a usuários da empresa {{ tenant('id') }}</p>
    </div>
</body>
</html>
