<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'tenant_id' => $this->tenant_id,

            // Valor técnico
            'role' => $this->role,

            // Valor traduzido para exibição
            'role_label' => $this->roleLabel(),

            'cpf_cnpj' => $this->cpf_cnpj,
            'is_admin' => $this->is_admin,
            'permissions' => $this->permissions_json,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
        ];
    }

    private function roleLabel(): string
    {
        return match ($this->role) {
            'administrator' => 'Administrador',
            'tenant_administrator' => 'Administrador da empresa',
            'employee' => 'Funcionário',
            'customer' => 'Cliente',
            default => 'Perfil desconhecido',
        };
    }
}
