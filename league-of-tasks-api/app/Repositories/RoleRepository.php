<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{

    // Get all roles.
    public function getAll()
    {
        return Role::all();
    }

    // Get a role by ID.
    public function getById($id)
    {
        return Role::findOrFail($id);
    }

    // Create a new role.
    public function create(array $data)
    {
        return Role::create($data);
    }

    // Update a role by ID.
    public function update($id, array $data)
    {
        $role = Role::findOrFail($id);
        $role->update($data);
        return $role;
    }

    // Delete a role by ID.
    public function delete($id)
    {
        $role = Role::findOrFail($id); // 
        return $role->delete();
    }
}

