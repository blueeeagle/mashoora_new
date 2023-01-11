<div class="" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <div class="pb-8 pb-lg-10">
            <h2 class="fw-bolder text-dark">Preferred Slot</h2>
        </div>
        <div class="fv-row mb-10 form-group row">
            <!--begin:Option-->
            <label class="d-flex flex-stack mb-5 cursor-pointer col-md-4">
                <!--begin:Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin:Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-primary">
                            <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                ....
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </span>
                    <!--end:Icon-->

                    <!--begin:Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bolder fs-6">15 Min</span>
                        {{-- <span class="fs-7 text-muted">Creating a clear text structure is just one SEO</span> --}}
                    </span>
                    <!--end:Info-->
                </span>
                <!--end:Label-->

                <!--begin:Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio"  name="preferre_slot" checked value="15"/>
                </span>
                <!--end:Input-->
            </label>
            <!--end::Option-->

            <!--begin:Option-->
            <label class="d-flex flex-stack mb-5 cursor-pointer col-md-4">
                <!--begin:Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin:Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-danger">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                ....
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </span>
                    <!--end:Icon-->

                    <!--begin:Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bolder fs-6">30 Min</span>
                        {{-- <span class="fs-7 text-muted">Creating a clear text structure is just one aspect</span> --}}
                    </span>
                    <!--end:Info-->
                </span>
                <!--end:Label-->

                <!--begin:Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="preferre_slot" value="30"/>
                </span>
                <!--end:Input-->
            </label>
            <!--end::Option-->

            <!--begin:Option-->
            <label class="d-flex flex-stack mb-5 cursor-pointer col-md-4">
                <!--begin:Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin:Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-success">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                ....
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </span>
                    <!--end:Icon-->

                    <!--begin:Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bolder fs-6">45 Min</span>
                        {{-- <span class="fs-7 text-muted">Creating a clear text structure copywriting</span> --}}
                    </span>
                    <!--end:Info-->
                </span>
                <!--end:Label-->

                <!--begin:Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="preferre_slot" value="45"/>
                </span>
                <!--end:Input-->
            </label>
            <!--end::Option-->

            <!--begin:Option-->
            <label class="d-flex flex-stack mb-5 cursor-pointer col-md-4">
                <!--begin:Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin:Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-success">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                ....
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </span>
                    <!--end:Icon-->

                    <!--begin:Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bolder fs-6">60 Min</span>
                        {{-- <span class="fs-7 text-muted">Creating a clear text structure copywriting</span> --}}
                    </span>
                    <!--end:Info-->
                </span>
                <!--end:Label-->

                <!--begin:Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="preferre_slot" value="60"/>
                </span>
                <!--end:Input-->
            </label>
            <!--end::Option-->
        </div>
        <div class="fv-row">
            <div class="col-12">
                <h2 class="fw-bolder text-dark">Consultant Type</h2>
            </div>
            <div class='row'>
                <div class="col-2">
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" onchange="enabledisable(document.querySelector('input[name=video_amount]'))" type="checkbox" value="1" id="Video" name="video" />
                        <label class="form-check-label" for="Video" >
                            Video
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-5">
                        <span class="input-group-text consultantcurrnect" id="inputGroup-sizing-default "></span>
                        <input type="number" onkeyup="courencyconveter()" value="0" disabled class="form-control" name="video_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                        <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount -- {{ $companeySetting->country->currency->currencycode }}</span>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class="col-2">
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" onchange="enabledisable(document.querySelector('input[name=voice_amount]'))" value="1" id="Voice" name="voice" />
                        <label class="form-check-label" for="Voice" >
                            Voice
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-5">
                        <span class="input-group-text consultantcurrnect" id="inputGroup-sizing-default "></span>
                        <input type="number" onkeyup="courencyconveter()" value="0" disabled class="form-control" name="voice_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                        <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount -- {{ $companeySetting->country->currency->currencycode }}</span>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class="col-2">
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" onchange="enabledisable(document.querySelector('input[name=text_amount]'))" value="1" id="Text" name="text" />
                        <label class="form-check-label" for="Text" >
                            Text
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-5">
                        <span class="input-group-text consultantcurrnect" id="inputGroup-sizing-default"></span>
                        <input type="number" onkeyup="courencyconveter()" value="0" disabled class="form-control" name="text_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                        <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount -- {{ $companeySetting->country->currency->currencycode }}</span>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class="col-2">
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" onchange="enabledisable(document.querySelector('input[name=direct_amount]'))" value="1" id="Direct" name="direct" />
                        <label class="form-check-label" for="Direct" >
                            Direct
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-5">
                        <span class="input-group-text consultantcurrnect" id="inputGroup-sizing-default "></span>
                        <input type="number" onkeyup="courencyconveter()" value="0" disabled class="form-control" name="direct_amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                        <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount -- {{ $companeySetting->country->currency->currencycode }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Wrapper-->
</div>
