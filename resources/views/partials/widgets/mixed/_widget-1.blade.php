
<!--begin::List Widget 3-->
<div class="card {{ $class }}">
    <!--begin::Header-->

 
    <div class="card-body pt-2">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
            <li class="nav-item mt-2">
                {{-- <a  class=" ms-0 me-10 py-5" href="#" ><b>APPROVALS </b></a>  --}}
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link  text-active-info  ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#App_1" >FIRM APPROVALS</a> 
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-danger  ms-0 me-10 py-5 " data-bs-toggle="tab" href="#App_2" >PAYOUT APPROVALS</a> 
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link  text-active-success ms-0 me-10 py-5 " data-bs-toggle="tab" href="#App_3" >PAYIN APPROVALS</a> 
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link  text-active-warning ms-0 me-10 py-5 " data-bs-toggle="tab" href="#App_4" >PROFILE APPROVALS</a> 
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            {{-- Tab 1 --}}
           
            <div class="tab-pane fade show active" id="App_1" role="tabpanel">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        
                        <div class="row gy-10 gx-xl-10">
                            <div class="card card-docs flex-row-fluid mb-2">
                                <table id="kt_datatable9" class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th>Date & Time</th>
                                            <th>Firm Name</th>
                                            <th>Email ID</th>
                                            <th>Category</th>
                                            <th>status</th>
                                            <th>Date & Time Stamp</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Firm Name</th>
                                            <th>Email ID</th>
                                            <th>Category</th>
                                            <th>status</th>
                                            <th>Date & Time Stamp</th>
                                            <th>Option</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="App_2" role="tabpanel">
                
                
            </div>
            <div class="tab-pane fade show" id="App_3" role="tabpanel">
            </div>
            <div class="tab-pane fade show" id="App_4" role="tabpanel"><div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    
                    <div class="row gy-10 gx-xl-10">
                        <div class="card card-docs flex-row-fluid mb-2">
                            <table id="kt_datatable10" class="table table-row-bordered gy-5">
                                <thead>
                                    <tr class="fw-bold fs-6 text-muted">
                                        <th>Date & Time</th>
                                        <th>Consultant Name</th>
                                        <th>Email ID</th>
                                        <th>Category</th>
                                        <th>status</th>
                                        <th>Date & Time Stamp</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Consultant Name</th>
                                        <th>Email ID</th>
                                        <th>Category</th>
                                        <th>status</th>
                                        <th>Date & Time Stamp</th>
                                        <th>Option</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end:List Widget 3-->
