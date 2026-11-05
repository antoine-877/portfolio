<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'summary' => fake()->sentence(12),
            'content' => '<p>' . fake()->paragraph() . '</p>',
            'demo_url' => fake()->url(),
            'repo_url' => 'https://github.com/' . fake()->userName() . '/' . Str::slug($title),
            'published_at' => now(),
            'position' => 0,
        ];
    }

    public function draft(): static
    {
        return $this->state(['published_at' => null]);
    }
}
