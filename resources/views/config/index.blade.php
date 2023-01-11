<x-base-layout>

    

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Config List</h1>
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
                        <li class="breadcrumb-item text-muted">Activities</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Config</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    <a href="{{ route('activities.config.create') }}" class="btn btn-sm btn-primary" >Create</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->

        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-0 pb-0">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_tab_pane_1" >Home Screen</a> {{--   href="{{ route('consultant.consultant.edit',$consultant->id) }} --}}
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" id="test"  href="#kt_tab_pane_2">All Category Screen</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_3">Category Screen</a>
                    </li>
                </ul>
                <!--begin::Navs-->
            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
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

                                    <!--<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" data-select2-id="select2-data-130-3ekp">-->
                                        <!--begin::Filter-->
                                    <!--    <button type="button" id="kt_engage_demos_toggle" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                    <!--    <span class="svg-icon svg-icon-2">-->
                                    <!--        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                    <!--            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>-->
                                    <!--        </svg>-->
                                    <!--    </span>-->
                                        
                                        <!--begin::Menu 1-->
                                    <!--</div>-->
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
                                                    <th>Type</th>
                                                    <th>Discount / Offer</th>
                                                    <th>Category</th>
                                                    <th>Sort No</th>
                                                    <th>status</th>
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

            <div class="tab-pane fade show " id="kt_tab_pane_2" role="tabpanel">
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
                                        <!--<button type="button" id="kt_engage_demos_toggle" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                        <!--<span class="svg-icon svg-icon-2">-->
                                        <!--    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                        <!--        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>-->
                                        <!--    </svg>-->
                                        <!--</span>-->
                                        <!--end::Svg
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
                                        <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_table2">
                                            <thead>
                                                <tr class="fw-semibold fs-6 text-gray-800">
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Discount / Offer</th>
                                                    <th>Category</th>
                                                    <th>Sort No</th>
                                                    <th>status</th>
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
            </div>
            <div class="tab-pane fade show " id="kt_tab_pane_3" role="tabpanel">
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
                                        <!--<button type="button" id="kt_engage_demos_toggle" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                        <!--<span class="svg-icon svg-icon-2">-->
                                        <!--    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                        <!--        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>-->
                                        <!--    </svg>-->
                                        <!--</span>-->
                                        <!--end::Svg Icon--
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
                                        <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_table3">
                                            <thead>
                                                <tr class="fw-semibold fs-6 text-gray-800">
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Discount / Offer</th>
                                                    <th>Category</th>
                                                    <th>Sort No</th>
                                                    <th>status</th>
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
            </div>
        </div>
    </div>
@section('scripts')
<script type="text/javascript">

    var table,table2,table3 = null;
        $(document).ready(function () {
            table = $("#kt_customers_table").DataTable({
              
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
                    url : "{{route('activities.config.datatableForHome')}}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        columnsDef : ['id','typeOfConfig','discount_offer','sort_no','status'] 
                    }

                },
                columns: [
                    { data: 'DT_RowIndex'},
                    { data: 'typeOfConfig' },
                    { data: 'discount_offer' },
                    { data: 'categoryId' },
                    { data: 'sort_no' },
                    { data: 'status'},
                    { data: 'action'},
                ],
                columnDefs : [
                    {
                        targets: -1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `
                                <a href="${data.edit}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"> 
                                    <span class="svg-icon svg-icon-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                        </svg>
                                    </span>  
                                </a>
                                
                                <a href="${data.Delete}" delete class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                    <i href="${data.Delete}" delete class="las la-trash fs-2 me-2"></i></a>
								</a>
                            `;
                        },
                    },
                ],
                drawCallback : function( settings ) { }
            });

            table2 = $("#kt_customers_table2").DataTable({
              
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
                    url : "{{route('activities.config.datatableForAllCategory')}}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        columnsDef : ['id','typeOfConfig','discount_offer','sort_no','status'] 
                    }

                },
                columns: [
                    { data: 'DT_RowIndex'},
                    { data: 'typeOfConfig' },
                    { data: 'discount_offer' },
                    { data: 'categoryId' },
                    { data: 'sort_no' },
                    { data: 'status'},
                    { data: 'action'},
                ],
                columnDefs : [
                    {
                        targets: -1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `
                                <a href="${data.edit}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"> 
                                    <span class="svg-icon svg-icon-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                        </svg>
                                    </span>  
                                </a>
                                
                                <a href="${data.Delete}" delete class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                    <i href="${data.Delete}" delete class="las la-trash fs-2 me-2"></i></a>
								</a>
                            `;
                        },
                    },
                ],
                drawCallback : function( settings ) { }
            });
            table3 = $("#kt_customers_table3").DataTable({
              
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
                    url : "{{route('activities.config.datatableForCategory')}}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        columnsDef : ['id','typeOfConfig','discount_offer','sort_no','status'] 
                    }

                },
                columns: [
                    { data: 'DT_RowIndex'},
                    { data: 'typeOfConfig' },
                    { data: 'discount_offer' },
                    { data: 'categoryId' },
                    { data: 'sort_no' },
                    { data: 'status'},
                    { data: 'action'},
                ],
                columnDefs : [
                    {
                        targets: -1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `
                                <a href="${data.edit}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"> 
                                    <span class="svg-icon svg-icon-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                        </svg>
                                    </span>  
                                </a>
                                
                                <a href="${data.Delete}" delete class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                    <i href="${data.Delete}" delete class="las la-trash fs-2 me-2"></i></a>
								</a>
                            `;
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
    <style>
        .tab-content {
            padding: 0px; 
            width: 100%;
            min-height: 340px;
        }
    </style>
@endsection
</x-base-layout>

