<?php

namespace Database\Factories;

use App\Models\PointTransactions;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LoyaltyPoints;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PointTransactions>
 */
class PointTransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loyalty = LoyaltyPoints::select('id', 'initial_point')
                                ->get();
        $loyalty = $loyalty->random();
        $usedPoint = 0;
        $randomPoint = fake()->numberBetween(1, $loyalty->initial_point);
        $totalAllPoints = PointTransactions::where('loyalty_point_id', $loyalty->id)
                                            ->sum('used_point');
        $totalAllPoints = (int) $totalAllPoints;
        if($totalAllPoints < $randomPoint){
            $usedPoint = $randomPoint;
        }
        return [
            'loyalty_point_id'  => $loyalty->id,
            'used_point'        => $usedPoint,
            'created_at'        => now()->toDateTimeString()
        ];
    }
}
