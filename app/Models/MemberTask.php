<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTask extends Model
{
    use HasFactory;

    public function members()
    {
        $this->hasMany(Member::class);
    }

    public function tasks()
    {
        $this->hasMany(Tasks::class);
    }
}
