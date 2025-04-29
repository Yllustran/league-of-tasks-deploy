<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    // Retrieve all tasks.
    public function getAllTasks()
    {
        return $this->taskRepository->getAll();
    }

    // Retrieve a single task by ID.
    public function getTaskById($id)
    {
        $task = $this->taskRepository->getById($id);
        if (!$task) {
            throw new ModelNotFoundException("Task not found.");
        }
        return $task;
    }

    // Create a new task.
    public function createTask(array $data)
    {
        return $this->taskRepository->create($data);
    }

    // Update an existing task.
    public function updateTask($id, array $data)
    {
        $task = $this->taskRepository->update($id, $data);
        if (!$task) {
            throw new ModelNotFoundException("Task not found.");
        }
        return $task;
    }

    // Delete a task by ID.
    public function deleteTask($id)
    {
        $deleted = $this->taskRepository->delete($id);
        if (!$deleted) {
            throw new ModelNotFoundException("Task not found.");
        }
        return $deleted;
    }

    // Retrieve all tasks by Interest ID.
    public function getAllTasksByInterestId($interestId)
    {
        return $this->taskRepository->getAllByInterestId($interestId);
    }
}
