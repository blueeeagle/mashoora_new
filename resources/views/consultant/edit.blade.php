<x-base-layout>
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">consultant</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">consultant</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"><a href="{{ route('consultant.consultant.index') }}" class="text-muted text-hover-primary">consultant</a></li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">View consultant</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="container-xxl">
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_tab_pane_1" >DashBoad</a> {{--   href="{{ route('consultant.consultant.edit',$consultant->id) }} --}}
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_2">Calender</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_3">Scheduling</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_4">Appointments History</a>
                    </li>
                      <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_5">Offer History</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_6">Promo Purchase History</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_7">Wallet & Transaction</a>
                   </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_8">Review & Ratings</a>
                  
                  
                </ul>
                <!--begin::Navs-->
            </div>
        </div>

        

        

        <div class="tab-content" id="myTabContent">
            {{-- Tab 1 --}}
            
          
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/300-1.jpg')}}" alt="image" />
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                                </div>
                
                               
                            </div>
                            <div class="col-lg-8">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $consultant->name }}</a>
                                <a href="#">
                                    @if($consultant->approval == 1)
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                            <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                        </svg>
                                    </span>
                                    @endif
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-sm btn-light-{{ ($consultant->approval == 0)?'danger':'success'  }} fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">{{ ($consultant->approval == 0)?'Waiting for Approval':'Approved' }}</a>
                                {{-- gender --}}
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">Gender : {{ ($consultant->gender ==1)?'Male':'Female'}}</span>
                                </div>
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">Year of Experience : {{ $consultant->exp_year }}</span>
                               </div>
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">Address :  {{ $consultant->register_address }}</span>  
                                </div>
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">Country :  {!! ($consultant->country)? $consultant->country->country_name:'' !!}</span>  
                                </div>
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">State :  {!! ($consultant->state)? $consultant->state->state_name:'' !!}</span>  
                                </div>
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">City :  {!! ($consultant->city)? $consultant->city->city_name:'' !!}</span>  
                                </div>
                                <div><hr></div>
                                <div class="form-group row">
                                    <div class="col-lg-6 d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                        <span class="fw-bolder">Email :  {!! $consultant->email !!}</span> 
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                        <span class="fw-bolder fs-6">Phone :  {!! $consultant->phone_no !!}</span>  
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div><hr></div>
                        <div class="form-group row">
                            <div class="col-lg-11 d-flex  justify-content-center ">
                                <span class="fw-bolder">Bio :  {!! $consultant->bio_data !!}</span> 
                            </div>
                        </div>
                        <div><hr></div>

                        <div class="form-group row"  >
                            <div class="col-sm-12"> 
                                <div class="container" >
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <div class=" card text-black bg-secondary " style="width: 15rem;">
                                                <div class="card-body">
                                                    <div class="div">
                                                        <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/wallet.png')}}" alt="image" />
                                                        Wallet Balence
                                                    </div>
                                        
                                                </div>
                                            </div>
                                            <div> <br>
                                        </div>

                                        <div class="card border-success bg-light " >
                                            <div class="card-body">
                                                 <div class="col-lg-6 d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                                    <span class="fw-bolder fs-6">Firm  :  {!! isset($consultant->firm)? $consultant->firm->comapany_name:'' !!}</span>  
                                                    <span class="fs-6">City  :  {!! isset($consultant->firm->city)? $consultant->firm->city->city_name:'' !!}</span>  
                                                    <span class="fs-6">State  :  {!! isset($consultant->firm->state)? $consultant->firm->state->state_name:'' !!}</span>  
                                                    <span class="fs-6">Country  :  {!! isset($consultant->firm->country)? $consultant->firm->country->country_name:'' !!}</span>  
                                                    <span class="fs-6">Zipcode  :  {{ $consultant->firm->zipcode??''}}</span>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="card text-black bg-secondary " style="width: 10rem;">
                                            <div class="card-body">
                                                <div class="div">
                                                    <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/star.png')}}"  alt="image" />
                                                Rating
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3" style="border-right-style: solid; border-width: 1px;">
                                        <div class="card text-black bg-secondary " style="width: 15rem;">
                                            <div class="card-body">
                                                <div class="div">
                                                    <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/calendar.png')}}"  alt="image" />
                                                Appointment Completed
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        
                                        <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3" {{ (isset($consultant->video_amount))? '':'hidden'}}>
                                            <div class="div">
                                                <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/video.png')}}"  alt="image" />
                                                <span class="fw-bolder fs-6">  Consultant Fee :  {!! $consultant->video_amount !!}  {{ $companeySetting->country->currency->currencycode }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3" {{(isset($consultant->text_amount))? '':'hidden'}}>
                                            <div class="div">
                                                <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/chat.png')}}"  alt="image" />
                                                <span class="fw-bolder fs-6">  Consultant Fee :  {!! $consultant->text_amount !!}  {{ $companeySetting->country->currency->currencycode }}</span> 
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                            <div class="div">
                                                <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/conversation.png')}}"  alt="image" />
                                                <span class="fw-bolder fs-6">  Consultant Fee :  {!! $consultant->direct_amount !!}  {{ $companeySetting->country->currency->currencycode }}</span> 
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                            <div class="div">
                                                <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/voice.png')}}"  alt="image" />
                                                <span class="fw-bolder fs-6">  Consultant Fee :  {!! $consultant->voice_amount !!} {{ $companeySetting->country->currency->currencycode }}</span> 
                                            </div>
                                        </div> 
                                    </div>
                                    {{-- container close --}}

                                </div>
                            </div>
                        </div>
                        <div><hr></div>

                        <div class="form-group row" >
                            <div class="col-lg-5" style="border-right-style: solid; border-width: 1px;" >
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">Category & Specialization</span>
                                   
                                    @foreach ($viewCategory as $key => $value)
                                        <ul>
                                            <li>{!! $value->name !!}</li> 
                                             
                                            @if(isset($value->child))
                                                @foreach ($value->child as $val)  
                                                    <ul>
                                                        <li>
                                                            {!! $val->name !!}
                                                        </li>
                                                        @if(isset($value->spec))
                                                            <li>
                                                                {!! $value->spec->title!!}
                                                            </li>
                                                        @endif
                                                    </ul>   
                                                 @endforeach 
                                            @endif                                           
                                        </ul> 
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-3" style="border-right-style: solid; border-width: 1px;" >
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">Language Known</span>
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-12">
                                        <span class="fw-bolder fs-6">@foreach($lang as $data) {{ $data->title ??''}}  @endforeach </span>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="d-flex align-items-left w-200px w-sm-300px flex-column mt-3">
                                    <span class="fw-bolder fs-6">Recent Reviews</span>
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-12">
                                        <div class="div">
                                            <img src="{{ URL::asset(theme()->getDemo().'/media/avatars/star.png')}}"  alt="image" />
                                        Rating
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div><hr></div>
                        
                        <div class="form-group row" >
                            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-12">
                                <span class="fw-bolder">Insurance</span>
                            </div>

                            <div class="container" >
                                <div class="form-group row">
                                    @foreach($insurance as $data)
                                        <span class="fw-bolder fs-6">{!! $data->comapany_name !!}</span>
                                    @endforeach 
                                </div>
                            </div>

                        </div>
                        <div><hr></div>
                    
                        <div class="form-group row" >
                            <div class="col text-center">
                                <span class="fw-bolder">Account Info.</span>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-12">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="fw-bolder fs-6">Bank Account No:</span> {!! $consultant->account_number !!}
                                        <p class="fs-6">Account Holder Name: {!! $consultant->account_name !!}</p>
                                        <p class=" fs-6">IFSC Code: {!! $consultant->ifsc_code !!}</p>
                                        <p class=" fs-6">Branch: {!! $consultant->branch !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- card body close --}}
                    </div>
                    {{-- card  close --}}
                </div>
            </div>
            {{-- tab close  --}}
        </div>
                        {{-- <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $consultant->name }}</a>
                                        <a href="#">
                                            @if($consultant->approval == 1)
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                    <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                                    <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                                </svg>
                                            </span>
                                            @endif
                                            <!--end::Svg Icon-->
                                        </a>
                                        <a href="#" class="btn btn-sm btn-light-{{ ($consultant->approval == 0)?'danger':'success'  }} fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">{{ ($consultant->approval == 0)?'Waiting for Approval':'Approved' }}</a>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$">0</div>
                                            </div>
                                            <div class="fw-bold fs-6 text-gray-400">Earnings</div>
                                        </div>
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                        <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="75">0</div>
                                            </div>
                                            <div class="fw-bold fs-6 text-gray-400">Projects</div>
                                        </div>
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
                                            </div>
                                            <div class="fw-bold fs-6 text-gray-400">Success Rate</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        <span class="fw-bold fs-6 text-gray-400">Profile Compleation</span>
                                        <span class="fw-bolder fs-6">11 of {{ $consultant->step }} Steps</span>
                                    </div>
                                    <div class="h-5px mx-3 w-100 bg-light mb-3">
                                        <div class="bg-success rounded h-5px" role="progressbar" style="width: {{ ($consultant->step/11)*100 }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                            <span class="fw-bolder fs-6">Gender : Male</span>
                                        </div>
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                            <span class="fw-bolder fs-6">Year of Experience : {{ $consultant->exp_year }}</span>
                                        </div>
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                            <span class="fw-bolder fs-6">Phone : {{ $consultant->phone_no }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-12">
                                            <span class="fw-bolder fs-6">Bio Data : {{ $consultant->bio_data }}</span>
                                        </div>
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-12">
                                            <span class="fw-bolder fs-6">Address : {{ $consultant->register_address }}</span>
                                        </div>
                                       
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Profile Details</h3>
                        </div>
                        {{-- <a href="../../demo1/dist/account/settings.html" class="btn btn-primary align-self-center">Edit Profile</a> 
                    </div>
                    <div class="card-body p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Full Name</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $consultant->name }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Email</label>
                            <div class="col-lg-8 fv-row">
                                <a href="mailto:{{ $consultant->email }}"><span class="fw-bold text-gray-800 fs-6">{{ $consultant->email }}</span></a>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Contact Phone
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i></label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <a href="tel:{{ $consultant->phone_no }}"><span class="fw-bolder fs-6 text-gray-800 me-2">{{ $consultant->phone_no }}</span>
                                <span class="badge badge-success">Verified</span></a>
                            </div>
                            @if($consultant->landline)
                                <label class="col-lg-4 fw-bold text-muted"></label>
                                <a href="tel:{{ $consultant->landline }}"><span class="fw-bolder fs-6 text-gray-800 me-2">{{ $consultant->landline }}</a>
                            @endif
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Bio Data</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{!! $consultant->bio_data !!}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Country
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ ($consultant->country)?$consultant->country->country_name:'' }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">State
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="State of origination"></i></label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ ($consultant->state)?$consultant->state->state_name:'' }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">City
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="City of origination"></i></label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ ($consultant->city)?$consultant->city->city_name:'' }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Zipcode
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Zipcode of origination"></i></label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $consultant->zipcode }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gy-5 g-xl-10">
                    <div class="col-xl-4">
                        <div class="card card-flush h-xl-100">
                            <div class="card-body">
                                <div class="hover-scroll-overlay-y pe-6 me-n6">
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <div class="d-flex flex-stack">
                                            <span class="text-gray-400 fw-bolder">
                                            <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Video</a></span>
                                            <span class="badge badge-light-success">{{ $consultant->video_amount }}</span>
                                        </div>
                                    </div>
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <div class="d-flex flex-stack">
                                            <span class="text-gray-400 fw-bolder">
                                            <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Text</a></span>
                                            <span class="badge badge-light-success">{{ $consultant->text_amount }}</span>
                                        </div>
                                    </div>
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <div class="d-flex flex-stack">
                                            <span class="text-gray-400 fw-bolder">
                                            <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Voice</a></span>
                                            <span class="badge badge-light-success">{{ $consultant->voice_amount }}</span>
                                        </div>
                                    </div>
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <div class="d-flex flex-stack">
                                            <span class="text-gray-400 fw-bolder">
                                            <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Direact</a></span>
                                            <span class="badge badge-light-success">{{ $consultant->direct_amount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        

            {{-- Tab 2 calendar--}}
            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                {{-- @include('schedule.appointment',['consultant'=>$consultant]) --}}
            </div>

            {{-- Tab 3 Scheduling --}}
            <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                <div id="kt_content_container" class="container-xxl">
                    <div class="row gy-10 gx-xl-10">
                        <div class="card card-docs flex-row-fluid mb-2">
                            <table id="kt_datatable3" class="table table-row-bordered gy-5">
                                <thead>
                                    <tr class="fw-bold fs-6 text-muted">
                                        <th>SNo</th>
                                        <th>Create Date</th>
                                        <th>schedule From - To</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>SNo</th>
                                        <th>Create Date</th>
                                        <th>schedule From - To</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tab 4  Appointment History --}}


            <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                <div>Past/Current/Upcoming History</div>
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        <div class="row gy-10 gx-xl-10">
                            <div class="card card-docs flex-row-fluid mb-2">
                                <table id="kt_datatable4" class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th>SNo</th>
                                            <th>Date and Time</th>
                                            <th>Transaction ID</th>
                                            <th>Purchased By</th>
                                            <th>Purchased with</th>
                                            <th>XX USD</th>
                                            <th>Discount Amount</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SNo</th>
                                            <th>Date and Time</th>
                                            <th>Transaction ID</th>
                                            <th>Purchased By</th>
                                            <th>Purchased with</th>
                                            <th>XX USD</th>
                                            <th>Discount Amount</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 5  Offer History --}}
            <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        
                        <div class="row gy-10 gx-xl-10">
                            <div class="card card-docs flex-row-fluid mb-2">
                                <table id="kt_datatable5" class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th>SNo</th>
                                            <th>Date and Time</th>
                                            <th>Transaction ID</th>
                                            <th>Purchased By</th>
                                            <th>Purchased with</th>
                                            <th>Offer Title</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SNo</th>
                                            <th>Date and Time</th>
                                            <th>Transaction ID</th>
                                            <th>Purchased By</th>
                                            <th>Purchased with</th>
                                            <th>Offer Title</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 6 Promo Purchase History --}}
            <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        <div class="row gy-10 gx-xl-10">
                            <div class="card card-docs flex-row-fluid mb-2">
                                <table id="kt_datatable6" class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th>SNo</th>
                                            <th>Date and Time</th>
                                            <th>Booking ID</th>
                                            <th>Appointment Booked By</th>
                                            <th>Appointment Booked with</th>
                                            <th>XX USD</th>
                                            <th>XX USD Discount</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SNo</th>
                                            <th>Date and Time</th>
                                            <th>Booking ID</th>
                                            <th>Appointment Booked By</th>
                                            <th>Appointment Booked with</th>
                                            <th>XX USD</th>
                                            <th>XX USD Discount</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              {{-- Tab 7 Wallet --}}
              <div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        
                        <div class="row gy-10 gx-xl-10">
                            <div class="card card-docs flex-row-fluid mb-2">
                                <table id="kt_datatable7" class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                         
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 8 Review &Rating--}}
            <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        
                        <div class="row gy-10 gx-xl-10">
                            <div class="card card-docs flex-row-fluid mb-2">
                                <table id="kt_datatable8" class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th>SNo</th>
                                            <th>Date and Time</th>
                                            <th>Booking ID</th>
                                            <th>Appointment Booked By</th>
                                            <th>Appointment Booked with</th>
                                            <th>XX USD</th>
                                            <th>XX USD Discount</th>
                                            <th>Amount</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SNo</th>
                                            <th>Date and Time</th>
                                            <th>Booking ID</th>
                                            <th>Appointment Booked By</th>
                                            <th>Appointment Booked with</th>
                                            <th>XX USD</th>
                                            <th>XX USD Discount</th>
                                            <th>Amount</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        
            {{-- <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div> --}}
    </div>


    @section('scripts')
