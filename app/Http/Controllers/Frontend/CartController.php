<?php

namespace App\Http\Controllers\Frontend;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Http\Controllers\Controller;
use App\Mail\Orderconfirm;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaypalSetting;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function MyCart()
    {
        return view('frontend.pages.my_cart');
    }

    public function GetCartCourse()
    {
        return response()->json([
            'carts' => Cart::content(),
            'cartTotal' => Cart::total(),
            'cartQty' => Cart::count(),
        ]);
    }

    public function AddToCart(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $cartItem = Cart::search(fn($cartItem) => $cartItem->id === $id);

        if ($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        Cart::add([
            'id' => $id,
            'name' => $request->course_name,
            'qty' => 1,
            'price' => $course->discount_price ?? $course->selling_price,
            'weight' => 1,
            'options' => [
                'image' => $course->course_image,
                'slug' => $request->course_name_slug,
                'instructor' => $request->instructor,
                'instructor_name' => $course->user->name,
                'instructor_photo' => $course->user->photo,
            ],
        ]);

        return response()->json(['success' => 'Successfully Added to Your Cart']);
    }

    public function CartData()
    {
        return response()->json([
            'carts' => Cart::content(),
            'cartTotal' => Cart::total(),
            'cartQty' => Cart::count(),
        ]);
    }
    public function AddMiniCart()
    {

        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));
    } // End Method 
    public function CartRemove($rowId)
    {

        Cart::remove($rowId);
        return response()->json(['success' => 'Course Remove From Cart']);
    } // End Method 
    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Course Removed From Cart']);
    }

    public function CouponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
                        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                        ->first();

        if ($coupon) {
            $discountAmount = round(Cart::total() * $coupon->coupon_discount / 100);
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discountAmount,
                'total_amount' => round(Cart::total() - $discountAmount)
            ]);

            return response()->json(['validity' => true, 'success' => 'Coupon Applied Successfully']);
        }

        return response()->json(['error' => 'Invalid Coupon']);
    }

    public function CouponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json([
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ]);
        }

        return response()->json(['total' => Cart::total()]);
    }

    public function CouponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);
    }

    public function CheckoutCreate()
    {
        if (Auth::check() && Cart::total() > 0) {
            return view('frontend.pages.checkout', [
                'isCheckout' => true,
                'carts' => Cart::content(),
                'cartTotal' => Cart::total(),
                'cartQty' => Cart::count(),
            ]);
        }

        $notification = [
            'message' => Auth::check() ? 'Add at least One Course' : 'You Need to Login First',
            'alert-type' => 'error'
        ];
        return redirect()->route(Auth::check() ? 'index' : 'login')->with($notification);
    }

    public function BuyToCart(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $cartItem = Cart::search(fn($cartItem) => $cartItem->id === $id);

        if ($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        Cart::add([
            'id' => $id,
            'name' => $request->course_name,
            'qty' => 1,
            'price' => $course->discount_price ?? $course->selling_price,
            'weight' => 1,
            'options' => [
                'image' => $course->course_image,
                'slug' => $request->course_name_slug,
                'instructor' => $request->instructor,
            ],
        ]);

        return response()->json(['success' => 'Successfully Added to Your Cart']);
    }

    public function InsCouponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
                        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                        ->first();

        if ($coupon && $coupon->course_id == $request->course_id && $coupon->instructor_id == $request->instructor_id) {
            $discountAmount = round(Cart::total() * $coupon->coupon_discount / 100);
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discountAmount,
                'total_amount' => round(Cart::total() - $discountAmount)
            ]);

            return response()->json(['validity' => true, 'success' => 'Coupon Applied Successfully']);
        }

        return response()->json(['error' => 'Coupon Criteria Not Met for this course and instructor']);
    }

    public function Payment(Request $request)
    {
        // Get total amount after applying any coupon, if available
        $total_amount = Session::has('coupon') ? Session::get('coupon')['total_amount'] : round(Cart::total());
    
        // Handle the different payment types
        if ($request->cash_delivery == 'handcash') {
            // COD payment
            $paymentData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'cash_delivery' => true,  // Mark as COD
                'total_amount' => $total_amount,
                'payment_type' => 'COD', // Payment type is COD
                'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',  // Order is pending until payment is made
                'created_at' => Carbon::now(),
            ];
        } 
        // else {
        //     // PayPal payment (existing logic)
        //     $paymentData = [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'phone' => $request->phone,
        //         'address' => $request->address,
        //         'cash_delivery' => false,  // Mark as PayPal
        //         'total_amount' => $total_amount,
        //         'payment_type' => 'PayPal',
        //         'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
        //         'order_date' => Carbon::now()->format('d F Y'),
        //         'order_month' => Carbon::now()->format('F'),
        //         'order_year' => Carbon::now()->format('Y'),
        //         'status' => 'completed',
        //         'created_at' => Carbon::now(),
        //     ];
        // }
    
        // Save payment data
        $payment = Payment::create($paymentData);
    
        // Loop through courses in the cart and create orders
        foreach ($request->course_title as $key => $course_title) {
            $existingOrder = Order::where('user_id', Auth::user()->id)
                ->where('course_id', $request->course_id[$key])->first();
    
            if ($existingOrder) {
                return redirect()->back()->with([
                    'message' => 'You have already registered for this course',
                    'alert-type' => 'error'
                ]);
            }
    
            Order::create([
                'payment_id' => $payment->id,
                'user_id' => Auth::user()->id,
                'course_id' => $request->course_id[$key],
                'instructor_id' => $request->instructor_id[$key],
                'course_title' => $course_title,
                'price' => $request->price[$key],
            ]);
        }
    
        // Clear cart session after successful order creation
        $request->session()->forget('cart');
    
        // Send confirmation email to the user
        Mail::to($request->email)->send(new Orderconfirm([
            'invoice_no' => $payment->invoice_no,
            'amount' => $total_amount,
            'name' => $payment->name,
            'email' => $payment->email,
        ]));
    
        // Redirect to payment success page
        $notification = [
            'message' => 'Order placed successfully. Please pay on delivery.',
            'alert-type' => 'success'
        ];
        return redirect()->route('payment.success')->with($notification);
    }
    

    public function PaymentSuccess()
    {

    
        // For PayPal or other payment types, retain existing behavior
        return view('frontend.pages.payment_success');
    }
    

    public function paypalCancel()
    {
        return redirect()->route('payment')->with([
            'message' => 'Something went wrong, try again later!',
            'alert-type' => 'error'
        ]);
    }

    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
    
        $response = $provider->capturePaymentOrder($request->token);
    
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Handle payment logic here
            $total_amount = Session::has('coupon') ? Session::get('coupon')['total_amount'] : round(Cart::total());
    
            // Prepare payment data
            $paymentData = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => request()->phone, // Assuming you collect this on checkout
                'address' => request()->address, // Assuming you collect this on checkout
                'cash_delivery' => false, // Or set according to your business logic
                'total_amount' => $total_amount,
                'payment_type' => 'PayPal',
                'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'completed', // Assuming you want to mark it as completed
            ];
    
            // Create payment record
            $payment = Payment::create($paymentData);
    
            // Create associated orders
            foreach (Cart::content() as $cartItem) {
                Order::create([
                    'payment_id' => $payment->id,
                    'user_id' => Auth::user()->id,
                    'course_id' => $cartItem->id,
                    'instructor_id' => $cartItem->options['instructor'], // Adjust based on your structure
                    'course_title' => $cartItem->name,
                    'price' => $cartItem->price,
                ]);
            }
    
            // Clear the cart and coupon session
            $this->clearSession();
    
            // Send confirmation email
            Mail::to(Auth::user()->email)->send(new Orderconfirm([
                'invoice_no' => $payment->invoice_no,
                'amount' => $total_amount,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]));
    
            return redirect()->route('payment.success')->with([
                'message' => 'Order placed successfully',
                'alert-type' => 'success'
            ]);
        }
    
        return redirect()->route('paypal.cancel');
    }
    

    public function payWithPaypal()
    {
        
        $total_amount = Session::has('coupon') ? Session::get('coupon')['total_amount'] : round(Cart::total());
        $config = $this->paypalConfig();
        $paypalSetting = PaypalSetting::first();

        $paypalAmount = round($total_amount * $paypalSetting->currency_rate, 2);
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => $config['currency'],
                    "value" => $paypalAmount
                ]
            ]]
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('paypal.cancel');
    }

    public function paypalConfig()
    {
        $paypalSetting = PaypalSetting::first();
        $config =
            [
                'mode'    => $paypalSetting === 1 ? 'live' : 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
                'sandbox' => [
                    'client_id'         => $paypalSetting->client_id,
                    'client_secret'     =>  $paypalSetting->secret_key,
                    'app_id'            => 'APP-80W284485P519543T',
                ],
                'live' => [
                    'client_id'         =>  $paypalSetting->client_id,
                    'client_secret'     => $paypalSetting->secret_key,
                    'app_id'            => '',
                ],

                'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
                'currency'       => $paypalSetting->currency_name,
                'notify_url'     => '', // Change this accordingly for your application.
                'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
                'validate_ssl'   => true, // Validate SSL when creating api client.
            ];
        return $config;
    }
    

    private function clearSession()
    {
        Session::forget('cart');
        Session::forget('coupon');
    }
}
