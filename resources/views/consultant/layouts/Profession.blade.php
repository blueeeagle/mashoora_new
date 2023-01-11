<div class="" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100" >
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-15">
            <!--begin::Title-->
            <h2 class="fw-bolder text-dark">Profession</h2>
            <!--end::Title-->
            <!--begin::Notice-->
            <div class="text-muted fw-bold fs-6"></div>
            <!--end::Notice-->
        </div>
        <div class="fv-row mb-10">
            <input type="hidden" name="categorie_id" id="categorie_id">
            <div id="kt_docs_jstree_checkable"></div>
        </div>
    </div>
    <!--end::Wrapper-->
    {{-- Category --}}
    <div class="w-100" hidden>
        <div class="fv-row mb-10" >
            <h2 class="fw-bolder text-dark">Category</h2>
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Search option" data-allow-clear="true" name="category_id" id="category_id" multiple="multiple">
                @foreach ($Categorys as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- Sub Category --}}
        <div class="fv-row mb-10" >
            <h2 class="fw-bolder text-dark">Sub Category</h2>
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Search option" data-allow-clear="true" name="sub_category_id" id="sub_category_id" multiple="multiple">

            </select>
        </div>
    </div>
</div>
