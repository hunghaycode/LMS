@extends('admin.layouts.master')

@section('content')


<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">Custom vertical Tab</h5>
                <div class="tab">
                    <div class="row clearfix">
                        <div class="col-md-3 col-sm-12">
                            <ul class="nav flex-column vtabs nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home4" role="tab" aria-selected="false">Paypal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#profile4" role="tab" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#contact4" role="tab" aria-selected="false">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home4" role="tabpanel">
                           @include('admin.payment-setting.section.paypal')
                                </div>
                                <div class="tab-pane fade " id="profile4" role="tabpanel">
                                    <div class="pd-20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip
                                        ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore
                                        eu fugiat nulla pariatur. Excepteur sint occaecat
                                        cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim id est laborum.
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact4" role="tabpanel">
                                    <div class="pd-20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip
                                        ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore
                                        eu fugiat nulla pariatur. Excepteur sint occaecat
                                        cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim id est laborum.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
