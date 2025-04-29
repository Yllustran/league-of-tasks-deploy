<?php

namespace App\Services;

use App\Repositories\UserInterestRepository;

class UserInterestService
{
    protected $userInterestRepository;

    public function __construct(UserInterestRepository $userInterestRepository)
    {
        $this->userInterestRepository = $userInterestRepository;
    }


    // Get all interests of a user
    public function getUserInterests($userId)
    {
        return $this->userInterestRepository->getUserInterests($userId);
    }

    // Add interests to a user
    public function addInterestsToUser($userId, array $interestIds)
    {
        if (empty($interestIds)) {
            return response()->json([
                'message' => 'Aucun centre d\'intérêt n\'a été fourni.'
            ], 400);
        }

        // Check if interests exist in the database
        $validInterestIds = $this->userInterestRepository->getExistingInterestIds($interestIds);

        $invalidInterests = array_diff($interestIds, $validInterestIds);
        if (!empty($invalidInterests)) {
            return response()->json([
                'message' => 'un ou plusieurs centres d\'intérêt n\'existent pas.',
                'invalid_interest_ids' => array_values($invalidInterests)
            ], 400);
        }

        // Check if the user already has these interests
        $existingInterestIds = $this->userInterestRepository->getUserInterestIds($userId);
        $newInterests = array_diff($validInterestIds, $existingInterestIds);

        if (empty($newInterests)) {
            return response()->json(['message' => 'Ces centres d\'intérêt sont déjà enregistrés.'], 409);
        }

        // Add new interests
        $this->userInterestRepository->addInterests($userId, $newInterests);

        return [
            'message' => 'Les centres d\'intérêt ont été ajoutés avec succès.',
            'added_interest_ids' => array_values($newInterests)
        ];
    }

    // Remove interests from a user
    public function removeInterestsFromUser($userId, array $interestIds)
    {
        if (empty($interestIds)) {
            return response()->json([
                'message' => 'Aucun centre d\'intérêt n\'a été fourni pour suppression.'
            ], 400);
        }

        $validInterestIds = $this->userInterestRepository->getExistingInterestIds($interestIds);
        $invalidInterests = array_diff($interestIds, $validInterestIds);

        if (!empty($invalidInterests)) {
            return response()->json([
                'message' => 'Certains centres d\'intérêt à supprimer n\'existent pas.',
                'invalid_interest_ids' => array_values($invalidInterests)
            ], 400);
        }

        $this->userInterestRepository->removeInterests($userId, $interestIds);

        return [
            'message' => "Le ou les centres d'intérêt ont bien été supprimés.",
            'deleted_interest_ids' => $interestIds
        ];
    }

    public function updateUserInterests($userId, array $interestIds, bool $replace)
    {
        if ($replace) {
            // Delete all user interests before add new interests
            $this->userInterestRepository->removeAllInterests($userId);
        }

        // add new users interests 
        return $this->addInterestsToUser($userId, $interestIds);
    }
}
