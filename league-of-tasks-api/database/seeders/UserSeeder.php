<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password123'),
                'xp' => 0,
                'gold' => 0,
                'level' => 1,
                'physical_disabled' => false,
                'vision_impairment' => false,
                'task_season' => 0,
                'role_id' => 1, // Admin
                'league_id' => 1, // Unranked
                'avatar_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'UserVision',
                'email' => 'user1@user.com',
                'password' => Hash::make('password123'),
                'xp' => 0,
                'gold' => 0,
                'level' => 1,
                'physical_disabled' => false,
                'vision_impairment' => true,
                'task_season' => 0,
                'role_id' => 2, // User
                'league_id' => 1, // Unranked
                'avatar_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'UserPhysical',
                'email' => 'user2@user.com',
                'password' => Hash::make('password123'),
                'xp' => 0,
                'gold' => 0,
                'level' => 1,
                'physical_disabled' => true,
                'vision_impairment' => false,
                'task_season' => 0,
                'role_id' => 2, // User
                'league_id' => 1, // Unranked
                'avatar_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
