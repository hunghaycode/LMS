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
                            <h4 class="text-blue h4">Edit Course</h4>
                            <p class="mb-30">All bootstrap element classies</p>
                        </div>
                        <div class="pull-right">
                            <a href="#basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                                data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>
                        </div>
                    </div>
                    <form action="{{ route('instructor.course.update', $course->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Category</label>
                            <div class="col-sm-12 col-md-4">
                                <select class="form-control custom-select2" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <optgroup label="Category">
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $course->category_id ? 'selected' : '' }}>
                                                {{ $item->category_name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <label class="col-sm-12 col-md-2 col-form-label">Sub Category</label>
                            <div class="col-sm-12 col-md-4">
                                <select class="form-control custom-select2" name="sub_category_id" required>
                                    <option value="">Select Sub Category</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}"
                                            {{ $subcategory->id == $course->sub_category_id ? 'selected' : '' }}>
                                            {{ $subcategory->sub_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Course Label</label>
                            <div class="col-sm-12 col-md-4">
                                <select class="form-control" name="label" required>
                                    <option value="">Open this select menu</option>
                                    <option value="Beginner" {{ $course->label == 'Beginner' ? 'selected' : '' }}>Beginner
                                    </option>
                                    <option value="Middle" {{ $course->label == 'Middle' ? 'selected' : '' }}>Middle
                                    </option>
                                    <option value="Advance" {{ $course->label == 'Advance' ? 'selected' : '' }}>Advance
                                    </option>
                                </select>
                                @error('label')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <label class="col-sm-12 col-md-2 col-form-label">Certificate</label>
                            <div class="col-sm-12 col-md-4">
                                <select class="form-control" name="certificate" required>
                                    <option value="">Open this select menu</option>
                                    <option value="Yes" {{ $course->certificate == 'Yes' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="No" {{ $course->certificate == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                                @error('certificate')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Selling Price</label>
                            <div class="col-sm-12 col-md-4">
                                <input class="form-control" type="number" name="selling_price" placeholder="Selling Price"
                                    value="{{ old('selling_price', $course->selling_price) }}" required />
                                @error('selling_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <label class="col-sm-12 col-md-2 col-form-label">Discount Price</label>
                            <div class="col-sm-12 col-md-4">
                                <input class="form-control" type="number" name="discount_price"
                                    placeholder="Discount Price"
                                    value="{{ old('discount_price', $course->discount_price) }}" />
                                @error('discount_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Course Name</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="course_name"
                                    placeholder="Enter Course Name" value="{{ old('course_name', $course->course_name) }}"
                                    required />
                                @error('course_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Course Title</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="course_title"
                                    placeholder="Enter Course Title"
                                    value="{{ old('course_title', $course->course_title) }}" required />
                                @error('course_title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Video URL</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="file" name="video" accept="video/mp4, video/webm"
                                    placeholder="Enter Video URL"  />
                                    <div class="col-md-6"> 
                                        <video width="300" height="130" controls>
                                            <source src="{{ asset( $course->video ) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @error('video')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Resources</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="resources" placeholder="Enter Resources" rows="3">{{ old('resources', $course->resources) }}</textarea>
                                @error('resources')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="html-editor pd-20 card-box mb-30">
                            <h4 class="h4 text-blue">Prerequisites</h4>
                            <textarea name="prerequisites" class="textarea_editor form-control border-radius-0" placeholder="Enter text ...">{{ old('prerequisites', $course->prerequisites) }}</textarea>
                            @error('prerequisites')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="html-editor pd-20 card-box mb-30">
                            <h4 class="h4 text-blue">Description</h4>
                            <textarea class="form-control textarea_editor border-radius-0" name="description"
                                placeholder="Enter Course Description" rows="4">{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" id="input1"  value="{{ old('duration', $course->duration) }}" >
                            @error('duration')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nhãn</label>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="bestseller" value="1"
                                        {{ $course->bestseller ? 'checked' : '' }} id="bestseller">
                                    <label class="form-check-label" for="bestseller">Bestseller</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="featured" value="1"
                                        {{ $course->featured ? 'checked' : '' }} id="featured">
                                    <label class="form-check-label" for="featured">Featured</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="highest_rated" value="1"
                                        {{ $course->highest_rated ? 'checked' : '' }} id="highest_rated">
                                    <label class="form-check-label" for="highest_rated">Highest Rated</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Course Image</label>
                            <div class="col-sm-12 col-md-10 custom-file">
                                <input type="file" class="custom-file-input" id="image" name="course_image"
                                    >
                                <label class="custom-file-label" for="course_image">Choose file</label>
                                @error('course_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Show Image</label>
                            <div class="col-sm-12 col-md-10">
                                <img id="showImage"
                                    src="{{ !empty($course->course_image) ? asset($course->course_image) : url('vendors/images/photo1.jpg') }}"
                                    alt="Course Image" width="120">
                            </div>
                        </div>

                 
                        
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Additional Resources</label>
                            <div class="col-sm-12 col-md-10 add_item">
                                <div class="input-group mb-2" id="whole_extra_item_add">
                                    <input type="text" class="form-control col-8" name="course_goals[]"
                                        placeholder="Enter Additional Resource">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary addeventmore" type="button">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row" id="whole_extra_item_delete">
                            @if ($course->course_goals)
                                @foreach ($course->course_goals as $goal)
                                    <div class="col-sm-12 col-md-10 add_item">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control col-8" name="course_goals[]" 
                                                placeholder="Enter Additional Resource" value="{{ $goal->goal_name }}" >
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-danger removeeventmore" type="button">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
          
                        

                        
                        
                        <div class="form-group mb-0">
                            <input type="submit" class="btn btn-primary" value="Save & Update" />
                        </div>
                    </form>



                    <!-- Default Basic Forms End -->

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

<script type="text/javascript">
    $(document).ready(function() {
        $(".addeventmore").click(function() {
            var newField = $("#whole_extra_item_add").html();
            $("#whole_extra_item_delete").append(
                '<div class="col-sm-12 col-md-10 add_item"><div class="input-group mb-2">' +
                newField +
                '<button class="btn btn-outline-danger removeeventmore" type="button">Remove</button></div></div>'
            );
        });
    
        $(document).on("click", ".removeeventmore", function() {
            $(this).closest('.add_item').remove(); // Xóa cả nhóm input
        });
    });
    </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('select[name="category_id"]').on('change', function() {
                    var category_id = $(this).val();
                    if (category_id) {
                        $.ajax({
                            url: "{{ url('/instructor/subcategory/ajax') }}/" + category_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('select[name="sub_category_id"]').empty();
                                $('select[name="sub_category_id"]').append(
                                    '<option value="">Select Sub Category</option>');
                                $.each(data, function(key, value) {
                                    $('select[name="sub_category_id"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .sub_category_name + '</option>');
                                });
                            },
                            error: function() {
                                alert('Error loading subcategories');
                            }
                        });
                    } else {
                        $('select[name="sub_category_id"]').empty().append(
                            '<option value="">Select Sub Category</option>');
                    }
                });
            });
        </script>
    @endsection
