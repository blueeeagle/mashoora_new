<!--begin::List Widget 2-->
<?php
    // List items
    $listRows = array(
        array(
            'avatar' => 'avatars/300-6.jpg',
            'name' => 'Emma Smith',
            'description' => 'Project Manager',
        ),
        array(
            'avatar' => 'avatars/300-5.jpg',
            'name' => 'Sean Bean',
            'description' => 'PHP, SQLite, Artisan CLI',
        ),
        array(
            'avatar' => 'avatars/300-11.jpg',
            'name' => 'Brian Cox',
            'description' => 'PHP, SQLite, Artisan CLI',
        ),
        array(
            'avatar' => 'avatars/300-9.jpg',
            'name' => 'Francis Mitcham',
            'description' => 'PHP, SQLite, Artisan CLI',
        ),
        array(
            'avatar' => 'avatars/300-23.jpg',
            'name' => 'Dan Wilson',
            'description' => 'PHP, SQLite, Artisan CLI',
        )
    );
?>
@php
$chartColor = $chartColor ?? 'primary';
$chartHeight = $chartHeight ?? '175px';
@endphp

<!--begin::Mixed Widget 2-->

<div class="card {{ $class }}">
<!--begin::Header-->
{{-- <div class="card-header border-0 bg-{{ $chartColor }} py-5">
    <h3 class="card-title fw-bolder text-white">Sales Statistics</h3>

    <div class="card-toolbar">
        <!--begin::Menu-->
        <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color-{{ $color ?? '' }} border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
            {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}
        </button>
        {{ theme()->getView('partials/menus/_menu-3') }}
        <!--end::Menu-->
    </div>
</div> --}}
<!--end::Header-->

<!--begin::Body-->
<div class="card-body">
    <!--begin::Chart-->
    {{-- <div class="mixed-widget-2-chart card-rounded-bottom bg-{{ $chartColor }}" data-kt-color="{{ $chartColor }}" data-kt-chart-url="{{ route('profits') }}" style="height: {{ $chartHeight }}"></div> --}}
    <!--end::Chart-->
    <div class="row">
    <!--begin::Stats-->
    <div class="col-xxl-6">
        <!--begin::Row-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
            <li class="nav-item mt-2">
                <a class="nav-link text-active-info ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_tab_pane_1" ><b>CUSTOMERS</b></a> 
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-danger ms-0 me-10 py-5 " data-bs-toggle="tab" href="#kt_tab_pane_2" >CONSULTANTS</a> 
            </li>
        
        </ul>
        <div class="tab-content" id="myTabContent">
            {{-- Tab 1 --}}
            <center><b>Recently Register</b></center>
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                <div id="kt_content_container" class="container-xxl">
                    <div class="row gy-10 gx-xl-10">
                        <div class="card card-docs flex-row-fluid mb-2">
                            <table id="kt_datatable" class="table table-row-bordered gy-5">
                                <thead>
                                    <tr class="fw-bold fs-6 text-muted">
                                        <th>SNo</th>
                                        <th>Customer </th>
                                        <th>Mobile No</th>
                                        <th>E-mail ID</th>
                                        <th>Registered on</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- <tfoot>
                                    <tr>
                                        <th>SNo</th>
                                        <th>Customer Name</th>
                                        <th>Mobile No</th>
                                        <th>E-mail ID</th>
                                        <th>Registered on</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
     
      
            {{-- Tab 2--}}
            <div class="tab-pane fade show" id="kt_tab_pane_2" role="tabpanel">
                <div id="kt_content_container">
                    <table id="kt_datatable2" class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-bold fs-6 text-muted">
                            <th>SNo</th>
                            <th>Consultant</th>
                            <th>Mobile No</th>
                            <th>E-mail ID</th>
                            <th>Registered on</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>SNo</th>
                            <th>Consultant Name</th>
                            <th>Mobile No</th>
                            <th>E-mail ID</th>
                            <th>Registered on</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>--}}
                    </table>

                </div> 
            </div> 

        </div>
    </div>
   
    
   

    <div class="col-xxl-6">
        <div class="card-header align-items-center border-0 mt-4">
            <div class="fv-row mb-12">
                <select name="" class="form-select" id="">
                    <option value="">All Consultant</option>
                </select>
            </div>
            
            <div class="fv-row mb-12">
                <select class="form-select" onchange="statusFilter(this)">
                    <option value="" selected>All Status</option>
                    <option value="1">Booked</option>
                    <option value="2">Process</option>
                    <option value="3">Cancelled</option>
                    <option value="4">Completed</option>
                </select>
            </div>
    
        </div>
        <center><b>Today Appointment</b></center>
        <div id="kt_content_container">
            <table id="kt_datatable3" class="table table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-bold fs-6 text-muted">
                            <th>SNo</th>
                            <th>Customer</th>
                            <th>Mobile No</th>
                            <th>E-mail ID</th>
                            <th>Booking ID</th>
                            <th>Consultant</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>SNo</th>
                            <th>Customer Name</th>
                            <th>Mobile No</th>
                            <th>E-mail ID</th>
                            <th>Booking ID</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </tfoot> --}}
            </table>
        </div>
    </div>
       
        <!--end::Row-->
    </div>
