<?php

namespace Database\Factories;

use App\Models\Gateway;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant>
 */
class MerchantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'external_id' => fake()->randomNumber(4),
            'external_key' => Str::random(16),
            'user_id' => User::all()->random(),
            'gateway_id' => Gateway::all()->random(),
        ];
    }
}
