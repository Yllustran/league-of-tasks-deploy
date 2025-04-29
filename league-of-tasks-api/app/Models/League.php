<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $table = 'leagues';

    protected $fillable = [
        'league_name',
        'league_description',
    ];

    public $timestamps = false; 

     // Relation : 1 League can have many Users
    public function users()
    {
        return $this->hasMany(User::class, 'league_id');
    }
}
