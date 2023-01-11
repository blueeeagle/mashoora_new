<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Currency</h1>
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
                        <li class="breadcrumb-item text-muted">Currency</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('master.currency.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
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
                        <form action="{{ route('master.currency.update',$currency->id) }}" method="Post" id="formEdit">
                            @csrf
                            <div class="py-5">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label fs-6 mb-4">Country Name<span class="text-danger">*</span></label>
                                        <input type="text" name="countryname" class="form-control mb-4" placeholder="Country Name" value="{{ $currency->countryname }}" required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label fs-6 mb-4">Country Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control mb-4" placeholder="Country Code" value="{{ $currency->countrycode }}" required readonly/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label fs-6 mb-4">Currency Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control mb-4" placeholder="Currency Code" value="{{ $currency->currencycode }}" readonly/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label fs-6 mb-4">Symbol<span class="text-danger">*</span></label>
                                        <input type="text" name="symbol" class="form-control mb-4" placeholder="Symbol" value="{{ $currency->symbol }}" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label fs-6 mb-4">Price<span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control mb-4" placeholder="Price" value="{{ $currency->price }}" required/>
                                    </div>
                                    <div class="col-md-6">
                                      
                                        <input class="form-check-input me-3" name="status" type="checkbox" {{ ($currency->status == '1')?'checked':'' }} value="1" id="status" />
                                     
                                        <label class="form-check-label" for="status">
                                            <div class="fw-bolder text-gray-800">Status</div>
                                        </label>
                                    </div>
                                </div>

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
        back = `{{ route('master.currency.index') }}`
        $(document).ready(function () {
            back = `{{ route('master.currency.index') }}`
        })
    </script>
    @endsection
</x-base-layout>
