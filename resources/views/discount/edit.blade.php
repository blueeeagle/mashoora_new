<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Discount</h1>
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
                        <li class="breadcrumb-item text-muted">Category</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('other.discount.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
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
                        <form action="{{ route('other.discount.update',$discount->id) }}" method="post" id="formEdit">
                            @csrf
                            <div class="py-5">
                                <div class="p-10">
                                      <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Choose Consultant<span class="text-danger">*</span></label>
                                        <select class="form-select" name="consultant_id" id="consultant_id" data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @foreach($consultants as $consultant)
                                                <option {{ ($discount->consultant_id ==  $consultant->id)?'selected':'' }}  data-price="{{ $consultant->country->currency->price }}" data-voice-yes="{{ $consultant->voice }}" data-video-yes="{{ $consultant->video }}" data-text-yes="{{ $consultant->text }}" data-direact-yes="{{ $consultant->direct }}" data-direact="{{ $consultant->direct_amount }}" data-text="{{ $consultant->text_amount }}" data-voice="{{ $consultant->voice_amount }}" data-video="{{ $consultant->video_amount }}" data-currency="{{ $consultant->country->currency->countrycode }}" value="{{$consultant->id}}">{{$consultant->name}} / {{$consultant->country_code}} {{$consultant->phone_no}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mb-2" >Promo Title</label>
                                        <input type="text" name="promo_title" class="form-control" placeholder="Promo Title" value="{{$discount->promo_title}}" required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mb-2" >Promo Code</label>
                                        <input type="text" name="promo_code" class="form-control" placeholder="Promo Code" value="{{$discount->promo_code}}"required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mb-2" >No of Coupons<span class="text-danger">*</span><br><small>If zero means unlimited </small></label>
                                        <input type="number" name="no_of_coupons" class="form-control" placeholder="No of Coupons" value="{{$discount->no_of_coupons}}"required/>
                                    </div>
                                    <div class="col-md-6">
                                        @include('components.imagecrop',['name'=>'image','imgsrc'=>$discount->image])
                                    </div>
                                    <div class="col-md-6">

                                        <label class="form-label fs-6 mb-2" >Flat or Percentage</label>
                                          <div class="row">
                                        <div class="form-check form-check-custom form-check-solid mb-5 col-md-6">
                                            <input class="form-check-input me-3" name="flat_percentage" onclick="validateamount()"  {{ ($discount->flat_percentage == 0)?'checked':'' }} type="radio" checked  value="0" id="flat" />
                                            <label class="form-check-label" for="flat">
                                                <div class="fw-bolder text-gray-800">Flat</div>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid mb-5 col-md-6">
                                            <input class="form-check-input me-3" onclick="validateamount()" name="flat_percentage" {{ ($discount->flat_percentage == 1)?'checked':'' }} type="radio" value="1" id="percentage" />
                                            <label class="form-check-label" for="percentage">
                                                <div class="fw-bolder text-gray-800">percentage</div>
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mb-2" >Amount</label>
                                        <div class="input-group  mb-5">
                                            <span class="input-group-text base_curency" id="base_curency">{{ ($discount->flat_percentage == 1)?'%':$discount->consultant->country->currency->currencycode }}</span>
                                            <input type="number" name="amount" id="amount" onkeyup="validateamount()" class="form-control" placeholder="Amount" value="{{$discount->amount}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label " >From Date</label>
                                        <input class="form-control form-control-solid" name="from_date" id="from_date"  placeholder="From Date"  value="{{$discount->from_date}}" required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label " >To Date</label>
                                        <input class="form-control form-control-solid" name="to_date" id="to_date"  placeholder="To Date"  value="{{$discount->to_date}}" required/>
                                    </div>
                                    @php
                                        $id = explode(',',$discount->category_id);
                                    @endphp
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Choose Category<span class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id[]" id="category_id" data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @if($Category)
                                                <option {{ (in_array($Category->id,$id))?'selected':'' }} value="{{$Category->id}}">{{$Category->name}}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="subcat_div"{{ (count($subcategory) > 0)?'':'hidden' }}>
                                        <label for="" class="form-label">Choose Subcategory<span class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id[]" id="subcat_id" multiple data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @foreach ($subcategory as $sub)
                                                <option {{ (in_array($sub->id,$id))?'selected':'' }} value="{{$sub->id}}">{{$sub->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12" >
                                        <label class="form-label fs-6 mb-2" >Applicable for</label>
                                        @php
                                            $consultant = $discount->consultant;
                                            $consultant_currency =    $discount->consultant->country->currency;
                                            $admin = $companeySetting->country->currency;
                                        @endphp
                                        <div class=''>
                                            <div class="row">
                                                <div class="col-md-3" id="video_div" {{ ($consultant->video == 1)?'':'hidden' }} >
                                                    <label class="custom-control-label" for="customSwitch1">Video </label>
                                                    <input class='form-check-input' name="video" type='checkbox' value='1' {{ ($discount->video == 1)?'checked':'' }} />
                                                    <label class="custom-control-label" for="customSwitch1"><span id="video">{{ $consultant->video_amount }} {{ $consultant_currency->currencycode }} / {{ round((($consultant->video_amount/$consultant_currency->price)*$admin->price),2) }} {{ $admin->currencycode }}</span></label>
                                                </div>
                                                <div class="col-md-3" id="voice_div" {{ ($consultant->voice == 1)?'':'hidden' }}>
                                                    <label class="custom-control-label"  for="customSwitch1">Voice</label>
                                                    <input class='form-check-input' name="voice" type='checkbox' value='1' {{ ($discount->voice == 1)?'checked':'' }} />
                                                    <label class="custom-control-label" for="customSwitch1"><span id="voice">{{ $consultant->voice_amount }} {{ $consultant_currency->currencycode }} / {{ round((($consultant->voice_amount/$consultant_currency->price)*$admin->price),2) }} {{ $admin->currencycode }}</span></label>
                                                </div>
                                                <div class="col-md-3" id="text_div" {{ ($consultant->text == 1)?'':'hidden' }}>
                                                    <label class="custom-control-label" for="customSwitch1">Text</label>
                                                    <input class='form-check-input' name="text" type='checkbox' value='1' {{ ($discount->text == 1)?'checked':'' }} />
                                                    <label class="custom-control-label" for="customSwitch1"><span id="text">{{ $consultant->text_amount }} {{ $consultant_currency->currencycode }} / {{ round((($consultant->text_amount/$consultant_currency->price)*$admin->price),2) }} {{ $admin->currencycode }}</span></label>
                                                </div>
                                                <div class="col-md-3" id="direct_div" {{ ($consultant->direct == 1)?'':'hidden' }}>
                                                    <label class="custom-control-label" for="customSwitch1">Direct</label>
                                                    <input class='form-check-input' name="direct" type='checkbox' value='1' {{ ($discount->direct == 1)?'checked':'' }} />
                                                    <label class="custom-control-label" for="customSwitch1"><span id="direct">{{ $consultant->direct_amount }} {{ $consultant_currency->currencycode }} / {{ round((($consultant->direct_amount/$consultant_currency->price)*$admin->price),2) }} {{ $admin->currencycode }}</span></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                       </div>
                                    <div class="form-group row" style="float:right;">
                                    <div class="mb-10">
                                        <button type="submit" class="btn btn-primary btn-hover-rise me-5">Save</button>
                                    </div>
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
    <script>
        var category_id  = $('#category_id');
        var subcat_id  = $('#subcat_id');
        const yesterday = new Date();
        var BasicDetails = null
        const admin_country = {!! json_encode($companeySetting->country->currency) !!}
        yesterday.setDate(yesterday.getDate() - 1);
        const subcat_div = document.getElementById('subcat_div')
        var current = new Date($('#from_date').val())


        $("#consultant_id").on('select2:select', function (e) {
                var data = e.params.data;
                let dataset = e.params.data.element.dataset;
                document.getElementById("video"). innerHTML = `${dataset.voice} ${dataset.currency} / ${Number((dataset.voice/dataset.price)*admin_country.price).toFixed(2)} {{ $companeySetting->country->currency->currencycode }}`;
                document.getElementById("voice"). innerHTML = `${dataset.video} ${dataset.currency} / ${Number((dataset.video/dataset.price)*admin_country.price).toFixed(2)} {{ $companeySetting->country->currency->currencycode }}`;
                document.getElementById("text"). innerHTML = `${dataset.text} ${dataset.currency} / ${Number((dataset.text/dataset.price)*admin_country.price).toFixed(2)} {{ $companeySetting->country->currency->currencycode }}`;
                document.getElementById("direct"). innerHTML = `${dataset.direact} ${dataset.currency} / ${Number((dataset.direact/dataset.price)*admin_country.price).toFixed(2)} {{ $companeySetting->country->currency->currencycode }}`;
                document.getElementById("base_curency").textContent = dataset.currency;
                BasicDetails = dataset.currency
                if(dataset.videoYes == "1") document.getElementById('video_div').hidden = false; else document.getElementById('video_div').hidden = true;
                if(dataset.direactYes == "1") document.getElementById('direct_div').hidden = false; else document.getElementById('direct_div').hidden = true;
                if(dataset.textYes == "1") document.getElementById('text_div').hidden = false; else document.getElementById('text_div').hidden = true;
                if(dataset.voiceYes == "1") document.getElementById('voice_div').hidden = false; else document.getElementById('voice_div').hidden = true;

                $.ajax({
                    url:"{{route('other.discount.getConsultant')}}",
                    method:"POST",
                    data:{id:data.id,"_token": "{{ csrf_token() }}",},
                    success:function(data){
                        let option = ``
                        if(data.Category){
                            option += '<option selected value='+data.Category.id+'>'+data.Category.name+'</option>';
                        }
                        category_id.html(option).trigger("change");
                        option = ``
                        if(data.subCategort.length > 0){
                            subcat_div.hidden = false;
                            subcat_id.attr('required', true);
                            data.subCategort.forEach((e)=>{
                                option += '<option value='+e.id+'>'+e.name+'</option>';
                            })
                        }else{
                            subcat_div.hidden = true;
                            subcat_id.removeAttr('required');
                        }
                        subcat_id.html(option).trigger("change");

                    }
                    })
                })
        var From_DateFlatpickr = flatpickr("#from_date", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate : `{{ date('Y-m-d') }}`,
                onChange : function(selectedDates, dateStr, instance){
                    To_DateFlatpickr.set({minDate:selectedDates[0]})
                }
            })
            
            var To_DateFlatpickr = flatpickr('#to_date', {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate : `{{$discount->from_date}}`
            });

        function formatDate(date) {
            return [
                padTo2Digits(date.getMonth() + 1),
                padTo2Digits(date.getDate()),
                date.getFullYear(),
            ].join('/');
        }
        function padTo2Digits(num) {
            return num.toString().padStart(2, '0');
        }

        function validateamount(){
            const Amount = document.getElementById('amount');
            if($('[name="flat_percentage"]:checked').val() == 1){
                if(Amount.value >100) Amount.value = 100
                document.getElementById("base_curency").textContent = '%';
            }else{
                document.getElementById("base_curency").textContent = BasicDetails;
            }
        }

        back = `{{ route('other.discount.index') }}`
        $(document).ready(function () {
            back = `{{ route('other.discount.index') }}`
        })


    </script>
    @endsection
</x-base-layout>