</div>
</div>
<!--end::Body-->



<!--end::Mixed Widget 2-->
@section('scripts')
<script type="text/javascript">
    var table,table2,table3,table9,table10 = null;
    $(document).ready(function () {
        table = $("#kt_datatable").DataTable({
          
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
            lengthChange: false,
            pageLength: 10,
            info: true,
            paging: false,
            // searchDelay: 500,
            processing: false,
            serverSide: true,
            searchable: false,
            ajax: {
                url : "{{route('user.customer.datatableDashboard')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    // columnsDef : ['id','phone_no','name','email','created_at','action']
                }

            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'name' },
                { data: 'phone_no' ,defaultContent:'-'},
                { data: 'email' ,defaultContent:'-'},
                { data: 'created_at' ,defaultContent:'-'},
                { data: 'action' }
            ],
            columnDefs : [
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                            <a href="${data.edit}" class="btn btn-icon btn-primary"><i class="las la-eye fs-2 me-2"></i></a>
                        `;
                    },
                },
               
            ],
            drawCallback : function( settings ) { }
        });
   
        // consultant

        table2 = $("#kt_datatable2").DataTable({
           
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
            lengthChange: false,
            pageLength: 10,
            searchDelay: 500,
            processing: false,
            serverSide: true,
            ajax: {
                url : "{{route('consultant.consultant.datatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    // columnsDef : ['id','phone_no','name','email','created_at','action']
                }

            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'name' },
                { data: 'phone_no' ,defaultContent:'-'},
                { data: 'email',defaultContent:'-' },
                { data: 'created_at',defaultContent:'-'},
                { data: 'action' }
            ],
            columnDefs : [
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                            <a href="${data.edit}" class="btn btn-icon btn-primary"><i class="las la-eye fs-2 me-2"></i></a>
                        `;
                    },
                },
               
            ],
            drawCallback : function( settings ) { }
        });

        // table3 = $("#kt_datatable3").DataTable({
        //     // initComplete: function(settings, json) {
        //     //     const select = ToogleColum.val()
        //     //     table.columns().every(function (index) {
        //     //         if(!select.includes(index.toString())){
        //     //             var column =  table.column(index)
        //     //             column.visible(false)
        //     //         }else{
        //     //             var column =  table.column(index)
        //     //             column.visible(true)
        //     //         }
        //     //     })
        //     // },
        //     responsive: true,
        //     buttons: [
        //             'print',
        //             'copyHtml5',
        //             'excelHtml5',
        //             'csvHtml5',
        //             'pdfHtml5',
        //         ],
        //     // Pagination settings
        //     dom: `<'row'<'col-sm-12'tr>>
        //     <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        //     // read more: https://datatables.net/examples/basic_init/dom.html
        //     lengthMenu: [5, 10, 25, 100],
        //         lengthChange: false,
        //     pageLength: 10,
        //         searchDelay: 500,
        //         processing: false,
        //         serverSide: true,
        //     ajax: {
        //     {{--    url : "{{route('history.appointment.datatable')}}",--}}
        //         type: 'POST',
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             columnsDef : ['id','customer_id','mobile','email','booking_id','consultant_id','appointment_date','status']
        //         }

        //     },
        //     columns: [
        //         { data: 'DT_RowIndex'},
        //         { data: 'customer_id',defaultContent:'-'},
        //         { data: 'mobile',defaultContent:'-'},
        //         { data: 'email',defaultContent:'-'},
        //         { data: 'booking_id',defaultContent:'-'},
        //         { data: 'consultant_id',defaultContent:'-'},
        //         { data: 'appointment_date',defaultContent:'-'},
        //         { data: 'status'}
        //     ],
        
        //     drawCallback : function( settings ) { }
        // });

        table9 = $("#kt_datatable9").DataTable({
                // initComplete: function(settings, json) {
                //     const select = ToogleColum.val()
                //     table.columns().every(function (index) {
                //         if(!select.includes(index.toString())){
                //             var column =  table.column(index)
                //             column.visible(false)
                //         }else{
                //             var column =  table.column(index)
                //             column.visible(true)
                //         }
                //     })
                // },
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
                processing: false,
                serverSide: true,
                ajax: {
                    url : "{{route('approval.firm.datatable')}}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        columnsDef : ['id','created_at','company_name','email','category','status','updated_at','option']
                    }
                },
                columns: [
                    { data: 'created_at'},
                    { data: 'comapany_name' },
                    { data: 'email' },
                    { data: 'category' },
                    { data: 'status'},
                    { data: 'updated_at'},
                    {data: 'option'}
                ],
                columnDefs : [
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <a href="${data.view}" class="btn btn-icon btn-primary"><i class="las la-eye fs-2 me-2"></i></a>
                            `;
                        },
                    },
                    {
                        targets: 4,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `
                                <select name="" id="" class="form-select" onchange='status(this)' data-control="select2">
                                    <option ${(row.dropdown.select == 1)?'selected':''} value="${row.dropdown.ped}">Pending</option>
                                    <option ${(row.dropdown.select == 2)?'selected':''} value="${row.dropdown.acc}">Approval</option>
                                    <option ${(row.dropdown.select == 3)?'selected':''} value="${row.dropdown.dec}">Decline</option>
                                </select>
                            `;
                        },

                    }
                ],
                drawCallback : function( settings ) { }
            });
        
        });


        // Consultant profile approvals

        table10 = $("#kt_datatable10").DataTable({
            // initComplete: function(settings, json) {
            //     const select = ToogleColum.val()
            //     table.columns().every(function (index) {
            //         if(!select.includes(index.toString())){
            //             var column =  table.column(index)
            //             column.visible(false)
            //         }else{
            //             var column =  table.column(index)
            //             column.visible(true)
            //         }
            //     })
            // },
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
            processing: false,
            serverSide: true,
            ajax: {
                url : "{{route('approval.consultant.datatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    columnsDef : ['id','created_at','name','email','category','status','updated_at','option']
                }

            },
            columns: [
                { data: 'created_at'},
                { data: 'name' },
                { data: 'email' },
                { data: 'category' },
                { data: 'status'},
                { data: 'updated_at'},
                {data: 'option'}
            ],
            columnDefs : [
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                                <a href="${data.view}" class="btn btn-icon btn-primary"><i class="las la-eye fs-2 me-2"></i></a>

                        `;
                    },
                },
                {
                    targets: 4,
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                            <select name="" id="" class="form-select" onchange='conStatus(this)' data-control="select2">
                                <option ${(row.dropdown.select == 1)?'selected':''} value="${row.dropdown.ped}">Pending</option>
                                <option ${(row.dropdown.select == 2)?'selected':''} value="${row.dropdown.acc}">Approval</option>
                                <option ${(row.dropdown.select == 3)?'selected':''} value="${row.dropdown.dec}">Decline</option>
                            </select>
                        `;
                    },

                }
            ],
            drawCallback : function( settings ) { }
        });

        function status(obj){
            value = obj.value;
            
            $.ajax({
                url: value,
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    changeValue:value,
                },
                success:function(data){
                if(data.msg){
                    Switealert(data.msg,'success')
                    
                }else{
                    var Ptag = "";
                    for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                    // Switealert(Ptag,'error')
                }
                
            },
            error:function(erroe){
                console.log(erroe);
                window.scrollTo({top:0,behavior:'smooth'});
                alert("Something is wrong");
            }
                    
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
        }
            
        function conStatus(obj){
                value = obj.value;
                
            $.ajax({
                url: value,
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    changeValue:value,
                },
                success:function(data){
                if(data.msg){
                    Switealert(data.msg,'success')
                    // Switealert
                }else{
                    var Ptag = "";
                    for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                    // Switealert(Ptag,'error')
                }
                },
                error:function(erroe){
                    console.log(erroe);
                    window.scrollTo({top:0,behavior:'smooth'});
                    alert("Something is wrong");
                }      
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
        }

        function statusFilter(obj){
            table3.column(4).search(obj.value, false, false);
            table3.table().draw();                                      
        }
</script>
@endsection
