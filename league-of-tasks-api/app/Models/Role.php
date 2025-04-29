<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'role_name', 
    ];

    public $timestamps = false; 

    
     // Relation : 1 Role  can have many Users
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
