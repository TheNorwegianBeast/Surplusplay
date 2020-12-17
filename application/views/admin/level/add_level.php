<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
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
                        <h5 id="viewGameId"><i class="fa fa-signal"></i> &nbsp;&nbsp;Add Level</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Add Level</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php echo form_open('admin_controller/Level/insert_level'); ?>
                    <div class="main-cards">
                        <div class="card">
                            <div class="CardIn">
                                <div class="row-inside">
                                    <div class="add-alert-row">
                                        <h6 class="h6-add-game">Add Level</h6>
                                    </div>

                                    <!--alert boxes section starts-->
                                   <?php 
                                    if ($this->session->flashdata('suc_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                                    <?php }
                                    ?>
                                </div>
                                <br />
                                <div id="form-elements1">
                                    <table id="mytabledata">
                                        <td>
                                            <div>
                                                <label id="loginLabel1">&nbsp;Game <span
                                                        style="color: red;">*</span></label>
                                                <select name="select_game" type="text" class="txt-level-name" id="game_level"
                                                        placeholder="Enter Level Name" name="txt_level" autocomplete="off"
                                                        oncopy="return false" onpaste="return false" oncut="return false">
                                                    <option value="">Select Game...</option>
                                                    <?php
                                                    foreach ($level as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->game_id; ?>">
                                                            <?php echo $value->game_name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <br />
                                            <span class="span-game-error" id="add_game_err"><?php echo $this->session->flashdata('game_message'); ?></span>
                                        </td>


                                        <td width="50%">
                                            <div id="mainLabel">
                                                <label id="lblPass">Level Name<span
                                                        style="color: red;">*</span></label>
                                                <input type="text" class="txt-level-name" id="level-name"
                                                       placeholder="Enter Level Name" name="txt_level" pattern="[A-Za-z0-9 ]{1,25}" title="accept only alphanumeric values." maxlength="35" autocomplete="off"
                                                       oncopy="return false" onpaste="return false" oncut="return false">
                                            </div>
                                            <span class="span-game-error er-msg" id="level_name_err"><?php echo $this->session->flashdata('level_message'); ?></span>
                                        </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblFname">From Date</label>
                                                    <input type="date" name="from_date" id="from_date" class="txt-from-date"
                                                           placeholder="dd-----yyyy">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="fr_date_err"><?php echo $this->session->flashdata('from_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="lblLname">To Date</label>
                                                    <input type="date" name="to_date" id="to_date" class="txt-to-date"
                                                           placeholder="dd-----yyyy">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="to_date_err"><?php echo $this->session->flashdata('to_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="gradediv">
                                                    <label id="lblEmail">Grade<span style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input class="Child_Radiogroup1" type="radio" name="radio_grade"
                                                               id="radio_grade_on" value="Yes"> <span class="size">Yes</span>

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input class="Child_Radiogroup2" type="radio" name="radio_grade"
                                                               id="radio_grade_off"  value="No"> <span
                                                               class="size">No</span><span id="grdRerr"
                                                               style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="radio_grade_err"><?php echo $this->session->flashdata('grade_message'); ?></span>
                                            </td>
                                            <td>
                                                <div id="divpassword">
                                                    <label id="lblPass">Result<span style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radio_result" id="radio_result_on"
                                                               value="Yes"> <span class="size">Yes</span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radio_result" id="radio_result_off"
                                                                value="No"> <span class="size">No</span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="radio_result_err"><?php echo $this->session->flashdata('result_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="divemail" style="">
                                                    <label id="lblEmail">Attendance<span
                                                            style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radio_attendance" id="radio-attend-on"
                                                               value="Yes"> <span class="size">Yes</span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radio_attendance" id="radio-attend-off"
                                                                value="No"> <span class="size">No</span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="radio_attend_err"><?php echo $this->session->flashdata('att_message'); ?></span>
                                            </td>
                                            <td>
                                                <div id="divpassword">
                                                    <label id="lblPass">Certificate<span
                                                            style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radio_certificate" id="radio_certificate_on"
                                                               value="Yes"> <span class="size">Yes</span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radio_certificate" id="radio_certificate_off"
                                                                value="No"> <span class="size">No</span><span
                                                               id="certRerr"
                                                               style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="radio_certificate_err"><?php echo $this->session->flashdata('crt_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="divpassword">
                                                    <label id="lblDiploma">Diploma<span style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radio_diploma" id="radio_diploma_on"
                                                               value="Yes"> <span class="size">Yes</span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radio_diploma" id="radio_diploma_off"
                                                                value="No"> <span class="size">No</span><span
                                                               id="dipRerr"
                                                               style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="radio_diploma_err"><?php echo $this->session->flashdata('dip_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <input type="submit" name="btn_save" value="Save" class="save-button" onclick="return addLevel();">
                                                    <input type="submit" name="btn_cancel" value="Back" class="back-button">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
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
