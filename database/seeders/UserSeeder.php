<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(['role' => User::ROLE_CANDIDATE])->count(50)->hasCandidate(1)->create();
        User::factory(['role' => User::ROLE_EMPLOYER])->count(50)->hasEmployer(1)->create();
    }
}
