<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\MasterLevel;
use App\Models\MasterTechnical;
use App\Models\RecruitmentNews;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Candidate::truncate();
        Employer::truncate();
        MasterLevel::truncate();
        MasterTechnical::truncate();
        RecruitmentNews::truncate();
        Application::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->call([
            UserSeeder::class,
            MasterLevelSeeder::class,
            MasterTechnicalSeeder::class,
            RecruitmentNewsSeeder::class,
            ApplicationSeeder::class,
        ]);
    }
}
