<?php

namespace App\Services;

use App\Repositories\TaskRewardRepository;
use Illuminate\Support\Facades\DB;
use App\Services\LevelService;
use App\Models\User;

class TaskRewardService
{
    protected $taskRewardRepository;
    protected $levelService;

    public function __construct(TaskRewardRepository $taskRewardRepository, LevelService $levelService)
    {
        $this->taskRewardRepository = $taskRewardRepository;
        $this->levelService = $levelService;
    }

    // Apply task rewards (XP, gold, season progress).
    public function applyTaskRewards(int $userId, int $taskId): array
    {
        DB::beginTransaction();
    
        try {
            // Check if the task is already completed
            if (!$this->taskRewardRepository->isTaskCompleted($userId, $taskId)) {
                DB::rollBack();
                return ['success' => false, 'message' => 'Task not found or already completed'];
            }
    
            // Retrieve task rewards
            $taskRewards = $this->taskRewardRepository->getTaskRewards($taskId);
    
            if (!$taskRewards) {
                DB::rollBack();
                return ['success' => false, 'message' => 'Invalid task rewards'];
            }
    
            // Update XP and gold
            $this->taskRewardRepository->updateUserRewards(
                $userId,
                $taskRewards->reward_xp,
                $taskRewards->reward_gold
            );
    
            // Reload user after update
            $user = User::findOrFail($userId);
    
            // Level-up verification
            $levelData = $this->levelService->checkLevelUp($user);
    
            DB::commit();
    
            return [
                'success' => true,
                'new_xp' => $user->xp,
                'new_level' => $levelData['new_level'],
                'xp_needed_for_next_level' => $levelData['xp_needed_for_next_level'],
            ];
    
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Error applying rewards', 'error' => $e->getMessage()];
        }
    }
    
}