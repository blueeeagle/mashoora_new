<div class="modal fade" id="personal_detail_update" tabindex="-1" aria-hidden="true">
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
                <form id="personal_form" class="form" action="#">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Profile Update</h1>
                        {{-- <div class="text-muted fw-bold fs-5">If you need more info, please check
                            <a href="#" class="fw-bolder link-primary">Project Guidelines</a>.
                        </div> --}}
                    </div>
                    <div class="d-flex flex-stack mb-8">
						<!--begin::Label-->
					<div class="me-5">
						<label class="fs-6 fw-bold">Individual or Firm</label>
						<div class="fs-7 fw-bold text-muted">(Are you working in firm or indivudal professional)</div>
					</div>
					<!--end::Label-->
					<!--begin::Switch-->
						<label class="form-check form-switch form-check-custom form-check-solid">
						<input class="form-check-input" type="checkbox" value="1" onchange="firm_div_function()" {{ ($consultant->firm_choose == '' || $consultant->firm_choose == null)?'':'checked' }} >
					<span class="form-check-label fw-bold text-muted"></span>
					</label>
					<!--end::Switch-->
					</div>
                    <div class="flex-column mb-8 fv-row" id="firm_div" style="{{ ($consultant->firm_choose == '' || $consultant->firm_choose == null)?'display:none':'' }}">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">Firm</span>
                        </label>
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Firm" name="firm_choose" id="firm_choose">
                            <option value=''></option>
                            @foreach($firm as $value)
                                <option data-image="{{ asset("storage/$value->logo") }}" {{ ($consultant->firm_choose == $value->id)?'selected':'' }} value="{{$value->id}}">{{$value->comapany_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Name</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Full Name" name="name" value="{{ $consultant->name }}"/>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input type="email" class="form-control form-control-solid" placeholder="example@gmail.com" name="email" value="{{ $consultant->email }}" />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">Landline Number</span>
                        </label>
                        <div class="input-group mb-5">
                            <span class="input-group-text countrycode">{{ $consultant->country->dialing }}</span>
                            <input type="tel" name="landline" id="landline" value="{{ $consultant->landline }}" class="form-control mb-2 mb-md-0" placeholder="Landline Number ( optional )">
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Date of Birth</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid" name="dob" id="dob" value="{{ $consultant->dob }}"  placeholder="Date of Birth"  required/>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Gender</label>
                            <div class="d-flex align-items-center">
                                <label class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input"  name="gender" type="radio" value="0" id="male" {{($consultant->gender == 0)?'checked':''}}>
                                    <span class="form-check-label fw-bold">Male</span>
                                </label>
                                <label class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input"  name="gender" type="radio" value="1" id="female" {{($consultant->gender == 1)?'checked':''}}>
                                    <span class="form-check-label fw-bold">Female</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8">
                        <label class="required fs-6 fw-bold mb-2">Bio</label>
                        <textarea class="form-control" id="bio_data" placeholder="Bio Data" required name="bio_data" >{!! $consultant->bio_data !!}</textarea>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Year of Experience</span>
                            </label>
                            <input type="number" name="exp_year" id="exp_year"  class="form-control form-control-solid" value="{{ $consultant->exp_year }}" placeholder="Year of Experience" required/>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Language</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" multiple
                                data-placeholder="Select Language" name="language[]">
                                <option value="">Select Language</option>
                                @php
                                    $la = explode(',',$consultant->language);
                                @endphp
                                @foreach ($language as $language)
                                    <option {{ (\in_array($language->id, $la)?'selected':'')}} value="{{ $language->id }}">{{ $language->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8">
                        <label class="required fs-6 fw-bold mb-2">Register Address</label>
                        <textarea class="form-control" required placeholder="Register Address" required name="register_address" >{!! $consultant->register_address !!}</textarea>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Country</label>
                            <p class="text-dark-75 fw-bold fs-5 m-0">{{ $consultant->country->country_name ?? '' }}</p>
                        </div>
                        @if ($consultant->country->has_state == 1)
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">State</label>
                            <select class="form-select form-select-solid" data-control="select2" id="state" required data-hide-search="true" data-placeholder="Select State" name="state_id">
                                <option></option>
                                    @foreach($state as $state)
                                        <option value="{{$state->id}}" {{ ($consultant->state_id == $state->id)?'selected':'' }}>{{$state->state_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">City</label>
                            <select class="form-select form-select-solid" data-control="select2" id="city" required data-hide-search="true" data-placeholder="Select city" name="city_id">
                                <option></option>
                                    @foreach($city as $city)
                                        <option value="{{$city->id}}" {{ ($consultant->city_id == $city->id)?'selected':'' }}>{{$city->city_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Zipcode</label>
                            <input type="text" class="form-control form-control-solid" required placeholder="" name="zipcode" value="{{ $consultant->zipcode }}" />
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3 kt_modal_new_target_cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary kt_modal_new_target_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
