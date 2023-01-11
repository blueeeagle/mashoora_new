<x-base-layout>
    @section('styles')
    {{-- <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/flatpickr/flatpickr.bundle.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
    @endsection

    {{-- Model --}}
    @include('customer.view_layouts.Model')

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Customer View</h1>
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
                        <li class="breadcrumb-item text-muted">Customer</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('consultant.consultant.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
    <div id="kt_content_container" class="container-xxl">
        <div class="card mb-5 mb-xl-10">
            {{-- NAV--}}
            <div class="card-body pt-9 pb-0">
            @include('customer.view_layouts.basicinfo')
            @include('customer.view_layouts.nav')
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="kt_tab_pane_1" role="tabpanel">
            @include('customer.view_layouts.basic')
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
            
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content flex-column-fluid" style="margin-bottom: 21px;">
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
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table-->
                                    <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="table-responsive" style="margin-top:-25px;">
                                            <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_table11">
                                                <thead>
                                                    <tr class="fw-semibold fs-6 text-gray-800">
                                                        <th>#</th>
                                                        <th>Amount</th>
                                                        <th>Type</th>
                                                        <th>Date</th>
                                                        <th>Description</th>
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
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        <div class="row gy-10 gx-xl-10">
                            <div class="card card-docs flex-row-fluid mb-2">
                                <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_table2">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800">
                                            <th>Booking Info</th>
                                            <th>Consultant Info</th>
                                            <th>Customer Info</th>
                                            <th>Consultant</th>
                                            <th>Customer</th>
                                            <th>Booking Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                @include('customer.view_layouts.Review')
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                @include('customer.view_layouts.offerpurchase')
            </div>
        </div>
    </div>

    @section('scripts')


<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/flatpickr/flatpickr.bundle.js')}}'></script>
<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/fslightbox/fslightbox.bundle.js') }}'></script>
<script src="{{ URL::asset(theme()->getDemo().'/js/customer_view_model.js') }}"></script>

<script>
    var table = null
    $(document).ready(function () {
        table = $("#kt_customers_table11").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('user.customer.transactiondatatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : "{{$customer->id}}",
                    columnsDef : ['id','amount','type','created_at','action']
                }

            },
            columns: [
                { data : 'DT_RowIndex' },
                    { data : 'amount' },
                    { data : 'type' },
                    { data : 'created_at' },
                    { data : 'action' },
            ],
           
            drawCallback : function( settings ) { }
        });

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                table.search(e.target.value).draw();
            });


        $( "#reset" ).click(function() {
                $('#kt_customers_table1').val('');
               table.search($('#kt_customers_table1').val()).draw();
            });

    });
</script>


