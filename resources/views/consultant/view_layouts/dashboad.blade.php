<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-body">
            <form id="personal_details" action="#" method="post">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="{{asset("storage/$consultant->picture")}}" alt="image" />
                            <div
                                class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <a href="#"
                            class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $consultant->name }}</a>
                        <a href="#">
                            @if($consultant->approval == 1)
                            <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <path
                                        d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                        fill="#00A3FF" />
                                    <path class="permanent"
                                        d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                        fill="white" />
                                </svg>
                            </span>
                            @endif
                            <!--end::Svg Icon-->
                        </a>
                        <a href="#"
                            class="btn btn-sm btn-light-{{ ($consultant->approval == 0)?'danger':'success'  }} fw-bolder ms-2 fs-8 py-1 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#kt_modal_upgrade_plan">{{ ($consultant->approval == 0)?'Waiting for Approval':'Approved' }}</a>


                        <div class="row">

                            <div class="col-6">
                                <label class="required form-label fs-6 mb-2">Phone :</label>

                                <input type="text" name="email" id="email"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" readonly
                                    value="{{ $consultant->phone_no }}" />
                            </div>

                            <div class="col-6">
                                <label class="required form-label fs-6 mb-2">Email :</label>
                                <input type="text" name="email" id="email"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" required
                                    value="{{ $consultant->email }}" />

                            </div>


                        </div>

                        <div class="row">

                            <div class="col-6">
                                <label for="" class="required form-label">Gender:</label>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="gender" type="radio" value="0" id="male"
                                        {{ ($consultant->gender ==0)?'checked':''}} />
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                    &nbsp;
                                    <input class="form-check-input" type="radio" name="gender" value="1" id="female"
                                        {{ ($consultant->gender ==1)?'checked':''}} />
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div>

                            </div>
                            <div class="col-6">
                                <label class="required form-label fs-6 mb-2">Year of Experience :</label>
                                <input type="text" name="exp_year" id="exp_year"
                                    class="form-control form-control-solid mb-2" placeholder="Name" required
                                    value="{{ $consultant->exp_year }}" />

                            </div>

                        </div>

                        <div class="row p-5">
                            @include('components.addressComponent',['country_id'=>$consultant->country_id,'state_id'=>$consultant->state_id,
                            'city_id'=>$consultant->city_id,'zipcode'=>$consultant->zipcode,'register_address'=>$consultant->register_address,'page'=>'Edit','countrys'=>$countrys,'state'=>$state,'city'=>$city])
                        </div>

                        <div class="row">
                            <label class="required form-label fs-6 mb-2">Bio :</label>
                            <textarea name="bio_data" id="bio_data" class="form-control form-control-solid mb-3"
                                placeholder="Name" required>{{ $consultant->bio_data }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-sm float-end"
                                    id="personal">Update</button>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
            <div>
                <hr>
            </div>

            <form action="#" method="post" id="consultant_amount">
                <div class="form-group row">


                    <div class="col-2">
                        <h3 class="fw-bolder text-dark">Consultant Type</h3>
                    </div>
                    <div class='row'>
                        <div class="col-1">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input"
                                    onchange="enabledisable(document.querySelector('input[name=video_amount]'))"
                                    {{($consultant->video == 1)?'checked':''}} type="checkbox" value="1" id="Video"
                                    name="video" />
                                <label class="form-check-label" for="Video">
                                    Video
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect"
                                    id="inputGroup-sizing-default "></span>
                                <input type="number" onkeyup="courencyconveter()" value="{{$consultant->video_amount}}"
                                    {{($consultant->video != 1)?'disabled':''}} class="form-control" name="video_amount"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" />
                                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount
                                    {{ round($companySetting_country_price->country->currency->price * $consultant->video_amount,2) }}
                                    {{ $companeySetting->country->currency->currencycode }}</span>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-1">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox"
                                    onchange="enabledisable(document.querySelector('input[name=voice_amount]'))"
                                    {{($consultant->voice == 1)?'checked':''}} value="1" id="Voice" name="voice" />
                                <label class="form-check-label" for="Voice">
                                    Voice
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect"
                                    id="inputGroup-sizing-default "></span>
                                <input type="number" onkeyup="courencyconveter()" value="{{$consultant->voice_amount}}"
                                    {{($consultant->voice != 1)?'disabled':''}} class="form-control" name="voice_amount"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" />
                                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount
                                    {{ round($companySetting_country_price->country->currency->price * $consultant->voice_amount,2) }}
                                    {{ $companeySetting->country->currency->currencycode }}</span>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-1">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox"
                                    onchange="enabledisable(document.querySelector('input[name=text_amount]'))"
                                    {{($consultant->text == 1)?'checked':''}} value="1" id="Text" name="text" />
                                <label class="form-check-label" for="Text">
                                    Text
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect" id="inputGroup-sizing-default"></span>
                                <input type="number" onkeyup="courencyconveter()" value="{{$consultant->text_amount}}"
                                    {{($consultant->text != 1)?'disabled':''}} class="form-control" name="text_amount"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" />
                                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount
                                    {{ round($companySetting_country_price->country->currency->price * $consultant->text_amount,2) }}
                                    {{ $companeySetting->country->currency->currencycode }}</span>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-1">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox"
                                    onchange="enabledisable(document.querySelector('input[name=direct_amount]'))"
                                    {{($consultant->direct == 1)?'checked':''}} value="1" id="Direct" name="direct" />
                                <label class="form-check-label" for="Direct">
                                    Direct
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect"
                                    id="inputGroup-sizing-default "></span>
                                <input type="number" onkeyup="courencyconveter()" value="{{$consultant->direct_amount}}"
                                    {{($consultant->direct != 1)?'disabled':''}} class="form-control"
                                    name="direct_amount" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" />
                                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount
                                    {{ round($companySetting_country_price->country->currency->price * $consultant->direct_amount,2) }}
                                    {{ $companeySetting->country->currency->currencycode }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="fw-bolder text-dark">Commission</h2>
                <div class="form-group row">

                    <div class="col-6">
                        <div class="rounded border p-10">
                            <h4>Commission For Consultant Fee</h4>

                            <label class="required form-label fs-6 mb-2">Flat or Percentage</label>
                            <div class="form-check form-check-custom form-check-solid mb-5">
                                <input class="form-check-input me-3" name="com_con_type"
                                    onchange="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value)"
                                    type="radio" value="0" {{($consultant->com_con_type ==0)?'checked':''}}
                                    id="com_con_flat" />
                                <label class="form-check-label" for="com_con_flat">
                                    <div class="fw-bolder text-gray-800">Flat</div>
                                </label>
                                &nbsp;
                                <input class="form-check-input me-3" name="com_con_type"
                                    onchange="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value)"
                                    type="radio" value="1" {{($consultant->com_con_type ==1)?'checked':''}}
                                    id="com_con_per" />
                                <label class="form-check-label" for="com_con_per">
                                    <div class="fw-bolder text-gray-800">Percentage</div>
                                </label>
                            </div>
                            <label class="required form-label fs-6 mb-2">Commission Amount</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect"
                                    id="inputGroup-sizing-default "></span>
                                <input type="number"
                                    onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_con_type]:checked').value)"
                                    value="{{ $consultant->com_con_amount}}" class="form-control" name="com_con_amount"
                                    id="com_con_amount" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" />
                                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount
                                    {{ round($companySetting_country_price->country->currency->price * $consultant->com_con_amount,2) }}
                                    {{ $companeySetting->country->currency->currencycode }}</span>
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
                                                <td width="5%">Base currency
                                                    {{ $companeySetting->country->currency->currencycode }}</td>
                                                <td id="video_base"></td>
                                                <td id="voice_base"></td>
                                                <td id="text_base"></td>
                                                <td id="direact_base"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="rounded border p-10">
                            <h4>Commission For Offers</h4>

                            <label class="required form-label fs-6 mb-2">Flat or Percentage</label>
                            <div class="form-check form-check-custom form-check-solid mb-5">
                                <input class="form-check-input me-3" name="com_off_type"
                                    onchange="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value)"
                                    type="radio" value="0" {{($consultant->com_off_flat ==0)?'checked':''}}
                                    id="com_off_flat" />
                                <label class="form-check-label" for="com_off_flat">
                                    <div class="fw-bolder text-gray-800">Flat</div>
                                </label>
                                &nbsp;
                                <input class="form-check-input me-3" name="com_off_type"
                                    onchange="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value)"
                                    type="radio" value="1" {{($consultant->com_off_flat ==1)?'checked':''}}
                                    id="com_off_per" />
                                <label class="form-check-label" for="com_off_per">
                                    <div class="fw-bolder text-gray-800">Percentage</div>
                                </label>
                            </div>
                            <label class="required form-label fs-6 mb-2">Commission Amount</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text consultantcurrnect"
                                    id="inputGroup-sizing-default "></span>
                                <input type="number" class="form-control"
                                    onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_off_type]:checked').value)"
                                    value="{{ $consultant->com_off_amount}}" name="com_off_amount" id="com_off_amount"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" />
                                <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base Amount
                                    {{ round($companySetting_country_price->country->currency->price * $consultant->com_off_amount,2) }}
                                    {{ $companeySetting->country->currency->currencycode }}</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="rounded border p-10">
                                <h4>Payout Settings</h4>

                                <label class="required form-label fs-6 mb-2">Flat or Percentage</label>
                                <div class="form-check form-check-custom form-check-solid mb-5">
                                    <input class="form-check-input me-3" name="com_pay_type"
                                        onchange="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value)"
                                        type="radio" value="0" {{($consultant->com_pay_flat ==0)?'checked':''}}
                                        id="com_pay_flat" />
                                    <label class="form-check-label" for="com_pay_flat">
                                        <div class="fw-bolder text-gray-800">Flat</div>
                                    </label>
                                    &nbsp;
                                    <input class="form-check-input me-3" name="com_pay_type"
                                        onchange="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value)"
                                        type="radio" value="1" {{($consultant->com_pay_flat ==1)?'checked':''}}
                                        id="com_pay_per" />
                                    <label class="form-check-label" for="com_pay_per">
                                        <div class="fw-bolder text-gray-800">Percentage</div>
                                    </label>
                                </div>
                                <label class="required form-label fs-6 mb-2">Minimum Payout Amount</label>
                                <div class="input-group mb-5">
                                    <span class="input-group-text consultantcurrnect"
                                        id="inputGroup-sizing-default "></span>
                                    <input type="number" class="form-control"
                                        onkeyup="CourencyFlatconveter(document.querySelector('input[name=com_pay_type]:checked').value)"
                                        value="{{ $consultant->com_pay_amount}}" name="com_pay_amount"
                                        id="com_pay_amount" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-default" />
                                    <span class="input-group-text" id="inputGroup-sizing-default basecurrency">Base
                                        Amount
                                        {{ round($companySetting_country_price->country->currency->price * $consultant->com_pay_amount,2) }}
                                        {{ $companeySetting->country->currency->currencycode }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-sm float-end"
                            id="submit_consultant">Update</button>
                    </div>
                </div>
            </form>
            <div>
                <hr>
            </div>

            <form action="#" method="post" id="firm_individual">
                <div class="form-group row">
                    <div class="col-6">
                        <h3 class="fw-bolder text-dark">Firm / Individual</h3>

                        <div class="btn-group w-100 w-lg-50" data-kt-buttons="true"
                            data-kt-buttons-target="[data-kt-button]">
                            <label
                                class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success {{($consultant->type==1)?'active':''}}"
                                data-kt-button="true">
                                <input onchange="firm_type(1)" class="btn-check" type="radio" name="type"
                                    {{($consultant->type==1)?'checked':''}} value="1" />
                                Firm
                            </label>
                            <label
                                class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success {{($consultant->type==2)?'active':''}} "
                                data-kt-button="true">
                                <input onchange="firm_type(2)" class="btn-check" type="radio" name="type"
                                    {{($consultant->type==2)?'checked':''}} value="2" />
                                Individual
                            </label>
                        </div>

                        <div class="row" id="firmselectdiv">
                            <label class=" form-label fs-6 mb-2">Choose Firm</label>
                            <select required class="form-select form-select-solid" data-placeholder="Search option"
                                data-allow-clear="true" name="firm_choose" id="firm_choose">
                                <option value=""></option>
                                @foreach ($firm as $key => $fi)
                                <option data-image="{{ asset("storage/$fi->logo") }}"
                                    {{ ($consultant->firm_choose == $fi->id)?'selected':''}} value="{{ $fi->id }}">
                                    {{ $fi->comapany_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="row" hidden id="other">
                            <input type="text" name="other" id="other" class="form-control mb-2 mb-md-0"
                                placeholder="Enter Firm Name" />
                        </div>
                    </div>

                    <div class="col-6" hidden>

                        <div class="card bg-secondary ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                        <b>Firm: {!! isset($consultant->firm)? $consultant->firm->comapany_name:''
                                            !!}</b><br />
                                        City : {!! isset($consultant->firm->city)? $consultant->firm->city->city_name:''
                                        !!}
                                        State : {!! isset($consultant->firm->state)?
                                        $consultant->firm->state->state_name:'' !!}
                                        Country : {!! isset($consultant->firm->country)?
                                        $consultant->firm->country->country_name:'' !!}
                                        Zipcode : {{ $consultant->firm->zipcode??''}}
                                    </div>

                                    <div class="col-lg-2">
                                        <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/conversation.png')}}"
                                            alt="image" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-sm float-end" id="submit_firm">Update</button>
                    </div>
                </div>
            </form>
            <div>
                <hr>
            </div>

            <form action="#" method="post" id="category">
                <div class="form-group row">

                    <div class="col-lg-6">
                        <div class="rounded border p-10">
                            <h3>Category</h3>
                            <input type="hidden" name="categorie_id" id="categorie_id">
                            <div id="kt_docs_jstree_basic">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="rounded border p-10">
                            <h3>Specialization</h3>
                            <input type="hidden" name="specialized" id="specialized">
                            <div id="kt_docs_jstree_basic1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-sm float-end"
                            id="submit_category">Update</button>
                    </div>
                </div>

            </form>
            <div>
                <hr>
            </div>

            <form action="#" method="post" id="lang_insurance">
                <div class="form-group row">
                    <div class="col-lg-5">
                        <div class="rounded border p-10">
                            <h2 class="fw-bolder text-dark">Language</h2>
                            <select class="form-select form-select-solid form-control mb-2 mb-md-0"
                                data-control="select2" data-placeholder="Search option" data-allow-clear="true"
                                name="language" id="language" multiple="multiple">
                                @foreach ($language as $data)
                                <option value="{{ $data->id }}"
                                    {{(in_array($data->id,explode(',',$consultant->language)))?'selected':''}}>
                                    {{ $data->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="rounded border p-10">
                            <h3 class="fw-bolder text-dark">Insurance</h2>
                                <div class="col-12">
                                    <div class="btn-group w-100 w-lg-50" data-kt-buttons="true"
                                        data-kt-buttons-target="[data-kt-button]">
                                        <label
                                            class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success {{($consultant->insurancecheckbox==1 )? 'active':'' }}"
                                            data-kt-button="true">
                                            <input onchange="Insurance(1)" name="insurancecheckbox" class="btn-check"
                                                type="radio" value="1" />
                                            Yes
                                        </label>
                                        <label
                                            class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success  {{($consultant->insurancecheckbox==2 )? 'active':'' }}"
                                            data-kt-button="true">
                                            <input onchange="Insurance(2)" name="insurancecheckbox" class="btn-check"
                                                type="radio" value="2" />
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12" id="Insurancediv">
                                    <label class="form-label fs-6 mb-2">Select Insurance</label>
                                    <select class="form-select form-select-solid" data-placeholder="option"
                                        data-allow-clear="true" name="insurance_id" id="insurance_id"
                                        multiple="multiple">
                                        @foreach ($insurance as $value )
                                        <option data-image="{{ asset("storage/$value->logo") }}"
                                            {{($consultant->insurance_id == $value->id)?'selected':''}}
                                            value="{{ $value->id }}">{{ $value->comapany_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>

                    </div>

                    <div class="col-lg-7">

                        <h2 class="fw-bolder text-dark">Bank Details</h2>
                        <div class="form-group row">
                            <div class="col-6">
                                <label class="required form-label fs-6 mb-2">Account Number</label>
                                <input type="number" name="account_number" class="form-control form-control-solid mb-4"
                                    placeholder="Account Number" value="{{$consultant->account_number}}" required />

                            </div>
                            <div class="col-6">
                                <label class="required form-label fs-6 mb-2">Account Name</label>
                                <input type="text" name="account_name" class="form-control form-control-solid mb-4"
                                    placeholder="Account Name" value="{{$consultant->account_name}}" required />

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label class="required form-label fs-6 mb-4">IBAN Code / IFSC Code</label>
                                <input type="text" name="ifsc_code" class="form-control form-control-solid mb-4"
                                    placeholder="IBAN Code / IFSC Code" value="{{$consultant->ifsc_code}}" required />
                            </div>
                            <div class="col-6">
                                <label class="required form-label fs-6 mb-4">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control form-control-solid mb-4"
                                    placeholder="Bank Name" value="{{$consultant->bank_name}}" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label class="required form-label fs-6 mb-2">Branch</label>
                                <input type="text" name="branch" class="form-control form-control-solid mb-4"
                                    placeholder="Branch" value="{{$consultant->branch}}" required />

                            </div>
                            <div class="col-6 mt-12">
                                <input class="form-check-input me-3 " name="bank_status" type="checkbox"
                                    {{($consultant->bank_status==1)?'checked':''}} value="1" id="bank_status" />
                                <label class="form-check-label" for="bank_status">
                                    <div class="fw-bolder text-gray-800">verified</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-sm float-end" id="submit_other">Update</button>
                    </div>
                </div>
            </form>

            <div>
                <hr>
            </div>

            <div class="form-group row">
                <div class="col-2">
                    <div class=" card bg-secondary ">
                        <div class="card-body p-5">
                            <div class="div row">
                                <div class="col-2">
                                    <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/wallet.png')}}"
                                        alt="image" />
                                </div>
                                <div class="col">
                                    <b>{{ $consultant->wallet->balance ??'0'}}</b><br>
                                    Wallet Balence
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="card bg-secondary ">
                        <div class="card-body p-5">
                            <div class="div row">
                                <div class="col-2">
                                    <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/star.png')}}"
                                        alt="image" />

                                </div>
                                <div class="col">
                                    <b>{{ $rating ??''}} / 5</b><br>
                                    Rating
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class=" card bg-secondary ">
                        <div class="card-body p-5">
                            <div class="div row">
                                <div class="col-2">
                                    <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/calendar.png')}}"
                                        alt="image" />
                                </div>
                                <div class="col">
                                    <b>{{ $app_completed ??''}}</b><br>

                                    Appointment Completed
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <h3 class="fw-bolder text-dark">Recent Reviews</h2>
                        @foreach ($consultant->reviewForView as $review)
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        {{ date('d-m-Y', strtotime($review->created_at)) ??''}}<br />
                                        {{ $review->customer->name ??''}} {{ $review->customer->email}}<br>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/star.png')}}"
                                            alt="image" />
                                        {{ $review->rating ??''}}
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                </div>

            </div>

            {{-- card body close --}}
        </div>
        {{-- card  close --}}
    </div>
    {{-- tab close  --}}
</div>
