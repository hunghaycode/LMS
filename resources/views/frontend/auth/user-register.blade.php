@extends('frontend.layouts.master')
@section('frontend')
    <!-- SignIn Area Starts Here -->
    <section class="signup-area overflow-hidden">
        <div class="container">
            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-5 order-2 order-lg-0">
                    <div class="signup-area-textwrapper">
                        <h4 class="font-title--md mb-0 mt-5">Sign Up</h2>
                        <p class="mt-2 mb-lg-4 mb-3">Already have account? <a href="signin.html" class="text-black-50">Sign
                                In</a></p>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-element {{ $errors->has('name') ? 'error' : (old('name') ? 'active' : '') }}">
                                        <div class="form-alert">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="form-alert-input">
                                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder=""
                                                oninput="this.parentNode.parentNode.classList.add('active');" />
                                            <div class="form-alert-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-element {{ $errors->has('email') ? 'error' : (old('email') ? 'active' : '') }}">
                                        <div class="form-alert">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="form-alert-input">
                                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder=""
                                                oninput="this.parentNode.parentNode.classList.add('active');" />
                                            <div class="form-alert-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-element {{ $errors->has('password') ? 'error' : (old('password') ? 'active' : '') }}">
                                        <div class="d-flex justify-content-between">
                                            <label for="password">Password</label>
                                            <a href="forget-password.html" class="text-primary fs-6">Forget Password</a>
                                        </div>
                                        <div class="form-alert-input">
                                            <input type="password" id="password" name="password" placeholder="Type here..."
                                                oninput="this.parentNode.parentNode.classList.add('active');" />
                                            <div class="form-alert-icon" onclick="showPassword('password', this);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </div>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-element {{ $errors->has('password_confirmation') ? 'error' : (old('password_confirmation') ? 'active' : '') }}">
                                        <label for="password_confirmation" class="w-100" style="text-align: left;">Confirm Password</label>
                                        <div class="form-alert-input">
                                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Type here..." />
                                            <div class="form-alert-icon" onclick="showPassword('password_confirmation', this);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-element d-flex align-items-center terms">
                                        <input id="terms" name="terms" class="checkbox-primary me-1" type="checkbox" required />
                                        <label for="terms" class="text-secondary mb-0 fs-6">Chấp nhận điều khoản</label>
                                    </div>
        
                                    <div class="form-element">
                                        <button type="submit" class="button button-lg button--primary w-100">Sign Up</button>
                                    </div>
                                    <span class="d-block text-center text-secondary">or sign in with</span>
                                </form>

                    </div>
                </div>
                <div class="col-lg-7 order-1 order-lg-0">
                    <div class="signup-area-image">
                        <img src="{{ asset('frontend/dist/images/signup/Illustration.png') }}" alt="Illustration Image">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
