@extends('instructor.layouts.master')
@section('instructor')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- Thẻ hiển thị thông tin khóa học -->
            <div class="pd-20 card-box mb-30">
                <ul>
                    <li>
                        <div class="row no-gutters">
                            <!-- Phần hình ảnh khóa học -->
                            <div class="col-lg-4 col-md-12 col-sm-12 mr-3">
                                <div class="blog-img" style="background: url(&quot;vendors/images/img3.jpg&quot;) center center no-repeat;">
                                    <img src="{{ asset($course->course_image) }}" alt="" >
                                </div>
                            </div>
                            <!-- Phần thông tin khóa học -->
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <div class="blog-caption">
                                    <h4><a href="#">{{ $course->course_name }}</a></h4>
                                    <div class="blog-by">
                                        <p>{{ $course->course_title }}</p>
                                        <div class="pt-10">
                                            <!-- Nút để mở modal thêm phần mới -->
                                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#Medium-modal">Thêm phần</a>
                                            <form action="{{ route('instructor.add.course.section') }}" method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $course->id }}">
                                                <!-- Modal để thêm phần mới -->
                                                <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Thêm phần mới</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="text" name="section_title" class="form-control" placeholder="Nhập tiêu đề phần" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Lặp qua các phần của khóa học -->
            @foreach ($section as $key => $item)
            <div class="page-header">
                <div class="row">
                    <div class="col-md-10 col-sm-12">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <!-- Hiển thị tiêu đề phần -->
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h4>Phần {{ $key + 1 }}: {{ $item->section_title }}</h4>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-2 col-sm-12 text-right">
                        <!-- Nút để thêm bài giảng -->
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="icon-copy dw dw-more"></i> <!-- Updated icon -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <button onclick="addLectureDiv({{ $course->id }}, {{ $item->id }}, 'lectureContainer{{ $key }}')" class="dropdown-item" href="">
                                    <i class="icon-copy dw dw-add"></i> Thêm bài giảng <!-- Updated icon -->
                                </button>
                               <!-- Section Deletion -->
<form action="{{ route('instructor.delete.course.section', ['id' => $item->id]) }}" method="POST" id="delete-form-{{ $item->id }}">
    @csrf   
    <button type="button" class="dropdown-item" id="delete-section-{{ $item->id }}">
        <i class="icon-copy dw dw-delete-3"></i> Xóa Section
    </button>
</form>


                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Container cho các bài giảng trong phần này -->
                <div class="courseHide" id="lectureContainer{{ $key }}">
                    @foreach ($item->lectures as $lecture)
                        <div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
                            <div><strong>{{ $loop->iteration }}. {{ $lecture->lecture_title }}</strong></div>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="icon-copy dw dw-more"></i> <!-- Updated icon -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="{{ route('instructor.edit.lecture',['id' => $lecture->id]) }}">
                                        <i class="icon-copy dw dw-edit2"></i> Edit Bài Giảng <!-- Updated icon -->
                                    </a>
                                    <a class="dropdown-item" id="delete" href="{{ route('instructor.delete.lecture',['id' => $lecture->id]) }}">
                                        <i class="icon-copy dw dw-delete-3" ></i> Xóa Bài Giảng <!-- Updated icon -->
                                    </a>
                                    <!-- Lecture Deletion -->

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        

            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Mẫu quản trị Bootstrap 4 của
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    <script>
        // Hàm thêm một phần bài giảng mới vào giao diện
        function addLectureDiv(courseId, sectionId, containerId) {
    const lectureContainer = document.getElementById(containerId);
    const newLectureDiv = document.createElement('div');
    newLectureDiv.classList.add('lectureDiv', 'mb-3');

    newLectureDiv.innerHTML = `
        <div class="container mt-4">
            <h4 class="text-center">Tạo Bài Giảng Mới</h4>
            <form>
                <div class="mb-3">
                    <label for="lectureTitle" class="form-label">Tiêu đề bài giảng</label>
                    <input type="text" id="lectureTitle" class="form-control" placeholder="Nhập tiêu đề bài giảng" required>
                </div>
                <div class="mb-3">
                    <label for="lectureContent" class="form-label">Nội dung bài giảng</label>
                    <textarea id="lectureContent" class="form-control" placeholder="Nhập nội dung bài giảng" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="videoUrl" class="form-label">Thêm Time</label>
                    <input type="text" id="lecture_duration" name="lecture_duration" class="form-control" placeholder="Thêm Time" required>
                </div>
                 <div class="mb-3">
                    <label for="videoUrl" class="form-label">Thêm uRL</label>
                    <input type="text" id="lecture_duration" name="url" class="form-control" placeholder="Thêm URL" >
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-primary" onclick="saveLecture('${courseId}', ${sectionId}, '${containerId}')">Lưu bài giảng</button>
                    <button type="button" class="btn btn-secondary" onclick="hideLectureContainer('${containerId}')">Hủy</button>
                </div>
            </form>
        </div>
    `;

    lectureContainer.appendChild(newLectureDiv);

    // Initialize CKEditor for the new textarea
    CKEDITOR.replace('lectureContent');
}


        // Hàm ẩn container bài giảng
        function hideLectureContainer(containerId) {
            const lectureContainer = document.getElementById(containerId); // Lấy phần chứa bài giảng theo ID
            lectureContainer.style.display = 'none'; // Ẩn container
            location.reload(); // Tải lại để phản ánh thay đổi
        }

        // Hàm lưu thông tin bài giảng vào backend
        function saveLecture(courseId, sectionId, containerId) {
            const lectureContainer = document.getElementById(containerId); // Lấy container bài giảng theo ID
            const lectureTitle = lectureContainer.querySelector('input[type="text"]').value; // Lấy tiêu đề bài giảng từ input
            const lectureContent = lectureContainer.querySelector('textarea').value; // Lấy nội dung bài giảng từ textarea
            const lectureUrl = lectureContainer.querySelector('input[name="url"]').value; // Lấy URL bài giảng từ input

            // Gửi yêu cầu POST để lưu thông tin bài giảng
            fetch('{{ url("instructor/save-lecture") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Thêm CSRF token để bảo mật
                },
                body: JSON.stringify({
                    course_id: courseId, // ID khóa học
                    section_id: sectionId, // ID phần
                    lecture_title: lectureTitle, // Tiêu đề bài giảng
                    lecture_url: lectureUrl, // URL bài giảng
                    content: lectureContent, // Nội dung bài giảng
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Ghi log dữ liệu phản hồi để kiểm tra
                lectureContainer.style.display = 'none'; // Ẩn container bài giảng
                location.reload(); // Tải lại để hiển thị bài giảng mới
            })
            .catch(error => {
                console.error(error); // Ghi log bất kỳ lỗi nào xảy ra
            });
        }
    </script>

    
@endsection
