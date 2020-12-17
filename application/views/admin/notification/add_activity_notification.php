<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_notification.css" rel="stylesheet"
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
                        <h5 id="viewGameId"><i class="fa fa-plus-square" style="font-size: 25px;"></i> &nbsp;&nbsp;Activity Notification</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Activity
                                    Notification</a></li>
                        </ul>
                    </div>
                </div>

                <!--add game section starts-->
                <?php echo form_open('admin_controller/Notification/insert_activity_notify', 'autocomplete="off"'); ?>
                <div class="add-game-card">
                    <div class="row-inside">
                        <div class="add-alert-row axisx1">
                            <h6 class="h6-add-game">Add Activity Notification</h6>
                        </div>

                        <!--alert boxes section starts-->
                        <?php if ($this->session->flashdata('suc_message') == 'true') { ?>
                            <div class="add-alert-row2" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Activity Notification </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div>
                        <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                            <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                        <?php } else if ($this->session->flashdata('suc_message') == 'delete') { ?>
                            <div class="add-alert-row5" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Activity Notification </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <br />
                    <div class="add-form-element">
                        <table class="add-game-table">
                            <tr class="tbl-r1">
                                <td class="tbl-data-r1">
                                    <div>
                                        <label class="loginLabel axisy3">Select Game<span
                                                style="color: red;">*</span></label>
                                        <select name="select_game" class="sel-subscription selct-box1" id="seloptdd">
                                            <option value="">Select Game...</option>
                                            <?php
                                            foreach ($game as $row) {
                                                ?>
                                                <option value="<?php echo $row->game_id; ?>"> <?php echo $row->game_name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <span class="span-game-error" id="seloptdd_err"><?php echo $this->session->flashdata('sel_message'); ?></span>
                                <td>
                                    <div>
                                        <label class="lblGame axisy3">Activity Type<span style="color: red;">*</span></label>
                                        <select class="select-sub-box1" name="sel_type" id="act_type">
                                            <option value="">Select Type</option>
                                            <option value="Scoreboard">Scoreboard</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Test Drive">Test Drive</option>
                                            <option value="Knowledge">Knowledge</option>
                                        </select>
                                    </div>
                                    <span class="span-game-error" id="acttype_err"><?php echo $this->session->flashdata('act_message'); ?></span>
                                </td>
                            </tr>
                            <tr class="tbl-r2">
                                <td>
                                    <div>
                                        <label class="lblGame axisy3">From Rank<span style="color: red;">*</span></label>
                                        <input type="number" class="txt-title" id="txt_from_rank"
                                               name="txt_from_rank" placeholder="Enter From Rank">
                                    </div>
                                    <span class="span-game-error" id="txtfrmrnk_err"><?php echo $this->session->flashdata('frank_message'); ?></span>
                                </td>
                                <td>
                                    <div class="tbl_content_div">
                                        <label class="lblSubName" style="transform: translateY(-3px);">To Rank<span style="color: red;">*</span></label>
                                        <input type="number" class="txt-title" id="txt_to_rank"
                                               name="txt_to_rank" placeholder="Enter To Rank">
                                    </div>
                                    <span class="span-game-error" id="txttornk_err"><?php echo $this->session->flashdata('trank_message'); ?></span>
                                </td>
                            </tr>
                            <tr class="tbl-r3">
                                <td>
                                    <div class="tbl_content_div">
                                        <label class="lblSubName">Subject<span style="color: red;">*</span></label>
                                        <input type="text" class="txt-title" id="txt_actsubject"
                                               name="txt_subject" placeholder="Enter subject">
                                    </div>
                                    <span class="span-game-error" id="txt_actsubject_err"><?php echo $this->session->flashdata('sub_message'); ?></span>
                                </td>
                                <td>
                                    <div class="tbl_content_div">
                                        <label class="lblSubName axisy3">Message<span style="color: red;">*</span></label>
                                        <textarea class="body_content_textarea textarea-box2" id="activity_msgs" name="txt_message"
                                                  name="txta_con tent" placeholder="Type your message here..."></textarea>
                                    </div>
                                    <span class="span-game-error" id="activity_msgs_err"><?php echo $this->session->flashdata('m_message'); ?></span>
                                </td>
                            </tr>
                            <tr class="tbl-r4">
                                <td>
                                    <input type="submit" class="save-button" onclick="return addActivityVali();" name="btn_save" value="Save">
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
                        <div class="div_row" style="background-color: inherit">
                            <h6 class="h4txt">View Activity Notification</h6>
                        </div><br />

                        <div style="width: 100%; background-color: transparent; ">
                            <?php echo form_open('admin_controller/Notification/add_activity_notify'); ?>
                            <div>
                                <label class="lbl-game">Select Game<span
                                        style="color: red;">*</span></label>
                                <select name="select_game" id="select_game" class="sel-game" onchange="this.form.submit();">
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
                                        <th>Type</th>
                                        <th>From rank</th>
                                        <th>To Rank</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serial_no = 1;
                                    foreach ($notify as $row_notify) {
                                        ?>
                                        <tr>
                                            <td><?php echo $serial_no ?></td>
                                            <td><?php echo $row_notify->type; ?></td>
                                            <td><?php echo $row_notify->from_rank; ?></td>
                                            <td><?php echo $row_notify->to_rank; ?></td>
                                            <td><?php echo $row_notify->subject; ?></td>
                                            <td><?php echo $row_notify->message; ?></td>
                                            <td><?php echo $row_notify->timestamp; ?></td>
                                            <td>
                                                <?php
                                                $g_id = $row_notify->activity_notification_id;
                                                $enc_key = $this->encrypt->encode($g_id);
                                                ?>
                                                <a
                                                    href="<?php echo base_url(); ?>admin_controller/Notification/view_activity_notify/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-eye"
                                                        style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a
                                                    href="<?php echo base_url(); ?>admin_controller/Notification/edit_activity_notify/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-edit"
                                                        style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a onclick="return confirm('Are you sure want to delete activity Notification?');"
                                                   href="<?php echo base_url(); ?>admin_controller/Notification/delete_activity_notify/<?php echo $enc_key; ?>"><i
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
