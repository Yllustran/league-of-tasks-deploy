<?php

namespace App\Services;

use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    // Retrieve all contact messages.
    public function getAllContacts()
    {
        return $this->contactRepository->getAll();
    }

    // Retrieve a single contact message by ID.
    public function getContactById($id)
    {
        $contact = $this->contactRepository->getById($id);
        if (!$contact) {
            throw new ModelNotFoundException("Contact message not found.");
        }
        return $contact;
    }

    // Create a new contact message.
    public function createContact(array $data)
    {
        return $this->contactRepository->create($data);
    }

    // Delete a contact message by ID.
    public function deleteContact($id)
    {
        $deleted = $this->contactRepository->delete($id);
        if (!$deleted) {
            throw new ModelNotFoundException("Contact message not found.");
        }
        return $deleted;
    }
}
