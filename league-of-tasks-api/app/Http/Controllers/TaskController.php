<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    // Get all tasks.
    public function index(): JsonResponse
    {
        return response()->json($this->taskService->getAllTasks(), 200);
    }

    // Get a specific task by ID.
    public function show(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->taskService->getTaskById($id));
    }

    // Create a new task.
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'task_name' => 'required|string|max:150',
            'mobility_req' => 'required|boolean',
            'vision_req' => 'required|boolean',
            'difficulty' => 'required|in:easy,medium,hard',
            'reward_xp' => 'required|integer|min:0',
            'reward_gold' => 'required|integer|min:0',
            'interest_id' => 'required|exists:interests,id'
        ]);

        return response()->json($this->taskService->createTask($validatedData), 201);
    }

    // Update an existing task.
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->handleNotFound(function () use ($request, $id) {
            $validatedData = $request->validate([
                'task_name' => 'sometimes|required|string|max:150',
                'mobility_req' => 'sometimes|required|boolean',
                'vision_req' => 'sometimes|required|boolean',
                'difficulty' => 'sometimes|required|in:easy,medium,hard',
                'reward_xp' => 'sometimes|required|integer|min:0',
                'reward_gold' => 'sometimes|required|integer|min:0',
                'interest_id' => 'sometimes|required|exists:interests,id'
            ]);

            return $this->taskService->updateTask($id, $validatedData);
        });
    }

    // Delete a task.
    public function destroy(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->taskService->deleteTask($id), 'Task deleted successfully', 204);
    }

    // Get all tasks by Interest ID.
    public function getAllTasksByInterestId(int $interestId): JsonResponse
    {
        return response()->json($this->taskService->getAllTasksByInterestId($interestId), 200);
    }

    // Centralized 404 error handling
    private function handleNotFound(callable $callback, string $successMessage = null, int $successStatus = 200): JsonResponse
    {
        try {
            $result = $callback();
    
            // If the deletion returns 1 (success), display a confirmation message
            if ($successStatus === 204 && $result) {
                return response()->json(['message' => $successMessage ?? 'Task deleted successfully'], 200);
            }
    
            return $successMessage 
                ? response()->json(['message' => $successMessage], $successStatus) 
                : response()->json($result, $successStatus);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }
}
