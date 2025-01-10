<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminCourseManager;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPaymentSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PaypalSettingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\Frontend\QuestionController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\Instructor\InstructorCouponController;
use App\Http\Controllers\Instructor\InstructorCourseController;
use App\Http\Controllers\Instructor\InstructorOrder;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'index'])->name('index');

Route::controller(FrontEndController::class)->group(function () {
    Route::get('/course/details/{id}/{slug}', 'courseDetail')->name('course.course-detail');
    Route::get('/category/{id}/{slug}', 'CategoryCourse');
    Route::get('/subcategory/{id}/{slug}', 'SubCategoryCourse');
    Route::get('/instructor/details/{id}',  'InstructorDetails')->name('instructor.details');
});
Route::middleware(['auth'])->controller(WishListController::class)->group(function () {
    Route::post('/add-to-wishlist/{course_id}', 'AddToWishList')->name('add.wishlist');

    Route::get('/user/wishlist', 'AllWishlist')->name('user.wishlist');
    Route::get('/get-wishlist-course/', 'GetWishlistCourse');
    Route::get('/wishlist-remove/{id}', 'RemoveWishlist');
});
// Mua ngay 
Route::post('/buy/data/store/{id}', [CartController::class, 'BuyToCart']);

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::get('/cart/data/', [CartController::class, 'CartData']);
Route::get('/course/mini/cart/', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/course/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::post('/inscoupon-apply', [CartController::class, 'InsCouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::post('/payment', [CartController::class, 'Payment'])->name('payment');
Route::get('/payment-success', [CartController::class, 'PaymentSuccess'])->name('payment-success');
// Cart All Route 
Route::controller(CartController::class)->group(function () {
    Route::get('/mycart', 'MyCart')->name('mycart');
    Route::get('/get-cart-course', 'GetCartCourse');
    Route::get('/cart-remove/{rowId}', 'CartRemove');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'UserProfile'])->name('dashboard');
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
    Route::post('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/course/view/{course_id}',[UserController::class, 'CourseView'])->name('course.view'); 
 

});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/user/question',[QuestionController::class, 'UserQuestion'])->name('user.question');  
    

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);



Route::middleware(['auth', 'roles:instructor'])->group(function () {

    Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');
    Route::post('/instructor/logout', [InstructorController::class, 'instructorLogout'])->name('instructor.logout');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');
    Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');
    Route::get('/instructor/all/question', [InstructorController::class, 'InstructorAllQuestion'])->name('instructor.all.question');
    Route::get('/question/details/{id}', [InstructorController::class, 'QuestionDetails'])->name('question.details'); 
    Route::post('/instructor/replay',[InstructorController::class,'InstructorReplay'])->name('instructor.replay'); 

    Route::get('/instructor/all/coupon',[InstructorCouponController::class,'InstructorAllCoupon'])->name('instructor.all.coupon');
    Route::get('/instructor/add/coupon',[InstructorCouponController::class,'InstructorAddCoupon'])->name('instructor.add.coupon');
    Route::post('/instructor/store/coupon',[InstructorCouponController::class,'InstructorStoreCoupon'])->name('instructor.store.coupon');
    Route:: get('/instructor/edit/coupon/{id}',[InstructorCouponController::class,'InstructorEditCoupon'])->name('instructor.edit.coupon');
    Route::post('/instructor/update/coupon',[InstructorCouponController::class,'InstructorStoreCoupon'])->name('instructor.update.coupon');
    Route::get('/instructor/delete/coupon/{id}',[InstructorCouponController::class,'InstructorDeleteCoupon'])->name('instructor.delete.coupon');
    // Route::get('/admin/all/coupon','index')->name('coupon.index');
    // Route::get('/admin/add/coupon','AdminAddCoupon')->name('add.coupon');
    // Route::post('/admin/store/coupon','AdminStoreCoupon')->name('store.coupon');
    // Route::get('/admin/edit/coupon/{id}','AdminEditCoupon')->name('edit.coupon');
    // Route::post('/admin/update/coupon','AdminUpdateCoupon')->name('update.coupon');
    // Route::get('/admin/delete/coupon/{id}','AdminDeleteCoupon')->name('delete.coupon'); 

}); // End Instructor Group Middleware 

Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login')->middleware(RedirectIfAuthenticated::class);;


// Category Routes
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->controller(CategoryController::class)->group(function () {
    Route::get('/all-category', 'index')->name('all.category');
    Route::get('/add/category', 'AddCategory')->name('add.category');
    Route::post('/store/category', 'StoreCategory')->name('store.category');
    Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::post('/category/update/{id}', 'UpdateCategory')->name('update.category');
    Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
});

