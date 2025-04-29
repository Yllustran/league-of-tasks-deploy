<?php

namespace App\Services;

use App\Repositories\AvatarRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AvatarService
{
    protected $avatarRepository;

    public function __construct(AvatarRepository $avatarRepository)
    {
        $this->avatarRepository = $avatarRepository;
    }

    // Retrieve all avatars.
    public function getAllAvatars()
    {
        return $this->avatarRepository->getAll();
    }

    // Retrieve a single avatar by ID.
    public function getAvatarById($id)
    {
        $avatar = $this->avatarRepository->getById($id);
        if (!$avatar) {
            throw new ModelNotFoundException("Avatar not found.");
        }
        return $avatar;
    }

    // Create a new avatar.
    public function createAvatar(array $data)
    {
        return $this->avatarRepository->create($data);
    }

    // Update an existing avatar.
    public function updateAvatar($id, array $data)
    {
        $avatar = $this->avatarRepository->update($id, $data);
        if (!$avatar) {
            throw new ModelNotFoundException("Avatar not found.");
        }
        return $avatar;
    }

    // Delete an avatar by ID.
    public function deleteAvatar($id)
    {
        $avatar = $this->avatarRepository->getById($id);

        if (!$avatar) {
            throw new ModelNotFoundException("Avatar not found.");
        }

        // Delete the associated image if there is one
        if ($avatar->avatar_url) {
            $imageFullPath = storage_path('app/public/' . str_replace('storage/', '', $avatar->avatar_url));
            if (file_exists($imageFullPath)) {
                unlink($imageFullPath);
            }
        }

        // Now delete the avatar from the database
        return $this->avatarRepository->delete($id);
    }

    public function getAvailableAvatars(int $userLevel)
    {
        return $this->avatarRepository->getAvatarsByLevel($userLevel);
    }
}
