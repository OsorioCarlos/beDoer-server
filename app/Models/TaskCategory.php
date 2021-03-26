<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'deleted'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function task(){
        return $this->belongsToMany(Task::class);
    }

}
