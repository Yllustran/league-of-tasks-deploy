<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Services\UserInterestService;

class UserInterestController extends Controller
{
    protected $userInterestService;

    public function __construct(UserInterestService $userInterestService)
    {
        $this->userInterestService = $userInterestService;
    }

    // Get all interests of the authenticated user
    public function index(): JsonResponse
    {
        return response()->json($this->userInterestService->getUserInterests(Auth::id()), 200);
    }


    // Add interests to the authenticated user
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'interest_ids' => 'required|array',
            'interest_ids.*' => 'integer',
        ]);

        return response()->json($this->userInterestService->addInterestsToUser(Auth::id(), $validatedData['interest_ids']), 201);
    }

    // Remove interests from the authenticated user
    public function destroy(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'interest_ids' => 'required|array',
            'interest_ids.*' => 'integer',
        ]);

        return response()->json($this->userInterestService->removeInterestsFromUser(Auth::id(), $validatedData['interest_ids']));
    }

     // Update the user's interests.
     // If `replace` is `true`, all existing interests are removed before adding the new ones.
    public function update(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'interest_ids' => 'required|array',
            'interest_ids.*' => 'integer',
            'replace' => 'sometimes|boolean',
        ]);

        $userId = Auth::id();
        $interestIds = $validatedData['interest_ids'];
        $replace = $validatedData['replace'] ?? false;
        
        // Call the service to handle the update
        $response = $this->userInterestService->updateUserInterests($userId, $interestIds, $replace);

        return response()->json($response, 200);
    }
}
