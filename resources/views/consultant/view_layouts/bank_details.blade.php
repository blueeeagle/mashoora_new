<div class="card mb-5 mb-xl-10">
    <div class="card-header cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Bank Details</h3>
            @if($consultant->bank_status == 1)
                <a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">Verified</a>
            @else
                <a href="#" class="btn btn-sm btn-light-danger fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">Not Verified</a>
            @endif
        </div>
        <a href="#" class="btn btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#bank_update" >Edit</a>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Account Number</label>
                    <div class="col-lg-8">
                        <span data-update-account_number class="fw-bolder fs-6 text-gray-800">{{ ($consultant->account_number)?$consultant->account_number:'--' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Account Name</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-account_name class="fw-bold text-gray-800 fs-6">{{ ($consultant->account_name)?$consultant->account_name:'--' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">IBAN Code / IFSC Code</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-ifsc_code class="fw-bold text-gray-800 fs-6">{{ ($consultant->ifsc_code)?$consultant->ifsc_code:'--' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Bank Name</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-bank_name class="fw-bold text-gray-800 fs-6">{{ ($consultant->bank_name)?$consultant->bank_name :'--' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Branch</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-branch class="fw-bold text-gray-800 fs-6">{{ ($consultant->branch)?$consultant->branch:'--' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Verified</label>
                    <div class="col-lg-8 fv-row">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <!--begin::Input-->
                            <input class="form-check-input" name="bank_status" type="checkbox" data-update-verified  disabled value="1" {{ ($consultant->bank_status == 1)?'checked':''}}>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <span class="form-check-label fw-bold text-muted">Yes</span>
                            <!--end::Label-->
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-1">
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                </svg>
            </span>
            <div class="d-flex flex-stack flex-grow-1">
                <div class="fw-bold">
                    <h4 class="text-gray-900 fw-bolder">We need your attention!</h4>
                    <div class="fs-6 text-gray-700">Account verification is mandatory for Payin/Payout</div>
                    @if(!$consultant->preferre_slot)
                    <div class="fs-6 text-gray-700">Add time slot to create chedule</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

