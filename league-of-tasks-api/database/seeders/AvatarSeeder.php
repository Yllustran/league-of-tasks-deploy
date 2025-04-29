<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvatarSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('avatars')->insert([
            [
                'avatar_name' => 'Green',
                'avatar_url' => 'storage/avatars/avatar-green.png',
                'level_required' => 0
            ],
            [
                'avatar_name' => 'Blue',
                'avatar_url' => 'storage/avatars/avatar-blue.png',
                'level_required' => 0
            ],
            [
                'avatar_name' => 'Red',
                'avatar_url' => 'storage/avatars/avatar-red.png',
                'level_required' => 0
            ]
        ]);
    }
}
