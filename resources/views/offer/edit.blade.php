<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Offer</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Offer</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('other.offer.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <form action="{{ route('other.offer.update',$offer->id) }}" method="post" id="formEdit">
                            @csrf

                            <div class="py-5">
                                <div class="p-10">
                                     <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="required fw-bold fs-6 mb-3">Firm or Consultant Offer</label>
                                        <div class="d-flex flex-column fv-row">
                                             <div class="row">
                                            <div class="form-check form-check-custom form-check-solid mb-5 col-md-6">
                                                <input class="form-check-input me-3" name="firm_consultant"  type="radio" checked  value="0" id="kt_docs_formvalidation_radio_option_1" {{ ($offer->firm_consultant == 0)?'checked':'' }} />
                                                <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                                    <div class="fw-bolder text-gray-800">Firm</div>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid mb-5 col-md-6">
                                                <input class="form-check-input me-3" name="firm_consultant" type="radio" value="1" id="kt_docs_formvalidation_radio_option_2" {{ ($offer->firm_consultant == 1)?'checked':'' }}/>
                                                <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                                                    <div class="fw-bolder text-gray-800">Consultant</div>
                                                </label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="selecterdiv" {{ ($offer->firm_consultant == 1)?'hidden':'' }}>
                                        <label for="" class="form-label">Choose firm<span class="text-danger">*</span></label>
                                        <select class="form-select" name="firm_id" id="firm_id" {{ ($offer->firm_consultant == 1)?'':'required' }}  data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @foreach($firm as $firm)
                                                <option {{ ($offer->firm_id ==  $firm->id)?'selected':'' }} value="{{$firm->id}}">{{$firm->comapany_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Choose Consultant<span class="text-danger">*</span></label>
                                        <select class="form-select" name="consultant_id" id="consultant_id" required data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @foreach($consultant as $consul)
                                                <option data-value="{{$consul->categorie_id}}" value="{{$consul->id}}" {{ ($offer->consultant_id ==  $consul->id)?'selected':'' }}>{{$consul->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-bold fs-6 mb-2">Offer Title</label>
                                        <input type="text" name="offer_title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Offer Title" required value="{{ $offer->offer_title}}"/>
                                    </div>

                                    <div class="col-md-6">
                                        @include('components.imagecrop',['name'=>'image','imgsrc'=>$offer->image])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="required fw-bold fs-6 mb-2">Description</label>
                                        <textarea  name="description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Description" required >{{ $offer->description}}</textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="required fw-bold fs-6 mb-2">Amount</label>
                                        <div class="input-group  mb-5">
                                            <span class="input-group-text base_curency" id="base_curency">{{$offer->consultant->country->currency->currencycode}}</span>
                                            <input type="number" name="amount" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Amount" required value="{{ $offer->amount}}"/>
                                         </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" form-check-label" for="has_validity">
                                            <div class="fw-bolder text-gray-800">Has Validity</div>
                                        </label>
                                        <input class="form-check-input me-3" name="has_validity" type="checkbox" value="1" id="has_validity" {{ ($offer->has_validity == 1)?'checked':'' }}/>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label " >From Date<span class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid" name="from_date" id="from_date"  placeholder="From Date"  value="{{ $offer->from_date}}"required/>
                                    </div>
                                    <div class="col-md-6" id="valid_date">
                                        <label class="form-label " >To Date<span class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid" name="to_date" id="to_date"  placeholder="To Date" value="{{ $offer->to_date}}" required/>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="" class="form-label">Main Category<span class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id[]" id="category_id" required data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            <option  value="{{$category->id}}" selected>{{$category->name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="subcat_div" {{ (count($sub_category) > 0)?'':'hidden' }}>
                                        <label for="" class="form-label">Sub Category<span class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id[]" id="sub_category_id" data-control="select2" multiple data-placeholder="Select an option">
                                            @php
                                                $sub_category_id = explode(',',$offer->category_id);
                                            @endphp
                                            <option></option>
                                                @foreach($sub_category as $sub_cat)
                                                    <option data-value="{{$sub_cat->categorie_id}}" value="{{$sub_cat->id}}" {{ (in_array($sub_cat->id,$sub_category_id))?'selected':'' }}>{{$sub_cat->name}}</option>
                                                @endforeach
                                        </select>
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
        back = "{{ route('other.offer.index') }}"

        window.onload = function() {
            const selecterdiv = document.getElementById('selecterdiv')
            const firm_id = document.getElementById('firm_id')
            const consultant_id = document.getElementById('consultant_id')
            const category_id = document.getElementById('category_id')
            const sub_category_id = document.getElementById('sub_category_id')
            const subcat_div = document.getElementById('subcat_div')
            const base_curency = document.getElementById('base_curency')

            var RadioButton =  [...document.querySelectorAll('input[name=firm_consultant]')];

            RadioButton.forEach(element => {
                element.addEventListener('click',showhideParent)
            });

            function loadConsultant(){
                const firm_type = document.querySelector('input[name=firm_consultant]:checked').value
                const firm = $(firm_id).val()
                $.ajax({
                    url:"{{route('other.offer.getconsultant')}}",
                    method:"POST",
                    data:{firm:firm,firm_type:firm_type,"_token": "{{ csrf_token() }}",},
                    success:function(data){
                        let option = '<option></option>'
                        if(data.consultant.length > 0){
                            data.consultant.forEach((e)=>{ option += '<option data-currencycode='+e.country?.currency.currencycode+' value='+e.id+'>'+e.name+' / '+e.country_code+' '+e.phone_no+'</option>'; })
                        }
                        $(consultant_id).html(option).trigger("change");
                    }
                })
            }
            function showhideParent(event){
                if(event.target.value == 0){
                    selecterdiv.hidden = false
                    $(firm_id).prop('required',true)
                }
                else{
                    selecterdiv.hidden = true
                    $(firm_id).prop('required',false)
                    $(firm_id).val('');
                    loadConsultant()
                }
            }
        }
        
        var From_DateFlatpickr = flatpickr('#from_date', {
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
                minDate : `{{ $offer->from_date}}`
            });
        
        $(firm_id).on('select2:select', function (e) { loadConsultant() })

        $('#has_validity').change(function(){
            if ($(this).is(':checked')) $('#valid_date').show();
            else $('#valid_date').hide(); $('#to_date').removeAttr('required');
        }).change();
    
        
    

        $("#consultant_id").on('select2:select', function (e) {
            const data = e.params.data
            document.getElementById("base_curency").textContent= data.element.dataset.currencycode;

            $.ajax({
                url:"{{route('other.offer.consultantcategory')}}",
                method:"POST",
                data:{id:data.id,"_token": "{{ csrf_token() }}",},
                success:function(data){
                    var option = null
                    var sub_option = null
                    if(data.category){
                        option += '<option value='+data.category.id+'>'+data.category.name+'</option>';
                    }
                    $('#category_id').html(option).trigger("change");
                    if(data.subcaregory.length > 0){
                        $(sub_category_id).prop('required',true)
                        subcat_div.hidden = false
                        data.subcaregory.forEach((e)=>{
                            sub_option += '<option value='+e.id+'>'+e.name+'</option>';
                        })
                    }else{
                        subcat_div.hidden = true
                        $(sub_category_id).prop('required',false)
                    }
                    $('#sub_category_id').html(sub_option).trigger("change");
                }
            })
        })


    </script>
    @endsection
</x-base-layout>
