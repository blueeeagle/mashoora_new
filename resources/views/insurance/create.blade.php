<x-base-layout>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Insurance</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">User</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted"><a href="{{ route('user.insurance.index') }}" class="text-muted text-hover-primary">Insurance</a></li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Create Insurance</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
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
                    <div class="card-body rounded border pt-0">
                        <form action="{{ route('user.insurance.store') }}" method="post" id="formCreate">
                            @csrf
                            <div class="py-5">
                                 <div class="tabs effect-1 company">
			<!-- tab-title -->
			<input type="radio" id="tab-1" name="tab-effect-1" checked="checked">
			<span>About</span>

			<input type="radio" id="tab-2" name="tab-effect-1">
			<span> Address</span>

			<input type="radio" id="tab-3" name="tab-effect-1">
			<span>Contact</span>

			<!-- tab-content -->
			<div class="tab-content">
				<section id="tab-item-1">
					 <div class="p-10">
                                    <div class="form-group row">
                                    <div class="fv-row mb-10 col-md-6">
                                        <label class="required form-label fs-6 mb-2" >Company Name</label>
                                        <input type="text" name="comapany_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Company Name" required />
                                    </div>
                                    <div class="fv-row mb-10 col-md-6">
                                        <label class="required form-label fs-6 mb-2" >Legal Name</label>
                                        <input type="text" name="legal_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Legal Name" required />
                                    </div>
                                    <div class="fv-row mb-10 col-md-6">
                                        <label class="required form-label fs-6 mb-2" >Do you have tax?</label>
                                        <div class="form-check form-check-custom form-check-solid mb-5">
                                            <input class="form-check-input me-3" name="have_tax" type="radio" value="1" checked id="have_tax_Yes" />
                                            <label class="form-check-label" for="have_tax_Yes">
                                                <div class="fw-bolder text-gray-800">Yes</div>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid mb-5">
                                            <input class="form-check-input me-3" name="have_tax" type="radio" value="0" id="have_tax_no" />
                                            <label class="form-check-label" for="have_tax_no">
                                                <div class="fw-bolder text-gray-800">No</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-10 col-md-6" id="taxation_number_div">
                                        <label class="required form-label fs-6 mb-2" >Taxation Number</label>
                                        <input type="number" name="taxation_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Taxation Number" required />
                                    </div>
                                    <div class="fv-row mb-10 col-md-6">
                                        <label class="required form-label fs-6 mb-2" >Company Registered On</label>
                                        <input class="form-control form-control-solid" name="register_on" placeholder="Pick date rage" id="kt_daterangepicker_3" required/>
                                    </div>
                                    <div class="fv-row mb-10 col-md-6">
                                        @include('components.imagecrop',['name'=>'logo'])
                                    </div>
                                   
                                    <div class="fv-row mb-10 col-md-6">
                                        <label class="required form-label fs-6 mb-2" >Consultant Type </label>
                                        <div class="form-check form-check-custom form-check-solid mb-5">
                                            <input class="form-check-input me-3" name="consultant_type[]" type="checkbox" value="video_consultation" id="video_consultation" />
                                            <label class="form-check-label" for="video_consultation">
                                                <div class="fw-bolder text-gray-800">Video Consultation</div>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid mb-5">
                                            <input class="form-check-input me-3" name="consultant_type[]" type="checkbox" value="audio_voice_call_consultation" id="audio_voice_call_consultation" />
                                            <label class="form-check-label" for="audio_voice_call_consultation">
                                                <div class="fw-bolder text-gray-800">Audio / Voice Call Consultation</div>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid mb-5">
                                            <input class="form-check-input me-3" name="consultant_type[]" type="checkbox" value="text_consultation" id="text_consultation" />
                                            <label class="form-check-label" for="text_consultation">
                                                <div class="fw-bolder text-gray-800">Text Consultation</div>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid mb-5">
                                            <input class="form-check-input me-3" name="consultant_type[]" type="checkbox" value="direct_consultation" id="direct_consultation" />
                                            <label class="form-check-label" for="direct_consultation">
                                                <div class="fw-bolder text-gray-800">Direct Consultation</div>
                                            </label>
                                        </div>
                                    </div>
                                     </div>
                                </div>
				</section>
				<section id="tab-item-2">
				  
                                <div class="p-10">
                                    @include('components.addressComponent',['page'=>'create','countrys'=>$countrys])
                                </div>
				</section>
				<section id="tab-item-3">
				     <div class="p-10">
				     @include('components.contact')
				     </div>
				</section>
				
			</div>
		</div>
                              
                               
                               
 
                            
                                    <div class="fv-row mb-10">
                                        {{-- <label class="required fw-bold fs-6 mb-5"></label> --}}
                                        <div class="form-check form-check-custom form-check-solid mb-5">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status" type="checkbox" value="1" id="status" />
                                            <!--end::Input-->

                                            <!--begin::Label-->
                                            <label class="form-check-label" for="status">
                                                <div class="fw-bolder text-gray-800">Status</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
