<x-base-layout>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Article</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Other</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted"><a href="{{ route('other.article.index') }}" class="text-muted text-hover-primary">Article</a></li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Edit Article</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
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
                        <form action="{{ route('other.articel.update',$articel->id) }}" method="post" id="formCreate">
                            @csrf
                            <div class="py-5">
                                <div class="rounded border p-10">
                                    <div class="fv-row mb-10">
                                        <label class="required fw-bold fs-6 mb-3">Pos from</label>
                                        <div class="d-flex flex-column fv-row">
                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                <input class="form-check-input me-3" name="from_user"  type="radio" value="0" {{ ($articel->from_user == 0)?'checked':'' }} id="kt_docs_formvalidation_radio_option_1" />
                                                <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                                    <div class="fw-bolder text-gray-800">Firm</div>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                <input class="form-check-input me-3" name="from_user" type="radio" value="1" {{ ($articel->from_user == 1)?'checked':'' }} id="kt_docs_formvalidation_radio_option_1" />
                                                <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                                    <div class="fw-bolder text-gray-800">Consultant</div>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                <input class="form-check-input me-3" name="from_user" type="radio" value="2" {{ ($articel->from_user == 2)?'checked':'' }} id="kt_docs_formvalidation_radio_option_2" />
                                                <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                                                    <div class="fw-bolder text-gray-800">Admin</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-10" id="selecterdiv1" {{ ($articel->firm_id =='')?'hidden':'' }}>
                                        <label class="required form-label fs-6 mb-2" >Firm</label>
                                        <select class="form-select " id="firm_id" name="firm_id" data-placeholder="Search by Firm Name / Email / Mobile No / Consultant ID /  Admin Name">
                                            <option value=""></option>
                                            @foreach($firm as $data)
                                                <option {{ ($data->id ==  $articel->firm_id)?'selected':'' }} data-image="{{asset("storage/$data->logo")}}" value="{{$data->id}}">{{$data->comapany_name}} - {{ $data->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-10" id="selecterdiv2" {{ ($articel->consultant_id =='')?'hidden':'' }}>
                                        <label class="required form-label fs-6 mb-2" >Consultant</label>
                                        <select class="form-select" id="consultant_id" name="consultant_id" data-placeholder="Search by Consultant Name / Email / Mobile No / Consultant ID /  Admin Name">
                                            <option value=""></option>
                                            @foreach($consultant as $data)
                                                <option {{ ($data->id ==  $articel->consultant_id)?'selected':'' }} value="{{$data->id}}">{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-10" id="selecterdiv3" {{ ($articel->admin_id =='')?'hidden':'' }}>
                                        <label class="required form-label fs-6 mb-2" >Admin</label>
                                        <select class="form-select" id="admin_id" name="admin_id" data-placeholder="Admin by Consultant Name / Email / Mobile No / Consultant ID /  Admin Name">
                                            <option value=""></option>
                                            @foreach($user as $data)
                                                <option {{ ($data->id ==  $articel->admin_id)?'selected':'' }} value="{{$data->id}}">{{$data->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="required fw-bold fs-6 mb-2">Title</label>
                                        <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $articel->title }}" placeholder="Title" required />
                                    </div>
                                    <div class="fv-row mb-10">
                                        @include('components.imagecrop',['name'=>'image','imgsrc'=>$articel->image])
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="required fw-bold fs-6 mb-2">Short Description</label>
                                        <textarea name="describtion" class="form-control form-control-solid">{{ $articel->describtion }}</textarea>
                                    </div>
                                    <div class="fv-row mb-10">
                                        {{-- <label class="required fw-bold fs-6 mb-5"></label> --}}
                                        <div class="form-check form-check-custom form-check-solid mb-5">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status" {{ ($articel->status == 1)?'checked':'' }} type="checkbox" value="1" id="status" />
                                            <!--end::Input-->

                                            <!--begin::Label-->
                                            <label class="form-check-label" for="status">
                                                <div class="fw-bolder text-gray-800">Status</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <button type="submit" class="btn btn-primary btn-hover-rise me-5">update</button>
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
    <script >
        back = "{{ route('other.article.index') }}"
     
       
        window.onload = function() {
           
            var RadioButton = document.getElementById('formCreate').elements['from_user'];
            RadioButton.forEach(element => {
                element.addEventListener('click',showhideParent)
            });

            const firm_id = document.getElementById('firm_id');
            const consultant_id = document.getElementById('consultant_id');
            const admin_id = document.getElementById('admin_id');

            function showhideParent(event){
            // console.log(event.target.value);
            console.log('load');
                if(event.target.value == 0){
                    selecterdiv1.removeAttribute('hidden')
                    selecterdiv2.setAttribute('hidden',true)
                    selecterdiv3.setAttribute('hidden',true)
                    $(firm_id).prop('required','true');
                   
                    $(admin_id).val('');
                    $(consultant_id).val('');

                    $(admin_id).removeAttr('required'); 
                    $(consultant_id).removeAttr('required');

                    
                }
                if(event.target.value == 1){
                    selecterdiv2.removeAttribute('hidden')
                    selecterdiv1.setAttribute('hidden',true)
                    selecterdiv3.setAttribute('hidden',true)
                    $(consultant_id).prop('required','true');
                    
                    $(firm_id).val('');
                    $(admin_id).val('');

                    $(admin_id).removeAttr('required'); 
                    $(firm_id).removeAttr('required');

                }
                if(event.target.value == 2){
                    selecterdiv3.removeAttribute('hidden')
                    selecterdiv1.setAttribute('hidden',true)
                    selecterdiv2.setAttribute('hidden',true)
                    $(admin_id).prop('required','true');

                    $(consultant_id).val('');
                    $(firm_id).val('');

                    $(consultant_id).removeAttr('required'); 
                    $(firm_id).removeAttr('required');
                }
            }
        
        }
 
      
        $('#firm_id').select2({
            ajax: {
                url: '{{ route('other.article.search') }}',
                type: 'POST',
                data: function (params) {
                var query = {
                    search: params.term,
                    "_token": "{{ csrf_token() }}",
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                    results:  $.map(data, function (item) {
                            return {
                                text: item.title,
                                children: $.map(item.children, function (data) { return { id:`${data.id}`,text : data.text} })
                            }
                        })
                    };
                },
                cache: true
            },

        })

        $('#consultant_id').select2({
            ajax: {
                url: '{{ route('other.article.consultantSearch') }}',
                type: 'POST',
                data: function (params) {
                var query = {
                    search: params.term,
                    "_token": "{{ csrf_token() }}",
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                    results:  $.map(data, function (item) {
                            return {
                                text: item.title,
                                children: $.map(item.children, function (data) { return { id:`${data.id}`,text : data.text} })
                            }
                        })
                    };
                },
                cache: true
            },

        })
        $('#admin_id').select2({
            ajax: {
                url: '{{ route('other.article.userSearch') }}',
                type: 'POST',
                data: function (params) {
                var query = {
                    search: params.term,
                    "_token": "{{ csrf_token() }}",
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                    results:  $.map(data, function (item) {
                            return {
                                text: item.title,
                                children: $.map(item.children, function (data) { return { id:`${data.id}`,text : data.text} })
                            }
                        })
                    };
                },
                cache: true
            },

        })

        var optionFormat = function(item) {
            if ( !item.id ) {
                return item.text;
            }
            

            var span = document.createElement('span');
            var imgUrl = item.element.getAttribute('data-image');
            var template = '';
            // debugger;

            template += '<img src="' + imgUrl + '" class="rounded-circle h-40px me-2" alt="image"/>';
            template += item.text;

            span.innerHTML = template;

            return $(span);
        }

        // Init Select2 --- more info: https://select2.org/
        $('#firm_id').select2({
            templateSelection: optionFormat,
            templateResult: optionFormat,
        });
    
    
    </script>
    @endsection
</x-base-layout>
