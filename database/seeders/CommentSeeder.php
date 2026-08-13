<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            'Excelente publicação!',
            'Muito bom conteúdo.',
            'Obrigado por compartilhar essas informações.',
        ];

        $posts = Post::all();

        foreach ($posts as $post) {
            foreach ($comments as $content) {
                Comment::firstOrCreate(
                    [
                        'post_id' => $post->id,
                        'content' => $content,
                    ],
                    [
                        'approved' => true,
                    ]
                );
            }
        }
    }
}