<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Admin</h1>
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
                        <li class="breadcrumb-item text-muted">Admin</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <form action="{{ route('admin.user.update',$user->id) }}" method="post" id="formEdit">
                            @csrf
                            <div class="py-5">

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="required form-label fs-6 mb-4" >First Name</label>
                                        <input type="text" name="first_name" class="form-control mb-4 " placeholder="First Name" value="{{$user->first_name}}" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fs-6 mb-4" >Last Name</label> 
                                        <input type="text" name="last_name" class="form-control mb-4 " value="{{$user->last_name}}" placeholder="Last Name" required />

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="required form-label fs-6 mb-4" >Email Id / Username</label>
                                        <input type="text" name="email" class="form-control form-control-solid mb-4" placeholder="Email" value="{{$user->email}}"required />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fs-6 mb-4" >Profile Picture </label>
                                        <div class="col-md-6">
                                            @include('components.imagecrop',['name'=>'picture','imgsrc'=>$user->picture])
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="required form-label fs-6 mb-4" >Two Way Aunthentication</label> <br>
                                        <input type="checkbox" class="form-check-input mb-4 " name="is_two_way_auth" @if($user->is_two_way_auth==2) checked @endif value="2">
                                    </div>
                                </div>

                                

                                <h4>Address</h4>
                                @include('components.addressComponent',['country_id'=>$user->country_id,'state_id'=>$user->state_id,'phone'=>$user->phone,
                                'city_id'=>$user->city_id,'zipcode'=>$user->zipcode,'register_address'=>$user->register_address,'page'=>'Edit','countrys'=>$countrys,'state'=>$state,'city'=>$city])
                                <br>

                                <div class="rounded border p-10">
                                    <div class="form-group row">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <th></th>
                                                        <th><input class="form-check-input" id="create_check" type="checkbox"> Create</th>
                                                        <th><input class="form-check-input" id="edit_check" type="checkbox"> Edit </th>
                                                        <th><input class="form-check-input" id="view_check" type="checkbox"> View </th>
                                                        <th><input class="form-check-input" id="delete_check" type="checkbox"> Delete </th>
                                                        <th hidden><input class="form-check-input" id="download_check" type="checkbox"> Download </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        
                                                        <td><input class="form-check-input" type="checkbox" id="Admin" name="permession[]" {{ (in_array('Admin',explode(',',$user->permission))) ? 'checked':''}} value="Admin" /> Admin</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Admin_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Admin_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Admin_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Admin_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Admin_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Admin_View" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Admin_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Admin_delete" /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Admin_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Admin_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Currency" type="checkbox" value="Currency" {{ (in_array('Currency',explode(',',$user->permission))) ? 'checked':''}}/> Currency</td>
                                                        <td colspan="2"></td>
                                                        <td><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Currency_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Currency_View" /></td>
                                                        <td></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Currency_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Currency_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" type="checkbox" id="Country" {{ (in_array('Country',explode(',',$user->permission))) ? 'checked':''}} value="Country" name="permession[]"/> Country</td>
                                                        <td colspan="2"></td>
                                                        <td><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Country_View',explode(',',$user->permission))) ? 'checked':''}}  value="Country_View" type="checkbox" /></td>
                                                        <td></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Country_Download',explode(',',$user->permission))) ? 'checked':''}}  value="Country_Download" type="checkbox" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        
                                                        <td><input class="form-check-input" name="permession[]" id="State" type="checkbox"  {{ (in_array('State',explode(',',$user->permission))) ? 'checked':''}} value="State"/> State</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('State_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="State_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('State_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="State_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('State_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="State_View" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('State_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="State_delete" /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('State_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="State_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="City" type="checkbox" {{ (in_array('City',explode(',',$user->permission))) ? 'checked':''}} value="City"/> City</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('City_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="City_Create"/></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('City_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="City_Edit"/></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('City_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="City_View" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('City_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="City_delete" /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]"  data-head data-download {{ (in_array('City_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="City_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Document" type="checkbox" {{ (in_array('Document',explode(',',$user->permission))) ? 'checked':''}} value="Document"/> Document</td>
                                                        <td ><input class="form-check-input" name="permession[]"  data-head data-create {{ (in_array('Document_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Document_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Document_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Document_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Document_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Document_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Document_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Document_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]"  data-head data-download {{ (in_array('Document_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Document_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]"  id="Language" {{ (in_array('Language',explode(',',$user->permission))) ? 'checked':''}} value="Language" type="checkbox" /> Language</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Language_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Language_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Language_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Language_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Language_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Language_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Language_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Language_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Language_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Language_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Tax" {{ (in_array('Tax',explode(',',$user->permission))) ? 'checked':''}} value="Tax" type="checkbox" /> Tax</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Tax_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Tax_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Tax_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Tax_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Tax_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Tax_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Tax_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Tax_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]"  data-head data-download {{ (in_array('Tax_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Tax_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Category" {{ (in_array('Category',explode(',',$user->permission))) ? 'checked':''}} value="Category" type="checkbox" /> Category</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Categoty_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Categoty_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Categoty_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Categoty_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Categoty_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Categoty_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Categoty_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Categoty_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Categoty_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Categoty_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Specialization" {{ (in_array('Specialization',explode(',',$user->permission))) ? 'checked':''}} value="Specialization" type="checkbox" /> Specialization</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Specialization_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Specialization_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Specialization_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Specialization_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Specialization_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Specialization_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Specialization_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Specialization_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Specialization_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Specialization_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Company_Settings" {{ (in_array('Company_Settings',explode(',',$user->permission))) ? 'checked':''}} value="Company_Settings" type="checkbox" /> Company Settings</td>
                                                        <td colspan="2"></td>
                                                        <td><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Company_Settings_View',explode(',',$user->permission))) ? 'checked':''}}  type="checkbox" value="Company_Settings_View" /></td>
                                                        <td colspan="1"></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Company_Settings_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Company_Settings_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Firm" {{ (in_array('Firm',explode(',',$user->permission))) ? 'checked':''}} value="Firm" type="checkbox" /> Firm</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Firm_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Firm_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Firm_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Firm_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Firm_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Firm_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Firm_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Firm_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Firm_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Firm_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Insurance" {{ (in_array('Insurance',explode(',',$user->permission))) ? 'checked':''}} value="Insurance" type="checkbox" /> Insurance</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Insurance_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Insurance_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Insurance_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Insurance_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Insurance_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Insurance_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Insurance_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Insurance_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]"  data-head data-download {{ (in_array('Insurance_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Insurance_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]"  id="Customer" {{ (in_array('Customer',explode(',',$user->permission))) ? 'checked':''}} value="Customer" type="checkbox" /> Customer</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Customer_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Customer_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Customer_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Customer_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Customer_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Customer_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Customer_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Customer_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]"  data-head data-download {{ (in_array('Customer_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Customer_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Article" {{ (in_array('Article',explode(',',$user->permission))) ? 'checked':''}} value="Article" type="checkbox" /> Article</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Article_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Article_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Article_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Article_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Article_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Article_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Article_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Article_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]"  data-head data-download {{ (in_array('Article_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Article_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Video" {{ (in_array('Video',explode(',',$user->permission))) ? 'checked':''}} value="Video" type="checkbox" /> Video</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Video_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Video_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Video_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Video_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Video_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Video_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Video_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Video_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" data-head data-download {{ (in_array('Video_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Video_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Offer" {{ (in_array('Offer',explode(',',$user->permission))) ? 'checked':''}} value="Offer" type="checkbox" /> Offer</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Offer_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Offer_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Offer_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Offer_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Offer_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Offer_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Offer_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Offer_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]"  data-head data-download {{ (in_array('Offer_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Offer_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Discount" {{ (in_array('Discount',explode(',',$user->permission))) ? 'checked':''}} value="Discount" type="checkbox" /> Discount</td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-create {{ (in_array('Discount_Create',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Discount_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-edit {{ (in_array('Discount_Edit',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Discount_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-view {{ (in_array('Discount_View',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Discount_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" data-head data-delete {{ (in_array('Discount_delete',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Discount_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]"  data-head data-download {{ (in_array('Discount_download',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" value="Discount_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Communication" {{ (in_array('Communication',explode(',',$user->permission))) ? 'checked':''}} value="Communication" type="checkbox" /> Communication</td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-create {{ (in_array('Communication_Create',explode(',',$user->permission))) ? 'checked':''}} value="Communication_Create" /></td>
                                                        <td></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-view {{ (in_array('Communication_View',explode(',',$user->permission))) ? 'checked':''}} value="Communication_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-delete {{ (in_array('Communication_delete',explode(',',$user->permission))) ? 'checked':''}} value="Communication_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" type="checkbox"  data-head data-download {{ (in_array('Communication_download',explode(',',$user->permission))) ? 'checked':''}} value="Communication_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Consultant" value="Consultant" {{ (in_array('Consultant',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" /> Consultant</td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-create {{ (in_array('Consultant_Create',explode(',',$user->permission))) ? 'checked':''}} value="Consultant_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-edit {{ (in_array('Consultant_Edit',explode(',',$user->permission))) ? 'checked':''}} value="Consultant_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-view {{ (in_array('Consultant_View',explode(',',$user->permission))) ? 'checked':''}} value="Consultant_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-delete {{ (in_array('Consultant_delete',explode(',',$user->permission))) ? 'checked':''}} value="Consultant_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" type="checkbox"  data-head data-download {{ (in_array('Consultant_download',explode(',',$user->permission))) ? 'checked':''}} value="Consultant_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Schedule" value="Schedule" {{ (in_array('Schedule',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" /> Schedule</td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-create {{ (in_array('Schedule_Create',explode(',',$user->permission))) ? 'checked':''}} value="Schedule_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-edit {{ (in_array('Schedule_Edit',explode(',',$user->permission))) ? 'checked':''}} value="Schedule_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-view {{ (in_array('Schedule_View',explode(',',$user->permission))) ? 'checked':''}} value="Schedule_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-delete {{ (in_array('Schedule_delete',explode(',',$user->permission))) ? 'checked':''}} value="Schedule_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" type="checkbox"  data-head data-download {{ (in_array('Schedule_download',explode(',',$user->permission))) ? 'checked':''}} value="Schedule_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Config" value="Config" {{ (in_array('Config',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" /> Config</td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-create {{ (in_array('Config_Create',explode(',',$user->permission))) ? 'checked':''}} value="Config_Create" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-edit {{ (in_array('Config_Edit',explode(',',$user->permission))) ? 'checked':''}} value="Config_Edit" /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-view {{ (in_array('Config_View',explode(',',$user->permission))) ? 'checked':''}} value="Config_View"  /></td>
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-delete {{ (in_array('Config_delete',explode(',',$user->permission))) ? 'checked':''}} value="Config_delete"  /></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" type="checkbox"  data-head data-download {{ (in_array('Config_download',explode(',',$user->permission))) ? 'checked':''}} value="Config_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Consultant_Approval" value="Consultant_Approval" {{ (in_array('Consultant_Approval',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" /> Consultant Approval</td>
                                                        <td colspan="2">
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-view {{ (in_array('Consultant_Approval_View',explode(',',$user->permission))) ? 'checked':''}} value="Consultant_Approval_View"  /></td>
                                                        <td></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" type="checkbox" data-head  data-download {{ (in_array('Consultant_Approval_download',explode(',',$user->permission))) ? 'checked':''}} value="Consultant_Approval_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" name="permession[]" id="Firm_Approval" value="Firm_Approval" {{ (in_array('Firm_Approval',explode(',',$user->permission))) ? 'checked':''}} type="checkbox" /> Firm Approval</td>
                                                        <td colspan="2">
                                                        <td ><input class="form-check-input" name="permession[]" type="checkbox" data-head data-view {{ (in_array('Firm_Approval_View',explode(',',$user->permission))) ? 'checked':''}} value="Firm_Approval_View"  /></td>
                                                        <td></td>
                                                        <td hidden><input class="form-check-input" name="permession[]" type="checkbox" data-head  data-download {{ (in_array('Firm_Approval_download',explode(',',$user->permission))) ? 'checked':''}} value="Firm_Approval_download"  /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- row close --}}
                                </div>
                                <br>
                                <div class="form-group row" style="float:right" >
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-secondary btn-hover-rise me-5 ">Reset</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-hover-rise me-5">Save</button>
                                    </div>
                                </div>
                            </div>
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
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/tinymce/tinymce.bundle.js')}}'></script>
    <script>
        var state = $("#state_id")
        var city = $("#city_id")
        back = `{{ route('admin.user.index') }}`;

        document.querySelectorAll('[data-create]').forEach(d =>{ $("#create_check").prop('checked', true)})
        document.querySelectorAll('[data-edit]').forEach(d =>{ $("#edit_check").prop('checked', true)})
        document.querySelectorAll('[data-view]').forEach(d =>{ $("#view_check").prop('checked', true)})
        document.querySelectorAll('[data-delete]').forEach(d =>{ $("#delete_check").prop('checked', true)})
        document.querySelectorAll('[data-download]').forEach(d =>{ $("#download_check").prop('checked', true)})

        $("#country_id").on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            url:"{{route('master.country.getState')}}",
            method:"POST",
            data:{id:data.id,"_token": "{{ csrf_token() }}",},
            success:function(data){
                var option = null
                if(data.states.length != null){
                    data.states.forEach((e)=>{
                        option += '<option value='+e.id+'>'+e.state_name+'</option>';
                    })
                }
                state.html(option).trigger("change");
                city.html(null).trigger("change");
                if(data.Country){
                    $("#phone").val(data.Country.dialing)
                }
            }
        })
    });
    $("#state_id").on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            url:"{{route('master.country.getCity')}}",
            method:"POST",
            data:{id:data.id,"_token": "{{ csrf_token() }}",},
            success:function(data){
                var option = null
                if(data.length != null){
                    data.forEach((e)=>{
                        option += '<option value='+e.id+'>'+e.city_name+'</option>';
                    })
                }
                city.html(option).trigger("change");
            }
        })
    });
    
    $('[data-head]').click(function() {
        if ($(this).is(':checked')) {
            this.parentElement.parentElement.firstElementChild.firstChild.checked=true
        } else {
            var s = this.parentElement.parentElement.children;
            var len = s.length;
            var is_check = [];
            for (let index = 0; index < len; index++) {
                // const element = s[index];
                // console.log(element);
                var t = String(s[index].firstChild.checked==true);
                is_check.push(t);
            }
            var is_true =  is_check.filter((element, index) => element =='true');
            if(is_true.length < 2){
                this.parentElement.parentElement.firstElementChild.firstChild.checked=false;
            }
        };
    });
        
   
     $('#create_check').click(function() {
            if ($(this).is(':checked')) {
                $.each($('[data-create]'), function(index, data){ data.checked = true })
            } else {
                $.each($('[data-create]'), function(index, data){ data.checked = false })
            }
        });

        $('#edit_check').click(function() {
            if ($(this).is(':checked')) {
                $.each($('[data-edit]'), function(index, data){ data.checked = true })
            } else {
                $.each($('[data-edit]'), function(index, data){ data.checked = false })
            }
        });

        $('#view_check').click(function() {
            if ($(this).is(':checked')) {
                $.each($('[data-view]'), function(index, data){ data.checked = true })
            } else {
                $.each($('[data-view]'), function(index, data){ data.checked = false })
            }
        });

        $('#delete_check').click(function() {
            if ($(this).is(':checked')) {
                $.each($('[data-delete]'), function(index, data){ data.checked = true })
            } else {
                $.each($('[data-delete]'), function(index, data){ data.checked = false })
            }
        });

        $('#download_check').click(function() {
            if ($(this).is(':checked')) {
                $.each($('[data-download]'), function(index, data){ data.checked = true })
            } else {
                $.each($('[data-download]'), function(index, data){ data.checked = false })
            }
        });
        
        
        // Row wise Check
        
         $('#Admin').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Admin').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Admin').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });

        $('#Currency').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Currency').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Currency').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Country').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Country').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Country').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#City').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#City').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#City').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#State').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#State').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#State').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Document').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Document').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Document').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Language').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Language').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Language').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Tax').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Tax').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Tax').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Category').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Category').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Category').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Specialization').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Specialization').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Specialization').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Company_Settings').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Company_Settings').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Company_Settings').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Firm').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Firm').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Firm').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Insurance').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Insurance').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Insurance').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Customer').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Customer').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Customer').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Article').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Article').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Article').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Video').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Video').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Video').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Discount').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Discount').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Discount').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Offer').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Offer').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Offer').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Communication').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Communication').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Communication').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Consultant').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Consultant').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Consultant').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Schedule').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Schedule').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Schedule').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Config').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Config').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Config').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Consultant_Approval').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Consultant_Approval').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Consultant_Approval').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });
        $('#Firm_Approval').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#Firm_Approval').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#Firm_Approval').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });      

        
    </script>
    @endsection

</x-base-layout>
