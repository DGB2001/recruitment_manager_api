<?php

namespace Database\Seeders;

use App\Models\MasterLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        DB::table('master_levels')->insert([
            [
                'name' => 'Intern',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Fresher',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Junior',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Middle',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Senior',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Leader',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
