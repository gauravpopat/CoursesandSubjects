<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Trait\ResponseTrait;
use App\Models\NonComputerCourse;

class NonComputerCourseController extends Controller
{
    use ResponseTrait;
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'course_name'   => 'required',
        ]);

        if($validation->fails())
            return $this->returnResponse(false,'Validation Error',$validation->errors());

        $nonComputerCourse = NonComputerCourse::create($request->only(['course_name']));

        return $this->returnResponse(true,'Course created successfully',$nonComputerCourse);
    }
}
