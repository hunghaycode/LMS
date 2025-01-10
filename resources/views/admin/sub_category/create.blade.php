@extends('admin.layouts.master')
@section('content')
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
                    <form action="{{ route('admin.store.subcategory') }}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Single Select</label>
                                <select class="custom-select2 form-control"  name="category_id"
                                    style="width: 100%; height: 38px">
                                    <optgroup label="Category">
                                        @foreach ($category as $item) 
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endforeach
                                    </optgroup>
                     
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Sub Category</label>
                    
                                    <input class="form-control" type="text" name="sub_category_name" 
                                        placeholder="Johnny Brown" />
                          

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
