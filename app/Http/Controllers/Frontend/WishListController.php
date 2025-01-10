<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function AllWishlist(){

        return view('frontend.dashboard.layouts.master');

    }// End Method 

    public function AddToWishList(Request $request, $course_id){
        if (!auth()->check()) {
            return response()->json(['error' => 'You must be logged in to add to your wishlist.'], 403);
        }
    
 
        if (Auth::check()) {
           $exists = Wishlist::where('user_id',Auth::id())->where('course_id',$course_id)->first();

           if (!$exists) {
            Wishlist::insert([
                'user_id' => Auth::id(),
                'course_id' => $course_id,
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['success' => 'Successfully Added on your Wishlist']);
           }else {
            return response()->json(['error' => 'This Product Has Already on your withlist']);
           }

        }else{
            return response()->json(['error' => 'At First Login Your Account']);
        } 

    } // End Method 

    public function GetWishlistCourse() {
        $wishlist = Wishlist::with(['course', 'course.user']) // Include instructor relationship
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->get();
    
        $wishQty = Wishlist::where('user_id', Auth::id())->count();
    
        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }
    
    public function RemoveWishlist($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Course Remove']);

    }// End Metho

}
