"use strict";

const PayIn = function () {
    var table = null
    var searchTable = 'Pending'
    var rendering;
    var bulkaction = []

    const initfun = function (){
        [...rendering].forEach(e=> e.addEventListener('click', function (event){ Reloadtable(event) }) );
        let app = document.querySelectorAll('[data-app]');
        [...app].forEach(e => e.addEventListener('click', function(event){ update_approval(event) }))
    }

    function Switealert(Msg,status){
        Swal.fire({
            text: Msg,
            icon: status,
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: 'btn btn-primary'
            }
        });
    }
    function update_approval(e){
        if(bulkaction.length < 1) return;
        Swal.fire({
            text: 'Change Status',
            icon: "warning",
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: "Yes, Update!",
            cancelButtonText: "No, cancel",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        }).then((function (t) {
            if(t.value){
                $.ajax({
                    url: app_status,
                    method:"post",
                    data:{
                        "_token": csrf,
                        status:e.target.value,
                        id:bulkaction,
                    },
                    success:function(data){
                        if(data.msg){
                            bulkaction = [];
                            Switealert(data.msg,'success')
                            table.table().draw();
                        }else{
                            var Ptag = "";
                            for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                            Switealert(Ptag,'error')
                        }
                    }
                })
            }
        }))
    }


    const checkboxfunction = function(event){
        let id = parseInt(event.target.value)
        if(event.target.checked){
            bulkaction.push(id)
            return
        }

        const index = bulkaction.indexOf(id);
        if (index > -1) { // only splice array when item is found
            bulkaction.splice(index, 1); // 2nd parameter means remove one item only
            return
        }
    }
    const buttonstatus = function(){
        if(searchTable == 'Decline'){
            decline.hidden = true;
            approve.hidden = false;
            table.column(8).visible(true)
            table.column(7).visible(false)
        }else if(searchTable == 'Approved'){
            decline.hidden = false;
            approve.hidden = true;
            table.column(7).visible(true)
            table.column(8).visible(false)
        }else{
            decline.hidden = false;
            approve.hidden = false;
            table.column(7).visible(false)
            table.column(8).visible(false)
        }
    }
    const Reloadtable = function(pare){
        searchTable =  pare.target.value
        table.table().draw();
        [...document.querySelectorAll('[data-apptick]')].forEach(e => (e.dataset.apptick == searchTable)?e.hidden = false:e.hidden= true);
        buttonstatus();
    }

    return {

        init: function () {
            rendering = document.querySelectorAll('[data-rendering]');

            initfun()
            table = $("#kt_customers_table").DataTable({
                initComplete: function(settings, json) {
                    table.column(7).visible(false)
                    table.column(8).visible(false)
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
                // dom: `<'row'<'col-sm-12 'tr>>
                // <'row'<'col-sm-12 col-md-5 dataTables_pager'i ><'col-sm-12 col-md-7 'lp>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html

                lengthMenu: [5, 10, 25, 100],
                // searching: false,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                bInfo : false,
                layout: {
                    scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                    footer: false, // display/hide footer
                },
                ajax: {
                    url : firmdatatable,
                    type: 'POST',
                    data: {
                        "_token": csrf,
                        columnsDef : ['id','created_at','company_name','email','category','approval','updated_at','option'],
                        searchTable: function () { // dynamic
                            return  searchTable;
                        },
                    }

                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'logo' },
                    { data: 'comapany_name' },
                    { data: 'register_on'},
                    { data: 'country'},
                    { data: 'category' },
                    { data: 'approval'},
                    { data: 'app_date'},
                    { data: 'deapp_date'},
                    { data: 'status'},
                    {data: 'select'}
                ],
                columnDefs : [
                    {
                        targets: -1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            return `<input ${bulkaction.includes(row.id)?'checked':''} data-checkaction  class="typecheck" type="checkbox" value='${row.id}' >
                                <a href="${row.option.view}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <span class="svg-icon svg-icon-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </a>
                            `;
                        },
                    },
                    {
                        targets: 1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            if(data){
                                return `<div class="d-flex align-items-center">
                                            <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                                <img class="rounded-circle z-depth-2" src="${baseURl}/storage/${data}">
                                            </div>
							            </div>`;
                            }
                            return '';


                        },
                    },
                    {
                        targets: 4,
                        data: null,
                        width : '200px',
                        orderable: true,
                        render: function (data, type, row) {
                            return `Address : ${row.address || ''}<br/>City : ${row.city?.city_name || ''}
								,<br>State : ${row.state?.state_name || ''}
								,<br>Country : ${row.addcountry?.country_name || ''}
                                ,<br> Zipcode : ${row.zipcode || ''}`
                        },
                    },
                    {
                        targets: 6,
                        data: null,
                        width : '200px',
                        orderable: true,
                        render: function (data, type, row) {
                            if(searchTable == 'Pending') return `<a href="#" class="btn btn-sm btn-light-warning fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal">Waiting for Approval</a>`;
                            else if(searchTable == 'Decline') return `<a href="#" class="btn btn-sm btn-light-danger fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal">Decline</a>`;
                            return `<a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal">Approved</a>`;
                        },
                    },
                    {
                        targets: 9,
                        data: null,
                        width : '200px',
                        orderable: true,
                        render: function (data, type, row) {
                            if(data == 1) return `<a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal">Active</a>`;
                            return `<a href="#" class="btn btn-sm btn-light-danger fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal">Deactive</a>`;
                        },
                    },
                ],
                drawCallback : function( settings ) {
                    let checkActiontag = document.querySelectorAll('[data-checkaction]');
                    [...checkActiontag].forEach(e => e.addEventListener('click', function(event){ checkboxfunction(event) }))
                }
            });
        }
    }
}();
KTUtil.onDOMContentLoaded(function () {
    PayIn.init();
})
