<?php

namespace App\Services\LoyaltyPoints;

use App\Models\LoyaltyPoints as LP;
use Illuminate\Support\Facades\DB;

class LoyaltyPoints
{
    public function report(){
        $results =  LP::select([
                        'lp.customer_id',
                        'lp.batch_code',
                        'lp.expired_date',
                        DB::raw('(lp.initial_point - COALESCE(pt.total_used_point, 0)) AS remaining_point')
                    ])
                    ->from('loyalty_points as lp')
                    ->leftJoin(DB::raw('
                        (
                            SELECT loyalty_point_id, SUM(used_point) AS total_used_point
                            FROM point_transactions
                            GROUP BY loyalty_point_id
                        ) as pt
                    '), 'pt.loyalty_point_id', '=', 'lp.id')
                    ->whereDate('lp.expired_date', '>=', now())
                    ->whereRaw('(lp.initial_point - COALESCE(pt.total_used_point, 0)) > 0')
                    ->orderBy('lp.expired_date')
                    ->orderBy('lp.customer_id')
                    ->get();
        return $results;
    }
}