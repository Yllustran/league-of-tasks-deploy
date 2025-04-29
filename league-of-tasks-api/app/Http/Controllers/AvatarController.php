<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;
use App\Services\AvatarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AvatarController extends Controller
{
    protected $avatarService;

    public function __construct(AvatarService $avatarService)
    {
        $this->avatarService = $avatarService;
    }

    // Get all avatars.
    public function index(): JsonResponse
    {
        return response()->json($this->avatarService->getAllAvatars(), 200);
    }

    // Get a specific avatar by ID.
    public function show(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->avatarService->getAvatarById($id));
    }

    // Create a new avatar.
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'avatar_name' => 'required|string|max:150',
            'avatar_url' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Accept only images
            'level_required' => 'required|integer|min:0'
        ]);
    
        // stock image and retrieve image path
        $path = $request->file('avatar_url')->store('avatars', 'public');
    
        // create a new avatar with the image path
        $avatar = Avatar::create([
            'avatar_name' => $validatedData['avatar_name'],
            'avatar_url' => 'storage/' . $path,
            'level_required' => $validatedData['level_required'],
        ]);
    
        return response()->json($avatar, 201);
    }

    // Update an existing avatar.
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->handleNotFound(function () use ($request, $id) {
            $validatedData = $request->validate([
                'avatar_name' => 'required|string|max:150',
                'avatar_url' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048', // Accept only images
                'level_required' => 'sometimes|integer|min:0',
            ]);

            return $this->avatarService->updateAvatar($id, $validatedData);
        });
    }

    // Delete an avatar.
    public function destroy(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->avatarService->deleteAvatar($id), 'Avatar deleted successfully', 204);
    }

    // Centralized 404 error handling
    private function handleNotFound(callable $callback, string $successMessage = null, int $successStatus = 200): JsonResponse
    {
        try {
            $result = $callback();
    
            // If the deletion returns 1 (success), display a confirmation message
            if ($successStatus === 204 && $result) {
                return response()->json(['message' => $successMessage ?? 'Avatar deleted successfully'], 200);
            }
    
            return $successMessage 
                ? response()->json(['message' => $successMessage], $successStatus) 
                : response()->json($result, $successStatus);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Avatar not found'], 404);
        }
    }

    public function getAvailableAvatars(Request $request): JsonResponse
    {
        $user = $request->user(); 
        $availableAvatars = $this->avatarService->getAvailableAvatars($user->level);
    
        return response()->json($availableAvatars, 200);
    }
    
}
