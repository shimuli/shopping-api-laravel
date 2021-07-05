<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(1),
            'quantity' => $this->faker->numberBetween(1,10),
            'price'=>$this->faker->numberBetween(300,50000),
            'status' => $this->faker->randomElement([Products::AVAILABLE_PRODUCT, Products::UNAVAILABLE_PRODUCT]),
           'image' => $this->faker->randomElement(['1.png','2.png','3.png']),
            'seller_id' => User::all()->random()->id,

        ];
    }
}
