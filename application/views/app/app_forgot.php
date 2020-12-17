
<html>
    <head>
        <?php require_once APPPATH . 'views/app/asset/header/links.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/asset/css/fonts_styling.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/asset/css/app_forgot.css" rel="stylesheet" type="text/css"/>
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
                                <div class="txt-forgot-div">
                                    <label>Forgot Your Password ?</label>
                                </div>

                                 <?php echo form_open('App/verify_password'); ?>
                                    <div class="user-row">
                                        <i class="fas fa-envelope" id="inputuser" style="font-size:18px;"></i>
                                        <input class="user-input" type="email" placeholder="Please enter email" id="txt_email" name="txt_email" autocomplete="off" oncopy="return false" onpaste="return false"
                                               oncut="return false">
                                    </div>
                                    <div class="email-error-row">
                                       
                                        <div class="email-incorrect">
                                            <span class="not-match" id="err_txt_email"><?php echo $this->session->flashdata('email_message'); ?></span>
                                        </div>
                                    </div>
                                    <div class="btn-resend-pwd">
                                        <input type="submit" class="resend-email" name="btn_send" onclick="return appForgotVali();" value="Send recovery email">
                                    </div>
                                    <!-- Span for Email does not exits -->
                                    <div class="email-exits">
                                        <label id="err_msg"><?php echo $this->session->flashdata('message'); ?></label>
                                    </div>
                               <?php echo form_close();?>
                                <div class="login-back">
                                    <a href="<?php echo base_url(); ?>App/logout">
                                        <input type="submit" class="back-login" name="btn_cancel" value="Back to Login" >
                                    </a>
                                </div >
                            </div>
                        </div>
                    </div>

                </div>
                <div class="footer"></div>
            </div>
        </div>
        <script>
            
            
            
            
            
              /* Validation for form app forgor password page */
            function appForgotVali()
            {
                var txtEmail = document.getElementById("txt_email");

                return (emptyValidation(txtEmail, 'err_txt_email') ?
                        checkEmailVali(txtEmail, 'err_txt_email') ?
                        CheckTags(txtEmail, 'err_txt_email') ?
                        true : false : false : false);
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
            
            
             var spinner = document.getElementById('ftco-loader');
            function preloader() {
                spinner.style.display = 'none';
            }
        </script>
    </body>
</html>



