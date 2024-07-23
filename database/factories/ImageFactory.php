<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $noteable = [
            User::class,
            Post::class,
        ];
        return [
            'url' =>$this->faker->imageUrl($width = 640 ,$higth = 488),
            'imagable_id' =>$this->faker->numberBetween(1.10),
            'imagable_type' =>$this->faker->randomElement($noteable),

        ];
    }
}
