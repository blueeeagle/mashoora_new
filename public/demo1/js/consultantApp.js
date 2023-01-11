"use strict";

const PayIn = function(){
    var searchTable = `Pending`;
    var table = null;
    var bulkaction = []
    var rendering = null

    const initfun = function (){
        [...rendering].forEach(e=> e.addEventListener('click', function (event){ bulkaction = []; Reloadtable(event) }) );
        let app = document.querySelectorAll('[data-app]');
        [...app].forEach(e => e.addEventListener('click', function(event){ update_approval(event) }))
    }

    const convertcomTemp = function(admin_country,country,amount,type){
        if(type == 0) return `${country.currency.currencycode} ${amount} / ${admin_country.currency.currencycode} ${((amount/country.currency.price)*admin_country.currency.price).toFixed(2)}`
        else return `${amount} %`
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
    
    const buttonstatus = function(){
        if(searchTable == 'Decline'){
            decline.hidden = true;
            approve.hidden = false;
        }else if(searchTable == 'Approved'){
            decline.hidden = false;
            approve.hidden = true;
        }else{
            decline.hidden = false;
            approve.hidden = false;
        }
    }
    const Reloadtable = function(pare){
        searchTable =  pare.target.value
        table.table().draw();
        [...document.querySelectorAll('[data-apptick]')].forEach(e => (e.dataset.apptick == searchTable)?e.hidden = false:e.hidden= true);
        buttonstatus();
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

    return {
        init : function(){
            rendering = document.querySelectorAll('[data-rendering]');

            initfun()
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
                    url : datatableurl,
                    type: 'POST',
                    data: {
                        "_token": csrf,
                        columnsDef : [],
                        searchTable: function () { // dynamic
                            return  searchTable;
                        },
                    }
                },
                columns: [
                    { data : 'DT_RowIndex' },
                    { data : 'picture' },
                    { data : 'phone_no' },
                    { data : 'name' },
                    { data : 'commission_fee' },
                    { data : 'step' },
                    // { data : 'address' },
                    { data : 'approval' },
                    { data : 'status' },
                    { data : 'action' },
                ],
                columnDefs : [
                    {
                        targets: -1,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            if(searchTable == 'Approved')`<a href="${data.view}" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </span>
                                </a>
                            `;
                            return `${row.app_status || searchTable != 'Pending'  ?`<input  class="typecheck" ${bulkaction.includes(row.id)?'checked':''} type="checkbox" data-checkaction value='${row.id}' >`:''}
                                <a href="${data.view}" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </span>
                                </a>
                            `;
                        },
                    },
                    // {
                    //     targets: 5,
                    //     data: null,
                    //     orderable: true,
                    //     render: function (data, type, row) {
                    //         let cat = `<a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">${data.cat }</a><br>`
                    //         let sub = ``
                    //         data.sub.forEach(e => sub += `<a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">${e}</a>`)
                    //         return cat+sub;
                    //     },
                    // },
                    {
                        targets: 7,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            let success = 'success', status = 'Active';
                            if(data == 0){ success = 'danger'; status = 'Deactive' }
                            return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${status}</a>`
                        },
                    },
                    // {
                    //     targets: 6,
                    //     data: null,
                    //     orderable: true,
                    //     render: function (data, type, row) {
                    //         return `<div class="fs-6 fw-bold text-gray-600">
                    //             ${row.city?.city_name || ''}
					// 			,<br>${row.state?.state_name}
					// 			,<br>${row.addcountry?.country_name}
                    //             ,<br> Zipcode : ${row.zipcode}
                    //         </div>`
                    //     },
                    // },
                    {
                        targets: 6,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            if(data == 2) return `<a href="#" class="btn btn-sm btn-light-sucess fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">Approved</a>`
                            if(data == 1) return `<a href="#" class="btn btn-sm btn-light-danger fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">Approval Decline</a>`
                            return `<a href="#" class="btn btn-sm btn-light-warning fw-bolder ms-2 fs-8 py-1 px-3"data-bs-toggle="modal">Waiting for Approval</a>`
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
                                            <img class="rounded-circle z-depth-2" src="${data}">
                                        </div>
                                    </div>`;
                            }
                            return '';
                        },
                    },
                    {
                        targets: 4,
                        data: null,
                        orderable: true,
                        render: function (data, type, row) {
                            data = JSON.parse(data);
                            let connfee = (row.com_con_amount != null)?convertcomTemp(admin_country, data, row.com_con_amount, row.com_con_type):'Not Added';
                            let offerfee = (row.com_con_amount != null)?convertcomTemp(admin_country, data, row.com_off_amount, row.com_off_type):'Not Added';
                            let payout = (row.com_con_amount != null)?convertcomTemp(admin_country, data, row.com_pay_amount, 0):'Not Added';
                            return `Consultant Fee : ${connfee}<br/>
                            Offers : ${offerfee}<br/> Payout : ${payout}`
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
