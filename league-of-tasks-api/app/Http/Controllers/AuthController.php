<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Register a new user.
    public function register(Request $request): JsonResponse
    {
        return $this->handleRequest(fn() => $this->authService->register($request->all()), 201);
    }

    // Authenticate the user and return a JWT token.
    public function login(Request $request): JsonResponse
    {
        return $this->handleRequest(fn() => $this->authService->login($request->only('email', 'password')), 200);
    }

    // Log out the user.
    public function logout(): JsonResponse
    {
        return $this->handleRequest(fn() => $this->authService->logout(), 200);
    }

    // Get the authenticated user.
    public function profile(): JsonResponse
    {
        return $this->handleRequest(fn() => $this->authService->getProfile(), 200);
    }

    //  Refresh the JWT token.
    public function refresh(): JsonResponse
    {
        return $this->authService->refreshToken();
    }

    // Centralized response handling.
    private function handleRequest(callable $callback, int $successStatus = 200): JsonResponse
    {
        try {
            $result = $callback();

            // Extract the status if present
            $status = $result['status'] ?? $successStatus;
            unset($result['status']);

            return response()->json($result, $status);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong, please try again.'], 500);
        }
    }
}
