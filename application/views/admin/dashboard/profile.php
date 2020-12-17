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
            <!--This is the main section beneath header admin and dropdowns starts-->
            <main class="main">
                <div class="main-header">
                    <div class="main-header__heading" id="Vgameid">
                        <h5 id="viewGameId"><i class="fas fa-user-tie"></i> &nbsp;&nbsp;Edit Profile</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>Admin/profile">&nbsp;&nbsp;Edit Profile</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h6-add-game">Edit Profile</h6>
                                </div>
                                <!--alert boxes section starts-->
                                <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                                    <div class="add-alert-row3" id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                        <strong><span class="strong-alert-msg">Your Admin </span><span class="msg-alert"> &nbsp;profile is updated successfully!</span></strong>
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
                            <?php echo form_open_multipart('Admin/update_profile'); ?>
                            <div class="form-elements">
                                <table class="tbl-edit-mission">
                                    <?php
                                    foreach ($admin as $row) {
                                        ?>
                                        <tr>
                                            <td width="50%">
                                                <div>
                                                    <label class="loginLabel">Profile Image</label>
                                                    <?php
                                                    if ($row->profile_img) {
                                                        ?>
                                                        <img src="<?php echo base_url(); ?>application/views/admin/asset/image/profile_pic/<?php echo $row->profile_img; ?>"
                                                             alt="<?php echo $row->profile_img; ?>" class="img-background"
                                                             id="img-profile" />
                                                         <?php } else { ?>
                                                        <img src="<?php echo base_url(); ?>application/views/admin/asset/image/profile_pic/admin_logo.jpg"
                                                             alt="" class="img-background" id="img-profile" />
                                                             <?php
                                                         }
                                                         ?>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="file" accept="image/*" name="file_profile" class="inp-city-img"
                                                       onchange="loadFile(event);">
                                            </td>
                                            <td>
                                                <div class="combo1">
                                                    <label class="resp1" style="padding-top:5px;">Admin Name<span
                                                            style="color: red;">*</span></label>
                                                            <input type="text" id="txtadmin_name" value="<?php echo $row->admin_name; ?>"
                                                           class="txt-city" name="txt_name" autocomplete="off" maxlength="30" oncopy="return false" onpaste="return false" oncut="return false">
                                                </div>
                                                <span class="span-game-error" id="txtadmin_name_err"><?php echo $this->session->flashdata('name_message'); ?></span>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <div class="admiuname">
                                                    <label class="resp2">Admin Username<span
                                                            style="color: red;">*</span></label>
                                                            <input type="text" class="txt-correct-ans" maxlength="30" id="txtadUname" name="txt_username"
                                                            value="<?php echo $row->admin_username; ?>" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                                                </div>
                                                <br />
                                                <span class="span-game-error1" id="txtadUname_err"><?php echo $this->session->flashdata('user_message'); ?></span>
                                            </td>
                                            <td>
                                                <div class="combo2">
                                                    <label class="resp3">Admin email<span
                                                            style="color: red;">*</span></label>
                                                    <input type="email"
                                                           value="<?php echo $row->admin_email; ?>" class="txt-city"
                                                           name="txt_email" id="txtademail" maxlength="30" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                                                </div>
                                                <span class="span-game-error" id="txtademail_err"><?php echo $this->session->flashdata('mail_message'); ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="btn-section">
                                            <input type="submit" class="update-button btm" onclick="return editProfilevali();" name="update_profile" value="Update">
                                            <input type="submit" class="back-button btm2" name="btn_cancel" value="Back">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </main>
            <!--This is the main section beneath header admin and dropdowns ends-->
        </div>
        <script>
            var loadFile = function (event) {
                var image = document.getElementById('img-profile');
                image.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
        <script>
            function spinner()
            {
                var spin = document.getElementById('spin_div');
                spin.style.display = 'none';
            }
        </script>
    </body>

</html>
