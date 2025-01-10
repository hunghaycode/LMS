<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminCourseManager extends Controller
{
    public function index(){

        $course = Course::latest()->get();
        return view('admin.course.index',compact('course'));

    }// End M
    public function AdminCourseDetails($id){

        $course = Course::find($id);
        return view('admin.course.course-detail',compact('course'));

    }// End M
    public function UpdateCourseStatus(Request $request){

        $courseId = $request->input('course_id');
        $isChecked = $request->input('is_checked',0);

        $course = Course::find($courseId);
        if ($course) {
            $course->status = $isChecked;
            $course->save();
        }

        return response()->json(['message' => 'Course Status Updated Successfully']);

    }// End Method

}
