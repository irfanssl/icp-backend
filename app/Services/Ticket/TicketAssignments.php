<?php

namespace App\Services\Ticket;

use Illuminate\Support\Facades\DB;
use App\Models\TicketAssignment;
use App\Enums\TicketStatus;


class TicketAssignments {
    public function totalPerAgent(){
        $results = TicketAssignment::select(
                        'agent_id',
                        DB::raw('COUNT(DISTINCT ticket_id) as active_ticket_count')
                    )
                    ->whereNull('unassigned_at')
                    ->whereHas('ticket', function ($query) {
                        $query->whereNotIn('status', [
                            TicketStatus::SOLVED->name,
                            TicketStatus::CLOSED->name,
                        ]);
                    })
                    ->groupBy('agent_id')
                    ->orderBy('active_ticket_count', 'DESC')
                    ->get();
        return $results;
    }
}