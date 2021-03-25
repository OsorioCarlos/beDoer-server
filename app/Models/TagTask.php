<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTask extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======

    protected $fillable = [
        'tag_id',
        'task_id',
        'deleted'
    ];

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }
    public function task(){
        return $this->belongsToMany(task::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
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

>>>>>>> 4fe5c2cd4c6fdca0463cd1ce5a2fc809468318c3
}
