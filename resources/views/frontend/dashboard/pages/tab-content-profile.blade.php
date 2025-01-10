<div class="tab-content__profile">
    <div class="tab-content__profile-content">
        <div class="about-student">
            <h6 class="font-title--card">About Me</h6>
            <p class="font-para--md">
                Hello my name is Tanya. I am a designer. My personal qualities are responsibility.
            </p>
        
            @if(Auth::user()->role == 'instructor')
                <a class="button button-md button--primary-outline w-100 my-3" href="{{ route('instructor.dashboard') }}">Truy cập trang giảng viên</a>
            @else
                <a class="button button-md button--primary-outline w-100 my-3" href="{{ route('become.instructor') }}">Trở thành giảng viên</a>
            @endif
        </div>
        
    </div>
    <div class="tab-content__profile-content">
        <div class="info-student">
            <h6 class="font-title--card">Philip Information</h6>
            <dl class="row my-0 info-student-topic">
                <dt class="col-sm-4">
                    <span>Name</span>
                </dt>
                <dd class="col-sm-8">
                    <p>Phillip Bergson</p>
                </dd>
            </dl>
            <dl class="row my-0 info-student-topic">
                <dt class="col-sm-4">
                    <span>E-mail</span>
                </dt>
                <dd class="col-sm-8">
                    <p>phillip.bergson@gmail.com</p>
                </dd>
            </dl>
            <dl class="row my-0 info-student-topic">
                <dt class="col-sm-4">
                    <span>What do you do</span>
                </dt>
                <dd class="col-sm-8">
                    <p>UI/UX Designer</p>
                </dd>
            </dl>
            <dl class="row my-0 info-student-topic">
                <dt class="col-sm-4">
                    <span>Phone Number</span>
                </dt>
                <dd class="col-sm-8">
                    <p>+8801236 968966</p>
                </dd>
            </dl>
            <dl class="row my-0 info-student-topic">
                <dt class="col-sm-4">
                    <span>Nationality</span>
                </dt>
                <dd class="col-sm-8">
                    <p>Bangladesh</p>
                </dd>
            </dl>
        </div>
    </div>
</div>