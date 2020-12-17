<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_interval.css" rel="stylesheet"
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
                        <h5 id="viewGameId"><i class="fa fa-bell"></i> &nbsp;&nbsp;View Interval Notification</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Notification/add_inteval_notify">&nbsp;&nbsp;Interval
                                    Notification</a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View Interval
                                    Notification</a></li>
                        </ul>
                    </div>
                </div>
                <!--view interval notification section starts-->
                <div class="add-game-card">
                    <div class="add-div-row">
                        <h6 class="h7-add-game">View Interval Notification</h6>
                    </div><br />

                    <div class="add-form-element">
                        <table class="add-game-table">
                            <?php
                            foreach ($notify as $row_notify) {
                                ?>
                            <tr class="row-r1">
                                    <td>
                                        <div>
                                            <label class="lblGame axisy1">Subject </label>
                                            <input type="text" class="txt-title" value="<?php echo $row_notify->subject; ?>"
                                                   disabled="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName axisy1">Message </label>
                                            <textarea class="body_content_textarea3"disabled=""><?php echo $row_notify->message; ?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="row-r2">
                                    <td>
                                        <div>
                                            <label class="lblGame axisy1">Notification Date </label>
                                            <input value="<?php echo $row_notify->notification_date; ?>" class="txt-title"
                                                   disabled="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName">Notification Time</label>
                                            <input class="txt-title" value="<?php echo $row_notify->notification_time; ?>"
                                                   disabled="">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="row-r3">
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName">Notification Interval</label>
                                            <input class="txt-title" value="<?php echo $row_notify->notification_interval; ?>"
                                                   disabled="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName">Time Zone </label>
                                            <input class="txt-title" value="<?php echo $row_notify->time_zone; ?>" disabled="">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td>
                                    <a href="<?php echo base_url(); ?>admin_controller/Notification/add_inteval_notify"><input
                                            type="submit" class="back-button" name="btn_cancel" value="Back"></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!--view interval notification section ends-->
            </main>
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
