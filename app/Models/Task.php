<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public function state(){
        return $this->hasOne(State::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

}
