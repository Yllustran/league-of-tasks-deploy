<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    // Get all roles.
    public function index(): JsonResponse
    {
        return response()->json($this->roleService->getAllRoles(), 200);
    }

    // Get a specific role by ID.
    public function show(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->roleService->getRoleById($id));
    }

    // Create a new role.
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'role_name' => 'required|string|max:150'
        ]);

        return response()->json($this->roleService->createRole($validatedData), 201);
    }

    // Update an existing role.
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->handleNotFound(function () use ($request, $id) {
            $validatedData = $request->validate([
                'role_name' => 'required|string|max:150'
            ]);

            return $this->roleService->updateRole($id, $validatedData);
        });
    }

    // Delete a role.
    public function destroy(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->roleService->deleteRole($id), 'Role deleted successfully', 204);
    }

    
    private function handleNotFound(callable $callback, string $successMessage = null, int $successStatus = 200): JsonResponse
    {
        try {
            $result = $callback();
    
            // If the deletion returns 1 (success), display a confirmation message
            if ($successStatus === 204 && $result) {
                return response()->json(['message' => $successMessage ?? 'Role deleted successfully'], 200);
            }
    
            return $successMessage 
                ? response()->json(['message' => $successMessage], $successStatus) 
                : response()->json($result, $successStatus);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Role not found'], 404);
        }
    }
}