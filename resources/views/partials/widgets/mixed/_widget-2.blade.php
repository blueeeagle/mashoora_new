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
                                            <th>Customer Name</th>
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
         
          
                    {{-- Tab 2 --}}
                <div class="tab-pane fade show " id="kt_tab_pane_2" role="tabpanel">
                    <div id="kt_content_container" class="container-xxl">
                        <div class="row gy-10 gx-xl-10">
                            <div class="card card-docs flex-row-fluid mb-2">
                                <table id="kt_datatable2" class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th>SNo</th>
                                            <th>Consultant Name</th>
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
                                    </tfoot> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        
       

            <div class="col-xxl-6">
                <div class="card-header align-items-center border-0 mt-4">
                    <div class="fv-row mb-12">
                        <select name="" class="form-select form-select-solid" id="">
                            <option value="">All Consultant</option>
                        </select>
            
                    </div>
                    
                    <div class="fv-row mb-12">
                        <select name=""  class="form-select form-select-solid" id="">
                            <option value="">All Status</option>
                            <option value="1">Booked</option>
                            <option value="2">Process</option>
                            <option value="3">Cancelled</option>
                            <option value="4">Completed</option>
                        </select>
                    </div>
            
                </div>
                <div id="kt_content_container">
                    <table id="kt_datatable3" class="table table-row-bordered gy-5">
                            <thead>
                                <tr class="fw-bold fs-6 text-muted">
                                    <th>SNo</th>
                                    <th>Customer Name</th>
                                    <th>Mobile No</th>
                                    <th>E-mail ID</th>
                                    <th>Booking ID</th>
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
    var table,table2,table3 = null;
        $(document).ready(function () {
            table = $("#kt_datatable").DataTable({
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
                // buttons: [
                //         'print',
                //         'copyHtml5',
                //         'excelHtml5',
                //         'csvHtml5',
                //         'pdfHtml5',
                //     ],
                // // Pagination settings
                // dom: `<'row'<'col-sm-12'tr>>
                // <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // // read more: https://datatables.net/examples/basic_init/dom.html

                // lengthMenu: [5, 10, 25, 100],
                lengthChange: false,
                pageLength: 10,
                info: true,
                paging: false,
                // searchDelay: 500,
                processing: true,
                serverSide: true,
                searchable: false,
                ajax: {
                    url : "{{route('user.customer.datatableDashboard')}}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        columnsDef : ['id','phone_no','name','email','created_at','action']
                    }

                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'name' },
                    { data: 'phone_no' },
                    { data: 'email' },
                    { data: 'created_at' },
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
                // buttons: [
                //         'print',
                //         'copyHtml5',
                //         'excelHtml5',
                //         'csvHtml5',
                //         'pdfHtml5',
                //     ],
                // // Pagination settings
                // dom: `<'row'<'col-sm-12'tr>>
                // <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // // read more: https://datatables.net/examples/basic_init/dom.html

                // lengthMenu: [5, 10, 25, 100],
                lengthChange: false,
                pageLength: 10,
                info: true,
                paging: false,
                // searchDelay: 500,
                processing: true,
                serverSide: true,
                searchable: false,
                ajax: {
                    url : "{{route('consultant.consultant.datatable')}}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        columnsDef : ['id','phone_no','name','email','created_at','action']
                    }

                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'name' },
                    { data: 'phone_no' },
                    { data: 'email' },
                    { data: 'created_at' },
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

            table3 = $("#kt_datatable3").DataTable({
            responsive: true,
            // buttons: [
            //         'print',
            //         'copyHtml5',
            //         'excelHtml5',
            //         'csvHtml5',
            //         'pdfHtml5',
            //     ],
            // // Pagination settings
            // dom: `<'row'<'col-sm-12'tr>>
            // <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // // read more: https://datatables.net/examples/basic_init/dom.html

            lengthChange: false,
                pageLength: 10,
                info: true,
                paging: false,
                // searchDelay: 500,
                processing: true,
                serverSide: true,
                searchable: false,
            ajax: {
                url : "{{route('history.appointment.datatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    columnsDef : ['id','title','updated_at','status']
                }

            },
            columns: [
                { data: 'DT_RowIndex'},
                { data: 'app_booked_with'},
                { data: 'app_booked_with'},
                { data: 'app_booked_by'},
                { data: 'booking_id'},
                { data: 'app_booked_with'},
                { data: 'status'}
            ],
           
            drawCallback : function( settings ) { }
        });
            
        });

    </script>
    @endsection
   