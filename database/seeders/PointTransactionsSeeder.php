<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PointTransactions;
use Illuminate\Database\Seeder;
use App\Models\LoyaltyPoints;

class PointTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $lowestPointPerTransaction = 1;
        $highestPointPerTransaction = 150;

        $batches = LoyaltyPoints::where('expired_date', '>=', now())
                                ->get();
        foreach ($batches as $batch) {
            $totalUsed = PointTransactions::where('loyalty_point_id', $batch->id)
                ->sum('used_point');

            $remaining = $batch->initial_point - $totalUsed;

            if ($remaining <= 0) {
                continue;
            }

            $targetUsage = rand(0, $remaining);

            while ($remaining > 0 && $targetUsage > 0) {

                $max = min($highestPointPerTransaction, $remaining, $targetUsage);
                if ($max < $lowestPointPerTransaction) {
                    break;
                }
                $used = rand($lowestPointPerTransaction, $max);

                $totalNow = PointTransactions::where('loyalty_point_id', $batch->id)
                                                ->sum('used_point');
                $realRemaining = $batch->initial_point - $totalNow;
                if ($realRemaining <= 0) {
                    break;
                }
                if ($used > $realRemaining) {
                    $used = $realRemaining;
                }

                PointTransactions::create([
                    'loyalty_point_id' => $batch->id,
                    'used_point' => $used,
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);

                $remaining -= $used;
                $targetUsage -= $used;
            }
        }
    }
}
