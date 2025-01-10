<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset("backend/asset/vendors/images/apple-touch-icon.png")}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset("backend/asset/vendors/images/favicon-32x32.png")}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("backend/asset/vendors/images/favicon-16x16.png")}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/asset/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('backend/asset/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{asset("backend/asset/vendors/styles/core.css")}}" />
    <link rel="stylesheet" type="text/css" href="{{asset("backend/asset/vendors/styles/icon-font.min.css")}}" />
    	<!-- switchery css -->
	<link rel="stylesheet" type="text/css" href="{{asset("backend/asset/src/plugins/switchery/switchery.min.css")}}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{asset("backend/asset/src/plugins/dropzone/src/dropzone.css")}}" /> --}}

<!-- CSS for DataTables -->
    <link rel="stylesheet" type="text/css" href="{{asset("backend/asset/vendors/styles/style.css")}}" />
	<link rel="stylesheet" type="text/css" href="{{asset("backend/asset/src/plugins/cropperjs/dist/cropper.css")}}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

	<!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href="{{asset("backend/asset/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" />
	<!-- bootstrap-touchspin css -->
	<link rel="stylesheet" type="text/css" href="{{asset("backend/asset/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css")}}" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->
</head>
<script>
    setTimeout(function() {
    $('.pre-loader').fadeOut('slow');
}, 1000); // 2000ms = 2s

</script>
<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="vendors/images/deskapp-logo.svg" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

    <div class="header">
 @include('admin.layouts.header')
    </div>
    @include('admin.layouts.sidebar')

 
    <div class="mobile-menu-overlay"></div>

    @yield('content')
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
                    data-color-scheme="no-preference: dark; light: light; dark: light;"
                    data-icon="octicon-repo-forked" data-size="large" data-show-count="true"
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
        <a href="https://github.com/dropways/deskapp" target="_blank"
            class="btn btn-success btn-sm mb-0 mb-md-3 w-100">
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
    <button class="welcome-modal-btn">
        <i class="fa fa-download"></i> Download
    </button>
    <!-- welcome modal end -->
    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="{{asset("backend/asset/vendors/scripts/core.js")}}"></script>
    <script src="{{asset("backend/asset/vendors/scripts/script.min.js")}}"></script>
    <script src="{{asset("backend/asset/vendors/scripts/process.js")}}"></script>
    
    <script src="{{asset("backend/asset/vendors/scripts/layout-settings.js")}}"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    
<!-- DataTables JS -->
<script src="{{ asset('backend/asset/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/asset/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/asset/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/asset/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Buttons for DataTable -->
<script src="{{ asset('backend/asset/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/asset/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/asset/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/asset/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/asset/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/asset/src/plugins/datatables/js/vfs_fonts.js') }}"></script>


<script src="{{asset("backend/asset/vendors/scripts/datatable-setting.js")}}"></script>
<script src="{{asset("backend/asset/src/plugins/switchery/switchery.min.js")}}"></script>
<!-- bootstrap-tagsinput js -->
<script src="{{asset("backend/asset/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js")}}"></script>
<!-- bootstrap-touchspin js -->
<script src="{{asset("backend/asset/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js")}}"></script>
<script src="{{ asset('backend/asset/vendors/scripts/advanced-components.js')}}"></script>

    {{-- <script src="{{asset("backend/asset/src/plugins/dropzone/src/dropzone.js")}}"></script> --}}

	{{-- <script src="{{asset("backend/asset/src/plugins/cropperjs/dist/cropper.js")}}"></script>

    <script src="{{asset("backend/asset/src/plugins/apexcharts/apexcharts.min.js")}}"></script>

    <script src="{{asset("backend/asset/vendors/scripts/dashboard3.js")}}"></script> --}}
	{{-- <script>
		Dropzone.autoDiscover = false;
		$(".dropzone").dropzone({
			addRemoveLinks: true,
			removedfile: function (file) {
				var name = file.name;
				var _ref;
				return (_ref = file.previewElement) != null
					? _ref.parentNode.removeChild(file.previewElement)
					: void 0;
			},
		});
	</script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    

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

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

</body>

</html>
