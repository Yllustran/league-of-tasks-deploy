<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Interest extends Model
{
    use HasFactory;

    protected $table = 'interests';

    protected $fillable = [
        'interest_name',
        'interest_description',
    ];

    public $timestamps = false; 

    // Relation : 1 Interest can have multiple Tasks.
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'interest_id');
    }
}
