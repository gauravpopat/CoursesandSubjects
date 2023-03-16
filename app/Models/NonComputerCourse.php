<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonComputerCourse extends Model
{
    use HasFactory;

    protected $fillable = ['course_name'];

    public function subjects()
    {
        return $this->morphToMany(Subject::class,'subjectable');
    }
}
