<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $table = 'avatars'; 

    protected $fillable = [
        'avatar_name',
        'avatar_url',
        'level_required',
    ];

    public $timestamps = false;

     // Relation : 1 Avatar can have many Users
    public function users()
    {
        return $this->hasMany(User::class, 'avatar_id');
    }
}
