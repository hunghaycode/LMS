

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>My Profile-Eduguard</title>
    <link rel="stylesheet" href="{{ asset('frontend/dist/main.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('frontend/dist/images/favicon/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <style>
        .badged {
            display: inline-block;
            padding: 5px 5px;
   
            /* Thay đổi màu border nếu cần */
            border-radius: 5px;
            /* Thiết lập border-radius */
            margin-right: 5px;
            /* Khoảng cách giữa các badge */
            background-color: #f4cf62;
            /* Màu nền badge */
            color: #333333;
            /* Màu chữ */
            font-weight: bold;
            /* Chữ đậm */
            font-size: 10px
        }
        .badged-blue {
            display: inline-block;
            padding: 5px 5px;

            /* Thay đổi màu border nếu cần */
            border-radius: 5px;
            /* Thiết lập border-radius */
            margin-right: 5px;
            /* Khoảng cách giữa các badge */
            background-color: #1089ff;
            /* Màu nền badge */
            color: #ffffff;
            /* Màu chữ */
            font-weight: bold;
            /* Chữ đậm */
            font-size: 10px
        }
        .badged-orange{
            display: inline-block;
            padding: 5px 5px;
       
            /* Thay đổi màu border nếu cần */
            border-radius: 5px;
            /* Thiết lập border-radius */
            margin-right: 5px;
            /* Khoảng cách giữa các badge */
            background-color: #f37c4a;
            /* Màu nền badge */
            color: #ffffff;
            /* Màu chữ */
            font-weight: bold;
            /* Chữ đậm */
            font-size: 10px
        }

        .scroll-to-top, .scroll-down {
            position: fixed;
            right: 20px;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: opacity 0.3s;
        }

        .scroll-to-top {
            bottom: 20px;
            background-color: #007bff;
            color: white;
        }

        .scroll-to-top:hover {
            background-color: #0056b3;
        }

        .scroll-down {
            bottom: 70px; /* Vị trí cách nút cuộn lên */
            background-color: #28a745;
            color: white;
        }

        .scroll-down:hover {
            background-color: #218838;
        }
    </style>
</head>

