<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserInterestRepository
{

    // Get all interests of a user
    public function getUserInterests($userId)
    {
        return DB::table('users_interests')
            ->where('user_id', $userId)
            ->join('interests', 'users_interests.interest_id', '=', 'interests.id')
            ->select('interests.id', 'interests.interest_name')
            ->get();
    }

    // Add multiple interests to a user
    public function addInterests($userId, array $interestIds)
    {
        $data = array_map(fn($id) => ['user_id' => $userId, 'interest_id' => $id], $interestIds);
        return DB::table('users_interests')->insert($data);
    }

    // Remove multiple interests from a user
    public function removeInterests($userId, array $interestIds)
    {
        return DB::table('users_interests')
            ->where('user_id', $userId)
            ->whereIn('interest_id', $interestIds)
            ->delete();
    }

    // Get IDs of existing interests in database
    public function getExistingInterestIds(array $interestIds)
    {
        return DB::table('interests')
            ->whereIn('id', $interestIds)
            ->pluck('id')
            ->toArray();
    }

    // Get IDs of interests the user already has
    public function getUserInterestIds($userId)
    {
        return DB::table('users_interests')
            ->where('user_id', $userId)
            ->pluck('interest_id')
            ->toArray();
    }

    // Remove all User Interest
    public function removeAllInterests($userId)
    {
        return DB::table('users_interests')->where('user_id', $userId)->delete();
    }
}
