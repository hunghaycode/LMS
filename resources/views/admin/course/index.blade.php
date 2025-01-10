@extends('admin.layouts.master')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>DataTable</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" href="{{ route('admin.add.category') }}"
                                    role="button">Add Category</a>
                                {{-- data-toggle="dropdown" --}}
                                {{-- <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Table Category</h4>
                        <p class="mb-0">
                            You can find more options <a class="text-primary" href="https://datatables.net/"
                                target="_blank">Click Here</a>
                        </p>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Category Image</th>
                                    <th class="table-plus datatable-nosort">Name</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->course_image) }}" alt="{{ $item->course_name }}"
                                                style="width: 50px; height: auto;"></td>
                                        <td class="table-plus"> {{limitText($item->course_name,20)}}</td>
                                        <td>{{ $item['user']['name'] }}</td>
                                        <td>{{ $item['category']['category_name'] }}</td>
                                        <td>{{ $item->selling_price }}</td>
                                        <td><input type="checkbox" id="switch" class="switch-btn status-toggle"
                                                data-color="#4CAF50" data-secondary-color="#F44336"
                                                data-course-id="{{ $item->id }}" {{ $item->status ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="{{ route('admin.admin.course.details', $item->id) }}"><i class="dw dw-eye"></i>
                                                        View</a>
                                                    <a class="dropdown-item"
                                                        href=""><i
                                                            class="dw dw-edit2"></i> Edit</a>
                                                    <a class="dropdown-item" id="delete"
                                                        href=""><i
                                                            class="dw dw-delete-3"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                    Hingarajiya</a>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->

    <script>
        $(document).ready(function(){
            $('.status-toggle').on('change', function(){
                var courseId = $(this).data('course-id');
                var isChecked = $(this).is(':checked');
                // send an ajax request to update status 
                $.ajax({
                    url: "{{ route('admin.update.course.status') }}",
                    method: "POST",
                    data: {
                        course_id : courseId,
                        is_checked: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response){
                        toastr.success(response.message);
                    },
                    error: function(){
                    }
                });
            });
        });
    </script>
   
    
@endsection
