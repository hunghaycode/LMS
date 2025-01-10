@extends('frontend.layouts.master')
@section('frontend')
<section class="section getin-touch overflow-hidden" style="background-image: url({{ asset('frontend/dist/images/contact/bg.png') }});">
    <div class="container">
        <div class="row">
            <h2 class="font-title--md text-center">Get Become Instructor </h2>
            <div class="col-lg-5 pe-lg-4 position-relative mb-4 mb-lg-0">
    
             
                  
                        <img src="{{ asset('frontend/dist/images/signup/Illustration.png') }}" alt="Illustration Image">
            
              
            </div>
            <div class="col-lg-7 form-area">
                <form method="post" action="{{ route('instructor.register') }}" >
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control--focused @error('name') is-invalid @enderror" name="name" placeholder="Type here..." id="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Type here..." id="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-lg-2 my-2">
                        <div class="col-12">
                            <label for="username">User Name</label>
                            <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Type here...">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Type here...">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Type here...">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Type here...">
                        </div>
                    </div>
                    <div class="row my-lg-2 my-2">
                        <div class="col-12 text-end">
                            <div class="custom-control custom-checkbox mb-4 fs-15">
                                <input type="checkbox" class="custom-control-input" id="agreeCheckbox" required>
                                <label class="custom-control-label" for="agreeCheckbox">By signing, I agree to the 
                                    <a href="terms-and-conditions.html" class="text-color hover-underline">terms and conditions</a> and
                                    <a href="privacy-policy.html" class="text-color hover-underline">privacy policy</a>
                                </label>
                            </div>
                            <button type="submit" class="button button-lg button--primary fw-normal">Apply Now <i class="la la-arrow-right icon ml-1"></i></button>
                        </div>
                    </div>
                </form>
                
                <div class="form-area-shape">
                    <img src="{{asset("frontend/dist/images/shape/circle3.png")}}" alt="Shape" class="img-fluid shape-01">
                    <img src="{{asset("frontend/dist/images/shape/circle5.png")}}" alt="Shape" class="img-fluid shape-02">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
