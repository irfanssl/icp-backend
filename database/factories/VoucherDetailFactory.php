<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Voucher;
use App\Enums\VoucherLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VoucherDetail>
 */
class VoucherDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $voucher = Voucher::inRandomOrder()->first();
        return [
            'voucher_id' => Voucher::inRandomOrder()->first()->id,
            'user_id'    => User::inRandomOrder()->first()->id,
            'nominal'    => $this->faker->randomElement($voucher->level->nominal()),
            'is_used'    => $this->faker->boolean(30), // 70% belum dipakai
        ];
    }

    public function unused()
    {
        return $this->state(fn () => ['is_used' => false]);
    }

    public function used()
    {
        return $this->state(fn () => ['is_used' => true]);
    }
}
