<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create City</h1>
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
                        <li class="breadcrumb-item text-muted">Master</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('master.city.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <form action="{{ route('master.city.store') }}" method="post" id="formCreate">
                            @csrf
                            <div class="py-5">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Country<span class="text-danger">*</span></label>
                                        <select class="form-select mb-4" name="countryName" id="country_id" data-control="select2" required data-placeholder="Select an option">
                                            <option></option>
                                            @foreach($countrys as $country)
                                                <option value="{{$country->id}}" data-has_state='{{ $country->has_state }}' >{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="stateDiv">
                            
                                        <label for="" class="form-label">State<span class="text-danger">*</span></label>
                                        <select class="form-select mb-4 " name="stateName" id="state_id" data-control="select2" required data-placeholder="Select an option">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                   
                                    <div class="col-md-6">
                                        <label for="" class="form-label ">City<span class="text-danger">*</span></label>
                                        <input type="text" name="cityName" class="form-control " required placeholder="City"/>
                                    </div>
                                </div>

                                <div class="form-group row" style="float:right" >
                                    <div class="col-md-6">
                                        <button type="reset" id="formreset" class="btn btn-secondary btn-hover-rise me-5">Reset</button>
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
        $(document).ready(function () {
        back = '{{ route('master.city.index') }}'
        var state = $("#state_id")
        var city = $("#city_id")
        var stateDiv = $('#stateDiv')
        $("#country_id").on('select2:select', function (e) {
                var data = e.params.data;
                    let has_state =  e.params.data.element.dataset.has_state
                    if(has_state != "0"){
                        stateDiv.show(500)
                        state.attr('required');
                    }else{
                        stateDiv.hide(500)
                        state.removeAttr('required');
                    }
                $.ajax({
                    url:"{{route('master.country.getState')}}",
                    method:"POST",
                    data:{id:data.id,"_token": "{{ csrf_token() }}",},
                    success:function(data){
                        var option = `<option selected></option>`
                        var option1 = `<option selected></option>`

                        if(data.states.length != null){
                            data.states.forEach((e)=>{
                                option += '<option value='+e.id+'>'+e.state_name+'</option>';
                            })
                        }
                        if(data.city.length != null){
                            data.city.forEach((e)=>{
                                option1 += '<option value='+e.id+'>'+e.city_name+'</option>';
                            })
                        }
                        state.html(option).val('').trigger("change");
                        city.html(option1).val('').trigger("change");
                    }
                })
            })
        })
    </script>
    @endsection
</x-base-layout>
