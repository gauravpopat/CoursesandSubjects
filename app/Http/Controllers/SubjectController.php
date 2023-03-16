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
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'course'        => 'required|in:computer,noncomputer',
            'course_name'   => 'required',
            'subject_name'  => 'required|max:40'
        ]);

        if($validation->fails())
            return $this->returnResponse(false,'Validation Error',$validation->errors());

        if($request->course == 'computer'){
            $computerCourse = ComputerCourse::where('course_name',$request->course_name)->first();
            $subject = new Subject;
            $subject->subject_name = $request->subject_name;
            $computerCourse->subjects()->save($subject);
        }
        else{
            $nonComputerCourse = NonComputerCourse::where('course_name',$request->course_name)->first();
            $subject = new Subject;
            $subject->subject_name = $request->subject_name;
            $nonComputerCourse->subjects()->save($subject);
        }
    }
}
