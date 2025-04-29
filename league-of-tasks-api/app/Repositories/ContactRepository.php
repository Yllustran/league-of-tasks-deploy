<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    // Get all contacts.
    public function getAll()
    {
        return Contact::all();
    }

    // Get a contact by ID.
    public function getById($id)
    {
        return Contact::findOrFail($id);
    }

    // Create a new contact message.
    public function create(array $data)
    {
        return Contact::create($data);
    }

    // Delete a contact message by ID.
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        return $contact->delete();
    }
}
