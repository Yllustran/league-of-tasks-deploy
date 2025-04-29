<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Avatar;
use App\Models\League;
use Illuminate\Support\Facades\DB;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Interest;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    // Register a new user and return a JWT token.
    public function register(array $data)
    {
        // Normaliser l'email
        $data['email'] = strtolower($data['email']);
    
        $validator = Validator::make($data, [
            'username' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            'physical_disabled' => 'nullable|boolean',
            'vision_impairment' => 'nullable|boolean',
            'task_season' => 'nullable|integer|min:0',
            'interests' => 'array', // 
            'interests.*' => 'exists:interests,id', 
        ]);
    
        if ($validator->fails()) {
            return ['error' => $validator->errors()->first(), 'status' => 400];
        }
    
         // Automatic assigment of default values
        $defaultRole = Role::findOrFail(2);
        $defaultLeague = League::findOrFail(1);
        $defaultAvatar = Avatar::findOrFail(1);
    
        if (!$defaultRole || !$defaultLeague || !$defaultAvatar) {
            return ['error' => 'Configuration error: Default role, league, or avatar is missing.', 'status' => 500];
        }
        
        // Secture values 
        $data['xp'] = 0;
        $data['gold'] = 0;
        $data['level'] = 1; 
        $data['task_season'] = 0; 
        $data['role_id'] = $defaultRole->id;
        $data['league_id'] = $defaultLeague->id;
        $data['avatar_id'] = $defaultAvatar->id;
    
        // Secure registration
        DB::beginTransaction();
        try {
            $user = $this->authRepository->createUser([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'], 
                'xp' => $data['xp'],
                'gold' => $data['gold'],
                'level' => $data['level'],
                'physical_disabled' => $data['physical_disabled'] ?? false,
                'vision_impairment' => $data['vision_impairment'] ?? false,
                'task_season' => $data['task_season'] ?? 0,
                'role_id' => $data['role_id'],
                'league_id' => $data['league_id'],
                'avatar_id' => $data['avatar_id'],
            ]);
    
            // Add interests selected
            if (!empty($data['interests'])) {
                $user->interests()->sync($data['interests']);
            }
    
            $token = JWTAuth::fromUser($user);
            DB::commit();
    
            return ['user' => $user, 'token' => $token, 'status' => 201];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => 'Something went wrong, please try again.', 'status' => 500];
        }
    }

    // Authenticate the user and return a JWT token.
    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return ['error' => 'Invalid credentials', 'status' => 401];
        }

        return ['token' => $token, 'status' => 200];
    }

    // Invalidate the user token (logout).
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return ['message' => 'User successfully logged out', 'status' => 200];
    }

    // GetProfile to the authenticated user.
    public function getProfile()
    {
        try {
            return JWTAuth::parseToken()->authenticate();
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException $e) {
            return ['error' => 'Token has expired', 'status' => 401];
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException $e) {
            return ['error' => 'Token is invalid', 'status' => 401];
        } catch (\Exception $e) {
            return ['error' => 'Could not fetch user', 'status' => 500];
        }
    }

    // Refresh the JWT token.
    public function refreshToken(): JsonResponse
    {
        try {
            // check if token is valide 
            if (!$token = JWTAuth::getToken()) {
                return response()->json(['error' => 'No token provided'], 400);
            }
    
            // Rafresh token
            $newToken = JWTAuth::refresh($token);
    
            return response()->json(['token' => $newToken], 200);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired, please log in again'], 401);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Could not refresh token'], 500);
        }
    }
    

}
