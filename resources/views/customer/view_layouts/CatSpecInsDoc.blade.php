<div class="card mb-5 mb-xl-10">
    <div class="card-header cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Category,Insurance & Documents</h3>
        </div>
        <a href="#" class="btn btn-primary align-self-center"data-bs-toggle="modal" data-bs-target="#last_update">Edit</a>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Category</label>
                    <div class="col-lg-8">
                        <span data-update-Category class="fw-bolder fs-6 text-gray-800">{{ $consultant->parentcat()->name ?? 'Not Found' }}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Sub Category</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-subcaregory class="fw-bold text-gray-800 fs-6">{{ \implode(", ",$consultant->subcat()->pluck('name')->toArray()) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Specialized</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-spec class="fw-bold text-gray-800 fs-6">{{ \implode(", ",$consultant->getspec()->pluck('title')->toArray()) ?? 'No found' }}</span>
                    </div>
                </div>
                <div class="row mb-7" style="{{ (count($consultant->Insurance->pluck('comapany_name')->toArray()) < 1 )?'display:none':'' }}"  id="insurancespan">
                    <label class="col-lg-4 fw-bold text-muted">Insurance</label>
                    <div class="col-lg-8 fv-row">
                        <span data-update-insurance class="fw-bold text-gray-800 fs-6">{{ \implode(", ",$consultant->Insurance->pluck('comapany_name')->toArray()) ?? 'No insurance' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card-body">
                <div class="row mb-12">
                    <label class="col-lg-4 fw-bold text-muted">Document</label>
                    <div class="col-lg-8 fv-row">
                        <div class="row" id="appenddoc">
                            @foreach (explode(',',$consultant->proof) as $va)
                                @if(file_exists(public_path("storage/$va")))
                                    @if (pathinfo(asset("storage/$va"), PATHINFO_EXTENSION) == 'pdf')
                                    <div class="col-lg-4">
                                        <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="{{ asset("demo1/pdf.png") }}">
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('{{ asset("demo1/pdf.png") }}')"></div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="bi bi-eye-fill fs-2x text-white"></i>
                                            </div>
                                        </a>
                                    </div>
                                    @else
                                    <div class="col-lg-4">
                                        <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="{{ asset("storage/$va") }}">
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('{{ asset("storage/$va") }}')"></div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="bi bi-eye-fill fs-2x text-white"></i>
                                            </div>
                                        </a>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
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
                    <div class="fs-6 text-gray-700">Modifying/Changing categories, specialization can be done when reference doesnt mapped anywhere</div>
                    @if(!$consultant->preferre_slot)
                    <div class="fs-6 text-gray-700">Add time slot to create chedule</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

