<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserTaskRepository
{
    // Remove all tasks assigned to a user.
    public function removeUserTasks(int $userId)
    {
        DB::table('users_tasks')->where('user_id', $userId)->delete();
    }

    // Assign tasks to a user.
    public function assignTasksToUser(int $userId, $tasks)
    {
        $data = [];

        foreach ($tasks as $task) {
            $data[] = [
                'user_id' => $userId,
                'task_id' => $task->id,
                'is_completed' => 0,
                'created_at' => now(),
            ];
        }

        DB::table('users_tasks')->insert($data);
    }

    public function getUserTasks(int $userId)
    {
    return DB::table('users_tasks')
        ->join('tasks', 'users_tasks.task_id', '=', 'tasks.id')
        ->where('users_tasks.user_id', $userId)
        ->select('tasks.*', 'users_tasks.is_completed', 'users_tasks.created_at')
        ->get();
    }

    public function markTaskAsCompleted(int $userId, int $taskId)
    {
        $updated = DB::table('users_tasks')
            ->where('user_id', $userId)
            ->where('task_id', $taskId)
            ->update(['is_completed' => true]);
    
        return $updated ? true : false; // Return bool
    }

}