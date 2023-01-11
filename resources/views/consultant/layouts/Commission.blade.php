<div class="" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-8 pb-lg-10">
            <!--begin::Title-->
            <h2 class="fw-bolder text-dark">Commission</h2>
        </div>
        
        <h4>Commission For Consultant Fee</h4>
        <div class="mb-10 fv-row">
            <label class="required form-label fs-6 mb-2" >Flat or Percentage</label>
            <div class="form-check form-check-custom form-check-solid mb-5">
                <input class="form-check-input me-3" name="com_con_type" onchange="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value)" type="radio" value="0" checked id="com_con_flat" />
                <label class="form-check-label" for="com_con_flat">
                    <div class="fw-bolder text-gray-800">Flat</div>
                </label>
            </div>
            <div class="form-check form-check-custom form-check-solid mb-5">
                <input class="form-check-input me-3" name="com_con_type" onchange="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value)" type="radio" value="1" id="com_con_per" />
                <label class="form-check-label" for="com_con_per">
                    <div class="fw-bolder text-gray-800">Percentage</div>
                </label>
            </div>
        
            <label class="required form-label fs-6 mb-2" >Commission Amount</label>
            <div class="input-group mb-5">
                <span class="input-group-text consultantcurrnect" id="inputGroup-sizing-default "></span>
                <input type="number" onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value)" class="form-control" name="com_con_amount" id="com_con_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount -- {{ $companeySetting->country->currency->currencycode }}</span>
            </div>
        </div>
        
        <div class="mb-10 fv-row">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th></th>
                            <th>Video</th>
                            <th>Voice</th>
                            <th>Text</th>
                            <th>Direct</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="consultantcurrnect"></td>
                            <td id="video_current"></td>
                            <td id="voice_current"></td>
                            <td id="text_current"></td>
                            <td id="direact_current"></td>
                        </tr>
                        <tr>
                            <td>Base currency {{ $companeySetting->country->currency->currencycode }}</td>
                            <td id="video_base"></td>
                            <td id="voice_base"></td>
                            <td id="text_base"></td>
                            <td id="direact_base"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       
      
        <h4>Commission For Offers</h4>
        <div class="mb-10 fv-row">
            <label class="required form-label fs-6 mb-2" >Flat or Percentage</label>
            <div class="form-check form-check-custom form-check-solid mb-5">
                <input class="form-check-input me-3" name="com_off_type" onchange="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value)" type="radio" value="0" checked id="com_off_flat" />
                <label class="form-check-label" for="com_off_flat">
                    <div class="fw-bolder text-gray-800">Flat</div>
                </label>
            </div>
            <div class="form-check form-check-custom form-check-solid mb-5">
                <input class="form-check-input me-3" name="com_off_type" onchange="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value)" type="radio" value="1" id="com_off_per" />
                <label class="form-check-label" for="com_off_per">
                    <div class="fw-bolder text-gray-800">Percentage</div>
                </label>
            </div>
            <label class="required form-label fs-6 mb-2" >Commission Amount</label>
            <div class="input-group mb-5">
                <span class="input-group-text consultantcurrnect" id="inputGroup-sizing-default "></span>
                <input type="number" class="form-control" onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value)"  name="com_off_amount" id="com_off_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount -- {{ $companeySetting->country->currency->currencycode }}</span>
            </div>
        </div>
       
       
        <h4>Payout Settings</h4>
        <div class="mb-10 fv-row">
            <label class="required form-label fs-6 mb-2 d-none" >Flat or Percentage</label>
            <div class="form-check form-check-custom form-check-solid mb-5 d-none">
                <input class="form-check-input me-3" name="com_pay_type" onchange="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value)" type="radio" value="0" checked id="com_pay_flat" />
                <label class="form-check-label" for="com_pay_flat">
                    <div class="fw-bolder text-gray-800">Flat</div>
                </label>
            </div>
            <div class="form-check form-check-custom form-check-solid mb-5 d-none">
                <input class="form-check-input me-3" name="com_pay_type" onchange="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value)" type="radio" value="1" id="com_pay_per" />
                <label class="form-check-label" for="com_pay_per">
                    <div class="fw-bolder text-gray-800">Percentage</div>
                </label>
            </div>
            <label class="required form-label fs-6 mb-2" >Minimum Payout Amount</label>
            <div class="input-group mb-5">
                <span class="input-group-text consultantcurrnect" id="inputGroup-sizing-default "></span>
                <input type="number" class="form-control"  onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value)" name="com_pay_amount" id="com_pay_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount -- {{ $companeySetting->country->currency->currencycode }}</span>
            </div>
        </div>
    </div>
    <!--end::Wrapper-->
</div>
