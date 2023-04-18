<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecruitmentNewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employer_id' => $this->faker->randomElement(\App\Models\Employer::pluck('id')),
            'master_technical_id' => $this->faker->randomElement(\App\Models\MasterTechnical::pluck('id')),
            'master_level_id' => $this->faker->randomElement(\App\Models\MasterLevel::pluck('id')),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraphs($nb = 3, $asText = true),
            'salary' => $this->faker->numberBetween($min = 1000000, $max = 50000000),
            'quantity' => $this->faker->randomDigitNotNull,
            'expired_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
        ];
    }
}
