<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{ 
    public function run(): void
    {
        $tenantIds = [
            'empresa1',
            'empresa2',
            'empresa3',
        ];

        foreach (range(1, 15) as $index) {
            $tenantId = $tenantIds[array_rand($tenantIds)];

            User::factory()->create([
                'name' => fake()->name(),
                'email' => "usuario{$index}@example.com",
                'tenant_id' => $tenantId,
            ]);
        }
    }
}