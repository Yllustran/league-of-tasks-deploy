<?php

namespace App\Http\Controllers;

use App\Services\TaskRewardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskRewardController extends Controller
{
    protected $taskRewardService;

    public function __construct(TaskRewardService $taskRewardService)
    {
        $this->taskRewardService = $taskRewardService;
    }

    // Apply rewards when a task is completed.
    public function applyTaskRewards(int $taskId): JsonResponse
    {
        $userId = Auth::id();
        $result = $this->taskRewardService->applyTaskRewards($userId, $taskId);

        if ($result['success']) {
            return response()->json(['message' => 'Rewards applied successfully'], 200);
        } else {
            return response()->json(['error' => $result['message']], 400);
        }
    }
}