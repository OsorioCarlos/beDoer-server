<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTask extends Model
{
    use HasFactory;

    public function task(){
        $this->hasTo(Task::class);
    }
    public function member(){
        $this->hasTo(Member::class);
    }
}
