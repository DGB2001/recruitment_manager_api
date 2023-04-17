<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Candidate;
use App\Models\User;

class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::all()->pluck('id')->toArray();
        return [
            'user_id' => $userId[array_rand($userId)],
            'name' => $this->faker->name(),
            'gender' => array_rand(Candidate::$genders),
            'phone_number' => $this->faker->unique()->numerify('09########'),
            'address' => $this->faker->address(),
        ];
    }
}
