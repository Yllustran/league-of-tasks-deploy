<?php

namespace App\Repositories;

use App\Models\Interest;

class InterestRepository
{
    // Get all interests.
    public function getAll()
    {
        return Interest::all();
    }

    // Get an interest by ID.
    public function getById($id)
    {
        return Interest::findOrFail($id);
    }

    // Create a new interest.
    public function create(array $data)
    {
        return Interest::create($data);
    }

    // Update an interest by ID.
    public function update($id, array $data)
    {
        $interest = Interest::findOrFail($id);
        $interest->update($data);
        return $interest;
    }

    // Delete an interest by ID.
    public function delete($id)
    {
        $interest = Interest::findOrFail($id);
        return $interest->delete();
    }
}
