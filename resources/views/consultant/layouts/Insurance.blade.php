<div class="" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-8 pb-lg-10">
            <!--begin::Title-->
            <h2 class="fw-bolder text-dark">Insurance</h2>
        </div>
        <div class="fv-row mb-10">
            <div class="btn-group w-100 w-lg-50" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active" data-kt-button="true">
                    <input onclick="Insurance(1)" class="btn-check" type="radio" checked="checked" value="1"/>
                    Yes
                </label>
                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " data-kt-button="true">
                    <input onclick="Insurance(2)" class="btn-check" type="radio"  value="2"/>
                    No
                </label>
            </div>
        </div>
        <div class="mb-10 fv-row" id="Insurancediv">
            <label class="form-label fs-6 mb-2" >Select Insurance</label>
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="option" data-allow-clear="true" name="insurance_id" id="insurance_id" multiple="multiple">
                <option></option>
            </select>
        </div>
    </div>
    <!--end::Wrapper-->
</div>