<div class="form-group row" style="float:right;">
                                    <div class="mb-10">
                                        <button type="submit" class="btn btn-primary btn-hover-rise me-5">Submit</button>
                                    </div>
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
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/cropper/cropper.bundle.js')}}'></script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/formrepeater/formrepeater.bundle.js')}}'></script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
    <script>
    const have_tax_Yes = document.querySelectorAll('[name="have_tax"]')
    const taxation_number_div = document.getElementById('taxation_number_div')
    var state = $("#state_id")
    var city = $("#city_id")


    back="{{route('user.insurance.index')}}";

    have_tax_Yes.forEach(element => {
        element.addEventListener('change',have_tax_Yes_fun)
    })


    $("#kt_daterangepicker_3").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"),10),
             locale: {
                        format: '{{ strtoupper($companeySetting->date_format) }}'
                    }
        }, function(start, end, label) {
            // var years = moment().diff(start, "years");
            // alert("You are " + years + " years old!");
        }
    );

        var options2 = {selector: "#register_address"};

        if (KTApp.isDarkMode()) {

            options2["skin"] = "oxide-dark";
            options2["content_css"] = "dark";
        }

        tinymce.init(options2);


    function have_tax_Yes_fun(event){
        if(event.target.value == 1){
            taxation_number_div.removeAttribute('hidden')
            taxation_number_div.setAttribute('required',true)
        }else{
            taxation_number_div.setAttribute('hidden',true)
            taxation_number_div.removeAttribute('required')
        }
    }

    $("#country_id").on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            url:"{{route('master.country.getState')}}",
            method:"POST",
            data:{id:data.id,"_token": "{{ csrf_token() }}",},
            success:function(data){
                var option = `<option>select State</option>`
                if(data.states.length != null){
                    data.states.forEach((e)=>{
                        option += '<option value='+e.id+'>'+e.state_name+'</option>';
                    })
                }
                state.html(option).trigger("change");
                city.html(null).trigger("change");
                if(data.currency){
                    $("#inputGroup-sizing-default").html(data.currency.currencycode)
                    $("#inputGroup-sizing-default_text").val(data.currency.countryname)
                }
                if(data.Country){
                    $("input[data-cmobile]").val(data.Country.dialing)
                    $("input[data-cphone]").val(data.Country.dialing)
                }
            }
        })
    });
    $("#state_id").on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            url:"{{route('master.country.getCity')}}",
            method:"POST",
            data:{id:data.id,"_token": "{{ csrf_token() }}",},
            success:function(data){
                var option = null
                if(data.length != null){
                    data.forEach((e)=>{
                        option += '<option value='+e.id+'>'+e.city_name+'</option>';
                    })
                }
                city.html(option).trigger("change");
            }
        })
    });
    $('#kt_docs_repeater_basic').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
    </script>
    @endsection
</x-base-layout>
