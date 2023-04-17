<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class EmployerFactory extends Factory
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
            'company_name' => $this->faker->words(3, true),
            'phone_number' => $this->faker->unique()->numerify('09########'),
            'address' => $this->faker->address(),
        ];
    }
}