<script>
    var table1 = null
    $(document).ready(function () {
        table1 = $("#kt_customers_table2").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],

            lengthMenu: [5, 10, 25, 100],
            bInfo : false,
            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('user.customer.appointmentdatatable')}}",
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    'id' : "{{$customer->id}}",
                    columnsDef : [],
                    // searchTable: function () { // dynamic
                    //     return  searchTable;
                    // },
                }
            },
            columns: [
                { data: 'id'},
                { data: 'consultant_id'},
                { data: 'customer_id'},
                { data: 'cons_date_slot'},
                { data: 'cus_date_slot'},
                { data: 'status'},
            ],
            columnDefs : [
                {
                    targets: 0,
                    data: null,
                    orderable: true,
                    render: function (data, type, row) {
                        return `ID : BK-${data}<br>Type : ${row.appointment_type}`
                    },
                },
                {
                    targets: 2,
                    data: null,
                    orderable: true,
                    render: function (data, type, row) {
                        if(!data) return ''
                        data = JSON.parse(data);
                        
                        return `Name : ${data.name}<br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                        Email : ${data.email}<br>County : ${data.country?.country_name} `
                    },
                },
                {
                    targets: 1,
                    data: null,
                    orderable: true,
                    render: function (data, type, row) {
                        data = JSON.parse(data);
                        return `Name : ${data.name}<br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                        Email : ${data.email}<br>County : ${data.country?.country_name} `
                    },
                },
                {
                    targets: 3,
                    data: null,
                    orderable: true,
                    render: function (data, type, row) {
                        return `Date : ${data.Date}<br>Time: ${data.Time}<br>Amount : ${data.Amount}`
                    },
                },
                {
                    targets: 5,
                    data: null,
                    orderable: true,
                    render: function (data, type, row) {
                        let success = 'success';
                        if(data == 'Pending') success = 'primary'
                        if(data == 'NoShowByCustomer' || data == 'NoShowByConsultant') success = 'info'
                        if(data == 'Cancelled') success = 'danger'

                        return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${data}</a>`
                    },
                },
                {
                    targets: 4,
                    data: null,
                    orderable: true,
                    render: function (data, type, row) {
                        return `Date : ${data.Date}<br>Time: ${data.Time}<br>Amount : ${data.Amount}`
                    },
                },
            ],

            drawCallback : function( settings ) {
            }
        })
        review_datatablr = $("#review_datatable").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('review.datatable_customer',$customer->id)}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    columnsDef : ['id','title','updated_at','status']
                }

            },
            columns: [
                { data: 'DT_RowIndex'},
                { data: 'created_at'},
                { data: 'customer_id'},
                { data: 'consultant_id'},
                { data: 'appointment_id'},
                { data: 'comments'},
                { data: 'action'},
            ],
            columnDefs : [
                {
                        targets: 3,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            if(!data) return ''
                            data = JSON.parse(data);
                            return `Name : ${row.consultant.name}<br>Phone No : ${row.consultant.country?.dialing} ${row.consultant.phone_no}<br>
                            Email : ${row.consultant.email}<br>County : ${row.consultant.country?.country_name} `
                        },
                    },
                    {
                        targets: 2,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            data = JSON.parse(data);
                            return `Name : ${row.customer.name}<br>Phone No : ${row.customer.country?.dialing} ${row.customer.phone_no}<br>
                            Email : ${row.customer.email}<br>County : ${row.customer.country?.country_name} `
                        },
                    },
                    {
                        targets: 4,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `BK-${data}`
                        },
                    },
                    {
                        targets: 5,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `comments : ${data}<br/>
                                    Rating : ${row.rating}`
                        },
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `<a href="${data.delete}"  class="deleteagain btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                    <i href="${data.delete}" class="las la-trash fs-2 me-2"></i></a>
								</a>`
                        },
                    },
            ],
            drawCallback : function( settings ) { }
        });
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
                    url : `{{route('history.offer.datatable',['id'=>$customer->id,'type'=>'customer'])}}`,
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

<script>
    const updateURL = `{{ route('user.customer.user-update',$customer->id) }}`
    const consultant_country = {!! json_encode($customer->country) !!}

    //commom function
    function formatDate(date) {
        return [
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate()),
            date.getFullYear(),
            ].join('/');
    }
    function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
    }
    
    
    $(document).on('click','.deleteagain',function(e){
    deletedata(e)
})
function Switealert(Msg,status){
        Swal.fire({
            text: Msg,
            icon: status,
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: 'btn btn-primary'
            }
        });
    }
function deletedata(e){
        e.preventDefault();
        var text = 'Are you sure you want to delete ?'
        let route = e.target.getAttribute('href')
            Swal.fire({
                text: text,
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((function (t) {
                if(t.value){
                    let data = { _token: csrf }
                    fetch(route,{
                        method: 'post',
                        headers: { 'Content-Type': 'application/json', },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        review_datatablr.ajax.reload(null, false);
                        Switealert((data.status)?data.msg:'error',(data.status)?'success':'error')
                    });
                }
            }))
    }
    </script>

@endsection
</x-base-layout>
