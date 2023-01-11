<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit State</h1>
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
                        <li class="breadcrumb-item text-muted">State</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('master.state.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <div class="card-body pt-0">
                        <form action="{{ route('master.state.update',$state->id) }}" method="POST" id="formEdit">
                            @csrf
                            <div class="py-5">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                   
                                        <label for="" class="form-label">Country<span class="text-danger">*</span></label>
                                        <select class="form-select" name="country_id" data-control="select2" required data-placeholder="Select an option">
                                            <option></option>
                                            @foreach($data as $country)
                                                <option {{ ($state->country_id ==  $country->id)?'selected':'' }} value="{{$country->id}}">{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                   
                                        <label for="" class="form-label">State name<span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $state->state_name }}" name="state_name" class="form-control mb-4 " required placeholder="State name"/>
                                    </div>
                                </div>
                                <div class="form-group row" style="float:right" >
                                    <div class="col-md-6">
                                        <button type="button" id="formEditReset" class="btn btn-secondary btn-hover-rise me-5 ">Reset</button>

                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-hover-rise">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
    <script>
        back = `{{ route('master.state.index') }}`
        $(document).ready(function () {
            back = `{{ route('master.state.index') }}`
        })
    </script>
    @endsection
</x-base-layout>
