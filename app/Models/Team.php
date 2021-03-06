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
        return $this->morphMany(Task::class, 'taskable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class);
    }
    
}
