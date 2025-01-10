<?php
// Lấy ID của người dùng đã đăng nhập
$id = Auth::user()->id;

// Fetch the latest confirmed payments for the user's orders, grouping by course_id
$latestOrders = App\Models\Order::where('user_id', $id)
    ->join('payments', 'orders.payment_id', '=', 'payments.id') // Kết hợp với bảng payments
    ->where('payments.status', 'completed') // Lọc chỉ lấy các đơn hàng có trạng thái completed
    ->select('course_id', \DB::raw('MAX(orders.id) as max_id')) // Chọn ID đơn hàng lớn nhất cho mỗi khóa học
    ->groupBy('course_id'); // Nhóm theo course_id để lấy đơn hàng mới nhất cho mỗi khóa học

// Join the latest orders with the orders table to get complete order data
$myCourse = App\Models\Order::joinSub($latestOrders, 'latest_order', function($join) {
    $join->on('orders.id', '=', 'latest_order.max_id'); // Kết nối trên ID đơn hàng lớn nhất
})->with(['course', 'course.user']) // Tải trước dữ liệu khóa học và người dạy
  ->orderBy('latest_order.max_id', 'DESC') // Sắp xếp theo ID đơn hàng mới nhất giảm dần
  ->paginate(10); // Phân trang kết quả, hiển thị 10 khóa học mỗi trang

// Kiểm tra xem người dùng có khóa học nào không
if ($myCourse->isEmpty()) {
    echo "<p>Không tìm thấy khóa học nào.</p>"; // Hiển thị thông báo nếu không có khóa học
} else {
?>
<div class="row">
    @foreach ($myCourse as $item)  
        <div class="col-lg-4 col-md-6 mb-4"> <!-- Lưới Bootstrap cho bố cục đáp ứng -->
            <div class="contentCard contentCard--watch-course"> <!-- Thẻ khóa học -->
                <div class="contentCard-top">
                    <a href="{{ url('course/details/' . $item->course->id . '/' . $item->course->course_name_slug) }}">
                        <img src="{{ asset($item->course->course_image) }}" alt="Hình ảnh khóa học" class="img-fluid" /> <!-- Hình ảnh khóa học -->
                    </a>
                </div>
                <div class="contentCard-bottom">
                    <h5>
                        <a href="{{ url('course/details/' . $item->course->id . '/' . $item->course->course_name_slug) }}" class="font-title--card">
                            {{ limitText($item->course->course_name, 65) }} <!-- Tên khóa học với giới hạn ký tự -->
                        </a>
                    </h5>
                    <div class="contentCard-info d-flex align-items-center justify-content-between">
                        <a href="{{ route('instructor.details', $item->course->instructor_id) }}" class="contentCard-user d-flex align-items-center">
                            <img src="{{ asset('frontend/dist/images/courses/7.png') }}" alt="Hình ảnh giảng viên" class="rounded-circle" /> <!-- Hình ảnh giảng viên -->
                            <p class="font-para--md">{{ $item->course->user->name }}</p> <!-- Tên giảng viên -->
                        </a>
                        <div class="contentCard-course--status d-flex align-items-center">
                            <span class="percentage">100%</span> <!-- Tỷ lệ hoàn thành khóa học -->
                            <p>Hoàn thành</p> <!-- Trạng thái khóa học -->
                        </div>
                    </div>
                    <a class="button button-md button--primary-outline w-100 my-3" href="{{ route('course.view', $item->course_id) }}">Xem khóa học</a> <!-- Nút để xem khóa học -->
                    <div class="contentCard-watch--progress">
                        <span class="percentage" style="width: 100%;"></span> <!-- Thanh tiến trình -->
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="col-lg-12 mt-lg-5">
        <div class="pagination justify-content-center pb-0">
            {{ $myCourse->links() }} <!-- Hiển thị các liên kết phân trang để điều hướng qua danh sách khóa học -->
        </div>
    </div>
</div>

<?php
}
?> 
