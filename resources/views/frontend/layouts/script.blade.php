<script type="text/javascript">
    function addToWishList(course_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log("Adding course to wishlist with ID: ", course_id);

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "{{ url('/add-to-wishlist/') }}/" + course_id,

            success: function(data) {
                console.log(data);
                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error("AJAX Error: ", textStatus);
                console.error("Error Thrown: ", errorThrown);
                console.error("Response Text: ", jqXHR.responseText);

                // Optionally show an error message to the user
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: 'An error occurred while adding to the wishlist.',
                });
            }
        });
    }


    function wishlist() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            //    url: "{{ url('/add-to-wishlist/') }}/" + course_id,

            url: "{{ url('/get-wishlist-course/') }}",
            success: function(response) {
                $('#wishQty').text(response.wishQty);

                var rows = ""
                $.each(response.wishlist, function(key, value) {
                    rows += `
  <div class="col-lg-4 col-md-6 col-md-6 mb-4">
        <div class="contentCard contentCard--course">
            <div class="contentCard-top">
                <a href="/course/details/${value.course.id}/${value.course.course_name_slug}">
                    <img src="${value.course.course_image}" alt="${value.course.course_name}" class="img-fluid" />
                </a>
            </div>
            <div class="contentCard-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        ${value.course.bestseller ? '<span class="badged">Bestseller</span>' : ''}
                        ${value.course.highestrated ? '<span class="badged">Highest Rated</span>' : ''}
                        ${value.course.discount_price == null ? '<span class="badged">New</span>' : `<div class="badged-blue">${Math.round((value.course.selling_price - value.course.discount_price) / value.course.selling_price * 100)}%</div>`}
                        <span class="badged-orange">${value.course.label}</span>
                    </div>
                    <div class="ml-auto">
                        <div id="${value.id}" onclick="wishlistRemove(this.id)"  class="btn btn-outline-danger btn-sm">
                           <i class="fas fa-trash-alt"></i>
                        </div>
                         <button class="btn btn-outline-primary btn-sm" type="submit"
                                                onclick="addToCart(${value.course.id}, '${value.course.name}','${value.course.user.id}','${value.course.course_name_slug}' )" id="button-addon2">Add cart</button>
                    </div>
                </div>
                <h5>
                    <a href="{{ url('/course/details/${value.course.id}/${value.course.course_name_slug}') }}" class="font-title--card">${value.course.course_name}</a>
                </h5>
        <div class="contentCard-info d-flex align-items-center justify-content-between">
    <a href="{{ url('/instructor/details/${value.course.user.id}') }}" class="contentCard-user d-flex align-items-center">
        <img src="${value.course.user.photo}" alt="${value.course.user.name}" style="width: 50px; height: 50px;object-fit: cover"  class="img-fluid rounded-circle" />
        <p class="font-para--md">${value.course.user.name}</p>
    </a>

    <div class="price">
        ${value.course.discount_price !== null 
            ? `<span>$${value.course.discount_price}</span><del>$${value.course.selling_price}</del>` 
            : `<span>$${value.course.selling_price}</span>`}
    </div>
</div>

                <div class="contentCard-more">
                    <div class="book d-flex align-items-center">
                        <div class="icon">
                            <img src="{{ asset('frontend/dist/images/icon/book.png') }}" alt="location" />
                        </div>
                        <span>${value.course.lessons} Lessons</span>
                    </div>
                    <div class="eye d-flex align-items-center">
                        <div class="icon">
                            <img src="{{ asset('frontend/dist/images/icon/eye.png') }}" alt="eye" />
                        </div>
                        <span>${value.course.views}</span>
                    </div>
                    <div class="clock d-flex align-items-center">
                        <div class="icon">
                            <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}" alt="clock" />
                        </div>
                        <span>${value.course.duration} Hours</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="icon">
                            <img src="{{ asset('frontend/dist/images/icon/star.png') }}" alt="star" />
                        </div>
                        <span>${value.course.rating}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

             `
                });
                $('#wishlist').html(rows);
            }
        })
    }
    wishlist();
    /// WishList Remove Start  // 
    function wishlistRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "{{ url('/wishlist-remove/') }}/" + id,


            success: function(data) {
                wishlist();
                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message   
            }
        })
    }
    /// End WishList Remove // 
</script>
<script type="text/javascript">
    function addToCart(courseId, courseName, instructorId, slug) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                course_name: courseName,
                course_name_slug: slug,
                instructor: instructorId
            },
            url: "{{ url('/cart/data/store/') }}/" + courseId,
            success: function(data) {
                miniCart();

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message   
            }
        });


    }