<body style="background-color: #ebebf2;" onload="loader()">
    <div class="loader">
        <span class="loader-spinner">Loading...</span>
    </div>
    <!-- Header Starts Here -->
    @include('frontend.dashboard.layouts.header')
    <!-- Header Ends Here -->

    <!-- Breadcrumb Starts Here -->
    <div class="py-0">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="index.html" class="fs-6 text-secondary">Home</a></li>
                    <li class="breadcrumb-item fs-6 text-secondary" aria-current="page">My Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Students Info area Starts Here -->
    <section class="section students-info">
        <div class="container">
            <div class="students-info-intro">
                <!-- profile Details   -->

                @include('frontend.dashboard.layouts.profile')

                <!-- Nav  -->
                @include('frontend.dashboard.layouts.navbar')

            </div>

            {{-- <div class="row students-info-intro d-none">
                <div class="col-lg-6">
                    <div class="students-info-intro-start">
                        <div class="image">
                            <img src="dist/images/user/user-img-01.jpg" alt="Student" />
                        </div>
                        <div class="text">
                            <h5>Phillip Bergson</h5>
                            <p>UI/UX Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="students-info-intro-end">
                        <div class="enrolled-courses">
                            <div class="enrolled-courses-icon">
                                <svg width="28" height="26" viewBox="0 0 28 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 1.625H8.8C10.1791 1.625 11.5018 2.15764 12.477 3.10574C13.4521 4.05384 14 5.33974 14 6.68056V24.375C14 23.3694 13.5891 22.405 12.8577 21.6939C12.1263 20.9828 11.1343 20.5833 10.1 20.5833H1V1.625Z"
                                        stroke="#1089FF" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M27 1.625H19.2C17.8209 1.625 16.4982 2.15764 15.523 3.10574C14.5479 4.05384 14 5.33974 14 6.68056V24.375C14 23.3694 14.4109 22.405 15.1423 21.6939C15.8737 20.9828 16.8657 20.5833 17.9 20.5833H27V1.625Z"
                                        stroke="#1089FF" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="enrolled-courses-text">
                                <h6 class="font-title--xs">24</h6>
                                <p class="fs-6 mt-1">Enrolled Courses</p>
                            </div>
                        </div>
                        <div class="completed-courses">
                            <div class="completed-courses-icon">
                                <svg width="22" height="26" viewBox="0 0 22 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M19.1716 3.95235C19.715 4.14258 20.078 4.65484 20.078 5.23051V13.6518C20.078 16.0054 19.2226 18.2522 17.7119 19.9929C16.9522 20.8694 15.9911 21.552 14.9703 22.1041L10.5465 24.4938L6.11516 22.1028C5.09312 21.5508 4.13077 20.8694 3.36983 19.9916C1.85791 18.2509 1 16.0029 1 13.6468V5.23051C1 4.65484 1.36306 4.14258 1.90641 3.95235L10.0902 1.07647C10.3811 0.974511 10.6982 0.974511 10.9879 1.07647L19.1716 3.95235Z"
                                        stroke="#00AF91" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M7.30688 12.4002L9.65931 14.7538L14.5059 9.90723" stroke="#00AF91"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="completed-courses-text">
                                <h5 class="font-title--xs">19</h5>
                                <p class="fs-6 mt-1">Completed Courses</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <nav>
                        <div class="nav" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab"
                                aria-controls="nav-profile" aria-selected="true">My Profile</button>

                            <button class="nav-link" id="nav-coursesall-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-coursesall" type="button" role="tab"
                                aria-controls="nav-coursesall" aria-selected="false">All Courses</button>

                            <button class="nav-link" id="nav-activecourses-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-activecourses" type="button" role="tab"
                                aria-controls="nav-activecourses" aria-selected="false">
                                Active Courses
                            </button>

                            <button class="nav-link" id="nav-completedcourses-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-completedcourses" type="button" role="tab"
                                aria-controls="nav-completedcourses" aria-selected="false">
                                Completed Courses
                            </button>

                            <button class="nav-link" id="nav-purchase-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-purchase" type="button" role="tab"
                                aria-controls="nav-purchase" aria-selected="false">Purchase History</button>

                            <button class="nav-link" id="nav-setting-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-setting" type="button" role="tab"
                                aria-controls="nav-setting" aria-selected="false">Setting</button>

                            <button class="nav-link" id="nav-logout-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-logout" type="button" role="tab"
                                aria-controls="nav-logout-tab" aria-selected="false">Logout</button>
                        </div>
                    </nav>
                </div>
            </div> --}}
            <div class="students-info-main">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                        aria-labelledby="nav-profile-tab">
                        @include('frontend.dashboard.pages.tab-content-profile')

                    </div>

                    <div class="tab-pane fade" id="nav-coursesall" role="tabpanel" aria-labelledby="nav-coursesall-tab">
                     
                        @include('frontend.dashboard.pages.coursesall')


                    </div>

                    <div class="tab-pane fade" id="nav-activecourses" role="tabpanel"
                        aria-labelledby="nav-activecourses-tab">
                        @include('frontend.dashboard.pages.activecourses')

                    </div>

                    <div class="tab-pane fade" id="nav-completedcourses" role="tabpanel"
                        aria-labelledby="nav-completedcourses-tab">
                        @include('frontend.dashboard.pages.completedcourses')

                    </div>

                    <div class="tab-pane fade" id="nav-purchase" role="tabpanel" aria-labelledby="nav-purchase-tab">
                        @include('frontend.dashboard.pages.nav-purchase')

                    </div>
                    <div class="tab-pane fade" id="nav-setting" role="tabpanel" aria-labelledby="nav-setting-tab">
                        @include('frontend.dashboard.pages.nav-setting', ['profileInfo' => $profileInfo])

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Starts Here -->

    @include('frontend.layouts.footer')

    <script src="{{ asset('frontend/src/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/src/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/src/js/app.js') }}"></script>
    <script src="{{ asset('frontend/dist/main.js') }}"></script>
    
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@include('frontend.layouts.script')
</body>

</html>
