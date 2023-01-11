<x-base-layout>

    <div id="kt_engage_demos" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="explore" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'350px', 'lg': '475px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_engage_demos_toggle" data-kt-drawer-close="#kt_engage_demos_close">
        <!--begin::Card-->
        <div class="card shadow-none rounded-0 w-100">
            <!--begin::Header-->
            <div class="card-header" id="kt_engage_demos_header">
                <h3 class="card-title fw-bolder text-gray-700">Advanced Search</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary h-40px w-40px me-n6" id="kt_engage_demos_close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body" id="kt_engage_demos_body">
                <!--begin::Content-->
                <div id="kt_explore_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_engage_demos_body" data-kt-scroll-dependencies="#kt_engage_demos_header" data-kt-scroll-offset="5px">
                    <!--begin::Wrapper-->
                    <div class="fv-row mb-12">
                        <select class="form-select form-select-solid" data-control="select2" data-placeholder="Search option" data-allow-clear="true" id="filter" multiple="multiple">
                            <option value="legal_name" >legal Name</option>
                            <option value="have_tax" >have Tax</option>
                            <option value="taxation_number" >taxation Number</option>
                            <option value="register_on" >register On</option>
                            <option value="consultant_type" >consultant Type</option>
                            <option value="register_address" >register Address</option>
                            <option value="country_id" >country</option>
                            <option value="state_id" >state</option>
                            <option value="city_id" >city</option>
                            <option value="zipcode" >Zipcode</option>
                            <option value="cname" >c-name</option>
                            <option value="ctitle" >c-title</option>
                            <option value="cemail" >c-email</option>
                            <option value="cmobile" >c-mobile</option>
                            <option value="cphone" >c-phone</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xxl-4" data-id-filter="legal_name" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">legal Name</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='2' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="have_tax" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">have Tax</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='3' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="taxation_number" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">taxation Number</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='4' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="register_on" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">register On</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='5' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="consultant_type" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">consultant Type</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='6' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="register_address" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">Register Address</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='7' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="country_id" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">country</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='8' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="state_id" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">state</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='9' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="city_id" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">city</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='10' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="zipcode" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">zipcode</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='11' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="cname" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">c-name</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='12' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="ctitle" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">c-title</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='13' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="cemail" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">c-email</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='14' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="cmobile" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">c-Mobile</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='15' />
                        </div>
                        <div class="col-xxl-4" data-id-filter="cphone" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">c-phone</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='16' />
                        </div>
                    </div>
                    <div class="rounded py-4 px-6 mb-5" hidden id="search_div">
                        <button type="button" id="search_two" class="btn btn-primary me-5">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_engage_demos1" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="explore" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'350px', 'lg': '475px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_engage_demos1_toggle" data-kt-drawer-close="#kt_engage_demos1_close">
        <!--begin::Card-->
        <div class="card shadow-none rounded-0 w-100">
            <!--begin::Header-->
            <div class="card-header" id="kt_engage_demos1_header">
                <h3 class="card-title fw-bolder text-gray-700">Filter</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary h-40px w-40px me-n6" id="kt_engage_demos1_close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body" id="kt_engage_demos1_body">
                <!--begin::Content-->
                <div id="kt_explore_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_engage_demos1_body" data-kt-scroll-dependencies="#kt_engage_demos1_header" data-kt-scroll-offset="5px">
                    <!--begin::Wrapper-->
                    <div class="fv-row mb-12">
                        <select class="form-select" id="toogleColum" data-control="select2" data-placeholder="Toggle column" multiple="multiple">
                            <option></option>
                            <option selected value="0">#</option>
                            <option selected value="1">Consultant Name</option>
                            {{-- <option selected value="2">Type</option> --}}
                            <option selected value="2">Last Config</option>
                            {{-- <option selected value="3">Last Update</option> --}}
                            <option selected value="3">Schedule</option>
                            <option selected value="4">Action</option>
                        </select>
                    </div>

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Schedule List</h1>
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
                        <li class="breadcrumb-item text-muted">Activities</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Schedule</li>
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
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    {{-- <a href="{{ route('user.insurance.create') }}" class="btn btn-sm btn-primary" >Create</a> --}}
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
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" id="kt_subheader_search_form"  data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search ">

                            </div>
                            <div class="d-flex align-items-center p-10">
                                <!--<button type="button" id="search" class="btn btn-primary me-5">Search</button>-->
                                <button type="button" id="reset" class="btn btn-primary btn-xs me-5">Reset</button>

                            </div>

                            <!--end::Search-->
                        </div>
                       <!--begin::Card toolbar-->
                        <div class="card-toolbar" data-select2-id="select2-data-131-2zax">

                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" data-select2-id="select2-data-130-3ekp">
                                <!--begin::Filter-->
                                <button type="button" id="kt_engage_demos_toggle" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Advanced search</button>
                                <!--begin::Menu 1-->
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
                                            <th>#</th>
                                            <th>Picture</th>
                                            <th>Consultant Details</th>
                                            <th>Country</th>
                                            <th>Category</th>
                                            <th>Last Schedule</th>
                                            <th>Schedule On</th>
                                            <th>Approval</th>
                                            <th>Schedule</th>
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
<script type="text/javascript">

    var table = null;
        $(document).ready(function () {
            table = $("#kt_customers_table").DataTable({
                initComplete: function(settings, json) {
                    const select = ToogleColum.val()
                    table.columns().every(function (index) {
                        if(!select.includes(index.toString())){
                            var column =  table.column(index)
                            column.visible(false)
                        }else{
                            var column =  table.column(index)
                            column.visible(true)
                        }
                        var column =  table.column(index)
                            column.visible(true)
                    })
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
                // dom: `<'row'<'col-sm-12 'tr>>
                // <'row'<'col-sm-12 col-md-5 dataTables_pager'i ><'col-sm-12 col-md-7 'lp>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html

                lengthMenu: [5, 10, 25, 100],
                // searching: false,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                bInfo : false,
                layout: {
                    scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                    footer: false, // display/hide footer
                },
                ajax: {
                    url : "{{route('activities.schedules.datatable')}}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        columnsDef : ['DT_RowIndex','picture','details','country','categorie_id','Last_Config','lastUpDate','approval','scheduleOrNot']
                    }

                },
                columns: [
                    { data: 'DT_RowIndex'},
                    { data: 'picture' },
                    { data: 'details' },
                    { data: 'country' },
                    { data: 'categorie_id' },
                    { data: 'Last_Config' },
                    { data: 'lastUpDate'},
                    { data : 'approval' },
                    { data: 'scheduleOrNot'},
                    { data: 'view'}
                ],
                columnDefs : [
                    {
                        targets: 1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            if(data){
                                return `<div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                            <img class="rounded-circle z-depth-2" src="${data}">
                                        </div>
                                    </div>`;
                            }
                            return '';
                        },
                    },
                    {
                        targets: 4,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            let cat = `<a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">${data.cat }</a><br>`
                            let sub = ``
                            data.sub.forEach(e => sub += `<a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">${e}</a>`)
                            return cat+sub;
                        },
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `
                                <a href="${data.view}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                        </svg>
                                    </span>
                                </a>
                            `;
                        },
                    },
                    {
                        targets: 7,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            if(row.approval == 2) return `<a href="#" class="btn btn-sm btn-light-sucess fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">Approved</a>`
                            if(row.approval == 1) return `<a href="#" class="btn btn-sm btn-light-danger fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">Approval Decline</a>`
                            return `<a href="#" class="btn btn-sm btn-light-warning fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">Waiting for Approval</a>`
                        },
                    },
                    {
                        targets: 8,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            if(data == 0) return `<a href="#" class="btn btn-sm btn-light-danger fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal">Not Scheduled</a>`;
                            else return `<a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal">Scheduled</a>`
                        },
                    },
                ],
                drawCallback : function( settings ) { }
            });

            const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                table.search(e.target.value).draw();
            });

            $( "#reset" ).click(function() {
                $('#kt_subheader_search_form').val('');
               table.search($('#kt_subheader_search_form').val()).draw();
            });
        });

    </script>

@endsection
</x-base-layout>

