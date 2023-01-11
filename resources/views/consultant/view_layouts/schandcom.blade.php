<div class="card mb-5 mb-xl-10">
    <div class="card-header cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Schedule and Commission Fee</h3>
        </div>
        <a href="#" class="btn btn-primary align-self-center"data-bs-toggle="modal" data-bs-target="#Commission_update">Edit</a>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Slot Timing</label>
                    <div class="col-lg-8">
                        <span data-update-preferre_slot class="fw-bolder fs-6 text-gray-800">{{ ($consultant->preferre_slot)?"$consultant->preferre_slot Min":'No Time Slot' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Video</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-Video class="fw-bold text-gray-800 fs-6">{{ ($consultant->video == 1)?$consultant->country->currency->currencycode.' '.$consultant->video_amount.' / '.$companeySetting->country->currency->currencycode.' '.round(($consultant->video_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2):'Not Activated' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Text</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-Text class="fw-bold text-gray-800 fs-6">{{ ($consultant->text == 1)?$consultant->country->currency->currencycode.' '. $consultant->text_amount.' / '.$companeySetting->country->currency->currencycode.' '.round(($consultant->text_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2) :'Not Activated' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Direct Visit</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-Direact class="fw-bold text-gray-800 fs-6">{{ ($consultant->direct == 1)?$consultant->country->currency->currencycode .' '.$consultant->direct_amount.' / '.$companeySetting->country->currency->currencycode.' '.round(($consultant->direct_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2) :'Not Activated' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Voice</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-Voice class="fw-bold text-gray-800 fs-6">{{ ($consultant->voice == 1)?$consultant->country->currency->currencycode .' '.$consultant->voice_amount.' / '.$companeySetting->country->currency->currencycode.' '.round(($consultant->voice_amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2) :'Not Activated' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Commission<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Consultant Fee" aria-label="Consultant Fee"></i></label>
                    <div class="col-lg-8 d-flex align-items-center">
                        <span data-update-Consultant_Fee class="fw-bold text-gray-800 fs-6">{{ ($consultant->com_con_amount != null)?$consultant->convertcomTemp($companeySetting,$consultant->com_con_amount,$consultant->com_con_type,$consultant):'Consultant Fee Not Added' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Offers</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-Offers class="fw-bold text-gray-800 fs-6">{{ ($consultant->com_off_amount != null)?$consultant->convertcomTemp($companeySetting,$consultant->com_off_amount,$consultant->com_off_type,$consultant):'Offers Fee Not Added' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Payout<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Minimum withdrawal amount" aria-label="Minimum withdrawal amount "></i></label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-Payout class="fw-bold text-gray-800 fs-6">{{ ($consultant->com_pay_amount != null)?$consultant->convertcomTemp($companeySetting,$consultant->com_pay_amount,$consultant->com_pay_type,$consultant):'Payout Fee Not Added' }}</span>
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
                    <div class="fs-6 text-gray-700">Modifying details can be done when reference not mapped against booking, schedule etc</div>
                    @if(!$consultant->preferre_slot)
                    <div class="fs-6 text-gray-700">Add time slot to create schedule</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

