<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => rand(1, 4),
            'title' => fake()->sentence(5),
            'description' => fake()->sentence(20),
            'thumbnail' => 'https://placehold.co/500x500',
            'slug' => fake()->slug(),
            'project_overview' => fake()->sentence(20),
            'project_challenges' => fake()->sentence(20),
            'project_objectives' => fake()->sentence(20),
            'project_final_outcome' => fake()->sentence(20),
            'background' => 'https://placehold.co/1080x500',
        ];
    }
}
