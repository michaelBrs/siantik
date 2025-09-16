@extends('siantik.layouts.main')

@section('container')
    <!--begin::Wrapper-->
    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
        <!--begin::Toolbar wrapper-->
        <div class="topbar d-flex align-items-stretch flex-shrink-0">
            <!--begin::Heaeder menu toggle-->
            <div class="d-flex align-items-stretch d-lg-none px-3 me-n3" title="Show header menu">
                <div class="topbar-item" id="kt_header_menu_mobile_toggle">
                    <i class="bi bi-text-left fs-1"></i>
                </div>
            </div>
            <!--end::Heaeder menu toggle-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Wrapper-->

@endsection