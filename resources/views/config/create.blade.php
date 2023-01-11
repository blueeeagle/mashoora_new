<x-base-layout>
    @section('styles')
        <link href="{{ URL::asset(theme()->getDemo().'/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" />
    @endsection
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Config</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">Activities</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"><a href="{{ route('activities.config.index') }}" class="text-muted text-hover-primary">Config</a></li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Create Config</li>
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
                    <div class="card-body rounded border pt-0">
                <form action="{{ route('activities.config.store') }}" method="post" id="formCreate">
                @csrf
                <div class="py-5">
                    <div class="p-10">
                        <div class="form-group row">
                        <div class="mb-10 col-md-6">
                            <label  class="form-label">Choose<span class="text-danger">*</span></label>
                            <select class="form-select" name="choose_section" id="home" onchange="(changeCategory(event))" data-placeholder="Select an option" >
                                <option value="1">Home</option>
                                <option value="2">All Category</option>
                                <option value="3">Category</option>
                            </select>
                        </div>

                        <div class="mb-10 col-md-6">
                            <label class="form-label">Category<span class="text-danger">*</span></label>
                            <input type="hidden" name="categorie_id" id="categorie_id">
                            <div id="kt_docs_jstree_checkable"></div>
                        </div>
                        
                        <div class="mb-10 col-md-6">
                            <label  class="form-label">Type</label>
                            <select class="form-select" name="type" id="type" onchange="(showhideParent(event))">
                                <option>Select an option</option>    
                                <option value="1">Discount</option>
                                <option value="2">Offer</option>
                            </select>
                        </div>
                        

                        <div class="mb-10 col-md-6"  id="selecterdiv" hidden>
                            <label class="fs-6 form-label fw-bolder text-dark">Choose Discount</label>
                            <select class="form-select" name="discount_id" id="discount_id" data-control="select2" data-placeholder="Select an option">
                                <option></option>
                                @foreach($discount as $data)
                                    <option value="{{$data->id}}">{{$data->promo_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-10 col-md-6" id="selecterdiv1" hidden>
                           
                            <label class="fs-6 form-label fw-bolder text-dark">Choose Offer</label>
                            <select class="form-select" name="offer_id" id="offer_id" data-control="select2"  data-placeholder="Select an option">
                                <option></option>
                                @foreach($offer as $data)
                                    <option value="{{$data->id}}">{{$data->offer_title}}</option>
                                @endforeach
                            </select>
                             
                        </div>

                        <div class="mb-10 col-md-6">
                            <label for="" class="form-label">Sort</label>
                            <input type="number" name="sort_no" class="form-control" placeholder="Sort No"/>
                        </div>
                        </div>
                        <div class="form-group row" style="float:right;">
                        <div class="mb-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('scripts')
    <script src='{{ URL::asset(theme()->getDemo().'/plugins/custom/jstree/jstree.bundle.js')}}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
       
        
        const selecterdiv = document.getElementById('selecterdiv')
        const selecterdiv1 = document.getElementById('selecterdiv1')
        const discount = document.getElementById('discount')
        const offer = document.getElementById('offer')
        const selecterdiv2 = document.getElementById('selecterdiv2')
        const type = document.getElementById('type')
     
        const categorie_id = document.getElementById('categorie_id')
        
        function showhideParent(event){
            if(event.target.value == 1){
                selecterdiv.removeAttribute('hidden')
                selecterdiv1.setAttribute('hidden',true)

                $(offer).removeAttr('required'); 
              
                $(type).removeAttr('required'); 
                $(discount).prop('required','true');
                $(offer).value='';
            }
            if(event.target.value == 2){
                selecterdiv1.removeAttribute('hidden')
                selecterdiv.setAttribute('hidden',true)

                $(discount).removeAttr('required'); 
                $(offer).prop('required','true');
                $(discount).value='';
            }
        }

        back = `{{ route('activities.config.index') }}`
        $(document).ready(function () {
            back = `{{ route('activities.config.index') }}`
        })

        function changeCategory(event){
            // console.log(event.target.value);
            if(event.target.value == 2){
                
                console.log(category_id);
                // $(category_id).setAttribute('multiple',true)
                $(discount).removeAttr('required'); 
                $(offer).removeAttr('required'); 
                $(type).removeAttr('required'); 
            }
            else{
                
               
                $(offer).prop('required','true');
                $(discount).prop('required','true');
                $(type).prop('required','true');
            }
            
        }

    var KTJSTreeCheckable = {
        init: function () {
            $("#kt_docs_jstree_checkable")
            // listen for event
                .on('changed.jstree', function (e, data) {
                    var i, j, r = [];
                    for(i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).id);
                    }
                    categorie_id.value = r.join(',');
                    console.log(r);
                })
                .jstree({
                plugins: ["wholerow", "checkbox", "types"],
                core: {
                    themes: {
                        responsive: !1
                    },
                    data: {!! json_encode($tree) !!}
                },
                types: {
                    default: {
                        icon: ""
                    },
                    file: {
                        icon: ""
                    }
                }
            })
        }
    };

    KTUtil.onDOMContentLoaded((function () {
        KTJSTreeCheckable.init()
    }));

    </script>
    @endsection
</x-base-layout>
