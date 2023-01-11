"use strict";

// Class definition
var KTSigninGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;
    var PhoneNumber;
    var modal;
    var modalEl;
    var phoneInput = null;
    var verifyotp;
    const config = {
        apiKey: "AIzaSyD9LNiyoP1HzDSZtaI1xEZg8iqWd0zgyzs",
        authDomain: "otparun-c5a3e.firebaseapp.com",
        projectId: "otparun-c5a3e",
        storageBucket: "otparun-c5a3e.appspot.com",
        messagingSenderId: "989404442406",
        appId: "1:989404442406:web:f9b9e670fe921b28429be7",
        measurementId: "G-DN1BVLF8NJ"
    };
    var buttonresent;
    // Handle form
    const FireBase_init = function(){
        firebase.initializeApp(config);
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': (response) => {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                // onSignInSubmit();
            }
        });
    }
    const sentotp = function(){
        const appVerifier = window.recaptchaVerifier;
        firebase.auth().signInWithPhoneNumber(PhoneNumber, appVerifier)
                .then((confirmationResult) => {
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;
                }).catch((error) => {
                    console.log(error)
                });
    }

    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            },
                            callback: {
                                message: 'Please enter valid password',
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
        buttonresent.addEventListener('click',function (event){
            event.preventDefault();
            sentotp();
            Swal.fire({
                text: "You have successfully logged in!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            })
        })
        const login_form_submit = function(){
            // Simulate ajax request
            axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
            .then(function (response) {
                // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                Swal.fire({
                    text: "You have successfully logged in!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function (result) {
                    if (result.isConfirmed) {
                        form.querySelector('[name="email"]').value = "";
                        form.querySelector('[name="password"]').value = "";
                        window.location.reload();
                    }
                });
            })
            .catch(function (error) {
                let dataMessage = error.response.data.message;
                let dataErrors = error.response.data.errors;
                for (const errorsKey in dataErrors) {
                    if (!dataErrors.hasOwnProperty(errorsKey)) continue;
                    dataMessage += "\r\n" + dataErrors[errorsKey];
                }

                if (error.response) {
                    Swal.fire({
                        text: dataMessage,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            })
            .then(function () {
                // always executed
                // Hide loading indication
                submitButton.removeAttribute('data-kt-indicator');

                // Enable button
                submitButton.disabled = false;
            });
        }
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status === 'Valid') {

                    fetch(updateURL,{
                        method: 'POST', // or 'PUT'
                        body: new FormData(form)
                    })
                    .then(response => response.json())
                    .then((response) => {
                        if(!response.status){
                            Swal.fire({
                                text: 'Credential Not Found',
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                            return
                        }
                        if(response.is_two_way==2){
                            PhoneNumber = response.phone;
                            sentotp()
                            phoneInput.innerHTML = '******'+response.phone.substr(response.phone.length - 5);
                            modal.show()
                            return;
                        }
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    // Disable button to avoid multiple click
                    submitButton.disabled = true;
                    login_form_submit()
                    })
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
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
        });

        verifyotp.addEventListener('click',function(){
            verifyotp.setAttribute("data-kt-indicator", "on")
            verifyotp.disabled = true;
            let o = [].slice.call(modalEl.querySelectorAll('input[maxlength="1"]'))
            if(o.map((t) => { return t.value }).includes('')){
                Swal.fire({
                    text: "Please enter valid securtiy code and try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                verifyotp.disabled = false
                verifyotp.removeAttribute("data-kt-indicator")
                return
            }
            let code = ''
            o.forEach(element => {
                code += element.value
            });
            confirmationResult.confirm(code).then(function (result) {
                verifyotp.disabled = false
                verifyotp.removeAttribute("data-kt-indicator")
                modal.hide()
                login_form_submit()
            }).catch(function (error) {
                Swal.fire({
                    text: "Please enter valid securtiy code and try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                verifyotp.disabled = false
                verifyotp.removeAttribute("data-kt-indicator")
            })

        })
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');
            modalEl = document.getElementById('exampleModal')
            phoneInput = document.getElementById('phone-number')
            verifyotp = document.getElementById('kt_sing_in_two_steps_submit')
            modal = new bootstrap.Modal(modalEl);
            buttonresent  = document.getElementById('resent_otp')
            handleForm();
            FireBase_init()
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
