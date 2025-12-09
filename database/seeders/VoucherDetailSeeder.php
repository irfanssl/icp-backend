<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VoucherDetail;
use App\Models\Voucher;
use App\Models\User;

class VoucherDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $vouchers = Voucher::all();

        foreach ($users as $user) {
            // setiap user dapat 1-3 voucher random
            $ownedVouchers = $vouchers->random(rand(1, 3));

            foreach ($ownedVouchers as $voucher) {
                // ambil nominal sesuai level voucher menggunakan enum
                $nominals = $voucher->level->nominal();

                foreach ($nominals as $nominal) {
                    // Simulasi: tidak semua detail disediakan
                    if (rand(0, 10) < 3) continue;

                    VoucherDetail::create([
                        'voucher_id' => $voucher->id,
                        'user_id'    => $user->id,
                        'nominal'    => $nominal,
                        'is_used'    => rand(0, 1) === 0 ? false : true,
                    ]);
                }
            }
        }
    }
}
