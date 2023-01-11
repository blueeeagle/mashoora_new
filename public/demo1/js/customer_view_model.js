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
        
    }

    const updateconsultant = function(data){

        document.querySelectorAll('[data-update-name]').forEach(e => { e.innerText = data.consultant.name })
        document.querySelectorAll('[data-update-email]').forEach(e => { e.innerText = data.consultant.email })
        document.querySelectorAll('[data-update-dob]').forEach(e => { e.innerText = data.consultant.dob })
        document.querySelectorAll('[data-update-gender]').forEach(e => { e.innerText = (data.consultant.gender == 0)?'Male':'Female' })
        document.querySelectorAll('[data-update-country_name]').forEach(e => { e.innerText = data.consultant.country.country_name })
        document.querySelectorAll('[data-update-state_name]').forEach(e => { e.innerText = (data.consultant.state)?data.consultant.state.state_name :'--' })
        document.querySelectorAll('[data-update-city_name]').forEach(e => { e.innerText = data.consultant.city.city_name })
        document.querySelectorAll('[data-update-zipcode]').forEach(e => { e.innerText = data.consultant.zipcode })
        
        document.querySelectorAll('[data-update-register_address]').forEach(e => { e.innerText = String(data.consultant.register_address).replace( /(<([^>]+)>)/ig, ''); })
    }

    var handleForm = function () {
        

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
                    gender: {
                        validators: {
                            notEmpty: {
                                message: "Select at least one gender"
                            }
                        }
                    },
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
                    state_id: {
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
    }

    return {
        // Public functions
        init: function () {
            // Elements
            //debugger
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

// On document ready
KTUtil.onDOMContentLoaded(function () {
    personal_detail_update.init();

});