<script>

    var table1,table2,table3,table4 = null

    $(document).ready(function () {
        // Scheduling

        table1 = $("#kt_datatable3").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('activities.schedules.getscheduleDatatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : `{{ $consultant->id }}`,
                    columnsDef : ['id','created_at','fromto','scheduleType']
                }

            },
            columns: [
                { data: 'DT_RowIndex'},
                { data: 'created_at' },
                { data: 'fromto' },
                { data: 'scheduleType' },
                { data: 'action'}
            ],
            columnDefs : [
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                            <a href="${data.Delete}" delete_calender class="btn btn-icon btn-danger"><i href="${data.Delete}" delete class="las la-trash fs-2 me-2"></i></a>
                        `;
                    },
                },
            ],
            drawCallback : function( settings ) { }
        });

        // Appointment
        table2 = $("#kt_datatable4").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('history.appointment.datatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    columnsDef : ['id','title','updated_at','status']
                }

            },
            columns: [
                { data: 'DT_RowIndex'},
                { data: 'created_at'},
                { data: 'booking_id'},
                { data: 'app_booked_by'},
                { data: 'app_booked_with'},
                { data: 'xx_usd'},
                { data: 'discount_amount'},
                { data: 'amount'},
                { data: 'status'}
            ],
           
            drawCallback : function( settings ) { }
        });

        // Offer History
        table3 = $("#kt_datatable5").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('history.offer.datatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    columnsDef : ['id','title','updated_at','status']
                }

            },
            columns: [
                { data: 'DT_RowIndex'},
                { data: 'created_at'},
                { data: 'trans_id'},
                { data: 'purchased_by'},
                { data: 'purchased_with'},
                { data: 'offer_title'},
                { data: 'amount'},
                { data: 'status'}
            ],
           
            drawCallback : function( settings ) { }
        });

        // Promo History

        table4 = $("#kt_datatable6").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('history.purchase.datatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    columnsDef : ['id','title','updated_at','status']
                }

            },
            columns: [
                { data: 'DT_RowIndex'},
                { data: 'created_at'},
                { data: 'booking_id'},
                { data: 'app_booked_by'},
                { data: 'app_booked_with'},
                { data: 'xx_usd'},
                { data: 'discount_amount'},
                { data: 'amount'},
                { data: 'status'}
            ],
           
            drawCallback : function( settings ) { }
        });

        // Wallet
        table5 = $("#kt_datatable7").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('consultant.consultant.wallet.index')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    columnsDef : ['id','title','updated_at','status']
                }

            },
            columns: [
                { data: 'date_time'},
                { data: 'type'},
                { data: 'account_name'},
                { data: 'consultant_id'},
                { data: 'done_by'},
                { data: 'amount'},
                { data: 'balance'},
                { data: 'status'},
               
            ],
           
            drawCallback : function( settings ) { }
        });

        // Review & Rating
        table5 = $("#kt_datatable8").DataTable({
            responsive: true,
            buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 100],

            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('review.datatable')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    columnsDef : ['id','title','updated_at','status']
                }

            },
            columns: [
                { data: 'DT_RowIndex'},
                { data: 'created_at'},
                { data: 'booking_id'},
                { data: 'app_booked_by'},
                { data: 'app_booked_with'},
                { data: 'xx_usd'},
                { data: 'discount_amount'},
                { data: 'amount'},
                { data: 'rating'},
                { data: 'action'}
            ],
           
            drawCallback : function( settings ) { }
        });

    });
</script>

@endsection
</x-base-layout>
