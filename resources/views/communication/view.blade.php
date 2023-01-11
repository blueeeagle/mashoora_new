<x-base-layout>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Manage Communication</h1>
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
                        <li class="breadcrumb-item text-muted"><a href="{{ route('other.communication.index') }}" class="text-muted text-hover-primary">Manage Communication</a></li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">View Communication</li>
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
                       
                            @csrf
                            <div class="py-5">
                                <div class="rounded border p-10">
                                   
                                    <div class="fv-row mb-10">
                                        <label for="" class="form-label">Communication Mode </label>
                                        @php 
                                            $cm = "";
                                            if($communication->communication_mode ==0) $cm = "SMS";
                                            elseif($communication->communication_mode == 1) $cm = "Push Notification";
                                            else $cm = "Email";                                        
                                        @endphp
                                        <input type="text" class="form-control" value="{{$cm }}" readonly/>                                                                              
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label for="" class="form-label">Send To </label>
                                        @php
                                            $send = '';
                                            if($communication->send_to ==1) $send = "Customer";
                                            elseif($communication->send_to == 2) $send = "Consultant";
                                            else $send = "other"
                                        @endphp

                                        <input type="text"  class="form-control" value="{{$send}}" readonly/>

                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label">Send On</label>
                                        <input type="text"  class="form-control" value="{{$communication->send_on}}" readonly/>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="form-label fs-6 mb-2" >Subject<span class="text-danger">*</span></label>
                                        <input type="text" name="subject" class="form-control" value="{{$communication->subject }}" readonly/>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label fs-6 mb-2" >Body<span class="text-danger">*</span></label>
                                        <textarea  class="form-control" readonly>{{$communication->body }}</textarea>
                                    </div>

                                    <!-- Data Table for "Send To" -->
                                    <div class="row gy-10 gx-xl-10">
                                        <div class="card card-docs flex-row-fluid mb-2">
                                            <table id="communicate" class="table table-row-bordered gy-5">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-muted">
                                                        <th>Sno</th>
                                                        <th>Name</th>
                                                        <th>Mobile No</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                              
                                                    @foreach ($customer as $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data->name}}</td>
                                                            <td>{{ $data->phone_no}}</td>
                                                            <td>{{ $data->email}}</td>
                                                        </tr>
                                                    @endforeach
                                            
                                                    @foreach ($consultant as $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data->name}}</td>
                                                            <td>{{ $data->phone_no}}</td>
                                                            <td>{{ $data->email}}</td>
                                                        </tr>
                                                    @endforeach
                                              
                                                </tbody>
                                            </table>
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
      
       const send_to = document.getElementById('send_to');

        back = `{{ route('other.communication.index') }}`
        var table = null;
        $(document).ready(function () {
            back = `{{ route('other.communication.index') }}`
            table = $("#communicate").DataTable({ });      
        })
        
    </script>
    @endsection
</x-base-layout>
