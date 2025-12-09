<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TicketStatus;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => User::inRandomOrder()->first()->id,
            'subject' => $this->faker->sentence(5),
            'status' => $this->faker->randomElement(
                array_column(TicketStatus::cases(), 'name')
            )
        ];
    }

    public function active()
    {
        return $this->state(fn () => [
                    'status' => $this->faker->randomElement([
                        TicketStatus::OPEN->name,
                        TicketStatus::IN_PROGRESS->name
                    ])
                ]);
    }
}
