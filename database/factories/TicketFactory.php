<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        $userId = User::inRandomOrder()->first()->id;
        $uniqueTicketNo = $userId . now()->format('ymd') . random_int(10, 99);

        $status = $this->faker->randomElement([1, 2]); // 1 => open, 2 => closed
        $closedAt = $status === 2 ? $this->faker->dateTimeBetween('-1 months', 'now') : null;

        $comment = $status === 2 ? $this->faker->sentence() : null;

        return [
            'ticket_no' => $uniqueTicketNo,
            'user_id' => $userId,
            'title' =>  $this->faker->word(3),
            'description' =>  $this->faker->paragraph(),
            'status' => $status,
            'agent_id' => 1,
            'comment' => $comment,
            'closed_at' => $closedAt,
            'created_at' => now()
        ];
    }
}