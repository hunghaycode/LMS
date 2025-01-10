@php
$id = Auth::user()->id;
$profileData = App\Models\User::find($id);
$status = $profileData->status;
    @endphp
<div class="header-left">
    <div class="menu-icon bi bi-list"></div>
    @if ($status === '1')
    <div class="search-toggle-icon bi bi-check-circle" style="color: green; font-size: 24px;" data-toggle="header_search"></div> <!-- Icon trạng thái hoạt động -->
    @else  
    <div class="search-toggle-icon bi bi-x-circle" style="color: red; font-size: 24px;" data-toggle="header_search"></div> <!-- Icon trạng thái ko hoạt động -->
    @endif
    <div class="header-search">
        <form>
            <div class="form-group mt-3">
                @if ($status === '1')
                <h6>Instructor Account Is <span class="text-success">Active</span> </h6>
                @else   
                <h6>Instructor Account Is <span class="text-danger">InActive</span> </h6> 
               <small class="text-secondary"><b> Plz wait admin will check and approve your account</b> </small>
                @endif
            </div>
        </form>
    </div>
</div>
<div class="header-right">
    <div class="dashboard-setting user-notification">
        <div class="dropdown">
            <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                <i class="dw dw-settings2"></i>
            </a>
        </div>
    </div>
    <div class="user-notification">
        <div class="dropdown">
            <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                <i class="icon-copy dw dw-notification"></i>
                <span class="badge notification-active"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="notification-list mx-h-350 customscroll">
                    <ul>
                        <li>
                            <a href="#">
                                <img src="vendors/images/img.jpg" alt="" />
                                <h3>John Doe</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit, sed...
                                </p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="vendors/images/photo1.jpg" alt="" />
                                <h3>Lea R. Frith</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit, sed...
                                </p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="vendors/images/photo2.jpg" alt="" />
                                <h3>Erik L. Richards</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit, sed...
                                </p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="vendors/images/photo3.jpg" alt="" />
                                <h3>John Doe</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit, sed...
                                </p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="vendors/images/photo4.jpg" alt="" />
                                <h3>Renee I. Hansen</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit, sed...
                                </p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="vendors/images/img.jpg" alt="" />
                                <h3>Vicki M. Coleman</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit, sed...
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="user-info-dropdown">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                <span class="user-icon">
                    <img src="{{ (!empty($profileData->photo)) ? url($profileData->photo) : url('upload/no_image.jpg')}}" alt="" />
                </span>
                <span class="user-name">{{$profileData->username}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                <a class="dropdown-item" href="{{ route('instructor.profile') }}"><i class="dw dw-user1"></i> Profile</a>
                <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
                <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
                <form id="logout-form" action="{{ route('instructor.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="dw dw-logout"></i> Log Out
                </a>
            </div>
        </div>
    </div>
    <div class="github-link">
        <a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg"
                alt="" /></a>
    </div>
</div>


