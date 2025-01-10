@php
    $courses = App\Models\Course::where('status', 1)->orderBy('id', 'ASC')->limit(6)->get();
    $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
@endphp

<section class="section section--bg-offwhite-three featured-popular-courses main-popular-course">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="featured-popular-courses-heading d-flex align-content-center justify-content-between">
                    <div class="main-heading">
                        <h3 class="font-title--md">Our Popular Courses</h3>
                    </div>
                    <div class="nav-button featured-popular-courses-tabs">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link  ps-0" id="pills-all-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all"
                                    aria-selected="true">
                                    All
                                </button>
                            </li>
                            @foreach ($categories as $category)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-{{ $category->id }}-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-{{ $category->id }}" type="button" role="tab"
                                        aria-controls="pills-{{ $category->id }}" aria-selected="false">
                                        {{ $category->category_name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="row">
                        @foreach ($courses as $course)
                            @php
                                $amount = $course->selling_price - $course->discount_price;
                                $discount = ($amount / $course->selling_price) * 100;
                            @endphp
                            <div class="col-xl-4 col-md-6">

                                <div class="contentCard contentCard--course">
                                    <div class="contentCard-top">
                                        <a href="{{ url('course/details/' . $course->id . '/' . $course->course_name_slug) }}"><img
                                                src="{{ asset($course->course_image) }}" alt="images"
                                                class="img-fluid" /></a>
                                    </div>
                                    <div class="contentCard-bottom">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                @if ($course->bestseller == 1)
                                                    <span class="badged">Bestseller</span>
                                                @endif
                                                @if ($course->highestrated == 1)
                                                    <span class="badged">Highest Rated</span>
                                                @endif
                                                @if ($course->discount_price == null)
                                                    <span class="badged">New</span>
                                                @else
                                                    <div class="badged-blue">{{ round($discount) }}%</div>
                                                @endif
                                                <span class="badged-orange"> {{ $course->label }}</span>
                                            </div>

                                            <div class="ml-auto">
                                                <div id="{{ $course->id }}" onclick="addToWishList(this.id)"
                                                    class="btn btn-outline-danger btn-sm">

                                                    <i class="fas fa-heart"></i>
                                                </div>

                                                <button class="btn btn-outline-primary btn-sm" type="submit"
                                                    onclick="addToCart({{ $course->id }}, '{{ $course->course_name }}','{{ $course->instructor_id }}','{{ $course->course_name_slug }}' )"
                                                    id="button-addon2">Add cart</button>
                                            </div>

                                        </div>
                                        <h5>
                                            <a href="{{ url('course/details/' . $course->id . '/' . $course->course_name_slug) }}"
                                                class="font-title--card">{{ limitText($course->course_name, 65) }}</a>
                                        </h5>
                                        <div class="contentCard-info d-flex align-items-center justify-content-between">
                                            <a href="{{ route('instructor.details', $course->instructor_id) }}"
                                                class="contentCard-user d-flex align-items-center">
                                                <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                    alt="client-image" class="rounded-circle" />
                                                <p class="font-para--md">{{ $course['user']['name'] }}</p>
                                            </a>
                                            <div class="price">
                                                @if ($course->discount_price !== null)
                                                    <span>${{ $course->discount_price }}</span>
                                                    <del>${{ $course->selling_price }}</del>
                                                @else
                                                    <span>${{ $course->selling_price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="contentCard-more">
                                            <div class="book d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                        alt="location" />
                                                </div>
                                                <span>5</span>
                                            </div>


                                            <div class="eye d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                        alt="eye" />
                                                </div>
                                                <span>24,517</span>
                                            </div>

                                            <div class="clock d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                        alt="clock" />
                                                </div>
                                                <span>3 Hours</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                        alt="star" />
                                                </div>
                                                <span>4.5</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="course-search.html" class="button button-lg button--primary">Browse all
                                Courses</a>
                        </div>
                    </div>
                </div>
                @foreach ($categories as $category)
                    <div class="tab-pane fade" id="pills-{{ $category->id }}" role="tabpanel"
                        aria-labelledby="pills-{{ $category->id }}-tab">
                        <div class="row">
                            @foreach ($category->courses as $course)
                                <!-- Filtered by category -->
                                @php
                                    $amount = $course->selling_price - $course->discount_price;
                                    $discount = ($amount / $course->selling_price) * 100;
                                @endphp
                                <div class="col-xl-4 col-md-6">
                                    <div class="contentCard contentCard--course">
                                        <div class="contentCard-top">
                                            <a
                                                href="{{ url('course/details/' . $course->id . '/' . $course->course_name_slug) }}"><img
                                                    src="{{ asset($course->course_image) }}" alt="images"
                                                    class="img-fluid" /></a>
                                        </div>
                                        <div class="contentCard-bottom">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    @if ($course->bestseller == 1)
                                                        <span class="badged">Bestseller</span>
                                                    @endif
                                                    @if ($course->highestrated == 1)
                                                        <span class="badged">Highest Rated</span>
                                                    @endif
                                                    @if ($course->discount_price == null)
                                                        <span class="badged">New</span>
                                                    @else
                                                        <div class="badged-blue">{{ round($discount) }}%</div>
                                                    @endif
                                                    <span class="badged-orange"> {{ $course->label }}</span>
                                                </div>

                                                <div class="ml-auto">
                                                    <div id="{{ $course->id }}" onclick="addToWishList(this.id)"
                                                        class="btn btn-outline-danger btn-sm">

                                                        <i class="fas fa-heart"></i>
                                                    </div>

                                                    <button class="btn btn-outline-primary btn-sm" type="submit"
                                                        onclick="addToCart({{ $course->id }}, '{{ $course->course_name }}','{{ $course->instructor_id }}','{{ $course->course_name_slug }}' )"
                                                        id="button-addon2">Add cart</button>
                                                </div>
                                            </div>
                                            <h5>
                                                <a href="{{ url('course/details/' . $course->id . '/' . $course->course_name_slug) }}"
                                                    class="font-title--card">{{ limitText($course->course_name, 65) }}</a>
                                            </h5>
                                            <div
                                                class="contentCard-info d-flex align-items-center justify-content-between">
                                                <a href="{{ route('instructor.details', $course->instructor_id) }}"
                                                    class="contentCard-user d-flex align-items-center">
                                                    <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                        alt="client-image" class="rounded-circle" />
                                                    <p class="font-para--md">{{ $course['user']['name'] }}</p>
                                                </a>
                                                <div class="price">
                                                    @if ($course->discount_price == null)
                                                        <span>${{ $course->selling_price }}</span>
                                                    @else
                                                        <span>${{ $course->discount_price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="contentCard-more">
                                                <div class="book d-flex align-items-center">
                                                    <div class="icon">
                                                        <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                            alt="location" />
                                                    </div>
                                                    <span>5</span>
                                                </div>
                                                <div class="eye d-flex align-items-center">
                                                    <div class="icon">
                                                        <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                            alt="eye" />
                                                    </div>
                                                    <span>24,517</span>
                                                </div>
                                                <div class="clock d-flex align-items-center">
                                                    <div class="icon">
                                                        <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                            alt="clock" />
                                                    </div>
                                                    <span>3 Hours</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon">
                                                        <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                            alt="star" />
                                                    </div>
                                                    <span>4.5</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="course-search.html" class="button button-lg button--primary">Browse all
                                    Courses</a>
                            </div>
                        </div>
                    </div>
                @endforeach


                {{-- <div class="tab-pane fade" id="pills-design" role="tabpanel" aria-labelledby="pills-design-tab">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-01.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-02.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-03.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="course-search.html" class="button button-lg button--primary">Browse all
                                Courses</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-dev" role="tabpanel" aria-labelledby="pills-dev-tab">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-01.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-02.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="course-search.html" class="button button-lg button--primary">Browse all
                                Courses</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-bus" role="tabpanel" aria-labelledby="pills-bus-tab">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-01.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-02.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-03.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-04.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="course-search.html" class="button button-lg button--primary">Browse all
                                Courses</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-its" role="tabpanel" aria-labelledby="pills-its-tab">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="contentCard contentCard--course">
                                <div class="contentCard-top">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"><img
                                            src="{{ asset('frontend/dist/images/courses/demo-img-01.png') }}"
                                            alt="images" class="img-fluid" /></a>
                                </div>
                                <div class="contentCard-bottom">
                                    <h5>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="font-title--card">Chicago International
                                            Conference on Education</a>
                                    </h5>
                                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                                        <a href="{{ route('instructor.details',$course->instructor_id) }}"
                                            class="contentCard-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}"
                                                alt="client-image" class="rounded-circle" />
                                            <p class="font-para--md">Brandon Dias</p>
                                        </a>
                                        <div class="price">
                                            <span>$12</span>
                                            <del>$95</del>
                                        </div>
                                    </div>
                                    <div class="contentCard-more">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                    alt="star" />
                                            </div>
                                            <span>4.5</span>
                                        </div>
                                        <div class="eye d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                    alt="eye" />
                                            </div>
                                            <span>24,517</span>
                                        </div>
                                        <div class="book d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                    alt="location" />
                                            </div>
                                            <span>37 Lesson</span>
                                        </div>
                                        <div class="clock d-flex align-items-center">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                    alt="clock" />
                                            </div>
                                            <span>3 Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="course-search.html" class="button button-lg button--primary">Browse all
                                Courses</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="featured-popular-courses-shape">
        <img src="{{ asset('frontend/dist/images/shape/dots/dots-img-12.png') }}" alt="Shape"
            class="img-fluid dot-06" />
        <img src="{{ asset('frontend/dist/images/shape/triangel.png') }}" alt="Shape" class="img-fluid dot-07" />
    </div>
</section>
