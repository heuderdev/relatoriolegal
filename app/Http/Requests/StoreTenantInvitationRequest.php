<?php

namespace App\Http\Requests;

use App\Enums\TenantRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTenantInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'create',
            \App\Models\TenantInvitation::class
        );
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'role' => [
                'required',
                Rule::enum(TenantRole::class),
                Rule::notIn([
                    'super_administrador',
                ]),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => mb_strtolower(
                trim($this->input('email'))
            ),
        ]);
    }
}
