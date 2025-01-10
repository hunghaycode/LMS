
@extends('admin.layouts.master')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- Thẻ hiển thị thông tin khóa học -->
            <div class="pd-20 card-box mb-30">
                <ul>
                    <li>
                        <div class="row no-gutters">
                            <!-- Phần hình ảnh khóa học -->
                            <div class="col-lg-4 col-md-12 col-sm-12 mr-3">
                                <div class="blog-img" style="background: url(&quot;vendors/images/img3.jpg&quot;) center center no-repeat;">
                                    <img src="{{ asset($course->course_image) }}" alt="" >
                                </div>
                            </div>
                            <!-- Phần thông tin khóa học -->
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <div class="blog-caption">
                                    <h4><a href="#">{{ $course->course_name }}</a></h4>
                                    <div class="blog-by">
                                        <p>{{ $course->course_title }}</p>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <h4 class="mb-20 h4">Course Details</h4>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-tag mr-2"></i>
                                    <span>Category</span>
                                </div>
                                <span class="badge badge-info badge-pill">{{ $course['category']['category_name'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-list mr-2"></i>
                                    <span>SubCategory</span>
                                </div>
                                <span class="badge badge-info badge-pill">{{ $course['subcategory']['sub_category_name'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-fill mr-2"></i>
                                    <span>Instructor</span>
                                </div>
                                <span class="badge badge-secondary badge-pill">{{ $course['user']['name'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-tag mr-2"></i>
                                    <span>Label</span>
                                </div>
                                <span class="badge badge-info badge-pill">{{ $course->label }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock mr-2"></i>
                                    <span>Duration</span>
                                </div>
                                <span class="badge badge-light badge-pill">{{ $course->duration }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-video mr-2"></i>
                                    <span>Video</span>
                                </div>
                                <video width="300" height="200" controls>
                                    <source src="{{ asset($course->video) }}" type="video/mp4">
                                </video>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <h4 class="mb-20 h4">Additional Information</h4>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark-text mr-2"></i>
                                    <span>Resources</span>
                                </div>
                                <span class="badge badge-info badge-pill">{{ $course->resources }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-award-fill mr-2"></i>
                                    <span>Certificate</span>
                                </div>
                                <span class="badge badge-success badge-pill">{{ $course->certificate }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-cash mr-2"></i>
                                    <span>Selling Price</span>
                                </div>
                                <span class="badge badge-success badge-pill">${{ $course->selling_price }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-tag-fill mr-2"></i>
                                    <span>Discount Price</span>
                                </div>
                                <span class="badge badge-warning badge-pill">${{ $course->discount_price }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-info-circle-fill mr-2"></i>
                                    <span>Status</span>
                                </div>
                                @if ($course->status == 1)
                                <span class="badge bg-success badge-pill">Active</span>
                                @else
                                <span class="badge bg-danger badge-pill">Inactive</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
  
</div>

        

            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Mẫu quản trị Bootstrap 4 của
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection
