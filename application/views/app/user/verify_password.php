
<html>
    <head>
        <?php require_once APPPATH . 'views/app/asset/header/links.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/asset/css/fonts_styling.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/asset/css/verify_password.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>application/views/app/asset/js/fontawesome5.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>application/views/app/user/JS_validation.js" type="text/javascript"></script>
    </head>
    <body onload="preloader();">

        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <div class="division">
            <div class="container">

                <!-- Top red border -->
                <div class="header"></div>
                <!-- Top red border End -->


                <div class="dash-section">
                    <div class="line-div">
                        <div class="left-side">
                            <img src="<?php echo base_url(); ?>application/views/asset/image/login/cars_LoginPage.PNG" alt="" height="100%" width="100%"/>
                        </div>
                        <div class="right-side">
                            <div class="login-section">
                                <div class="logo-row">
                                    <div class="logo-div">
                                        <img src="<?php echo base_url(); ?>application/views/asset/image/login/login-logo.png" alt="" height="100%" width="100%"/>
                                    </div>
                                </div>
                                <div class="user-email">
                                    <label name="admin_email" id="admin_email"><?php echo $this->session->userdata('email'); ?></label>
                                </div>
                                <div class="txt-forgot-div">
                                    <label>Verify OTP and Reset Password</label>
                                </div>

                                <?php echo form_open('App/update_password'); ?>

                                <div class="user-row">
                                    <i class="fas fa-edit otp-icon"></i>
                                    <input class="user-input" type="text" placeholder="Enter OTP" name="txt_otp" id="txt_otp" onblur="sendRequestOtp();" autocomplete="off" oncopy="return false" onpaste="return false"
                                           oncut="return false" >
                                </div>
                                <div class="opt-error-row">
                                    <!-- OPT matched -->
                                    <div class="otp-incorrect" style="display: block;">
                                        <span class="not-match" id="err_otp"><?php echo $this->session->flashdata('otp_message'); ?></span>
                                    </div>
                                </div>

                                <div class="new-pass">
                                    <i class='fas fa-key' id="inputuser"></i>
                                    <input class="pass-new" type="password" placeholder="Enter Your Password" name="password" id="password" autocomplete="off" oncopy="return false" onpaste="return false"
                                           oncut="return false" >
                                    <span class="eyes" onclick="typeCast()">
                                        <i class='fas fa-eye' id="remove1"></i>
                                        <i class='fas fa-eye-slash' id="remove2"></i>
                                    </span>

                                </div>

                                <div class="new-pass-error">
                                    <div class="otp-incorrect" style="display: block;">
                                        <label id="err_password"><?php echo $this->session->flashdata('pass_message'); ?></label>
                                    </div>
                                </div>

                                <div class="confirm-pass">
                                    <i class='fas fa-lock' id="inputuser"></i>
                                    <input class="pass-new" type="password" onblur="validatePassword();" placeholder="Confirm Password" name="confirm_password" id="confirm_password" autocomplete="off" oncopy="return false" onpaste="return false"
                                           oncut="return false" >
                                    <span class="eyes" onclick="typeCast2()">
                                        <i class='fas fa-eye' id="remove3"></i>
                                        <i class='fas fa-eye-slash' id="remove4"></i>
                                    </span>
                                </div>

                                <div class="pass-error-row">
                                    <div class="otp-incorrect" style="display: block;">
                                        <span id="err_confirm_password"><?php echo $this->session->flashdata('con_message'); ?></span>
                                    </div>

                                </div>
                                <div class="resend-lbl">
                                    <a href="<?php echo base_url(); ?>App/resend_otp">
                                        <label class="resend-otp-lbl">Resend OTP ?</label>
                                    </a>
                                </div>
                                <div class="btn-resend-pwd">
                                    <input type="submit" class="resend-email" name="reset_pass" value="Reset Password" onclick="return varifyPassVali();">
                                </div>

                                <div class="email-exits">
                                    <label id="err_msg"><?php echo $this->session->flashdata('message'); ?></label>
                                </div>
                                <?php echo form_close(); ?>
                                <div class="login-back">
                                    <a href="<?php echo base_url(); ?>App/logout">
                                        <button class="back-login">Back to Login</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="footer"></div>
            </div>
        </div>
        <script>
            var spinner = document.getElementById('ftco-loader');
            function preloader() {
                spinner.style.display = 'none';
            }



            function validatePassword() {
                var password = document.getElementById("password");
                var confirm_password = document.getElementById("confirm_password");

                if (password.value != confirm_password.value) {
                    document.getElementById("err_msg").innerText = "Passwords doesn't match.";
                    password.focus();
                    return false;
                } else {
                    document.getElementById("err_msg").innerText = "";
                    return true;
                }
            }

            function typeCast() {
                var v1 = document.getElementById("password");
                var v2 = document.getElementById("remove1");
                var v3 = document.getElementById("remove2");

                if (v1.type === 'password') {
                    v1.type = "text";
                    v2.style.display = "block";
                    v3.style.display = "none";
                } else {
                    v1.type = "password";
                    v2.style.display = "none";
                    v3.style.display = "block";
                }
            }

            function typeCast2() {
                var v1 = document.getElementById("confirm_password");
                var v2 = document.getElementById("remove3");
                var v3 = document.getElementById("remove4");

                if (v1.type === 'password') {
                    v1.type = "text";
                    v2.style.display = "block";
                    v3.style.display = "none";
                } else {
                    v1.type = "password";
                    v2.style.display = "none";
                    v3.style.display = "block";
                }
            }

            //  Ajax start 
            function createdRequestObject() {
                var tmpXmlHttpObject;
                if (window.XMLHttpRequest)
                {
                    tmpXmlHttpObject = new XMLHttpRequest();
                } else if (window.ActiveXObject)
                {
                    tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
                }
                return tmpXmlHttpObject;
            }
            var http1 = createdRequestObject();


            /* Ajax call for OTP..*/
            function sendRequestOtp() {
                var data = document.getElementById("txt_otp").value;
                http1.open('get', '<?php echo base_url(); ?>App/chaeck_otp?data=' + data);
                http1.onreadystatechange = processResponseOtp;
                http1.send(null);
            }

            function processResponseOtp() {
                if (http1.readyState == 4) {
                    var response = http1.responseText;
                    if (response == "")
                    {
                        document.getElementById('err_otp').innerHTML = "OTP not matched";
                        document.getElementById('err_otp').style.color = "#cc0000";
                        document.getElementById("txt_otp").focus();
                    } else if (response == "expired") {
                        document.getElementById('err_otp').innerHTML = "OTP Expired, Please Resend OTP.";
                        document.getElementById('err_otp').style.color = "#cc0000";
                        document.getElementById("txt_otp").focus();
                    } else if (response == "matched") {
                        document.getElementById('err_otp').innerHTML = "OTP matched";
                        document.getElementById('err_otp').style.color = "green";
                    }

                }
            }
        </script>
    </body>
</html>



