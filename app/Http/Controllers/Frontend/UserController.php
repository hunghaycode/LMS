<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseSection;
use App\Models\Order;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()  {
        return view('frontend.index');
    }
    public function UserProfile() {
        $id = Auth::user()->id;
        $profileInfo = User::find($id);
        
        // Check if user is found
        if (!$profileInfo) {
            return redirect()->back()->with('error', 'User not found.');
        }
        // // Check my my course
        // $latestOrders = Order::where('user_id',$id)->select('course_id', \DB::raw('MAX(id) as max_id'))->groupBy('course_id');
        //     $myCourse = Order::joinSub($latestOrders, 'latest_order', function($join) {
        //     $join->on('orders.id', '=', 'latest_order.max_id');
        // })->orderBy('latest_order.max_id','DESC')->get();

    
        return view('frontend.dashboard.layouts.master', compact('profileInfo')); 
    }
    public function UserProfileUpdate(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
           $file = $request->file('photo');
           @unlink(public_path('upload/user_images/'.$data->photo));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/user_images'),$filename);
           $data['photo'] ='upload/user_images/' . $filename;

        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
    public function UserLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'info'
        );

        return redirect('/login')->with($notification);
    } // End Method 

    public function UserPasswordUpdate(Request $request){

        /// Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        /// Update The new Password 
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification); 

    }// End Method

    // public function MyCourse(){
    //     $id = Auth::user()->id;

    //     $latestOrders = Order::where('user_id',$id)->select('course_id', \DB::raw('MAX(id) as max_id'))->groupBy('course_id');

      
    //         $myCourse = Order::joinSub($latestOrders, 'latest_order', function($join) {
    //         $join->on('orders.id', '=', 'latest_order.max_id');
    //     })->orderBy('latest_order.max_id','DESC')->get();

  
    //     return view('frontend.dashboard.layouts.master',compact('myCourse'));

    // }// End Method 
    
    public function CourseView($course_id){
        $id = Auth::user()->id;
        $allquestion = Question::latest()->get();
        $course = Order::where('course_id',$course_id)->where('user_id',$id)->first();
        $section = CourseSection::where('course_id',$course_id)->orderBy('id','asc')->get();

        return view('frontend.pages.course_view',compact('course','section','allquestion'));


    }// End Method 

}
