<?php

namespace App\Services;

use App\Repositories\LeagueRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LeagueService
{
    protected $leagueRepository;

    public function __construct(LeagueRepository $leagueRepository)
    {
        $this->leagueRepository = $leagueRepository;
    }

    // Retrieve all leagues.
    public function getAllLeagues()
    {
        return $this->leagueRepository->getAll();
    }

    // Retrieve a single league by ID.
    public function getLeagueById($id)
    {
        $league = $this->leagueRepository->getById($id);
        if (!$league) {
            throw new ModelNotFoundException("League not found.");
        }
        return $league;
    }

    // Create a new league.
    public function createLeague(array $data)
    {
        return $this->leagueRepository->create($data);
    }

    // Update an existing league.
    public function updateLeague($id, array $data)
    {
        $league = $this->leagueRepository->update($id, $data);
        if (!$league) {
            throw new ModelNotFoundException("League not found.");
        }
        return $league;
    }

    // Delete a league by ID.
    public function deleteLeague($id)
    {
        $deleted = $this->leagueRepository->delete($id);
        if (!$deleted) {
            throw new ModelNotFoundException("League not found.");
        }
        return $deleted;
    }
}