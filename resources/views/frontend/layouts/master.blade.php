<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Eduguard - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('frontend/dist/main.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/src/scss/vendors/plugin/css/star-rating-svg.css')}}" />
    <link rel="stylesheet" href="{{asset("frontend/src/scss/vendors/plugin/css/jquery-ui.css")}}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <link rel="icon" type="image/png" href="{{asset('frontend/dist/images/favicon/favicon.png')}}" />

    <style>
        .badged {
            display: inline-block;
            padding: 5px 5px;
   
            /* Thay đổi màu border nếu cần */
            border-radius: 5px;
            /* Thiết lập border-radius */
            margin-right: 5px;
            /* Khoảng cách giữa các badge */
            background-color: #f4cf62;
            /* Màu nền badge */
            color: #333333;
            /* Màu chữ */
            font-weight: bold;
            /* Chữ đậm */
            font-size: 10px
        }
        .badged-blue {
            display: inline-block;
            padding: 5px 5px;

            /* Thay đổi màu border nếu cần */
            border-radius: 5px;
            /* Thiết lập border-radius */
            margin-right: 5px;
            /* Khoảng cách giữa các badge */
            background-color: #1089ff;
            /* Màu nền badge */
            color: #ffffff;
            /* Màu chữ */
            font-weight: bold;
            /* Chữ đậm */
            font-size: 10px
        }
        .badged-orange{
            display: inline-block;
            padding: 5px 5px;
       
            /* Thay đổi màu border nếu cần */
            border-radius: 5px;
            /* Thiết lập border-radius */
            margin-right: 5px;
            /* Khoảng cách giữa các badge */
            background-color: #f37c4a;
            /* Màu nền badge */
            color: #ffffff;
            /* Màu chữ */
            font-weight: bold;
            /* Chữ đậm */
            font-size: 10px
        }

        .scroll-to-top, .scroll-down {
            position: fixed;
            right: 20px;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: opacity 0.3s;
        }

        .scroll-to-top {
            bottom: 20px;
            background-color: #007bff;
            color: white;
        }

        .scroll-to-top:hover {
            background-color: #0056b3;
        }

        .scroll-down {
            bottom: 70px; /* Vị trí cách nút cuộn lên */
            background-color: #28a745;
            color: white;
        }

        .scroll-down:hover {
            background-color: #218838;
        }
    </style>
</head>

<body  style="background-color: #ebebf2;" onload="loader()">
    <div class="loader">
        <span class="loader-spinner">Loading...</span>
    </div>

    <!-- Header Starts Here -->
    <header>
        @include('frontend.layouts.header-menu')
    </header>

    @yield('frontend')

    <!-- Phần Tiếp Theo -->
    <section id="nextSection">
      
    </section>

    <!-- Footer Starts Here -->
    @include('frontend.layouts.footer')

    <button id="scrollToTop" class="scroll-to-top" style="display: none;" onclick="scrollToTop()">
        ↑
    </button>

    <button id="scrollDown" class="scroll-down" onclick="scrollToNextSection()">
        ↓
    </button>

    <script src="{{asset('frontend/src/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/src/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset("frontend/src/scss/vendors/plugin/js/jquery.star-rating-svg.js")}}"></script>

    <script src="{{asset('frontend/src/js/app.js')}}"></script>
    <script src="{{asset('frontend/dist/main.js')}}"></script>

    <script src="{{asset("frontend/src/scss/vendors/plugin/js/price_range_script.js")}}"></script>
    <script src="{{asset("frontend/src/scss/vendors/plugin/js/jquery-ui.min.js")}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    

<!-- Datatable Setting JS -->

<script>
    $(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  }) 


    });

  });
</script>
<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

    <script>
        const filterBtn = document.querySelector("#filter");
        const cross = document.querySelector(".filter--cross");

        filterBtn.addEventListener("click", function () {
            let sidebar = document.querySelector(".filter-sidebar");
            sidebar.classList.toggle("active");
        });

        cross.addEventListener("click", function () {
            let sidebar = document.querySelector(".filter-sidebar");
            sidebar.classList.remove("active");
        });
    </script>
    <script>
        // Students Feedback
        $(".rating-icons-2").starRating({
            starSize: 30,
            activeColor: "#FF7A1A",
            hoverColor: "#FF7A1A",
            ratedColors: ["#FF7A1A", "#FF7A1A", "#FF7A1A", "#FF7A1A", "#FF7A1A"],
            emptyColor: "red",
            initialRating: 5,
            readOnly: true,
            useFullStars: true,
            starGradient: {
                start: "#FF7A1A",
                end: "#FF7A1A",
            },
        });
    </script>

    <script>
        function drop() {
            const dropBox = document.querySelector(".categoryDrop");
            const arrow = document.querySelector(".select-button button svg");
            arrow.classList.toggle("appear");
            dropBox.classList.toggle("appear");
        }

        // Show or hide the scroll to top button
        window.onscroll = function() {
            const scrollToTopButton = document.getElementById("scrollToTop");
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollToTopButton.style.display = "block";
            } else {
                scrollToTopButton.style.display = "none";
            }
        };

        // Scroll to the top of the page
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Scroll to the next section of the page
        function scrollToNextSection() {
            const nextSection = document.querySelector('#nextSection'); // Kiểm tra ID ở đây
            if (nextSection) {
                nextSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>
    <script>
            $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
    </script>
    @include('frontend.layouts.script')
</body>
</html>
