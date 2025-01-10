@extends('frontend.layouts.master')
@section('frontend')
    <!-- Breadcrumb Starts Here -->
    <div class="py-0">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="index.html" class="fs-6 text-secondary">Home</a></li>
                    <li class="breadcrumb-item active"><a href="cart.html" class="fs-6 text-secondary">Cart</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb Ends Here -->

    <!-- Cart Section Starts Here -->
    <section class="section cart-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h6 class="cart-area__label " id="cartQty"> Courses in Cart</h6>
                    <div id="cartPage">


                    </div>
                </div>
                <div class="col-lg-4">
                    <h6 class="cart-area__label">Summery</h6>
             
                    <div class="summery-wizard" id="couponCalField">


                    </div>
                    <div class="py-3">
                        <a href="{{ route('checkout') }}"
                            class="button button-lg button--primary form-control mb-lg-3">Checkout</a>
                    </div>
                    {{-- @if (Session::has('coupon'))
                    @else
                        <div class="summery-wizard">
                            <form onsubmit="return false;">
                                <label for="coupon">Apply Coupon <span class="badged-blue" id="coupon-sc">Nhập
                                        Coupon</span></label>
                                <div class="cart-input" id="couponField">
                                    <input type="text" id="coupon_name" class="form-control" placeholder="Coupon Code" />
                                    <button type="submit" onclick="applyCoupon()" class="sm-button">Apply</button>
                                </div>
                            </form>
                        </div>
                    @endif --}}
                   
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section Ends Here -->
@endsection


{{-- {{ json_encode(Session::get('coupon'), JSON_PRETTY_PRINT) }} --}}
