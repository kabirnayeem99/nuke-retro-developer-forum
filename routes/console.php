<?php

use App\Models\Thread;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



Artisan::command('generate:posts', function () {
    $threads = Thread::all();

    if ($threads->isEmpty()) {
        $this->error('No threads found to generate posts for.');
        return;
    }

    foreach ($threads as $thread) {
        \App\Jobs\GenerateRandomPosts::dispatch($thread);
        $this->info('Random post generated for thread: ' . $thread->id);
    }
})->purpose('Generate random posts for all threads');

app()->booted(function () {
    Schedule::command('generate:posts')->everySecond();
});