"use strict";

const cus = function(){
    var table;
    return {
        init : function (){


              table = $("#kt_customers_table").DataTable({
                initComplete: function(settings, json) {

                },
                responsive: true,
                buttons: [
                        'print',
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5',
                    ],
                // Pagination settings
                // dom: `<'row'<'col-sm-12'tr>>
                // <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // // read more: https://datatables.net/examples/basic_init/dom.html

                lengthMenu: [5, 10, 25, 100],
                bInfo : false,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                   url : cus_url,
                    type: 'POST',
                    data:{
                        "_token": csrf,
                        columnsDef : [],
                        // searchTable: function () { // dynamic
                        //     return  searchoffer;
                        // },
                    }
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'phone_no' },
                    { data: 'name' },
                    { data: 'gender' },
                    { data: 'dob' },
                    { data: 'register_address' },
                    { data: 'status' },
                    { data: 'action' }
                ],
                columnDefs : [
                    {
                        targets: -1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `
                                <a href="${data.edit}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"> 
                                    <span class="svg-icon svg-icon-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                        </svg>
                                    </span>  
                                </a>
                                <a href="${data.view}" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1"> 
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </span>
                                </a>
                                
                                <a href="${data.Delete}" delete class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                    <i href="${data.Delete}" delete class="las la-trash fs-2 me-2"></i></a>
								</a>
                            `;
                        },
                    },
                ],

                drawCallback : function( settings ) {
                    // let checkActiontag = document.querySelectorAll('[data-offercheck]');
                    // [...checkActiontag].forEach(e => e.addEventListener('click', function(event){ checkboxoffer(event) }))

                    // let app = document.querySelectorAll('[data-appoffer]');
                    // [...app].forEach(e => e.addEventListener('click', function(event){ update_offer_approval(event) }))

                    // let dec = document.querySelectorAll('[data-declineoffer]');
                    // [...dec].forEach(e => e.addEventListener('click', function(event){ update_offer_approval(event) }))

                }
            })
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    cus.init();
})

