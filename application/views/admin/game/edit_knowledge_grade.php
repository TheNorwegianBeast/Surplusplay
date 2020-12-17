<!DOCTYPE html>
<html>

    <head>
        <?php require APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/edit_mission.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/game/js/game_page_validation.js" type="text/javascript"></script>
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
                        <h5 id="viewGameId"><i class="fa fa-graduation-cap"></i> &nbsp;&nbsp;Edit Knowledge Grade</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="<?php echo base_url(); ?>admin_controller/Game/manage_game">&nbsp;&nbsp;Game</a>
                        </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Knowledge_grade/manage_knowledge_grade">&nbsp;&nbsp;Knowledge Grade</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit
                                    Knowledge Grade</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn" style="">
                            <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h6-add-game">Edit Knowledge Grade</h6>
                                </div>

                                <!--alert boxes section starts-->
                                <?php 
                                if ($this->session->flashdata('add_message') == 'update') { ?>
                         <div class="add-alert-row3"  id="alert_box">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                            <strong><span class="strong-alert-msg">Knowledge Grade </span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                        </div>
                                <?php   } else if ($this->session->flashdata('add_message') == 'false') { ?>
                        <div class="add-alert-row4"  id="alert_box">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                            <strong><span class="strong-alert-msg"></span><span class="msg-alert"> &nbsp;Something
                                    went wrong, Please try again.</span></strong>
                        </div>
                                <?php }
                                ?>

                            </div>
                            <br />
                            <?php echo form_open_multipart('admin_controller/Knowledge_grade/update_knowledge_grade'); ?>
                                <div id="form-elements">

                                    <?php
                                    foreach ($know_grade_view as $row) {
                                        ?>
                                        <table id="tbl-edit-mission">
                                            <input type="hidden" name="txt_game" value="">
                                            <input type="hidden" sname="txt_res" id="txt_res"
                                                   value="<?php echo $row->is_attempt; ?>">
                                            <tr>
                                                <td width="50%">
                                                    <div>
                                                        <label class="loginLabel" >Level Image</label>
                                                        <img src="<?php echo base_url(); ?>application/views/asset/image/knowledge_level/<?php echo $row->know_level_img; ?>"
                                                             alt="" class="know-img" id="level-image" />

                                                    </div>

                                                </td>
                                                <td width="50%">
                                                    <div>
                                                        <label class="loginLabel" style="">Quiz Image</label>
                                                        <img src="<?php echo base_url(); ?>application/views/asset/image/knowledge_level/<?php echo $row->know_qz_img; ?>"
                                                             alt="" class="know-img"  id="quiz-image"/>
                                                </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="file" accept="image/*" name="filelevel" class="inp-city-img" id="inp_level_img"
                                                           onchange="loadFile(event);">
                                                    
                                                </td>
                                                <td>
                                                    <input type="file" accept="image/*" name="filequiz" class="inp-city-img" id="inp_quiz_img"
                                                           onchange="loadFileQuiz(event);">
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label id="lbl-bg-img" style="">From Percentage<span
                                                                style="color: red;">*</span></label>
                                                                <input type="number" id="txt_from_percent"
                                                               value="<?php echo $row->avg_frm_percent; ?>" class="txt-city"
                                                               name="txt_from_percent" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="from_percentage_err"><?php echo $this->session->flashdata('from_message'); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label id="lblLname">To Percentage<span
                                                                style="color: red;">*</span></label>
                                                                <input type="text" class="txt-total-que" id="to_percentage"
                                                               name="txt_to_percent" value="<?php echo $row->avg_to_percent; ?>" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="to_percentage_err"><?php echo $this->session->flashdata('to_message'); ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label id="lbl-ans-pnt">Grade<span style="color: red;">*</span></label>
                                                        <input type="text" class="txt-correct-ans" name="grade"
                                                               id="know_grade" value="<?php echo $row->avg_grade; ?>" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="know_grade_err"><?php echo $this->session->flashdata('g_message'); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label id="lblPass">Description<span
                                                                style="color: red;">*</span></label>
                                                        <textarea type="text" id="txt_time" class="txt-time-limit"
                                                                  name="txt_desc" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false"><?php echo $row->avg_grade_desc; ?></textarea>
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="txt_time_err"><?php echo $this->session->flashdata('desc_message'); ?></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div>
                                                        <label id="lbl-result">Participation<span
                                                                style="color: red;">*</span></label>
                                                        <div class="Parent_Radiogroup1">
                                                            <input type="radio" name="radio_grade" id="radio_res_on"
                                                                   value="y"> <span class="size">Yes</span>

                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio" name="radio_grade" id="radio_res_off"
                                                                   value="n"> <span class="size">No</span>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="span-game-error" id="participate_err"><?php echo $this->session->flashdata('rd_message'); ?></span>
                                                </td>
                                            </tr>
                                            <?php
                                    }
                                    ?>
                                        <tr>
                                            <td>
                                                <input type="submit" class="update-button" name="btn_update" value="Update" onclick="return editKnowledgeGrade();">
                                                <input type="submit" class="back-button" name="btn_cancel" value="Back">

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
            var loadFile = function (event) {
                var image = document.getElementById('img-city');
                image.src = URL.createObjectURL(event.target.files[0]);
            };

            var loadFileQuiz = function (event) {
                var image = document.getElementById('img-quiz');
                image.src = URL.createObjectURL(event.target.files[0]);
            };

            var loadFileCongrats = function (event) {
                var image = document.getElementById('img-congo');
                image.src = URL.createObjectURL(event.target.files[0]);
            };

            var result = document.getElementById('txt_res').value;
            if (result === 'y') {
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
