<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TicketAssignment;
use Illuminate\Database\Seeder;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;

class TicketAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = Ticket::all();
        $agents  = User::all();

        foreach ($tickets as $ticket) {

            // random number of switches (1–3 agent)
            $switchCount = min(rand(1, 3), $agents->count());

            $usedAgents = [];

            for ($i = 0; $i < $switchCount; $i++) {

                // prevent same agent for one ticket
                do {
                    $agent = $agents->random();
                } while (in_array($agent->id, $usedAgents));

                $usedAgents[] = $agent->id;

                $assignedAt = now()->subDays(rand(10, 30));

                // Create ACTIVE assignment
                $assignment = TicketAssignment::create([
                    'ticket_id' => $ticket->id,
                    'agent_id' => $agent->id,
                    'assigned_at' => $assignedAt,
                    'unassigned_at' => null
                ]);

                if ($i < $switchCount - 1) {
                    $assignment->update([
                        'unassigned_at' => now()->subDays(rand(1, 9))
                    ]);
                }
            }

            // If ticket SOLVED / CLOSED → no active assignment allowed
            if (in_array($ticket->status, [
                TicketStatus::SOLVED->name,
                TicketStatus::CLOSED->name
            ])) {
                TicketAssignment::where('ticket_id', $ticket->id)
                    ->whereNull('unassigned_at')
                    ->update([
                        'unassigned_at' => now()
                    ]);
            }
        }
    }
}
