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
                            <option value="name">Name</option>
                            {{-- <option value="categories_id">Category</option> --}}
                            <option value="description">Description</option>
                            <option value="tags">Tag</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xxl-10" data-id-filter="name" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">Name</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input mb-3 mb-lg-0" data-col-index='2' />
                        </div>
                        {{-- <div class="col-xxl-10" data-id-filter="categories_id" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">Category</label>
                            <select class="form-select datatable-input" data-col-index='3' data-control="select2" required data-placeholder="Select an option" multiple>
                                <option value=""></option>
                                @foreach ($Category as $key => $value )
                                    <option value="{{ $value->id }}">{{$value->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-xxl-10" data-id-filter="description" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">Description</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='4' />
                        </div>
                        <div class="col-xxl-10" data-id-filter="tags" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">Tag</label>
                            <input type="text" class="form-control form-control form-control-solid datatable-input" data-col-index='5' />
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
                            <option selected value="1">Type</option>
                            <option selected value="2">Name</option>
                            <option selected value="3">Category</option>
                            <option selected value="4">Description</option>
                            <option selected value="5">Tag</option>
                            <option selected value="6">Image</option>
                            <option selected value="7">Display In Home</option>
                            <option selected value="8">Status</option>
                            <option selected hidden value="9">Action</option>
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Firm Approvals List</h1>
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
                        <div class="card-title">
                            <button class="btn btn-primary me-5 btn-sm" data-rendering value="Pending">
                                <span data-apptick="Pending" class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Pending List</button>
                            <button class="btn btn-success me-5 btn-sm" data-rendering value="Approved">
                                <span data-apptick="Approved" hidden class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Approved List</button>
                            <button class="btn btn-danger me-5 btn-sm" data-rendering value="Decline">
                                <span data-apptick="Decline" hidden class="svg-icon svg-icon-muted svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor"></path>
                                                </svg></span>Declined List</button>
                        </div>
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
                                            <th>Logo</th>
                                            <th>Company Name</th>
                                            <th>Company Registered On</th>
                                            <th>Address</th>
                                            <th>Category</th>
                                            <th>Approval status</th>
                                            <th>Approve Date</th>
                                            <th>Decline status</th>
                                            <th>Firm Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <!--<td colspan="9"></td>-->
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><button class="btn btn-danger btn-sm" data-app  value="1" id="decline">Decline</button></th>
                                            <td><button class="btn btn-success btn-sm" data-app  value="2" id="approve">Approve</button></th>
                                            
                                        </tr>
                                    </tfoot>
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
<script src="{{ URL::asset(theme()->getDemo().'/js/firm_app.js') }}"></script>

<script type="text/javascript">
    const app_status = `{{ route('approval.firm.status')}}`
    const firmdatatable = `{{route('approval.firm.datatable')}}`

    var checked = [];
    var table = null;
        $(document).ready(function () {

        });

    function update_approval(e){

       if(e.value == 1){
           var status = "Decline";
       }
       else{
           var status = "Approve";
       }

       if(checked.length !=0 ){
           $.ajax({
               url: "",
               method:"post",
               data:{
                   "_token": "{{ csrf_token() }}",
                   status:status,
                   id:checked,
               },
               success:function(data){
                    if(data.msg){
                        checked = [];
                        Switealert(data.msg,'success')
                        table.draw()
                    }else{
                        var Ptag = "";
                        for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                        Switealert(Ptag,'error')
                    }
               }
           })
       }
    }

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
    </script>
@endsection
</x-base-layout>

