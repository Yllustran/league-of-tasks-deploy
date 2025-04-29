<?php

namespace App\Http\Controllers;

use App\Services\InterestService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class InterestController extends Controller
{
    protected $interestService;

    public function __construct(InterestService $interestService)
    {
        $this->interestService = $interestService;
    }

    // Get all interests.
    public function index(): JsonResponse
    {
        return response()->json($this->interestService->getAllInterests(), 200);
    }

    // Get a specific interest by ID.
    public function show(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->interestService->getInterestById($id));
    }

    // Create a new interest.
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'interest_name' => 'required|string|max:150',
            'interest_description' => 'nullable|string'
        ]);

        return response()->json($this->interestService->createInterest($validatedData), 201);
    }

    // Update an existing interest.
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->handleNotFound(function () use ($request, $id) {
            $validatedData = $request->validate([
                'interest_name' => 'required|string|max:150',
                'interest_description' => 'nullable|string'
            ]);

            return $this->interestService->updateInterest($id, $validatedData);
        });
    }

    // Delete an interest.
    public function destroy(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->interestService->deleteInterest($id), 'Interest deleted successfully', 204);
    }

    // Centralized 404 error handling
    private function handleNotFound(callable $callback, string $successMessage = null, int $successStatus = 200): JsonResponse
    {
        try {
            $result = $callback();
    
            // If the deletion returns 1 (success), display a confirmation message
            if ($successStatus === 204 && $result) {
                return response()->json(['message' => $successMessage ?? 'Interest deleted successfully'], 200);
            }
    
            return $successMessage 
                ? response()->json(['message' => $successMessage], $successStatus) 
                : response()->json($result, $successStatus);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Interest not found'], 404);
        }
    }
}
