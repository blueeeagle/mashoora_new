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
						            <button class="btn nav-link btn-color-gray-400 btn-active btn-active-secondary px-6 py-3 me-2 active" data-bs-toggle="tab" href="#kt_tab_pane_1">Bookin Info</button>
								    <button class="btn  nav-link  btn-color-gray-400 btn-active btn-active-secondary px-6 py-3" data-bs-toggle="tab" href="#kt_tab_pane_2">Log Details</button>
						        </div>
							</div><br/>
                            
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                    <div class="row mb-5">
                                        <div class="col-3">
                                            <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Appointment Type:</span>
                                             <span style="text-transform:capitalize;" data-app-type class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                        </div>
                                        <div class="col-4">
                                            <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Appointment Status:</span>
                                             <span data-app-status class="fw-bold fs-5 text-gray-700 flex-grow-1"></span>
                                        </div> 
                                        <div class="col-4" id="is_insurance" hidden>
                                            <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Insurance:</span>
                                             <span data-insurance class=""></span><br>
                                             <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Policy ID:</span>
                                             <span data-policyid class=""></span>
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
                                    
                                    <div class="row" id="selecterDiv" >
                                         <div class="col-4">
                                           <div class="card-toolbar" data-select2-id="select2-data-131-2zax">
                                                <select id="BookingactionForModal" class="form-select" data-control="select2" data-placeholder="Action Taken ...">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--<div class="row">-->
          <!--                              <div class="col-lg-6 mb-10 mb-lg-0">-->
          <!--                                  <div class="nav flex-column">-->
          <!--                                     <div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">-->
        		<!--									end::Description-->
        		<!--									<div class="d-flex align-items-center me-2">-->
        		<!--										begin::Radio-->
        		<!--										<div class="form-check form-check-custom form-check-solid form-check-success me-6">-->
        		<!--											<input class="form-check-input" type="radio" name="plan" value="advanced">-->
        		<!--										</div>-->
        		<!--										end::Radio-->
        		<!--										begin::Info-->
        		<!--										<div class="flex-grow-1">-->
        		<!--											<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Advanced</h2>-->
        		<!--											<div class="fw-bold opacity-50">Best for 100+ team size</div>-->
        		<!--										</div>-->
        		<!--										end::Info-->
        		<!--									</div>-->
        		<!--									end::Description-->
        		<!--									begin::Price-->
        		<!--									<div class="ms-5">-->
        		<!--										<span class="mb-2">$</span>-->
        		<!--										<span class="fs-3x fw-bolder" data-kt-plan-price-month="339" data-kt-plan-price-annual="3399">339</span>-->
        		<!--										<span class="fs-7 opacity-50">/-->
        		<!--										<span data-kt-element="period">Mon</span></span>-->
        		<!--									</div>-->
        		<!--									end::Price-->
    						<!--				    </div>-->
										<!--    </div>-->
          <!--                              </div>-->
                                        
          <!--                              <div class="col-lg-6 mb-10 mb-lg-0">-->
                                           
          <!--                                  <div class="tab-content rounded h-100 bg-light p-10">-->
    										    <!--begin::Tab Pane-->
    						<!--				    <div class="tab-pane fade show active" id="kt_upgrade_plan_startup">-->
        		<!--									<div class="pb-5">-->
        		<!--										<h2 class="fw-bolder text-dark">What’s in Startup Plan?</h2>-->
        		<!--										<div class="text-muted fw-bold">Optimal for 10+ team size and new startup</div>-->
        		<!--									</div>-->
										<!--	        <div class="pt-1">-->
												<!--begin::Item-->
										<!--		<div class="d-flex align-items-center mb-7">-->
										<!--			<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 10 Active Users</span>-->
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
										<!--			<span class="svg-icon svg-icon-1 svg-icon-success">-->
										<!--				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
										<!--					<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>-->
										<!--					<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>-->
										<!--				</svg>-->
										<!--			</span>-->
													<!--end::Svg Icon-->
										<!--		</div>-->
												<!--end::Item-->
												<!--begin::Item-->
										<!--		<div class="d-flex align-items-center mb-7">-->
										<!--			<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 30 Project Integrations</span>-->
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
										<!--			<span class="svg-icon svg-icon-1 svg-icon-success">-->
										<!--				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
										<!--					<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>-->
										<!--					<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>-->
										<!--				</svg>-->
										<!--			</span>-->
													<!--end::Svg Icon-->
										<!--		</div>-->
												<!--end::Item-->
												<!--begin::Item-->
										<!--		<div class="d-flex align-items-center mb-7">-->
										<!--			<span class="fw-bold fs-5 text-gray-700 flex-grow-1">Analytics Module</span>-->
													<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
										<!--			<span class="svg-icon svg-icon-1 svg-icon-success">-->
										<!--				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
										<!--					<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>-->
										<!--					<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>-->
										<!--				</svg>-->
										<!--			</span>-->
													<!--end::Svg Icon-->
										<!--		</div>-->
												<!--end::Item-->
												<!--begin::Item-->
										<!--		<div class="d-flex align-items-center mb-7">-->
										<!--			<span class="fw-bold fs-5 text-muted flex-grow-1">Finance Module</span>-->
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
										<!--			<span class="svg-icon svg-icon-1">-->
										<!--				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
										<!--					<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>-->
										<!--					<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect>-->
										<!--					<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect>-->
										<!--				</svg>-->
										<!--			</span>-->
													<!--end::Svg Icon-->
										<!--		</div>-->
												<!--end::Item-->
												<!--begin::Item-->
										<!--		<div class="d-flex align-items-center mb-7">-->
										<!--			<span class="fw-bold fs-5 text-muted flex-grow-1">Accounting Module</span>-->
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
										<!--			<span class="svg-icon svg-icon-1">-->
										<!--				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
										<!--					<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>-->
										<!--					<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect>-->
										<!--					<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect>-->
										<!--				</svg>-->
										<!--			</span>-->
													<!--end::Svg Icon-->
										<!--		</div>-->
												<!--end::Item-->
												<!--begin::Item-->
										<!--		<div class="d-flex align-items-center mb-7">-->
										<!--			<span class="fw-bold fs-5 text-muted flex-grow-1">Network Platform</span>-->
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
										<!--			<span class="svg-icon svg-icon-1">-->
										<!--				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
										<!--					<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>-->
										<!--					<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect>-->
										<!--					<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect>-->
										<!--				</svg>-->
										<!--			</span>-->
													<!--end::Svg Icon-->
										<!--		</div>-->
												<!--end::Item-->
												<!--begin::Item-->
										<!--		<div class="d-flex align-items-center">-->
										<!--			<span class="fw-bold fs-5 text-muted flex-grow-1">Unlimited Cloud Space</span>-->
													<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
										<!--			<span class="svg-icon svg-icon-1">-->
										<!--				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
										<!--					<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>-->
										<!--					<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect>-->
										<!--					<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect>-->
										<!--				</svg>-->
										<!--			</span>-->
													<!--end::Svg Icon-->
										<!--		</div>-->
												<!--end::Item-->
										<!--	</div>-->
											<!--end::Body-->
										<!--</div>-->
										<!--</div>-->
          <!--                              </div>-->
          <!--                      </div>-->
                                </div>
                                
                                
                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                   <div class="col-12 mb-10 mb-lg-0">
                                    <div class="table-responsive" style="margin-top:-25px;">
                                        <table id="App_log" class=" table table-striped table-row-bordered gy-5 gs-7">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                   </div>
                                </div>
                            </div>
						</div>
						<!--end::Plans-->
						<!--begin::Actions-->
						
						<!--end::Actions-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
