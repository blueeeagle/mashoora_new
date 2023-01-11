<div class="modal fade" id="last_update" tabindex="-1" aria-hidden="true">
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
                <form id="last_update_form" class="form" action="#">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Update</h1>
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-bold">
                                    <h4 class="text-gray-900 fw-bolder">Warning</h4>
                                    <div class="fs-6 text-gray-700">If you change Main Category, It reflect in all category</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Category</span>
                        </label>
                        <select required class="form-select form-select-solid" id="category" data-control="select2" data-hide-search="true" data-placeholder="select Category" name="categorie_id[]">
                            <option value="">select Category</option>
                            @php
                                $cate = \explode(',',$consultant->categorie_id);
                            @endphp
                            @foreach ($Category as $cat)
                                <option value="{{ $cat->id }}" {{ (in_array($cat->id,$cate))?'selected':'' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-column mb-8 fv-row" id="subcategory_div" style="{{ (count($subcaregory) == 0)?'display:none':'' }}">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Sub Category</span>
                        </label>
                        <select {{ (count($subcaregory) == 0)?'required':'' }} class="form-select form-select-solid" data-control="select2" data-hide-search="true" id="sub_category" multiple data-placeholder="Sub Category" name="categorie_id[]">
                                <option value="">Sub Category</option>
                                @foreach ($subcaregory as $cat)
                                    <option value="{{ $cat->id }}" {{ (in_array($cat->id,$cate))?'selected':'' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Specialization</span>
                        </label>
                        <div id="specappend">
                            @php
                            $specdata = explode(',',$consultant->specialized);
                            @endphp
                            @foreach ($Consultantcategory as $key => $spec)
                                <span class="text-dark fw-bolder d-block fs-3">{{ $key }}</span>
                                @foreach ($spec as $key2 => $item)
                                    <span class="text-dark fw-bolder d-block fs-3" style="margin-left: 30px;">{{ $key2 }}</span>
                                    @foreach ($item as $key3 => $item2)
                                        <span class="text-muted fw-bold fs-6" style="margin-left: 60px;">
                                            <input class="form-check-input" type="checkbox" name="specialization_id[]" {{ (in_array($item2->id,$specdata))?'checked':'' }} value="{{ $item2->id }}" id="flexCheckChecked{{ $key3 }}">
                                            <label class="form-check-label" for="flexCheckChecked{{ $key3 }}">{{ $item2->title }}</label>
                                        </span>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div id="insurancediv" style="{{ ($isinsurance == 0)?'display:none':'' }}">
                        @php
                            $cate = \explode(',',$consultant->insurance_id);
                        @endphp
                        <div class="d-flex flex-stack mb-8">
                        <div class="me-5">
                            <label class="fs-6 fw-bold"> Insurance Yes or No</label>
                        </div>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" {{ (count($cate) > 0)?'checked':''}} onchange="Insurance_div_function()">
                        <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                        </div>
                        <div class="flex-column mb-8 fv-row" id="insetance_select" style="{{ (count($cate) < 1)?'display:none':'' }}">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Insurance</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" multiple data-placeholder="Select Insurance" id="insutance" name="insurance_id[]">
                                @foreach ($insurance as $cat)
                                    <option value="{{ $cat->id }}" {{ (in_array($cat->id,$cate))?'selected':'' }}>{{ $cat->comapany_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">
                                <a href="#" class="downloadAll">Download Proof</a>
                            </span>
                        </label>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row" id="proof_clone">

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
