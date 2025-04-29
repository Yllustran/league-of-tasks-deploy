<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    // Get all contact messages.
    public function index(): JsonResponse
    {
        return response()->json($this->contactService->getAllContacts(), 200);
    }

    // Get a specific contact message by ID.
    public function show(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->contactService->getContactById($id));
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'contact_email' => 'required|email|max:150',
            'contact_subject' => 'required|string|max:150',
            'contact_message' => 'required|string'
        ]);
    
        $this->contactService->createContact($validatedData);
    
        // send json if its working
        return response()->json([
            'message' => 'Votre message a bien été envoyé.'
        ], 201);
    }

    // Delete a contact message.
    public function destroy(int $id): JsonResponse
    {
        return $this->handleNotFound(fn() => $this->contactService->deleteContact($id), 'Contact message deleted successfully', 204);
    }

    // Centralized 404 error handling
    private function handleNotFound(callable $callback, string $successMessage = null, int $successStatus = 200): JsonResponse
    {
        try {
            $result = $callback();
    
            // If the deletion returns true, display a confirmation message
            if ($successStatus === 204 && $result) {
                return response()->json(['message' => $successMessage ?? 'Contact message deleted successfully'], 200);
            }
    
            return $successMessage 
                ? response()->json(['message' => $successMessage], $successStatus) 
                : response()->json($result, $successStatus);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Contact message not found'], 404);
        }
    }
}
