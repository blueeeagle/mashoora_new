<x-base-layout>
    @section('styles')
    {{-- <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/flatpickr/flatpickr.bundle.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
    @endsection

    {{-- Model --}}
    @include('consultant.view_layouts.Model')

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Consultant View</h1>
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
                        <li class="breadcrumb-item text-muted">Consultant</li>
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
                @include('consultant.view_layouts.basicinfo')
                @include('consultant.view_layouts.nav')
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="kt_tab_pane_1" role="tabpanel">
                {{-- Dash Boad--}}
                @include('consultant.view_layouts.basic')
                @include('consultant.view_layouts.schandcom')
                @include('consultant.view_layouts.bank_details')
                @include('consultant.view_layouts.CatSpecInsDoc')
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                @include('consultant.view_layouts.transaction')
            </div>
            
             <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                @include('consultant.view_layouts.appointment')
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                @include('consultant.view_layouts.Review')
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                @include('consultant.view_layouts.offerpurchase')
            </div>
            {{-- @include('consultant.view_layouts.dashboad') --}}
            {{-- calendar--}}
            {{-- @include('consultant.view_layouts.calender') --}}
            {{-- Scheduling --}}
            {{-- @include('consultant.view_layouts.Scheduling') --}}
            {{-- Appointment History --}}
            {{-- @include('consultant.view_layouts.Appointment') --}}
            {{-- Offer History --}}
            {{-- @include('consultant.view_layouts.Offer') --}}
            {{-- Wallet --}}
            {{-- @include('consultant.view_layouts.Wallet') --}}
            {{--Review &Rating--}}
            {{-- @include('consultant.view_layouts.Review') --}}
        </div>
    </div>


    @section('scripts')
{{-- <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}'></script> --}}
{{-- <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/datatables/datatables.bundle.js')}}'></script> --}}
{{-- <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/formrepeater/formrepeater.bundle.js')}}'></script> --}}
{{-- <script src="{{ URL::asset(theme()->getDemo().'/js/calendarForConsultant.js') }}"></script> --}}
{{-- <script src="{{ URL::asset(theme()->getDemo().'/js/calendar.js') }}"></script> --}}
{{-- <script src="{{ URL::asset(theme()->getDemo().'/js/consultant_view.js') }}"></script> --}}

<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/flatpickr/flatpickr.bundle.js')}}'></script>
<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>-->
<script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/fslightbox/fslightbox.bundle.js') }}'></script>
<script src="{{ URL::asset(theme()->getDemo().'/js/consultant_view_model.js') }}"></script>

<script>
    const updateURL = `{{ route('consultant.consultant.update',$consultant->id) }}`
    const Getcity = `{{route('master.country.getCity')}}`
    const consultant_country = {!! json_encode($consultant->country) !!}
    const admin_country = {!! json_encode($companySetting_country_price->country) !!}
    var downloadAllFiles = `{{ $consultant->proof }}`
    const filepauth = `{{ asset("") }}`
    const modelcategory = `{{ route('consultant.modelcategory') }}`

    const sub_category_id = $('#sub_category_id');
    const specialization_id = $('#specialization_id');
    var table1,table2,table3,table4 = null

    const consultantcurrnect = document.querySelectorAll('.consultantcurrnect')
    consultantcurrnect.forEach(e => { e.innerText = consultant_country.currency.currencycode })
    const tree =  {!! json_encode($tree) !!}
    const refresh = `{{ route('activities.schedules.getAllschedule',$consultant->id) }}?_token={{ csrf_token() }}`
    const Consultamt_id = `{{ $consultant->id }}`
    const appdetails = `{{ route('activities.schedules.getappdetails') }}`
    const refresh1 = `{{ route('activities.schedules.getAllschedule',$consultant->id) }}?_token={{ csrf_token() }}`
    const $type = @json($consultant->type);
    const $type1 = @json($consultant->insurancecheckbox);
    var consultant_id = @json($consultant->id);

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

var table = null;
var review_datatablr = null;
var offerTable = null;

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
                    url : `{{route('history.offer.datatable',['id'=>$consultant->id,'type'=>'consultant'])}}`,
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
            });
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
                url : "{{route('review.datatable',$consultant->id)}}",
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
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('consultant.consultant.transactiondatatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : "{{$consultant->id}}",
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

        $( ".tablereset" ).click(function() {
            $('#kt_customers_table').val('');
           table.search($('#kt_customers_table').val()).draw();
        });

    });
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

<script>
    
    var table2 = null
    
    $(document).ready(function () {
        table2 = $("#kt_customers").DataTable({
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
                url : "{{route('consultant.consultant.appointmentdatatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : "{{$consultant->id}}",
                    columnsDef : ['id','consultant_id','customer_id','cons_date_slot','cus_date_slot','status']
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
            drawCallback : function( settings ) { }
        });
    
    });
    </script>
@endsection
</x-base-layout>
