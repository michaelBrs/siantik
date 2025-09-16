<!DOCTYPE html>
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
        <link rel="shortcut icon" href="{{ asset('assets/media/avatars/kpu.png') }}" />

        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->

        {{-- jquery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!--begin::Page Vendor Stylesheets-->
        <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->

        <!--begin::Global Stylesheets Bundle-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->

        {{-- <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}"> --}}

        <!-- Keenicons -->
        <link rel="stylesheet" href="{{ asset('assets/keenicons/font/duotone/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/keenicons/font/outline/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/keenicons/font/solid/style.css') }}">

        <style>
            .tr-selected {
                background-color: #E6F4FF !important; /* Soft blue */
                color: #1E40AF !important;            /* Navy text */
            }
        </style>
	</head>
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
                @include('siantik.layouts.sidebar')
                <!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    @include('siantik.layouts.header')
                    
                        <!--begin::Content-->
                        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                            @yield('container')
                        </div>

                    @include('siantik.layouts.footer')
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
        @stack('scripts')

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success')),
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        </script>
        @endif
    </body>
</html>



