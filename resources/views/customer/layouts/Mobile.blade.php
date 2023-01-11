<div class="current" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <style type="text/css">
            .hide {
                display: none;
            }
        </style>
    <div class="w-100">
        <div class="card-body pt-0">
            <div class="py-5">
                <h4>Enter Your Mobile Number</h4>
                <div class="alert alert-danger hide" id="error-message"></div>
                <div class="alert alert-success hide" id="sent-message"></div>
                <div class="rounded border p-10">
                    <form>
                    <div class="fv-row mb-10">                        
                        <div class="input-group mt-5">
                            <input type="tel" name="phone_no" id="phone-number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="+91XXXXXXXXXX" required />
                        </div>                       
                    </div>
                    <div class="fv-row mb-10"  id="otp_gene">
                        <div id="recaptcha-container"></div>
                        <button type="button" class="btn btn-primary btn-hover-rise me-5" onclick="otpSend();">Generate OTP</button>
                    </div>
                    </form>
                    <div class="fv-row mb-10" id="otp_div" hidden>                        
                        <label class="required form-label fs-6 mb-2" > Enter OTP</label>
                        <input type="number" id="otp-code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="OTP" required />
                    </div>
                    <form>
                    <div class="fv-row mb-10" id="otp_very_div" hidden>
                        <button type="button" class="btn btn-primary btn-hover-rise me-5" onclick="otpVerify1();">Verify OTP</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Wrapper-->
</div>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>
    <script type="text/javascript">
        const config = {
            apiKey: "AIzaSyDfzyTX8vp-v0JPvN3mHrg-ijwxGWE-rdc",
            authDomain: "revathi-160905.firebaseapp.com",
            projectId: "revathi-160905",
            storageBucket: "revathi-160905.appspot.com",
            messagingSenderId: "742620427349",
            appId: "1:742620427349:web:a678c2f2aa2cd41a7f10dc",
            measurementId: "G-SXP6HX49ZZ"
        };
        
        firebase.initializeApp(config);
    </script>
    <script type="text/javascript">  
        // reCAPTCHA widget    
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': (response) => {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                onSignInSubmit();
            }
        });

        function otpSend() {
            let p = document.getElementById('otp_div');
            p.removeAttribute("hidden");
            let v = document.getElementById('otp_very_div');
            v.removeAttribute("hidden");
            document.getElementById("otp_gene").style.display = "none";

            var phoneNumber = document.getElementById('phone-number').value;
            const appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;

                    document.getElementById("sent-message").innerHTML = "Message sent succesfully.";
                    document.getElementById("sent-message").classList.add("d-block");
                }).catch((error) => {
                    document.getElementById("error-message").innerHTML = error.message;
                    document.getElementById("error-message").classList.add("d-block");
                });
        }

        function otpVerify1() {
            var code = document.getElementById('otp-code').value;
            confirmationResult.confirm(code).then(function (result) {
                // User signed in successfully.
                var user = result.user;
                var phoneNumber = document.getElementById('phone-number').value;
                const data = {
                    _token: csrf,
                    step: 0,
                    phone_no:phoneNumber,
                    country_code:'IN',
                };

                fetch('http://localhost/mashoora/public/consultant/save', {
                        method: 'POST', // or 'PUT'
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.otp_status) GenerateOtp.textContent = 'Try Again'
                        if (data.otp_status) {
                            document.getElementById('continue').click()
                            document.getElementById('continue').removeAttribute('hidden')
                        }
                    })

                document.getElementById("sent-message").innerHTML = "You are succesfully logged in.";
                document.getElementById("sent-message").classList.add("d-block");
      
            }).catch(function (error) {
                document.getElementById("error-message").innerHTML = error.message;
                document.getElementById("error-message").classList.add("d-block");
            });
        }
    </script>
