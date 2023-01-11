"use strict";

// Class definition
var exampleModal77 = function () {
    var submitButton;
    var cancelButton;
    var validator;
    var form;
    var modal;
    var modalEl;
    var close;
    // Init form inputs
    

    var handleForm = function () {
        validator = FormValidation.formValidation(
            form, {
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: "Enter Title"
                            }
                        }
                    },
                   
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
                        formData.append("_token", csrf);
                        formData.append("description",tinyMCE.get('templateBody').getContent());
                        fetch(updateURL,{
                            method: 'POST', // or 'PUT'
                            body: formData
                        })
                        .then(response => response.json())
                        .then((response) => {
                            if (response.status) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                //updateconsultant(response)
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
            modalEl = document.getElementById('exampleModal');

            if (!modalEl) {
                return;
            }

            modal = new bootstrap.Modal(modalEl);

            form = document.getElementById('exampleModal77');
            submitButton = modalEl.querySelector('.kt_modal_new_target_submit');
            cancelButton = modalEl.querySelector('.kt_modal_new_target_cancel');
            close = modalEl.querySelector('div[data-bs-dismiss]');

            
            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    exampleModal77.init();
    
});
