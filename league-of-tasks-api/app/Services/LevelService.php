<?php

namespace App\Services;

use App\Models\User;

class LevelService
{
    // Max level
    private int $maxLevel = 200;

    // Calculate required XP for a level-up
    public function getXpRequired(int $level): int
    {
        if ($level == 1) {
            return 0;
        }

        return (100 * ($level - 1)) + (50 * (($level - 1) * ($level - 2) / 2));
    }

    // Check if the user should level-up
    public function checkLevelUp(User $user): array
    {
        $currentXp = $user->xp;
        $currentLevel = $user->level;

        // 🔥 Utilisation de la propriété de classe
        $maxLevel = $this->maxLevel;

        // Get XP required for current and next level
        $xpCurrentLevel = $this->getXpRequired($currentLevel);
        $xpRequiredNext = $this->getXpRequired($currentLevel + 1);

        // Check if user has enough XP to level up
        while ($currentXp >= $xpRequiredNext && $currentLevel < $maxLevel) {
            $currentLevel++;
            $xpCurrentLevel = $xpRequiredNext;
            $xpRequiredNext = $this->getXpRequired($currentLevel + 1);
        }

        // If max level is reached, stop progression
        if ($currentLevel >= $maxLevel) {
            $currentLevel = $maxLevel;
            $xpRequiredNext = 0; // No more level-up possible
        }

        // Calculate XP needed for next level
        $xpNeeded = max(0, $xpRequiredNext - $currentXp);

        // Update user level
        $user->level = $currentLevel;
        $user->save();

        return [
            'new_level' => $currentLevel,
            'xp_needed_for_next_level' => max(0, $xpNeeded),
        ];
    }
}
