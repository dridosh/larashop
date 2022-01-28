<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->words(2, true) . ' ' .
                $this->faker->randomNumber() . ' ' .
                $this->faker->words(2, true),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 1, 999999.99),
            'category_id' => Category::get()->random()->id,
            'picture' => 'nopicture.png'
        ];
    }
}
