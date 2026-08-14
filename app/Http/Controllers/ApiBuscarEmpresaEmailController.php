<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiBuscarEmpresaEmailController extends Controller
{
     public function handle(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => [
                'required',
                'email',
            ],
        ]);

        $empresas = User::query()
            ->where('email', $data['email'])
            ->whereNotNull('tenant_id')
            ->select([
                'tenant_id',
                'name',
                'email',
                'role',
            ])
            ->get();

        return response()->json([
            'tenants' => UserResource::collection($empresas),
        ]);
    }
}
