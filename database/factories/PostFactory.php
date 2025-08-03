<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
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

        return [
            'body' => $this->faker->randomElement($comments),
            'thread_id' => Thread::factory(),
            'user_id' => User::factory(),
        ];
    }

}
