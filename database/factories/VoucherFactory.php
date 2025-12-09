<?php

namespace Database\Factories;

use App\Enums\VoucherLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $level = VoucherLevel::all();
        return [
            'level' => $this->faker->randomElement($level),
            'expired_at' => $this->faker->dateTimeBetween('-15 days', '+30 days'),
        ];
    }

    public function notExpired()
    {
        return $this->state(fn () => [
            'expired_at' => now()->addDays(rand(1, 30)),
        ]);
    }

    public function expired()
    {
        return $this->state(fn () => [
            'expired_at' => now()->subDays(rand(1, 30)),
        ]);
    }
}
