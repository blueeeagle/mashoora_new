
<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Offer purchase</h1>
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
                        <li class="breadcrumb-item text-muted">Offer</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
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

                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 toogle_datatable">
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
                                            <th>Status</th>
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
    <script>
    $(document).ready(function () {
        offerTable = $("#kt_customers_offer").DataTable({
                initComplete: function(settings, json) {

                },
                responsive: true,
                buttons: [
                        'print',
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5',
                    ],
                // Pagination settings
                // dom: `<'row'<'col-sm-12'tr>>
                // <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // // read more: https://datatables.net/examples/basic_init/dom.html

                lengthMenu: [5, 10, 25, 100],
                bInfo : false,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url : `{{route('history.offer.datatable')}}`,
                    type: 'POST',
                    data:{
                        "_token": csrf,
                        columnsDef : [],
                    }
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'id'},
                    { data: 'consultant_id'},
                    { data: 'customer_id'},
                    { data: 'consultant_amount' },
                    { data: 'cus_amount' },
                    { data: 'pay_in' },
                ],
                columnDefs : [
                    {
                        targets: 1,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `ID : ${row.payment_id}`
                        },
                    },
                    {
                        targets: 2,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(!data) return ''
                            data = JSON.parse(data);
                            return `Name : <b>${data.name}</b><br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                            Email : ${data.email} `
                        },
                    },
                    {
                        targets: 3,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(!data) return ''
                            data = JSON.parse(data);
                            return `Name : <b>${data.name}</b><br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                            Email : ${data.email}`
                        },
                    },
                    {
                        targets: 4,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `Amount : <b>${data.consultant_currenct.currencycode} ${data.consultant_amount} </b><i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Consultant Fee"
                            aria-label="Consultant Fee"></i> `
                        },
                    },
                    {
                        targets: 5,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `Amount : <b> ${data.customer_currency.currencycode} ${data.customer_amount} </b> <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Consultant Fee" aria-label="Consultant Fee"></i>`
                        },
                    },
                    {
                        targets: 6,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            let success = 'success', status = 'Approved';
                            if(data == 1){ success = 'primary';status = 'Pending'}
                            else if(data == 3){ success = 'danger'; status = 'Decline' }
                            return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${status}</a>`
                        },
                    },
                ],

                drawCallback : function( settings ) {
                }
            })
    });
            </script>
@endsection
</x-base-layout>
