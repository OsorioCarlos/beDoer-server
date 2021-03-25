<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTask extends Model
{
    use HasFactory;

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

}
