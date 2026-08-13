<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('tenants')->upsert(
            [
                [
                    'id' => 'empresa1',
                    'created_at' => $now,
                    'updated_at' => $now,
                    'data' => json_encode([
                        'name' => 'Empresa 1',
                        'slug' => 'empresa-1',
                        'active' => true,
                    ], JSON_THROW_ON_ERROR),
                ],
                [
                    'id' => 'empresa2',
                    'created_at' => $now,
                    'updated_at' => $now,
                    'data' => json_encode([
                        'name' => 'Empresa 2',
                        'slug' => 'empresa-2',
                        'active' => true,
                    ], JSON_THROW_ON_ERROR),
                ],
                [
                    'id' => 'empresa3',
                    'created_at' => $now,
                    'updated_at' => $now,
                    'data' => json_encode([
                        'name' => 'Empresa 3',
                        'slug' => 'empresa-3',
                        'active' => true,
                    ], JSON_THROW_ON_ERROR),
                ],
            ],
            ['id'],
            ['updated_at', 'data']
        );
    }
}