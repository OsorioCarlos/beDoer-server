<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function users(){
        $this->hasMany(User::class);
    }

    public function role(){
        return $this->hasOne(Role::class);
    }

    public function tasks(){
        return $this->belongsToMany(Task::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

}
