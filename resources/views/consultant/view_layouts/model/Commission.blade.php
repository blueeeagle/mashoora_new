<div class="modal fade" id="Commission_update" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form id="Commission_form" class="form" action="#">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Schedule and Commission Fee</h1>
                        {{-- <div class="text-muted fw-bold fs-5">If you need more info, please check
                            <a href="#" class="fw-bolder link-primary">Project Guidelines</a>.
                        </div> --}}
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Slot Timing</span>
                        </label>
                        <div class="d-flex align-items-center">
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input"  name="preferre_slot" type="radio" value="15"  {{($consultant->preferre_slot == 15)?'checked':''}}>
                                <span class="form-check-label fw-bold">15 Min</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input"  name="preferre_slot" type="radio" value="30"  {{($consultant->preferre_slot == 30)?'checked':''}}>
                                <span class="form-check-label fw-bold">30 Min</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input"  name="preferre_slot" type="radio" value="45"  {{($consultant->preferre_slot == 45)?'checked':''}}>
                                <span class="form-check-label fw-bold">45 Min</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input" required  name="preferre_slot" type="radio" value="60"  {{($consultant->preferre_slot == 60)?'checked':''}}>
                                <span class="form-check-label fw-bold">60 Min</span>
                            </label>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Consultant Type</span>
                        </label>
                        <div class="d-flex flex-stack" style="justify-content: space-around">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" onchange="enabledisable(document.querySelector('input[name=video_amount]'))" name="video" type="checkbox" value="1" {{ ($consultant->video == 1)?'checked':'' }}>
                                <span class="form-check-label fw-bold text-muted">Video</span>
                            </label>
                            <div class="me-5">
                                <div class="input-group mb-5">
                                    <span class="input-group-text countrycode">{{ $consultant->country->currency->currencycode }}</span>
                                    <input type="number" {{ ($consultant->video == 1)?'':'disabled' }} onkeyup="courencyconveter()" name="video_amount" value="{{ $consultant->video_amount }}" class="form-control mb-2 mb-md-0" placeholder="">
                                    <span class="input-group-text countrycode">{{ $companeySetting->country->currency->currencycode;  }} {{ round(($consultant->video_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <div class="d-flex flex-stack" style="justify-content: space-around">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" onchange="enabledisable(document.querySelector('input[name=text_amount]'))"  name="text" type="checkbox" value="1" {{ ($consultant->text == 1)?'checked':'' }}>
                                <span class="form-check-label fw-bold text-muted">Text</span>
                            </label>
                            <div class="me-5">
                                <div class="input-group mb-5">
                                    <span class="input-group-text countrycode">{{ $consultant->country->currency->currencycode }}</span>
                                    <input type="number" {{ ($consultant->text == 1)?'':'disabled' }} onkeyup="courencyconveter()" name="text_amount" value="{{ $consultant->text_amount }}" class="form-control mb-2 mb-md-0" placeholder="">
                                    <span class="input-group-text countrycode">{{ $companeySetting->country->currency->currencycode;  }} {{ round(($consultant->text_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <div class="d-flex flex-stack" style="justify-content: space-around">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" onchange="enabledisable(document.querySelector('input[name=direct_amount]'))" name="direct" type="checkbox" value="1" {{ ($consultant->direct == 1)?'checked':'' }}>
                                <span class="form-check-label fw-bold text-muted">Direct Visit</span>
                            </label>
                            <div class="me-5">
                                <div class="input-group mb-5">
                                    <span class="input-group-text countrycode">{{ $consultant->country->currency->currencycode }}</span>
                                    <input type="number" {{ ($consultant->direct == 1)?'':'disabled' }} onkeyup="courencyconveter()" name="direct_amount" value="{{ $consultant->direct_amount }}" class="form-control mb-2 mb-md-0" placeholder="">
                                    <span class="input-group-text countrycode">{{ $companeySetting->country->currency->currencycode;  }} {{ round(($consultant->direct_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <div class="d-flex flex-stack" style="justify-content: space-around">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" onchange="enabledisable(document.querySelector('input[name=voice_amount]'))" name="voice" type="checkbox" value="1" {{ ($consultant->voice == 1)?'checked':'' }}>
                                <span class="form-check-label fw-bold text-muted">Voice</span>
                            </label>
                            <div class="me-5">
                                <div class="input-group mb-5">
                                    <span class="input-group-text countrycode">{{ $consultant->country->currency->currencycode }}</span>
                                    <input type="number" {{ ($consultant->voice == 1)?'':'disabled' }} onkeyup="courencyconveter()" name="voice_amount" value="{{ $consultant->voice_amount }}" class="form-control mb-2 mb-md-0" placeholder="">
                                    <span class="input-group-text countrycode">{{ $companeySetting->country->currency->currencycode;  }} {{ round(($consultant->voice_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Commission For Consultant Fee</span>
                        </label>
                        <div class="d-flex align-items-center">
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input"  name="com_con_type" type="radio" onchange="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value,document.getElementById('com_con_amount_span'),document.getElementById('com_con_amount'))" value="0"  {{($consultant->com_con_type == 0)?'checked':''}}>
                                <span class="form-check-label fw-bold">Flat</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input" required name="com_con_type" type="radio" onchange="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value,document.getElementById('com_con_amount_span'),document.getElementById('com_con_amount'))" value="1"  {{($consultant->com_con_type == 1)?'checked':''}}>
                                <span class="form-check-label fw-bold">Percentage</span>
                            </label>
                        </div>
                    </div>
                    @php
                    $span = ($consultant->com_con_type == 1)?'%':$companeySetting->country->currency->currencycode;
                    if($consultant->com_con_type == 0){
                        $amount = round((($consultant->com_con_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price),2);
                        $span = "$span $amount";
                    }
                    @endphp
                    <div class="d-flex flex-column mb-8 fv-row">
                        <div class="d-flex align-items-center">
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect">{{ $consultant->country->currency->currencycode; }}</span>
                                <input type="number" id="com_con_amount" required value="{{ $consultant->com_con_amount; }}" onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value,document.getElementById('com_con_amount_span'),document.getElementById('com_con_amount'))" class="form-control" name="com_con_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                                
                                <span class="input-group-text" id="com_con_amount_span">{{ $span ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Commission For Offers</span>
                        </label>
                        <div class="d-flex align-items-center">
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input" required name="com_off_type" type="radio" onchange="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value,document.getElementById('com_off_amount_span'),document.getElementById('com_off_amount'))"  value="0"  {{($consultant->com_off_type == 0)?'checked':''}}>
                                <span class="form-check-label fw-bold">Flat</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input"  name="com_off_type" type="radio" onchange="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value,document.getElementById('com_off_amount_span'),document.getElementById('com_off_amount'))"  value="1"  {{($consultant->com_off_type == 1)?'checked':''}}>
                                <span class="form-check-label fw-bold">Percentage</span>
                            </label>
                        </div>
                    </div>
                    @php
                    $span = ($consultant->com_off_type == 1)?'%':$companeySetting->country->currency->currencycode;
                    if($consultant->com_off_type == 0){
                        $amount = round((($consultant->com_off_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price),2);
                        $span = "$span $amount";
                    }
                    @endphp
                    <div class="d-flex flex-column mb-8 fv-row">
                        <div class="d-flex align-items-center">
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect">{{ $consultant->country->currency->currencycode; }}</span>
                                <input type="number" id="com_off_amount" required value="{{ $consultant->com_off_amount; }}" onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value,document.getElementById('com_off_amount_span'),document.getElementById('com_off_amount'))" class="form-control" name="com_off_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                                <span class="input-group-text" id="com_off_amount_span">{{ $span }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Payout Settings</span>
                        </label>
                        <div class="d-flex align-items-center">
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input" required name="com_pay_type" type="radio" onchange="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value,document.getElementById('com_pay_type_span'),document.getElementById('com_pay_amount'))" value="0"  {{($consultant->com_pay_type == 0)?'checked':''}}>
                                <span class="form-check-label fw-bold">Flat</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input"  name="com_pay_type" type="radio" onchange="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value,document.getElementById('com_pay_type_span'),document.getElementById('com_pay_amount'))" value="1"  {{($consultant->com_pay_type == 1)?'checked':''}}>
                                <span class="form-check-label fw-bold">Percentage</span>
                            </label>
                        </div>
                    </div>
                    @php
                    $span = ($consultant->com_pay_type == 1)?'%':$companeySetting->country->currency->currencycode;
                    if($consultant->com_pay_type == 0){
                        $amount = round((($consultant->com_pay_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price),2);
                        $span = "$span $amount";
                    }
                    @endphp
                    <div class="d-flex flex-column mb-8 fv-row">
                        <div class="d-flex align-items-center">
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect">{{ $consultant->country->currency->currencycode; }}</span>
                                <input type="number" id="com_pay_amount" required value="{{ $consultant->com_pay_amount; }}" onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value,document.getElementById('com_pay_type_span'),document.getElementById('com_pay_amount'))" class="form-control" name="com_pay_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                                <span class="input-group-text" id="com_pay_type_span">{{ $span }}</span>
                            </div>
                        </div>
                    </div>
                    @if(count($consultant->Schedule) < 1)
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3 kt_modal_new_target_cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary kt_modal_new_target_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    @else
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <div class="d-flex flex-stack flex-grow-1">
                            <div class="fw-bold">
                                <h4 class="text-gray-900 fw-bolder">Warning</h4>
                                <div class="fs-6 text-gray-700">Some schedule is not Expired,
                                <a href="#">You able to update after schedule is complete</a></div>
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
