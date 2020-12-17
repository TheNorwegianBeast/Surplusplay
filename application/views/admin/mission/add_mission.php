<!DOCTYPE html>
<html>

    <head>
        <?php require APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_mission.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/mission/js/mission_validation.js" type="text/javascript"></script>
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
            <?php require APPPATH . 'views/admin/asset/common/common-sidenav.php'; ?>
            <!--This is the main section beneath header admin and dropdowns starts-->
            <main class="main">
                <div class="main-header">
                    <div class="main-header__heading" id="Vgameid">
                        <h5 id="viewGameId"><i class="fa fa-flag-checkered"></i> &nbsp;&nbsp;Add Mission</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Add
                                    Mission</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h6-add-game">Add Mission</h6>
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
                            <?php echo form_open_multipart('admin_controller/Mission/insert_mission'); ?>
                                <div id="form-elements1">
                                    <table id="mytabledata">
                                        <tr>
                                            <td width='50%'>
                                                <div>
                                                    <label id="UseridentLabel">Game <span
                                                            style="color: red;">*</span></label>
                                                    <select class="txt-level-step" id="game_level" name="select_game">
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
                                            <td>
                                                <div >
                                                    <label id="lblFname">Level<span style="color: red;">*</span></label>
                                                    <select class="txt-level-step" id="select_level" name="select_level">
                                                        <option value="">Select Level</option>
                                                        <option value="1">level 1</option>
                                                        <option value="2">level 2</option>
                                                        <option value="3">level 3</option>
                                                    </select>
                                                </div>
                                                <br />
                                                <span class="span-location-error" id="select_level_err"><?php echo $this->session->flashdata('level_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width='50%'>
                                                <div>
                                                    <label id="loginLabel" style="">City Image<span
                                                            style="color: red;">*</span></label>
                                                    <input type="file" class="file-location-img" id="city_image"
                                                           name="file_image" accept="image/*">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="city_img_err"><?php echo $this->session->flashdata('file_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">City Name<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" class="txt-location" id="city_name" name="txt_city"
                                                           placeholder="Enter City Name" pattern="[A-Za-z0-9 ]{1,35}" title="Enter city name." maxlength="35" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false">
                                                </div>
                                                <br />
                                                <span class="span-location-error" id="city_name_err"><?php echo $this->session->flashdata('city_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lbl-mission">Mission Step<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" class="txt-course" id="mission_step" name="txt_step"
                                                           placeholder="Enter Mission Step"  title="Enter mission step." maxlength="35" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false">
                                                </div>
                                                <br />
                                                <span class="span-location-error" id="mission_step_err"><?php echo $this->session->flashdata('step_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="lblLname">Total Question<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" class="txt-total-que" id="txt_total_question" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" name="txt_total_question" placeholder="Enter Total Question">

                                                </div>
                                                <br />
                                                <span class="span-game-error" id="total_que_err"><?php echo $this->session->flashdata('que_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblFname">Each&nbsp;Correct&#8203;Answer Point<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" id="txt_correct_answer" class="txt-correct-ans"
                                                           name="txt_correct_answer" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" placeholder="Enter Each Correct Answer Point" >
                                                </div>
                                                <br />
                                                <span class="span-location-error" id="correct_ans_err"><?php echo $this->session->flashdata('ans_message'); ?></span>
                                            </td>

                                            <td>
                                                <div>
                                                    <label id="lbltimelimit">Time Limit<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" id="time_limit" class="txt-time-limit"
                                                           name="txt_time" placeholder="Enter Time Limit in Minute" >
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="time_limit_err"><?php echo $this->session->flashdata('time_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblFname">From Date</label>
                                                    <input type="date" id="txt_from_date" class="txt-from-date"
                                                           name="txt_from_date" placeholder="dd-----yyyy">
                                                </div>
                                                <br />
<!--                                                <span class="span-location-error" id="txt_time_err"><?php echo $this->session->flashdata('fdate_message'); ?></span>-->
                                            </td>

                                            <td>
                                                <div>
                                                    <label id="lblLname">To Date</label>
                                                    <input type="date" id="txt_to_date" class="txt-to-date"
                                                           name="txt_to_date" placeholder="dd-----yyyy">
                                                </div>
                                                <br />
<!--                                                <span class="span-game-error" id="txt_from_date_err"><?php echo $this->session->flashdata('tdate_message'); ?></span>-->
                                            </td>
                                        </tr>
                                        <tr>
                                           
                                            <td>
                                                <div>
                                                    <label id="lblPass">Result<span style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radio_result" id="result_radio_on"
                                                               value="Yes"> <span class="size">Yes</span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radio_result" id="result_radio_off"
                                                               value="No" > <span class="size">No</span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="result_radio_err"><?php echo $this->session->flashdata('res_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <input type="submit" id="btnsave" name="btn_save" value="Save" class="save-button" onclick="return addMission();">
                                                    <input type="submit" id="btnsave" name="btn_cancel" value="Back" class="back-button">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <?php echo form_close();?>
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
