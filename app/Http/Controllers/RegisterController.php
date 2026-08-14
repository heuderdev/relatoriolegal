<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],

            'cpf_cnpj' => [
                'nullable',
                'string',
                'max:20',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $tenantId = 'empresa_' . Str::uuid()->toString();

        [$tenant, $user] = DB::transaction(function () use (
            $data,
            $tenantId
        ) {
            $tenant = Tenant::create([
                'id' => $tenantId,
                'data' => [
                    'name' => $data['name'],
                    'owner_email' => $data['email'],
                ],
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'tenant_id' => $tenant->id,
                'cpf_cnpj' => $data['cpf_cnpj'] ?? null,
                'is_admin' => true,
                'role' => 'tenant_administrator',
                'permissions_json' => null,
                'password' => Hash::make($data['password']),
            ]);

            return [$tenant, $user];
        });

        Auth::login($user);

        $request->session()->regenerate();

        $request->session()->put(
            'authenticated_tenant_id',
            $tenant->id
        );

        return redirect()->route('tenant.dashboard', [
            'tenant' => $tenant->id,
        ]);
    }
}
