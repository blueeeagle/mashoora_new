"use strict";

const PayIn = function () {
    var table = null
    var searchTable = 'Pending'
    var rendering;
    var modalEl;
    var modal;
    var form;
    var submitButton;
    var cancelButton;
    var startFlatpickr;
    var close;
    var id =null
    const initfun = function (){
        [...rendering].forEach(e=> e.addEventListener('click', function (event){ Reloadtable(event) }) );

        $("#status").on('select2:select', function (e) {
            var data = e.params.data;
            if(data.id == 2) {
                [...document.querySelectorAll('[data-approvel')].forEach(e => e.hidden = false);
                document.getElementById('Txid').required = true
                $('#typetrx').prop('required',true)
            }else {
                [...document.querySelectorAll('[data-approvel')].forEach(e => e.hidden = true);
                document.getElementById('Txid').required = false
                $('#typetrx').prop('required',false)
            }
            document.getElementById('Txid').value = '';
        });
        
        startFlatpickr = flatpickr(document.getElementById('pay_date'), {
            enableTime: false,
            dateFormat: "Y-m-d",
        });
        
        form.addEventListener('submit', function (e) {
            e.preventDefault();
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        submitButton.disabled = true;
                        const formData = new FormData(e.target);
                        formData.append('id',id);
                        formData.append("_token", csrf);
                        fetch(app_status,{
                            method: 'POST', // or 'PUT'
                            body: formData
                        })
                        .then(response => response.json())
                        .then((response) => {
                            if (response.status) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                table.table().draw();
                                Swal.fire({
                                    text: "successfully!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        close.click();
                                    }
                                });
                            }
                        })
                        .catch(error => { });



        });

        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    close.click();
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

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
    
    const Reloadtable = function(pare){
        searchTable =  pare.target.value
        table.table().draw();
        [...document.querySelectorAll('[data-apptick]')].forEach(e => (e.dataset.apptick == searchTable)?e.hidden = false:e.hidden= true);
    }

    return {

        init: function () {
            rendering = document.querySelectorAll('[data-rendering]');
            modalEl = document.getElementById('statusupdate');

            if (!modalEl) {
                return;
            }

            modal = new bootstrap.Modal(modalEl);

            form = document.getElementById('statusform');
            submitButton = modalEl.querySelector('.kt_modal_new_target_submit');
            cancelButton = modalEl.querySelector('.kt_modal_new_target_cancel');
            close = modalEl.querySelector('div[data-bs-dismiss]');

            initfun()
            table = $("#kt_customers_table").DataTable({
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
                bInfo: false,
                layout: {
                    scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                    footer: false, // display/hide footer
                },
                ajax: {
                    url: pay_out,
                    type: 'POST',
                    data: {
                        "_token": csrf,
                        columnsDef : [],
                        searchTable: function () { // dynamic
                            return  searchTable;
                        },
                    },
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'consultant'
                    },
                    {
                        data: 'commands'
                    },
                    {
                        data: 'pay_updated_date'
                    },
                    {
                        data: 'consultant_amount'
                    },
                    {
                        data: 'admin_amount'
                    },
                    {
                        data: 'isbank'
                    },
                    {
                        data: 'pay_out'
                    },
                    {
                        data: 'pay_out'
                    },
                ],
                columnDefs: [{
                        targets: 1,
                        data: null,
                        width:'250px',
                        orderable: true,
                        render: function (data, type, row) {
                            data = JSON.parse(data);
                            return `Name : ${data.name}<br>Phone No : ${data.country?.dialing} ${data.phone_no}<br>
                                Email : ${data.email}<br>Country : ${data.country?.country_name} `
                        },
                    },
                    {
                        targets: 3,
                        render: function (data, type, row) {
                            return `Requested Date : ${data.Request_date}<br/>Updated : ${data.updated}`;
                        },

                    },
                    {
                        targets: 2,
                        width:'250px',
                        render: function (data, type, row) {
                            if(searchTable != 'Decline') return `Type : ${row.type || ''}<br/>Transaction ID : ${row.Txid || ''}<br/>Comments : ${row.commands || ''}<br/> Pay Date : ${row.pay_date || ''}`;
                            else return `Comments : ${row.commands || ''}`;
                        },

                    },
                    {
                        targets: 4,
                        render: function (data, type, row) {
                            return data.amount;
                        },

                    },
                    {
                        targets: 5,
                        render: function (data, type, row) {
                            return data.amount;
                        },

                    },
                    {
                        targets: 6,
                        render: function (data, type, row) {
                            let success = 'success', status = 'Verified';
                            if(data == '0') success = 'danger', status = 'Not Verified';
                            return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${status}</a>`
                        },

                    },
                    {
                        targets: 7,
                        render: function (data, type, row) {
                            let success = 'success', status = 'Approved';
                            if(data == 1){ success = 'primary';status = 'Pending'}
                            else if(data == 3){ success = 'danger'; status = 'Decline' }
                            return `<a href="#" class="btn btn-sm btn-light-${success} fw-bolder ms-2 fs-8 py-1 px-3">${status}</a>`
                        },

                    },
                    {
                        targets: -1,
                        render: function (data, type, row) {
                            if(searchTable != 'Pending' || row.isbank == '0') return ``;
                            return `<a href="#" data-bs-toggle="modal" data-bs-target="#statusupdate" data-openmodel=${row.id} class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" data-openmodel=${row.id}  width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                        </svg>
                                    </span>
                                </a>`;

                        },

                    }
                ],
                drawCallback: function (settings) {
                    if(searchTable != 'Pending') table.column(8).visible(false);
                    else table.column(8).visible(true);
                    [...document.querySelectorAll('[data-openmodel]')].forEach(e => e.addEventListener('click', function(event){
                        id = event.target.dataset.openmodel
                        document.getElementById('Txid').value = '';

                    }));
                }
            });
        }
    }
}();
KTUtil.onDOMContentLoaded(function () {
    PayIn.init();
})
