<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'is_active' => true,
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1, 200),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'weight' => $this->faker->numberBetween(500, 1000),
            'min_weight' => $this->faker->numberBetween(1, 500),
            'country_origin' => $this->faker->country(),
            'quality' => $this->faker->word(),
            'check' => $this->faker->word(),
            'category_id' => Category::all()->random()->id
        ];
    }
}
