<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function computerCourses()
    {
        return $this->morphedByMany(ComputerCourse::class,'subjectable');
    }

    public function nonComputerCourses()
    {
        return $this->morphedByMany(NonComputerCourse::class,'subjectable');
    }
}
