<!DOCTYPE html>
<html>

    <head>
        <?php require APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/edit_mission.css" rel="stylesheet"
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
                        <h5 id="viewGameId"><i class="fa fa-flag"></i> &nbsp;&nbsp;Edit Mission</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit
                                    Mission</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn" style="">
                            <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h6-edit-mission">&nbsp;Edit Mission</h6>
                                </div>
                                <!--alert boxes section starts-->
                                <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                                    <div class="add-alert-row3" id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                        <strong><span class="strong-alert-msg">Mission </span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
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
                            <?php echo form_open_multipart('admin_controller/Mission/update_mission'); ?>
                            <div id="form-elements">

                                <?php
                                foreach ($get_single_mission as $row) {
                                    ?>
                                    <table id="tbl-edit-mission">
                                        <input type="hidden" name="txt_res" id="txt_res"
                                               value="<?php echo $row->result; ?>">
                                        <tr>
                                            <td width="50%">
                                                <div>
                                                    <label id="loginLabel" style="">City Image<span
                                                            style="color: red;">*</span></label>
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/<?php echo $row->city_image; ?>"
                                                         alt="" class="img-background" id="img-city" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="file" accept="image/*" name="file_city" class="inp-city-img"
                                                       onchange="loadFile(event);">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label id="lbl-bg-img" >Game<span
                                                        style="color: red;">*</span></label>
                                                <select class="txt-city" id="edit_game_mission">
                                                    <option>Surplusplay Porsche 2020</option>
                                                </select>
                                                <br>
                                                <span class="span-game-error" id="game_mission_err"><?php echo $this->session->flashdata('city_message'); ?></span>
                                            </td>
                                            <td>
                                                <label id="lbl-bg-img" >Level<span
                                                        style="color: red;">*</span></label>
                                                <select class="txt-total-que" id="edit_level_mission">
                                                    <option>Level 1</option>
                                                    <option>Level 2</option>
                                                    <option>Level 3</option>
                                                </select>
                                                <span class="span-game-error" id="level_mission_err"><?php echo $this->session->flashdata('city_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lbl-bg-img" style="">City Name<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" id="txt_city" value="<?php echo $row->city_name; ?>"
                                                           class="txt-city" name="txt_city" title="Enter city name." maxlength="35" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false" >
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="txt_city_err"><?php echo $this->session->flashdata('city_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="lblmission">Mission Step<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" class="txt-total-que" id="edit_mission_step"
                                                           name="txt_step"
                                                           value="<?php echo $row->mission_step; ?>">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="mission_step_err"><?php echo $this->session->flashdata('que_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblLname">Total Question<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" class="txt-total-que" id="txt_total_question"
                                                           name="txt_total_question" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false"
                                                           value="<?php echo $row->total_question; ?>">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="total_question_err"><?php echo $this->session->flashdata('que_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="lbl-ans-pnt">Each Correct Answer Point<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" class="txt-correct-ans" name="txt_correct_answer"
                                                           id="txt_correct_answer" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false"
                                                           value="<?php echo $row->per_correct_question_point; ?>">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="correct_answer_err"><?php echo $this->session->flashdata('ans_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                <div>
                                                    <label id="lblPass">Time Limit<span style="color: red;">*</span></label>
                                                    <input type="number" id="txt_time" class="txt-time-limit" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false"
                                                           name="txt_time" value="<?php echo $row->time_limit; ?>">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="txt_time_err"><?php echo $this->session->flashdata('time_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="lbl-from-date">From Date</label>
                                                    <input type="date" class="txt-from-date" id="txt_from_date" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false"
                                                           value="<?php echo $row->from_date; ?>" name="txt_from_date">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="txt_from_date_err"><?php echo $this->session->flashdata('fdate_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                <div>
                                                    <label id="lblPass">To Date</label>
                                                    <input type="date" id="txt_to_date" class="txt-to-date" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false"
                                                           value="<?php echo $row->to_date; ?>" name="txt_to_date">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="txt_to_date_err"><?php echo $this->session->flashdata('tdate_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="lbl-result">Result<span style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radio_result" id="radio_res_on"
                                                               value="Yes"> <span class="size">Yes</span>

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radio_result" id="radio_res_off"
                                                               value="No"> <span class="size">No</span>
                                                        <span id="radOffErr"
                                                              style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error"><?php echo $this->session->flashdata('res_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="submit" class="update-button" name="update_mission" value="Update" onclick="return editMission();">
                                            <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php echo form_close(); ?>
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
                $('#myTable').DataTable();
            });
        </script>
        <script>
            var loadFile = function (event) {
                var image = document.getElementById('img-city');
                image.src = URL.createObjectURL(event.target.files[0]);
            };

            var result = document.getElementById('txt_res').value;
            if (result === 'Yes') {
                document.getElementById('radio_res_on').checked = 'true';
            } else {
                document.getElementById('radio_res_off').checked = 'false';
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
