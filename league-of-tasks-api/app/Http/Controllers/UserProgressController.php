<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Services\LevelService;

class UserProgressController extends Controller
{
    protected $levelService;

    public function __construct(LevelService $levelService)
    {
        $this->levelService = $levelService;
    }

    // Get user XP and progression
    public function getUserProgress(): JsonResponse
    {
        $user = Auth::user();
        $levelData = $this->levelService->checkLevelUp($user);

        return response()->json([
            'level' => $user->level,
            'xp' => $user->xp,
            'xp_needed_for_next_level' => $levelData['xp_needed_for_next_level'],
        ]);
    }
}
