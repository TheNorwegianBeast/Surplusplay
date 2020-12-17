<!DOCTYPE html>
<html>
    <head>
        <title>PORSCHE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="<?php echo base_url(); ?>application/views/admin/asset/js/fa5.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/reset.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/common_for_all.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="<?php echo base_url(); ?>application/views/admin/asset/image/porsche-logo.jpg" width="50px" height="50px" type="image/x-icon">
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/preloader.css" rel="stylesheet"
              type="text/css" />
              <?php require APPPATH . 'views/admin/asset/common/page_right_coff.php'; ?>

    </head>
    <body onload="spinner();">
        <div class="spinner-wrapper" id="spin_div">
            <div class="spinner"></div>
        </div>
        <header></header>

        <div class="container">
            <div class="login-content">
                <?php if ($this->session->flashdata('suc_message') == 'true') { ?>
                    <div class="alert1" id="err_parant">
                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                        <span id="err_msg">OTP Has Been Sent Successfully on Your Registered Email Address.</span>
                    </div>
                <?php } else if ($this->session->flashdata('otp_fmessage') == 'false') { ?>
                    <div class="alert4" id="err_parant">
                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                        <span id="err_msg">OTP Does Not Matched.</span>
                    </div>
                <?php } else if ($this->session->flashdata('pass_fmessage') == 'pass_false') { ?>
                    <div class="alert4" id="err_parant">
                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                        <span id="err_msg">Entered Passowrd Does Not Matched.</span>
                    </div>
                <?php } ?>

                <?php echo form_open('Admin/reset_new_pass'); ?>
                <img class="img-round" src="<?php echo base_url(); ?>application/views/admin/asset/image/admin_icon.png" alt=""/>
                <h2 class="title">Verify OTP and Reset Password</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-pen-square"></i>
                    </div>
                    <div class="div">
                        <h5>Enter OTP</h5>
                        <input type="text" class="input" id="txt_otp" name="txt_otp" onblur="sendRequestOtp();" placeholder="Ex : 123abc"
                               autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                    </div>
                </div>
                <span class="errorspan" id="errorspan"><?php echo $this->session->flashdata('otp_message'); ?></span>

                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-key"></i>
                    </div>
                    <div class="div">
                        <h5>Enter New Password</h5>
                        <input type="password" class="input" id="inputpass" name="new_pass" placeholder="ex : Ssp@999" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" maxlength="40"
                               title="Your password must be at least 6 characters as well as contain one uppercase, one lowercase and one number."
                               autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                        <span class="eyes" onclick="typeCast()">
                            <i id="remove1" class="fa fa-eye"></i>
                            <i id="remove2" class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <span class="errorspan" id="inp_pass_err"><?php echo $this->session->flashdata('pass_message'); ?></span>

                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Confirm Password</h5>
                        <input type="password" class="input" id="inputpass2" name="confirm_pass" placeholder="ex : Ssp@999" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" maxlength="40"
                               title="Your password must be at least 6 characters as well as contain one uppercase, one lowercase and one number."
                               autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                        <span class="eyes" onclick="typeCast2()">
                            <i id="remove3" class="fa fa-eye"></i>
                            <i id="remove4" class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                </div>

                <span class="errorspan" id="inputpass2_error"><?php echo $this->session->flashdata('con_message'); ?></span>
                <a href="<?php echo base_url(); ?>Admin/resend_otp">Resend OTP?</a>
                <div class="btn-box">
                    <input type="submit" class="btn" value="Reset Password" onclick="return verifyotpvali();" name="btn_reset" id="btn_reset">
                    <input type="submit" class="btn2" value="Back to Login" name="btn_cancel">
                </div>
                <?php echo form_close(); ?>
            </div>
            <footer></footer>
        </div>
        <script src="<?php echo base_url(); ?>application/views/admin/asset/js/drop_eye.js" type="text/javascript"></script>
    </body>

    <script>
        if (document.getElementById("err_msg").innerText == "")
        {
            document.getElementById("err_parant").style.display = "none";
        } else {
            document.getElementById("err_parant").style.display = "block";
        }
    </script>
    <script>
        function spinner()
        {
            var spin = document.getElementById('spin_div');
            spin.style.display = 'none';
        }



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
            http1.open('get', '<?php echo base_url(); ?>Admin/chaeck_otp?data=' + data);
            http1.onreadystatechange = processResponseOtp;
            http1.send(null);
        }

        function processResponseOtp() {
            if (http1.readyState == 4) {
                var response = http1.responseText;
//                    alert(response);
                if (response == "")
                {
                    document.getElementById('errorspan').innerHTML = "OTP not matched";
                    document.getElementById('errorspan').style.color = "#cc0000";
                    document.getElementById("txt_otp").focus();
                } else if (response == "expired") {
                    document.getElementById('errorspan').innerHTML = "OTP Expired, Please Resend OTP.";
                    document.getElementById('errorspan').style.color = "#cc0000";
                    document.getElementById("txt_otp").focus();
                } else if (response == "matched") {
                    document.getElementById('errorspan').innerHTML = "OTP matched";
                    document.getElementById('errorspan').style.color = "green";
                }
            }
        }
    </script>
</html>