<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence;
        $content = fake()->paragraphs(asText: true);
        $created_at = fake()->dateTimeBetween('-1 year');

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => Str::limit($content, 150),
            'content' => $content,
            'thumbnail' => fake()->imageUrl,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
