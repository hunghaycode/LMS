@extends('frontend.layouts.master')
@section('frontend')

        <!-- Breadcrumb Starts Here -->
        <div class="event-sub-section event-sub-section--spaceY eventsearch-sub-section">
            <div class="container">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="index.html" class="fs-6 text-secondary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="course-search.html" class="fs-6 text-secondary">{{ $subcategory->category->category_name }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="course-search.html" class="fs-6 text-secondary">{{ $subcategory->sub_category_name }}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Breadcrumb Ends Here -->

        <!-- Event Search Starts Here -->
        <section class="section event-search">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        <div class="event-search-bar">
                            <form action="#">
                                <div class="form-input-group">
                                    <input type="text" class="form-control" placeholder="Search Course..." />
                                    <button class="button button-lg button--primary" type="submit" id="button-addon2">
                                        Search
                                    </button>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-search"
                                    >
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 d-none d-lg-block">
                        <div class="accordion sidebar-filter" id="sidebarFilter">
                            <!-- Category  -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="categoryAcc">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
                                        category
                                    </button>
                                </h2>
                                <div id="categoryCollapse" class="accordion-collapse collapse show" aria-labelledby="categoryAcc" data-bs-parent="#sidebarFilter">
                                    <div class="accordion-body">
                                        <form action="#">
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> All </label>
                                                </div>
                                                <p class="check-details">
                                                    1,54,750
                                                </p>
                                            </div>
                                            @foreach ($categories as $cat)
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}"><label> {{ $cat->category_name }} </label></a>
                                                </div>
                                                <p class="check-details">
                                                    45,770
                                                </p>
                                            </div>
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Level  -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="levelAcc">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#levelCollapse" aria-expanded="false" aria-controls="levelCollapse">
                                        Level
                                    </button>
                                </h2>
                                <div id="levelCollapse" class="accordion-collapse collapse" aria-labelledby="levelAcc" data-bs-parent="#sidebarFilter">
                                    <div class="accordion-body">
                                        <form action="#">
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> All </label>
                                                </div>
                                                <p class="check-details">
                                                    1,54,750
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> Beginner </label>
                                                </div>
                                                <p class="check-details">
                                                    45,770
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> Intermediate </label>
                                                </div>
                                                <p class="check-details">
                                                    35,790
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> Advanced </label>
                                                </div>
                                                <p class="check-details">
                                                    5,770
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> Expert </label>
                                                </div>
                                                <p class="check-details">
                                                    765
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Price  -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Price
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#sidebarFilter">
                                    <div class="accordion-body">
                                        <div class="price-range">
                                            <div>
                                                <div class="price-range-block">
                                                    <form class="d-flex price-range-block__inputWrapper" action="#">
                                                        <input
                                                            type="number"
                                                            min="0"
                                                            max="5000"
                                                            oninput="validity.valid||(value='0');"
                                                            id="min_price"
                                                            class="price-range-field"
                                                            style="width: 105px; height: 50px; border-radius: 4px; padding: 15px;"
                                                        />
                                                        <span>to</span>
                                                        <input
                                                            type="number"
                                                            min="0"
                                                            max="5000"
                                                            oninput="validity.valid||(value='5000');"
                                                            id="max_price"
                                                            class="price-range-field"
                                                            style="width: 125px; height: 50px; padding: 15px; border-radius: 4px;"
                                                        />
                                                        <button class="angle-btn">
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="24"
                                                                height="24"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-chevron-right"
                                                            >
                                                                <polyline points="9 18 15 12 9 6"></polyline>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <div id="slider-range" class="price-filter-range"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Rating  -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="ratingAcc">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ratingCollapse" aria-expanded="false" aria-controls="ratingCollapse">
                                        Rating
                                    </button>
                                </h2>
                                <div id="ratingCollapse" class="accordion-collapse collapse" aria-labelledby="ratingAcc" data-bs-parent="#sidebarFilter">
                                    <div class="accordion-body">
                                        <form action="#">
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> All </label>
                                                </div>
                                                <p class="check-details">
                                                    1,54,750
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 1 Star and higher </label>
                                                </div>
                                                <p class="check-details">
                                                    45,770
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 2 Star and higher </label>
                                                </div>
                                                <p class="check-details">
                                                    45,770
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 3 Star and higher </label>
                                                </div>
                                                <p class="check-details">
                                                    45,770
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 4 Star and higher </label>
                                                </div>
                                                <p class="check-details">
                                                    45,770
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 5 Star </label>
                                                </div>
                                                <p class="check-details">
                                                    45,770
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Duration  -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="durationAcc">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#durationCollapse" aria-expanded="false" aria-controls="durationCollapse">
                                        Duration
                                    </button>
                                </h2>
                                <div id="durationCollapse" class="accordion-collapse collapse" aria-labelledby="durationAcc" data-bs-parent="#sidebarFilter">
                                    <div class="accordion-body">
                                        <form action="#">
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> All </label>
                                                </div>
                                                <p class="check-details">
                                                    1,54,750
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 0 - 5 minutes </label>
                                                </div>
                                                <p class="check-details">
                                                    45,770
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 5 - 10 minutes </label>
                                                </div>
                                                <p class="check-details">
                                                    35,790
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 10 - 15 minutes </label>
                                                </div>
                                                <p class="check-details">
                                                    5,770
                                                </p>
                                            </div>
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" class="checkbox-primary" />
                                                    <label> 15+ minutes </label>
                                                </div>
                                                <p class="check-details">
                                                    765
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="event-search-results">
                            <div class="event-search-results-heading">
                                <div class="nice-select" tabindex="0">
                                    <span class="current">Most Viewed</span>
                                    <ul class="list">
                                        <li data-value="Nothing" data-display="category" class="option selected focus">
                                            Nothing
                                        </li>
                                        <li data-value="1" class="option">Some option</li>
                                        <li data-value="2" class="option">Another option</li>
                                        <li data-value="4" class="option">Potato</li>
                                    </ul>
                                </div>
                                <p>{{ count($courses) }} results found.</p>
                                <button class="button button-lg button--primary button--primary-filter d-lg-none" id="filter">
                                    <span>
                                        <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.3335 14.9999V9.55554" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3.3335 6.4444V1" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.55469 14.9999V8" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.55469 4.88886V1" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.7773 14.9999V11.1111" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.7773 7.99995V1" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M1 9.55554H5.66663" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M7.22217 4.88867H11.8888" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M13.4443 11.1111H18.111" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    Filter
                                </button>
                            </div>
                        </div>
                        <div class="row event-search-content">
                      
                            @foreach ($courses as $course)
                            <div class="col-md-6 mb-4">
                                @php
                                $amount = $course->selling_price - $course->discount_price;
                                $discount = ($amount/$course->selling_price) * 100;
                            @endphp
                                <div class="contentCard contentCard--course">
                                    <div class="contentCard-top">
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img src="{{ asset($course->course_image) }}" alt="images" class="img-fluid" /></a>
                                    </div>
                                    <div class="contentCard-bottom">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex">
                                                @if ($course->bestseller == 1)
                                                    <span class="badged mr-2">Bestseller</span>
                                                @endif
                                                @if ($course->highestrated == 1)
                                                    <span class="badged mr-2">Highest Rated</span>
                                                @endif
                                                @if ($course->discount_price == null)
                                                    <span class="badged mr-2">New</span>
                                                @else
                                                    <div class="badged-blue mr-2">{{ round($discount) }}%</div>
                                                @endif
                                                <span class="badged-orange mr-2"> {{ $course->label }}</span>
                                            </div>
                                        
                                            <div class="d-flex ml-auto">
                                                <a id="{{ $course->id }}"
                                                    onclick="addToWishList(this.id)" class="btn btn-outline-danger btn-sm mr-2" style="margin-right: 10px;">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                <a class="btn btn-outline-primary btn-sm" type="submit" id="button-addon2"  onclick="addToCart({{ $course->id }}, '{{ $course->course_name }}', '{{ $course->instructor_id }}', '{{ $course->course_name_slug }}' )">Add cart</a>
                                            </div>
                                            
                                        </div>
                                        <h5>
                                            <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International Conference on Education</a>
                                        </h5>
                                        <div class="contentCard-info d-flex align-items-center justify-content-between">
                                            <a href="{{ route('instructor.details',$course->instructor_id) }}" class="contentCard-user d-flex align-items-center">
                                                <img src="{{asset('upload/instructor_images/' . $course->user->photo)}}" alt="client-image" class="img-fluid rounded-circle" style="width: 50px; height: 50px;" />
                                                <p class="font-para--md">{{ $course['user']['name'] }}</p>
                                            </a>
                                            <div class="price">
                                    
                                                @if ($course->discount_price !== NULL)
                                                <span>${{ $course->discount_price }}</span>
                                                <del>${{ $course->selling_price }}</del>
    
                                                @else
                                                <span>${{ $course->selling_price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="contentCard-more">
                                            <div class="d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{asset("frontend/dist/images/icon/star.png")}}" alt="star" />
                                                </div>
                                                <span>4.5</span>
                                            </div>
                                            <div class="eye d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{asset("frontend/dist/images/icon/eye.png")}}" alt="eye" />
                                                </div>
                                                <span>24,517</span>
                                            </div>
                                            <div class="book d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{asset("frontend/dist/images/icon/book.png")}}" alt="location" />
                                                </div>
                                                <span>37 Lesson</span>
                                            </div>
                                            <div class="clock d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="dist/images/icon/Clock.png" alt="clock" />
                                                </div>
                                                <span>{{ $course->duration }} Hours</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
@endforeach
         
                        </div>
                        <div class="pagination-group mt-lg-5 mt-2">
                            <a href="#" class="p_prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                                    <path data-name="Icon feather-chevron-left" d="M20.5,23l-7-7,7-7" transform="translate(-12.5 -7.586)" fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </a>
                            <a href="#!1" class="cdp_i active">01</a>
                            <a href="#!2" class="cdp_i">02</a>
                            <a href="#!3" class="cdp_i">03</a>

                            <a href="#!+1" class="p_next">
                                <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.5 1L8.5 8L1.5 15" stroke="#35343E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="filter-sidebar">
            <div class="filter-sidebar__top">
                <button class="filter--cross">
                    <svg width="20" height="19" viewBox="0 0 20 19" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.5967 4.59668L5.40429 13.7891" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M5.40332 4.59668L14.5957 13.7891" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <form action="#">
                <div class="filter-sidebar__wrapper">
                    <div class="accordion sidebar-filter" id="sidebarFilter">
                        <!-- Category  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="categoryAcc">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
                                    category
                                </button>
                            </h2>
                            <div id="categoryCollapse" class="accordion-collapse collapse show" aria-labelledby="categoryAcc" data-bs-parent="#sidebarFilter">
                                <div class="accordion-body">
                                    <form action="#">
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> All </label>
                                            </div>
                                            <p class="check-details">
                                                1,54,750
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Development </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Finance & Accounting </label>
                                            </div>
                                            <p class="check-details">
                                                35,790
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> IT & Software </label>
                                            </div>
                                            <p class="check-details">
                                                5,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Offices Productivity </label>
                                            </div>
                                            <p class="check-details">
                                                765
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Personal Development </label>
                                            </div>
                                            <p class="check-details">
                                                65
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Digatal Marketing </label>
                                            </div>
                                            <p class="check-details">
                                                9,870
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Health & Fitness </label>
                                            </div>
                                            <p class="check-details">
                                                70
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Level  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="levelAcc">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#levelCollapse" aria-expanded="false" aria-controls="levelCollapse">
                                    Level
                                </button>
                            </h2>
                            <div id="levelCollapse" class="accordion-collapse collapse" aria-labelledby="levelAcc" data-bs-parent="#sidebarFilter">
                                <div class="accordion-body">
                                    <form action="#">
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> All </label>
                                            </div>
                                            <p class="check-details">
                                                1,54,750
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Beginner </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Intermediate </label>
                                            </div>
                                            <p class="check-details">
                                                35,790
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Advanced </label>
                                            </div>
                                            <p class="check-details">
                                                5,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Expert </label>
                                            </div>
                                            <p class="check-details">
                                                765
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Price  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Price
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#sidebarFilter">
                                <div class="accordion-body">
                                    <div class="price-range">
                                        <div>
                                            <div class="price-range-block">
                                                <form class="d-flex price-range-block__inputWrapper" action="#">
                                                    <input
                                                        type="number"
                                                        min="0"
                                                        max="5000"
                                                        oninput="validity.valid||(value='0');"
                                                        id="min_price"
                                                        class="price-range-field"
                                                        style="width: 105px; height: 50px; border-radius: 4px; padding: 15px;"
                                                    />
                                                    <span>to</span>
                                                    <input
                                                        type="number"
                                                        min="0"
                                                        max="5000"
                                                        oninput="validity.valid||(value='5000');"
                                                        id="max_price"
                                                        class="price-range-field"
                                                        style="width: 125px; height: 50px; padding: 15px; border-radius: 4px;"
                                                    />
                                                    <button class="angle-btn">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-chevron-right"
                                                        >
                                                            <polyline points="9 18 15 12 9 6"></polyline>
                                                        </svg>
                                                    </button>
                                                </form>
                                                <div id="slider-range" class="price-filter-range"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Rating  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="ratingAcc">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ratingCollapse" aria-expanded="false" aria-controls="ratingCollapse">
                                    Rating
                                </button>
                            </h2>
                            <div id="ratingCollapse" class="accordion-collapse collapse" aria-labelledby="ratingAcc" data-bs-parent="#sidebarFilter">
                                <div class="accordion-body">
                                    <form action="#">
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> All </label>
                                            </div>
                                            <p class="check-details">
                                                1,54,750
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 1 Star and higher </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 2 Star and higher </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 3 Star and higher </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 4 Star and higher </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 5 Star </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Duration  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="durationAcc">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#durationCollapse" aria-expanded="false" aria-controls="durationCollapse">
                                    Duration
                                </button>
                            </h2>
                            <div id="durationCollapse" class="accordion-collapse collapse" aria-labelledby="durationAcc" data-bs-parent="#sidebarFilter">
                                <div class="accordion-body">
                                    <form action="#">
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> All </label>
                                            </div>
                                            <p class="check-details">
                                                1,54,750
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 0 - 5 minutes </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 5 - 10 minutes </label>
                                            </div>
                                            <p class="check-details">
                                                35,790
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 10 - 15 minutes </label>
                                            </div>
                                            <p class="check-details">
                                                5,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 15+ minutes </label>
                                            </div>
                                            <p class="check-details">
                                                765
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <button class="button button-lg button--primary button--primary-filter w-100 d-lg-none" type="button">
                <span>
                    <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.3335 14.9999V9.55554" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3.3335 6.4444V1" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.55469 14.9999V8" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.55469 4.88886V1" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.7773 14.9999V11.1111" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.7773 7.99995V1" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M1 9.55554H5.66663" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M7.22217 4.88867H11.8888" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M13.4443 11.1111H18.111" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                Apply
            </button>
        </div>

@endsection