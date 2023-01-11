<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Video Create</h1>
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
                        </li>  <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Others</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Video</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('other.video.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Products-->
                <div class="card card-flush">
                    <form action="{{ route('other.video.store') }}" method="post" id="formCreate">
                        @csrf
                        <div class="card-body pt-5">
                            <div class="fv-row mb-10">
                                <label class="required fw-bold fs-6 mb-3">Pos from</label>
                                <div class="d-flex flex-column fv-row">
                                    <div class="form-check form-check-custom form-check-solid mb-5">
                                        <input class="form-check-input me-3" name="post_from"  type="radio" checked  value="0" id="kt_docs_formvalidation_radio_option_1" />
                                        <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                            <div class="fw-bolder text-gray-800">Firm</div>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid mb-5">
                                        <input class="form-check-input me-3" name="post_from" type="radio" value="1" id="kt_docs_formvalidation_radio_option_1" />
                                        <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                            <div class="fw-bolder text-gray-800">Consultant</div>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid mb-5">
                                        <input class="form-check-input me-3" name="post_from" type="radio" value="2" id="kt_docs_formvalidation_radio_option_2" />
                                        <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                                            <div class="fw-bolder text-gray-800">Admin</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="fv-row mb-10" id="selecterdiv1">
                                <label class="required form-label fs-6 mb-2" >Firm</label>
                                <select class="form-select" id="firm_id" name="firm_id" data-placeholder="Search by Firm Name / Email / Mobile No / Consultant ID /  Admin Name">
                                
                                </select>
                            </div>
                            <div class="fv-row mb-10" id="selecterdiv2" hidden>
                                <label class="required form-label fs-6 mb-2" >Consultant</label>
                                <select class="form-select" id="consultant_id" name="consultant_id" data-placeholder="Search by Consultant Name / Email / Mobile No / Consultant ID /  Admin Name">

                                </select>
                            </div>
                            <div class="fv-row mb-10" id="selecterdiv3" hidden>
                                <label class="required form-label fs-6 mb-2" >Admin</label>
                                <select class="form-select" id="admin_id" name="admin_id" data-placeholder="Admin by Consultant Name / Email / Mobile No / Consultant ID /  Admin Name">

                                </select>
                            </div>
                            <div class="mb-10">
                                <label for="" class="form-label">Video Title<span class="text-danger">*</span></label>
                                <input type="text" name="video_title" class="form-control " placeholder="Video Title"/>
                            </div>
                            <div class="mb-10">
                                <label for="" class="form-label">Video URL<span class="text-danger">*</span></label>
                                <input type="url" name="video_url" class="form-control " placeholder="Video URL"/>
                            </div>
                            <div class="mb-10">
                                <label class="form-check-label" for="display_in_home">
                                    <div class="fw-bolder text-gray-800">Display in Home</div>
                                </label>   
                                <input class="form-check-input me-3" name="display_in_home" type="checkbox" value="1" id="display_in_home"  onclick="show_dis_in_home(this)"/>
                                            
                            </div>
                            <div class="mb-10" hidden id="display_sort">
                                <label for="" class="form-label">Sort No<span class="text-danger">*</span></label>
                                <input type="number" name="sort_no" id="sort_no" class="form-control " placeholder="Sort No"/>
                            </div>
                            <div class="mb-10 float-end">
                                <button  class="btn btn-light" onclick="event.preventDefault()">Reset</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @section('scripts')
    <script>
        back = `{{ route('other.video.index') }}`
        $(document).ready(function () {
            back = `{{ route('other.video.index') }}`
        })
        
        const selecterdiv1 = document.getElementById('selecterdiv1')
        const selecterdiv2 = document.getElementById('selecterdiv2')
        const selecterdiv3 = document.getElementById('selecterdiv3')
        const display_sort = document.getElementById('display_sort')

        var RadioButton = document.getElementById('formCreate').elements['post_from'];
        RadioButton.forEach(element => {
            element.addEventListener('click',showhideParent)
        });
        function showhideParent(event){
            
            if(event.target.value == 0){
                selecterdiv1.removeAttribute('hidden')
                selecterdiv2.setAttribute('hidden',true)
                selecterdiv3.setAttribute('hidden',true)
                // $(firm_id).prop('required','true');
                // $(consultant_id).prop('required','false');
                // $(admin_id).prop('required','fale');
            }
            if(event.target.value == 1){
                selecterdiv2.removeAttribute('hidden')
                selecterdiv1.setAttribute('hidden',true)
                selecterdiv3.setAttribute('hidden',true)
                // $(consultant_id).prop('required','true');
                // $(firm_id).prop('required','false');
                // $(admin_id).prop('required','fale');
            }
            if(event.target.value == 2){
                selecterdiv3.removeAttribute('hidden')
                selecterdiv1.setAttribute('hidden',true)
                selecterdiv2.setAttribute('hidden',true)
                // $(admin_id).prop('required','true');
                // $(firm_id).prop('required','false');
                // $(consultant_id).prop('required','fale');
            }
        }
        
        function show_dis_in_home(checkbox) {
            if(checkbox.checked){
                display_sort.removeAttribute('hidden');
                $('#sort_no').prop('required','true');
            }
            else{
               display_sort.setAttribute('hidden',true);
                $('#sort_no').removeAttr('required');
               $('#sort_no').val('');
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
    </script>
    @endsection
</x-base-layout>
