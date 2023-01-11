<div class="" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-15">
            <!--begin::Title-->
            <h2 class="fw-bolder text-dark">Personal</h2>
            <!--end::Title-->
            <!--begin::Notice-->
            <div class="text-muted fw-bold fs-6">Personal info, please Fill</div>
            <!--end::Notice-->
        </div>
        <div class="fv-row mb-10">
            <label class="form-label required fs-6 mb-2" >Profile Image </label>
        </div>
         <div class="mb-10 fv-row">
            @include('components.imagecrop',['name'=>'picture'])
        </div>
<div class="form-group row">
        <div class="mb-10 fv-row col-md-6">
            <label class="required form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control mb-2 mb-md-0" placeholder="First & last Name" required/>
        </div>
        <div class="mb-10 fv-row col-md-6">
            <label class="required form-label">Email</label>
            <input type="email" name="email" id="email"  class="form-control mb-2 mb-md-0" placeholder="Email" required/>
        </div>
        <div class="mb-10 fv-row col-md-6">
            <label class="form-label">Landline Number</label>
            <div class="input-group mb-5">
                <span class="input-group-text countrycode"></span>
                <input type="tel" name="landline"  id="landline" class="form-control mb-2 mb-md-0" placeholder="Landline Number ( optional )"/>
            </div>
        </div>
        <div class="mb-10 fv-row col-md-6">
            <label class="required form-label fs-6 mb-2" >Date of Birth</label>
            <input class="form-control form-control-solid" name="dob" id="dob"  placeholder="Date of Birth"  required/>
        </div>
        <div class="mb-10 fv-row col-md-6"style="display:flex;align-items:center;">
            <label class="required form-label fs-6 mb-2 gen-txt" >Gender</label>
            <input type="hidden" name="gender" id="gender" value="0">
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" onchange="$('#gender').val(0)" name="tegender" type="radio" value="0" id="male" checked/>
                <label class="form-check-label" for="male">
                    Male
                </label>
            </div>
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input"  type="radio" name="tegender" onchange="$('#gender').val(1)" value="1" id="female"/>
                <label class="form-check-label" for="female">
                    Female
                </label>
            </div>
        </div>
        <div class="mb-10 fv-row col-md-6">
            <label class="required form-label fs-6 mb-2" >Bio</label>
            <div class="form-floating mb-7">
                <textarea class="form-control" id="bio_data" placeholder="Leave a comment here" name="bio_data" ></textarea>
                <label for="bio_data">Comments</label>
            </div>
        </div>
        <div class="mb-10 fv-row col-md-6">
            <label class="required form-label fs-6 mb-2" >Year of Experience</label>
            <input type="number" name="exp_year" id="exp_year"  class="form-control mb-2 mb-md-0" placeholder="Year of Experience" required/>
        </div>
        <div class="mb-10 fv-row col-md-6">
            <label class="required form-label fs-6 mb-2" >Select Language</label>
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Search option" data-allow-clear="true" name="language" id="language" multiple="multiple">
                @foreach ($Language as $language)
                    <option value="{{ $language->id }}">{{ $language->title }}</option>
                @endforeach
            </select>
        </div>
        </div>
    </div>
    <!--end::Wrapper-->
</div>
