<x-base-layout>
    @include('history.appointment.view_model')
<div class="modal fade" id="Info-model" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="text-muted fw-bold fs-5"><a href="#" class="link-primary fw-bolder">Accept</a> -- Accept Booking</div>
                <div class="text-muted fw-bold fs-5"><a href="#" class="link-primary fw-bolder">Reject </a> -- Reject Booking</div>
                <div class="text-muted fw-bold fs-5"><a href="#" class="link-primary fw-bolder">Cancelled By Consultant</a> -- Customer Refund Accepted</div>
                <div class="text-muted fw-bold fs-5"><a href="#" class="link-primary fw-bolder">Cancelled By customer</a> -- Refund base on Admin Cancelled time</div>
                <div class="text-muted fw-bold fs-5"><a href="#" class="link-primary fw-bolder">No Show By Customer</a> -- No refund for customer</div>
                <div class="text-muted fw-bold fs-5"><a href="#" class="link-primary fw-bolder">No Show By Consultant</a> -- Refund for customer</div>
            </div>
        </div>
    </div>
</div>

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Appointment List</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Booking Activities</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0" hidden>
                        <!--begin::Menu toggle-->
                         <!--begin::Filter-->
                        <button type="button" id="kt_engage_demos1_toggle" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon--> <!-- Filter -->
                        </button>
                    </div>
                    <!--end::Primary button-->
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
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <button class="btn btn-primary me-5 btn-sm" data-rendering value="pending">Pending</button>
                            <button class="btn btn-success me-5 btn-sm" data-rendering value="booked">Booked</button>
                            <button class="btn btn-danger me-5 btn-sm" data-rendering value="cancelled">Cancelled</button>
                            <button class="btn btn-secondary me-5 btn-sm" data-rendering value="noShow">No Show</button>
                            <button class="btn btn-success me-5 btn-sm" data-rendering value="completed">Completed</button>

                            <!--<button class="btn btn-danger me-5 btn-sm" value="past" onclick="refresh(this)">Past</button>                             -->
                            <!--<button class="btn btn-info me-5 btn-sm" value="today" onclick="refresh(this)">Today</button>                             -->
                            <!--<button class="btn btn-success me-5 btn-sm" value="upcoming" onclick="refresh(this)">Upcoming History</button>                          -->
                        </div>
                       <!--begin::Card toolbar-->
                       <div id="selecterDiv_two" class="card-toolbar" style="flex-wrap: nowrap;">
                           <label class="col-lg-4 fw-bold text-muted">Action<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="modal" data-bs-target="#Info-model"></i></label>
                            <div data-select2-id="select2-data-131-2zax">
                                <select id="Bookingaction" class="form-select" data-control="select2" data-placeholder="select an option">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive" style="margin-top:-25px;">
                                <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_table">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800">
                                            <th>Booking Info</th>
                                            <th>Consultant Info</th>
                                            <th>Customer Info</th>
                                            <th>Consultant</th>
                                            <th>Customer</th>
                                            <th>Booking Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

@section('scripts')
    <script src="{{ URL::asset(theme()->getDemo().'/js/Booking.js') }}"></script>
    <script>
        const appurl = `{{route('appointment.history.datatable')}}`
        const appStatus = `{{ route('appointment.status') }}`
        const View = `{{ route('appointment.history.view') }}`
    </script>
@endsection
</x-base-layout>

