<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(250),
            'price' => $this->faker->randomNumber(3, true),
            'discount' =>  $this->faker->randomNumber(2, true),
            'draft' => '0',
            'product_slug' => 'PD'.Str::random(9),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            
        });
    }
}
