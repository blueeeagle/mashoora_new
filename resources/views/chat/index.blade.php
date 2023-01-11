<x-base-layout>

        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding: 5px">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Chat</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Home</a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3" id="chatopenclose">
                        <div class="m-0">
                             <template>
                            <button type="button" id="kt_engage_demos1_toggle" v-bind:class="CustomerButton?ActiveBitton:NoActivebutton" @clicK='tootlebutton' data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Customer Chat</button>
                            <button type="button" id="kt_engage_demos1_toggle" v-bind:class="ConsultantButton?ActiveBitton:NoActivebutton" @clicK=tootlebutton data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Consultant Chat</button>
                             </template>
                        </div>
                        <!--end::Primary button-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xxl">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row" id="customer" v-if='customerChatActive'>
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                            <!--begin::Contacts-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header pt-7" id="kt_chat_contacts_header">
                                    <!--begin::Form-->
                                    <form class="w-100 position-relative" autocomplete="off">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid px-15"  @keyup="searchData($event)" placeholder="Search by Name or email...">
                                        <!--end::Input-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-5" id="kt_chat_contacts_body">
                                    <!--begin::List-->
                                    <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px" style="max-height: 275px;">
                                        <!--begin::User-->
                                        <template v-for="(customer,index) in customers" :key="index" >
                                            <template v-if='notifivation[index].filtered'>
                                            <div class="d-flex flex-stack py-4" @click='SetCustomer(index)'>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-45px symbol-circle">
                                                        <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">@{{ customer.name?.charAt(0) || '' }}</span>
                                                    </div>
                                                    <div class="ms-5">
                                                        <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">@{{ customer.name || 'No Name'}}</a>
                                                        <div class="fw-bold text-muted">@{{ customer.email || 'No Email' }}</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <template v-if="notifivation[index].count > 0">
                                                        <div class="symbol symbol-45px symbol-circle">
                                                            <span class="symbol-label bg-light-success text-success fs-6 fw-bolder">@{{ notifivation[index].count  }}</span>
                                                        </div>
                                                    </template>
                                                    </template>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        </template>
                                        <div class="separator separator-dashed d-none"></div>
                                    </div>
                                    <!--end::List-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--end::Sidebar-->
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                            <!--begin::Messenger-->
                            <div class="card" id="kt_chat_messenger">
                                <!--begin::Card header-->
                                <div class="card-header" id="kt_chat_messenger_header">
                                    <!--begin::Title-->
                                    <div class="card-title">
                                        <!--begin::User-->
                                        <div class="d-flex justify-content-center flex-column me-3">
                                            <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1"><template>@{{ ActiveCustomer?.name || '' }}</template></a>
                                            <!--begin::Info-->
                                            <div class="mb-0 lh-1">
                                                {{-- <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                                <span class="fs-7 fw-bold text-muted">Active</span> --}}
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body" id="kt_chat_messenger_body">
                                    <!--begin::Messages-->
                                    <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px" style="max-height: 128px;">
                                        <template v-for="(message,index) in conversion">
                                                <div class="d-flex justify-content-end mb-10" v-bind:class="message.sender == 'Admin'?'justify-content-end':'justify-content-start'">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-column align-items-end">
                                                        <!--begin::User-->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <!--begin::Details-->
                                                            <div class="me-3">
                                                                {{-- <span class="text-muted fs-7 mb-1">Just now</span> --}}
                                                                <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">@{{ message.sender}}</a>
                                                            </div>
                                                        </div>
                                                        <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text">@{{ message.message }}</div>
                                                        <!--end::Text-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                        </template>
                                        <template v-if='conversion.length == 0'>
                                            <div data-kt-element="template-out" class="d-flex justify-content-center mb-10">
                                                <div class="d-flex flex-column align-items-end">
                                                    <div data-kt-element="message-text" class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end">No conversion</div>
                                                </div>
                                            </div>
                                        </template>
                                        <!--end::Message(template for in)-->
                                    </div>
                                    <!--end::Messages-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <template v-if='ActiveCustomer'>
                                    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-flush mb-3" v-model="message" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
                                        <!--end::Input-->
                                        <!--begin:Toolbar-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Actions-->
                                            <div class="d-flex align-items-center me-2" style="display: none !important">
                                                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">
                                                    <i class="bi bi-paperclip fs-3"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">
                                                    <i class="bi bi-upload fs-3"></i>
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                            <!--begin::Send-->
                                            <button class="btn btn-primary" @click="Sentmessage" type="button" data-kt-element="send">Send</button>
                                            <!--end::Send-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                </template>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Messenger-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <div class="d-flex flex-column flex-lg-row" id="consultant" v-if='consultantChatActive'>
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                            <!--begin::Contacts-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header pt-7" id="kt_chat_contacts_header">
                                    <!--begin::Form-->
                                    <form class="w-100 position-relative" autocomplete="off">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid px-15"  @keyup="searchData($event)" placeholder="Search by Name or email...">
                                        <!--end::Input-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-5" id="kt_chat_contacts_body">
                                    <!--begin::List-->
                                    <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px" style="max-height: 275px;">
                                        <!--begin::User-->
                                        <template v-for="(consultant,index) in consultants" :key="index" >
                                            <template v-if='notifivation[index].filtered'>
                                            <div class="d-flex flex-stack py-4" @click='SetConsultant(index)'>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-45px symbol-circle">
                                                        <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">@{{ consultant.name?.charAt(0) || '' }}</span>
                                                    </div>
                                                    <div class="ms-5">
                                                        <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">@{{ consultant.name || 'No Name'}}</a>
                                                        <div class="fw-bold text-muted">@{{ consultant.email || 'No Email' }}</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <template v-if="notifivation[index].count > 0">
                                                        <div class="symbol symbol-45px symbol-circle">
                                                            <span class="symbol-label bg-light-success text-success fs-6 fw-bolder">@{{ notifivation[index].count  }}</span>
                                                        </div>
                                                    </template>
                                                    </template>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        </template>
                                        <div class="separator separator-dashed d-none"></div>
                                    </div>
                                    <!--end::List-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--end::Sidebar-->
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                            <!--begin::Messenger-->
                            <div class="card" id="kt_chat_messenger">
                                <!--begin::Card header-->
                                <div class="card-header" id="kt_chat_messenger_header">
                                    <!--begin::Title-->
                                    <div class="card-title">
                                        <!--begin::User-->
                                        <div class="d-flex justify-content-center flex-column me-3">
                                            <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1"><template>@{{ ActiveConsultant?.name || '' }}</template></a>
                                            <!--begin::Info-->
                                            <div class="mb-0 lh-1">
                                                {{-- <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                                <span class="fs-7 fw-bold text-muted">Active</span> --}}
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body" id="kt_chat_messenger_body">
                                    <!--begin::Messages-->
                                    <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages-consultant" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px" style="max-height: 128px;">
                                        <template v-for="(message,index) in conversion">
                                                <div class="d-flex justify-content-end mb-10" v-bind:class="message.sender == 'Admin'?'justify-content-end':'justify-content-start'">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-column align-items-end">
                                                        <!--begin::User-->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <!--begin::Details-->
                                                            <div class="me-3">
                                                                {{-- <span class="text-muted fs-7 mb-1">Just now</span> --}}
                                                                <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">@{{ message.sender}}</a>
                                                            </div>
                                                        </div>
                                                        <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text">@{{ message.message }}</div>
                                                        <!--end::Text-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                        </template>
                                        <template v-if='conversion.length == 0'>
                                            <div data-kt-element="template-out" class="d-flex justify-content-center mb-10">
                                                <div class="d-flex flex-column align-items-end">
                                                    <div data-kt-element="message-text" class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end">No conversion</div>
                                                </div>
                                            </div>
                                        </template>
                                        <!--end::Message(template for in)-->
                                    </div>
                                    <!--end::Messages-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <template v-if='ActiveConsultant'>
                                    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-flush mb-3" v-model="message" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
                                        <!--end::Input-->
                                        <!--begin:Toolbar-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Actions-->
                                            <div class="d-flex align-items-center me-2" style="display: none !important">
                                                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">
                                                    <i class="bi bi-paperclip fs-3"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">
                                                    <i class="bi bi-upload fs-3"></i>
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                            <!--begin::Send-->
                                            <button class="btn btn-primary" @click="Sentmessage" type="button" data-kt-element="send">Send</button>
                                            <!--end::Send-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                </template>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Messenger-->
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
        @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/vue@2.7.10"></script>
        {{-- <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js"></script> --}}

    <script>
        const CustomerURL = '{{ route('chat.getcustomer')}}'
        const ConsultantURL = '{{ route('chat.getconsultant')}}'
    </script>
    <script type="module" src="{{ URL::asset(theme()->getDemo().'/js/Chat.js') }}"></script>
    @endsection
    </x-base-layout>

