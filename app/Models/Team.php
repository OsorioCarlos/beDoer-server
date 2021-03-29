<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'deleted'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // preguntar sobre la relacion

    // public function members()
    // {
    //     return $this->hasMany(Member::class);
    // }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
}
