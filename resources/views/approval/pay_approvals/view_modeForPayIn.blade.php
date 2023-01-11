<div class="modal fade" id="view_app" tabindex="-1" aria-modal="true" role="dialog" aria-hidden="true">

			<div class="modal-dialog modal-xl">
				<!--begin::Modal content-->
				<div class="modal-content rounded">
					<!--begin::Modal header-->
					<div class="modal-header justify-content-end border-0 pb-0">
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body pt-0 pb-15 px-5 px-xl-20">
						<!--begin::Heading-->
						<div class="mb-13 text-center">
							<h1 class="mb-3">View Appointment</h1>
							<input type="hidden" data-app-id>
						</div>
						<!--end::Heading-->
						<!--begin::Plans-->
						<div class="d-flex flex-column">
						    
						    <div class="nav-group nav-group-outline mx-auto" data-kt-buttons="true">
						        <div class="nav nav-tabs">
						            <button class="btn nav-link btn-color-gray-400 btn-active btn-active-secondary px-6 py-3 me-2 active" data-bs-toggle="tab" href="#kt_tab_pane_1">Appointment Details</button>
								    {{-- <button class="btn  nav-link  btn-color-gray-400 btn-active btn-active-secondary px-6 py-3" data-bs-toggle="tab" href="#kt_tab_pane_2">Log Details</button> --}}
						        </div>
							</div><br/>
                            
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                    <div class="row mb-5">
                                        <div class="col-3">
                                            <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Appointment Type:</span>
                                             <span data-app-type class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                        </div>
                                        <div class="col-4">
                                            <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Appointment Status:</span>
                                             <span data-app-status class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                        </div> 
                                        <div class="col-4">
                                            <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Commission Amount:</span>
                                             <span data-com-amount class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 rounded border h-100 p-10">
                                            <h2 class="fw-bolder text-dark">Consultant Details</h2>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1"><b>Name:</b></span>
                                                    <span data-con-name  class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Phone No:</span>
                                                    <span data-con-phone  class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Email:</span>
                                                    <span data-con-email class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                        <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Amount:</span>
                                                        <span data-con-amount class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                        <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Time Zone:</span>
                                                        <span data-con-timezone class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div> 
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                            <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Time:</span>
                                                            <span data-con-timeslot class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                    </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Date:</span>
                                                    <span data-con-date class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        
                                         <div class="col-lg-6 rounded h-100 bg-light p-10">
                                            <h2 class="fw-bolder text-dark">Customer Details</h2>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Name:</span>
                                                    <span data-cus-name  class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Phone No:</span>
                                                    <span data-cus-phone class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Email:</span>
                                                    <span data-cus-email class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                               
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Amount:</span>
                                                    <span data-cus-amount class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                        <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Time Zone:</span>
                                                        <span data-cus-timezone class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div> 
                                                
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                        <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Time:</span>
                                                        <span data-cus-timeslot class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Date:</span>
                                                    <span data-cus-date class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                {{-- <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                   <div class="col-lg-6 mb-10 mb-lg-0"> Log Details
                                   
                                    </div>
                                </div> --}}
                            </div>
						</div>
						<!--end::Plans-->
						<!--begin::Actions-->
						<div class="d-flex flex-center flex-row-fluid pt-12">
							<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
							<!--<button type="submit" class="btn btn-primary">Upgrade Plan</button>-->
						</div>
						<!--end::Actions-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
