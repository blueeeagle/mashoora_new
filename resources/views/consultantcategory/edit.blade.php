<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Specialization</h1>
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
                        <li class="breadcrumb-item text-muted">Master</li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Specialization</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('master.specialization.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
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
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <form action="{{ route('master.consultantcategory.update',[$consultantcategory->id]) }}" method="Post" id="formEdit">
                            @csrf
                            <div class="py-5">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <!--begin::Label-->
                                        <label class="required form-label fs-6 mb-2" >Choose Main Category</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select mb-4" name="categorie_id" id="categorie_id" data-control="select2" data-placeholder="Select an option" required>
                                            <option></option>
                                            @foreach ($Category as $key => $value )
                                                <option url='{{ route('master.category.getchild',$value->id) }}' value="{{ $value->id }}" {{ ($consultantcategory->categorie_id == $value->id)?'selected':'' }}>{{$value->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--begin::Select2-->
                                    </div>
                                    <div class="col-md-6" id="selectdiv" {{ isset($consultantcategory->subcategorie_id)?'':'hidden' }}>
                                        <!--begin::Label-->
                                        <label class="required form-label fs-6 mb-2" >Choose Child Category</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select mb-4" name="subcategorie_id" id="subcategorie_id" data-control="select2" data-placeholder="Select an option" required>
                                            <option></option>
                                            @foreach ($ChildCategory as $key => $value )
                                                <option value="{{ $value->id }}" {{ ($consultantcategory->subcategorie_id == $value->id)?'selected':'' }}>{{$value->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--begin::Select2-->
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="required form-label fs-6 mb-2" >Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $consultantcategory->title }}" placeholder="Title" required/>
                                    </div>
                                </div>

                                <div class="form-group row" style="float:right" >
                                    <div class="col-md-6">
                                        <button type="button" id="formEditReset" class="btn btn-secondary btn-hover-rise me-5 ">Reset</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-hover-rise">Save</button>
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
    window.onload = function() {
        back = `{{ route('master.specialization.index') }}`
        var child = $("#subcategorie_id")
        var selectdiv = document.getElementById('selectdiv');
        $("#categorie_id").on('select2:select', function (e) {
            var data = e.params.data.element.attributes[0].value
            $.ajax({
                url:data,
                method:"POST",
                data:{"_token": "{{ csrf_token() }}"},
                success:function(data){
                    var option = null
                    if(data.child.length >0){
                        data.child.forEach((e)=>{
                            option +='<option></option>'
                            option += '<option value='+e.id+'>'+e.name+'</option>'
                        })
                        child.html(option)
                        selectdiv.removeAttribute('hidden');
                    }
                    else{
                        selectdiv.setAttribute('hidden',true);
                        subcategorie_id.removeAttribute('required');
                        document.getElementById('subcategorie_id').value = "";
                    }
                }
            })
        })
    }
    </script>
    @endsection
</x-base-layout>
