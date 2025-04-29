<?php

namespace App\Services;

use App\Repositories\UserTaskRepository;
use App\Services\UserPreferenceService;
use App\Services\TaskSelectionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskAssignmentService
{
    protected $userTaskRepository;
    protected $userPreferenceService;
    protected $taskSelectionService;

    public function __construct(UserTaskRepository $userTaskRepository, UserPreferenceService $userPreferenceService, TaskSelectionService $taskSelectionService)
    {
        $this->userTaskRepository = $userTaskRepository;
        $this->userPreferenceService = $userPreferenceService;
        $this->taskSelectionService = $taskSelectionService;
    }

    // Assign 3 unique tasks to the authenticated user.
    public function assignTasksToUser()
    {
        $userId = Auth::id(); // Use JWT to retrieve user_id

        DB::beginTransaction();

        try {
            $this->userTaskRepository->removeUserTasks($userId);

            // Retrieve user preference (interests, physical, vision)
            $preferences = $this->userPreferenceService->getUserPreferences($userId);
            if (!$preferences) {
                DB::rollBack();
                return ['error' => 'User not found.', 'status' => 404];
            }

            // Retrieve filtered tasks (Accessibility) 
            $tasks = $this->taskSelectionService->getFilteredTasks(
                $preferences['interest_ids'],
                $preferences['physical_disabled'],
                $preferences['vision_impaired']
            );

            if (count($tasks) < 3) {
                DB::rollBack();
                return ['error' => 'Not enough available tasks.', 'status' => 400];
            }

            // Select 3 unique tasks from  `interest_id`
            $selectedTasks = $this->getUniqueInterestTasks($tasks, 3);

            // Insert thoses new tasks 
            $this->userTaskRepository->assignTasksToUser($userId, $selectedTasks);

            DB::commit();
            return ['message' => 'Daily tasks assigned successfully.', 'status' => 201];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => 'Something went wrong.', 'status' => 500];
        }
    }

    // Selects unique tasks ensuring different `interest_id`
    private function getUniqueInterestTasks($tasks, $limit)
    {
        $groupedByInterest = $tasks->groupBy('interest_id'); 
        $selected = collect(); 
    
        foreach ($groupedByInterest->shuffle() as $interestTasks) { 
            if ($selected->count() >= $limit) break;
            $selected->push($interestTasks->random(1)->first()); 
        }
    
        return $selected;
    }
    

        public function getUserTasks(int $userId)
        {
            return $this->userTaskRepository->getUserTasks($userId);
        }

        public function markTaskAsCompleted(int $userId, int $taskId)
        {
            return $this->userTaskRepository->markTaskAsCompleted($userId, $taskId);
        }

}
