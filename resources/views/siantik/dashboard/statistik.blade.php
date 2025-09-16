@extends('siantik.layouts.main')

@section('title', 'Siantik - Statistik')

@section('container')

    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Statistik</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark"></li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row gy-5 g-xl-10">
                <div class="col-xl-4">
                    <!--begin::Mixed Widget 2-->
                    <div class="card card-xl-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0 bg-danger py-5">
                            <h3 class="card-title fw-bolder text-white">Detail Satuan Kerja</h3>
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button type="" class="btn btn-sm btn-icon btn-color-white btn-active-color- border-0 me-n3" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                                <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <!--begin::Chart-->
                            <div class="mixed-widget-2-chart card-rounded-bottom bg-danger" data-kt-color="danger" style="height: 200px; min-height: 200px;"><div id="apexchartsyltp8xtil" class="apexcharts-canvas apexchartsyltp8xtil apexcharts-theme-light" style="width: 311px; height: 200px;"><svg id="SvgjsSvg1522" width="311" height="200" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1524" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1523"><clipPath id="gridRectMaskyltp8xtil"><rect id="SvgjsRect1527" width="318" height="203" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskyltp8xtil"></clipPath><clipPath id="nonForecastMaskyltp8xtil"></clipPath><clipPath id="gridRectMarkerMaskyltp8xtil"><rect id="SvgjsRect1528" width="315" height="204" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><filter id="SvgjsFilter1534" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1535" flood-color="#cb1b46" flood-opacity="0.5" result="SvgjsFeFlood1535Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1536" in="SvgjsFeFlood1535Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1536Out"></feComposite><feOffset id="SvgjsFeOffset1537" dx="0" dy="5" result="SvgjsFeOffset1537Out" in="SvgjsFeComposite1536Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1538" stdDeviation="3 " result="SvgjsFeGaussianBlur1538Out" in="SvgjsFeOffset1537Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1539" result="SvgjsFeMerge1539Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1540" in="SvgjsFeGaussianBlur1538Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1541" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1542" in="SourceGraphic" in2="SvgjsFeMerge1539Out" mode="normal" result="SvgjsFeBlend1542Out"></feBlend></filter><filter id="SvgjsFilter1544" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1545" flood-color="#cb1b46" flood-opacity="0.5" result="SvgjsFeFlood1545Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1546" in="SvgjsFeFlood1545Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1546Out"></feComposite><feOffset id="SvgjsFeOffset1547" dx="0" dy="5" result="SvgjsFeOffset1547Out" in="SvgjsFeComposite1546Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1548" stdDeviation="3 " result="SvgjsFeGaussianBlur1548Out" in="SvgjsFeOffset1547Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1549" result="SvgjsFeMerge1549Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1550" in="SvgjsFeGaussianBlur1548Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1551" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1552" in="SourceGraphic" in2="SvgjsFeMerge1549Out" mode="normal" result="SvgjsFeBlend1552Out"></feBlend></filter></defs><g id="SvgjsG1553" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1554" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1563" class="apexcharts-grid"><g id="SvgjsG1564" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1566" x1="0" y1="0" x2="311" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1567" x1="0" y1="20" x2="311" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1568" x1="0" y1="40" x2="311" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1569" x1="0" y1="60" x2="311" y2="60" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1570" x1="0" y1="80" x2="311" y2="80" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1571" x1="0" y1="100" x2="311" y2="100" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1572" x1="0" y1="120" x2="311" y2="120" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1573" x1="0" y1="140" x2="311" y2="140" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1574" x1="0" y1="160" x2="311" y2="160" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1575" x1="0" y1="180" x2="311" y2="180" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1576" x1="0" y1="200" x2="311" y2="200" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1565" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1578" x1="0" y1="200" x2="311" y2="200" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1577" x1="0" y1="1" x2="0" y2="200" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1529" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1530" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1533" d="M 0 200L 0 125C 18.141666666666662 125 33.69166666666666 87.5 51.83333333333333 87.5C 69.975 87.5 85.52499999999999 120 103.66666666666666 120C 121.80833333333332 120 137.35833333333332 25 155.5 25C 173.64166666666665 25 189.19166666666666 100 207.33333333333331 100C 225.47499999999997 100 241.02499999999998 100 259.16666666666663 100C 277.3083333333333 100 292.85833333333335 100 311 100C 311 100 311 100 311 200M 311 100z" fill="transparent" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskyltp8xtil)" filter="url(#SvgjsFilter1534)" pathTo="M 0 200L 0 125C 18.141666666666662 125 33.69166666666666 87.5 51.83333333333333 87.5C 69.975 87.5 85.52499999999999 120 103.66666666666666 120C 121.80833333333332 120 137.35833333333332 25 155.5 25C 173.64166666666665 25 189.19166666666666 100 207.33333333333331 100C 225.47499999999997 100 241.02499999999998 100 259.16666666666663 100C 277.3083333333333 100 292.85833333333335 100 311 100C 311 100 311 100 311 200M 311 100z" pathFrom="M -1 200L -1 200L 51.83333333333333 200L 103.66666666666666 200L 155.5 200L 207.33333333333331 200L 259.16666666666663 200L 311 200"></path><path id="SvgjsPath1543" d="M 0 125C 18.141666666666662 125 33.69166666666666 87.5 51.83333333333333 87.5C 69.975 87.5 85.52499999999999 120 103.66666666666666 120C 121.80833333333332 120 137.35833333333332 25 155.5 25C 173.64166666666665 25 189.19166666666666 100 207.33333333333331 100C 225.47499999999997 100 241.02499999999998 100 259.16666666666663 100C 277.3083333333333 100 292.85833333333335 100 311 100" fill="none" fill-opacity="1" stroke="#cb1b46" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskyltp8xtil)" filter="url(#SvgjsFilter1544)" pathTo="M 0 125C 18.141666666666662 125 33.69166666666666 87.5 51.83333333333333 87.5C 69.975 87.5 85.52499999999999 120 103.66666666666666 120C 121.80833333333332 120 137.35833333333332 25 155.5 25C 173.64166666666665 25 189.19166666666666 100 207.33333333333331 100C 225.47499999999997 100 241.02499999999998 100 259.16666666666663 100C 277.3083333333333 100 292.85833333333335 100 311 100" pathFrom="M -1 200L -1 200L 51.83333333333333 200L 103.66666666666666 200L 155.5 200L 207.33333333333331 200L 259.16666666666663 200L 311 200"></path><g id="SvgjsG1531" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1584" r="0" cx="0" cy="0" class="apexcharts-marker wirn0owxm no-pointer-events" stroke="#cb1b46" fill="#f1416c" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1532" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1579" x1="0" y1="0" x2="311" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1580" x1="0" y1="0" x2="311" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1581" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1582" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1583" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1562" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1525" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 100px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: transparent;"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                            <!--end::Chart-->
                            <!--begin::Stats-->
                            <div class="card-p mt-n20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"></rect>
                                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"></rect>
                                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"></rect>
                                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-warning fw-bold fs-6">
                                           <span class="fs-3">558</span> Satker
                                        </a>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black"></path>
                                                <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-primary fw-bold fs-6">
                                            <span class="fs-3">38</span> Provinsi
                                        </a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black"></path>
                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-danger fw-bold fs-6 mt-2">
                                            <span class="fs-3">416</span> Kabupaten
                                        </a>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col bg-light-success px-6 py-8 rounded-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black"></path>
                                                <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-success fw-bold fs-6 mt-2">
                                            <span class="fs-3">98</span> Kota
                                        </a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 2-->
                </div>
                <div class="col-xl-8 mb-10">
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-6 mb-xl-10">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between flex-column">
                                    <!--begin::Icon-->
                                    <img src="{{ asset('assets/media/icons/duotune/abstract/abs035.svg') }}" class="w-35px" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column my-7">
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-gray-800 lh-1">10 Satker</span>
                                        <!--end::Number-->
                                        <!--begin::Follower-->
                                        <span class="fw-bold fs-6 text-success">Memuaskan</span>
                                        <!--end::Follower-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="m-0">
                                        <!--begin::Badge-->
                                        <span class="badge badge-success d-inline-flex flex-center px-2">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
                                        <span class="svg-icon svg-icon-7 svg-icon-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.5" d="M13 9.59998V21C13 21.6 12.6 22 12 22C11.4 22 11 21.6 11 21V9.59998H13Z" fill="black"></path>
                                                <path d="M5.7071 7.89291C5.07714 8.52288 5.52331 9.60002 6.41421 9.60002H17.5858C18.4767 9.60002 18.9229 8.52288 18.2929 7.89291L12.7 2.3C12.3 1.9 11.7 1.9 11.3 2.3L5.7071 7.89291Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->2.1 %</span>
                                        <!--end::Badge-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-6 mb-xl-10">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between flex-column">
                                    <!--begin::Icon-->
                                    <img src="{{ asset('assets/media/icons/duotune/abstract/abs025.svg') }}" class="w-35px" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column my-7">
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-gray-800 lh-1">5 Satker</span>
                                        <!--end::Number-->
                                        <!--begin::Follower-->
                                        <span class="fw-bold fs-6 text-primary">Sangat Baik</span>
                                        <!--end::Follower-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="m-0">
                                        <!--begin::Badge-->
                                        <span class="badge badge-success d-inline-flex flex-center px-2">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr068.svg-->
                                        <span class="svg-icon svg-icon-7 svg-icon-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.5" d="M13 14.4V3.00003C13 2.40003 12.6 2.00003 12 2.00003C11.4 2.00003 11 2.40003 11 3.00003V14.4H13Z" fill="black"></path>
                                                <path d="M5.7071 16.1071C5.07714 15.4771 5.52331 14.4 6.41421 14.4H17.5858C18.4767 14.4 18.9229 15.4771 18.2929 16.1071L12.7 21.7C12.3 22.1 11.7 22.1 11.3 21.7L5.7071 16.1071Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->0.47 %</span>
                                        <!--end::Badge-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-6 mb-xl-10">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between flex-column">
                                    <!--begin::Icon-->
                                    <img src="{{ asset('assets/media/icons/duotune/abstract/abs047.svg') }}" class="w-35px" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column my-7">
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-gray-800 lh-1">20 Satker</span>
                                        <!--end::Number-->
                                        <!--begin::Follower-->
                                        <span class="fw-bold fs-6 text-info">Baik</span>
                                        <!--end::Follower-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="m-0">
                                        <!--begin::Badge-->
                                        <span class="badge badge-success d-inline-flex flex-center px-2">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
                                        <span class="svg-icon svg-icon-7 svg-icon-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.5" d="M13 9.59998V21C13 21.6 12.6 22 12 22C11.4 22 11 21.6 11 21V9.59998H13Z" fill="black"></path>
                                                <path d="M5.7071 7.89291C5.07714 8.52288 5.52331 9.60002 6.41421 9.60002H17.5858C18.4767 9.60002 18.9229 8.52288 18.2929 7.89291L12.7 2.3C12.3 1.9 11.7 1.9 11.3 2.3L5.7071 7.89291Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->0.6 %</span>
                                        <!--end::Badge-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-6 mb-xl-10">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between flex-column">
                                    <!--begin::Icon-->
                                    {{-- <img src="{{ asset('assets/media/icons/duotune/abstract/abs045.svg') }}" class="w-35px" alt=""> --}}
                                    <i class="ki-duotone ki-home fs-3x text-gray-500 me-3">
                                    </i>
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column my-7">
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-gray-800 lh-1">15 Satker</span>
                                        <!--end::Number-->
                                        <!--begin::Follower-->
                                        <span class="fw-bold fs-6 text-danger">Cukup</span>
                                        <!--end::Follower-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="m-0">
                                        <!--begin::Badge-->
                                        <span class="badge badge-success d-inline-flex flex-center px-2">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
                                        <span class="svg-icon svg-icon-7 svg-icon-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.5" d="M13 9.59998V21C13 21.6 12.6 22 12 22C11.4 22 11 21.6 11 21V9.59998H13Z" fill="black"></path>
                                                <path d="M5.7071 7.89291C5.07714 8.52288 5.52331 9.60002 6.41421 9.60002H17.5858C18.4767 9.60002 18.9229 8.52288 18.2929 7.89291L12.7 2.3C12.3 1.9 11.7 1.9 11.3 2.3L5.7071 7.89291Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->3 %</span>
                                        <!--end::Badge-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <script>
        // Pastikan ApexCharts sudah tersedia (apexcharts.min.js)
        (function () {
          let chartInstance = null;
        
          function getOptions() {
            // Contoh opsi (horizontal bar) — silakan sesuaikan
            return {
              chart: {
                type: 'bar',
                height: 365,
                toolbar: { show: false }
              },
              plotOptions: {
                bar: { horizontal: true, barHeight: '60%', borderRadius: 6 }
              },
              series: [{
                name: 'Sales',
                data: [15000, 12000, 10000, 8000, 7000]
              }],
              xaxis: {
                categories: ['ECR - 90%', 'FGI - 82%', 'EOQ - 75%', 'FMG - 60%', 'PLG - 50%'],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { fontSize: '12px' } }
              },
              yaxis: {
                labels: { style: { fontSize: '12px', fontWeight: 600, colors: '#252f4a' } }
              },
              grid: { borderColor: '#dbdfe9', strokeDashArray: 4 },
              colors: ['#3E97FF', '#F1416C', '#50CD89', '#FFC700', '#7239EA'],
              dataLabels: {
                enabled: true,
                formatter: (val) => `${val.toLocaleString()}`
              },
              tooltip: { y: { formatter: (val) => `${val.toLocaleString()}` } }
            };
          }
        
          function renderChart() {
            const el = document.getElementById('kt_charts_widget_6');
            if (!el) return;
        
            // GUARD: kalau sudah pernah render, jangan render lagi
            if (el.dataset.rendered === '1') return;
        
            // Safety: kalau ada instance lama (mis. navigasi PJAX/Livewire), hancurkan
            if (chartInstance) { chartInstance.destroy(); chartInstance = null; }
        
            chartInstance = new ApexCharts(el, getOptions());
            chartInstance.render().then(() => {
              el.dataset.rendered = '1';
            });
          }
        
          function destroyChart() {
            const el = document.getElementById('kt_charts_widget_6');
            if (chartInstance) { chartInstance.destroy(); chartInstance = null; }
            if (el) delete el.dataset.rendered;
          }
        
          // Init saat DOM siap
          document.addEventListener('DOMContentLoaded', renderChart);
        
          // Kalau halamanmu pakai Turbolinks/Hotwire/Livewire yang re-render konten:
          // window.addEventListener('turbolinks:before-render', destroyChart);
          // document.addEventListener('livewire:navigated', () => { destroyChart(); renderChart(); });
        
          // Ekspos opsional kalau perlu dipanggil manual
          window.KTChartsWidget6 = { render: renderChart, destroy: destroyChart };
        })();
        </script>
@endsection
