<div class="card mb-5 mb-xl-10">
    <div class="card-header cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Profile Details</h3>
        </div>
        <a href="#" class="btn btn-primary align-self-center"data-bs-toggle="modal" data-bs-target="#personal_detail_update">Edit Profile Details</a>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Name</label>
                    <div class="col-lg-8">
                        <span data-update-name class="fw-bolder fs-6 text-gray-800">{{ $consultant->name }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Email</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-email class="fw-bold text-gray-800 fs-6">{{ $consultant->email }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Date of Birth</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-dob class="fw-bold text-gray-800 fs-6">{{ $consultant->dob }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Landline Number
                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Landline Number is optional" aria-label="Landline Number is optional"></i></label>
                    <div class="col-lg-8 d-flex align-items-center">
                        <span data-update-landline class="fw-bolder fs-6 text-gray-800 me-2">{{ $consultant->landline }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Gender</label>
                    <div class="col-lg-8">
                        <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary" data-update-gender >{{ ($consultant->gender == 0)?'Male':'Femal' }}</a>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Year of Experience</label>
                    <div class="col-lg-8">
                        <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary" data-update-exp_year >{{ $consultant->exp_year }} Years</a>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Language</label>
                    <div class="col-lg-8">
                        <span data-update-language class="fw-bolder fs-6 text-gray-800">{{ \implode(", ",$consultant->getLanguage()->pluck('title')->toArray()) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Registered Address</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-register_address class="fw-bold text-gray-800 fs-6">{!! $consultant->register_address !!}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Country</label>
                    <div class="col-lg-8">
                        <span data-update-country_name class="fw-bolder fs-6 text-gray-800">{{ $consultant->country->country_name ?? '' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">State</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-state_name class="fw-bold text-gray-800 fs-6">{{ $consultant->state->state_name ?? '' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">City</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-city_name class="fw-bold text-gray-800 fs-6">{{ $consultant->city->city_name ?? '' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Zipcode</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-zipcode class="fw-bold text-gray-800 fs-6">{{ $consultant->zipcode }}</span>
                    </div>
                </div>
                <div class="row mb-7" id="firmorindugial" style="{{ (!$consultant->firm)?'display:none':'' }}">
                    <label class="col-lg-4 fw-bold text-muted">Firm</label>
                    <div class="col-lg-8 fv-row">
                        @if($consultant->firm)
                            @if($consultant->firm->is_new == 1)
                            <a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">New</a>
                            @endif
                        @endif
                        <span data-update-firm class="fw-bold text-gray-800 fs-6">{{ $consultant->firm->comapany_name ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card-body pt-1">
                <div class="row mb-7">
                    <label class="col-lg-1 fw-bold text-muted">Bio</label>
                    <div class="col-lg-11 fv-row">
                        <span data-update-bio_data class="fw-bold text-gray-800 fs-6">{{ $consultant->bio_data }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
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
                    <div class="fs-6 text-gray-700">County information Can't edit</div>
                </div>
            </div>
        </div>
    </div>
</div>

