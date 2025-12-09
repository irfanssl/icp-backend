<?php

namespace App\Services\Voucher;

use App\Models\Voucher as Vch;

class Voucher
{
    public function report(){
        $vouchers = Vch::with(['details' => function($query) {
                            $query->where('is_used', false);
                            $query->whereIn('nominal', function($sub) {
                                $sub->selectRaw('MIN(nominal)')
                                    ->from('voucher_details')
                                    ->whereColumn('voucher_id', 'voucher_details.voucher_id');
                            });
                        }])
                        ->where('expired_at', '>=', now()->toDateString())
                        ->orderBy('expired_at', 'asc')
                        ->get();
        return $vouchers;
    }
}