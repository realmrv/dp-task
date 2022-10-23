<?php

namespace Database\Seeders;

use App\Models\Gateway;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Merchant::factory()->createMany([
            [
                'external_id' => '6',
                'external_key' => 'KaTf5tZYHx4v7pgZ',
                'user_id' => $user->id,
                'gateway_id' => Gateway::where('code', 'one')->first()->id,
            ],
            [
                'external_id' => '816',
                'external_key' => 'rTaasVHeteGbhwBx',
                'user_id' => $user->id,
                'gateway_id' => Gateway::where('code', 'two')->first()->id,
            ],
        ]);

        Payment::factory(500)->create();
    }
}
