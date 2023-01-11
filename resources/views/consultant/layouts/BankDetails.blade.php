<div class="" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-8 pb-lg-10">
            <!--begin::Title-->
            <h2 class="fw-bolder text-dark">Bank Details</h2>
        </div>
        <div class="fv-row mb-10">
            <!--begin::Input group-->
            <div class="d-flex flex-stack w-lg-50">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-bold form-label">Do you have Bank Account details ? </label>
                    <div class="fs-7 fw-bold text-muted">Save Bank Details for Pay In/Out ?</div>
                </div>
                <!--end::Label-->

                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" id="bankshowoff" checked="checked"/>
                    <span class="form-check-label fw-bold text-muted">
                        No / Yes
                    </span>
                </label>
                <!--end::Switch-->
            </div>
            <!--end::Input group-->
        </div>
        <div id="bankdivshowonoff">
            <div class="fv-row mb-10">
                <label class="required form-label fs-6 mb-2" >Account Number</label>
                <input type="number" name="account_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Account Number" required />
            </div>
            <div class="fv-row mb-10">
                <label class="required form-label fs-6 mb-2" >Account Name</label>
                <input type="text" name="account_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Account Name" required />
            </div>
            <div class="fv-row mb-10">
                <label class="required form-label fs-6 mb-2" >IBAN Code / IFSC Code</label>
                <input type="text" name="ifsc_code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="IBAN Code / IFSC Code" required />
            </div>
            <div class="fv-row mb-10">
                <label class="required form-label fs-6 mb-2" >Bank Name</label>
                <input type="text" name="bank_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Bank Name" required />
            </div>
            <div class="fv-row mb-10">
                <label class="required form-label fs-6 mb-2" >Branch</label>
                <input type="text" name="branch" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Branch" required />
            </div>
            <div class="fv-row mb-10">
                <div class="form-check form-check-custom form-check-solid mb-5">
                    <input class="form-check-input me-3" name="bank_status" type="checkbox" value="1" id="bank_status" />
                    <label class="form-check-label" for="bank_status">
                        <div class="fw-bolder text-gray-800">verified</div>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!--end::Wrapper-->
</div>
