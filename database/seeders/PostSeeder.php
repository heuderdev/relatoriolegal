<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'tenant_id' => 'empresa1',
                'title' => 'Bem-vindo à Empresa 1',
                'slug' => 'bem-vindo-a-empresa-1',
                'content' => 'Este é o primeiro post da Empresa 1.',
                'published' => true,
                'published_at' => now(),
            ],
            [
                'tenant_id' => 'empresa1',
                'title' => 'Novidades da Empresa 1',
                'slug' => 'novidades-da-empresa-1',
                'content' => 'Confira as novidades da Empresa 1.',
                'published' => true,
                'published_at' => now(),
            ],
            [
                'tenant_id' => 'empresa2',
                'title' => 'Bem-vindo à Empresa 2',
                'slug' => 'bem-vindo-a-empresa-2',
                'content' => 'Este é o primeiro post da Empresa 2.',
                'published' => true,
                'published_at' => now(),
            ],
            [
                'tenant_id' => 'empresa2',
                'title' => 'Novidades da Empresa 2',
                'slug' => 'novidades-da-empresa-2',
                'content' => 'Confira as novidades da Empresa 2.',
                'published' => true,
                'published_at' => now(),
            ],
            [
                'tenant_id' => 'empresa3',
                'title' => 'Bem-vindo à Empresa 3',
                'slug' => 'bem-vindo-a-empresa-3',
                'content' => 'Este é o primeiro post da Empresa 3.',
                'published' => true,
                'published_at' => now(),
            ],
            [
                'tenant_id' => 'empresa3',
                'title' => 'Novidades da Empresa 3',
                'slug' => 'novidades-da-empresa-3',
                'content' => 'Confira as novidades da Empresa 3.',
                'published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                [
                    'slug' => $post['slug'],
                ],
                $post
            );
        }
    }
}