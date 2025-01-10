<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseGoal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id', $id)->orderBy('id', 'desc')->get();
        return view('instructor.course.index', compact('courses'));
    }

    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('sub_category_name', 'ASC')->get();
        return response()->json($subcat); // Use response()->json() for better handling
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('instructor.course.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimetypes:video/mp4|max:10000',
            'image' => 'nullable|image|max:10000', // Thêm xác thực cho hình ảnh
        ]);

        // Xử lý tải lên hình ảnh
        $save_url = null;
        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $filename = date('ymdHi') . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/course'), $filename);
            $save_url = 'uploads/course/' . $filename;
        }

        // Xử lý tải lên video
        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video/'), $videoName);
        $save_video = 'upload/course/video/' . $videoName;

        // Lưu khóa học
        $course_id = Course::insertGetId([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,
            'video' => $save_video,
            'label' => $request->label,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,
            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highest_rated' => $request->highest_rated,
            'status' => 1,
            'course_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        // Xử lý mục tiêu khóa học
        if ($request->has('course_goals')) {
            foreach ($request->course_goals as $goal) {
                CourseGoal::create([
                    'course_id' => $course_id,
                    'goal_name' => $goal,
                ]);
            }
        }

        $notification = [
            'message' => 'Course Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('instructor.course.index')->with($notification);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::with('course_goals')->findOrFail($id); // Tải dữ liệu khóa học cùng với các mục tiêu
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('instructor.course.edit', compact('course', 'categories', 'subcategories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'video' => 'nullable|mimetypes:video/mp4|max:10000',
            'course_image' => 'nullable|image|max:10000',
            'course_goals' => 'nullable|array', // Validate course goals as an array

            'course_goals.*' => 'string|nullable', // Xác thực mỗi mục trong mảng
        ]);

        // Find the existing course
        $course = Course::findOrFail($id);

        // Store old values for video and image
        $save_url = $course->course_image;
        $save_video = $course->video;

        // Handle image upload
        // Handle image upload
        if ($request->hasFile('course_image')) {
            // Delete old image if it exists
            if ($save_url && file_exists(public_path($save_url))) {
                unlink(public_path($save_url));
            }

            $image = $request->file('course_image');
            $filename = date('ymdHi') . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/course'), $filename);
            $save_url = 'uploads/course/' . $filename; // Update the image URL
        }


        // Handle video upload
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('upload/course/video/'), $videoName);
            $save_video = 'upload/course/video/' . $videoName; // Update the video URL
        }

        // Update course data
        $course->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,
            'label' => $request->label,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,
            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highest_rated' => $request->highest_rated,
            'status' => 1,
            'course_image' => $save_url,
            'video' => $save_video,
            'updated_at' => Carbon::now(),
        ]);

        // Update course goals
        // First, delete existing goals
        CourseGoal::where('course_id', $course->id)->delete();


        // Thêm các mục course_goals mới
        if ($request->has('course_goals')) {
            foreach ($request->course_goals as $goal) {
                if (!empty($goal)) { // Kiểm tra để đảm bảo không thêm mục trống
                    CourseGoal::create([
                        'course_id' => $course->id,
                        'goal_name' => $goal,
                    ]);
                }
            }

            $notification = [
                'message' => 'Course Update Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('instructor.course.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function DeleteCourse(string $id)
    {
        // Tìm khóa học
        $course = Course::findOrFail($id);

        // Kiểm tra và xóa hình ảnh nếu có
        if ($course->course_image && file_exists(public_path($course->course_image))) {
            unlink(public_path($course->course_image));
        }

        // Kiểm tra và xóa video nếu có
        if ($course->video && file_exists(public_path($course->video))) {
            unlink(public_path($course->video));
        }

        // Xóa các mục tiêu khóa học liên quan
        CourseGoal::where('course_id', $id)->delete();

        // Xóa khóa học
        $course->delete();

        // Thông báo xóa thành công
        $notification = array(
            'message' => 'Course Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('instructor.course.index')->with($notification);
    }

    public function addLecture($id){

        $course = Course::find($id);
        $section = CourseSection::where('course_id',$id)->latest()->get();
        return view('instructor.course.section.add-lecture',compact('course','section'));

    }// End Method 

    public function AddCourseSection(Request $request){

        $course_id = $request->id;

        CourseSection::insert([
            'course_id' => $course_id,
            'section_title' => $request->section_title, 
        ]);

        $notification = array(
            'message' => 'Course Section Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  

    }// End Method 
    public function SaveLecture(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'course_id' => 'required|integer',
            'section_id' => 'required|integer',
            'lecture_title' => 'required|string|max:255',
            'lecture_url' => 'nullable|string|max:2048', // Giới hạn chiều dài tối đa cho URL
            'content' => 'nullable|string',
            'lecture_duration' => 'nullable|string',

        ]);
    
        $lecture = new CourseLecture();
        $lecture->course_id = $request->course_id;
        $lecture->section_id = $request->section_id;
        $lecture->lecture_title = $request->lecture_title;
        $lecture->url = $request->lecture_url;
        $lecture->lecture_duration = $request->lecture_duration;
        $lecture->content = $request->content;
        $lecture->save();
    
        return response()->json(['success' => 'Lecture Saved Successfully']);
    }// End Method 
    
    public function EditLecture($id){

        $clecture = CourseLecture::find($id);
        return view('instructor.course.section.edit-lecture',compact('clecture'));

    }// End Method 
    public function UpdateCourseLecture(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'id' => 'required|integer|exists:course_lectures,id', // Kiểm tra ID có tồn tại
            'lecture_title' => 'required|string|max:255',
            'url' => 'nullable|string|max:2048', // Giới hạn chiều dài tối đa cho URL
            'content' => 'nullable|string',
            'lecture_duration' => 'nullable|string',
        ]);
    
        $lid = $request->id;
    
        // Cập nhật bài giảng
        CourseLecture::find($lid)->update([
            'lecture_title' => $request->lecture_title,
            'url' => $request->url,
            'content' => $request->content,
            'lecture_duration' => $request->lecture_duration,
        ]);
    
        $notification = array(
            'message' => 'Course Lecture Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);   
    }// End Method 
    
    public function DeleteLecture($id){

        CourseLecture::find($id)->delete();

        $notification = array(
            'message' => 'Course Lecture Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  

    }// End Method 



    public function DeleteSection($id){

        $section = CourseSection::find($id);

        /// Delete reated lectures 
        $section->lectures()->delete();
        // Delete the section 
        $section->delete();

        $notification = array(
            'message' => 'Course Section Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 

    }// End Method 


}
