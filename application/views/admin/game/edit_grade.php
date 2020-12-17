<!DOCTYPE html>
<html>

    <head>
        <?php require APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/edit_grade.css" rel="stylesheet"
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
                        <h5 id="viewGameId"><i class="fa fa-graduation-cap"></i> &nbsp;&nbsp;Edit Grade</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="<?php echo base_url(); ?>admin_controller/Game/manage_game">&nbsp;&nbsp;Game</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Grade/manage_grade">&nbsp;&nbsp;Grade</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit
                                    Grade</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn" style="">
                            <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h6-add-game">Edit Grade</h6>
                                </div>

                                <!--alert boxes section starts-->
                                <?php if ($this->session->flashdata('add_message') == 'update') { ?>
                                    <div class="add-alert-row3"  id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                        <strong><span class="strong-alert-msg">Grade </span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                                    </div>
                                <?php } else if ($this->session->flashdata('add_message') == 'false') { ?>
                                    <div class="add-alert-row4"  id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                        <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something
                                                went wrong, Please try again!</span></strong>
                                    </div>
                                <?php }
                                ?>


                            </div>
                            <br />
                            <?php echo form_open_multipart('admin_controller/Grade/update_grade'); ?>
                            <div id="form-elements">

                                <?php
                                foreach ($edit_grade as $row) {
                                    ?>
                                    <table id="tbl-edit-mission">
                                        <input type="hidden" name="txt_res" id="txt_res"
                                               value="<?php echo $row->is_attempt; ?>">
                                        <tr>
                                            <td width="50%">
                                                <div>
                                                    <label id="loginLabel" >Badge Image<span
                                                            style="color: red;">*</span></label>
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/badge/<?php echo $row->badge_image; ?>"
                                                         alt="" class="img-background" id="img-city" />
                                                </div>
                                            </td>
                                            <td width="50%">
                                                <div>
                                                    <label id="loginLabel" >Congratulation Image<span
                                                            style="color: red;">*</span></label>
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/congrats_img/<?php echo $row->congrats_img; ?>"
                                                         alt="" class="img-background" id="img-congo" />
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="file" accept="image/*" name="filebadge" class="inp-city-img"
                                                       onchange="loadFile(event);">
                                            </td>
                                            <td>
                                                <input type="file" accept="image/*" name="file_congo" class="inp-city-img"
                                                       onchange="loadFileCongrats(event);">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lbl-bg-img" class="from-percent" >From Percentage<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" id="txt_from_percent"
                                                           value="<?php echo $row->from_percentage; ?>" class="txt-city"
                                                           name="txt_from_percent" oncopy="return false" onpaste="return false" oncut="return false" autocomplete="off">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="percentage_err"><?php echo $this->session->flashdata('from_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="lblLname" class="from-percent">To Percentage<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" class="txt-total-que" id="to_percentage" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false"
                                                           name="txt_to_percent" value="<?php echo $row->to_percentage; ?>">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="to_percentage_err"><?php echo $this->session->flashdata('to_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lbl-ans-pnt" class="from-percent">Grade<span style="color: red;">*</span></label>
                                                    <input type="text" class="txt-correct-ans" name="txt_grade" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" 
                                                           id="edit_grade" value="<?php echo $row->grade; ?>">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="edit_grade_err"><?php echo $this->session->flashdata('grade_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="lblPass" class="from-percent">Description<span
                                                            style="color: red;">*</span></label>
                                                    <textarea type="text" id="txt_time" class="txt-time-limit" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false"
                                                              name="txt_desc"><?php echo $row->description; ?></textarea>
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
                                                        <span id="radOffErr"
                                                              style="display: inline-block;text-align: left;width: 63%;float: right;font-size: 10px;height: 12px;"></span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error err-msg" id="participate_err"><?php echo $this->session->flashdata('rd_message'); ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="submit" class="update-button" name="btn_update" value="Update" onclick="return editGrade();">
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
                $('#myTable').DataTable({
                    "order": [
                        [0, "desc"]
                    ]
                });
            });
        </script>
        <script>
            var loadFile = function (event) {
                var image = document.getElementById('img-city');
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