// Category Routes
Route::middleware(['auth', 'roles:instructor'])->prefix('instructor')->name('instructor.')->controller(InstructorOrder::class)->group(function () {
    // Route::get('/all-category', 'index')->name('all.category');
    Route::get('/instructor/pending/order','InstructorAllOrder')->name('pending.order'); 
    Route::get('/instructor/order/details/{id}','InstructorOrderDetails')->name('order.details'); 
    Route::get('/pending-confirm/{id}','PendingToConfirm')->name('pending-confirm');

});
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->controller(AdminOrderController::class)->group(function () {
    // Route::get('/all-category', 'index')->name('all.category');
    Route::get('/admin/pending/order','AdminPendingOrder')->name('pending.order'); 
    Route::get('/admin/order/details/{id}','AdminOrderDetails')->name('order.details'); 
    Route::get('/pending-confirm/{id}','PendingToConfirm')->name('pending-confirm');

});
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->controller(SettingController::class)->group(function () {
    // Route::get('/all-category', 'index')->name('all.category');
    Route::get('/smtp/setting','SmtpSetting')->name('smtp.setting');
    Route::post('/update/smtp','SmtpUpdate')->name('update.smtp');

});
Route::middleware(['auth', 'roles:instructor'])->prefix('instructor')->name('instructor.')->controller(InstructorOrder::class)->group(function () {
    Route::get('/instructor/all/order','InstructorAllOrder')->name('all.order'); 
    Route::get('/instructor/order/details/{payment_id}','InstructorOrderDetails')->name('order.details'); 

});



// Sub Category Routes

Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->controller(SubCategoryController::class)->group(function () {
    Route::get('/all/subcategory', 'index')->name('all.subcategory');
    Route::get('/add/subcategory', 'create')->name('add.subcategory');
    Route::post('/store/subcategory', 'store')->name('store.subcategory');
    Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
    Route::post('/update/subcategory/{id}', 'UpdateSubCategory')->name('update.subcategory');
    Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');
    // Instructor All Route 

    Route::get('/all/instructor', 'AllInstructor')->name('all.instructor');
});

// Course Routes
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->controller(AdminCourseManager::class)->group(function () {
    Route::get('/all-courses', 'index')->name('all.courses.index');
    Route::post('/update/course/status', 'UpdateCourseStatus')->name('update.course.status');
    Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');

});
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->controller(AdminPaymentSettingController::class)->group(function () {
    Route::get('/admin/payment', 'index')->name('payment.all.index');
    
    // Route::post('/update/course/status', 'UpdateCourseStatus')->name('update.course.status');
    // Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');

});
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('paypal-setting', PaypalSettingController::class);

    
    // Route::post('/update/course/status', 'UpdateCourseStatus')->name('update.course.status');
    // Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');

});

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('payment', [CartController::class, 'index'])->name('payment');
    Route::get('payment', [CartController::class, 'payWithPaypal'])->name('payment');

    // Route::get('paypal/payment', [CartController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [CartController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [CartController::class, 'paypalCancel'])->name('paypal.cancel');
    /** COD routes */
    Route::get('cod/payment', [CartController::class, 'payWithCod'])->name('cod.payment');
    
    Route::get('payment-success', [CartController::class, 'paymentSuccess'])->name('payment.success');

});



// Coupon 
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->controller(AdminCouponController::class)->group(function () {
    Route::get('/admin/all/coupon','index')->name('coupon.index');
    Route::get('/admin/add/coupon','AdminAddCoupon')->name('add.coupon');
    Route::post('/admin/store/coupon','AdminStoreCoupon')->name('store.coupon');
    Route::get('/admin/edit/coupon/{id}','AdminEditCoupon')->name('edit.coupon');
    Route::post('/admin/update/coupon','AdminUpdateCoupon')->name('update.coupon');
    Route::get('/admin/delete/coupon/{id}','AdminDeleteCoupon')->name('delete.coupon'); 
});

Route::middleware(['auth', 'roles:instructor'])
    ->prefix('instructor')
    ->name('instructor.')
    ->group(function () {
        Route::get('courses/create', [InstructorCourseController::class, 'create'])->name('course.create');
        Route::get('courses/{id}', [InstructorCourseController::class, 'DeleteCourse'])->name('course.destroy');

        Route::resource('courses', InstructorCourseController::class)->names([
            'index' => 'course.index',
            // 'create' => 'course.create',
            'store' => 'course.store',
            'show' => 'course.show',
            'edit' => 'course.edit',
            'update' => 'course.update',
            // 'destroy' => 'course.destroy',
        ]);
        // Route::get('/delete/course/{id}','DeleteCourse')->name('delete.course');

        // Thêm route cho add course lecture
        Route::get('/courses/{id}/lecture', [InstructorCourseController::class, 'addLecture'])->name('add.course.lecture');
        Route::post('/add/course/section/', [InstructorCourseController::class, 'AddCourseSection'])->name('add.course.section');
        Route::post('/delete/course/section/{id}', [InstructorCourseController::class, 'DeleteSection'])->name('delete.course.section');
        Route::post('/save-lecture', [InstructorCourseController::class, 'SaveLecture'])->name('save-lecture');
        Route::get('/edit/lecture/{id}', [InstructorCourseController::class, 'EditLecture'])->name('edit.lecture');
        Route::post('/update/course/lecture', [InstructorCourseController::class, 'UpdateCourseLecture'])->name('update.lecture');
        Route::get('/delete/lecture/{id}', [InstructorCourseController::class, 'DeleteLecture'])->name('delete.lecture');

        Route::get('/subcategory/ajax/{category_id}', [InstructorCourseController::class, 'GetSubCategory']);
    });





Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');
Route::get('/become/instructor-register', [AdminController::class, 'BecomeInstructorRegister'])->name('become.instructor-register');
Route::post('/instructor/register', [AdminController::class, 'InstructorRegister'])->name('instructor.register');

Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    // Instructor All Route 

    Route::get('/all/instructor', 'AllInstructor')->name('all.instructor');
    Route::post('/update/instructor/status', 'UpdateInstructorStatus')->name('update.instructor.status');

});



require __DIR__ . '/auth.php';
