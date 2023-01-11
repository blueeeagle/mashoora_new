<div class="" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-12">
            <!--begin::Title-->
            <h2 class="fw-bolder text-dark">Address</h2>
            <!--end::Title-->
            <!--begin::Notice-->
            <div class="text-muted fw-bold fs-6">Add Address Information</div>
            <!--end::Notice-->
        </div>
        <!--end::Heading-->
        <div class="fv-row mb-10">
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="required form-label fs-6 mb-4" >Registered Address</label>
                    <textarea id="register_address" name="register_address" class="tox-target"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="required form-label fs-6 mb-4" >Country</label>
                    <select class="form-select mb-4" id="country_id" name="country_id" data-control="select2" data-placeholder="Select an Country" required>
                        <option></option>
                        @foreach($countrys as $country)
                            <option value="{{$country->id}}" data-has_state='{{ $country->has_state }}'>{{$country->country_name}}</option>
                        @endforeach
                    </select>

                    <div id="stateDiv">
                        <label class="required form-label fs-6 mb-4" >State</label>
                        <select class="form-select mb-4" name="state_id" id="state_id" data-control="select2" data-placeholder="Select an State" required>
                            <option></option>
                        </select>
                    </div>

                    <label class="required form-label fs-6 mb-4" >City</label>
                    <select class="form-select mb-4" name="city_id" id="city_id" data-control="select2" data-placeholder="Select an City" required>
                        <option></option>
                    </select>


                    <label class="required form-label fs-6 mb-4" >Zip Code</label>
                    <input type="text" name="zipcode" class="form-control mb-4" placeholder="Zip Code" required />

                    @if(isset($phone))
                        <label class="required form-label fs-6 mb-4" >Mobile no</label>
                        <input type="text" name="phone" id="phone" class="form-control mb-4" placeholder="Mobile no" required/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Wrapper-->
</div>
