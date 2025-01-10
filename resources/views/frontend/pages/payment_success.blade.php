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
 

    <section class="section section--bg-white calltoaction">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 mx-auto text-center">
                    <h5 class="font-title--sm">Đặt hàng thành công</h5>
                    <p class="my-4 font-para--lg">
                        Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của chúng tôi <br> Chúng tôi sẽ cố gắng hoàn thiện hơn về sản phẩm của mình .Xin cảm ơn !
                    </p>
                    <a href="{{url('/')}}" class="button button-md button--primary">Tiếp tực mua sắm</a>
                </div>
            </div>
        </div>
    </section>

@endsection



