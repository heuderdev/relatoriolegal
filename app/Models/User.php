<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_default_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class)
            ->using(TenantUser::class)
            ->withPivot([
                'role',
                'status',
                'joined_at',
            ])
            ->withTimestamps();
    }

    public function defaultTenant(): BelongsTo
    {
        return $this->belongsTo(
            Tenant::class,
            'tenant_default_id'
        );
    }

    public function belongsToTenant(
        int $tenantId
    ): bool {
        return $this->tenants()
            ->whereKey($tenantId)
            ->wherePivot('status', 'active')
            ->exists();
    }


    public function sentTenantInvitations(): HasMany
{
    return $this->hasMany(
        TenantInvitation::class,
        'invited_by'
    );
}
}
