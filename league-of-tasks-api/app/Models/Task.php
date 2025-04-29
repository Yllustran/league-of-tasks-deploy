<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'task_name',
        'mobility_req',
        'vision_req',
        'difficulty',
        'reward_xp',
        'reward_gold',
        'interest_id',
    ];

    //  Relation : 1 task belongs to 1 interest.
    public function interest(): BelongsTo
    {
        return $this->belongsTo(Interest::class);
    }

    // Relation : 1 task can be assigned to multiple users through the pivot table `users_tasks`.
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_tasks')
            ->withTimestamps();
    }
}
