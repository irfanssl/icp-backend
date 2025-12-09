<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoyaltyPoints;
use App\Models\User;

class LoyaltyPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * this LoyaltyPointsSeeder doesn't need factory
         * because the the unique pair customer_id and bathch_code is done by calling Model::firstOrCreate()
         */


        $batchCodes = ['PROMO_JAN_2025', 'PROMO_FEB_2025', 'PROMO_MAR_2025'];
        $customerIds = User::pluck('id')->toArray();

        foreach ($customerIds as $customerId) {
            foreach ($batchCodes as $batchCode) {

                $isExpired = fake()->boolean;
                if($isExpired){
                    $expiredDate = now()->addMonths(rand(1,3))->toDateTimeString();
                }else{
                    $expiredDate = now()->subWeeks(rand(1,3))->toDateTimeString();
                }

                LoyaltyPoints::firstOrCreate([
                    'customer_id' => $customerId,
                    'batch_code'  => $batchCode,
                ],[
                    'expired_date'  => $expiredDate,
                    'initial_point' => rand(10, 300),
                ]);
            }
        }
    }
}
