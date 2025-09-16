@extends('siantik.layouts.main')
@section('title', 'Siantik - Bantuan')

@section('container')
<div class="toolbar" id="kt_toolbar">
  <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
    <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
      <h1 class="text-dark fw-bolder fs-3 my-1">Bantuan</h1>
      <span class="h-20px border-gray-300 border-start mx-4"></span>
      {{-- <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
        <li class="breadcrumb-item text-dark"></li>
      </ul> --}}
    </div>
  </div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
  <div id="kt_content_container" class="container-fluid px-10">

    {{-- ROW 1: 3 kartu ringkas --}}
    <div class="row g-6 g-xl-9 mb-8">
      <div class="col-12 col-md-6 col-xl-4">
        <div class="card h-100 border-1 border border-primary">
          <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center mb-6">
                <i class="ki-duotone ki-social-media fs-3x text-primary me-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                   </i>
                </div>
            <div class="fs-2hx fw-bold text-primary mt-auto">-</div>
            <div class="fs-4 fw-bold text-gray-800">Layanan Konsultasi</div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-4">
        <div class="card h-100 border-1 border border-primary">
          <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center mb-6">
                <i class="ki-duotone ki-book-square fs-3x text-primary me-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </div>
            <div class="fs-2hx fw-bold text-primary mt-auto">-</div>
            <div class="fs-4 fw-bold text-gray-800">Helpdesk</div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-4">
        <div class="card h-100 border-1 border border-primary">
          <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-start mb-3">
                <i class="ki-duotone ki-geolocation-home fs-3x text-primary me-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <div class="fs-3 fw-bold text-gray-800 mt-auto">Kantor KPU RI</div>
            <div class="text-gray-600 fs-6 fw-bold">
                Jl. Imam Bonjol No.29, Menteng, Kec. Menteng, Kota Jakarta Pusat, DKI Jakarta 10310
            </div>
            {{-- <div class="mt-auto">
              <a target="_blank" href="https://maps.google.com" class="btn btn-sm btn-light-primary">Lihat Peta</a>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
    {{-- /ROW 1 --}}

    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-15">
            <!--begin::Classic content-->
            <div class="mb-13">
                <!--begin::Intro-->
                <div class="mb-15">
                    <!--begin::Title-->
                    <h4 class="fs-2x text-gray-800 w-bolder mb-6">Frequesntly Asked Questions</h4>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <p class="fw-bold fs-4 text-gray-600 mb-2">Menu ini berisi pertanyaan yang sering diajukan terkait penggunaan aplikasi Siantik. Jika jawaban yang Anda cari belum tersedia, silakan lihat dokumen panduan atau hubungi Helpdesk untuk bantuan lebih lanjut.</p>
                    <!--end::Text-->
                </div>
                <!--end::Intro-->
                <!--begin::Row-->
                <div class="row mb-12">
                    <!--begin::Col-->
                    <div class="col-md-6 pe-md-10 mb-10 mb-md-0">
                        <!--begin::Title-->
                        <h2 class="text-gray-800 fw-bolder mb-4">Penjelasan Siantik</h2>
                        <!--end::Title-->
                        <!--begin::Accordion-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle mb-0 active" data-bs-toggle="collapse" data-bs-target="#kt_job_4_1" aria-expanded="true">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Apa itu SIANTIK?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_4_1" class="fs-6 ms-1 collapse show" style="">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">
                                    SIANTIK adalah aplikasi yang digunakan untuk menilai tingkat kematangan TIK di Instansi KPU.
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_4_2">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Bagaimana cara kerja SIANTIK?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_4_2" class="collapse fs-6 ms-1">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Cara kerja SIANTIK adalah dengan mengumpulkan dan menganalisis data TIK dari tingkat Kab/Kota, Provinsi, dan Biro/Pusat untuk menilai kematangan TIK.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 ps-md-10">
                        <!--begin::Title-->
                        <h2 class="text-gray-800 fw-bolder mb-4">Peran Pengguna</h2>
                        <!--end::Title-->
                        <!--begin::Accordion-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_5_1">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Berapa banyak pengguna yang dapat menggunakan SIANTIK pada Tingkat Kab/Kota, Provinsi/Biro/Pusat?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_5_1" class="collapse show fs-6 ms-1">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Masing – masing tingkat Kab/Kota, Provinsi, dan Biro/Pusat mendapatkan 2 akun untuk dapat mengakses SIANTIK.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_5_2">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Siapa yang mendapatkan akses SIANTIK?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_5_2" class="collapse fs-6 ms-1">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Yang mendapatkan akses SIANTIK adalah Operator dan Verifikator tingkat Kab/Kota, Provinsi, dan Biro/Pusat.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_5_3">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Apa peran masing – masing Operator dan Verifikator dalam SIANTIK?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_5_3" class="collapse fs-6 ms-1">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Peran Operator dalam SIANTIK adalah mengisi form penilaian mandiri dan menyimpan form tersebut. Peran Verifikator adalah meng-generate penilaian mandiri, memverifikasi hasil form yang sudah diinput, dan mensubmit jawaban form penilaian mandiri.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--end::Accordion-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-md-6 pe-md-10 mb-10 mb-md-0">
                        <!--begin::Title-->
                        <h2 class="text-gray-800 w-bolder mb-4">Aspek & Indikator</h2>
                        <!--end::Title-->
                        <!--begin::Accordion-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_6_1">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Apa saja indikator yang dinilai dalam SIANTIK ?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_6_1" class="collapse show fs-6 ms-1">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Indikator yang dinilai dalam SIANTIK adalah Infrastruktur, SDM IT dan Layanan Sistem.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_6_2">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Apa saja aspek yang dinilai dalam SIANTIK ?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_6_2" class="collapse fs-6 ms-1">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Aspek yang dinilai dalam SIANTIK Adalah Infrastruktur Aset TIK, Infrastruktur Jaringan TIK, SDM IT, Layanan Aplikasi Umum KPU dan Layanan Aplikasi Khusus KPU.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--end::Accordion-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 ps-md-10">
                        <!--begin::Title-->
                        <h2 class="text-gray-800 fw-bolder mb-4">Cara Penggunaan</h2>
                        <!--end::Title-->
                        <!--begin::Accordion-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_7_1">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Apa perangkat yang dibutuhkan untuk dapat mengakses aplikasi SIANTIK ?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_7_1" class="collapse show fs-6 ms-1">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Perangkat yang dibutuhkan untuk dapat mengakses aplikasi SIANTIK adalah jaringan internet dan laptop.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_7_2">
                                <!--begin::Icon-->
                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon toggle-off svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Apa yang perlu saya lakukan untuk memulai menggunakan aplikasi SIANTIK?</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div id="kt_job_7_2" class="collapse fs-6 ms-1">
                                <!--begin::Text-->
                                <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">
                                    Untuk memulai menggunakan aplikasi SIANTIK:
                                    <ol class="ps-10 pt-4">
                                        <li class="mb-3">Verifikator login ke dalam aplikasi dan masuk ke menu <b>Penilaian Mandiri</b>, lalu generate form penilaian mandiri.</li>
                                        <li class="mb-3">Operator menginput form penilaian mandiri dan menyimpan form tersebut.</li>
                                        <li class="mb-3">Verifikator memverifikasi hasil inputan form mandiri dan mensubmit form tersebut.</li>
                                    </ol>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--end::Accordion-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Classic content-->
            <!--begin::Section-->
            <div class="mb-17">
                <!--begin::Content-->
                <div class="d-flex flex-stack mb-5">
                    <!--begin::Title-->
                    <h3 class="text-dark">Video Tutorial</h3>
                    <!--end::Title-->
                </div>
                <!--end::Content-->
                <!--begin::Separator-->
                <div class="separator separator-dashed mb-9"></div>
                <!--end::Separator-->
                <!--begin::Row-->
                <div class="row g-10">
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch me-md-6">
                            <!--begin::Image-->
                            <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5" style="background-image:url('assets/media/stock/600x400/img-73.jpg')" data-fslightbox="lightbox-video-tutorials" href="">
                                <img src="assets/media/svg/misc/video-play.svg" class="position-absolute top-50 start-50 translate-middle" alt="">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <a href="../../demo13/dist/pages/user-profile/overview.html" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">Cara Penggunaan Siantik (Coming Soon)</a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-bold fs-5 text-gray-600 text-dark my-4">Dalam video ini, akan menjelaskan pengenalan untuk aplikasi Siantik dan fitur-fitur yang terdapat dalam aplikasi.</div>
                                <!--end::Text-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bolder">
                                    <!--begin::Author-->
                                    <a href="../../demo13/dist/pages/user-profile/overview.html" class="text-gray-700 text-hover-primary">KPU RI</a>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted"> - 15 September 2025</span>
                                    <!--end::Date-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch mx-md-3">
                            <!--begin::Image-->
                            <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5" style="background-image:url('{{ asset('assets/media/avatars/logoSiantik1.png') }}')" data-fslightbox="lightbox-video-tutorials" href="">
                                <img src="assets/media/svg/misc/video-play.svg" class="position-absolute top-50 start-50 translate-middle" alt="">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <a href="" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">Cara Evaluasi Kematangan TIK dengan Siantik (Coming Soon)</a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-bold fs-5 text-gray-600 text-dark my-4">Dalam video ini, kami akan memandu Anda langkah demi langkah untuk menggunakan aplikasi Siantik, mulai dari login, pengisian penilaian mandiri, hingga submit data.</div>
                                <!--end::Text-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bolder">
                                    <!--begin::Author-->
                                    <a href="" class="text-gray-700 text-hover-primary">KPU RI</a>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted"> - 20 September 2025</span>
                                    <!--end::Date-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Section-->
            <!--begin::Card-->
            <div class="card mb-4 bg-light text-center">
                <!--begin::Body-->
                <div class="card-body py-12">
                    <!--begin::Icon-->
                    <a href="#" class="mx-4">
                        <img src="assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="">
                    </a>
                    <!--end::Icon-->
                    <!--begin::Icon-->
                    <a href="#" class="mx-4">
                        <img src="assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="">
                    </a>
                    <!--end::Icon-->
                    <!--begin::Icon-->
                    <a href="#" class="mx-4">
                        <img src="assets/media/svg/brand-logos/twitter.svg" class="h-30px my-2" alt="">
                    </a>
                    <!--end::Icon-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>

  </div>
</div>
@endsection