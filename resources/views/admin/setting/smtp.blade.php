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
                                <h4>Form Smtp Setting </h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Form Smtp Setting 
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
                 
                    <form action="{{ route('admin.update.smtp') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $smtp->id }}">
                   <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mailer">Mailer</label>
                            <input type="text" name="mailer" class="form-control" id="mailer" value="{{ old('mailer', $smtp->mailer) }}" placeholder="Mailer" />
                            @error('mailer')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="host">Host</label>
                            <input type="text" name="host" class="form-control" id="host" value="{{ old('host', $smtp->host) }}" placeholder="Host" />
                            @error('host')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="port">Port</label>
                            <input type="text" name="port" class="form-control" id="port" value="{{ old('port', $smtp->port) }}" placeholder="Port" />
                            @error('port')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                   </div>
                    
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $smtp->username) }}" placeholder="Username" />
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" value="{{ old('password', $smtp->password) }}" placeholder="Password" />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="encryption">Encryption</label>
                                <input type="text" name="encryption" class="form-control" id="encryption" value="{{ old('encryption', $smtp->encryption) }}" placeholder="Encryption" />
                                @error('encryption')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="from_address">From Address</label>
                                <input type="text" name="from_address" class="form-control" id="from_address" value="{{ old('from_address', $smtp->from_address) }}" placeholder="From Address" />
                                @error('from_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                     </div>

                        <div class="form-group mb-0">
                            <input type="submit" class="btn btn-primary" value="Save & Update" />
                        </div>
                    </form>
            
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

@endsection
