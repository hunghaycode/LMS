@extends('frontend.layouts.master')
@section('frontend')
    <!-- Breadcrumb Starts Here -->
    <div class="py-0">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 align-items-center">
                    <li class="breadcrumb-item"><a href="index.html" class="fs-6 text-secondary">Home</a></li>
                    <li class="breadcrumb-item active"><a href="checkout.html" class="fs-6 text-secondary">Checkout</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Checkout Area Starts Here -->
    <section class="section checkout-area">
        <div class="container">
            <form method="post" action="{{ route('payment') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 checkout-area-checkout">
                        <h6 class="checkout-area__label">Checkout</h6>
                        <div class="checkout-tab">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-cod" role="tabpanel" aria-labelledby="pills-cod-tab">
                                    <div class="mb-3">
                                        <label for="first-name">First Name</label>
                                        <input class="form-control" type="text" name="name" id="first-name" value="{{ Auth::user()->name }}" required>
                                    </div>
                             
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control" required />
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6 mb-3 mb-lg-0">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" placeholder="Type here" name="address" id="address" value="{{ Auth::user()->address }}" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone">Phone</label>
                                                <input class="form-control" type="tel" name="phone" id="phone" value="{{ Auth::user()->phone }}" required />
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="mb-4">
                                        <label class="form-label">Payment Method</label>
                                        <div class="form-check">
                                            <input type="radio" name="cash_delivery" id="payment-cod" value="handcash" checked>
                                            <label class="form-check-label" for="payment-cod">
                                                <span class="icon">🪙</span> COD
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="cash_delivery" id="payment-paypal" value="paypal">
                                            <label class="form-check-label" for="payment-paypal">
                                                <span class="icon">💵</span> Paypal
                                            </label>
                                        </div>
                                    </div> --}}
                                    <div class="mb-4">
                                        <label class="form-label">Payment Method</label>
                                        <div class="form-check">
                                            <input type="radio" name="cash_delivery" id="payment-cod" value="handcash" checked>
                                            <label class="form-check-label" for="payment-cod">
                                                <span class="icon">🪙</span> COD (Cash on Delivery)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="cash_delivery" id="payment-paypal" value="paypal">
                                            <label class="form-check-label" for="payment-paypal">
                                                <span class="icon">💵</span> PayPal
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <button type="button" id="submit-payment" class="btn btn-primary">Submit Payment</button>
                                    
                                    <script>
                                    document.getElementById('submit-payment').addEventListener('click', function() {
                                        const selectedPaymentMethod = document.querySelector('input[name="cash_delivery"]:checked').value;
                                        if (selectedPaymentMethod === 'paypal') {
                                            window.location.href = "{{ route('payment') }}";
                                        } else {
                                            // Handle COD submission (you might want to add more logic here)
                                            alert('COD payment method selected.');
                                        }
                                    });
                                    </script>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="checkout-area-summery">
                            <h6 class="checkout-area__label">Summary</h6>
                            <div class="cart"> <!-- Bắt đầu khối giỏ hàng -->
                                <div class="cart__includes-info cart__includes-info--bordertop-0"> <!-- Thông tin giỏ hàng -->
                                    <div class="productContent__wrapper"> <!-- Wrapper chứa các sản phẩm trong giỏ hàng -->
                                        @foreach ($carts as $item) <!-- Lặp qua từng sản phẩm trong giỏ hàng -->
                                            <input type="hidden" name="slug[]" value="{{ $item->options->slug }}"> <!-- Thêm slug của khóa học -->
                                            <input type="hidden" name="course_id[]" value="{{ $item->id }}"> <!-- Thêm ID của khóa học -->
                                            <input type="hidden" name="course_title[]" value="{{ $item->name }}"> <!-- Thêm tiêu đề của khóa học -->
                                            <input type="hidden" name="price[]" value="{{ $item->price }}"> <!-- Thêm giá của khóa học -->
                                            <input type="hidden" name="instructor_id[]" value="{{ $item->options->instructor }}"> <!-- Thêm ID của giảng viên -->
                                            
                                            <div class="productContent"> <!-- Thông tin sản phẩm -->
                                                <div class="productContent-item__img productContent-item"> <!-- Hình ảnh sản phẩm -->
                                                    <img src="{{ asset($item->options->image) }}" alt="checkout" /> <!-- Hiển thị hình ảnh khóa học -->
                                                </div>
                                                <div class="productContent-item__info productContent-item"> <!-- Thông tin chi tiết sản phẩm -->
                                                    <h6 class="font-para--lg">
                                                        <a href="{{ url('course/details/' . $item->id . '/' . $item->options->slug) }}">{{ $item->name }}</a> <!-- Liên kết đến trang chi tiết khóa học -->
                                                    </h6>
                                                    <p>by {{ $item->options->instructor_name }}</p> <!-- Hiển thị tên giảng viên -->
                                                    <div class="price"> <!-- Khối hiển thị giá -->
                                                        <h6 class="font-para--md">${{ $item->price }}</h6> <!-- Hiển thị giá khóa học -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach <!-- Kết thúc vòng lặp -->
                                    </div>
                                    
                                    <!-- Nút chỉnh sửa giỏ hàng -->
                                    <a href="{{ route('mycart') }}" class="btn btn-secondary text-light btn-sm">
                                        <i class="la la-edit mr-1"></i>Edit
                                    </a>
                                </div>
                                
                                <div class="cart__checkout-process"> <!-- Bắt đầu khối thông tin thanh toán -->
                                    @if (Session::has('coupon')) <!-- Kiểm tra xem có coupon không -->
                                        <ul> <!-- Danh sách hiển thị thông tin thanh toán với coupon -->
                                            <li>
                                                <p>Subtotal</p> <!-- Tiêu đề cho tổng tạm tính -->
                                                <p>${{ $cartTotal }}</p> <!-- Hiển thị tổng tạm tính -->
                                            </li>
                                            <li>
                                                <p>Coupon Name</p> <!-- Tiêu đề cho tên coupon -->
                                                <p>{{ session()->get('coupon')['coupon_name'] }} ({{ session()->get('coupon')['coupon_discount'] }} %)</p> <!-- Hiển thị tên và tỷ lệ giảm giá của coupon -->
                                            </li>
                                            <li>
                                                <p>Coupon Discount</p> <!-- Tiêu đề cho giảm giá từ coupon -->
                                                <p>${{ session()->get('coupon')['discount_amount'] }}</p> <!-- Hiển thị số tiền giảm giá từ coupon -->
                                            </li>
                                            <li>
                                                <p class="font-title--card">Total</p> <!-- Tiêu đề cho tổng cộng -->
                                                <p class="total-price font-title--card">${{ session()->get('coupon')['total_amount'] }}</p> <!-- Hiển thị tổng số tiền sau khi áp dụng coupon -->
                                            </li>
                                            <input type="hidden" name="total" value="{{ session()->get('coupon')['total_amount'] }}"> <!-- Lưu tổng số tiền vào input ẩn -->
                                        </ul>
                                    @else <!-- Nếu không có coupon -->
                                        <ul> <!-- Danh sách hiển thị thông tin thanh toán không có coupon -->
                                            <li>
                                                <p class="font-title--card">Total:</p> <!-- Tiêu đề cho tổng cộng -->
                                                <p class="total-price font-title--card">${{ $cartTotal }}</p> <!-- Hiển thị tổng số tiền giỏ hàng -->
                                            </li>
                                            <input type="hidden" name="total" value="{{ $cartTotal }}"> <!-- Lưu tổng số tiền vào input ẩn -->
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- <button type="submit" c            lass="button button-lg button--primary w-50 mt-4">Confirm Payment</button> --}}
            </form>
        </div>
    </section>
    <!-- Checkout Area Ends Here -->
@endsection
