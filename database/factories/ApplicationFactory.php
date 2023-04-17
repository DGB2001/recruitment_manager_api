<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'candidate_id' => $this->faker->randomElement(\App\Models\Candidate::pluck('id')),
            'master_technical_id' => $this->faker->randomElement(\App\Models\MasterTechnical::pluck('id')),
            'master_level_id' => $this->faker->randomElement(\App\Models\MasterLevel::pluck('id')),
            'recruitment_news_id' => $this->faker->randomElement(\App\Models\RecruitmentNews::pluck('id')),
            'title' => $this->faker->jobTitle,
            'content' => implode(',', $this->faker->words($nb = 5)),
            'result' => $this->faker->randomElement([0, 1, null]),
        ];
    }
}
