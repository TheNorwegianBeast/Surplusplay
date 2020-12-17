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
                        <h5 id="viewGameId"><i class="fa fa-bell"></i> &nbsp;&nbsp;Interval Notification</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Interval
                                    Notification</a></li>
                        </ul>
                    </div>
                </div>

                <!--add game section starts-->
                <?php echo form_open('admin_controller/Notification/insert_inteval_notify', 'autocomplete="off"'); ?>
                <div class="add-game-card">
                    <div class="row-inside">
                        <div class="add-alert-row">
                            <h6 class="h6-add-game">Add Interval Notification</h6>
                        </div>

                        <!--alert boxes section starts-->
                        <?php if ($this->session->flashdata('suc_message') == 'true') { ?>
                            <div class="add-alert-row2" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Interval Notification </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div>
                        <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                            <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                        <?php } else if ($this->session->flashdata('suc_message') == 'delete') { ?>
                            <div class="add-alert-row5" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Interval Notification </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <br />

                    <div class="add-form-element">
                        <table class="add-game-table">
                            <tr>
                                <td colspan="2">
                                    <div>
                                        <label class="loginLabel axisy10">Select Game<span
                                                style="color: red;">*</span></label>
                                                <select name="select_game" class="sel-subscription flex1" id="selctgameinp">
                                            <option value="">Select Game...</option>
                                            <?php
                                            foreach ($game as $row) {
                                                ?>
                                                <option value="<?php echo $row->game_id; ?>"><?php echo $row->game_name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br />
                                    <span class="span-game-error-sel1" id="selctgame_err"><?php echo $this->session->flashdata('sel_message'); ?></span>
                                </td>
                            </tr>
                            <tr class="tbl-row2">
                                <td class="tdp_no">
                                    <div>
                                        <label class="lblGame" class="axisy1">Subject<span style="color: red;">*</span></label>
                                        <input type="text" class="txt-title" placeholder="Enter Subject"
                                               name="txt_subject" id="txt_Subject" maxlength="30" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                                    </div>
                                    <br />
                                    <span class="span-game-error" id="subinp_err"><?php echo $this->session->flashdata('sub_message'); ?></span>
                                </td>
                                <td>
                                    <div class="tbl_content_div">
                                        <label class="lblSubName axisy1">Message<span style="color: red;">*</span></label>
                                        <textarea class="body_content_textarea2" name="txt_message" id="txt_areaspace" oncopy="return false" onpaste="return false" oncut="return false"></textarea>
                                    </div>
                                    <br />
                                    <span class="span-sub-error" id="areaspace_err"><?php echo $this->session->flashdata('mes_message'); ?></span>
                                </td>
                            </tr>
                            <tr class="tbl-row3">
                                <td>
                                    <div>
                                        <label class="lblGame">Notification Date<span style="color: red;">*</span></label>
                                        <input type="date" class="txt-title" name="txt_date" id="ip_date">
                                    </div>
                                    <br />
                                    <span class="span-game-error" id="inpdate_err"><?php echo $this->session->flashdata('date_message'); ?></span>
                                </td>
                                <td>
                                    <div class="tbl_content_div">
                                        <label class="lblSubName">Notification Time<span
                                                style="color: red;">*</span></label>
                                                <input type="time" class="txt-title" name="txt_time" id="inpnotify_time">
                                    </div>
                                    <br />
                                    <span class="span-sub-error" id="notifytime_err"><?php echo $this->session->flashdata('time_message'); ?></span>
                                </td>
                            </tr>
                            <tr class="tbl-row4">
                                <td>
                                    <div class="tbl_content_div">
                                        <label class="lblSubName">Notification Interval<span
                                                style="color: red;">*</span></label>
                                        <select class="sel-subscription" name="sel_interval" id="select_intervaldd">
                                            <option value="">Select Interval</option>
                                            <option value="Only Once">Only Once</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="Monthly">Monthly</option>
                                            <option value="Yearly">Yearly</option>
                                        </select>
                                    </div>
                                    <br />
                                    <span class="span-sub-error" id="intervaldd_err"><?php echo $this->session->flashdata('int_message'); ?></span>
                                </td>
                                <td>
                                    <div class="tbl_content_div">
                                        <label class="lblSubName">Time Zone<span style="color: red;">*</span></label>
                                        <select class="sel-subscription" id="timezone_dd" name="sel_zone"
                                                style="float: right;">
                                            <option value="">Select Timezone</option>
                                            <option value="CET">CET</option>
                                            <option value="GMT">GMT</option>
                                            <option value="IST">IST</option>
                                        </select>
                                    </div>
                                    <br />
                                    <span class="span-sub-error" id="timezone_errmsg"><?php echo $this->session->flashdata('zone_message'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="save-button" onclick="return addIntervalVali();" name="btn_save" value="Save">
                                    <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!--add game section ends-->
                <div class="main-cards">
                    <div class="card">
                        <div class="div_row">
                            <h6 class="h4txt">View Interval Notification</h6>
                        </div><br />

                        <div style="width: 100%; background-color: transparent; ">
                            <?php echo form_open('admin_controller/Notification/add_inteval_notify'); ?>
                            <div>
                                <label class="lbl-game">Select Game<span
                                        style="color: red;">*</span></label>
                                <select name="select_game" class="sel-game" onchange="this.form.submit();">
                                    <option value=" "><?php echo $sel_game; ?> </option>
                                    <?php
                                    foreach ($user_game as $row_one):
                                        ?>
                                        <option value="<?php echo $row_one->game_id; ?>"><?php echo $row_one->game_name; ?> </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <?php echo form_close(); ?>
                            <br><br>
                            <table id="myTable" class="display dataTable cell-border" align="center">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Notification Date</th>
                                        <th>Notification Time</th>
                                        <th>Interval</th>
                                        <th>Timezone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $serial_no = 1;
                                    foreach ($notification as $row_notify) {
                                        ?>
                                        <tr>
                                            <td><?php echo $serial_no ?></td>
                                            <td><?php echo $row_notify->subject; ?></td>
                                            <td><?php echo $row_notify->message; ?></td>
                                            <td><?php echo $row_notify->notification_date; ?></td>
                                            <td><?php echo $row_notify->notification_time; ?></td>
                                            <td><?php echo $row_notify->notification_interval; ?></td>
                                            <td><?php echo $row_notify->time_zone; ?></td>
                                            <td>
                                                <?php
                                                $g_id = $row_notify->interval_notification_id;
                                                $enc_key = $this->encrypt->encode($g_id);
                                                ?>
                                                <a
                                                    href="<?php echo base_url(); ?>admin_controller/Notification/view_interval_notify/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-eye"
                                                        style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a
                                                    href="<?php echo base_url(); ?>admin_controller/Notification/edit_interval_notify/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-edit"
                                                        style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a onclick="return confirm('Are you sure want to delete interval notification?');"
                                                   href="<?php echo base_url(); ?>admin_controller/Notification/delete_inteval_notify/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $serial_no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

            $(document).ready(function () {
                $('#myTable').DataTable({
                    "order": [
                        [0, "desc"]
                    ]
                });
            });
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
