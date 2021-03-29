<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function teams(){
        return $this->belongsTo(Team::class);
    }

    public function role(){
        return $this->hasOne(Role::class);
    }
    
}
