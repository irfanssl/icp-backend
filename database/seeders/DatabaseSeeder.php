<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,


            /**
             * run LoyaltyPointsSeeder and then run PointTransactionsSeeder
             */
            LoyaltyPointsSeeder::class,
            PointTransactionsSeeder::class,



            /**
             * run TicketSeeder and then run TicketAssignmentSeeder
             */
            TicketSeeder::class,
            TicketAssignmentSeeder::class,
        ]);
    }
}
