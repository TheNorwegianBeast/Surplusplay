<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/profile.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/dashboard/JS_validation.js" type="text/javascript"></script>
    </head>
    <body onload="spinner();">
        <div class="spinner-wrapper" id="spin_div">
            <div class="spinner"></div>
        </div>
        <div class="grid-container">
            <div class="menu-icon" onclick="addToggleEffect();">
                <i class="fas fa-bars header__menu"></i>
            </div>
            <!--header starts-->
            <?php require_once APPPATH . 'views/admin/asset/common/common_header.php'; ?>
            <!--header ends-->
            <?php require_once APPPATH . 'views/admin/asset/common/dialoge.php'; ?>
            <?php require_once APPPATH . 'views/admin/asset/common/common-sidenav.php'; ?>

            <main class="main">
                <div class="main-header">
                    <div class="main-header__heading" id="Vgameid">
                        <h5 id="viewGameId"><i class="fas fa-key"></i> &nbsp;&nbsp;Change Password</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>Admin/profile">&nbsp;&nbsp;Change Password</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h7-add-game">Change Password</h6>
                                </div>
                                <!--alert boxes section starts-->
                                <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                                    <div class="add-alert-row3" id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                        <strong><span class="strong-alert-msg">Your Admin </span><span class="msg-alert"> &nbsp;password is updated successfully!</span></strong>
                                    </div>
                                <?php } else if ($this->session->flashdata('suc_message') == 'false') {
                                    ?>
                                    <div class="add-alert-row4" id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                        <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                    </div>
                                <?php } ?>
                            </div>
                            <br />
                            <?php echo form_open('Admin/update_password'); ?>
                            <div class="form-elements">
                                <table class="tbl-edit-mission">
                                    <tr>
                                        <td class="tbl-data1">
                                            <div style="position: relative;">
                                                <label class="lbl-ans-pnt" style="transform: translateY(6px);">Current Password<span
                                                        style="color: red;">*</span></label>
                                                <input type="password" class="txt-city"  id="inputpass" name="txt_old_pass"
                                                       autocomplete="off" oncopy="return false" maxlength="30" onpaste="return false" oncut="return false" placeholder="Enter current password">
                                                <span class="eyes" onclick="typeCast()">
                                                    <i id="remove1" class="fa fa-eye" style="font-size: 17px;display: none;"></i>
                                                    <i id="remove2" class="fa fa-eye-slash" style="font-size: 17px;color: #ccc"></i>
                                                </span>
                                            </div>
                                            <br />
                                            <span class="span-game-error" id="inputpass_err"><?php echo $this->session->flashdata('old_message'); ?></span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="tbl-data1">
                                            <div style="position: relative;">
                                                <label class="lbl-ans-pnt" style="transform: translateY(6px);">New Password<span
                                                        style="color: red;">*</span></label>
                                                <input type="password" class="txt-city" maxlength="30"  id="inputpass1" name="txt_new_pass"
                                                       autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" placeholder="Enter new password">
                                                <span class="eyes" onclick="typeCast2()">
                                                    <i id="remove3" class="fa fa-eye" style="font-size: 17px;display: none;"></i>
                                                    <i id="remove4" class="fa fa-eye-slash" style="font-size: 17px;color: #ccc"></i>
                                                </span>
                                            </div>
                                            <br />
                                            <span class="span-game-error" id="inputpass1_err"><?php echo $this->session->flashdata('new_message'); ?></span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td id="tbl-data1">
                                            <div style="position: relative;">
                                                <label class="lbl-ans-pnt" style="transform: translateY(6px);">Confirm Password<span
                                                        style="color: red;">*</span></label>
                                                <input type="password" class="txt-city" id="inputpass2" name="txt_con_pass"
                                                       autocomplete="off" maxlength="30" oncopy="return false" onpaste="return false" oncut="return false" placeholder="Enter confirm password">
                                                <span class="eyes" onclick="typeCast3()">
                                                    <i id="remove5" class="fa fa-eye" style="font-size: 17px;display: none;"></i>
                                                    <i id="remove6" class="fa fa-eye-slash" style="font-size: 17px;color: #ccc"></i>
                                                </span>
                                            </div>
                                            <br />
                                            <span class="span-game-error" id="inputpass2_err"><?php echo $this->session->flashdata('con_message'); ?></span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" class="update-button" onclick="return changepassVali();" name="change_password" value="Change Password">
                                            <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script>
            var box = document.getElementById("alert_box");
            setTimeout(
                    function () {
                        box.style.display = 'none';
                    }, 3000
                    );

            function spinner()
            {
                var spin = document.getElementById('spin_div');
                spin.style.display = 'none';
            }
        </script>
    </body>
</html>
