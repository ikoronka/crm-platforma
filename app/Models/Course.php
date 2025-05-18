<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'z_courses';
    protected $fillable = ['name', 'description'];

}
