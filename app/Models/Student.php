<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    /** ↴ EXISTUJÍCÍ tabulka v dumpu */
    protected $table = 'z_students';

    protected $fillable = [
        'name',
        'email',
        'birth_year',
        'password',
        'profile_picture'
    ];

    protected $hidden   = ['password','remember_token'];
}
