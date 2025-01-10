@extends('instructor.layouts.master')
@section('instructor')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Form</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Form Basic
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown">
                                    January 2018
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Export List</a>
                                    <a class="dropdown-item" href="#">Policies</a>
                                    <a class="dropdown-item" href="#">View Assets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Default Basic Forms</h4>
                            <p class="mb-30">All bootstrap element classies</p>
                        </div>
                        <div class="pull-right">
                            <a href="#basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                                data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>
                        </div>
                    </div>
                    <form action="{{ route('instructor.store.coupon') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Coupon</label>
                                    <select class="custom-select2 form-control"  name="course_id" style="width: 100%; height: 38px">
                                        <optgroup label="Category">
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" {{ old('category_id') == $course->id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="text-danger">{{ $errors->first('category_id') }}</div>
                                    @endif
                                </div>
                    
                                <div class="form-group">
                                    <label>Coupon Name</label>
                                    <input type="text" name="coupon_name" class="form-control" value="{{ old('coupon_name') }}">
                                    @if ($errors->has('coupon_name'))
                                        <div class="text-danger">{{ $errors->first('coupon_name') }}</div>
                                    @endif
                                </div>
                    
                                <div class="form-group">
                                    <label>Coupon Validity</label>
                                    <input class="form-control" name="coupon_validity" type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ old('coupon_validity') }}">
                                    @if ($errors->has('coupon_validity'))
                                        <div class="text-danger">{{ $errors->first('coupon_validity') }}</div>
                                    @endif
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Coupon Discount</label>
                                    <input class="form-control" name="coupon_discount" type="text" value="{{ old('coupon_discount') }}">
                                    @if ($errors->has('coupon_discount'))
                                        <div class="text-danger">{{ $errors->first('coupon_discount') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group mb-0">
                            <input type="submit" class="btn btn-primary" value="Save & Update" />
                        </div>
                    </form>
                    
                    <div class="collapse collapse-box" id="basic-form1">
                        <div class="code-box">
                            <div class="clearfix">
                                <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
                                    data-clipboard-target="#copy-pre"><i class="fa fa-clipboard"></i> Copy Code</a>
                                <a href="#basic-form1" class="btn btn-primary btn-sm pull-right" rel="content-y"
                                    data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
                            </div>
                            <pre>
                                <code class="xml copy-pre" id="copy-pre">

                        </code>
                    </pre>
                        </div>
                    </div>
                </div>
                <!-- Default Basic Forms End -->


                <!-- Input Validation End -->
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Đảm bảo sử dụng chỉ số 0
            });
        });
    </script>
@endsection
