<?php

namespace App\Repositories;

use App\Models\League;

class LeagueRepository
{
    // Get all leagues.
    public function getAll()
    {
        return League::all();
    }

    // Get a league by ID.
    public function getById($id)
    {
        return League::findOrFail($id);
    }

    // Create a new league.
    public function create(array $data)
    {
        return League::create($data);
    }

    // Update a league by ID.
    public function update($id, array $data)
    {
        $league = League::findOrFail($id);
        $league->update($data);
        return $league;
    }

    // Delete a league by ID.
    public function delete($id)
    {
        $league = League::findOrFail($id);
        return $league->delete();
    }
}
