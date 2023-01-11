<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create Admin</h1>
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
                        <form action="{{ route('admin.user.store') }}" method="post" id="formCreate">
                            @csrf
                            <div class="py-5">
                                
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="required form-label fs-6 mb-4" >First Name</label>
                                        <input type="text" name="first_name" class="form-control mb-4 " placeholder="First Name" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fs-6 mb-4" >Last Name</label> 
                                        <input type="text" name="last_name" class="form-control mb-4 " placeholder="Last Name" required />

                                    </div>
                                </div>

                              
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="required form-label fs-6 mb-4" >Email Id / Username</label>
                                        <input type="text" name="email" class="form-control mb-4 " placeholder="Email" required />

                                    </div>
                                    <div class="col-md-3">
                                        <label class="required form-label fs-6 mb-4" >Profile Picture </label>
                                        <div class="col-md-6">
                                            @include('components.imagecrop',['name'=>'picture','width'=>600,'height'=>600])
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="required form-label fs-6 mb-4" >Two Way Aunthentication</label> <br>
                                        <input type="checkbox" class="form-check-input mb-4 " name="is_two_way_auth" value="2">
                                    </div>
                                </div>

                                <h4>Address</h4>
                                <div class="form-group row">
                                        @include('components.addressComponent',['register_address'=>'','phone'=>'','page'=>'create','countrys'=>$countrys,'state'=>$state,'city'=>$city])
                                </div>
                                <br/>
                                
                                <div class="rounded border p-10">

                                    <div class="fv-row mb-10">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>

                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <th></th>
                                                        <th><input class="form-check-input" id="create_check" type="checkbox"  /> Create</th>
                                                        <th><input class="form-check-input" id="edit_check" type="checkbox" /> Edit </th>
                                                        <th><input class="form-check-input" id="view_check" type="checkbox" /> View </th>
                                                        <th><input class="form-check-input" id="delete_check" type="checkbox" /> Delete </th>
                                                        <th hidden><input class="form-check-input" id="download_check" type="checkbox" /> Download </th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="admin" data-check name="permession[]" value="Admin" type="checkbox" /> Admin</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Admin_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit ame="permession[]" type="checkbox" value="Admin_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view ame="permession[]" type="checkbox" value="Admin_View" /></td>
                                                        <td ><input class="form-check-input" data-head data-delete ame="permession[]" type="checkbox" value="Admin_delete" /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download ame="permession[]"  type="checkbox" value="Admin_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Currency" name="permession[]" value="Currency" type="checkbox" /> Currency</td>
                                                        <td colspan="2"></td>
                                                        <td></td>
                                                        <td><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Currency_View" /></td>
                                                        <td hidden><input class="form-check-input" data-head data-download name="permession[]" type="checkbox" value="Currency_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Country" name="permession[]" value="Country" type="checkbox" /> Country</td>
                                                        <td colspan="2"></td>
                                                        <td><input class="form-check-input" data-head data-view name="permession[]" value="Country_View" type="checkbox" /></td>
                                                        <td></td>
                                                        <td hidden><input class="form-check-input" data-head data-download name="permession[]" value="Country_Download" type="checkbox" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="State" name="permession[]" value="State" type="checkbox" /> State</td>
                                                        <td ><input class="form-check-input" data-head  data-admin data-create name="permession[]" type="checkbox" value="State_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-admin data-edit name="permession[]" type="checkbox" value="State_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-admin data-view name="permession[]" type="checkbox" value="State_View" /></td>
                                                        <td ><input class="form-check-input" data-head  data-admin data-delete name="permession[]" type="checkbox" value="State_delete" /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-admin data-download name="permession[]" type="checkbox" value="State_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="City" name="permession[]" value="City" type="checkbox" /> City</td>
                                                        <td ><input class="form-check-input"data-head  data-create name="permession[]" type="checkbox" value="City_Create"/></td>
                                                        <td ><input class="form-check-input"data-head  data-edit name="permession[]" type="checkbox" value="City_Edit"/></td>
                                                        <td ><input class="form-check-input"data-head  data-view name="permession[]" type="checkbox" value="City_View" /></td>
                                                        <td ><input class="form-check-input"data-head  data-delete name="permession[]" type="checkbox" value="City_delete" /></td>
                                                        <td hidden><input class="form-check-input" data-head data-download name="permession[]" type="checkbox" value="City_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Document" name="permession[]" value="Document" type="checkbox" /> Document</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Document_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Document_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Document_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Document_delete"  /></td>
                                                        <td hidden><input class="form-check-input" data-head data-download name="permession[]" type="checkbox" value="Document_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Language" name="permession[]" value="Language" type="checkbox" /> Language</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Language_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Language_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Language_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Language_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Language_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Tax" name="permession[]" value="Tax" type="checkbox" /> Tax</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Tax_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Tax_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Tax_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Tax_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Tax_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Category"  name="permession[]" value="Category" type="checkbox" /> Category</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Categoty_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Categoty_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Categoty_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Categoty_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Categoty_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Specialization" name="permession[]" value="Specialization" type="checkbox" /> Specialization</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Specialization_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Specialization_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Specialization_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Specialization_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Specialization_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Company_Settings" name="permession[]" value="Company_Settings" type="checkbox" /> Company Settings</td>
                                                        <td colspan="2"></td>
                                                        <td><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Company_Settings_View" /></td>
                                                        <td></td>
                                                        <td hidden><input class="form-check-input" data-head data-download name="permession[]" type="checkbox" value="Company_Settings_download" /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Firm" name="permession[]" value="Firm" type="checkbox" /> Firm</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Firm_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Firm_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Firm_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Firm_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Firm_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Insurance" name="permession[]" value="Insurance" type="checkbox" /> Insurance</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Insurance_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Insurance_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Insurance_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Insurance_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Insurance_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Customer" name="permession[]"  value="Customer" type="checkbox" /> Customer</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Customer_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Customer_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Customer_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Customer_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Customer_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Article" name="permession[]" value="Article" type="checkbox" /> Article</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Article_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Article_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Article_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Article_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Article_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Video" name="permession[]" value="Video" type="checkbox" /> Video</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Video_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Video_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Video_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Video_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Video_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Offer" name="permession[]" value="Offer" type="checkbox" /> Offer</td>
                                                        <td ><input class="form-check-input" data-head  data-create name="permession[]" type="checkbox" value="Offer_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Offer_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Offer_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Offer_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Offer_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Discount" name="permession[]" value="Discount" type="checkbox" /> Discount</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Discount_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Discount_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Discount_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Discount_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Discount_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Communication" name="permession[]" value="Communication" type="checkbox" /> Communication</td>
                                                        <td colspan="2"><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Communication_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Communication_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Communication_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Communication_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Consultant" name="permession[]" value="Consultant" type="checkbox" /> Consultant</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Consultant_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Consultant_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Consultant_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Consultant_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Consultant_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Schedule" name="permession[]" value="Schedule" type="checkbox" /> Schedule</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Schedule_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Schedule_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Schedule_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Schedule_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Schedule_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Config" name="permession[]" value="Config" type="checkbox" /> Config</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Config_Create" /></td>
                                                        <td ><input class="form-check-input" data-head data-edit name="permession[]" type="checkbox" value="Config_Edit" /></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Config_View"  /></td>
                                                        <td ><input class="form-check-input" data-head data-delete name="permession[]" type="checkbox" value="Config_delete"  /></td>
                                                        <td hidden><input class="form-check-input"  data-head data-download name="permession[]" type="checkbox" value="Config_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="Consultant_Approval" name="permession[]" value="Consultant_Approval" type="checkbox" /> Consultant Approval</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Consultant_Approval_Create" /></td>
                                                        <td ></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Consultant_Approval_View"  /></td>
                                                        <td ></td>
                                                        <td hidden><input class="form-check-input" data-head data-download name="permession[]" type="checkbox" value="Consultant_Approval_download"  /></td>
                                                    </tr>
                                                    <tr class="fw-bolder fs-6 text-gray-800">
                                                        <td><input class="form-check-input" id="firm_approval" name="permession[]" value="Firm_Approval" type="checkbox" /> Firm Approval</td>
                                                        <td ><input class="form-check-input" data-head data-create name="permession[]" type="checkbox" value="Firm_Approval_Create" /></td>
                                                        <td ></td>
                                                        <td ><input class="form-check-input" data-head data-view name="permession[]" type="checkbox" value="Firm_Approval_View"  /></td>
                                                        <td ></td>
                                                        <td hidden><input class="form-check-input" data-head data-download name="permession[]" type="checkbox"  value="Firm_Approval_download"  /></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row" style="float:right" >
                                    <div class="col-md-6">
                                        <button type="reset" id="formreset" class="btn btn-secondary btn-hover-rise me-5 ">Reset</button>
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
        back = `{{ route('admin.user.index') }}`
        $('[data-head]').click(function() {
            if ($(this).is(':checked')) {
                // debugger;
                this.parentElement.parentElement.firstElementChild.firstChild.checked=true
            }
            else {
             
                var s = this.parentElement.parentElement.children;
                var len = s.length;
                var is_check = [];
                for (let index = 0; index < len; index++) {
                    // const element = s[index];
                    // console.log(element);
                    var t = String(s[index].firstChild.checked==true);
                    is_check.push(t);
                }
                console.log(is_check);
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

        $('#admin').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#admin').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#admin').parent().parent().find('input'), function(index, data){ data.checked = false})
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
        $('#firm_approval').click(function() {
            if ($(this).is(':checked')) {
                $.each($('#firm_approval').parent().parent().find('input'), function(index, data){ data.checked = true})
            } else {
                $.each($('#firm_approval').parent().parent().find('input'), function(index, data){ data.checked = false})
            }
        });      

    </script>
    @endsection

</x-base-layout>
