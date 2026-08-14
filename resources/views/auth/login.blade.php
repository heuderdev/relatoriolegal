<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - {{ tenant('id') ?? 'Empresa' }}</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
            --warning: #b45309;
            --warning-light: #fffbeb;
            --success: #15803d;
            --success-light: #f0fdf4;
        }

        [x-cloak] {
            display: none !important;
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
            max-width: 730px;
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
        input[type="password"],
        select {
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
        input[type="password"]:focus,
        select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.13);
        }

        input.is-invalid,
        select.is-invalid {
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

        .alert-warning {
            color: #92400e;
            background: var(--warning-light);
            border: 1px solid #fde68a;
        }

        .alert a {
            color: inherit;
            font-weight: 700;
        }

        .tenant-select-container {
            margin-top: 12px;
            padding: 14px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .tenant-select-container label {
            color: var(--primary-dark);
        }

        .tenant-role {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: 0.75rem;
        }

        .loading {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            color: var(--muted);
            font-size: 0.8rem;
        }

        .loading-spinner {
            width: 16px;
            height: 16px;
            display: inline-block;
            border: 2px solid #dbeafe;
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
    <main class="login-card" x-data="loginForm()" x-init="init()">
        <header class="header">
            <div class="logo">↪</div>

            <h1>Entrar</h1>

            <p class="subtitle">Acesse sua conta para continuar.</p>

            <span class="tenant-label">
                Empresa: {{ tenant('id') }}
            </span>
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

        <div
            x-show="emailNotFound"
            x-cloak
            class="alert alert-warning"
        >
            <strong>E-mail não encontrado.</strong>
            <div>
                Este e-mail não possui cadastro na base de dados.
                Você precisa se registrar antes de fazer login.
            </div>
        </div>

        <div
            x-show="apiError"
            x-cloak
            class="alert alert-error"
            x-text="apiError"
        ></div>

        <form
            method="POST"
            action="{{ route('login.store', ['tenant' => tenant('id')]) }}"
            @submit="validateTenant($event)"
        >
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
                    x-model.trim="email"
                    @input.debounce.500ms="fetchTenants()"
                >

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div x-show="loading" x-cloak class="loading">
                    <span class="loading-spinner"></span>
                    <span>Buscando empresas...</span>
                </div>

                <div
                    x-show="tenants.length > 0"
                    x-cloak
                    x-transition
                    class="tenant-select-container"
                >
                    <label for="tenant_id">Empresas encontradas</label>

                    <select
                        id="tenant_id"
                        name="tenant_id"
                        x-model="selectedTenant"
                        :class="{ 'is-invalid': tenantError }"
                        :required="tenants.length > 1"
                    >
                        <option value="">Escolha uma empresa...</option>

                        <template x-for="tenantItem in tenants" :key="tenantItem.tenant_id">
                            <option
                                :value="tenantItem.tenant_id"
                                x-text="tenantItem.tenant_id +' (' + tenantItem.role_label + ')'"
                            ></option>
                        </template>
                    </select>

                    <template x-if="selectedTenantData">
                        <span
                            class="tenant-role"
                            x-text="'Perfil: ' + selectedTenantData.role"
                        ></span>
                    </template>

                    <div
                        x-show="tenantError"
                        x-cloak
                        class="error-message"
                        x-text="tenantError"
                    ></div>
                </div>
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

            <button
                type="submit"
                :disabled="loading || emailNotFound || tenants.length === 0"
            >
                <span x-show="!loading">Entrar</span>
                <span x-show="loading">Aguarde...</span>
            </button>
        </form>

        <p class="footer-note">
            Ainda não possui uma conta?
            <a href="{{ route('register', ['tenant' => tenant('id')]) }}">
                Criar cadastro
            </a>
        </p>

        <p class="footer-note">
            Acesso restrito à empresa
            <strong>{{ tenant('id') }}</strong>.
        </p>
    </main>

    <script>
        function loginForm() {
            return {
                email: @js(old('email', '')),
                tenants: [],
                selectedTenant: @js(old('tenant_id', '')),
                loading: false,
                tenantError: '',
                emailNotFound: false,
                apiError: '',
                requestId: 0,

                get selectedTenantData() {
                    return this.tenants.find(
                        tenantItem =>
                            tenantItem.tenant_id === this.selectedTenant
                    ) ?? null;
                },

                init() {
                    const email = this.email.trim();

                    if (email && email.includes('@')) {
                        this.fetchTenants();
                    }
                },

                async fetchTenants() {
                    const email = this.email.trim();

                    this.tenantError = '';
                    this.apiError = '';
                    this.emailNotFound = false;
                    this.tenants = [];
                    this.selectedTenant = '';

                    if (!email || !email.includes('@')) {
                        return;
                    }

                    const currentRequestId = ++this.requestId;
                    this.loading = true;

                    try {
                        const response = await fetch(
                            @js(route('api.buscar-empresa-email')),
                            {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': @js(csrf_token()),
                                },
                                body: JSON.stringify({
                                    email: email,
                                }),
                            }
                        );

                        const data = await response.json();

                        if (currentRequestId !== this.requestId) {
                            return;
                        }

                        if (!response.ok) {
                            throw new Error(
                                data.message ??
                                'Não foi possível consultar o e-mail.'
                            );
                        }

                        this.tenants = Array.isArray(data.tenants)
                            ? data.tenants
                            : [];

                        if (this.tenants.length === 0) {
                            this.emailNotFound = true;
                            this.tenantError =
                                'Você precisa se registrar antes de fazer login.';
                            return;
                        }

                        const oldTenant = @js(old('tenant_id', ''));
                        const oldTenantExists = this.tenants.some(
                            tenantItem => tenantItem.tenant_id === oldTenant
                        );

                        if (oldTenantExists) {
                            this.selectedTenant = oldTenant;
                        } else if (this.tenants.length === 1) {
                            this.selectedTenant =
                                this.tenants[0].tenant_id;
                        }
                    } catch (error) {
                        console.error('Erro ao buscar tenants:', error);

                        this.tenants = [];
                        this.selectedTenant = '';
                        this.emailNotFound = false;
                        this.apiError = error.message ??
                            'Não foi possível buscar as empresas.';
                    } finally {
                        if (currentRequestId === this.requestId) {
                            this.loading = false;
                        }
                    }
                },

                validateTenant(event) {
                    this.tenantError = '';

                    if (this.emailNotFound || this.tenants.length === 0) {
                        event.preventDefault();
                        this.tenantError =
                            'Você precisa se registrar antes de fazer login.';
                        return false;
                    }

                    if (this.tenants.length > 1 && !this.selectedTenant) {
                        event.preventDefault();
                        this.tenantError =
                            'Selecione uma empresa para continuar.';
                        return false;
                    }

                    return true;
                },
            };
        }
    </script>
</body>
</html>
