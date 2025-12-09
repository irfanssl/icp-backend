<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketAssignment>
 */
class TicketAssignmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::inRandomOrder()->first()->id,
            'agent_id' => User::inRandomOrder()->first()->id,
            'assigned_at' => now()->subDays(rand(1,30)),
            'unassigned_at' => null, // default active
        ];
    }

     /**
     * inactive assignment
     */
    public function inactive()
    {
        return $this->state(fn () => [
            'unassigned_at' => now()
        ]);
    }
}
