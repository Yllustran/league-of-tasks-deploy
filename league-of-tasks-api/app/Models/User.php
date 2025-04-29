<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Nom de la table associée

    protected $fillable = [
        'username',
        'email',
        'password',
        'xp',
        'gold',
        'level',
        'physical_disabled',
        'vision_impairment',
        'task_season',
        'role_id',
        'league_id',
        'avatar_id',
    ];

    protected $hidden = [
        'password',
    ];

    // Relation : 1 User have 1 Role
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Relation : 1 User have 1 League
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    // Relation : 1 User have 1 Avatar
    public function avatar(): BelongsTo
    {
        return $this->belongsTo(Avatar::class);
    }


    //  Relation : 1 user can have multiple tasks through the pivot table `users_tasks`
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'users_tasks')
            ->withPivot('deadline')
            ->withTimestamps();
    }

    //  Relation : 1 user can have multiple intereststhrough the pivot table `users_interests`
    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'users_interests');
    }

    /**
     * Get the identifier that will be stored in the JWT token.
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key-value array, containing any custom claims to be added to the JWT token.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function isAdmin()
    {
        return $this->role && strtolower($this->role->role_name) === 'admin';
    }
}
