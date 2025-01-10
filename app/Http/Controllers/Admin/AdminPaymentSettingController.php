<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPaymentSettingController extends Controller
{
    //
    public function index()
    {
        $paypalSetting = PaypalSetting::first();



        return view('admin.payment-setting.index',compact('paypalSetting'));
    }
 

}

