<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Trait\ResponseTrait;
use App\Models\Subject;
use App\Models\NonComputerCourse;

class NonComputerCourseController extends Controller
{
    use ResponseTrait;

    public function list($id)
    {
        $subjects = NonComputerCourse::with('subjects')->where('id',$id)->get();
        return $this->returnResponse(true,'Subjects',$subjects);
    }

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

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id'                  => 'required|exists:non_computer_courses,id',
            'course_name'         => 'required|max:40|string',
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $id = $request->id;
        $nonCompuetCourse = NonComputerCourse::where('id', $id)->first();
        $nonCompuetCourse->update([
            'course_name'       => $request->course_name,
        ]);

        return $this->returnResponse(true, 'Course Updated Successfully', $nonCompuetCourse);
    }

    public function delete($id)
    {
        $nonCompuetCourse = NonComputerCourse::find($id);
        $nonCompuetCourse->subjects()->detach();
        $nonCompuetCourse->delete();

        return $this->returnResponse(true, 'Course Deleted Successfully');
    }


    public function addSubject(Request $request){
        $validation = Validator::make($request->all(),[
            'course_name'   => 'required|exists:non_computer_courses,course_name',
            'subject_name'  => 'required|max:40'
        ]);

        if($validation->fails())
            return $this->returnResponse(false,'Validation Error',$validation->errors());
            
        $nonComputerCourse = NonComputerCourse::where('course_name',$request->course_name)->first();
        $subject = new Subject;
        $subject->subject_name = $request->subject_name;
        $nonComputerCourse->subjects()->save($subject);

        return $this->returnResponse(true,'Subject Added',$subject);
    }
}
