<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

    // Create a new user in table USERS
    public function createUser(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), 
            'xp' => $data['xp'],
            'gold' => $data['gold'],
            'level' => $data['level'],
            'physical_disabled' => $data['physical_disabled'],
            'vision_impairment' => $data['vision_impairment'],
            'task_season' => $data['task_season'],
            'role_id' => $data['role_id'],
            'league_id' => $data['league_id'],
            'avatar_id' => $data['avatar_id'],
        ]);
    }
}
