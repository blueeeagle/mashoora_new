<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Country</h1>
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
                        <li class="breadcrumb-item text-muted">Country</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('master.country.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <form action="{{ route('master.country.update',$country->id) }}" method="Post" id="formEdit">
                            @csrf
                            <div class="py-5">

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label fs-6 mb-4">Country Name<span class="text-danger">*</span></label>
                                        <input type="text" name="country_name" class="form-control mb-4" required placeholder="Title" value="{{ $country->country_name }}" required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label fs-6 mb-4">Country Code (ISO 2 Code) <span class="text-danger">*</span></label>
                                        <input type="text" name="country_code" class="form-control mb-4" required placeholder="Code" value="{{ $country->country_code }}" required/>
                                    </div>
                                </div>
                                    
                                    
                                    
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label fs-6 mb-4">Dialing<span class="text-danger">*</span></label>
                                        <input type="text" required oninput="this.value = this.value.replace(/[A-Z a-z]+/g, '').replace(/(\..*)\./g, '$1');"  name="dialing" class="form-control mb-4" placeholder="Title" value="{{ $country->dialing }}" required/>

                                    </div>
                                    <div class="col-md-6">
                                            <label class="required fw-bold fs-6 mb-4">Has State</label>
                                            <div class="col-md-6">
                                            <input class="form-check-input me-3" name="has_state"  type="radio" value="1" {{ ($country->has_state == 1)?'checked':'' }} id="kt_docs_formvalidation_radio_option_1" />
                                                    <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                                        <div class="fw-bolder text-gray-800">Yes</div>
                                                    </label>
                                            &nbsp;
                                            <input class="form-check-input me-3" name="has_state" type="radio" value="0" {{ ($country->has_state == 0)?'checked':'' }} id="kt_docs_formvalidation_radio_option_1" />
                                            <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                                <div class="fw-bolder text-gray-800">No</div>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                  
                                  
                                        
                                        {{-- <div class="d-flex flex-column fv-row">
                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                               
                                            </div>
                                        </div>
                                    </div> --}}
                                    <br>
                                <div class="form-group row" style="float:right" >
                                    <div class="col-md-6">
                                       <button type="button" id="formEditReset" class="btn btn-secondary btn-hover-rise me-5 ">Reset</button>

                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-hover-rise me-5">Save</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Products-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    @section('scripts')
    <script>
        back = `{{ route('master.country.index') }}`
        $(document).ready(function () {
            back = `{{ route('master.country.index') }}`
        })
    </script>
    @endsection
</x-base-layout>