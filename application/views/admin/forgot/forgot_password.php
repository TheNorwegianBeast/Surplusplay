<!DOCTYPE html>
<html>
    <head>
        <title>PORSCHE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="<?php echo base_url(); ?>application/views/admin/asset/js/fa5.js" type="text/javascript"></script>
        <link rel="icon" href="<?php echo base_url(); ?>application/views/admin/asset/image/porsche-logo.jpg" width="50px" height="50px" type="image/x-icon">
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/forgot_password.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/common_for_all.css" rel="stylesheet" type="text/css" />
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

                <?php echo form_open('Admin/reset_pass'); ?>
                <?php if ($this->session->flashdata('suc_message') == 'false') { ?>
                <div class="alert-box1" id="alert_box">Sorry, entered Email is not found in database.
                        <i class="fa fa-times" style="cursor:pointer;" onclick="this.parentElement.style.display = 'none';"></i>
                    </div>
                <?php } ?>
                <br>
                <br>
                <img class="img-round" src="<?php echo base_url(); ?>application/views/admin/asset/image/admin_icon.png" alt=""/>
                <h2 class="title">Forgot your Password ?</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" id="txt_email" name="txt_email" class="input" placeholder="example@website.com"
                               autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                    </div>
                </div>
                <span class="errorspan" id="txt_email_err"><?php echo $this->session->flashdata('email_message'); ?></span>
                <div class="div-btn">

                    <input type="submit" class="btn" value="Send recovery email" onclick="return forgotpassvali();" name="btn_forgot">
                    <input type="submit" class="btn2" value="Back to Login" name="btn_cancel">
                </div>
                <?php echo form_close(); ?>
            </div>
            <footer></footer>
        </div>
        <script src="<?php echo base_url(); ?>application/views/admin/asset/js/drop_eye.js" type="text/javascript"></script>
        <script>
            function spinner()
            {
                var spin = document.getElementById('spin_div');
                spin.style.display = 'none';
            }
        </script>
    </body>
</html>