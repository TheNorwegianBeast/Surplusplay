<!DOCTYPE html>
<html>

<head>
    <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_user.css" rel="stylesheet"
        type="text/css" />
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
                    <h5 id="viewGameId"><i class="fas fa-user-lock"></i> &nbsp;&nbsp;View User</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                href="<?php echo base_url(); ?>admin_controller/User/manage_user">&nbsp;&nbsp;User</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View User</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-cards">
                <div class="card">
                    <div class="CardIn">
                        <div class="div_row">
                            <h6 class="h4txt">View User</h6>
                        </div><br />
                        <?php
                        foreach ($user as $row_user) {
                            ?>
                        <div class="form-elements">
                            <table class="mytabledata">
                                <tr>
                                    <td>
                                        <div>
                                            <label class="loginLabel" style="transform: translateY(4px);">Login Name</label>
                                            <input type="text" value="<?php echo $row_user->login_name; ?>"
                                                class="txt-login-name" disabled="">
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <label class="UseridentLabel" style="transform: translateY(3px);">Userident</label>
                                            <input type="text" id="txtuserident" class="txt-userident"
                                                value="<?php echo $row_user->userident; ?>" disabled="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <label class="lblFname" style="transform: translateY(5px);">First Name</label>
                                            <input type="text" id="F-name" class="txt-first-name"
                                                value="<?php echo $row_user->first_name; ?>" disabled="">
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <label class="lblLname" style="transform: translateY(4px);">Last Name</label>
                                            <input type="text" id="L-name" class="txt-last-name"
                                                value="<?php echo $row_user->last_name; ?>" disabled="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="divemail">
                                            <label class="lblEmail" style="transform: translateY(6px);">Email</label>
                                            <input type="email" id="inpEmail" class="user-email"
                                                value="<?php echo $row_user->email; ?>" disabled="">
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <label class="LblRoleId" style="transform: translateY(5px);">User Role</label>
                                            <input class="input-LblRoleId" type="text"
                                                value="<?php echo substr($user_role, 0, -2); ?>" disabled="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin_controller/User/manage_user"><input
                                                type="submit" class="back-button" name="btn_cancel" value="Back"></a>
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
        </main>
        <!--This is the main section beneath header admin and dropdowns ends-->
    </div>
    <script>
function spinner()
{
    var spin = document.getElementById('spin_div');
    spin.style.display = 'none';
}
        </script>
</body>

</html>
