<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Trait\ResponseTrait;
use App\Models\ComputerCourse;
use App\Models\Subject;

class ComputerCourseController extends Controller
{
    use ResponseTrait;

    public function list($id)
    {
        $subjects = ComputerCourse::with('subjects')->where('id', $id)->get();
        return $this->returnResponse(true, 'Subjects', $subjects);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'course_name'   => 'required',
        ]);

        if ($validation->fails())
            return $this->returnResponse(false, 'Validation Error', $validation->errors());

        $computerCourse = ComputerCourse::create($request->only(['course_name']));

        return $this->returnResponse(true, 'Course created successfully', $computerCourse);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id'                  => 'required|exists:computer_courses,id',
            'course_name'         => 'required|max:40|string',
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $id = $request->id;
        $compuetCourse = ComputerCourse::where('id', $id)->first();
        $compuetCourse->update([
            'course_name'       => $request->course_name,
        ]);

        return $this->returnResponse(true, 'Course Updated Successfully', $compuetCourse);
    }

    public function delete($id)
    {
        $compuetCourse = ComputerCourse::find($id);
        $compuetCourse->subjects()->detach();
        $compuetCourse->delete();

        return $this->returnResponse(true, 'Course Deleted Successfully');
    }

    public function addSubject(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'course_name'   => 'required|exists:computer_courses,course_name',
            'subject_name'  => 'required|max:40'
        ]);

        if ($validation->fails())
            return $this->returnResponse(false, 'Validation Error', $validation->errors());

        $computerCourse = ComputerCourse::where('course_name', $request->course_name)->first();
        $subject = new Subject;
        $subject->subject_name = $request->subject_name;
        $computerCourse->subjects()->save($subject);

        return $this->returnResponse(true, 'Subject Added', $subject);
    }
}
