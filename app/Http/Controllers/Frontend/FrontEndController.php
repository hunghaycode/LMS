<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseGoal;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function courseDetail(string $id,$slug) {
        $courseDetail = Course::findOrFail($id);
        $goals = CourseGoal::where('course_id',$id)->orderBy('id','DESC')->get();
        $ins_id = $courseDetail->instructor_id; 
        $instructorCourses = Course::where('instructor_id',$ins_id)->orderBy('id','DESC')->get();

        $categories = Category::latest()->get();
        $cat_id = $courseDetail->category_id; 
        $relatedCourses = Course::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();
        // dd($relatedCourses);
      
        return view('frontend.pages.course-detail',compact('courseDetail','goals','instructorCourses','relatedCourses'));
    }
    public function CategoryCourse($id, $slug){

        $courses = Course::where('category_id',$id)->where('status','1')->get();
        $category = Category::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.search_category',compact('courses','category','categories'));
    }
    public function SubCategoryCourse($id, $slug){

        $courses = Course::where('sub_category_id',$id)->where('status','1')->get();
        $subcategory = SubCategory::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.search_sub_category',compact('courses','subcategory','categories')); 
    }// End Method 

    // End Method 
    public function InstructorDetails($id){

        $instructor = User::find($id);
        $courses = Course::where('instructor_id',$id)->get();
        return view('frontend.pages.instructor-detail',compact('instructor','courses'));

    }// End Method 

}

