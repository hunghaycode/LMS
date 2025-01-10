@extends('admin.layouts.master')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4>Profile</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Profile
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo">
                                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <img src="{{ !empty($profileInfo->photo) ? url( $profileInfo->photo) : url('vendors/images/photo1.jpg') }}"
                                    alt="" class="avatar-photo" />
                            </div>


                            <h5 class="text-center h5 mb-0">{{ $profileInfo->username }}</h5>
                            <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                            <div class="profile-info">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                <ul>
                                    <li><span>Email Address:</span> {{$profileInfo->email}}</li>
                                    <li><span>Phone Number:</span>  {{$profileInfo->phone}}</li>
                                    <li><span>Address:</span>  {{$profileInfo->address}}</li>
                                </ul>
                            </div>
                            <div class="profile-social">
                                <h5 class="mb-20 h5 text-blue">Social Links</h5>
                                <ul class="clearfix">
                                    <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i
                                                class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i
                                                class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i
                                                class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i
                                                class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <div class="profile-skills">
                                <h5 class="mb-20 h5 text-blue">Key Skills</h5>
                                <h6 class="mb-5 font-14">HTML</h6>
                                <div class="progress mb-20" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h6 class="mb-5 font-14">Css</h6>
                                <div class="progress mb-20" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#setting"
                                                role="tab">Settings</a>

                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Password</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active fade height-100-p" id="setting" role="tabpanel">
                                            <div class="profile-setting">
                                                <form method="POST" action="{{ route('admin.profile.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <ul class="profile-edit-list row">
                                                        <li class="weight-500 col-md-6">
                                                            <h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
                                                            <div class="input-group mb-3">
                                                                <div class="custom-file">
                                                                    <input type="file" name="photo"
                                                                        class="custom-file-input" id="image">
                                                                    <label class="custom-file-label" for="image">Choose
                                                                        file</label>
                                                                </div>
                                                            </div>

                                                            <img id="showImage"
                                                                src="{{ !empty($profileInfo->photo) ? url($profileInfo->photo) : url('vendors/images/photo1.jpg') }}"
                                                                alt="Admin" class="rounded-circle p-1 "
                                                                width="120">
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="name"
                                                                    value="{{ old('name', $profileInfo->name) }}" />
                                                                @error('name')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="username"
                                                                    value="{{ old('username', $profileInfo->username) }}" />
                                                                @error('username')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control form-control-lg" type="email"
                                                                    name="email"
                                                                    value="{{ old('email', $profileInfo->email) }}" />
                                                                @error('email')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Phone Number</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="phone"
                                                                    value="{{ old('phone', $profileInfo->phone) }}" />
                                                                @error('phone')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <textarea class="form-control" name="address">{{ old('address', $profileInfo->address) }}</textarea>
                                                                @error('address')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Update Information" />
                                                            </div>
                                                        </li>
                                                        <li class="weight-500 col-md-6">
                                                            <h4 class="text-blue h5 mb-20">Edit Social Media Links</h4>
                                                            <div class="form-group">
                                                                <label>Facebook URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="facebook"
                                                                    value="{{ old('facebook', $profileInfo->facebook) }}"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Twitter URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="twitter"
                                                                    value="{{ old('twitter', $profileInfo->twitter) }}"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Save & Update" />
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Setting Tab End -->
                                        <!-- Tasks Tab start -->
                                        <div class="tab-pane fade" id="tasks" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="profile-setting">
                                                    <form method="POST" action="{{ route('admin.password.update') }}">
                                                        @csrf
                                                        <ul class="profile-edit-list row">
                                                            <li class="weight-500 col-md-6">
                                                                <h4 class="text-blue h5 mb-20">Edit Your Personal Setting
                                                                </h4>
                                                                <div class="form-group">
                                                                    <label>Old Password</label>
                                                                    <input type="password" name="old_password"
                                                                        class="form-control @error('old_password') is-invalid @enderror"
                                                                        id="old_password" />
                                                                    @error('old_password')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>New Password</label>
                                                                    <input type="password" name="new_password"
                                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                                        id="new_password" />
                                                                    @error('new_password')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Confirm New Password </label>
                                                                    <input type="password" name="new_password_confirmation" class="form-control   class="form-control @error('new_password') is-invalid @enderror"" id="new_password_confirmation" /> 
                                                                    
                                                                    @error('new_password')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-0">
                                                                    <input type="submit" class="btn btn-primary"
                                                                        value="Save & Update" />
                                                                </div>
                                                    </form>


                                                </div>
                                                <!-- Open Task End -->

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tasks Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
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
