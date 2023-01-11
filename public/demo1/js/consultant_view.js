
const com_con_amount = document.getElementById('com_con_amount')
const com_off_amount = document.getElementById('com_off_amount')
const com_pay_amount = document.getElementById('com_pay_amount')

$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    window.dispatchEvent(new Event('resize'))
});

$(document).ready(function () {

    // Scheduling

    table1 = $("#kt_datatable3").DataTable({
        responsive: true,
        buttons: [
            'print',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ],
        // Pagination settings
        dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        // read more: https://datatables.net/examples/basic_init/dom.html

        lengthMenu: [5, 10, 25, 100],

        pageLength: 10,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('activities.schedules.getscheduleDatatable')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': `{{ $consultant->id }}`,
                columnsDef: ['id', 'created_at', 'fromto', 'scheduleType']
            }

        },
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'created_at'
            },
            {
                data: 'fromto'
            },
            {
                data: 'scheduleType'
            },
            {
                data: 'action'
            }
        ],
        columnDefs: [{
            targets: -1,
            data: null,
            orderable: false,
            className: 'text-end',
            render: function (data, type, row) {
                return `
                            <a href="${data.Delete}" delete_calender class="btn btn-icon btn-danger"><i href="${data.Delete}" delete class="las la-trash fs-2 me-2"></i></a>
                        `;
            },
        }, ],
        drawCallback: function (settings) {}
    });



    $("#kt_datatable4").DataTable();
    $("#kt_datatable5").DataTable();
    $("#kt_datatable7").DataTable();
    $("#kt_datatable8").DataTable();



    table4 = $("#kt_datatable6").DataTable({
        responsive: true,
        buttons: [
            'print',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ],
        // Pagination settings
        dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        // read more: https://datatables.net/examples/basic_init/dom.html

        lengthMenu: [5, 10, 25, 100],

        pageLength: 10,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('history.purchase.datatable')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                columnsDef: ['id', 'title', 'updated_at', 'status']
            }

        },
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'created_at'
            },
            {
                data: 'booking_id'
            },
            {
                data: 'app_booked_by'
            },
            {
                data: 'app_booked_with'
            },
            {
                data: 'xx_usd'
            },
            {
                data: 'discount_amount'
            },
            {
                data: 'amount'
            },
            {
                data: 'status'
            }
        ],

        drawCallback: function (settings) {}
    });
});
var KTJSTreeCheckable = {
    init: function () {
        $("#kt_docs_jstree_basic")
            // listen for event
            .on('changed.jstree', function (e, data) {
                var i, j, r = [];
                for (i = 0, j = data.selected.length; i < j; i++) {
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                // categorie_id.value = r.join(',');
                // console.log(r);

                let temparray = $("#kt_docs_jstree_basic").jstree("get_selected")
                categorie_id.value = temparray.join(',');
                $.ajax({
                    url: "{{route('consultant.consultant.getSubCategory')}}",
                    method: "POST",
                    data: {
                        "_token": csrf,
                        categorie_id: categorie_id.value
                    },
                    success: function (data) {
                        $('#kt_docs_jstree_basic1').jstree(true).settings.core.data = data.tree;
                        $('#kt_docs_jstree_basic1').jstree(true).refresh();

                    }
                })

            })
            .jstree({
                'plugins': ["wholerow", "checkbox", "types"],
                core: {
                    themes: {
                        responsive: !1
                    },
                    data: { tree }
                },
                "types": {
                    "default": {
                        "icon": "fa fa-folder text-warning"
                    },
                    "file": {
                        "icon": "fa fa-file  text-warning"
                    }
                },
            })
    }
}

KTUtil.onDOMContentLoaded((function () {
    KTJSTreeCheckable.init()
}));
const create_Slot = document.getElementById('create_Slot');
create_Slot.addEventListener('click', function () {
    variant($('#from_date').val(), $('#to_date').val())
})
var _token = `{{ csrf_token() }}`

const formrepeat = $('.kt_docs_repeater_nested');
$("#from_date").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format("YYYY"), 10),

}, function (start, end, label) {
    let toDay = new Date($("#from_date").val());
    $("#to_date").val($("#from_date").val());
    let PlusThirtyDays = new Date();
    PlusThirtyDays.setDate(toDay.getDate() + 30)
    $("#to_date").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"), 10),
        maxDate: formatDate(PlusThirtyDays),
        minDate: formatDate(toDay),

    }, function (start, end, label) {

    });
});

