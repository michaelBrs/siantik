
<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>@yield('title', 'Siantik')</title>
        <meta charset="utf-8" />
        <meta name="description" content="Dashboard Siantik - Sistem Informasi Admin Tiket & Pelaporan" />
        <meta name="keywords" content="Siantik, Admin, Laravel, Dashboard, Bootstrap" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="id_ID" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Siantik - Dashboard Admin Laravel" />
        <meta property="og:url" content="{{ url('/') }}" />
        <meta property="og:site_name" content="Siantik" />
        <link rel="canonical" href="{{ url('/') }}" />
        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->

        <!--begin::Page Vendor Stylesheets-->
        <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->

        <!--begin::Global Stylesheets Bundle-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
	</head>
	<body>
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<!-- Aside Section -->
			<div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color: #990000">
				<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
					<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
						<a href="/" class="py-9 mb-5">
							<img alt="Logo" src="{{ asset('assets/media/logos/logo-demo13.svg') }}" class="h-80px" />
						</a>
						<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #FFFFFF;">Welcome to Siantik</h1>
						<p class="fw-bold fs-2" style="color: #F8F8FF;">Sistem Informasi Asesmen Nilai Tingkat Kematangan Teknologi Informasi dan Komunikasi.</p>
					</div>
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
						style="background-image: url('{{ asset('assets/media/illustrations/unitedpalms-1/13.png') }}')">
					</div>
				</div>
			</div>

			<!-- Login Form Section -->
			<div class="d-flex flex-column flex-lg-row-fluid py-10" style="background-color: #1A1A2E">
				<div class="d-flex flex-center flex-column flex-column-fluid">
					<div class="w-lg-500px p-10 p-lg-15 mx-auto">
						<div class="rounded shadow-sm p-10" style="background-color: #FFFFFF">
							<form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate">
								@csrf
								<div class="text-center mb-10">
									<h1 class="mb-3" style="border-color:white; color: #ba0d0d;">Login</h1>
									<div class="text-gray-400 fw-bold fs-4">Masukan Email dan Password
										{{-- <a href="{{ route('register') }}" class="link-primary fw-bolder">Create an Account</a> --}}
									</div>
								</div>

								@if ($errors->any())
									<div class="alert alert-danger">
										<ul class="mb-0">
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif

								<div class="fv-row mb-10">
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<input id="email" type="email" name="email" class="form-control form-control-lg form-control-solid" required autofocus>
								</div>

								<div class="fv-row mb-10">
									<div class="d-flex flex-stack mb-2">
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
										<a href="{{ route('password.request') }}" class="link-danger fs-6 fw-bolder">Forgot Password ?</a>
									</div>
									<input id="password" type="password" name="password" class="form-control form-control-lg form-control-solid" required>
								</div>

								<div class="text-center">
									<button type="submit" class="btn btn-lg w-100 mb-5" style="background-color:#ba0d0d; border-color:#ba0d0d; color:white;">
										<span class="indicator-label">Masuk</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

 <!--begin::Javascript-->
 <script>var hostUrl = "{{ asset('assets') }}/";</script>

 <!--begin::Global Javascript Bundle-->
 <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
 <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

 <!--begin::Page Vendors Javascript-->
 <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
 <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

 <!--begin::Page Custom Javascript-->
 <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
 <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
 <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
 <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
 <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
 <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
</body>
</html>
