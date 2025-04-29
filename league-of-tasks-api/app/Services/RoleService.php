<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    // Retrieve all roles.
    public function getAllRoles()
    {
        return $this->roleRepository->getAll();
    }

    
    // Retrieve a single role by ID.
    public function getRoleById($id)
    {
        return $this->roleRepository->getById($id);
    }

    // Create a new role.
    public function createRole(array $data)
    {
        return $this->roleRepository->create($data);
    }

    // Update an existing role.
    public function updateRole($id, array $data)
    {
        $role = $this->roleRepository->update($id, $data);
        if (!$role) {
            throw new ModelNotFoundException("Role not found.");
        }
        return $role;
    }

    // Delete a role by ID.
    public function deleteRole($id)
    {
        return $this->roleRepository->delete($id);
    }
}

