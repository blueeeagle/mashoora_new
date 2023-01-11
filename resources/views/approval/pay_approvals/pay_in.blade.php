<x-base-layout>
    @include('history.appointment.view_model')

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pay In Approval List</h1>
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
                        <li class="breadcrumb-item text-muted">Approvals</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <ul class="nav nav-tabs nav-line-tabs fs-6">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold active" data-bs-toggle="tab" href="#app_tab">Appointment</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-bs-toggle="tab" href="#offer_tab">Offer</a>
                            </li>
                        </ul>
                    </div>
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                         <!--begin::Filter-->
                        <button type="button" id="kt_engage_demos1_toggle" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Filter</button>
                    </div>
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    {{-- <a href="{{ route('master.category.create') }}" class="btn btn-sm btn-primary" >Create</a> --}}
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
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="app_tab" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <button class="btn btn-primary me-5 btn-sm" data-rendering="booking" value="Pending">
                                        <span data-apptick="Pending" class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Pending List</button>
                                    <button class="btn btn-success me-5 btn-sm" data-rendering="booking" value="Approved">
                                        <span data-apptick="Approved" hidden class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Approved List</button>
                                    <button class="btn btn-danger me-5 btn-sm" data-rendering="booking" value="Decline">
                                        <span data-apptick="Decline" hidden class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Declined List</button>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 ">
                                <!--begin::Table-->
                                <div id="kt_customers_table_wrapper_12" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="table-responsive" style="margin-top:-25px;">
                                        <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_table">
                                            <thead>
                                                <tr class="fw-semibold fs-6 text-gray-800">
                                                    <th>#</th>
                                                    <th>Booking Info</th>
                                                    <th>Consultant Info</th>
                                                    <th>Customer Info</th>
                                                    <th>Consultant Amount</th>
                                                    <th>Customer Amount</th>
                                                    <th>Pay In Approval</th>
                                                    <th>Booking Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                             <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                    <td><button class="btn btn-danger btn-sm" data-app  value="Decline" id="decline">Decline</button></th>
                                                    <td><button class="btn btn-success btn-sm" data-decline  value="Approve" id="approve">Approve</button></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        
                                    </div>
        
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="offer_tab" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <button class="btn btn-primary me-5 btn-sm" data-rendering="offer" value="Pending">
                                        <span data-offtick="Pending" class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Pending List</button>
                                    <button class="btn btn-success me-5 btn-sm" data-rendering="offer" value="Approved">
                                        <span data-offtick="Approved" hidden class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Approved List</button>
                                    <button class="btn btn-danger me-5 btn-sm" data-rendering="offer" value="Decline">
                                        <span data-offtick="Decline" hidden class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Declined List</button>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 ">
                                <!--begin::Table-->
                                <div id="kt_customers_table_wrapper_12" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="table-responsive" style="margin-top:-25px;">
                                        <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_offer">
                                            <thead>
                                                <tr class="fw-semibold fs-6 text-gray-800">
                                                    <th>#</th>
                                                    <th>Offer Info</th>
                                                    <th>Consultant Info</th>
                                                    <th>Customer Info</th>
                                                    <th>Consultant Amount</th>
                                                    <th>Customer Amount</th>
                                                    <th>Offer Pay In</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                             <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td><button class="btn btn-danger btn-sm" data-appoffer  value="Decline" id="decline">Decline</button></th>
                                                    <td><button class="btn btn-success btn-sm" data-declineoffer  value="Approve" id="approve">Approve</button></th>
                                                </tr>
                                            </tfoot>
                                        </table>
        
                                    </div>
        
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@section('scripts')
<script src="{{ URL::asset(theme()->getDemo().'/js/PayIn.js') }}"></script>

<script>
    const appurl = `{{route('approval.pay_in.datatable')}}`;
    const offurl = `{{route('approval.pay_in.offerDatatable')}}`;
    const View = `{{ route('appointment.history.view') }}`
    const AppStatus = "{{ route('approval.pay_in.status') }}"
    const offerStatus = "{{ route('approval.pay_in.offstatus') }}"
</script>
@endsection
</x-base-layout>

