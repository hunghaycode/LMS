<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
    public function index(){

        $coupon = Coupon::latest()->get();
        return view('admin.coupon.index',compact('coupon'));

    } /// End M
    public function AdminAddCoupon(){
        return view('admin.coupon.create');
    }/// End Method 

    public function AdminStoreCoupon(Request $request){

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.coupon.index')->with($notification);  
    }
    public function AdminEditCoupon($id){

        $coupon = Coupon::find($id);
        return view('admin.coupon.edit',compact('coupon'));

    }/// End Method 


    public function AdminUpdateCoupon(Request $request){

        $coupon_id = $request->id;

        Coupon::find($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.coupon.index')->with($notification);  


    }/// End Method 

    public function AdminDeleteCoupon($id){

        Coupon::find($id)->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }/// End Method 
}
