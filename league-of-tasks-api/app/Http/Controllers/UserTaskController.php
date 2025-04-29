<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\TaskRewardService;
use App\Services\TaskAssignmentService;
use App\Services\LevelService;
use App\Repositories\TaskRewardRepository; 
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    protected $taskAssignmentService;
    protected $taskRewardService;
    protected $levelService;
    protected $taskRewardRepository;
    
    public function __construct(
        TaskAssignmentService $taskAssignmentService,
        TaskRewardService $taskRewardService,
        LevelService $levelService,
        TaskRewardRepository $taskRewardRepository 
    ) {
        $this->taskAssignmentService = $taskAssignmentService;
        $this->taskRewardService = $taskRewardService;
        $this->levelService = $levelService;
        $this->taskRewardRepository = $taskRewardRepository;
    }
    
    // Get the tasks assigned to the authenticated user.
    public function getUserTasks(): JsonResponse
    {
        $userId = Auth::id();
        $tasks = $this->taskAssignmentService->getUserTasks($userId);
        return response()->json($tasks, 200);
    }

    // Assign daily tasks to the authenticated user.
    public function assignDailyTasks(): JsonResponse
    {
        $userId = Auth::id();
        $result = $this->taskAssignmentService->assignTasksToUser($userId);
        return response()->json($result, $result['status']);
    }

    // Mark a task as completed and apply rewards
    public function completeTask(int $taskId): JsonResponse
    {
        $userId = Auth::id();
    
        // Mark the task as completed
        $completed = $this->taskAssignmentService->markTaskAsCompleted($userId, $taskId);
    
        if (!$completed) {
            return response()->json(['error' => 'Task not found or already completed'], 404);
        }
    
        // Get task rewards before applying them
        $taskRewards = $this->taskRewardRepository->getTaskRewards($taskId);

        if (!$taskRewards) {
            return response()->json(['error' => 'Invalid task rewards'], 400);
        }
    
        // Apply rewards
        $rewardApplied = $this->taskRewardService->applyTaskRewards($userId, $taskId);
    
        if (!$rewardApplied) {
            return response()->json(['error' => 'Error applying rewards'], 400);
        }
    
        return response()->json([
            'message' => 'Task completed and rewards applied',
            'xp_gained' => $taskRewards->reward_xp, 
            'gold_gained' => $taskRewards->reward_gold, 
        ]);
    }
}
