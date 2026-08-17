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
                'unique:users,email',
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

        [$tenant, $user] = DB::transaction(
            function () use ($data): array {
                $tenant = Tenant::create([
                    'uuid' => (string) Str::uuid(),
                    'name' => $data['name'],
                    'slug' => sprintf(
                        '%s-%s',
                        Str::slug($data['name']),
                        Str::lower(Str::random(6))
                    ),
                    'type' => 'company',
                    'status' => 'active',
                    'timezone' => 'America/Sao_Paulo',
                    'locale' => 'pt_BR',
                ]);

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'cpf_cnpj' => $data['cpf_cnpj'] ?? null,
                    'password' => Hash::make(
                        $data['password']
                    ),
                    'tenant_default_id' => $tenant->id,
                ]);

                $tenant->users()->attach($user->id, [
                    'role' => 'owner',
                    'status' => 'active',
                    'joined_at' => now(),
                ]);

                return [
                    $tenant,
                    $user,
                ];
            }
        );

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('teste'        );
    }
}
