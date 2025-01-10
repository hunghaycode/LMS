<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function AdminPendingOrder(){

        $payment = Payment::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.order-manager.pending',compact('payment'));

    } // End Method 
    public function AdminOrderDetails($payment_id){

        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();

        return view('admin.order-manager.order_detail',compact('payment','orderItem'));

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
