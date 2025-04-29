<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class TaskRewardRepository
{

    // Check if the task is already completed
    public function isTaskCompleted(int $userId, int $taskId): bool
    {
        return DB::table('users_tasks')
            ->where('user_id', $userId)
            ->where('task_id', $taskId)
            ->where('is_completed', true)
            ->exists();
    }

    // Retrieve task reward 
    public function getTaskRewards(int $taskId)
    {
        return DB::table('tasks')
            ->where('id', $taskId)
            ->select('reward_xp', 'reward_gold')
            ->first();
    }

    // Update XP, gold & task_season for user
    public function updateUserRewards(int $userId, int $xp, int $gold)
    {
        return DB::table('users')
            ->where('id', $userId)
            ->incrementEach([
                'xp' => $xp,
                'gold' => $gold,
                'task_season' => 1,
            ]);
    }
}
