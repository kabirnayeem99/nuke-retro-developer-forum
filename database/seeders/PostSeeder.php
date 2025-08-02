<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Thread;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Thread::all()->each(function ($thread) {
            Post::factory(rand(3, 10))->create([
                'thread_id' => $thread->id,
                'user_id' => $thread->user_id, 
            ]);
        });
    }
}
