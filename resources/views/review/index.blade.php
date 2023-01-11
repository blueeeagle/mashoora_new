<x-base-layout>
    @include('approval.pay_approvals.view_modeForPayIn')

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Review</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Review</li>
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
                                <table class="table table-row-bordered table-row-dashed gy-5" id="kt_customers_table">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800">
                                            <th>SNo</th>
                                            <th>Review Date</th>
                                            <th>Customer</th>
                                            <th>Consultant</th>
                                            <th>Appointment Id</th>
                                            <th>Review</th>
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
<script>

var table = null
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
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('review.datatable')}}",
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
                        table.ajax.reload(null, false);
                        Switealert((data.status)?data.msg:'error',(data.status)?'success':'error')
                    });
                }
            }))
    }
</script>
@endsection
</x-base-layout>
