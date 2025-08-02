<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Dev', 'slug' => 'web-dev', 'description' => 'HTTP, HTML, JS, CSS — the raw web.'],
            ['name' => 'Low-Level', 'slug' => 'low-level', 'description' => 'C, assembly, memory layout, and OS internals.'],
            ['name' => 'Linux & CLI', 'slug' => 'linux-cli', 'description' => 'Shell, pipes, dotfiles, and kernel hacking.'],
            ['name' => 'Reverse Engineering', 'slug' => 'reverse-engineering', 'description' => 'Crackmes, disassembly, patching, anti-debug.'],
            ['name' => 'Networking', 'slug' => 'networking', 'description' => 'Packets, ports, proxies, and protocol analysis.'],
            ['name' => 'Golang', 'slug' => 'golang', 'description' => 'Static binaries, goroutines, fast CLIs.'],
            ['name' => 'Rust', 'slug' => 'rust', 'description' => 'Fearless concurrency. Unsafe when needed.'],
            ['name' => 'Android Hacking', 'slug' => 'android-hacking', 'description' => 'APK reversing, Magisk, custom ROMs.'],
            ['name' => 'Web Exploits', 'slug' => 'web-exploits', 'description' => 'XSS, CSRF, LFI, RCE — the classics.'],
            ['name' => 'Self-Hosting', 'slug' => 'self-hosting', 'description' => 'Run your own services. No cloud, no leash.'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
