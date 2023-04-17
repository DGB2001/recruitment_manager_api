<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterTechnicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        DB::table('master_technicals')->insert([
            [
                'name' => 'PHP',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'NodeJS',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Golang',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Java',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Python',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '.NET',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
