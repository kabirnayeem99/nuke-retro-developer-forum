<?php

namespace App\Jobs;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateRandomPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Thread $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function handle(): void
    {
        $randomCount = rand(10, 15);
        $users = User::inRandomOrder()->take($randomCount)->pluck('id');
        $faker = \Faker\Factory::create();
        $comments = [
            'This really depends on your use case and long-term goals.',
            'Honestly, I think we’re asking the wrong question here.',
            'That’s a trade-off most people don’t consider until it’s too late.',
            'Interesting take — but have you thought about the implications at scale?',
            'I’ve been down this road before. It’s messier than it looks.',
            'It works, but whether it’s sustainable is a different story.',
            'You might want to revisit the assumptions behind that choice.',
            'This aligns with my experience, but it’s not always that simple.',
            'There’s nuance here that often gets overlooked in these discussions.',
            'It’s not about the tool — it’s about how you use it.',
            'Many people underestimate how much context matters in decisions like this.',
            'This feels like a symptom of a deeper architectural issue.',
            'Sometimes the best solution is the one that creates the least friction.',
            'That sounds good on paper, but real-world constraints change everything.',
            'You’re not wrong, but also not entirely right either.',
            'Every abstraction leaks eventually — the question is when and how badly.',
            'Simplicity and correctness often pull in opposite directions.',
            'People keep reinventing the wheel, but forget why the old ones worked.',
            'The problem isn’t technical — it’s cultural.',
            'What’s obvious in hindsight is rarely obvious up front.'
        ];

        foreach ($users as $userId) {
            $this->thread->posts()->create([
                'body' => $faker->randomElement($comments),
                'user_id' => $userId,
            ]);
        }
    }
}
