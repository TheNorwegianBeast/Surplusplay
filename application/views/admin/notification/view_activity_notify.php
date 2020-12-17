<!DOCTYPE html>
<html>
<head>
    <?php require_once(APPPATH . 'views/admin/asset/common/common-cdns.php'); ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_notification.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
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
        <?php require_once(APPPATH . 'views/admin/asset/common/common_header.php'); ?>
        <!--header ends-->
        <?php require_once APPPATH . 'views/admin/asset/common/dialoge.php'; ?>
        <?php require_once(APPPATH . 'views/admin/asset/common/common-sidenav.php'); ?>
        <!--This is the main section beneath header admin and dropdowns starts-->
        <main class="main">
            <div class="main-header">
                <div class="main-header__heading" id="Vgameid">
                    <h5 id="viewGameId"><i class="fa fa-bell"></i> &nbsp;&nbsp;View Activity Notification</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                href="<?php echo base_url(); ?>admin_controller/Notification/add_activity_notify">&nbsp;&nbsp;Activity
                                Notification</a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View Activity
                                Notification</a></li>
                    </ul>
                </div>
            </div>

            <!--view activity section starts-->
            <div class="add-game-card">
                <div class="add-div-row">
                    <h6 class="h6-add-game">View Activity Notification</h6>
                </div><br />
                <div class="add-form-element">
                    <table class="add-game-table">
                        <?php
                            foreach ($notify as $row) {
                                ?>
                        <tr>
                            <td>
                                <div>
                                    <label class="lblGame axisy3">Activity Type </label>
                                    <input disabled="" value="<?php echo $row->type; ?>" class="txt-title">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <label class="lblGame" style="transform : translateY(6px);">From Rank </label>
                                    <input disabled="" value="<?php echo $row->from_rank; ?>" class="txt-title">
                                </div>
                            </td>
                            <td>
                                <div class="tbl_content_div">
                                    <label class="lblSubName" style="transform : translateY(-2px);">To Rank </label>
                                    <input disabled="" value="<?php echo $row->to_rank; ?>" class="txt-title">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="tbl_content_div">
                                    <label class="lblSubName">Subject </label>
                                    <input disabled="" value="<?php echo $row->subject; ?>" class="txt-title">
                                </div>
                            </td>
                            <td>
                                <div class="tbl_content_div">
                                    <label class="lblSubName" style="transform: translateY(6px);">Message </label>
                                    <textarea disabled="" class="textarea-box2"><?php echo $row->message; ?></textarea>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                            ?>
                        <tr>
                            <td>
                                <a href="<?php echo base_url(); ?>admin_controller/Notification/add_activity_notify"><input
                                        type="submit" class="back-button" value="Back" style="margin-left: 0px;"></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--view activity section ends-->
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
