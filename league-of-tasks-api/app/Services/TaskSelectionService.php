<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskSelectionService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    // Get filtered tasks based on interests and accessibility settings.
    public function getFilteredTasks(array $interestIds, bool $physicalDisabled, bool $visionImpaired)
    {
        return $this->taskRepository->getFilteredTasks($interestIds, $physicalDisabled, $visionImpaired);
    }
    
}