</script>

{{-- /// Start Mini Cart  // --}}
<script type="text/javascript">
    function limitString(str, maxLength) {
        if (str.length > maxLength) {
            return str.slice(0, maxLength) + '...';
        }
        return str;
    }

    function miniCart() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/course/mini/cart') }}",
            dataType: 'json',
            success: function(response) {
                $('p[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);
                $('h6#cartQty').text(`Courses in Cart: ${response.cartQty}`);

                var miniCart = ""
                $.each(response.carts, function(key, value) {
                    // Giới hạn độ dài tên khóa học
                    var limitedName = limitString(value.name, 30); // Giới hạn 30 ký tự

                    miniCart += `
                <ul class="list-group">
                    <li class="list-group-item d-flex align-items-center" style="position: relative;">
                        <!-- Hình ảnh -->
                        <div class="me-3" style="flex-shrink: 0;">
                            <img src="{{ asset('${value.options.image}') }}" alt="Cart image" class="img-fluid rounded" style="width: 90px; height: 90px; object-fit: cover;">
                            <div class="text-danger" id="${value.rowId}" onclick="miniCartRemove(this.id)" style="position: absolute; bottom: 5px; right: 5px; z-index: 1;">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                        </div>
                        
                        <!-- Nội dung -->
                        <div class="flex-grow-1">
                            <p class="mt-0 mb-1">
                                <a href="{{ url('/course/details/${value.id}/${value.options.slug}') }}" class="text-dark" style="font-size: 10px; font-weight: bold">${limitedName}</a>
                            </p>
                            <p class="mb-1" style="font-size: 10px;">Giảng viên: ${value.options.instructor_name}</p>
                            <p class="mb-1" style="font-size: 10px;">
                                Giá: $${value.price} 
                            </p>
                        </div>
                    </li>
                </ul>
                `;
                });
                $('#miniCart').html(miniCart);
            }
        })
    }

    miniCart();
    // Mini Cart Remove Start 
    function miniCartRemove(rowId) {
        $.ajax({
            type: 'GET',
            url: '{{ url('/minicart/course/remove/') }}/' + rowId,
            dataType: 'json',
            success: function(data) {
                miniCart();
                cart();
                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message   
            }
        })
    }

    // End Mini Cart Remove 
</script>



{{-- /// Start MyCart  // --}}
<script type="text/javascript">
    function cart() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/get-cart-course') }}",
            dataType: 'json',
            success: function(response) {
                $('span[id="cartSubTotal"]').text(response.cartTotal);
                var rows = ""
                $.each(response.carts, function(key, value) {
                    rows += `
          <div class="cart-wizard-area">
    <div class="image">
        <img src="${value.options.image}" alt="product" />
    </div>
    <div class="text">
        <h6><a href="{{ url('/course/details/${value.id}/${value.options.slug}') }}">${value.name}</a></h6>
        <p>By <a href="#">${value.options.instructor_name}</a></p>
        <div class="bottom-wizard d-flex justify-content-between align-items-center">
            <p>
                $${value.price} <span><del>$</del></span>
            </p>
           
                <div type="button" id="${value.rowId}" onclick="cartRemove(this.id)">
                 <i class="fas fa-trash-alt"></i>
                </div>
          
        </div>
    </div>
</div>

                `
                });
                $('#cartPage').html(rows);
            }
        })
    }
    cart();

    // My Cart Remove Start 
    function cartRemove(rowId) {
        $.ajax({
            type: 'GET',
            url: "{{ url('/cart-remove/') }}/" + rowId,
            dataType: 'json',
            success: function(data) {
                miniCart();
                cart();
                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message   
            }
        })
    }