$("#recurring").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format("YYYY"), 10),
    locale: {
        format: '{{ strtoupper($companeySetting->date_format) }}'
    }
}, function (start, end, label) {

});
const date = new Date();
formrepeat.repeater({
    repeaters: [{
        selector: '.inner-repeater',
        isFirstItemUndeletable: true,
        defaultValues: {
            'sunday_from': `${date.getHours()}:${date.getMinutes()}`,
            'sunday_to': `${date.getHours()}:${date.getMinutes()}`
        },
        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    }],

    show: function () {
        $(this).slideDown();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});

function formatDate(date) {
    return [
        padTo2Digits(date.getMonth() + 1),
        padTo2Digits(date.getDate()),
        date.getFullYear(),
    ].join('/');
}

function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}
const Standard = function () {
    formrepeat.setList([{
            title: 'Sunday',
            'day': 'sunday'
        },
        {
            title: 'Monday',
            'day': 'monday'
        },
        {
            title: 'Tuesday',
            'day': 'tuesday'
        },
        {
            title: 'Wednesday',
            'day': 'wednesday'
        },
        {
            title: 'Thursday',
            'day': 'thursday'
        },
        {
            title: 'Friday',
            'day': 'friday'
        },
        {
            title: 'Saturday',
            'day': 'saturday'
        },
    ])
}

