<?php

namespace Database\Factories;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition()
    {
        $ticket = Ticket::all()->random(1);
        $state = random_int(0,1);

        return [
            'detail' => fake()->paragraph(3, true),
            'ticket_id' => $ticket[0]['id'],
            'user_id' => $state ? $ticket[0]['applicant'] : $ticket[0]['assigned']
        ];
    }
}
