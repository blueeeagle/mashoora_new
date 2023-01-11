<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Customer</h1>
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
                        <li class="breadcrumb-item text-muted">App User</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('user.customer.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
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
                        <form action="{{ route('user.customer.update',$customer->id) }}" method="post" id="formEdit">
                            @csrf
                            <div class="py-5">
                               
                                <div class=" form-group row mb-3" >
                                    <div class="col-sm-2">
                                        <label class="form-label">Mobile</label>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                         <div class="input-group">
                                            <select class="form-select" name="country_code" id="country_code" style="max-width:15%;" disabled="true">
                                            <option>--</option>
                                              @foreach($countrys as $data)
                                                   <option value="{{$data->id}}" data-has_state='{{ $data->has_state }}' {{ ($customer->country_id ==  $data->id)?'selected':'' }}>{{$data->country_code}}</option>
                                               @endforeach
                                            </select>
                                          
                                            <input class="input-group-text" name="dialing" id="dialing" readonly style="width: 100px" value="{{ $customer->dialing }}">
                                            <input type="number" name="phone_no" id="phone_no" value="{{ $customer->phone_no }}" class="form-control" placeholder="Name" required readonly/>
                                         </div>
                                    </div>
                                </div>
                                  
                                <h4>Personal</h4>
                                    <div class="form-group row mb-3">
                                        <div class="col-sm-6">
                                            <label class="required form-label fs-6 mb-2" >Name</label>
                                            <input type="text" name="name" value="{{ $customer->name }}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" required />
                                        </div>
                                        <div class="col-sm-6"">
                                            <label class="required form-label fs-6 mb-2" >Date of Birth</label>
                                            <input class="form-control form-control-solid" name="dob" id="dob"  placeholder="Date of Birth" value="{{ $customer->dob }}"  required/>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row mb-3">
                                        <div class="col-sm-6">
                                            <label class="required form-label fs-6 mb-2" >Gender </label>
                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                <input class="form-check-input me-3" name="gender" type="radio" {{ ($customer->gender == 'male')?'checked':'' }} value="male" id="male" />
                                                <label class="form-check-label" for="male">
                                                    <div class="fw-bolder text-gray-800">Male</div>
                                                </label>

                                                <input class="form-check-input" name="gender" type="radio" {{ ($customer->gender == 'female')?'checked':'' }} value="female" id="Female" />
                                                <label class="form-check-label me-2" for="Female">
                                                    <div class="fw-bolder text-gray-800">Female</div>
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <label class="required form-label fs-6 mb-2" >Email</label>
                                            <input class="form-control form-control-solid" value="{{ $customer->email }}" name="email" id="Email"  placeholder="Email" type="email" required/>
                                        </div>
                                    </div>
                                
                                <h4>Address</h4>
                                <div class="rounded border p-10">
                                    @include('components.addressComponent',['country_id'=>$customer->country_id,'state_id'=>$customer->state_id,
                                        'city_id'=>$customer->city_id,'zipcode'=>$customer->zipcode,'register_address'=>$customer->register_address,'page'=>'Edit','countrys'=>$countrys,'state'=>$state,'city'=>$city])
                                </div>
                                
                                <div class="form-group row mb-3" style="float:right" >
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
                    <!--end::Card body-->
                </div>
                <!--end::Products-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    @section('scripts')
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
    <script>
        back = '{{ route('user.customer.index') }}'
        const yesterday = new Date();
        var BasicDetails = null
        yesterday.setDate(yesterday.getDate() - 1);


        // $("#dob").val(formatDate(yesterday))
        $("#dob").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"),10),
                maxDate : formatDate(yesterday),
                
            }, function(start, end, label) {}
        )


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
        
         var state = $("#state_id")
        var city = $("#city_id")
        var country_id = $("#country_id")
        var stateDiv = $('#stateDiv')
        var phone_no = $('#phone_no')

        $("#country_code").change(function (e) {
           
            var id = e.currentTarget.options[e.currentTarget.options.selectedIndex].value;
            let has_state =  e.currentTarget.options[e.currentTarget.options.selectedIndex].dataset.has_state;
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
                data:{id:id,"_token": "{{ csrf_token() }}",},
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
                    country_id.val(id).trigger("change");
                    state.html(option).val('').trigger("change");
                    city.html(option1).val('').trigger("change");
                    phone_no.val(data.Country.dialing)
                }
            })
            
        });
        

    </script>
    @endsection
</x-base-layout>
