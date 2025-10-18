<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(5),
            'author' => $this->faker->name(),
            // 'featured_image' => $this->faker->imageUrl(),
            'category' => $this->faker->word(),
            'tags' => implode(',', $this->faker->words(3)),
        ];
    }
}
