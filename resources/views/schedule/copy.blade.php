<div class="modal fade" id="copy_model" tabindex="-1" aria-hidden="true">
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
                <form id="copy_form" class="form" action="#">
                    @csrf
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Copy schedule</h1>
                    </div>
                    <div class="row">
                        <div class="d-flex flex-column mb-6 col-6">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">From Date</span>
                            </label>
                            <input type="text" id="pop_from" class="form-control form-control-solid" placeholder="From Date" name="from_date" required value=""/>
                        </div>

                        <div class="d-flex flex-column mb-6 col-6">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">To Date</span>
                            </label>
                            <input type="text" id="pop_to" class="form-control form-control-solid" placeholder="To Date" name="to_date" required value="" />
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
