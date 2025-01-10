<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset("backend/asset/vendors/styles/core.css")}}" />
	<link rel="stylesheet" type="text/css" href="{{asset("backend/asset/vendors/styles/icon-font.min.css")}}" />
	<link rel="stylesheet" type="text/css" href="{{asset("backend/asset/vendors/styles/style.css")}}" />

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
		(function (w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
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

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="{{asset("backend/asset/vendors/images/deskapp-logo.svg")}}" alt="" />
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="{{route('become.instructor-register')}}">Register</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="{{asset("backend/asset/vendors/images/login-page-img.png")}}" alt="" />
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To DeskApp</h2>
						</div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                    
							{{-- <div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin" />
										<div class="icon">
											<img src="vendors/images/briefcase.svg" class="svg" alt="" />
										</div>
										<span>I'm</span>
										Manager
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user" />
										<div class="icon">
											<img src="vendors/images/person.svg" class="svg" alt="" />
										</div>
										<span>I'm</span>
										Employee
									</label>
								</div>
							</div> --}}
							{{-- <div class="form-group has-danger">
								<label class="form-control-label">Input with danger</label>
								<input type="text" class="form-control form-control-danger" />
								<div class="form-control-feedback">
									Sorry, that username's taken. Try another?
								</div>
								<small class="form-text text-muted">Example help text that remains
									unchanged.</small>
							</div> --}}
							<div class="input-group custom">
								<input type="email" name="email" id="email"  class="form-control @error('email')
                               form-control-danger
                                @enderror  form-control-lg" placeholder="Email" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
                                @error('email')
								<div class="form-control-feedback">
									{{$message}}
								</div>
                                @enderror
							</div>
							<div class="input-group custom">
								<input type="password" name="password" id="password" class="form-control  @error('password')
                               form-control-danger
                                @enderror   form-control-lg" placeholder="**********" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
                                @error('password')
								<div class="form-control-feedback">
									{{$message}}
								</div>
                                @enderror
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="remember"  id="remember_me" class="custom-control-input" id="customCheck1" />
										<label class="custom-control-label" for="customCheck1">Remember</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password">
										<a href="forgot-password.html">Forgot Password</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											
										-->
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										{{-- <a class="btn btn-primary btn-lg btn-block" href="index.html">Sign In</a> --}}
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
										OR
									</div>
									<div class="input-group mb-0">
										{{-- <a class="btn btn-outline-primary btn-lg btn-block"
											href="register.html">Register To Create Account</a> --}}
                                            {{-- <input class="btn btn-primary btn-lg btn-block" type="submit" value="Register To Create Account"> --}}
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
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
	<button class="welcome-modal-btn">
		<i class="fa fa-download"></i> Download
	</button>
	<!-- welcome modal end -->
	<!-- js -->
	<script src="{{asset("backend/asset/vendors/scripts/core.js")}}"></script>
	<script src="{{asset("backend/asset/vendors/scripts/script.min.js")}}"></script>
	<script src="{{asset("backend/asset/vendors/scripts/process.js")}}"></script>
	<script src="{{asset("backend/asset/vendors/scripts/layout-settings.js")}}"></script>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
			style="display: none; visibility: hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
</body>

</html>