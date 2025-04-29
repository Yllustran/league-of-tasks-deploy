<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(LeagueSeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(AvatarSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
