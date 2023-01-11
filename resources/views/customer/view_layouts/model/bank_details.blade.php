<div class="modal fade" id="bank_update" tabindex="-1" aria-hidden="true">
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
                <form id="bank_form" class="form" action="#">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Bank Details</h1>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Account Number</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Account Number" name="account_number" value="{{$consultant->account_number}}"/>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Account Name</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Account Name" name="account_name" value="{{$consultant->account_name}}" />
                    </div>
                    
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">IBAN Code / IFSC Code</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="IBAN Code / IFSC Code" name="ifsc_code" value="{{$consultant->ifsc_code}}" />
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Bank Name</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Bank Name" name="bank_name" value="{{$consultant->bank_name}}" />
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Branch</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Branch" name="branch" value="{{$consultant->branch}}" />
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Verified</span>
                        </label>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <!--begin::Input-->
                            <input class="form-check-input" name="bank_status" type="checkbox" value="1" {{ ($consultant->bank_status == 1)?'checked':''}}>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <span class="form-check-label fw-bold text-muted">Yes</span>
                            <!--end::Label-->
                        </label>
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
