<x-base-layout>
    @section('styles')
    <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" />
    @endsection
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create Firm</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">User</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Firm</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('user.firms.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <form action="{{ route('user.firms.store') }}" method="post" id="formCreate">
                            @csrf
                            <div class="py-5">
                                <h4>About</h4>
                                <div class="rounded border p-10">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-4" >Company Name</label>
                                            <input type="text" name="comapany_name" class="form-control mb-4" placeholder="Company Name" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-4" >Legal Name</label>
                                            <input type="text" name="legal_name" class="form-control  mb-4" placeholder="Legal Name" required />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-4" >Do you have tax?</label>
                                            <div class="form-check form-check-custom form-check-solid mb-3">
                                                <input class="form-check-input " name="have_tax" type="radio" value="1" checked id="have_tax_Yes" />
                                                <label class="form-check-label me-3" for="have_tax_Yes">
                                                    <div class="fw-bolder text-gray-800">Yes</div>
                                                </label>

                                                <input class="form-check-input" name="have_tax" type="radio" value="0" id="have_tax_no" />
                                                <label class="form-check-label " for="have_tax_no">
                                                    <div class="fw-bolder text-gray-800">No</div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="taxation_number_div">
                                            <label class="required form-label fs-6 mb-4" >Taxation Number</label>
                                            <input type="number" id="taxation_number" name="taxation_number" class="form-control mb-4" placeholder="Taxation Number" required />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-4" >Company Registered On</label>
                                            <input class="form-control mb-4" name="register_on" placeholder="Company Registered On" id="kt_daterangepicker_3" required/>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="form-label fs-6 mb-4" >Logo</label>
                                        </div>
                                        <div class="col-md-3">
                                         @include('components.imagecrop',['name'=>'logo'])
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="required form-label fs-6 mb-2" >About Us</label>
                                            <textarea id="about_us" name="about_us" class="tox-target"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <h4>Address</h4>
                                <div class="rounded border p-10">
                                    <div class="rounded border p-10">
                                    @include('components.addressComponent',['register_address'=>'','page'=>'create','countrys'=>$countrys,'state'=>$state,'city'=>$city])
                                    </div>
                                </div>
                                @include('components.contact')
                                <h4>Category / Sub Category</h4>
                                <div class="rounded border p-10">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label class="required form-label fs-6 mb-4" >Category</label>
                                            <select class="form-select mb-4" name="categorie_id[]" id="categorie_id" data-control="select2" data-placeholder="Select Category" required>
                                                <option></option>
                                                @foreach ($category as $cat)
                                                    <option value='{{ $cat->id }}' {{ count($cat->child) > 0?'data-has_child':'' }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="subcatid">
                                        <div class="col-md-4">
                                            <label class="required form-label fs-6 mb-4" >Sub Category</label>
                                            <select class="form-select mb-4" name="categorie_id[]" id="sub_categorie_id" data-control="select2" multiple data-placeholder="Select Category" required>
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <h4>Bank Account Details</h4>
                                <div class="rounded border p-10">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-2" >Account Number</label>
                                            <input type="number" name="account_number" class="form-control  mb-4" placeholder="Account Number" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-2" >Account Name</label>
                                            <input type="text" name="account_name" class="form-control  mb-4" placeholder="Account Name" required />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-4" >IBAN Code / IFSC Code</label>
                                            <input type="text" name="ifsc_code" class="form-control mb-4 " placeholder="IBAN Code / IFSC Code" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-4" >Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control  mb-4 " placeholder="Bank Name" required />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-2" >Branch</label>
                                            <input type="text" name="branch" class="form-control  mb-4" placeholder="Branch" required />
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-6">
                                                <div class="form-check form-check-custom form-check-solid mb-5">
                                                    <input class="form-check-input me-3" name="bank_status" type="checkbox" value="1" id="bank_status" />
                                                    <label class="form-check-label" for="bank_status">
                                                        <div class="fw-bolder text-gray-800">verified</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <h4>Login Details</h4>
                                <div class="rounded border p-10">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-2" >Email ID</label>
                                            <input type="email" name="email" class="form-control  mb-4" placeholder="email" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="required form-label fs-6 mb-2" >User Name</label>
                                            <input type="text" name="user_name" class="form-control  mb-4" placeholder="User Name"  />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                <input class="form-check-input me-3" name="login_status" type="checkbox" value="1" id="login_status" />
                                                <label class="form-check-label" for="login_status">
                                                    <div class="fw-bolder text-gray-800">Status</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <h4>Gallary</h4>
                                <div class="rounded border p-10">
                                    <div class="fv-row mb-10">
                                        <label class="required form-label fs-6 mb-2" >Upload Image</label>
                                        <input type="file" name="gallery[]" id="image" multiple onchange="image_select()" class="form-control" placeholder="Image" required >
                                        <div class="card-body d-flex flex-wrap justify-content-start" id="container"></div>
                                    </div>
                                    <div class="fv-row mb-10">

                                    </div>
                                </div>
                                <div class="form-group row" style="float:right" >
                                    <div class="col-md-6">
                                        <button type="reset" id="formreset" class="btn btn-secondary btn-hover-rise me-5">Reset</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-hover-rise">Save</button>
                                    </div>
                                </div>
                                {{-- <h4>Working Hours</h4>
                                <div class="rounded border p-10">
                                    <div class="mb-10">
                                        <div class="kt_docs_repeater_nested">
                                            <div class="form-group">
                                                <div data-repeater-list="kt_docs_repeater_nested_outer">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Sunday</label>
                                                                <div class='form-check form-switch form-check-custom form-check-solid'>
                                                                    <input class='form-check-input checkboxOnOff'  name='day' type='checkbox'checked value='Sunday' />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="inner-repeater">
                                                                    <div data-repeater-list="kt_docs_repeater_nested_inner" class="mb-5">
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">From :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="sunday_from" class="form-control" placeholder="Enter contact number" required />
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">To :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="sunday_to" class="form-control" placeholder="Enter contact number" required />
                                                                                <button class="border border-secondary btn btn-icon btn-light-danger" data-repeater-delete type="button">
                                                                                    <i class="la la-trash-o fs-3"></i>
                                                                                </button>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                                                        <i class="la la-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <div class="kt_docs_repeater_nested">
                                            <div class="form-group">
                                                <div data-repeater-list="kt_docs_repeater_nested_outer">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Monday</label>
                                                                <div class='form-check form-switch form-check-custom form-check-solid'>
                                                                    <input class='form-check-input checkboxOnOff' name='day' type='checkbox' checked value='Monday' />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="inner-repeater">
                                                                    <div data-repeater-list="kt_docs_repeater_nested_inner" class="mb-5">
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">From :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="monday_from" class="form-control" placeholder="Enter contact number" required />
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">To :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="monday_to" class="form-control" placeholder="Enter contact number"  required/>
                                                                                <button class="border border-secondary btn btn-icon btn-light-danger" data-repeater-delete type="button">
                                                                                    <i class="la la-trash-o fs-3"></i>
                                                                                </button>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                                                        <i class="la la-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <div class="kt_docs_repeater_nested">
                                            <div class="form-group">
                                                <div data-repeater-list="kt_docs_repeater_nested_outer">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Tuesday</label>
                                                                <div class='form-check form-switch form-check-custom form-check-solid'>
                                                                    <input class='form-check-input checkboxOnOff' name='day' type='checkbox' checked value='Tuesday' />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="inner-repeater">
                                                                    <div data-repeater-list="kt_docs_repeater_nested_inner" class="mb-5">
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">From :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="tuesday_from" class="form-control" placeholder="Enter contact number"  required/>
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">To :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="tuesday_to" class="form-control" placeholder="Enter contact number" required />
                                                                                <button class="border border-secondary btn btn-icon btn-light-danger" data-repeater-delete type="button">
                                                                                    <i class="la la-trash-o fs-3"></i>
                                                                                </button>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                                                        <i class="la la-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <div class="kt_docs_repeater_nested">
                                            <div class="form-group">
                                                <div data-repeater-list="kt_docs_repeater_nested_outer">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Wednesday</label>
                                                                <div class='form-check form-switch form-check-custom form-check-solid'>
                                                                    <input class='form-check-input checkboxOnOff' name='day' type='checkbox' checked value='Wednesday' />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="inner-repeater">
                                                                    <div data-repeater-list="kt_docs_repeater_nested_inner" class="mb-5">
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">From :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="wednesday_from" class="form-control" placeholder="Enter contact number" required />
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">To :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="wednesday_to" class="form-control" placeholder="Enter contact number" required />
                                                                                <button class="border border-secondary btn btn-icon btn-light-danger" data-repeater-delete type="button">
                                                                                    <i class="la la-trash-o fs-3"></i>
                                                                                </button>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                                                        <i class="la la-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <div class="kt_docs_repeater_nested">
                                            <div class="form-group">
                                                <div data-repeater-list="kt_docs_repeater_nested_outer">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Thursday</label>
                                                                <div class='form-check form-switch form-check-custom form-check-solid'>
                                                                    <input class='form-check-input checkboxOnOff' name='day' type='checkbox' checked value='Thursday' />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="inner-repeater">
                                                                    <div data-repeater-list="kt_docs_repeater_nested_inner" class="mb-5">
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">From :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="thursday_from" class="form-control" placeholder="Enter contact number" required />
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">To :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="thursday_to" class="form-control" placeholder="Enter contact number" required/>
                                                                                <button class="border border-secondary btn btn-icon btn-light-danger" data-repeater-delete type="button">
                                                                                    <i class="la la-trash-o fs-3"></i>
                                                                                </button>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                                                        <i class="la la-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <div class="kt_docs_repeater_nested">
                                            <div class="form-group">
                                                <div data-repeater-list="kt_docs_repeater_nested_outer">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Friday</label>
                                                                <div class='form-check form-switch form-check-custom form-check-solid'>
                                                                    <input class='form-check-input checkboxOnOff' name='day' type='checkbox' checked value='Friday' />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="inner-repeater">
                                                                    <div data-repeater-list="kt_docs_repeater_nested_inner" class="mb-5">
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">From :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="friday_from" class="form-control" placeholder="Enter contact number" required />
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">To :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="friday_to" class="form-control" placeholder="Enter contact number" required />
                                                                                <button class="border border-secondary btn btn-icon btn-light-danger" data-repeater-delete type="button">
                                                                                    <i class="la la-trash-o fs-3"></i>
                                                                                </button>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                                                        <i class="la la-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <div class="kt_docs_repeater_nested">
                                            <div class="form-group">
                                                <div data-repeater-list="kt_docs_repeater_nested_outer">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Saturday</label>
                                                                 <div class='form-check form-switch form-check-custom form-check-solid'>
                                                                <input class='form-check-input checkboxOnOff' name='day' type='checkbox' checked value='Saturday' />
                                                            </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="inner-repeater">
                                                                    <div data-repeater-list="kt_docs_repeater_nested_inner" class="mb-5">
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">From :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="saturday_from" class="form-control" placeholder="Enter contact number" required />
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            <label class="form-label">To :</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="time" name="saturday_to" class="form-control" placeholder="Enter contact number" required />
                                                                                <button class="border border-secondary btn btn-icon btn-light-danger" data-repeater-delete type="button">
                                                                                    <i class="la la-trash-o fs-3"></i>
                                                                                </button>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                                                        <i class="la la-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </div>

                                    <div class="form-group row" style="float:right" >
                                        <div class="col-md-6">
                                            <button type="reset" id="formreset" class="btn btn-secondary btn-hover-rise me-5 ">Reset</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-hover-rise">Save</button>
                                        </div>
                                    </div>
                                </div> --}}
                            <!--</div>-->
                        </form>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Products-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    @section('scripts')
    <style>
        <style>
                .image_container {
            height: 120px;
            width: 200px;
            border-radius: 6px;
            overflow: hidden;
            margin: 10px;
        }
        .image_container img {
            height: 120px;
            width: 200px;

            object-fit: cover;
        }
        .image_container span {
            top: -6px;
            right: 8px;
            color: red;
            font-size: 28px;
            font-weight: normal;
            cursor: pointer;
        }
    </style>

    <script>
        var images = [];
        function image_select() {
          var image = document.getElementById('image').files;
          for (i = 0; i < image.length; i++) {
            images.push({
                "name" : image[i].name,
                "url" : URL.createObjectURL(image[i]),
                "file" : image[i],
            })
          }
          document.getElementById('container').innerHTML = image_show();
        }

        function image_show() {
          var image = "";
          images.forEach((i) => {
             image += `<div class="image_container d-flex justify-content-center position-relative">
                        <img src="`+ i.url +`"  alt="Image">
                        <span class="position-absolute" onclick="delete_image(`+ images.indexOf(i) +`)">&times;</span>
                    </div>`;
          })
          return image;
        }

        function delete_image(e) {
            images.splice(e, 1);
            document.getElementById('container').innerHTML = image_show();

            const dt = new DataTransfer()
            const input = document.getElementById('image')
            const { files } = input

            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (e !== i)
                dt.items.add(file);
            }

            input.files = dt.files;
            console.log(document.getElementById('image').files);
        }
    </script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/cropper/cropper.bundle.js')}}'></script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/formrepeater/formrepeater.bundle.js')}}'></script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/jstree/jstree.bundle.js')}}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
     back = "{{ route('user.firms.index') }}"
    const have_tax_Yes = document.querySelectorAll('[name="have_tax"]')
    const taxation_number_div = document.getElementById('taxation_number_div')
    const taxation_number = document.getElementById('taxation_number')
    const categorie_id = document.getElementById('categorie_id')

    have_tax_Yes.forEach(element => {
        element.addEventListener('change',have_tax_Yes_fun)
    })

    $(".checkboxOnOff").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).parent().parent().parent().find('[data-repeater-create]')[0].click()

        }
        else {
            let arr = $(this).parent().parent().parent().find('[data-repeater-delete]');
            $.each( arr, function( key, value ) {
                value.click();
            });

        }
    });

    var startFlatpickr = flatpickr($("#kt_daterangepicker_3"), {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

    $('.kt_docs_repeater_nested').repeater({
        repeaters: [{
            selector: '.inner-repeater',
            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        }],

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    var options = {selector: "#about_us"};

    if (KTApp.isDarkMode()) {
        options["skin"] = "oxide-dark";
        options["content_css"] = "dark";
    }

    tinymce.init(options);


    function have_tax_Yes_fun(event){
        if(event.target.value == 1){
            taxation_number_div.removeAttribute('hidden')
            taxation_number.setAttribute('required',true)
        }else{
            taxation_number_div.setAttribute('hidden',true)
            taxation_number.removeAttribute('required')
            taxation_number.value = ''
        }
    }

    $("#categorie_id").on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            url:"{{route('help.getchildcategory')}}",
            method:"POST",
            data:{id:data.id,"_token": "{{ csrf_token() }}",},
            success:function(data){
                var option = `<option>Select Category</option>`
                if(data.child.length > 0){
                    data.child.forEach((e)=>{
                        option += '<option value='+e.id+'>'+e.name+'</option>';
                    })
                    $('#subcatid').show(100);
                    $('#sub_categorie_id').prop('required',true);
                }else{
                    $('#sub_categorie_id').prop('required',false);
                    $('#subcatid').hide(100);
                }
                $('#sub_categorie_id').html(option).trigger("change");
            }
        })
    });
    </script>
    @endsection
</x-base-layout>
