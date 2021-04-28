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
        'expiration_date',
        'deleted'
    ];

    protected $casts = [
        'expiration_date' => 'date:Y-m-d',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function taskable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

//    public function setExpirationDateAttribute($value)
//    {
//        $this->attributes['expiration_date'] = strtolower($value);
//    }

}
