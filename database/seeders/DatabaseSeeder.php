<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create users
        $users = User::factory(10)->create();

        // Create categories
        $categories = Category::factory(5)->create();

        // Create threads with posts
        $users->each(function ($user) use ($categories) {
            Thread::factory(10)
                ->for($user)
                ->for($categories->random())
                ->create()
                ->each(function ($thread) use ($user) {
                    User::inRandomOrder()->take(rand(3, 8))->get()->each(function ($commenter) use ($thread) {
                        Post::factory()->for($thread)->for($commenter)->create();
                    });
                });
        });
    }
}

