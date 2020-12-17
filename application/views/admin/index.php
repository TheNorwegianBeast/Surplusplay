<!DOCTYPE html>
<html>
    <head>  
        <title>PORSCHE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>application/views/admin/asset/image/porsche-logo.jpg" width="50px" height="50px" type="image/x-icon">
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/index.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/common_for_all.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/asset/js/fa5.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/preloader.css" rel="stylesheet" type="text/css" />
        <?php require APPPATH . 'views/admin/asset/common/page_right_coff.php'; ?>
    </head>
    <body onload="spinner();">
        <div class="spinner-wrapper" id="spin_div">
            <div class="spinner"></div>
        </div>
        <header></header>
        <div class="container">
            <div class="login-content">
                <?php if ($this->session->flashdata('l_message') == 'false') { ?>
                    <div class="alert4" id="alert_box">
                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                        <strong>Sorry!</strong> Invalid Username or Password!
                    </div>
                <?php } else if ($this->session->flashdata('suc_message') == 'pass_true') { ?>
                    <div class="alert1" id="alert_box">
                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                        <strong>Your</strong> Password is Changed Successfully!
                    </div>
                <?php }
                ?>

                <?php echo form_open('Admin/login_validation'); ?>
                <div>
                    <img class="img-round" src="<?php echo base_url(); ?>application/views/admin/asset/image/admin_icon.png" alt="admin login"/></div>
                <h2 class="title">Admin Login</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" class="input" id="userinput1" name="txt_email"  autocomplete="off"
                               oncopy="return false" onpaste="return false" oncut="return false" placeholder="Enter Your Username" >
                    </div>
                </div>
                <span class="errorspan" id="userinput_err"><?php echo $this->session->flashdata('f_message'); ?></span>

                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="txt_password" class="input" id="inputpass" maxlength="40" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                               oncopy="return false" onpaste="return false" oncut="return false" placeholder="Enter Your Password">
                        <span class="eyes" onclick="typeCast()">
                            <i id="remove1" class="fa fa-eye"></i>
                            <i id="remove2" class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <span class="errorspan" id="inputpass_error"><?php echo $this->session->flashdata('p_message'); ?></span>
                <a href="<?php echo base_url(); ?>Admin/forgot_pass">Forgot Password?</a>
                <input type="submit" class="btn"  onclick="return indexVali()" value="Login" name="btn_login">
                <?php echo form_close(); ?>
            </div>
            <footer></footer>
        </div>
        <script src="<?php echo base_url(); ?>application/views/admin/asset/js/drop_eye.js" type="text/javascript"></script>
        <script>
            var box = document.getElementById("alert_box");
            setTimeout(
                    function () {
                        box.style.display = 'none';
                    }, 3500
                    );

            function spinner()
            {
                var spin = document.getElementById('spin_div');
                spin.style.display = 'none';
            }
        </script>
    </body>
</html>
