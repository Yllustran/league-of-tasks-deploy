<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Retrieve all users.
    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    // Retrieve a single user by ID.
    public function getUserById($id)
    {
        $user = $this->userRepository->getById($id);
        if (!$user) {
            throw new ModelNotFoundException("User not found.");
        }
        return $user;
    }

    // Create a new user.
    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    // Update an existing user.
    public function updateUser($id, array $data)
    {
        $user = $this->userRepository->update($id, $data);
        if (!$user) {
            throw new ModelNotFoundException("User not found.");
        }
        return $user;
    }

    // Delete a user by ID.
    public function deleteUser($id)
    {
        $deleted = $this->userRepository->delete($id);
        if (!$deleted) {
            throw new ModelNotFoundException("User not found.");
        }
        return $deleted;
    }

    // Update users accessibility param
    public function updateUserAccessibility(int $userId, array $accessibilityData): array
    {

        $this->userRepository->updateAccessibility($userId, $accessibilityData);
    
        return [
            'message' => 'Paramètres d’accessibilité mis à jour avec succès.',
            'physical_disabled' => $accessibilityData['physical_disabled'],
            'vision_impairment' => $accessibilityData['vision_impairment']
        ];
    }
}

