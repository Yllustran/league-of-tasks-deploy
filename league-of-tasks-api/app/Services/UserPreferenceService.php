<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\UserInterestService;

class UserPreferenceService
{
    protected $userRepository;
    protected $userInterestService;

    public function __construct(UserRepository $userRepository, UserInterestService $userInterestService)
    {
        $this->userRepository = $userRepository;
        $this->userInterestService = $userInterestService;
    }

    // Get user preferences (interests + accessibility settings).
    public function getUserPreferences(int $userId)
    {
        $user = $this->userRepository->getById($userId);
        if (!$user) {
            return null;
        }

        $interests = $this->userInterestService->getUserInterests($userId);

        return [
            'interest_ids' => $interests->pluck('id')->toArray(),
            'physical_disabled' => $user->physical_disabled,
            'vision_impaired' => $user->vision_impairment,
        ];
    }
}
