<div class="" data-kt-stepper-element="content">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bolder text-dark">Firm / Individual</h2>
            <div class="text-muted fw-bold fs-6"></div>
        </div>
        <div class="fv-row mb-10">
            <div class="btn-group w-100 w-lg-50" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active" data-kt-button="true">
                    <input onchange="firm_type(1)" class="btn-check" type="radio" name="type" checked="checked" value="1"/>
                    Firm
                </label>
                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " data-kt-button="true">
                    <input onchange="firm_type(2)" class="btn-check" type="radio" name="type"  value="2"/>
                    Individual
                </label>
            </div>
        </div>
        <div class="fv-row mb-10" id="firmselectdiv">
            <label class=" form-label fs-6 mb-2" >Choose Firm</label>
            <select required class="form-select form-select-solid"  data-placeholder="Search option" data-allow-clear="true" name="firm_choose" id="firm_choose">
                <option></option>
            </select>
        </div>
        <div class="fv-row mb-10" hidden id="other">
            <input type="text" name="other" id="other"  class="form-control mb-2 mb-md-0" placeholder="Enter Firm Name"/>
        </div>
    </div>
    <!--end::Wrapper-->
</div>
