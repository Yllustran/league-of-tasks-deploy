<?php

namespace App\Services;

use App\Repositories\InterestRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InterestService
{
    protected $interestRepository;

    public function __construct(InterestRepository $interestRepository)
    {
        $this->interestRepository = $interestRepository;
    }

    // Retrieve all interests.
    public function getAllInterests()
    {
        return $this->interestRepository->getAll();
    }

    // Retrieve a single interest by ID.
    public function getInterestById($id)
    {
        $interest = $this->interestRepository->getById($id);
        if (!$interest) {
            throw new ModelNotFoundException("Interest not found.");
        }
        return $interest;
    }

    // Create a new interest.
    public function createInterest(array $data)
    {
        return $this->interestRepository->create($data);
    }

    // Update an existing interest.
    public function updateInterest($id, array $data)
    {
        $interest = $this->interestRepository->update($id, $data);
        if (!$interest) {
            throw new ModelNotFoundException("Interest not found.");
        }
        return $interest;
    }

    // Delete an interest by ID.
    public function deleteInterest($id)
    {
        $deleted = $this->interestRepository->delete($id);
        if (!$deleted) {
            throw new ModelNotFoundException("Interest not found.");
        }
        return $deleted;
    }
}
