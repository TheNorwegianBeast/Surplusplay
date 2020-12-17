<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_user.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/user/JS_validation.js" type="text/javascript"></script>
        <script type="text/javascript">
            var tokenValue = '<?php echo $this->security->get_csrf_hash(); ?>';
            function checkEmail() {
                console.log('Token is ' + tokenValue);
                email = document.getElementById("txt_email").value;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>admin_controller/User/check_edit_email',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': tokenValue,
                        email: email
                    },
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        console.log('The returned DATA is ' + JSON.stringify(data));
                        console.log('The returned token is ' + data.token);
                        tokenValue = data.token;
                        document.getElementById("<?php echo $this->security->get_csrf_token_name(); ?>").value = tokenValue;
                        var count = data.response[0].ECount;
                        if (email != '') {
                            if (count > 0) {
                                tempEmail = document.getElementById("t_email").value;
                                if (tempEmail === email) {
                                    document.getElementById("email_span").innerHTML = '';
                                } else {
                                    document.getElementById("email_span").innerHTML = 'Sorry, email already exists';
                                }
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
                        <h5 id="viewGameId"><i class="fas fa-user-edit"></i> &nbsp;&nbsp;Edit User</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/User/manage_user">&nbsp;&nbsp;User</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit User</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="post" action="<?php echo base_url(); ?>admin_controller/User/update_user" autocomplete="off"> 
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="main-cards">
                        <div class="card">
                            <div class="CardIn" style="">
                                <div class="row-inside">
                                    <div class="add-alert-row">
                                        <h6 class="h6-add-game">Edit User</h6>
                                    </div>
                                    <!--alert boxes section starts-->
                                    <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                                        <div class="add-alert-row3" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                            <strong><span class="strong-alert-msg">User</span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                                        </div>
                                    <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                        <div class="add-alert-row4" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                            <strong><span class="strong-alert-msg">No</span><span class="msg-alert"> &nbsp;Changes were made in record!</span></strong>
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
                                <?php
                                foreach ($user as $row_user) {
                                    ?>
                                    <input type="hidden" name="user_id_hidden" value="<?php echo $row_user->userident; ?>" />
                                    <input type="hidden" id="role-hidden1" value="<?php echo $p_user_role_id1; ?>" />
                                    <input type="hidden" id="role-hidden2" value="<?php echo $p_user_role_id2; ?>" />
                                    <div class="form-elements">
                                        <table class="mytabledata">
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label class="lblFname" style="transform : translateY(4px);">First Name <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text" value="<?php echo $row_user->first_name; ?>"
                                                               class="txt-first-name" id="inputFirstName" placeholder="Enter First Name"
                                                               name="txt_first_name" maxlength="30" autocomplete="off"
                                                               oncopy="return false" onpaste="return false" oncut="return false">
                                                    </div>
                                                    <span class="span-game-error" id="fname_err"><?php echo $this->session->flashdata('f_message') ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label class="lblLname" style="transform : translateY(2px);">Last Name <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text"
                                                               value="<?php echo $row_user->last_name; ?>" class="txt-last-name L-name"
                                                               id="inputLastName" placeholder="Enter Last Name" name="txt_last_name" maxlength="30" autocomplete="off"
                                                               oncopy="return false" onpaste="return false" oncut="return false">
                                                    </div>
                                                    <span class="span-game-error" id="lname_err"><?php echo $this->session->flashdata('l_message') ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label class="lblEmail" style="transform : translateY(8px);">Email<span style="color: red;">*</span></label>
                                                        <input type="email" value="<?php echo $row_user->email; ?>" onchange="checkEmail();"
                                                               id="txt_email" class="user-email" placeholder="Enter Email"
                                                               name="txt_email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,40}" oncopy="return false" onpaste="return false" oncut="return false" autocomplete="off">
                                                        <input type="hidden" value="<?php echo $row_user->email; ?>" name="t_email" id="t_email">
                                                    </div>
                                                    <span class="span-game-error" id="email_span"><?php echo $this->session->flashdata('email_message') ?></span>
                                                </td>
                                                <td>
                                                    <label class="LblRoleId translationlbl1">User Role<span
                                                            style="color: red;">*</span></label>
                                                    <div class="checkbox-div">
                                                        <?php
                                                        foreach ($role as $row) {
                                                            ?>
                                                            <div>
                                                                <input type="checkbox" name="check_list[]"
                                                                       id="test<?php echo $row->role_id; ?>"
                                                                       value="<?php echo $row->role_id; ?>" />
                                                                <label class="check-label"
                                                                       for="test<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></label>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    </div>
                                                    <span class="span-game-error"><?php echo $this->session->flashdata('role_message') ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <input type="submit" name="btn_update" value="Update" class="update-button" onclick="return editUservali();">
                                                        <input type="submit" name="btn_cancel" value="Back" class="back-button">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
            <!--This is the main section beneath header admin and dropdowns ends-->
        </div>
        <script>
            var box = document.getElementById("alert_box");
            setTimeout(
                    function () {
                        box.style.display = 'none';
                    }, 3000
                    );
            var role1 = document.getElementById("role-hidden1").value;
            var role2 = document.getElementById("role-hidden2").value;
            if (role2 !== "") {
                document.getElementById("test" + role1).checked = true;
                document.getElementById("test" + role2).checked = true;
            } else {
                document.getElementById("test" + role1).checked = true;
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
