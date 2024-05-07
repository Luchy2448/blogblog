<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $published = $this->faker->randomElement([true, false]);
        $published_at = $published ? $this->faker->dateTimeBetween('-1 year', 'now') : null;
        $name = $this->faker->unique()->sentence();
        return [
            //
            'title' => $name,
            'slug' => Str::slug($name),
            'excerpt' => $this->faker->text(200),
            'body' => $this->faker->text(2000),
            'image_path' => $this->faker->imageUrl(1280, 720),
            'published' => $published,
            'user_id' => rand(1, 20),
            'category_id' => rand(1, 5),
            'published_at' => $published_at,
        ];
    }
}
