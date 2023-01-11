<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Company Setting</h1>
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
                        <li class="breadcrumb-item text-muted">Setting</li>
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
                <div class="card mb-5 mb-xl-10">
                    @include('companysetting.basicinfo')
                </div>
                <div class="card mb-5 mb-xl-10">
                    <form class="formEdit" action="{{ route('setting.companysettings.detailsupdate') }}"  onsubmit="tinymce.triggerSave();" method="post" id="">
                    @csrf
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Company Details</h3>
                        </div>
                        <div style="padding-top: 13px;">
                            <input class="btn btn-primary align-self-center details" onclick="details()" hidden type="button" value="Cancel"/>
                            <input class="btn btn-primary align-self-center details" hidden type="submit" value="Update Details"/>
                            <input class="btn btn-primary align-self-center details" onclick="details()" type="button" value="Edit"/>
                        </div>
                    </div>
                    <div class="card-body details">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Company Name</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->comapany_name }}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Have Tax ?</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ ($Companysetting->have_tax == 1)? 'Yes':'No' }}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Company Registered On</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->register_on }}</span></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Legal Name</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->legal_name }}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Taxation Number</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->taxation_number }}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">About Us</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{!! $Companysetting->about_us !!}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body details" hidden>
                        <div class="row">
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Company Name</label>
                                <input type="text" name="comapany_name" value="{{ $Companysetting->comapany_name }}" class="form-control form-control-solid mb-4" placeholder="Company Name" required />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Company Email</label>
                                <input type="email" name="email" value="{{ $Companysetting->email }}" class="form-control form-control-solid mb-4" placeholder="Company Email" required />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Legal Name</label>
                                <input type="text" name="legal_name" value="{{ $Companysetting->legal_name }}" class="form-control form-control-solid mb-4" placeholder="Legal Name" required />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Do you have tax?</label>
                                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                    <label class="form-check-label" for="flexSwitch20x30">No&nbsp;</label>
                                    <input class="form-check-input h-20px w-30px" onchange="have_tax_Yes_fun(event)" type="checkbox" value="1" name="have_tax" {{ ($Companysetting->have_tax == 1)? 'checked':'' }} id="flexSwitch20x30"/>
                                    <label class="form-check-label" for="flexSwitch20x30">Yes</label>
                                </div>
                            </div>
                            <div class="col-xl-6" id="taxation_number_div" {{ ($Companysetting->have_tax != 1)? "hidden":''}}>
                                <label class="required form-label fs-6 mb-4">Taxation Number</label>
                                <input type="number" name="taxation_number" id="taxation_number" value="{{ $Companysetting->taxation_number }}" class="form-control form-control-solid mb-4" placeholder="Taxation Number" {{ ($Companysetting->have_tax_Yes == 1)?"required":''}} />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Company Registered On</label>
                                <input class="form-control form-control-solid mb-4" value="{{ $Companysetting->register_on }}" name="register_on" placeholder="Pick date rage" id="kt_daterangepicker_3" required />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">About Us</label>
                                <textarea id="about_us" name="about_us" class="tox-target" maxlength="256">{{ $Companysetting->about_us }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                {{-- address --}}
                <div class="card mb-5 mb-xl-10">
                    <form class="formEdit" action="{{ route('setting.companysettings.addressupdate') }}" method="post" id="">
                    @csrf
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Company Address</h3>
                        </div>
                        <div style="padding-top: 13px;">
                            <input class="btn btn-primary align-self-center Address" onclick="Address()" hidden type="button" value="Cancel"/>
                            <input href="#" class="btn btn-primary align-self-center Address" type="submit" hidden value="Update Address"/>
                            <input class="btn btn-primary align-self-center Address" onclick="Address()" type="button" value="Edit"/>
                        </div>
                    </div>
                    <div class="card-body Address">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Registered Address</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{!! $Companysetting->register_address !!}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Country</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->country->country_name ?? ''}}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted" {{ ($Companysetting->country->has_state == 1)?'':'hidden' }}>State</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->state->state_name ?? '' }}</span></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">City</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->city->city_name ?? '' }}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Zip Code</label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->zipcode }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body Address" hidden>
                        @include('components.addressComponent',['country_id'=>$Companysetting->country_id,'state_id'=>$Companysetting->state_id,
                            'city_id'=>$Companysetting->city_id,'zipcode'=>$Companysetting->zipcode,'register_address'=>$Companysetting->register_address,'page'=>'Edit',
                            'countrys'=>$countrys,'state'=>$state,'city'=>$city])
                    </div>
                    </form>
                </div>
                {{-- Companysettings --}}
                <div class="card mb-5 mb-xl-10">
                    <form class="formEdit" action="{{ route('setting.companysettings.settingupdate') }} " method="post" id="">
                    @csrf
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Company Setting</h3>
                        </div>
                        <div style="padding-top: 13px;">
                            <input class="btn btn-primary align-self-center Setting" onclick="Setting()" hidden type="button" value="Cancel"/>
                            <input href="#" class="btn btn-primary align-self-center Setting" type="submit" hidden value="Update Settings"/>
                            <input class="btn btn-primary align-self-center Setting" onclick="Setting()" type="button" value="Edit"/>
                        </div>
                    </div>
                    <div class="card-body Setting">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Base Currency<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="App owner transactions currency" aria-label="App owner transactions currency"></i></label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{$currency->countrycode ?? ''}} {{$currency->countryname ?? ''}}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Date Format<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="App owner viewable date format" aria-label="App owner viewable date format"></i></label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ date($Companysetting->date_format) }}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Discard Cut off Time<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Customer Booking Cancellation cut off time for refund eligibility" aria-label="Customer Booking Cancellation cut off time for refund eligibility"></i></label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->discard_cut_off_time }}</span></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Time Zone<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="App owner timezone" aria-label="App owner timezone"></i></label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{$Time_Zone}}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Reschedule Cut off Time<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Customer reschedule cut off time for another booking" aria-label="Customer reschedule cut off time for another booking"></i></label>
                                    <div class="col-lg-8"> <span class="fw-bolder fs-6 text-gray-800">{{ $Companysetting->reschedule_cut_off_time }}</span></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Logo (For Login Page)</label>
                                    <div class="col-lg-8"><img src="{{ asset("storage/$Companysetting->logo_login_page") }}" style="width:40px; #222;height: 40px" alt=""/></div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Logo (For Header)</label>
                                    <div class="col-lg-8"><img src="{{ asset("storage/$Companysetting->logo_header") }}" style="width:40px; #222;height: 40px" alt=""/></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body Setting" hidden>
                        <div class="row">
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Base Currency<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="App owner transactions currency" aria-label="App owner transactions currency"></i></label>
                                <div class="input-group input-group-solid mb-4">
                                    <span class="input-group-text base_curency mb-4" id="base_curency">{{$currency->countrycode}}</span>
                                    <input type="text" style="text-align: left;" value="{{$currency->countryname}}" class="form-control form-control-solid mb-4"
                                    id="inputGroup-sizing-default_text" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label fs-6 mb-4">Time Zone<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="App owner timezone" aria-label="App owner timezone"></i></label>
                                <input type="text" style="text-align: left;" value="{{$Time_Zone}}" class="form-control form-control-solid mb-4" readonly />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Date Format<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="App owner viewable date format" aria-label="App owner viewable date format"></i></label>
                                <select class="form-select mb-4" name="date_format" id="date_format" data-control="select2" data-placeholder="Eg: Y-M:m-D:d" required>
                                    <option></option>
                                    <option {{ ($Companysetting->date_format == 'm/d/y')?'selected':'' }} value="m/d/y">m/d/y</option>
                                    <option {{ ($Companysetting->date_format == 'd-m-y')?'selected':'' }} value="d-m-y">d-m-y</option>
                                    <option {{ ($Companysetting->date_format == 'd-M-Y')?'selected':'' }} value="d-M-Y">d-M-Y</option>
                                    <option {{ ($Companysetting->date_format == 'y-d-m')?'selected':'' }} value="y-d-m">y-d-m</option>
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Reschedule Cut off Time<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Customer reschedule cut off time for another booking" aria-label="Customer reschedule cut off time for another booking"></i></label>
                                <input type="time" name="reschedule_cut_off_time" value="{{ $Companysetting->reschedule_cut_off_time }}" class="without form-control form-control-solid mb-4" required />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fs-6 mb-4">Discard Cut off Time<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Customer Booking Cancellation cut off time for refund eligibility" aria-label="Customer Booking Cancellation cut off time for refund eligibility"></i></label>
                                <input type="time" name="discard_cut_off_time" value="{{ $Companysetting->discard_cut_off_time }}" class="without form-control form-control-solid mb-4" placeholder="Eg: H:i:s:a" required />
                            </div>
                            <div class="col-xl-3">
                                <label class="required form-label fs-6 mb-4">Logo (For Login Page)</label><br/>
                                <div>
                                    @include('components.imagecrop',['name'=>'logo_login_page','imgsrc'=>$Companysetting->logo_login_page])
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <label class="required form-label fs-6 mb-4">Logo (For Header)</label><br/>
                                <div>
                                    @include('components.imagecrop',['name'=>'logo_header','imgsrc'=>$Companysetting->logo_header])
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                {{-- Contact --}}
                <div class="card mb-5 mb-xl-10">
                    <form class="formEdit" action="{{ route('setting.companysettings.contactupdate') }}" method="post" id="">
                    @csrf
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Company Contact</h3>
                        </div>
                        <input href="#" class="btn btn-primary align-self-center" type="submit"  value="Update Contact"/>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @include('components.contact',['contact'=>$contact,'dialing'=>$Companysetting->country->dialing])
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    @section('scripts')
    <script>
        $(document).ready(function () {
            back = "{{ route('setting.companysettings.index') }}"
        })

    </script>
    <style>
        .without::-webkit-datetime-edit-ampm-field {
            display: none;

        }

    </style>

    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/cropper/cropper.bundle.js')}}'></script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/formrepeater/formrepeater.bundle.js')}}'></script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
    <script>
        var objectB = new Object();
        var objectA = new Object();
        const have_tax_Yes = document.querySelectorAll('[name="have_tax"]')
        const taxation_number_div = document.getElementById('taxation_number_div')
        const taxation_number = document.getElementById('taxation_number')
        const details = function(){
            [...document.querySelectorAll('.details')].forEach(e => e.hidden = !e.hidden)
        }
        const Address = function(){
            [...document.querySelectorAll('.Address')].forEach(e => e.hidden = !e.hidden)
        }
        const Setting = function(){
            [...document.querySelectorAll('.Setting')].forEach(e => e.hidden = !e.hidden)
        }
        have_tax_Yes.forEach(element => {
            element.addEventListener('change', have_tax_Yes_fun)
        })

        $('.formEdit').submit(function(e){
            e.preventDefault();
            const formData = new FormData(e.target);
            $.ajax({
                method:"POST",
                url:$(this).prop('action'),
                data:new FormData(e.target),
                cache: false,
                processData: false,
                contentType: false,
                success:function(data){
                    if(data.msg){
                        Switealert(data.msg,'success')
                        setTimeout(() => {
                            if(back) window.location.href = back
                        }, 1000);
                    }else{
                        var Ptag = "";
                        for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                        Switealert(Ptag,'error')
                    }
                    console.log(data);
                    // window.scrollTo({top:0,behavior:'smooth'});
                },
                error:function(erroe){
                    console.log(erroe);
                    // window.scrollTo({top:0,behavior:'smooth'});
                    alert("Something is wrong");
                }
            });
        });

        $("#kt_daterangepicker_3").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10)
        }, function (start, end, label) {
            // var years = moment().diff(start, "years");
            // alert("You are " + years + " years old!");
        });

        var options = {
            selector: "#about_us",
            height : "200"
        };

        if (KTApp.isDarkMode()) {
            options["skin"] = "oxide-dark";
            options["content_css"] = "dark";
        }

        tinymce.init(options);


        function have_tax_Yes_fun(event) {
            if (event.target.checked) {
                taxation_number_div.removeAttribute('hidden')
                taxation_number.setAttribute('required', true)
            } else {
                taxation_number_div.setAttribute('hidden', true)
                 taxation_number.removeAttribute('required')
                taxation_number.value = '';
            }
        }

        $('.formCreate').submit(function(e){
        e.preventDefault();
        const formData = new FormData(e.target);
        $.ajax({
            method:"POST",
            url:$(this).prop('action'),
            data:formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(data){
                if(data.msg){
                    e.target.reset();
                    Switealert(data.msg,'success')
                    setTimeout(() => {
                        if(back) window.location.href = back
                    }, 1000);
                }else{
                    var Ptag = "";
                    for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                    Switealert(Ptag,'error')
                }
                console.log(data);
                window.scrollTo({top:0,behavior:'smooth'});
            },
            error:function(erroe){
                console.log(erroe);
                window.scrollTo({top:0,behavior:'smooth'});
                alert("Something is wrong");
            }
        });
    });
    
    
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