const variant = function (start, end) {
    let data = []
    var start = new Date(start);
    var end = new Date(end);

    var loop = new Date(start);
    while (loop <= end) {
        data.push({
            title: `${formatDate(loop)}`,
            day: `${formatDate(loop)}`
        })
        var newDate = loop.setDate(loop.getDate() + 1);
        loop = new Date(newDate);
    }
    formrepeat.setList(data)
}
var table = null;
$(document).ready(function () {
    table = $("#kt_datatable").DataTable({
        responsive: true,
        buttons: [
            'print',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ],
        // Pagination settings
        dom: `<'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        // read more: https://datatables.net/examples/basic_init/dom.html

        lengthMenu: [5, 10, 25, 100],

        pageLength: 10,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('activities.schedules.getscheduleDatatable')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': `{{ $consultant->id }}`,
                columnsDef: ['id', 'created_at', 'fromto', 'scheduleType']
            }

        },
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'created_at'
            },
            {
                data: 'fromto'
            },
            {
                data: 'scheduleType'
            },
            {
                data: 'action'
            }
        ],
        columnDefs: [{
            targets: -1,
            data: null,
            orderable: false,
            className: 'text-end',
            render: function (data, type, row) {
                return `
                                <a href="${data.Delete}" delete_calender class="btn btn-icon btn-danger"><i href="${data.Delete}" delete class="las la-trash fs-2 me-2"></i></a>
                            `;
            },
        }, ],
        drawCallback: function (settings) {}
    });
});
document.body.addEventListener('click', function (event) {
    const e = event

    if (e.srcElement.hasAttribute('delete_calender')) {
        e.preventDefault()
        var text = e.srcElement.hasAttribute('text') ? e.srcElement.getAttribute('text') : 'Are you sure you want to delete ?'
        Swal.fire({
            text: text,
            icon: "warning",
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: "Yes, delete!",
            cancelButtonText: "No, cancel",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        }).then((function (t) {
            if (t.value) {
                let route = e.srcElement.getAttribute('href')
                let data = {
                    _token: _token
                }
                fetch(route, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        $('#trigerClick').click();
                        table.ajax.reload(null, false);
                        Switealert((data.status) ? data.msg : 'error', (data.status) ? 'success' : 'error')
                    });
            }
        }))
    }
}, true)
    function load_calendar() {
        // var calendarEl = document.getElementById('kt_calendar_app1')
        // calendar = new FullCalendar.Calendar(calendarEl)
        // calendar.render();
    }


const appfound = document.getElementById('appfound');
const appnotfound = document.getElementById('appnotfound');
const popup_edit = document.getElementById('kt_modal_view_event1_edit');
const popup_delete = document.getElementById('kt_modal_view_event1_delete');
const status = document.getElementById('status');
var _token = `{{ csrf_token() }}`

statusValue = document.getElementById("status").value;
map_id = document.getElementById("map_id").innerText;
reason = '';

function statusChange(e) {
    statusValue = e.value;

    map_id = document.getElementById("map_id").innerText;
    reason = document.getElementById("reason");

    if (e.value > 0) {

        actionReason.removeAttribute('hidden');
    } else {
        actionReason.setAttribute('hidden', true);
        reason.value = '';
    }
}

function saveStatus() {

    Reason = reason.value;
    Swal.fire({
        html: "Are you Sure?",
        icon: "info",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Save",
        cancelButtonText: 'Discard',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: 'btn btn-danger'
        },
    }).then((function (e) {
        if (e.value) {
            $.ajax({
                url: "{{ route('activities.schedules.appStatus') }}",
                method: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: statusValue,
                    map: map_id,
                    reason: Reason,
                },
                success: function (data) {
                    if (data.msg) {
                        Switealert(data.msg, 'success')
                    } else {
                        var Ptag = "";
                        for (var error in data.errors) {
                            Ptag += data.errors[error] + ', ';
                        };
                    }

                },
                error: function (erroe) {
                    console.log(erroe);
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    alert("Something is wrong");
                }

            })
        }
    }))
}

function Switealert(Msg, status) {
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

function enabledisable(input) {
    if (event.target.checked) {
        input.disabled = false
    } else {
        input.disabled = true
        input.value = 0
    }
}
var BasicDetails = null
var country_id = $("#country_id");
$("#country_code").select2({
    templateResult: formatState,
    width: 'resolve'
});

$("#country_code").change(function (e) {
    $('#phone_no').val('');

    var id = e.currentTarget.options[e.currentTarget.options.selectedIndex].value;
    let has_state = e.currentTarget.options[e.currentTarget.options.selectedIndex].dataset.has_state;
    if (has_state != "0") {
        stateDiv.show(500)
        state.attr('required');
    } else {
        stateDiv.hide(500)
        state.removeAttr('required');
    }
    country_id.val(id).trigger("change");
    $.ajax({
        url: "{{ route('master.country.getState')}}",
        method: "POST",
        data: {
            id: id,
            "_token": csrf,
        },
        success: function (data) {
            var option = `<option value=''>Select State</option>`
            var option1 = `<option selected>Select City</option>`

            if (data.states.length != null) {
                data.states.forEach((e) => {
                    option += '<option value=' + e.id + '>' + e.state_name + '</option>';
                })
            }
            if (data.city.length != null) {
                data.city.forEach((e) => {
                    option1 += '<option value=' + e.id + '>' + e.city_name + '</option>';
                })
            }
            state.html(option).trigger("change");
            city.html(option1).trigger("change");
            BasicDetails = data
            $("#dial_code").val(data.Country.dialing)
            // phone_no.val(data.Country.dialing)
            // countrycode.innerText = data.Country.dialing
            // landline.val(data.Country.dialing)
        }
    })
});

function formatState(state) {
    if (!state.id) return state.text;

    var baseUrl = `${ baseURl }/demo1/flags/1x1/`;
    var $state = $(
        `<span><img onerror="this.onerror=null;this.remove()" src="${baseUrl}/${state.text.toLowerCase()}.svg" class="img-flag" />${state.text}</span>`
    );
    return $state;
};

$("#country_code").on('select2:select', function (e) {
    var data = e.params.data;
    $.ajax({
        url: "{{route('master.country.getState')}}",
        method: "POST",
        data: {
            id: data.id,
            "_token": "{{ csrf_token() }}",
        },
        success: function (data) {
            console.log(data);
            if (data.Country) {

            }
        }
    })
});

$(window).on("load", function () {


    let com_con_type = document.querySelector('input[name="com_con_type"]:checked').value
    var amount = $('#com_con_amount').val();
    let AmountFlat = parseFloat(amount)
    let AmountFlatcurrency = admin_country.currency.price * consultant_country.currency.price * AmountFlat
    updateAmount(event.target, com_con_type)
    let voice = document.querySelector('input[name=voice]')
    let direct = document.querySelector('input[name=direct]')
    let text = document.querySelector('input[name=text]')
    let video = document.querySelector('input[name=video]')

    let video_current = document.getElementById("video_current")
    let voice_current = document.getElementById("voice_current")
    let text_current = document.getElementById("text_current")
    let direact_current = document.getElementById("direact_current")

    let video_base = document.getElementById("video_base")
    let voice_base = document.getElementById("voice_base")
    let text_base = document.getElementById("text_base")
    let direact_base = document.getElementById("direact_base")

    if (video.checked) {
        let value = parseFloat(document.querySelector('input[name=video_amount]').value)
        let basepriceconvert = admin_country.currency.price * consultant_country.currency.price * value

        video_current.innerText = `${value} ( ${ (com_con_type == 1)? ((value/100)*value) + value : value+AmountFlat} )`
        video_base.innerText = `${ Number(basepriceconvert).toFixed(2)} ( ${ (com_con_type == 1)? (((basepriceconvert/100)*basepriceconvert)+basepriceconvert).toFixed(2) : (basepriceconvert+AmountFlatcurrency).toFixed(2)} )`
    }
    if (voice.checked) {
        let value = parseFloat(document.querySelector('input[name=voice_amount]').value)
        let basepriceconvert = admin_country.currency.price * consultant_country.currency.price * value

        voice_current.innerText = `${value} ( ${ (com_con_type == 1)? ((value/100)*value) + value  : value+AmountFlat} )`
        voice_base.innerText = `${ Number(basepriceconvert).toFixed(2)} ( ${ (com_con_type == 1)? (((basepriceconvert/100)*basepriceconvert)+basepriceconvert).toFixed(2) : (basepriceconvert+AmountFlatcurrency).toFixed(2)} )`
    }
    if (text.checked) {
        let value = parseFloat(document.querySelector('input[name=text_amount]').value)
        let basepriceconvert = admin_country.currency.price * consultant_country.currency.price * value

        text_current.innerText = `${value} ( ${ (com_con_type == 1)? ((value/100)*value) + value  : value+AmountFlat} )`
        text_base.innerText = `${ Number(basepriceconvert).toFixed(2)} ( ${ (com_con_type == 1)? (((basepriceconvert/100)*basepriceconvert)+basepriceconvert).toFixed(2) : (basepriceconvert+AmountFlatcurrency).toFixed(2)} )`
    }
    if (direct.checked) {
        let value = parseFloat(document.querySelector('input[name=direct_amount]').value)
        let basepriceconvert = admin_country.currency.price * consultant_country.currency.price * value

        direact_current.innerText = `${value} ( ${ (com_con_type == 1)? ((value/100)*value) + value  : value+AmountFlat} )`
        direact_base.innerText = `${ Number(basepriceconvert).toFixed(2)} ( ${ (com_con_type == 1)? (((basepriceconvert/100)*basepriceconvert)+basepriceconvert).toFixed(2) : (basepriceconvert+AmountFlatcurrency).toFixed(2)} )`
    }

    firm_type($type);
    Insurance($type1);
});

function courencyconveter() {
    event.target.parentElement.lastElementChild.innerText = `Base Amount ${(admin_country.currency.price * consultant_country.currency.price * Number(event.target.value)).toFixed(2)}  ${admin_country.currency.currencycode}`
}

function CourencyFlatconveter(type) {
    const parentNode = event.target.parentNode.parentNode
    const inputvalue = parentNode.children[4].children[1]
    if (type == 0) {
        parentNode.children[4].children[2].innerText = `Base Amount ${(admin_country.currency.price * consultant_country.currency.price * Number(inputvalue.value)).toFixed(2)}  ${admin_country.currency.currencycode}`
    } else {
        parentNode.children[4].children[2].innerText = `%`
    }
}

function updateAmount(event, type) {
    if (type == 1) {
        event.value > 100 ? (event.value = 100) : event.value = event.value
    }
}

var firmType = 1;

function firm_type(type) {
    firmType = type
    if (type == 2) {
        $("#firmselectdiv").hide(500)
        $('#firm_choose').removeAttr('required');
        $('#firm_choose').val('');
    } else {
        $("#firmselectdiv").show(500)
        $('#firm_choose').attr('required');
    }

}

function Insurance(type) {

    if (type == 2) {
        $("#Insurancediv").hide(500)
        $('#insurance_id').val('');
        $('#Insurancediv').removeAttr('required');
    } else {
        $("#Insurancediv").show(500)
        $('#Insurancediv').attr('required');
    }
}

$("#firm_choose").select2({
    templateResult: insuransetemplate,
    templateSelection: insuransetemplate
});

$("#insurance_id").select2({
    templateResult: insuransetemplate,
    templateSelection: insuransetemplate
});

function insuransetemplate(state) {
    if (!state.id) return state.text;

    var imag = $(state.element).data('image');
    var $state = $(
        `<span><img style="width:25px;" onerror="this.onerror=null;this.remove()" src="${imag}" class="img-flag" />${state.text}</span>`
    );
    return $state;
}


com_con_amount.addEventListener('keyup', function (event) {
    let com_con_type = document.querySelector('input[name="com_con_type"]:checked').value
    let AmountFlat = parseFloat(event.target.value)
    let AmountFlatcurrency = admin_country.currency.price * consultant_country.currency.price * AmountFlat
    updateAmount(event.target, com_con_type)
    let voice = document.querySelector('input[name=voice]')
    let direct = document.querySelector('input[name=direct]')
    let text = document.querySelector('input[name=text]')
    let video = document.querySelector('input[name=video]')

    let video_current = document.getElementById("video_current")
    let voice_current = document.getElementById("voice_current")
    let text_current = document.getElementById("text_current")
    let direact_current = document.getElementById("direact_current")

    let video_base = document.getElementById("video_base")
    let voice_base = document.getElementById("voice_base")
    let text_base = document.getElementById("text_base")
    let direact_base = document.getElementById("direact_base")

    if (video.checked) {
        let value = parseFloat(document.querySelector('input[name=video_amount]').value)
        let basepriceconvert = admin_country.currency.price * consultant_country.currency.price * value

        video_current.innerText = `${value} ( ${ (com_con_type == 1)? ((value/100)*value) + value : value+AmountFlat} )`
        video_base.innerText = `${ Number(basepriceconvert).toFixed(2)} ( ${ (com_con_type == 1)? (((basepriceconvert/100)*basepriceconvert)+basepriceconvert).toFixed(2) : (basepriceconvert+AmountFlatcurrency).toFixed(2)} )`
    }
    if (voice.checked) {
        let value = parseFloat(document.querySelector('input[name=voice_amount]').value)
        let basepriceconvert = admin_country.currency.price * consultant_country.currency.price * value

        voice_current.innerText = `${value} ( ${ (com_con_type == 1)? ((value/100)*value) + value  : value+AmountFlat} )`
        voice_base.innerText = `${ Number(basepriceconvert).toFixed(2)} ( ${ (com_con_type == 1)? (((basepriceconvert/100)*basepriceconvert)+basepriceconvert).toFixed(2) : (basepriceconvert+AmountFlatcurrency).toFixed(2)} )`
    }
    if (text.checked) {
        let value = parseFloat(document.querySelector('input[name=text_amount]').value)
        let basepriceconvert = admin_country.currency.price * consultant_country.currency.price * value

        text_current.innerText = `${value} ( ${ (com_con_type == 1)? ((value/100)*value) + value  : value+AmountFlat} )`
        text_base.innerText = `${ Number(basepriceconvert).toFixed(2)} ( ${ (com_con_type == 1)? (((basepriceconvert/100)*basepriceconvert)+basepriceconvert).toFixed(2) : (basepriceconvert+AmountFlatcurrency).toFixed(2)} )`
    }
    if (direct.checked) {
        let value = parseFloat(document.querySelector('input[name=direct_amount]').value)
        let basepriceconvert = admin_country.currency.price * consultant_country.currency.price * value

        direact_current.innerText = `${value} ( ${ (com_con_type == 1)? ((value/100)*value) + value  : value+AmountFlat} )`
        direact_base.innerText = `${ Number(basepriceconvert).toFixed(2)} ( ${ (com_con_type == 1)? (((basepriceconvert/100)*basepriceconvert)+basepriceconvert).toFixed(2) : (basepriceconvert+AmountFlatcurrency).toFixed(2)} )`
    }

});
com_off_amount.addEventListener('keyup', function (event) {
    updateAmount(event.target, document.querySelector('input[name="com_off_type"]:checked').value)
});
com_pay_amount.addEventListener('keyup', function (event) {
    updateAmount(event.target, document.querySelector('input[name="com_pay_type"]:checked').value)
});
document.querySelectorAll('input[name="com_con_type"]').forEach(e => e.addEventListener('change', function (event) {
    updateAmount(com_con_amount, event.target.value)
}))
document.querySelectorAll('input[name="com_off_type"]').forEach(e => e.addEventListener('change', function (event) {
    updateAmount(com_off_amount, event.target.value)
}))
document.querySelectorAll('input[name="com_pay_type"]').forEach(e => e.addEventListener('change', function (event) {
    updateAmount(com_pay_amount, event.target.value)
}))



// Update Consultant
$("#personal").on("click", function (e) {
    e.preventDefault();

    var data = ($('#personal_details').serializeArray().reduce(function (json, {
        name,
        value
    }) {
        json[name] = value;
        return json;
    }, {}));

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "{{ route('consultant.update') }}",
        data: {
            data,
            "_token": "{{ csrf_token() }}",
            form: 'personal',
            id: consultant_id
        },

        success: function (result) {
            if (result.msg) {
                Switealert(result.msg, 'success')
            } else {
                var Ptag = "";
                for (var error in result.errors) {
                    Ptag += result.errors[error] + ', ';
                };
            }
        },
        error: function (erroe) {
            console.log(erroe);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            alert("Something is wrong");
        }
    });
})

$("#submit_consultant").on("click", function (e) {
    e.preventDefault();

    var data = ($('#consultant_amount').serializeArray().reduce(function (json, {
        name,
        value
    }) {
        json[name] = value;
        return json;
    }, {}));

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "{{ route('consultant.update') }}",
        data: {
            data,
            "_token": "{{ csrf_token() }}",
            form: 'consultant_amount',
            id: consultant_id
        },

        success: function (result) {
            if (result.msg) {
                Switealert(result.msg, 'success')
            } else {
                var Ptag = "";
                for (var error in result.errors) {
                    Ptag += result.errors[error] + ', ';
                };
            }
        },
        error: function (erroe) {
            console.log(erroe);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            alert("Something is wrong");
        }
    });
})
$("#submit_firm").on("click", function (e) {
    e.preventDefault();

    var data = ($('#firm_individual').serializeArray().reduce(function (json, {
        name,
        value
    }) {
        json[name] = value;
        return json;
    }, {}));

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "{{ route('consultant.update') }}",
        data: {
            data,
            "_token": "{{ csrf_token() }}",
            form: 'firm_individual',
            id: consultant_id
        },

        success: function (result) {
            if (result.msg) {
                Switealert(result.msg, 'success')
            } else {
                var Ptag = "";
                for (var error in result.errors) {
                    Ptag += result.errors[error] + ', ';
                };
            }
        },
        error: function (erroe) {
            console.log(erroe);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            alert("Something is wrong");
        }
    });
})
$("#submit_category").on("click", function (e) {
    e.preventDefault();

    var data = ($('#category').serializeArray().reduce(function (json, {
        name,
        value
    }) {
        json[name] = value;
        return json;
    }, {}));

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "{{ route('consultant.update') }}",
        data: {
            data,
            "_token": "{{ csrf_token() }}",
            form: 'category',
            id: consultant_id
        },

        success: function (result) {
            if (result.msg) {
                Switealert(result.msg, 'success')
            } else {
                var Ptag = "";
                for (var error in result.errors) {
                    Ptag += result.errors[error] + ', ';
                };
            }
        },
        error: function (erroe) {
            console.log(erroe);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            alert("Something is wrong");
        }
    });
})
$("#submit_other").on("click", function (e) {
    e.preventDefault();

    var data = ($('#lang_insurance').serializeArray().reduce(function (json, {
        name,
        value
    }) {
        json[name] = value;
        return json;
    }, {}));

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "{{ route('consultant.update') }}",
        data: {
            data,
            "_token": "{{ csrf_token() }}",
            form: 'others',
            id: consultant_id
        },

        success: function (result) {
            if (result.msg) {
                Switealert(result.msg, 'success')
            } else {
                var Ptag = "";
                for (var error in result.errors) {
                    Ptag += result.errors[error] + ', ';
                };
            }
        },
        error: function (erroe) {
            console.log(erroe);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            alert("Something is wrong");
        }
    });
})
