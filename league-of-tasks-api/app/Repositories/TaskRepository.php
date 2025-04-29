<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    // Get all tasks.
    public function getAll()
    {
        return Task::all();
    }

    // Get a task by ID.
    public function getById($id)
    {
        return Task::findOrFail($id);
    }

    // Create a new task.
    public function create(array $data)
    {
        return Task::create($data);
    }

    // Update a task by ID.
    public function update($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    // Delete a task by ID.
    public function delete($id)
    {
        $task = Task::findOrFail($id);
        return $task->delete();
    }

    // Get all tasks by Interest ID.
    public function getAllByInterestId($interestId)
    {
        return Task::where('interest_id', $interestId)->get();
    }

    public function getFilteredTasks(array $interestIds, bool $physicalDisabled, bool $visionImpaired)
    {
        return Task::whereIn('interest_id', $interestIds)
            ->when($physicalDisabled, function ($query) {
                return $query->where('mobility_req', false);
            })
            ->when($visionImpaired, function ($query) {
                return $query->where('vision_req', false);
            })
            ->get();
    }
}
