<?php

namespace Database\Factories;

use App\Models\Roma\BranchOffice;
use App\Models\Roma\Brand;
use App\Models\Roma\TypeOfBranche;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence,
            'priority' => rand(1,3),
            'category' => 1,
            'subCategory' => 1,
            'management' => Brand::all('id')->random()->id,
            'zone' => TypeOfBranche::all('id')->random()->id,
            'department' => BranchOffice::all('id')->random()->id,
            'applicant' => User::all('id')->random()->id,
            'assigned' => User::all('id')->random()->id,
            'detail' => fake()->paragraph(3, true),
            'state' => fake()->randomElement($array = array(1, 2, 3), $count = 1),
         ];
    }
}
