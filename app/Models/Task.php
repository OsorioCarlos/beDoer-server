<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'state_id',
        'created_by',
        'teamspace',
        'deleted'
    ];



    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }



    public function state(){
        return $this->hasOne(State::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function memberTask(){
        return $this->belongsTo(MemberTask::class);
    }

}