</script>
{{-- /// End MyCart // --}}
{{-- /// Apply Coupon Start  // --}}
<script type="text/javascript">
    function applyCoupon() {
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                coupon_name: coupon_name
            },
            url: "{{ url('/coupon-apply') }}",
            success: function(data) {
                couponCalculation();
                if (data.validity == true) {
                    $('#couponField').hide();
                    $('#coupon-sc').text(`Coupon đã được áp dụng`);


                }

                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message   
            }
        })
    }
    /// Start Coupon Calculation Method 
    function couponCalculation() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/coupon-calculation') }}",
            dataType: 'json',
            success: function(data) {
                if (data.total) {
                    $('#couponCalField').html(
                        ` <div class="summery-wizard-text pt-0">
                            <h6>Subtotal</h6>
                            <p >$${data.total} </p>
                        </div>
                      
                        <div class="total-wizard">
                            <h6 class="font-title--card">Total:</h6>
                            <p class="font-title--card" >$${data.total}</p>
                        </div>
                           <form onsubmit="return false;">
                                <label for="coupon">Apply Coupon <span class="badged-blue" id="coupon-sc">Nhập
                                        Coupon</span></label>
                                <div class="cart-input" id="couponField">
                                    <input type="text" id="coupon_name" class="form-control" placeholder="Coupon Code" />
                                    <button type="submit" onclick="applyCoupon()" class="sm-button">Apply</button>
                                </div>
                            </form>
                        `
                    )

                } else {
                    $('#couponCalField').html(`
<div class="summery-wizard-text pt-0">
    <h6>Subtotal</h6>
    <p id="cartSubTotal">$${data.subtotal}</p>
</div>
<div class="summery-wizard-text">
    <h6>Coupon name</h6>
    <p>
        ${data.coupon_name}
        <button type="button" class="btn btn-danger text-light btn-sm ms-2" onclick="couponRemove()" >
                                           <i class="fas fa-trash-alt"></i>

        </button>
    </p>
</div>

<div class="summery-wizard-text">
    <h6>Coupon Discount</h6>
    <p>- $${data.discount_amount}</p>
</div>

<div class="total-wizard">
    <h6 class="font-title--card">Total:</h6>
    <p class="font-title--card" id="cartSubTotal"> $${data.total_amount}</p>
</div>

                    `)
                }
            }

        })
    }
    couponCalculation();
</script>
{{-- /// End Apply Coupon  // --}}
{{-- /// Remove Coupon Start  // --}}
<script type="text/javascript">
    function couponRemove() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: '{{ url('/coupon-remove') }}',
            success: function(data) {
                couponCalculation();
                $('#couponField').show();
                $('#coupon-sc').text(`Nhập Coupon`);
                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message   
            }
        })
    }
</script>
{{-- /// End Remove Coupon  // --}}
       {{-- /// Start Buy Now Button  // --}}
       <script type="text/javascript">
        function buyCourse(courseId, courseName, instructorId, slug){
             $.ajax({
                 type: "POST",
                 dataType: 'json',
                 data: { 
                     _token: '{{ csrf_token() }}',
                     course_name: courseName,
                     course_name_slug: slug,
                     instructor: instructorId
                 },
     
                 url: "{{url('/buy/data/store/')}}/"+ courseId,
                 success: function(data) {
                     miniCart();
     
                      // Start Message 
     
                 const Toast = Swal.mixin({
                       toast: true,
                       position: 'top-end',
                       showConfirmButton: false,
                       timer: 3000 
                 })
                 if ($.isEmptyObject(data.error)) {
                         
                         Toast.fire({
                         type: 'success', 
                         icon: 'success', 
                         title: data.success, 
                         });
                         // Redirect to the checkout page 
                         window.location.href = '{{url('/checkout')}}';
     
                 }else{
                    
                Toast.fire({
                         type: 'error', 
                         icon: 'error', 
                         title: data.error, 
                         })
                     }
     
                   // End Message   
                 } 
             });
        }
     
     </script>
          {{-- /// End Buy Now Button  // --}}
          <script type="text/javascript">
            function applyInsCoupon(){
                 var coupon_name = $('#coupon_name').val();
                 var course_id = $('#course_id').val();
                 var instructor_id = $('#instrutor_id').val();
                 $.ajax({
                     type: "POST",
                     dataType: 'json',
                     data: {coupon_name:coupon_name,course_id:course_id,instructor_id:instructor_id},
                     url: "{{url('/inscoupon-apply')}}",
                     success:function(data){
                         couponCalculation(); 
                         if (data.validity == true) {
                             $('#couponField').hide();
                         }
         // Start Message 
         const Toast = Swal.mixin({
                           toast: true,
                           position: 'top-end',
                           showConfirmButton: false,
                           timer: 3000 
                     })
                     if ($.isEmptyObject(data.error)) {
                             
                             Toast.fire({
                             type: 'success', 
                             icon: 'success', 
                             title: data.success, 
                             })
                     }else{
                        
                    Toast.fire({
                             type: 'error', 
                             icon: 'error', 
                             title: data.error, 
                             })
                         }
                       // End Message   
                     }
                 })
             }
         </script>