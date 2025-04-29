<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeagueSeeder extends Seeder
{

    
    public function run(): void
    {
        DB::table('leagues')->insert([
            [
                'league_name' => 'Unranked',
            ],
            [
                'league_name' => 'Bronze',
            ],
            [
                'league_name' => 'Silver',
            ],
            [
                'league_name' => 'Gold',
            ],
            [
                'league_name' => 'Diamond',
            ]
        ]);
    }
}
