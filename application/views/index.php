
<html>
    <head>
        <?php require_once APPPATH . 'views/app/asset/header/links.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/asset/css/fonts_styling.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/asset/css/index.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>application/views/app/asset/js/fontawesome5.js" type="text/javascript"></script>
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
                                <?php echo form_open('App/login_validation'); ?>
                                <div class="user-row">

                                    <i class="fas fa-user" id="inputuser"></i>
                                    <input class="user-input" type="email" placeholder="Email" id="txt_email" name="txt_email" autocomplete="off" oncopy="return false" onpaste="return false"
                                           oncut="return false">
                                </div>
                                <div class="email-verify-row">
                                    <div class="email-incorrect"  style="display: block;">
                                        <span class="opt-match" id="err_txt_email"><?php echo $this->session->flashdata('email_message'); ?></span>
                                    </div>
                                </div>
                                <div class="pass-row">

                                    <i class='fas fa-lock' id="inputuser"></i>
                                    <input class="user-input" id="inputpass" type="password" placeholder="Password" name="txt_password" autocomplete="off" oncopy="return false" onpaste="return false"
                                           oncut="return false">
                                    <span class="eyes" onclick="typeCast()">
                                        <i class='fas fa-eye' id="remove1"></i>
                                        <i class='fas fa-eye-slash' id="remove2"></i>
                                    </span>
                                </div>
                                <div class="password-verify-row">
                                    <div class="pass-incorrect">
                                        <span class="not-match" id="err_inputpass"><?php echo $this->session->flashdata('pass_message'); ?></span>
                                    </div>
                                </div>
                                <div class="forgot-row">
                                    <a href="<?php echo base_url(); ?>App/app_forgot">
                                        <text>Forgot the Password?</text>
                                    </a>
                                </div>
                                <div class="submit-row">
                                    <button class="login-btn" onclick="return loginVali();">Login</button>
                                </div>
                                <div class="error-row">
                                    <text><?php echo $this->session->flashdata('message'); ?></text>
                                </div>
                                <?php echo form_close(); ?>
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

            function typeCast() {
                var v1 = document.getElementById("inputpass");
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




            /* Validation for form login page */
            function loginVali()
            {
                var txtEmail = document.getElementById("txt_email");
                var txtInputPass = document.getElementById("inputpass");
                


                return (emptyValidation(txtEmail, 'err_txt_email') ?
                        checkEmailVali(txtEmail, 'err_txt_email') ?
                        CheckTags(txtEmail, 'err_txt_email') ?
                        emptyValidation(txtInputPass, 'err_inputpass') ?
                        checkPassWordVali(txtInputPass, 'err_inputpass') ?
                        CheckTags(txtInputPass, 'err_inputpass') ?
                        true : false : false : false : false : false : false );
            }

            /* Check Empty text fields. */

            function emptyValidation(control, msgBox) {

                var control_len = control.value.length;
                if (control_len === 0) {
                    document.getElementById(msgBox).innerHTML = 'This is required field';
                    control.focus();
                    return false;
                }
                document.getElementById(msgBox).innerHTML = '';
                return true;
            }

            function CheckTags(txtfld, msgBox) {

                var reg = /<(.|\n)*?>/g;
                var value = txtfld.value;
                if (reg.test(value) == false) {
                    document.getElementById(msgBox).innerHTML = '';
                    return true;
                }
                document.getElementById(msgBox).innerHTML = 'do not allow HTMLTAGS';
                txtfld.focus();
                return false;

            }


            /*Check all Alphabets on submit.*/
            function checkEmailVali(txtfld, msgBox) {
                var letters = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
                if (txtfld.value.match(letters)) {
                    document.getElementById(msgBox).innerHTML = '';
                    return true;
                } else {
                    document.getElementById(msgBox).innerHTML = 'Must have proper email id';
                    txtfld.focus();
                    return false;
                }
            }

            /*Check all Alphabets on submit.*/
            function checkPassWordVali(txtfld, msgBox) {
                var letters = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,}$/;
                if (txtfld.value.match(letters)) {
                    document.getElementById(msgBox).innerHTML = '';
                    return true;
                } else {
                    document.getElementById(msgBox).innerHTML = 'Enter 1num, 1upper, 1lower and min 4 or more characters.';
                    txtfld.focus();
                    return false;
                }
            }
        </script>
    </body>
</html>



