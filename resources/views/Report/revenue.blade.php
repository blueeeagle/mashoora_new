<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Revenue</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/metronic8/demo1/../demo1/index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Revenue</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->


        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <div class="card h-100">
                        <div class="card-header flex-nowrap border-0 pt-9">
                            <div class="card-title m-0">
                                <a href="#" class="fs-4 fw-bold text-hover-primary text-gray-600 m-0">Total Revenue {{$companeySetting->country->currency->currencycode}} {{ round($profit,2) }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-9 pb-0">
                        <div class="card-header" style="border-bottom : unset;padding : unset">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Revenue <span id="filtertext">Last 12 Month</span>
                                </span>
                                <span class="text-gray-400 mt-1 fw-bold fs-6">Search Year wise</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar ">
                                <div class="d-flex" style="gap: 30px">
                                    <div class="d-flex fs-6 fw-bold align-items-center">
                                        <!--begin::Bullet-->
                                        <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-500 flex-grow-1 me-4">Appointment</div>
                                        <!--end::Label-->
                                        <!--begin::Stats-->
                                        <div class="fw-boldest text-gray-700 text-xxl-end" id="Revenue_app">0</div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                        <!--begin::Bullet-->
                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-500 flex-grow-1 me-4">Offer</div>
                                        <!--end::Label-->
                                        <!--begin::Stats-->
                                        <div class="fw-boldest text-gray-700 text-xxl-end" id="Revenue_offer">0</div>
                                        <!--end::Stats-->
                                    </div>
                                    <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                        <!--begin::Bullet-->
                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-500 flex-grow-1 me-4">Total</div>
                                        <!--end::Label-->
                                        <!--begin::Stats-->
                                        <div class="fw-boldest text-gray-700 text-xxl-end" id="Revenue_total">0</div>
                                        <!--end::Stats-->
                                    </div>
                                    <div>
                                        <select class="form-select mb-4" id="Filteryear" data-control="select2"
                                            data-placeholder="Select Year" required>
                                            <option>Last 12 Month</option>
                                            @foreach (range((int)date('Y'), 2021) as $year)
                                            <option value="{{$year}}">Year {{$year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <canvas id="kt_chartjs_2" class="mh-400px"></canvas>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@section('scripts')
<script src="{{ URL::asset(theme()->getDemo().'/js/Revenue.js') }}"></script>

<script>
    const customer_data = '{{route('chartrevenue')}}'
    const currency =  {!! json_encode($companeySetting->country->currency) !!}
</script>
@endsection
</x-base-layout>

