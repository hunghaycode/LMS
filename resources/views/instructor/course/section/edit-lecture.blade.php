@extends('instructor.layouts.master')
@section('instructor')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- Thẻ hiển thị thông tin khóa học -->
            <div class="pd-20 card-box mb-30">
                <div class="container mt-4">
                    <h4 class="text-center">Sửa Bài Giảng</h4>
                    <form action="{{ route('instructor.update.lecture') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $clecture->id }}">
                    
                        <div class="mb-3">
                            <label for="lectureTitle" class="form-label">Tiêu đề bài giảng</label>
                            <input type="text" name="lecture_title" class="form-control" value="{{ old('lecture_title', $clecture->lecture_title) }}" required>
                            @if ($errors->has('lecture_title'))
                                <div class="text-danger">{{ $errors->first('lecture_title') }}</div>
                            @endif
                        </div>
                    
                        <div class="mb-3">
                            <label for="lectureContent" class="form-label">Nội dung bài giảng</label>
                            <textarea id="lectureContent" class="form-control" name="content" placeholder="Nhập nội dung bài giảng">{{ old('content', $clecture->content) }}</textarea>
                            @if ($errors->has('content'))
                                <div class="text-danger">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                    
                        <div class="mb-3">
                            <label for="videoUrl" class="form-label">Thêm URL Video</label>
                            <input type="text" name="url" class="form-control" id="input1" value="{{ old('url', $clecture->url) }}">
                            @if ($errors->has('url'))
                                <div class="text-danger">{{ $errors->first('url') }}</div>
                            @endif
                        </div>
                    
                        <div class="mb-3">
                            <label for="lecture_duration" class="form-label">Thêm Time</label>
                            <input type="text" id="lecture_duration" name="lecture_duration" value="{{ old('lecture_duration', $clecture->lecture_duration) }}" class="form-control" placeholder="Thêm Time" required>
                            @if ($errors->has('lecture_duration'))
                                <div class="text-danger">{{ $errors->first('lecture_duration') }}</div>
                            @endif
                        </div>
                    
                        <input type="submit" class="btn btn-primary" value="Save & Update" />
                        <a href="{{ route('instructor.add.course.lecture', ['id' => $clecture->course_id]) }}" class="btn btn-secondary">Back</a>
                    </form>
                    
                </div>
            </div>

            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Mẫu quản trị Bootstrap 4 của
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Khởi tạo CKEditor cho textarea nội dung bài giảng
    CKEDITOR.replace('lectureContent');
</script>
@endsection
