"use strict";

// Class definition
var personal_detail_update = function () {
    var submitButton;
    var cancelButton;
    var validator;
    var form;
    var modal;
    var modalEl;
    var close;
    // Init form inputs
    var initForm = function () {
        let PastDate = new Date();
        PastDate.setDate(PastDate.getDate() - 1);
        $("#dob").val(formatDate(PastDate))
        $("#dob").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10),
            maxDate: formatDate(PastDate)
        });

    }

    const updateconsultant = function(data){
        document.querySelectorAll('[data-update-name]').forEach(e => { e.innerText = data.consultant.name })
        document.querySelectorAll('[data-update-email]').forEach(e => { e.innerText = data.consultant.email })
        document.querySelectorAll('[data-update-dob]').forEach(e => { e.innerText = data.consultant.dob })
        document.querySelectorAll('[data-update-bio_data]').forEach(e => { e.innerText = data.consultant.bio_data })
        document.querySelectorAll('[data-update-landline]').forEach(e => { e.innerText = data.consultant.landline })
        document.querySelectorAll('[data-update-exp_year]').forEach(e => { e.innerText = `${data.consultant.exp_year} Years` })
        document.querySelectorAll('[data-update-gender]').forEach(e => { e.innerText = (data.consultant.gender == 0)?'Male':'Female' })
        document.querySelectorAll('[data-update-language]').forEach(e => { e.innerText = data.language })
        document.querySelectorAll('[data-update-country_name]').forEach(e => { e.innerText = data.consultant.country.country_name })
        document.querySelectorAll('[data-update-state_name]').forEach(e => { e.innerText = (data.consultant.state)?data.consultant.state.state_name :'--' })
        document.querySelectorAll('[data-update-city_name]').forEach(e => { e.innerText = data.consultant.city.city_name })
        document.querySelectorAll('[data-update-zipcode]').forEach(e => { e.innerText = data.consultant.zipcode })
        document.querySelectorAll('[data-update-firm]').forEach(e => { e.innerText = (data.consultant.firm)?data.consultant.firm.comapany_name : '' })
        
        if(data.consultant.firm){ document.getElementById('firmorindugial').style.display = ''
        }else{ document.getElementById('firmorindugial').style.display = 'none' }
        
        document.querySelectorAll('[data-update-register_address]').forEach(e => { e.innerText = String(data.consultant.register_address).replace( /(<([^>]+)>)/ig, ''); })
    }

    var handleForm = function () {
        validator = FormValidation.formValidation(
            form, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: "Enter Name"
                            }
                        }
                    },
                    dob: {
                        validators: {
                            notEmpty: {
                                message: "Enter Date of Birth"
                            }
                        }
                    },
                    // bio: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "Leave Some comment here"
                    //         }
                    //     }
                    // },
                    exp_year: {
                        validators: {
                            notEmpty: {
                                message: "Enter Year of Experience"
                            }
                        }
                    },
                    language: {
                        validators: {
                            notEmpty: {
                                message: "Select at least one Language"
                            }
                        }
                    },
                    // register_address: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "Enter Your Address"
                    //         }
                    //     }
                    // },
                    zipcode: {
                        validators: {
                            notEmpty: {
                                message: "Enter zipcode"
                            }
                        }
                    },
                    city_id: {
                        validators: {
                            notEmpty: {
                                message: "Select City"
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Enter Email Address"
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address',
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Action buttons
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        submitButton.disabled = true;
                        const formData = new FormData(e.target);
                        formData.append('form','personal');
                        formData.append("_token", csrf);
                        formData.append("firm_choose", $('#firm_choose').val());
                        fetch(updateURL,{
                            method: 'POST', // or 'PUT'
                            body: formData
                        })
                        .then(response => response.json())
                        .then((response) => {
                            if (response.status) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                updateconsultant(response)
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
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
                    } else {
                        // Show error message.
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
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

    return {
        
        // Public functions
        init: function () {
            // Elements
            modalEl = document.getElementById('personal_detail_update');

            if (!modalEl) {
                return;
            }

            modal = new bootstrap.Modal(modalEl);

            form = document.getElementById('personal_form');
            submitButton = modalEl.querySelector('.kt_modal_new_target_submit');
            cancelButton = modalEl.querySelector('.kt_modal_new_target_cancel');
            close = modalEl.querySelector('div[data-bs-dismiss]');

            initForm();
            handleForm();
        }
    };
}();

var Commission_update = function () {
    var submitButton;
    var cancelButton;
    var form;
    var modal;
    var modalEl;
    var close;
    var validator;
    // Init form inputs
    var initForm = function () {



    }
    const convertcomTemp = function(admin_country,consultant,amount,type){
        if(type == 0) return `${consultant.country.currency.currencycode} ${amount} / ${admin_country.currency.currencycode} ${((amount/consultant.country.currency.price)*admin_country.currency.price).toFixed(2)}`
        else return `${amount} %`
    }
    const updateconsultant = function(data){
        document.querySelectorAll('[data-update-preferre_slot]').forEach(e => { e.innerText = `${data.consultant.preferre_slot} Min` })
        document.querySelectorAll('[data-update-video]').forEach(e => { e.innerText = (data.consultant.video == 1)?`${data.consultant.country.currency.currencycode} ${data.consultant.video_amount} / ${admin_country.currency.currencycode} ${((data.consultant.video_amount/data.consultant.country.currency.price)*admin_country.currency.price).toFixed(2)}`:'Not Actived' })
        document.querySelectorAll('[data-update-text]').forEach(e => { e.innerText = (data.consultant.text == 1)?`${data.consultant.country.currency.currencycode} ${data.consultant.text_amount} / ${admin_country.currency.currencycode} ${((data.consultant.text_amount/data.consultant.country.currency.price)*admin_country.currency.price).toFixed(2)}`:'Not Actived' })
        document.querySelectorAll('[data-update-direact]').forEach(e => { e.innerText = (data.consultant.direct == 1)?`${data.consultant.country.currency.currencycode} ${data.consultant.direct_amount} / ${admin_country.currency.currencycode} ${((data.consultant.direct_amount/data.consultant.country.currency.price)*admin_country.currency.price).toFixed(2)}`:'Not Actived' })
        document.querySelectorAll('[data-update-voice]').forEach(e => { e.innerText = (data.consultant.voice == 1)?`${data.consultant.country.currency.currencycode} ${data.consultant.voice_amount} / ${admin_country.currency.currencycode} ${((data.consultant.voice_amount/data.consultant.country.currency.price)*admin_country.currency.price).toFixed(2)}`:'Not Actived' })
        document.querySelectorAll('[data-update-consultant_fee]').forEach(e => { e.innerText = (data.consultant.com_con_amount != null)?convertcomTemp(admin_country,data.consultant,data.consultant.com_con_amount,data.consultant.com_con_type):'Consultant Fee Not Added' })
        document.querySelectorAll('[data-update-offers]').forEach(e => { e.innerText = (data.consultant.voice == 1)?convertcomTemp(admin_country,data.consultant,data.consultant.com_off_amount,data.consultant.com_off_type):'Offers Fee Not Added' })
        document.querySelectorAll('[data-update-payout]').forEach(e => { e.innerText = (data.consultant.voice == 1)?convertcomTemp(admin_country,data.consultant,data.consultant.com_pay_amount,data.consultant.com_pay_type):'Payout Fee Not Added' })

    }

    var handleForm = function () {
        validator = FormValidation.formValidation(
            form, {
                fields: { },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Action buttons
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        submitButton.disabled = true;
                        const formData = new FormData(e.target);
                        formData.append('form','consultant_amount');
                        formData.append("_token", csrf);
                        fetch(updateURL,{
                            method: 'POST', // or 'PUT'
                            body: formData
                        })
                        .then(response => response.json())
                        .then((response) => {
                            if (response.status) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                updateconsultant(response)
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
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
                    } else {
                        // Show error message.
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        cancelButton?.addEventListener('click', function (e) {
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

    return {
        // Public functions
        init: function () {
            // Elements
            modalEl = document.getElementById('Commission_update');

            if (!modalEl) {
                return;
            }

            modal = new bootstrap.Modal(modalEl);

            form = document.getElementById('Commission_form');
            submitButton = modalEl.querySelector('.kt_modal_new_target_submit');
            cancelButton = modalEl.querySelector('.kt_modal_new_target_cancel');
            close = modalEl.querySelector('div[data-bs-dismiss]');

            initForm();
            handleForm();
        }
    };
}();

var Last_update = function () {
    var submitButton;
    var cancelButton;
    var form;
    var modal;
    var modalEl;
    var close;
    var validator;
    // Init form inputs
    var initForm = function () {

    }
    const get_url_extension = function( url ) {
        return url.split(/[#?]/)[0].split('.').pop().trim();
    }
    const appenddoc = function(file){
        let html = ''
        let path = ''
        file.split(',').forEach(e => {
            if(get_url_extension(e) == `pdf`) {path = `demo1/pdf.png`;}
            else { path = `storage/${e}` }

            html += `<div class="col-lg-4">
            <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="${filepauth}${path}">
                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('${filepauth}${path}')"></div>
                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                </div>
            </a>
        </div>`
        })
        return html;
    }

    const updateconsultant = function(data){
        document.querySelectorAll('[data-update-spec]').forEach(e => { e.innerText = `${data.spec}` })
        document.querySelectorAll('[data-update-subcaregory]').forEach(e => { e.innerText = `${data.subcaregory.toString()}` })
        document.querySelectorAll('[data-update-Category]').forEach(e => { e.innerText = `${data.Category.name}` })
        document.querySelectorAll('[data-update-insurance]').forEach(e => { e.innerText = (data.insurance.length == 0)?$('#insurancespan').hide():`${data.insurance.toString()}` })
        document.getElementById('appenddoc').innerHTML = appenddoc(data.consultant.proof)
    }

    var handleForm = function () {
        validator = FormValidation.formValidation(
            form, {
                fields: { },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Action buttons
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        submitButton.disabled = true;
                        const formData = new FormData(e.target);
                        formData.append('form','category');
                        formData.append("_token", csrf);
                        fetch(updateURL,{
                            method: 'POST', // or 'PUT'
                            body: formData
                        })
                        .then(response => response.json())
                        .then((response) => {
                            if (response.status) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                updateconsultant(response)
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
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
                    } else {
                        // Show error message.
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        cancelButton?.addEventListener('click', function (e) {
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

    return {
        // Public functions
        init: function () {
            // Elements
            modalEl = document.getElementById('last_update');

            if (!modalEl) {
                return;
            }

            modal = new bootstrap.Modal(modalEl);

            form = document.getElementById('last_update_form');
            submitButton = modalEl.querySelector('.kt_modal_new_target_submit');
            cancelButton = modalEl.querySelector('.kt_modal_new_target_cancel');
            close = modalEl.querySelector('div[data-bs-dismiss]');

            initForm();
            handleForm();
        }
    };
}();

var bank_update = function () {
    var submitButton;
    var cancelButton;
    var form;
    var modal;
    var modalEl;
    var close;
    var validator;
    // Init form inputs
    var initForm = function () {
    }

    const updatebank = function(data){
        document.querySelectorAll('[data-update-account_number]').forEach(e => { e.innerText = (data.consultant.account_number) })
        document.querySelectorAll('[data-update-bank_name]').forEach(e => { e.innerText = (data.consultant.bank_name) })
        document.querySelectorAll('[data-update-branch]').forEach(e => { e.innerText = (data.consultant.branch) })
        document.querySelectorAll('[data-update-account_name]').forEach(e => { e.innerText = (data.consultant.account_name)})
        document.querySelectorAll('[data-update-ifsc_code]').forEach(e => { e.innerText = (data.consultant.ifsc_code) })
        if(data.consultant.bank_status == 1){ document.querySelectorAll('[data-update-verified]').forEach(e => { e.checked=true })}
        else{document.querySelectorAll('[data-update-verified]').forEach(e => { e.checked=false })}
    }

    var handleForm = function () {
        validator = FormValidation.formValidation(
            form, {
                fields: { },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Action buttons
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        submitButton.disabled = true;
                        const formData = new FormData(e.target);
                        formData.append('form','bank_details');
                        formData.append("_token", csrf);
                        fetch(updateURL,{
                            method: 'POST', // or 'PUT'
                            body: formData
                        })
                        .then(response => response.json())
                        .then((response) => {
                            if (response.status) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                updatebank(response)
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
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
                    } else {
                        // Show error message.
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
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

    return {
        // Public functions
        init: function () {
            // Elements
            modalEl = document.getElementById('bank_update');

            if (!modalEl) {
                return;
            }

            modal = new bootstrap.Modal(modalEl);

            form = document.getElementById('bank_form');
            submitButton = modalEl.querySelector('.kt_modal_new_target_submit');
            cancelButton = modalEl.querySelector('.kt_modal_new_target_cancel');
            close = modalEl.querySelector('div[data-bs-dismiss]');

            initForm();
            handleForm();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {
    personal_detail_update.init();
    Commission_update.init();
    bank_update.init();
    Last_update.init();

function insuransetemplate(state){
    if (!state.id) return state.text;
   var imag = $(state.element).data('image');
    var $state = $(
        `<span><img style="width:25px;" onerror="this.onerror=null;this.remove()" src="${imag}" class="img-flag" />${state.text}</span>`
    );
     return $state;
}
$("#firm_choose").select2({
        templateResult: insuransetemplate,
        templateSelection: insuransetemplate
});
    var city = $("#city")
    $("#state").on('select2:select,select2:unselect', function (e) {
        var data = e.params.data;
        $.ajax({
            url:Getcity,
            method:"POST",
            data:{id:data.id,"_token": csrf,},
            success:function(data){
                var option = `<option selected></option>`
                if(data.length != null){
                    data.forEach((e)=>{
                        option += '<option value='+e.id+'>'+e.city_name+'</option>';
                    })
                }
                city.html(option).val('').trigger("change");
            }
        })
    });

    $('#category').on('change', function (e) {
        var data = e.target.value;
        $.ajax({
            url:modelcategory,
            method:"POST",
            data:{categorie_id:[data],parent:'hh',"_token": csrf,},
            success:function(data){
                var option = `<option></option>`
                if(data.subcategory.length != null){
                    data.subcategory.forEach((e)=>{
                        option += '<option value='+e.id+'>'+e.name+'</option>';
                    })
                }
                $('#sub_category').html(option).val('').trigger("change");
                document.getElementById('specappend').innerHTML = specTemplate(data.Consultantcategory)
                proofappend(data.Document);
                if(data.subcategory.length == 0) $('#subcategory_div').hide(500)
                else $('#subcategory_div').show(500)

                if(data.isinsurance > 0) $('#insurancediv').show(500)
                else{ $('#insurancediv').hide(500); $('#insutance').val('')}
            }
        })
    });
    $('#sub_category').on('change', function (e) {
        var data = $('#sub_category').val();
        data.push($('#category').val());
        $.ajax({
            url:modelcategory,
            method:"POST",
            data:{categorie_id:data,"_token": csrf,},
            success:function(data){
                document.getElementById('specappend').innerHTML = specTemplate(data.Consultantcategory)
                proofappend(data.Document);

                if(data.isinsurance > 0) $('#insurancediv').show(500)
                else{ $('#insurancediv').hide(500); $('#insutance').val('')}

            }
        })
    });
});
const proof_clone = document.getElementById('proof_clone')
const proofappend = (document)=> {
    proof_clone.innerHTML = ''
    document.forEach(e => proof_clone.appendChild(poofTemplate(e.title)))
}
const poofTemplate = function (text) {

    let div = document.createElement('div')

    let div2 = document.createElement('div')
    let lable = document.createElement('label')
    let input = document.createElement('input')

    div.classList.add('fv-row', 'mb-10','col-md-6')
    div2.classList.add('card-body', 'd-flex', 'flex-wrap', 'justify-content-start')
    lable.classList.add('required', 'form-label', 'fs-6', 'mb-2')
    lable.innerText = text
    input.type = 'file'
    input.name = 'gallery[]'
    input.required = true
    input.accept = '.pdf,image/*'
    input.placeholder = 'Image'
    input.classList.add('form-control', 'form-control-solid', 'mb-3', 'mb-lg-0', 'gallery')
    input.multiple = true

    div.appendChild(lable)
    div.appendChild(input)
    div.appendChild(div2)
    return div
}
const catetemplate = (vat,sub) => {
    let templatereturn =  `<span class="d-block fw-bold text-start" style="margin-bottom: 25px;">
    <span class="text-dark fw-bolder d-block fs-3">${vat}</span>`

    for (var keyone in sub) {
        templatereturn += subcatloop(keyone,sub[keyone])
    }
    return templatereturn += `</span>`;
}
const subcatloop = (keyone,sub) => {
    return ` <span class="text-dark fw-bolder d-block fs-3" style="margin-left: 30px;">${keyone}</span> ${specloop(sub)}`
}

const specloop = (specArray) => {
    let templatereturn = ''
    specArray.forEach(element => {
        templatereturn += `<span class="text-muted fw-bold fs-6" style="margin-left: 60px;">
        <input class="form-check-input" type="checkbox" name="specialization_id[]" value="${element.id}" id="flexCheckChecked${element.id}">
													<label class="form-check-label" for="flexCheckChecked${element.id}">${element.title}</label>
                                                    </span>`
    });
    return templatereturn;
}

const specTemplate = function (specDatas) {
    let html = "";
    for (var key in specDatas) {
        html += catetemplate(key,specDatas[key])
    }
    if(html == '') html = `<span class="text-muted fw-bold fs-6" style="margin-left: 60px;">NO Specialized</span>`
    return html;
}

function firm_div_function(){
    if(event.target.checked){
        $('#firm_div').show(500);
        $('#firm_choose').attr('required', true);
    }else{
        $('#firm_div').hide(500);
        $('#firm_choose').removeAttr('required');
        $('#firm_choose').val('')
    }
}

function Insurance_div_function(){
    if(event.target.checked){
        $('#insetance_select').show(500);
        $('#insutance').attr('required', true);
    }else{
        $('#insetance_select').hide(500);
        $('#insutance').removeAttr('required');
        $('#insutance').val('')
    }
}

function enabledisable(input){
    if(event.target.checked){
        input.disabled = false
        input.required = true
    }else{
        input.disabled = true
        input.required = false
        input.value = 0
    }
}
function courencyconveter() {
    event.target.parentElement.lastElementChild.innerText = `${admin_country.currency.currencycode} ${Number((event.target.value/consultant_country.currency.price)*admin_country.currency.price).toFixed(2)}`
}

function CourencyFlatconveter(type,span,input) {
    const parentNode = span
    const inputvalue = span.parentElement.children[1]
    if (type == 0) {
        parentNode.innerText = `${admin_country.currency.currencycode} ${Number((inputvalue.value/consultant_country.currency.price)*admin_country.currency.price).toFixed(2)}`
    } else {
        parentNode.innerText = `%`
        if(input.value > 100) input.value = 100
    }
}

$('.downloadAll').click( function( e ){
    e.preventDefault();
    var temporaryDownloadLink = document.createElement("a");
    temporaryDownloadLink.style.display = 'none';
    document.body.appendChild( temporaryDownloadLink );
    const filesForDownload =  downloadAllFiles.split(",");
    for( var n = 0; n < filesForDownload.length; n++ )
    {
        var download = filesForDownload[n];
        temporaryDownloadLink.setAttribute( 'href', `${filepauth}/storage/${download}` );
        temporaryDownloadLink.setAttribute( 'download',  download.replace(/^.*[\\\/]/, ''));
        temporaryDownloadLink.click();
    }
});
