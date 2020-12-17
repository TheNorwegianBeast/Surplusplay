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
                        <h5 id="viewGameId"><i class="fa fa-bell"></i> &nbsp;&nbsp;Activity Notification</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/notification/add_activity_notify">&nbsp;&nbsp;Activity
                                    Notification</a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit Activity
                                    Notification</a></li>
                        </ul>
                    </div>
                </div>
                <!--add game section starts-->
                <?php echo form_open('admin_controller/Notification/update_activity_notify', 'autocomplete="off"'); ?>
                <div class="add-game-card">
                    <div class="row-inside">
                        <div class="add-alert-row axisx1">
                            <h6 class="h6-add-game">Edit Activity Notification</h6>
                        </div>

                        <!--alert boxes section starts-->
                        <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                            <div class="add-alert-row3" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                <strong><span class="strong-alert-msg">Activity Notification </span> <span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
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
                            foreach ($notify as $row) {
                                ?>
                                <tr>
                                    <td colspan="2">
                                        <div>
                                            <label class="lblGame translation">Activity Type<span style="color: red;">*</span></label>
                                            <select class="textarea-box1 slbx1" name="sel_type" id="slctdd">
                                                <option value="<?php echo $row->type; ?>"><?php echo $row->type; ?></option>
                                                <option value="Scoreboard">Scoreboard</option>
                                                <option value="Sales">Sales</option>
                                                <option value="Test Drive">Test Drive</option>
                                                <option value="Knowledge">Knowledge</option>
                                            </select>
                                        </div>
                                        <br />
                                        <span class="span-game-error-sel1" id="slctdd_err"><?php echo $this->session->flashdata('act_message'); ?></span>
                                    </td>
                                </tr>
                                <tr class="tbl-rank-row">
                                    <td class="tdp_no">
                                        <div>
                                            <label class="lblGame" style="transform: translateY(5px);">From Rank<span style="color: red;">*</span></label>
                                            <input type="number" id="frm_rank" value="<?php echo $row->from_rank; ?>"
                                                   class="txt-title" name="txt_from_rank">
                                        </div>
                                        <br />
                                        <span class="span-game-error" id="frm_rank_err"><?php echo $this->session->flashdata('frank_message'); ?></span>
                                    </td>
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName" style="transform: translateY(-2px);">To Rank<span style="color: red;">*</span></label>
                                            <input type="number" id="to_rank" value="<?php echo $row->to_rank; ?>"
                                                   class="txt-title" name="txt_to_rank">
                                        </div>
                                        <br />
                                        <span class="span-sub-error" id="to_rank_err"><?php echo $this->session->flashdata('trank_message'); ?></span>
                                    </td>
                                </tr>
                                <tr class="tbl-subject-row">
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName">Subject<span style="color: red;">*</span></label>
                                            <input type="text" id="txtentsubject" value="<?php echo $row->subject; ?>"
                                                   class="txt-title" name="txt_subject">
                                        </div>
                                        <br />
                                        <span class="span-sub-error" id="subjcttxt_err"><?php echo $this->session->flashdata('sub_message'); ?></span>
                                    </td>
                                    <td>
                                        <div class="tbl_content_div">
                                            <label class="lblSubName" style="transform: translateY(6px);">Message<span style="color: red;">*</span></label>
                                            <textarea class="textarea-box2" id="msgareabx" name="txt_message"
                                                      name="txta_content"><?php echo $row->message; ?></textarea>
                                        </div>
                                        <br />
                                        <span class="span-sub-error" id="msgareabx_err"><?php echo $this->session->flashdata('m_message'); ?></span>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td>
                                    <input type="submit" class="update-button" onclick="return editActivityVali();" name="btn_update" value="Update">
                                    <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php echo form_close(); ?>
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
