<?php

namespace App\Http\Controllers;

use App\Services\LeagueService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class LeagueController extends Controller
{
    protected $leagueService;

    public function __construct(LeagueService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    // Get all leagues.
    public function index(): JsonResponse
    {
        return response()->json($this->leagueService->getAllLeagues(), 200);
    }

    // Get a specific league by ID.
    public function show(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->leagueService->getLeagueById($id));
    }

    // Create a new league.
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'league_name' => 'required|string|max:150',
            'league_description' => 'nullable|string'
        ]);

        return response()->json($this->leagueService->createLeague($validatedData), 201);
    }

    // Update an existing league.
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->handleNotFound(function () use ($request, $id) {
            $validatedData = $request->validate([
                'league_name' => 'required|string|max:150',
                'league_description' => 'nullable|string'
            ]);

            return $this->leagueService->updateLeague($id, $validatedData);
        });
    }

    // Delete a league.
    public function destroy(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->leagueService->deleteLeague($id), 'League deleted successfully', 204);
    }

    // Centralized 404 error handling
    private function handleNotFound(callable $callback, string $successMessage = null, int $successStatus = 200): JsonResponse
    {
        try {
            $result = $callback();
    
            // If the deletion returns 1 (success), display a confirmation message
            if ($successStatus === 204 && $result) {
                return response()->json(['message' => $successMessage ?? 'League deleted successfully'], 200);
            }
    
            return $successMessage 
                ? response()->json(['message' => $successMessage], $successStatus) 
                : response()->json($result, $successStatus);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'League not found'], 404);
        }
    }
}
