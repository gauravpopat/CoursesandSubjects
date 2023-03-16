<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Trait\ResponseTrait;
use App\Models\ComputerCourse;
use App\Models\NonComputerCourse;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    use ResponseTrait;
}
