<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(Request $request): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
            'remember' => [
                'nullable',
                'boolean',
            ],
        ]);

        $currentTenantId = (string) tenant('id');



        $user = User::query()
            ->where('email', $credentials['email'])
            ->where('tenant_id', $currentTenantId)
            ->first();



        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'E-mail ou senha inválidos para esta empresa.',
                ]);
        }

        Auth::login(
            $user,
            $request->boolean('remember')
        );

        $request->session()->regenerate();

        $request->session()->put(
            'authenticated_tenant_id',
            $currentTenantId
        );

        return redirect()->route('tenant.dashboard', [
            'tenant' => $currentTenantId,
        ]);
    }
}
