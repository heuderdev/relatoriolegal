<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acesso negado</title>

    <style>
        :root {
            color-scheme: light;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --text: #111827;
            --muted: #6b7280;
            --border: #e5e7eb;
            --background: #f3f4f6;
            --card: #ffffff;
            --danger: #dc2626;
            --danger-light: #fef2f2;
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
                    rgba(37, 99, 235, 0.12),
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

        .error-card {
            width: 100%;
            max-width: 480px;
            padding: 42px 34px;
            text-align: center;
            background: var(--card);
            border: 1px solid rgba(229, 231, 235, 0.9);
            border-radius: 20px;
            box-shadow:
                0 20px 45px rgba(15, 23, 42, 0.08),
                0 4px 12px rgba(15, 23, 42, 0.04);
        }

        .icon-wrapper {
            width: 82px;
            height: 82px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            border-radius: 50%;
            background: var(--danger-light);
        }

        .icon {
            width: 42px;
            height: 42px;
            color: var(--danger);
        }

        .status-code {
            margin-bottom: 8px;
            color: var(--danger);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        h1 {
            margin-bottom: 12px;
            color: var(--text);
            font-size: clamp(1.6rem, 4vw, 2rem);
            line-height: 1.2;
        }

        .description {
            margin: 0 auto;
            max-width: 360px;
            color: var(--muted);
            font-size: 0.98rem;
            line-height: 1.6;
        }

        .message {
            margin-top: 24px;
            padding: 13px 16px;
            color: #991b1b;
            background: var(--danger-light);
            border: 1px solid #fecaca;
            border-radius: 10px;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 28px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 20px;
            border-radius: 9px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .button-primary {
            color: #ffffff;
            background: var(--primary);
        }

        .button-primary:hover {
            background: var(--primary-dark);
        }

        .button-secondary {
            color: #374151;
            background: #ffffff;
            border: 1px solid var(--border);
        }

        .button-secondary:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .footer {
            margin-top: 28px;
            color: #9ca3af;
            font-size: 0.78rem;
        }

        @media (max-width: 480px) {
            .error-card {
                padding: 34px 22px;
                border-radius: 16px;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="error-card">
        <div class="icon-wrapper" aria-hidden="true">
            <svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
                <path d="M10.3 3.8 2.7 17a2 2 0 0 0 1.74 3h15.12a2 2 0 0 0 1.74-3L13.7 3.8a2 2 0 0 0-3.4 0Z"></path>
            </svg>
        </div>

        <p class="status-code">Erro 403</p>

        <h1>Acesso negado</h1>

        <p class="description">
            Você não tem permissão para acessar este recurso.
            Verifique se está utilizando a empresa correta.
        </p>

        @isset($message)
            <div class="message">
                {{ $message }}
            </div>
        @endisset

        <div class="actions">
            <a
                href="{{ url()->previous() }}"
                class="button button-secondary"
            >
                Voltar
            </a>

            <a
                href="{{ url('/') }}"
                class="button button-primary"
            >
                Ir para o início
            </a>
        </div>

        <p class="footer">
            Se você acredita que isso é um erro, entre em contato com o suporte.
        </p>
    </main>
</body>
</html>
