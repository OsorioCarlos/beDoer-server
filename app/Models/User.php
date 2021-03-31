<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //    metodos de orm


    // preguntar sobre el nombre
    // por que CREA muchas tareas
    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }

    // preguntar sobre la relacion

    // public function members()
    // {
    //     return $this->belongsToMany(Member::class);
    // }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

}
