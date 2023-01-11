<x-base-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create Category</h1>
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
                    <a href="{{ route('master.category.index') }}" class="btn btn-sm btn-secondary" ><i class="fas fa-arrow-left "></i></a>
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
                        <form action="{{ route('master.category.store') }}" method="post" id="formCreate">
                            @csrf
                            <!--begin::Repeater-->
                            <div class="py-5">
                                <div class="">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label class="required fw-bold fs-6 mb-4">Choose</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-check-input me-3" name="type" type="radio" checked value="0" id="kt_docs_formvalidation_radio_option_1" /> <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                                <div class="fw-bolder text-gray-800">Parent</div>
                                            </label>
                                            <input class="form-check-input me-3" name="type" type="radio"  value="1" id="kt_docs_formvalidation_radio_option_2" />
                                            <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                                                <div class="fw-bolder text-gray-800">Sub Category</div>
                                            </label>
                                        </div>
                                        
                                         <div class="col-md-3" id="is_insurance">
                                            <input class="form-check-input me-3 " name="insurance" type="checkbox" value="1" id="insurance" />
                                            <label class="form-check-label" for="insurance">
                                                <div class="fw-bolder text-gray-800">Category has insurance?</div>
                                            </label>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required fw-bold fs-6 mb-4">Category Name</label>
                                            <input type="text" name="name" class="form-control mb-4" placeholder="Category Name" required />
                                        </div>

                                        <div class="col-md-6" id="selecter" hidden>
                                            <label class="required form-label fs-6 mb-4" >Choose Parent</label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select mb-4" name="categories_id" id="categories_id" data-control="select2" data-placeholder="Select an option">
                                                <option value=""></option>
                                                @foreach ($Category as $key => $value )
                                                    <option value="{{ $value->id }}" data-value={{ $value->document_id}} >{{$value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                       
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="required fw-bold fs-6 mb-4">Document</label>
                                            <select class="form-select" name="document_id[]" id="document_id" data-control="select2" multiple data-placeholder="Select an option" required>
                                                <option value=""></option>
                                                @foreach ($documents as $key => $value )
                                                    <option value="{{ $value->id }}">{{$value->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="required fw-bold fs-6 mb-4">Short Description</label>
                                            <textarea name="description" class="form-control" maxlength="256" placeholder="256 Characters Alone" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="fw-bold fs-6 mb-4">Tags</label>
                                            <input class="form-control mb-4" name="tags" value="" id="tags" placeholder="e.g. Plain relief, Tooth Ace"/>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="required fw-bold fs-6 mb-4">Sort No</label>
                                            <input type="number" name="sort_no_list" class="form-control mb-4 " placeholder="for Category list" required />
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        
                                   
                                        <div class="col-md-6">
                                            <input class="form-check-input mb-3" name="display_in_home" type="checkbox" value="1" id="display_in_home"  onclick="show_dis_in_home(this)" /><label class="form-check-label" for="display_in_home">
                                                <div class="fw-bolder text-gray-800">  &nbsp; Display in home</div>
                                            </label>
                                            <div hidden id="display_sort">
                                                <input type="number" id="sort_no_home" name="sort_no_home" class="form-control mb-3 mb-lg-0" placeholder="for Home list" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" hidden>
                                        <div class="col-md-6">
                                            <input class="form-check-input me-3 " name="status" type="checkbox" value="1" id="status" checked />
                                            
                                            <label class="form-check-label" for="status">
                                                <div class="fw-bolder text-gray-800">Status</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="required fw-bold fs-6 mb-4">Menu Image/Icon</label>
                                    <span>Image must be less than 5MB</span>
                                    <div class="col-md-6">
                                    @include('components.imagecrop',['name'=>'img'])
                                    </div>
                                </div>
                            </div>

                            
                            <div class="form-group row" style="float:right" >
                                <div class="col-md-6">
                                    <button type="reset" id="formreset" class="btn btn-secondary btn-hover-rise me-5">Reset</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-hover-rise me-5">Save</button>
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
        back = `{{ route('master.category.index') }}`

        new Tagify(document.getElementById('tags'))
        const selecter = document.getElementById('selecter')
        const categories_id = document.getElementById('categories_id')
        const display_sort = document.getElementById('display_sort')
        const is_insurance = document.getElementById('is_insurance')
        
        var RadioButton = document.getElementById('formCreate').elements['type'];
        RadioButton.forEach(element => {
            element.addEventListener('click',showhideParent)
        });

        function showhideParent(event){
            if(event.target.value == 1){
                is_insurance.setAttribute('hidden',true)
                selecter.removeAttribute('hidden')
                $(categories_id).prop('required','true');
            }else{
                is_insurance.removeAttribute('hidden')
                selecter.setAttribute('hidden',true)
                $(categories_id).removeAttr('required');
                $(categories_id).val('');
            }
        }

        function show_dis_in_home(checkbox) {
            if(checkbox.checked){
                display_sort.removeAttribute('hidden');
                $('#sort_no_home').prop('required','true');
            }
            else{
               display_sort.setAttribute('hidden',true);
                $('#sort_no_home').removeAttr('required');
               $('#sort_no_home').val('');
            }
        }

        $("#categories_id").on('select2:select', function (e) {
            var data = e.currentTarget.options[e.currentTarget.options.selectedIndex].dataset.value
            var document_id = data.split(','); 
            var Ddata= [];
            var option= null;
            const Documents = @json($documents);
        
            document_id.forEach((id) => {   // loop for category based document
                check = Documents.filter(function (ele) {
                   
                    return id == ele.id;
                });
                Ddata.push(check);
            });

            Ddata = Ddata.flat(1);

            if(Ddata.length != null){
                Ddata.forEach((e)=>{
                    option += '<option value='+e.id+'>'+e.title+'</option>';
                })
            }
            $('#document_id').html(option).trigger("change");
            
        })
    </script>
      <style>
        .content {
    padding: 3px 0;
}

.card .card-body {
    padding: 2rem 1.00rem;
}
    </style>
    @endsection
</x-base-layout>
