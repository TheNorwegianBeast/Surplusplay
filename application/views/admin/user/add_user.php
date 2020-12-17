<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_user.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/user/JS_validation.js" type="text/javascript"></script>
        <script>
            var tokenValue = '<?php echo $this->security->get_csrf_hash(); ?>';
            function ajax_call() {
                if ($("#select_game").val() === '') {
                    document.getElementById("txt_login_name").value = "";
                    document.getElementById("txt_userident").value = "";
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('admin_controller/User/get_last_id'); ?>",
                        data: {
                            '<?php echo $this->security->get_csrf_token_name(); ?>': tokenValue,
                            game_id: $("#select_game").val()
                        },
                        dataType: "json",
                        cache: false,
                        success: function (data) {
                            tokenValue = data.token;
                            document.getElementById("<?php echo $this->security->get_csrf_token_name(); ?>").value = tokenValue;
                            var login_name = data.response[0].current_count;
                            var num = 1;
                            var login = parseInt(login_name) + num;
                            login = "SSP" + login;

                            document.getElementById("txt_login_name").value = login;
                            document.getElementById("txt_userident").value = login;
                        }
                    });
                }
            }
        </script>
        <script type="text/javascript">
            var tokenValue = '<?php echo $this->security->get_csrf_hash(); ?>';
            function checkEmail() {
                // console.log('Token is ' + tokenValue);
                email = document.getElementById("txt_email").value;
                game_id = document.getElementById("select_game").value;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>admin_controller/User/check_email',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': tokenValue,
                        email: email,
                        game_id: game_id
                    },
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        // # console.log('The returned DATA is ' + JSON.stringify(data));
                        // # console.log('The returned token is ' + data.token);
                        tokenValue = data.token;
                        document.getElementById("<?php echo $this->security->get_csrf_token_name(); ?>").value = tokenValue;
                        var count = data.response[0].ECount;
                        if (email != '') {
                            if (count > 0) {
                                document.getElementById("email_span").innerHTML = 'Sorry, email already exists';
                            } else {
                                document.getElementById("email_span").innerHTML = '';
                            }
                        }
                    }
                });
            }
        </script>

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
                        <h5 id="viewGameId">
                            <i class="fa fa-user-plus" style="font-size:23px;"></i> &nbsp;Add User
                        </h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist">
                                <a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a>
                            </li>
                            <li class="homelist" style="font-size: 13px;">
                                <a id="listGame" href="#">&nbsp;&nbsp;Add User</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="post" action="<?php echo base_url(); ?>admin_controller/User/insert_user" autocomplete="off"> 
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="main-cards">
                        <div class="card">
                            <div class="CardIn">
                                <div class="row-inside">
                                    <div class="add-alert-row">
                                        <h6 class="h6-add-game">&nbsp;Add User</h6>
                                    </div>

                                    <!--alert boxes section starts-->
                                    <?php if ($this->session->flashdata('suc_message') == 'false') { ?>
                                        <div class="add-alert-row4" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                            <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                        </div>
                                    <?php } else if ($this->session->flashdata('em_message') == 'email') { ?>
                                        <div class="add-alert-row4" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                            <strong><span class="strong-alert-msg">Sorry !</span><span class="msg-alert"> &nbsp;Email Address is already registered.</span></strong>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <br />
                                <div class="form-elements">
                                    <table class="mytabledata">
                                        <tr>
                                            <td colspan="2">
                                                <div>
                                                    <label class="loginLabel" style="transform: translateY(-5px);">Select Game<span
                                                            style="color: red;">*</span></label>
                                                    <select name="select_game" id="select_game" class="sel-subscription selip1" onchange="ajax_call();checkEmail();">
                                                        <option value="">Select Game...</option>
                                                        <?php
                                                        foreach ($game as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->game_id; ?>">
                                                                <?php echo $row->game_name; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <span class="span-game-error-sel1" id="err_game_id"><?php echo $this->session->flashdata('sel_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tdp_no">
                                                <div>
                                                    <label class="loginLabel" style="transform: translateY(4px);">Login Name<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" name="txt_login_name" id="txt_login_name" placeholder="Enter Login Name" class="txt-login-name" maxlength="30" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false" readonly=""/>
                                                </div>
                                                <span class="span-err-msg er-msg" id="err_name"><?php echo $this->session->flashdata('login_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="UseridentLabel" style="transform: translate(1%,3px);">Userident <span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" id="txt_userident" class="txt-userident" name="txt_userident" placeholder="Enter Userident" maxlength="30" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false" readonly=""/>
                                                </div>
                                                <span class="span-err-msg er-msg" id="userident_err"><?php echo $this->session->flashdata('user_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="lblFname" style="transform: translateY(4px);">First Name
                                                        <span style="color: red;">*</span></label>
                                                    <input type="text" class="txt-first-name" id="inputfirstname" placeholder="Enter First Name" name="txt_first_name" maxlength="30" oncopy="return false" onpaste="return false" oncut="return false" autocomplete="off"/>
                                                </div>
                                                <span class="span-err-msg er-msg" id="fname_err"><?php echo $this->session->flashdata('f_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="lblLname" style="transform: translateY(2px);">Last Name <span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" class="txt-last-name" id="inputLastname" placeholder="Enter Last Name" name="txt_last_name" maxlength="30" oncopy="return false" onpaste="return false" oncut="return false" autocomplete="off"/>
                                                </div>
                                                <span class="span-err-msg er-msg" id="lname_err"><?php echo $this->session->flashdata('l_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="lblEmail" style="transform: translateY(4px);">Email<span style="color: red;">*</span></label>
                                                    <input type="email" id="txt_email" class="user-email" placeholder="Enter Email" name="txt_email" onchange="checkEmail();"
                                                           autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false"/>
                                                </div>
                                                <span class="span-err-msg er-msg" id="email_span"><?php echo $this->session->flashdata('email_message'); ?></span>
                                            </td>
                                            <td>
                                                <div class="data-pass">
                                                    <label class="lblPass" style="transform: translateY(4px);">Password<span style="color: red;">*</span></label>
                                                    <input type="password" id="txt_password" class="user-pass pass-visible" placeholder="Enter Password" name="txt_password" maxlength="35"
                                                           autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false"/>
                                                    <span class="eyes" onclick="typeCast3()">
                                                        <i id="remove5" class="fa fa-eye" style="color:#919191;"></i>
                                                        <i id="remove6" class="fa fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                                <span class="span-err-msg er-msg" id="pass_err"><?php echo $this->session->flashdata('pass_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="LblRoleId">Select Role<span
                                                            style="color: red;">*</span></label>
                                                    <div class="checkbox-div">
                                                        <?php
                                                        foreach ($role as $row) {
                                                            ?>
                                                            <div>
                                                                <input class="checkbx-role" type="checkbox" name="check_list[]" id="test<?php echo $row->role_id; ?>" value="<?php echo $row->role_id; ?>" />
                                                                <label class="check-label" for="test<?php echo $row->role_id; ?>">&nbsp;<?php echo $row->role_name; ?></label>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <span class="span-err-msg er-msg" id="checkbx_err"><?php echo $this->session->flashdata('role_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <input type="submit" class="save-button" onclick="return addUserVali();" name="btn_save" value="Save"/>
                                                    <input type="submit" name="btn_cancel" value="Back" class="back-button" />
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <?php echo form_close(); ?> -->
                </form>
            </main>
            <!--This is the main section beneath header admin and dropdowns ends-->
        </div>
        <script type="text/javascript">
            var box = document.getElementById("alert_box");
            setTimeout(
                    function () {
                        box.style.display = 'none';
                    }, 3000
                    );
            function typeCast3() {
                var v1 = document.getElementById("txt_password");
                var v2 = document.getElementById("remove5");
                var v3 = document.getElementById("remove6");

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
