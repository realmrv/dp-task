<?php

namespace Database\Factories;

use App\Models\Merchant;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $amount = fake()->randomNumber(4);

        return [
            'external_id' => fake()->randomNumber(4),
            'status' => fake()->randomElement([
                'completed',
                'created',
                'in-progress',
            ]),
            'amount' => $amount,
            'amount_paid' => fake()->numberBetween(int2: $amount),
            'merchant_id' => Merchant::all()->random()->id,
            'created_at' => fake()->dateTimeBetween('-5 days'),
        ];
    }
}
