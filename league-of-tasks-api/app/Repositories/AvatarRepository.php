<?php

namespace App\Repositories;

use App\Models\Avatar;

class AvatarRepository
{
    // Get all avatars.
    public function getAll()
    {
        return Avatar::all();
    }

    // Get an avatar by ID.
    public function getById($id)
    {
        return Avatar::findOrFail($id);
    }

    // Create a new avatar.
    public function create(array $data)
    {
        return Avatar::create($data);
    }

    // Update an avatar by ID.
    public function update($id, array $data)
    {
        $avatar = Avatar::findOrFail($id);
        $avatar->update($data);
        return $avatar;
    }

    // Delete an avatar by ID.
    public function delete($id)
    {
        $avatar = Avatar::findOrFail($id);
        return $avatar->delete();
    }
    
    // Get Available avatar for user 
    public function getAvatarsByLevel(int $userLevel)
    {
        return Avatar::where('level_required', '<=', $userLevel)->get();
    }
    
}
