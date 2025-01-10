<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorOrder extends Controller
{
    public function InstructorAllOrder(){

        $id = Auth::user()->id;
        
        $latestOrderItem = Order::where('instructor_id',$id)->select('payment_id', \DB::raw('MAX(id) as max_id'))->groupBy('payment_id');

        $orderItem = Order::joinSub($latestOrderItem, 'latest_order', function($join) {
            $join->on('orders.id', '=', 'latest_order.max_id');
        })->orderBy('latest_order.max_id','DESC')->get();

        return view('instructor.order-manager.all-order',compact('orderItem'));

    }// End Method 
    public function InstructorOrderDetails($payment_id){

        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();

        return view('instructor.order-manager.order_detail',compact('payment','orderItem'));

    }// End Method 
    public function PendingToConfirm($payment_id)
    {
        $payment = Payment::find($payment_id);
    
        if ($payment->status == 'pending') {
            $payment->update(['status' => 'completed']);
            $message = 'Order Confirmed Successfully';
        } else {
            $payment->update(['status' => 'pending']);
            $message = 'Order Marked as Pending';
        }
    
        $notification = array(
            'message' => $message,
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    }
}
