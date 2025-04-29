<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Get all users.
    public function index(): JsonResponse
    {
        return response()->json($this->userService->getAllUsers(), 200);
    }

    // Get a specific user by ID.
    public function show($id): JsonResponse
    {
        try {
            $user = $this->userService->getUserById($id);
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    //  Update an existing user.
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'username' => 'sometimes|string|max:150',
                'email' => 'sometimes|email|unique:users,email,' . $id,
                'password' => 'sometimes|nullable|string|min:6',
                'physical_disabled' => 'sometimes|boolean',
                'vision_impairment' => 'sometimes|boolean',
            ]);
    
            // Prevent modification of protected fields
            unset($validatedData['xp']); 
            unset($validatedData['gold']); 
            unset($validatedData['level']); 
            unset($validatedData['task_season']); 
            unset($validatedData['role_id']); 
            unset($validatedData['league_id']);
    
            // do not erase password if password field is empty
            if (empty($validatedData['password'])) {
                unset($validatedData['password']); 
            }
    
            $user = $this->userService->updateUser($id, $validatedData);
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    

    // Delete a user.
    public function destroy($id): JsonResponse
    {
        try {
            $this->userService->deleteUser($id);
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar_id' => 'required|exists:avatars,id', // Check if avatar exist
        ]);
    
        $user = $request->user(); // Retriev auth user 
        $user->avatar_id = $request->avatar_id; // update avatar
        $user->save(); // save in base
    
        return response()->json([
            'message' => 'Avatar mis à jour avec succès.',
            'avatar_id' => $user->avatar_id,
        ], 200);
    }

    public function updateAccessibility(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'physical_disabled' => 'required|boolean',
            'vision_impairment' => 'required|boolean',
        ]);
    
        $userId = Auth::id();
        $response = $this->userService->updateUserAccessibility($userId, $validatedData);
    
        return response()->json($response, 200);
    }
}

