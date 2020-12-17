<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/edit_level_course.css" rel="stylesheet"
              type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_level.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/level/js/level_validation.js" type="text/javascript"></script>
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
                        <h5 id="viewGameId"><i class="fa fa-signal"></i> &nbsp;&nbsp;Edit Level</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="<?php echo base_url(); ?>admin_controller/Level/get_level">&nbsp;&nbsp;Level</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit
                                    Level</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn" style="">
                            <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h6-add-game">Edit Level</h6>
                                </div>
                                <!--alert boxes section starts-->
                               <?php 
                                if ($this->session->flashdata('suc_message') == 'update') { ?>
                         <div class="add-alert-row3" id="alert_box">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                            <strong><span class="strong-alert-msg">Level </span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                        </div>
                                <?php   } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                        <div class="add-alert-row4" id="alert_box">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                            <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something
                                    went wrong, Please try again!</span></strong>
                        </div>
                                <?php }
                                ?>
                            </div>
                            <br />

                            <div id="form-elements">
                                <?php echo form_open('admin_controller/Level/update_level'); ?>
                                          <?php
                                            foreach ($level as $value) {
                                                ?>
                                        <table id="mytabledata">
                                            <input type="hidden" value="<?php echo $value->grades; ?>" id="level-grade">
                                            <input type="hidden" value="<?php echo $value->result; ?>" id="level-result">
                                            <input type="hidden" value="<?php echo $value->attendance; ?>"
                                                   id="level-attendance">
                                            <input type="hidden" value="<?php echo $value->certifcate; ?>"
                                                   id="level-certificate">
                                            <input type="hidden" value="<?php echo $value->diploma; ?>" id="level-diploma">
                                            <tr>
                                                <td id="tbl-data-title">
                                                    <div>
                                                        <label id="loginLabel" style="">Level Title<span
                                                                style="color: red;">*</span></label>
                                                        <input type="text" id="txt_level" class="txt-level-title"
                                                               value="<?php echo $value->title ?>" name="txt_level_name"  title="accept only alphanumeric values with spaces." maxlength="35" autocomplete="off"
                                                               oncopy="return false" onpaste="return false" oncut="return false">
                                                    </div>
<!--                                                    <br />-->
                                                    <span class="span-game-error" id="edit_level_err"><?php echo $this->session->flashdata('level_message'); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label id="lblFname">From Date</label>
                                                        <input type="date" id="from_date" class="txt-from-date"
                                                               value="<?php echo $value->from_date ?>" name="level_from_date">
                                                    </div>
                                                    <br />
                                                    <!--<span class="span-game-error" id="fr_date_err"><?php echo $this->session->flashdata('from_message'); ?></span>-->
                                                </td>
                                            </tr>

                                            <tr>
                                                
                                                <td>
                                                    <div>
                                                        <label id="lblLname">To Date</label>
                                                        <input type="date" id="to_date" class="txt-to-date"
                                                               value="<?php echo $value->to_date; ?>" name="level_to_date">
                                                    </div>
                                                    <br />
                                                    <!--<span class="span-game-error" id="to_date_err"><?php echo $this->session->flashdata('to_message'); ?></span>-->
                                                </td>
                                                <td>
                                                    <div id="gradediv">
                                                        <label id="lblEmail">Grade<span style="color: red;">*</span></label>
                                                        <div class="Parent_Radiogroup1">
                                                            <input class="Child_Radiogroup1" type="radio" name="radio_grade"
                                                                   id="radio-grade-on" value="Yes"> <span class="size">Yes</span>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input class="Child_Radiogroup2" type="radio" name="radio_grade"
                                                                   id="radio-grade-off" value="No"> <span
                                                                   class="size">No</span><span id="grdRerr"
                                                                   style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="radio_grade_err"><?php echo $this->session->flashdata('grade_message'); ?></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                
                                                <td>
                                                    <div id="divpassword">
                                                        <label id="lblPass">Result<span style="color: red;">*</span></label>
                                                        <div class="Parent_Radiogroup1">
                                                            <input type="radio" name="radio_result" id="radio-resulton"
                                                                   value="Yes"> <span class="size">Yes</span>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio" name="radio_result" id="radio-resultoff"
                                                                   value="No"> <span class="size">No</span><span id="resRerr"
                                                                   style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="radio_result_err"><?php echo $this->session->flashdata('result_message'); ?></span>
                                                </td>
                                                <td>
                                                    <div id="divemail" style="">
                                                        <label id="lblEmail">Attendance<span
                                                                style="color: red;">*</span></label>
                                                        <div class="Parent_Radiogroup1">
                                                            <input type="radio" name="radio_attendance" id="radio-attendance-on"
                                                                   value="Yes"> <span class="size">Yes</span>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio" name="radio_attendance"
                                                                   id="radio-attendance-off" value="No"> <span
                                                                   class="size">No</span><span id="attRerr"
                                                                   style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="radio_attendance_err"><?php echo $this->session->flashdata('att_message'); ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    <div id="divpassword">
                                                        <label id="lblPass">Certificate<span
                                                                style="color: red;">*</span></label>
                                                        <div class="Parent_Radiogroup1">
                                                            <input type="radio" name="radio_certificate"
                                                                   id="radio-certificate-on" value="Yes"> <span
                                                                   class="size">Yes</span>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio" name="radio_certificate"
                                                                   id="radio-certificate-off" value="No"> <span
                                                                   class="size">No</span><span id="certRerr"
                                                                   style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="radio_certificate_err"><?php echo $this->session->flashdata('crt_message'); ?></span>
                                                </td>
                                                <td>
                                                    <div id="divpassword">
                                                        <label id="lblDiploma">Diploma<span style="color: red;">*</span></label>
                                                        <div class="Parent_Radiogroup1">

                                                            <input type="radio" name="radio_diploma" id="radio-diploma-on"
                                                                   value="Yes"> <span class="size">Yes</span>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio" name="radio_diploma" id="radio-diploma-off"
                                                                   value="No"> <span class="size">No</span><span id="dipRerr"
                                                                   style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="radio_diploma_err"><?php echo $this->session->flashdata('dip_message'); ?></span>
                                                </td>
                                            </tr>
                                            
                                                <?php
                                            }
                                            ?>
                                        <tr>
                                            <td>
                                                <div class="btn-div">
                                                    <input type="submit" class="update-button" name="btnupdate" value="Update" onclick="return editLevel();">
                                                    <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                <?php echo form_close();?>
                            </div>
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
            var grade = document.getElementById('level-grade').value;

            if (grade === 'Yes') {
                document.getElementById('radio-grade-on').checked = 'true';
            } else {
                document.getElementById('radio-grade-off').checked = 'true';
            }

            var result = document.getElementById('level-result').value;

            if (result === 'Yes') {
                document.getElementById('radio-resulton').checked = 'true';
            } else {
                document.getElementById('radio-resultoff').checked = 'true';
            }

            var attendance = document.getElementById('level-attendance').value;

            if (attendance === 'Yes') {
                document.getElementById('radio-attendance-on').checked = 'true';
            } else {
                document.getElementById('radio-attendance-off').checked = 'true';
            }

            var certificate = document.getElementById('level-certificate').value;

            if (certificate === 'Yes') {
                document.getElementById('radio-certificate-on').checked = 'true';
            } else {
                document.getElementById('radio-certificate-off').checked = 'true';
            }

            var diploma = document.getElementById('level-diploma').value;

            if (diploma === 'Yes') {
                document.getElementById('radio-diploma-on').checked = 'true';
            } else {
                document.getElementById('radio-diploma-off').checked = 'true';
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
