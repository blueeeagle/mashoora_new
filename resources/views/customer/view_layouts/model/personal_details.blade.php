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
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Name</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Full Name" name="name" value="{{ $customer->name }}"/>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input type="email" class="form-control form-control-solid" placeholder="example@gmail.com" name="email" value="{{ $customer->email }}" />
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Date of Birth</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid" name="dob" id="dob" value="{{ $customer->dob }}"  placeholder="Date of Birth"  required/>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Gender</label>
                            <div class="d-flex align-items-center">
                                <label class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input"  name="gender" type="radio" value="0" id="male" {{($customer->gender == 0)?'checked':''}}>
                                    <span class="form-check-label fw-bold">Male</span>
                                </label>
                                <label class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input"  name="gender" type="radio" value="1" id="female" {{($customer->gender == 1)?'checked':''}}>
                                    <span class="form-check-label fw-bold">Female</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-column mb-8">
                        <label class="required fs-6 fw-bold mb-2">Register Address</label>
                        <textarea class="form-control" required placeholder="Register Address" required name="register_address" >{!! $consultant->register_address !!}</textarea>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Country</label>
                            <p class="text-dark-75 fw-bold fs-5 m-0">{{ $customer->country->country_name ?? '' }}</p>
                        </div>                       
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">State</label>
                            <select class="form-select form-select-solid" data-control="select2" id="state" required data-hide-search="true" data-placeholder="Select State" name="state_id">
                                <option></option>
                                    @foreach($state as $state)
                                        <option value="{{$state->id}}" {{ ($customer->state_id == $state->id)?'selected':'' }}>{{$state->state_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">City</label>
                            <select class="form-select form-select-solid" data-control="select2" id="city" required data-hide-search="true" data-placeholder="Select city" name="city_id">
                                <option></option>
                                    @foreach($city as $city)
                                        <option value="{{$city->id}}" {{ ($customer->city_id == $city->id)?'selected':'' }}>{{$city->city_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Zipcode</label>
                            <input type="text" class="form-control form-control-solid" required placeholder="" name="zipcode" value="{{ $customer->zipcode }}" />
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
