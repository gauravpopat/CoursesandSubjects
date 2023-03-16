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

    public function show($id)
    {
        $subject = Subject::find($id);
        return $this->returnResponse(true,'Subject',$subject);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id'                  => 'required|exists:subjects,id',
            'subject_name'        => 'required|max:40|string',
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $id = $request->id;
        $subject = Subject::where('id', $id)->first();
        $subject->update([
            'subject_name'       => $request->subject_name,
        ]);

        return $this->returnResponse(true, 'Subject Updated Successfully');
    }

    public function delete($id)
    {
        $subject = Subject::where('id',$id)->first();

        if($subject){
            $subject->nonComputerCourses()->detach();
            $subject->delete();
            return $this->returnResponse(true,'Subject Deleted Successfully');
        }
        else{
            return $this->returnResponse(false,'Subject Not Found');
        }       
    }

    
}
