"use strict";

const PayIn = function(){
    var searchTable = `pending`;
    var searchoffer = `Pending`
    var table;
    var table_log;
    var offerTable;
    var rendering;
    var bulkaction = [];
    var offerbulk = [];
    var toogle_datatable = null;
    var currnetDiv = 'booking'
    // var update_approval;
    var modalEl;
    var modal;
    var appointment_id = [];

    const initfun = function (){
        [...rendering].forEach(e=> e.addEventListener('click', function (event){ bulkaction = []; offerbulk = []; Reloadtable(event) }) );
        toogle_datatable = [...document.querySelectorAll('.toogle_datatable')];
    }
    
    const Switealert = function(Msg,status){
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

    const checkboxoffer = function(event){
        let id = parseInt(event.target.value)
        if(event.target.checked){
            offerbulk.push(id)
            return
        }

        const index = offerbulk.indexOf(id);
        if (index > -1) { // only splice array when item is found
            offerbulk.splice(index, 1); // 2nd parameter means remove one item only
            return
        }
    }
    const update_approval = function(status){
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
                    url:AppStatus ,
                    method:"post",
                    data:{
                        "_token": csrf,
                        id:bulkaction,
                        status:status.target.value
                    },
                    success:function(data){
                        if(data.status){
                            bulkaction = [];
                            Switealert((data.status)?data.msg:'error',(data.status)?'success':'error')
                            table.table().draw();
                        }else{
                            Switealert('','error')
                        }
                    }
                })
            }
        }))
    }

    const update_offer_approval = function(status){
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
                    url:offerStatus ,
                    method:"post",
                    data:{
                        "_token": csrf,
                        id:offerbulk,
                        status:status.target.value
                    },
                    success:function(data){
                        if(data.status){
                            offerbulk = [];
                            Switealert((data.status)?data.msg:'error',(data.status)?'success':'error')
                            offerTable.table().draw();
                        }else{
                            Switealert('','error')
                        }
                    }
                })
            }
        }))
    }

    const Reloadtable = function(pare){
        // if(currnetDiv != pare.target.dataset.rendering) switch_Datatable();
        currnetDiv = pare.target.dataset.rendering
        if(currnetDiv == 'booking'){
            searchTable =  pare.target.value;
            table.table().draw();
            [...document.querySelectorAll('[data-apptick]')].forEach(e => (e.dataset.apptick == searchTable)?e.hidden = false:e.hidden= true);
        }else{
            searchoffer = pare.target.value;
            offerTable.table().draw();
            [...document.querySelectorAll('[data-offtick]')].forEach(e => (e.dataset.offtick == searchoffer)?e.hidden = false:e.hidden= true);
        }
    }

    const switch_Datatable = function(){
        toogle_datatable.forEach(e => { e.hidden = !e.hidden})
    }
    const popModel = function(e){
        const id = e.target.dataset.id;
        $.ajax({
            url:View,
            method:"GET",
            data:{
            _token: csrf,
            id:id
            },
            success:function(data){
                if(data.status){
                    console.log(data)
                    render_modal(data.App_data);
                    table_log.clear();
                    table_log.rows.add(data.App_log.original.data);
                    table_log.draw();
                }else{
                    var Ptag = "";
                    for(var error in data.errors) { Ptag += data.errors[error]+', '; };
                    Switealert(Ptag,'error')
                }
            }
        });
    }

    return {
        init : function (){

            rendering = document.querySelectorAll('[data-rendering]');
          
            // modalEl = document.getElementById('view_app');
            // modal = new bootstrap.Modal(modalEl);

            initfun()
            table_log = $("#App_log").DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
                "paging": false,
                "dom": "<'table-responsive'tr>",
                columns: [
                    { data: 'appointment_id'},
                    { data: 'action_by'},
                    { data: 'action'},
                    { data: 'description'},
                    { data: 'created_at'},
                ],
            });
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
                    url : appurl,
                    type: 'POST',
                    data:{
                        "_token": csrf,
                        columnsDef : [],
                        searchTable: function () { // dynamic
                            return  searchTable;
                        },
                    }
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'id'},
                    { data: 'consultant_id'},
                    { data: 'customer_id'},
                    { data: 'cons_date_slot' },
                    { data: 'cus_date_slot' },
                    { data: 'pay_in_status' },
                    { data: 'status' },
                    { data: 'action'},
                ],
                columnDefs : [
                    {
                        targets: 1,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `ID : BK-${data}<br>Type : ${row.appointment_type}`
                        },
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                           if(searchTable != 'Pending' || !row.checkcomfee) {
                            return `<button href="#" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#view_app" data-popup class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                            <span data-id="${row.id}"  class="svg-icon svg-icon-3">
                                <svg data-id="${row.id}"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path data-id="${row.id}"  d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                    <path data-id="${row.id}"  d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                </svg>
                            </span>
                        </button>`;
                            }
                            return `<input  class="typecheck" ${bulkaction.includes(row.id)?'checked':''} type="checkbox" data-checkaction value='${row.id}' >
                                <button href="#" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#view_app" data-popup class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                                <span data-id="${row.id}"  class="svg-icon svg-icon-3">
                                    <svg data-id="${row.id}"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path data-id="${row.id}"  d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                        <path data-id="${row.id}"  d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                    </svg>
                                </span>
                            </button>`;
                        },
                    },
                    {
                        targets: 2,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(!data) return ''
                            data = JSON.parse(data);
                           
                            return `Name : <b>${data.name}</b><br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                            Email : ${data.email} `
                        },
                    },
                    {
                        targets: 3,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(!data) return ''
                            data = JSON.parse(data);
                           
                            return `Name : <b>${data.name}</b><br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                            Email : ${data.email}`
                        },
                    },
                    {
                        targets: 4,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `Amount : <b>${data.Amount} </b><br>Commission Amount : <b>${data.ComissionAmount} </b><i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Consultant Fee" aria-label="Consultant Fee"></i> `
                        },
                    },
                    {
                        targets: 5,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `Amount : <b> ${data.Amount} </b> <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Consultant Fee" aria-label="Consultant Fee"></i>`
                        },
                    },
                    {
                        targets: 7,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            let success = 'success';
                            if(data == 'Pending') success = 'primary'
                            if(data == 'NoShowByCustomer' || data == 'NoShowByConsultant'){ 
                                success = 'info' 
                                return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${(data == 'NoShowByCustomer')?'No Show By Customer':'No Show By Consultant'}</a>`
                            }
                            if(data == 'Cancelled'){ 
                                success = 'danger' 
                                if(row.cancell_customer == null && row.cancell_consultant == null ) return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">Cancelled</a>`
                                return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${(row.cancell_customer != null)?'Cancelled By Customer':'Cancelled By Consultant'}</a>`
                            }
                            
                            return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${data}</a>`
                        },
                    },
                ],

                drawCallback : function( settings ) {
                    let checkActiontag = document.querySelectorAll('[data-checkaction]');
                    [...checkActiontag].forEach(e => e.addEventListener('click', function(event){ checkboxfunction(event) }))
                    
                    let popup = document.querySelectorAll('[data-popup]');
                    [...popup].forEach(e => e.addEventListener('click', function(event){ popModel(event) }))

                    let app = document.querySelectorAll('[data-app]');
                    [...app].forEach(e => e.addEventListener('click', function(event){ update_approval(event) }))

                    let dec = document.querySelectorAll('[data-decline]');
                    [...dec].forEach(e => e.addEventListener('click', function(event){ update_approval(event) }))

                }
            })

            offerTable = $("#kt_customers_offer").DataTable({
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
                    url : offurl,
                    type: 'POST',
                    data:{
                        "_token": csrf,
                        columnsDef : [],
                        searchTable: function () { // dynamic
                            return  searchoffer;
                        },
                    }
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'id'},
                    { data: 'consultant_id'},
                    { data: 'customer_id'},
                    { data: 'consultant_amount' },
                    { data: 'cus_amount' },
                    { data: 'pay_in' },
                    { data: 'action'},
                ],
                columnDefs : [
                    {
                        targets: 1,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `ID : ${row.payment_id}`
                        },
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(!row.checkofferfee || row.pay_in == 2 || row.pay_in == 3) return ``;
                            return `<input  class="typecheck" ${offerbulk.includes(row.id)?'checked':''} type="checkbox" data-offercheck value='${row.id}'>`;
                        },
                    },
                    {
                        targets: 2,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(!data) return ''
                            data = JSON.parse(data);
                            return `Name : <b>${data.name}</b><br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                            Email : ${data.email} `
                        },
                    },
                    {
                        targets: 3,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(!data) return ''
                            data = JSON.parse(data);
                            return `Name : <b>${data.name}</b><br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                            Email : ${data.email}`
                        },
                    },
                    {
                        targets: 4,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `Amount : <b>${data.consultant_currenct.currencycode} ${data.consultant_amount} </b><br>Commission Amount : <b>
                            ${data.ComissionAmount} </b><i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Consultant Fee"
                            aria-label="Consultant Fee"></i> `
                        },
                    },
                    {
                        targets: 5,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `Amount : <b> ${data.customer_currency.currencycode} ${data.customer_amount} </b> <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Consultant Fee" aria-label="Consultant Fee"></i>`
                        },
                    },
                    {
                        targets: 6,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            let success = 'success', status = 'Approved';
                            if(data == 1){ success = 'primary';status = 'Pending'}
                            else if(data == 3){ success = 'danger'; status = 'Decline' }
                            return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${status}</a>`
                        },
                    },
                ],

                drawCallback : function( settings ) {
                    let checkActiontag = document.querySelectorAll('[data-offercheck]');
                    [...checkActiontag].forEach(e => e.addEventListener('click', function(event){ checkboxoffer(event) }))

                    let app = document.querySelectorAll('[data-appoffer]');
                    [...app].forEach(e => e.addEventListener('click', function(event){ update_offer_approval(event) }))

                    let dec = document.querySelectorAll('[data-declineoffer]');
                    [...dec].forEach(e => e.addEventListener('click', function(event){ update_offer_approval(event) }))

                }
            })
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    PayIn.init();
})


    function template(e){
       
    }

    function render_modal(data){
        
        $('#view_app').modal('show');
        document.querySelectorAll('[data-app-id]').forEach(e => { e.value =  `${data.id}` })
        document.querySelectorAll('[data-booking-id]').forEach(e => { e.innerText =  `BK-${data.id}` })
        console.log(data);
        document.querySelectorAll('[data-cus-name]').forEach(e => { e.innerText =  `${data.customer.name}` })
        document.querySelectorAll('[data-cus-phone]').forEach(e => { e.innerText =  `${data.customer.phone_no}` })
        document.querySelectorAll('[data-cus-email]').forEach(e => { e.innerText =  `${data.customer.email}` })
       
        document.querySelectorAll('[data-con-name]').forEach(e => { e.innerText =  `${data.consultant.name}` })
        document.querySelector('[data-con-phone]').innerText =  `${data.consultant.phone_no}`
        document.querySelector('[data-con-email]').innerText =  `${data.consultant.email}`
        document.querySelector('[data-con-amount]').innerText =  `${data.conAmount}`
        document.querySelector('[data-cus-amount]').innerText =  `${data.cusAmount}`
        document.querySelector('[data-app-type]').innerText =  `${data.appointment_type}`
      
        document.querySelector('[data-con-timezone]').innerText =  `${data.consultantTimeZone}`
        document.querySelector('[data-cus-timezone]').innerText =  `${data.consultantTimeZone}`
        document.querySelector('[data-con-timeslot]').innerText =  `${data.consultantTime}`
        document.querySelector('[data-cus-timeslot]').innerText =  `${data.customerTime}`
        document.querySelector('[data-cus-date]').innerText =  `${data.customerDate}`
        document.querySelector('[data-con-date]').innerText =  `${data.consultantDate}`
        // document.querySelector('[data-com-amount]').innerText =  `${data.ComissionAmount}`
        
        if(`${data.status}` == "Confirmed" ){
            document.querySelector('[data-app-status]').innerText =  `${data.status}`
            document.querySelector('[data-app-status]').className =  'badge badge-success fs-5'
        }
        if(`${data.status}` == "Pending" ){
            console.log('pp')
            document.querySelector('[data-app-status]').innerText =  `${data.status}`
            document.querySelector('[data-app-status]').className =  'badge badge-primary fs-5'
        }
        if(`${data.status}` == "Completed" ){
            document.querySelector('[data-app-status]').innerText =  `${data.status}`
            document.querySelector('[data-app-status]').className =  'badge badge-success fs-5'
        }
        if(`${data.status}` == "Cancelled" ){
            let text = data.status;
            if(data.cancell_customer != null || data.cancell_consultant != null ){
                text = `${(data.cancell_customer != null)?'Cancelled By Customer':'Cancelled By Consultant'}`;
            } 
            document.querySelector('[data-app-status]').innerText =  `${text}`
            document.querySelector('[data-app-status]').className =  'badge badge-danger fs-5'
        }
        
        if(data.status == 'NoShowByCustomer' || data.status == 'NoShowByConsultant'){ 
            document.querySelector('[data-app-status]').innerText =  `${(data.status == 'NoShowByCustomer')?'No Show By Customer':'No Show By Consultant'}`
            document.querySelector('[data-app-status]').className =  'badge badge-info fs-5'
        }
    }

   