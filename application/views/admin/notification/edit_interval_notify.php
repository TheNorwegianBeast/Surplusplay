<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_interval.css" rel="stylesheet"
              type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/notification/JS_validation.js" type="text/javascript"></script>
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
                        <h5 id="viewGameId"><i class="fa fa-edit"></i> &nbsp;&nbsp;Edit Interval Notification</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Notification/add_inteval_notify">&nbsp;&nbsp;Interval
                                    Notification</a></li>
                                    <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit Interval
                                    Notification</a></li>
                        </ul>
                    </div>
                </div>
                <!--edit interval section starts-->
                <?php echo form_open('admin_controller/Notification/update_inteval_notify', 'autocomplete="off"'); ?>
                <div class="add-game-card">
                    <div class="row-inside">
                        <div class="add-alert-row">
                            <h6 class="h6-add-game">Edit Interval Notification</h6>
                        </div>

                        <!--alert boxes section starts-->
                        <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                            <div class="add-alert-row3" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                <strong><span class="strong-alert-msg">Interval Notification </span> <span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                            </div>
                        <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                            <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something
                                        went wrong, Please try again!</span></strong>
                            </div>
                        <?php }
                        ?>

                    </div>
                    <br />

                    <div class="add-form-element">
                        <table class="add-game-table">
                            <?php
                            foreach ($notify as $row_notify) {
                                ?>
                                <tr class="tbl-row01">
                                    <td>
                                        <div>
                                            <label class="lblGame axisy1">Subject<span style="color: red;">*</span></label>
                                            <input type="text" class="txt-title" id="inpsubjct_field"
                                                   value="<?php echo $row_notify->subject; ?>"
                                                   onkeypress="return onlyAlphabets(event, this);" placeholder="Enter Subject"
                                                   name="txt_subject">
                                        </div>
                                        <br />
                                        <span class="span-game-error" id="inpsubjct_err"><?php echo $this->session->flashdata('sub_message'); ?></span>
                                    </td>
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName axisy1">Message<span style="color: red;">*</span></label>
                                            <textarea class="body_content_textarea3" id="txtAreabx" name="txt_message"
                                                      ><?php echo $row_notify->message; ?></textarea>
                                        </div>
                                        <br />
                                        <span class="span-sub-error" id="txtareabx_err"><?php echo $this->session->flashdata('mes_message'); ?></span>
                                    </td>
                                </tr>
                                <tr class="tbl-row02">
                                    <td>
                                        <div class="not-date">
                                            <label class="not-date-label">Notification Date<span style="color: red;">*</span></label>
                                            <input type="date" id="noti_date" value="<?php echo $row_notify->notification_date; ?>" class="txt-title"
                                                   name="txt_date">
                                        </div>
                                        <br />
                                        <span class="span-game-error" id="notidate_err"><?php echo $this->session->flashdata('date_message'); ?></span>
                                    </td>
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName">Notification Time<span
                                                    style="color: red;">*</span></label>
                                                    <input type="time" id="notif_time" value="<?php echo $row_notify->notification_time; ?>" class="txt-title"
                                                   name="txt_time">
                                        </div>
                                        <br />
                                        <span class="span-sub-error" id="notif_time_err"><?php echo $this->session->flashdata('time_message'); ?></span>
                                    </td>
                                </tr>
                                <tr class="tbl-row03">
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName">Notification Interval<span
                                                    style="color: red;">*</span></label>
                                                    <select class="body_content_textarea" name="sel_interval" id="interval_setduration">
                                                <option value="<?php echo $row_notify->notification_interval; ?>">
                                                    <?php echo $row_notify->notification_interval; ?></option>
                                                <option value="Only Once">Only Once</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Yearly">Yearly</option>
                                            </select>
                                        </div>
                                        <br />
                                        <span class="span-sub-error" id="duration_err"><?php echo $this->session->flashdata('int_message'); ?></span>
                                    </td>
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName">Time Zone<span style="color: red;">*</span></label>
                                            <select class="body_content_textarea" name="sel_zone" id="timezone_interval">
                                                <option value="<?php echo $row_notify->time_zone; ?>">
                                                    <?php echo $row_notify->time_zone; ?></option>
                                                <option value="CET">CET</option>
                                                <option value="GMT">GMT</option>
                                                <option value="IST">IST</option>
                                            </select>
                                        </div>
                                        <br />
                                        <span class="span-sub-error" id="tzone_err"><?php echo $this->session->flashdata('zone_message'); ?></span>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td>
                                    <input type="submit" class="update-button" onclick="return editIntervalVali();" name="btn_update" value="Update">
                                    <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!--edit interval section ends-->
            </main>
        </div>
        <script type="text/javascript">
            var box = document.getElementById("alert_box");
            setTimeout(
                    function () {
                        box.style.display = 'none';
                    }, 3000
                    );
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
