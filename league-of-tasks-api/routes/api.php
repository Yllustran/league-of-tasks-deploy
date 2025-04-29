<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\UserTaskController;
use App\Http\Controllers\UserInterestController;
use App\Http\Controllers\UserProgressController;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

// Middleware admin sécurisé
$adminMiddleware = function (Request $request, Closure $next) {
    try {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user || !$user->isAdmin()) {
            return response()->json(['error' => 'Unauthorized. Admin access required.'], 403);
        }

        return $next($request);
    } catch (\Exception $e) { // Capture toutes les erreurs JWT
        return response()->json(['error' => 'Unauthorized.'], 401);
    }
};


// AUTH Routes
Route::post('/register', [AuthController::class, 'register']); // Register a new user 
Route::post('/login', [AuthController::class, 'login']); // Login
Route::post('/contacts', [ContactController::class, 'store']); // send a message from ContactForm


// Midleware Routes with JWT Auth
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // logout 
    Route::post('/refresh', [AuthController::class, 'refresh']); // Refresh JWT Token
    Route::get('/profile', [AuthController::class, 'profile']); // Show Profie
    Route::get('/avatars/available', [AvatarController::class, 'getAvailableAvatars']); // Show avaible avatar for user 
    Route::patch('/user/avatar', [UserController::class, 'updateAvatar']); // Change current avatar for User 
    Route::put('/user/accessibility', [UserController::class, 'updateAccessibility']); // Update Accessibilities params
    Route::get('/avatars', [AvatarController::class, 'index']); // Get all avatars
    Route::get('/avatars/{id}', [AvatarController::class, 'show']); // Get an avatar by ID 
    Route::get('/interests', [InterestController::class, 'index']); // Get all interests 
    Route::get('/interests/{id}', [InterestController::class, 'show']); // Get an interest by ID 

    // USERS_INTERESTS Routes
    Route::prefix('user/interests')->group(function () {
        Route::get('/', [UserInterestController::class, 'index']); // Get user interests
        Route::post('/', [UserInterestController::class, 'store']); // Add user interests
        Route::delete('/', [UserInterestController::class, 'destroy']); // Delete user interests
        Route::put('/', [UserInterestController::class, 'update']); // Update user interests
    });

    // Daily task - MAIN FEATURE - ROUTES
    Route::prefix('user')->group(function () {
        Route::post('/tasks/generate', [UserTaskController::class, 'assignDailyTasks']); // Generate 3 daily task for user
        Route::get('/tasks', [UserTaskController::class, 'getUserTasks']); // Get the tasks for user
        Route::patch('/tasks/{taskId}/complete', [UserTaskController::class, 'completeTask']); // Complete a task
        Route::get('/progress', [UserProgressController::class, 'getUserProgress']); //  Get User XP Progression
    });
});

// Routes Admin sécurisées
Route::group(['middleware' => $adminMiddleware], function () {

    // ROLES
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index']); // Get all roles
        Route::get('/{id}', [RoleController::class, 'show']); // Get Role by ID
        Route::post('/', [RoleController::class, 'store']); // Create a new role
        Route::put('/{id}', [RoleController::class, 'update']); // Update a role by ID
        Route::delete('/{id}', [RoleController::class, 'destroy']); // Delete a role by ID
    });

    // LEAGUES
    Route::prefix('leagues')->group(function () {
        Route::get('/', [LeagueController::class, 'index']); // Get all leagues
        Route::get('/{id}', [LeagueController::class, 'show']); // get a leagye by ID
        Route::post('/', [LeagueController::class, 'store']); // Create a new league 
        Route::put('/{id}', [LeagueController::class, 'update']); // Update a league by ID
        Route::delete('/{id}', [LeagueController::class, 'destroy']); // Delete a league by ID 
    });

    // AVATARS
    Route::prefix('avatars')->group(function () {
        Route::post('/', [AvatarController::class, 'store']); // Create a new avatar 
        Route::put('/{id}', [AvatarController::class, 'update']); // Update an avatar by ID
        Route::delete('/{id}', [AvatarController::class, 'destroy']); // Delete an avatar by ID 
    });

    // USERS
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']); // Get All users
        Route::get('/{id}', [UserController::class, 'show']); // Get a user by ID 
        Route::put('/{id}', [UserController::class, 'update']); // Update a user by ID 
        Route::delete('/{id}', [UserController::class, 'destroy']); // Delete a User by ID 
    });

    // INTERESTS
    Route::prefix('interests')->group(function () {
        Route::post('/', [InterestController::class, 'store']); // Create a new Interests
        Route::put('/{id}', [InterestController::class, 'update']); // Update an Interet by ID 
        Route::delete('/{id}', [InterestController::class, 'destroy']); // Delete an Interest by ID 
    });

    // TASKS
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index']); // Get all tasks
        Route::get('/{id}', [TaskController::class, 'show']); // Get a task by ID 
        Route::post('/', [TaskController::class, 'store']); // Create a new task
        Route::put('/{id}', [TaskController::class, 'update']); // Update a task by ID 
        Route::delete('/{id}', [TaskController::class, 'destroy']); // Delete a task by ID 
        Route::get('/interests/{interestId}', [TaskController::class, 'getAllTasksByInterestId']); // Get all task by interest_id
    });

    // CONTACTS
    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'index']); // Get all contact message 
        Route::get('/{id}', [ContactController::class, 'show']); // Get a contact message by ID 
        Route::delete('/{id}', [ContactController::class, 'destroy']); // Delete a contact message by ID 
    });
});
