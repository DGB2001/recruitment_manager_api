<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecruitmentNews;

class RecruitmentNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecruitmentNews::factory()->count(50)->create();
    }
}
