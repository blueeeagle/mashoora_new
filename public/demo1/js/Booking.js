"use strict";

const Booking = function(){
    var searchTable = `pending`;
    var table;
    var table_log;
    var rendering;
    var selecterDiv;
    var bulkaction = [];
    var modalEl;
    var modal;
    var appointment_id = [];

    const PendingOption = [['Confirmed','Accept'],['Reject','Reject']];
    const BookingOption = [['Completed','Completed'],['Cancelled_by_customer','Cancelled by Customer'],['Cancelled_by_consultant','Cancelled by Consultant'],['NoShowByCustomer','No Show by Customer'],['NoShowByConsultant','No Show by Consultant']];

    const initfun = function (){
        [...rendering].forEach(e=> e.addEventListener('click', function (event){ bulkaction = []; Reloadtable(event) }) )
        Bookingaction();
        BookingactionForModal();
        $('#Bookingaction').on('select2:select', function (e) {
            var data = e.params.data;
            if(bulkaction.length > 0) updatestatus(data.id)
        });
        
        $('#BookingactionForModal').on('select2:select', function (e) {
            appointment_id.push(document.querySelector('[data-app-id]').value);
            var data = e.params.data;
            updatestatusForModal(data.id)
        });
      
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
    const updatestatus = function(status){
        if(status == "") return
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
                    url: appStatus,
                    method:"post",
                    data:{
                        "_token": csrf,
                        id:bulkaction,
                        status:status
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
    
    const updatestatusForModal = function(status){
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
                        url: appStatus,
                        method:"post",
                        data:{
                            "_token": csrf,
                            id:appointment_id,
                            status:status
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

    const Bookingaction = function(){
        let option = '<option>Take Action</option>';
        if(searchTable == 'pending'){
            PendingOption.forEach((e)=> {
                option += `<option value='${e[0]}'>${e[1]}</option>`
            })
        }
        if(searchTable == 'booked'){
            BookingOption.forEach((e ,i)=> {
                option += `<option value='${e[0]}'>${e[1]}</option>`
            })
        }
        if(searchTable != 'pending' && searchTable != 'booked') selecterDiv.hidden = true
        else selecterDiv.hidden = false
        $('#Bookingaction').html(option)
        
    } 
    const BookingactionForModal = function(){
        let option = '<option></option>';
        if(searchTable == 'pending'){
            PendingOption.forEach((e)=> {
                option += `<option value='${e[0]}'>${e[1]}</option>`
            })
        }
        if(searchTable == 'booked'){
            BookingOption.forEach((e ,i)=> {
                option += `<option value='${e[0]}'>${e[1]}</option>`
            })
        }
       
        if(searchTable == 'pending' || searchTable == 'booked') document.getElementById('selecterDiv').hidden = false
        else document.getElementById('selecterDiv').hidden = true
        $('#BookingactionForModal').html(option)
        
    }

    const Reloadtable = function(pare){
        searchTable =  pare.target.value
        table.table().draw();
        Bookingaction();
        BookingactionForModal();
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
            selecterDiv = document.getElementById('selecterDiv_two')
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
                    { data: 'id'},
                    { data: 'consultant_id'},
                    { data: 'customer_id'},
                    { data: 'cons_date_slot'},
                    { data: 'cus_date_slot'},
                    { data: 'status'},
                    { data: 'action'},
                ],
                columnDefs : [
                    {
                        targets: 0,
                        data: null,
                        width : 50,
                        orderable: false,
                        render: function (data, type, row) {
                            return `ID : BK-${data}<br>Type : <span style="text-transform:capitalize;">${row.appointment_type}</span>`
                        },
                    },
                    {
                        targets: 2,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(!data) return ''
                            data = JSON.parse(data);
                           
                            return `Name : ${data.name}<br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                            Email : ${data.email}<br>Country : ${data.country?.country_name} `
                        },
                    },
                    {
                        targets: 1,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            data = JSON.parse(data);
                            return `Name : ${data.name}<br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                            Email : ${data.email}<br>Country : ${data.country?.country_name} `
                        },
                    },
                    {
                        targets: 3,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `Date : ${data.Date}<br>Time: ${data.Time}<br>Amount : ${data.Amount}`
                        },
                    },
                    {
                        targets: 5,
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
                    {
                        targets: 4,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `Date : ${data.Date}<br>Time: ${data.Time}<br>Amount : ${data.Amount}`
                        },
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            if(searchTable != 'pending' && searchTable != 'booked') {
                            return `<button href="#" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#view_app" data-popup class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                            <span data-id="${row.id}"  class="svg-icon svg-icon-3">
                                <svg data-id="${row.id}"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path data-id="${row.id}"  d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                    <path data-id="${row.id}"  d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                </svg>
                            </span>
                        </button>`;
                            }
                            return `<input  class="typecheck" ${bulkaction.includes(row.id)?'checked':''} type="checkbox" data-checkAction value='${row.id}' >
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
                ],

                drawCallback : function( settings ) {
                    let checkActiontag = document.querySelectorAll('[data-checkaction]');
                    [...checkActiontag].forEach(e => e.addEventListener('click', function(event){ checkboxfunction(event) }))
                    
                    let popup = document.querySelectorAll('[data-popup]');
                    [...popup].forEach(e => e.addEventListener('click', function(event){ popModel(event) }))
                }
            })

        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    Booking.init();
})


    function template(e){
       
    }

    function render_modal(data){
         if(data.insurance == null){
            document.getElementById('is_insurance').setAttribute('hidden',true);
            document.querySelector('[data-insurance]').innerText =  '-'
        }
        else{
            document.getElementById('is_insurance').removeAttribute("hidden",true);
            document.querySelector('[data-insurance]').innerText =  `${data.insurance.comapany_name}`
            document.querySelectorAll('[data-policyid]').forEach(e => { e.innerText =  `${data.policyid}` })
        }
        $('#view_app').modal('show');
        document.querySelectorAll('[data-app-id]').forEach(e => { e.value =  `${data.id}` })
        document.querySelectorAll('[data-booking-id]').forEach(e => { e.innerText =  `BK-${data.id}` })
        console.log(data);
        document.querySelectorAll('[data-cus-name]').forEach(e => { e.innerText =  `${data.customer?.name}` })
        document.querySelectorAll('[data-cus-phone]').forEach(e => { e.innerText =  `${data.customer?.phone_no}` })
        document.querySelectorAll('[data-cus-email]').forEach(e => { e.innerText =  `${data.customer?.email}` })
       
        document.querySelectorAll('[data-con-name]').forEach(e => { e.innerText =  `${data.consultant?.name}` })
        document.querySelector('[data-con-phone]').innerText =  `${data.consultant?.phone_no}`
        document.querySelector('[data-con-email]').innerText =  `${data.consultant?.email}`
        document.querySelector('[data-con-amount]').innerText =  `${data.conAmount}`
        document.querySelector('[data-cus-amount]').innerText =  `${data.cusAmount}`
        document.querySelector('[data-app-type]').innerText =  `${data.appointment_type}`
      
        document.querySelector('[data-con-timezone]').innerText =  `${data.consultantTimeZone}`
        document.querySelector('[data-cus-timezone]').innerText =  `${data.consultantTimeZone}`
        document.querySelector('[data-con-timeslot]').innerText =  `${data.consultantTime}`
        document.querySelector('[data-cus-timeslot]').innerText =  `${data.customerTime}`
        document.querySelector('[data-cus-date]').innerText =  `${data.customerDate}`
        document.querySelector('[data-con-date]').innerText =  `${data.consultantDate}`
        
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
       
        //     console.log('conf');
        //     document.querySelector('[data-status-update]').value='Action';
        //     document.getElementById('showStatusUpdate').removeAttribute("hidden",true);
        //     document.querySelector('[data-app-status]').innerText =  `${data.status}`
        // }

        // if(`${data.status}` == "Completed" ){
        //     console.log('Completed');
        //     document.getElementById('showStatusUpdate').setAttribute('hidden',true);
        //     document.querySelector('[data-app-status]').innerText =  `${data.status}`
        // }

        // if(`${data.status}` == "Cancelled" ){
        //       console.log('Cancelled');
        //     document.getElementById('showStatusUpdate').setAttribute('hidden',true);
        //     document.querySelector('[data-app-status]').innerText =  `${data.status}`
        // }
    }

    $("#status").on('change', function (e) {
        // console.log(e);
        var data = e.currentTarget.value
        var app_id =[];
        app_id.push(document.getElementById('app_id').value)

        $.ajax({
            url:"{{route('appointment.status')}}",
            method:"POST",
            data:{id:app_id,data:data,"_token": "{{ csrf_token() }}",},
            success:function(data){
                if(data.status){
                    $('#view_app').modal('hide');
                    const msg = data.msg;
                    Swal.fire({
                        text: msg,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                    table.ajax.reload(null, false);

                }
                else{
                    alert('something wrong');
                }

            }
        })
    });
