<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
use App\Enums\VoucherLevel;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Level 1 - sebagian expired, sebagian belum
        Voucher::factory()->count(5)->notExpired()->create([
            'level' => VoucherLevel::LEVEL_1,
        ]);
        Voucher::factory()->count(7)->expired()->create([
            'level' => VoucherLevel::LEVEL_1,
        ]);

        // Level 2
        Voucher::factory()->count(10)->notExpired()->create([
            'level' => VoucherLevel::LEVEL_2,
        ]);
        Voucher::factory()->count(4)->expired()->create([
            'level' => VoucherLevel::LEVEL_2,
        ]);
    }
}
