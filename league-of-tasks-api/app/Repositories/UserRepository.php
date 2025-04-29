<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    // Get all users.
    public function getAll()
    {
        return User::all();
    }

    // Get a user by ID.
    public function getById($id)
    {
        return User::find($id);
    }

    // Create a new user.
    public function create(array $data)
    {
        return User::create($data);
    }

    // Update a user by ID.
    public function update($id, array $data)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
    
        // Hash password only if password is not empty
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
    
        $user->update($data);
        return $user;
    }

    // Delete a user by ID
    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }
        return $user->delete();
    }

    public function updateAccessibility(int $userId, array $accessibilityData): void
    {
        User::where('id', $userId)->update([
            'physical_disabled' => $accessibilityData['physical_disabled'],
            'vision_impairment' => $accessibilityData['vision_impairment']
        ]);
    }
}

