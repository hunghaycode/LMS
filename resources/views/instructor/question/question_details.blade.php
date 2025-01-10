@extends('instructor.layouts.master')
@section('instructor')
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp


    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="chat-profile-header clearfix">
                                <div class="left">
                                    <div class="clearfix">
                                        <div class="chat-profile-photo">
                                            <img src="{{ asset(!empty($profileData->photo)) ? url($profileData->photo) : url('upload/no_image.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="chat-profile-name">
                                            <h3>{{ $profileData->name }}</h3>
                                            <span>New York, USA</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border-radius-4 box-shadow mb-30">
                    <div class="row no-gutters">
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="chat-list bg-light-gray">
                                <div class="chat-search">

                                    <span class="ti-search"></span>
                                    <input type="text" placeholder="Search Contact" />
                                </div>
                                <div class="notification-list chat-notification-list customscroll">
                                    <ul>
                                        <li class="active">
                                            <a href="#">
                                                <img src="{{ !empty($question->user->photo) ? url( $question->user->photo) : url('upload/no_image.jpg') }}"
                                                    alt="" />
                                                <h3 class="clearfix">{{ $question['user']['name'] }}</h3>
                                                <p>
                                                    <i class="fa fa-circle text-light-green"></i> online
                                                    {{ Carbon\Carbon::parse($question->created_at)->diffForHumans() }}
                                                </p>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <div class="chat-detail">
                                <div class="chat-profile-header clearfix">
                                    <div class="left">
                                        <div class="clearfix">
                                            <div class="chat-profile-photo">
                                                <img src="vendors/images/profile-photo.jpg" alt="" />
                                            </div>
                                            <div class="chat-profile-name">
                                                <h3>{{ $question['course']['course_name'] }}</h3>
                                                <span>New York, USA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                                data-toggle="dropdown">
                                                Setting
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Export Chat</a>
                                                <a class="dropdown-item" href="#">Search</a>
                                                <a class="dropdown-item text-light-orange" href="#">Delete Chat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-box">
                                    <div class="chat-desc customscroll">
                                        <ul>
                                        
                                            <li class="clearfix">
                                                <span class="chat-img">
                                                    <img src="{{ asset(!empty($question->user->photo)) ? url('upload/user_images/' . $question->user->photo) : url('upload/no_image.jpg') }}"
                                                        alt="" />


                                                </span>
                                                <div class="chat-body clearfix">
                                                    <p>
                                                        {{ $question->question }}
                                                    </p>
                                                    <div class="chat_time">{{ $question->subject }},
                                                        {{ Carbon\Carbon::parse($question->created_at)->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </li>
                                            @foreach ($replay as $rep)
                                            <li class="clearfix admin_chat">
                                                <span class="chat-img">
                                                    <img src="vendors/images/chat-img2.jpg" alt="" />
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <p>
                                                        {{ $rep->question }}
                                                    </p>
                                                    <div class="chat_time">You, {{ Carbon\Carbon::parse($rep->created_at)->diffForHumans() }}</div>
                                                </div>
                                            </li>
                                            @endforeach
                                            {{-- <li class="clearfix">
                                            <span class="chat-img">
                                                <img src="vendors/images/chat-img1.jpg" alt="" />
                                            </span>
                                            <div class="chat-body clearfix">
                                                <p>
                                                    Essentially the brief is for you guys to build an
                                                    iOS and android app. We will do backend and web
                                                    app. We have a version one mockup of the UI,
                                                    please see it attached. As mentioned before, we
                                                    would simply hand you all the assets for the UI
                                                    and you guys code. If you have any early questions
                                                    please do send them on to myself. Ill be in touch
                                                    in coming days when we have requirements prepared.
                                                    Essentially the brief is for you guys to build an
                                                    iOS and android app. We will do backend and web
                                                    app. We have a version one mockup of the UI,
                                                    please see it attached. As mentioned before, we
                                                    would simply hand you all the assets for the UI
                                                    and you guys code. If you have any early questions
                                                    please do send them on to myself. Ill be in touch
                                                    in coming days when we have.
                                                </p>
                                                <div class="chat_time">09:40PM</div>
                                            </div>
                                        </li>
                                        <li class="clearfix admin_chat">
                                            <span class="chat-img">
                                                <img src="vendors/images/chat-img2.jpg" alt="" />
                                            </span>
                                            <div class="chat-body clearfix">
                                                <p>Maybe you already have additional info?</p>
                                                <div class="chat_time">09:40PM</div>
                                            </div>
                                        </li>
                                        <li class="clearfix admin_chat">
                                            <span class="chat-img">
                                                <img src="vendors/images/chat-img2.jpg" alt="" />
                                            </span>
                                            <div class="chat-body clearfix">
                                                <p>
                                                    It is to early to provide some kind of estimation
                                                    here. We need user stories.
                                                </p>
                                                <div class="chat_time">09:40PM</div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <span class="chat-img">
                                                <img src="vendors/images/chat-img1.jpg" alt="" />
                                            </span>
                                            <div class="chat-body clearfix">
                                                <p>
                                                    We are just writing up the user stories now so
                                                    will have requirements for you next week. We are
                                                    just writing up the user stories now so will have
                                                    requirements for you next week.
                                                </p>
                                                <div class="chat_time">09:40PM</div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <span class="chat-img">
                                                <img src="vendors/images/chat-img1.jpg" alt="" />
                                            </span>
                                            <div class="chat-body clearfix">
                                                <p>
                                                    Essentially the brief is for you guys to build an
                                                    iOS and android app. We will do backend and web
                                                    app. We have a version one mockup of the UI,
                                                    please see it attached. As mentioned before, we
                                                    would simply hand you all the assets for the UI
                                                    and you guys code. If you have any early questions
                                                    please do send them on to myself. Ill be in touch
                                                    in coming days when we have requirements prepared.
                                                    Essentially the brief is for you guys to build an
                                                    iOS and android app. We will do backend and web
                                                    app. We have a version one mockup of the UI,
                                                    please see it attached. As mentioned before, we
                                                    would simply hand you all the assets for the UI
                                                    and you guys code. If you have any early questions
                                                    please do send them on to myself. Ill be in touch
                                                    in coming days when we have.
                                                </p>
                                                <div class="chat_time">09:40PM</div>
                                            </div>
                                        </li>
                                        <li class="clearfix upload-file">
                                            <span class="chat-img">
                                                <img src="vendors/images/chat-img1.jpg" alt="" />
                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="upload-file-box clearfix">
                                                    <div class="left">
                                                        <img src="vendors/images/upload-file-img.jpg" alt="" />
                                                        <div class="overlay">
                                                            <a href="#">
                                                                <span><i class="fa fa-angle-down"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="right">
                                                        <h3>Big room.jpg</h3>
                                                        <a href="#">Download</a>
                                                    </div>
                                                </div>
                                                <div class="chat_time">09:40PM</div>
                                            </div>
                                        </li>
                                        <li class="clearfix upload-file admin_chat">
                                            <span class="chat-img">
                                                <img src="vendors/images/chat-img2.jpg" alt="" />
                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="upload-file-box clearfix">
                                                    <div class="left">
                                                        <img src="vendors/images/upload-file-img.jpg" alt="" />
                                                        <div class="overlay">
                                                            <a href="#">
                                                                <span><i class="fa fa-angle-down"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="right">
                                                        <h3>Big room.jpg</h3>
                                                        <a href="#">Download</a>
                                                    </div>
                                                </div>
                                                <div class="chat_time">09:40PM</div>
                                            </div>
                                        </li> --}}
                                        </ul>
                                    </div>
                                    <form action="{{ route('instructor.replay') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="qid" value="{{ $question->id }}">
                                        <input type="hidden" name="course_id" value="{{ $question->course->id }}">
                                        <input type="hidden" name="user_id" value="{{ $question->user->id }}">
                                        <input type="hidden" name="instructor_id" value="{{ $profileData->id }}">
                            
                                        <div class="chat-footer">
                                            <div class="file-upload">
                                                <a href="#"><i class="fa fa-paperclip"></i></a>
                                            </div>
                                            <div class="chat_text_area">
                                                <textarea name="question" placeholder="Type your message…"></textarea>
                                            </div>
                                            <div class="chat_send">
                                                <button class="btn btn-link" type="submit">
                                                    <i class="icon-copy ion-paper-airplane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
    <!-- welcome modal start -->
    <div class="welcome-modal">
        <button class="welcome-modal-close">
            <i class="bi bi-x-lg"></i>
        </button>
        <iframe class="w-100 border-0" src="https://embed.lottiefiles.com/animation/31548"></iframe>
        <div class="text-center">
            <h3 class="h5 weight-500 text-center mb-2">
                Open source
                <span role="img" aria-label="gratitude">❤️</span>
            </h3>
            <div class="pb-2">
                <a class="github-button" href="https://github.com/dropways/deskapp"
                    data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-star"
                    data-size="large" data-show-count="true"
                    aria-label="Star dropways/deskapp dashboard on GitHub">Star</a>
                <a class="github-button" href="https://github.com/dropways/deskapp/fork"
                    data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-repo-forked"
                    data-size="large" data-show-count="true"
                    aria-label="Fork dropways/deskapp dashboard on GitHub">Fork</a>
            </div>
        </div>
        <div class="text-center mb-1">
            <div>
                <a href="https://github.com/dropways/deskapp" target="_blank" class="btn btn-light btn-block btn-sm">
                    <span class="text-danger weight-600">STAR US</span>
                    <span class="weight-600">ON GITHUB</span>
                    <i class="fa fa-github"></i>
                </a>
            </div>
            <script async defer="defer" src="https://buttons.github.io/buttons.js"></script>
        </div>
        <a href="https://github.com/dropways/deskapp" target="_blank" class="btn btn-success btn-sm mb-0 mb-md-3 w-100">
            DOWNLOAD
            <i class="fa fa-download"></i>
        </a>
        <p class="font-14 text-center mb-1 d-none d-md-block">
            Available in the following technologies:
        </p>
        <div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
            <i class="fa fa-html5"></i>
        </div>
    </div>
@endsection
