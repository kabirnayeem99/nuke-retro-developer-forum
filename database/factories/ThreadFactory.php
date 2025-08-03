<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    public function definition(): array
    {
        $titlesAndBodies = [
            [
                'title' => 'What’s your must-have tool after a fresh Linux install?',
                'body' => <<<TEXT
Every time I spin up a new Linux box, there are a few tools I install right away. For me, it's `htop`, `ncdu`, `ripgrep`, and `tmux`. Curious what others here can't live without. Do you automate this with a script or config manager like Ansible?
TEXT
            ],
            [
                'title' => 'Jetpack Compose vs XML in real production apps',
                'body' => <<<TEXT
Now that Compose is stable and widely adopted, I’m wondering if it's safe to go all-in for large production apps. Anyone made the switch recently? How was performance, maintainability, and team onboarding? Still keeping some XML?
TEXT
            ],
            [
                'title' => 'Hidden gems in the Linux terminal you probably don’t use',
                'body' => <<<TEXT
We all know `grep`, `sed`, `awk`, but I recently discovered `bat` and `fd`, and they instantly became part of my daily workflow. What are your underrated or lesser-known CLI tools that others should try?
TEXT
            ],
            [
                'title' => 'Creating an Android ROM building pipeline in CI',
                'body' => <<<TEXT
I’ve been experimenting with building custom Android ROMs and want to move builds to CI (GitHub Actions or GitLab). Has anyone automated repo syncing, build caching, and signing? What’s the best storage strategy for huge artifacts?
TEXT
            ],
            [
                'title' => 'Minimalist window managers: Are they worth the effort?',
                'body' => <<<TEXT
I tried switching from GNOME to i3wm and later to dwm. While the control is amazing, I found the config rabbit hole deep. Anyone here using a tiling WM as their daily driver? Any tips for keeping it sane without bloating?
TEXT
            ],
            [
                'title' => 'My switch to Neovim for Android development',
                'body' => <<<TEXT
I ditched Android Studio for a full Neovim + Gradle setup using LSPs and `nvim-dap`. Startup time is instant, and my memory usage dropped dramatically. But there are still pain points. Anyone else doing serious Android dev in Vim?
TEXT
            ]
        ];

        $selected = $this->faker->randomElement($titlesAndBodies);

        return [
            'title' => $selected['title'],
            'body' => $selected['body'],
            'slug' => Str::slug($selected['title']) . '-' . $this->faker->randomNumber(4),
            'pinned' => false,
            'locked' => false,
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }

}
