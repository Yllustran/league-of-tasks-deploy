<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items'; 
    protected $fillable = [
        'item_name',
        'item_description',
        'item_url',
        'cost',
        'is_purchasable',
    ];


     // Relation : 1 item can be owned by multiple users through the pivot table `users_items`.
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_items')
            ->withTimestamps();
    }
}
