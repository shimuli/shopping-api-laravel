<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\Seller;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transactions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $seller = Seller::has('products')->get()->random();
        $buyer = User::all()->except($seller->id)->random();
        return [
            'quantity' => $this->faker->numberBetween(1, 3),
            'price' => $this->faker->numberBetween(50, 2000),
            'buyer_id' => $buyer->id,
            'product_id' => $seller->products->random()->id,

        ];
    }
}
