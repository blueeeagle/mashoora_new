<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Appointment</h1>
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
                        <li class="breadcrumb-item text-muted">Appointment </li>
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
                        <div class="card-header flex-nowrap border-0 pt-9" style="display: block">
                            <a href="#" class="fs-4 fw-bold text-hover-primary text-gray-600 m-0">Total Appointment </a>
                            <div class="card-title m-0">
                                <div class="d-flex" style="gap: 30px">
                                    <div class="d-flex fs-6 fw-bold align-items-center">
                                        <div class="bullet w-8px h-6px rounded-2 bg-danger me-3" style="background-color : #009EF7"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">Pending</div>
                                        <div class="fw-boldest text-gray-700 text-xxl-end" >{{ $Pending }}</div>
                                    </div>
                                    <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3" style="background-color : #F1416C"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">Cancelled</div>
                                        <div class="fw-boldest text-gray-700 text-xxl-end" >{{ $Cancelled }}</div>
                                    </div>
                                    <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3" style="background-color : #50CD89"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">Confirmed</div>
                                        <div class="fw-boldest text-gray-700 text-xxl-end" >{{ $Confirmed }}</div>
                                    </div>
                                    <div class="d-flex fs-6 fw-bold align-items-center">
                                        <div class="bullet w-8px h-6px rounded-2 bg-danger me-3" style="background-color : #7239EA"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">No Show By Customer</div>
                                        <div class="fw-boldest text-gray-700 text-xxl-end" >{{ $NoShowByCustomer }}</div>
                                    </div>
                                    <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3" style="background-color : #5014D0"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">No Show By Consultant</div>
                                        <div class="fw-boldest text-gray-700 text-xxl-end" >{{ $NoShowByConsultant }}</div>
                                    </div>
                                    <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3" style="background-color : #50CD89"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">Completed</div>
                                        <div class="fw-boldest text-gray-700 text-xxl-end" >{{ $Completed }}</div>
                                    </div>
                                    <div class="d-flex fs-6 fw-bold align-items-center">
                                        <div class="bullet w-8px h-6px rounded-2 me-3" style="background-color : black"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">Total</div>
                                        <div class="fw-boldest text-gray-700 text-xxl-end" >{{ $total }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-9 pb-0">
                        <div class="card-header" style="border-bottom : unset;padding : unset">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Appointment  <span id="filtertext">Last 12 Month</span>
                                </span>
                                <span class="text-gray-400 mt-1 fw-bold fs-6">Search Year wise</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar ">
                                <div class="d-flex" style="gap: 30px">
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
                        <div class="card card-bordered">
                            <div class="card-body">
                                <div id="kt_card_widget_4_chart_consultant" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@section('scripts')
<script src="{{ URL::asset(theme()->getDemo().'/js/AppoinmentChart.js') }}"></script>

<script>
    const customer_data = '{{route('appChartdata')}}'
    const currency =  {!! json_encode($companeySetting->country->currency) !!}
</script>
@endsection
</x-base-layout>

