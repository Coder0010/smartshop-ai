<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(mt_rand(2, 4), true);

        return [
            'name'        => ucfirst($name),
            'slug'        => Str::slug($name) . '-' . $this->faker->unique()->lexify('??'),
            'description' => $this->faker->paragraphs(2, true),
            'price'       => $this->faker->randomFloat(2, 5, 499),
            'image'       => 'https://picsum.photos/seed/' . Str::slug($name) . '/600/400',

        ];
    }
}
