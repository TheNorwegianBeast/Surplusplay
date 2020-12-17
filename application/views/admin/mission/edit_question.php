<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/edit_question.css" rel="stylesheet"
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
            <?php require_once APPPATH . 'views/admin/asset/common/common-sidenav.php'; ?>
            <!--This is the main section beneath header admin and dropdowns starts-->
            <?php
            foreach ($question as $row) {
                ?>
                <main class="main">
                    <div class="main-header">
                        <div class="main-header__heading" id="Vgameid">
                            <h5 id="viewGameId"><i class="fa fa-inbox t_th"></i> &nbsp;&nbsp;Edit Question</h5>
                        </div>
                        <div class="main-header__updates" id="headerUpdates" style="">
                            <ul>
                                <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                            class="fa fa-home"></i></a></li>
                                <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                                href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                                </li>
                                <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                                href="<?php echo base_url(); ?>admin_controller/Mission/manage_question">&nbsp;&nbsp;Question</a>
                                </li>
                                <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit
                                        Question</a></li>
                            </ul>
                        </div>
                    </div>

                    <?php echo form_open('admin_controller/Mission/update_question'); ?>
                    <div class="main-cards">
                        <div class="card">
                            <div class="CardIn" style="">
                                <div class="row-inside">
                                    <div class="add-alert-row">
                                        <h6 class="h6-add-game">Edit Question</h6>

                                    </div>
                                    <!--alert boxes section starts-->
                                    <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                                        <div class="add-alert-row3" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                            <strong><span class="strong-alert-msg">Question </span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                                        </div>
                                    <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                        <div class="add-alert-row4" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                            <strong><span class="strong-alert-msg"></span><span class="msg-alert"> &nbsp;Something
                                                    went wrong, Please try again!</span></strong>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <br />
                                <div id="form-elements1">
                                    <table id="mytabledata">
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Question <span
                                                            style="color: red;">*</span></label>
                                                            <textarea rows="5" cols="5" name="txt_question"  class="txtar-que" id="edit_question"
                                                              autocomplete="off" oncopy="return false" onpaste="return false"
                                                              oncut="return false"
                                                              placeholder="Enter Question"><?php echo $row->question_label; ?></textarea>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="edit_question_err"><?php echo $this->session->flashdata('message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblLname">Option A<span style="color: red;">*</span></label>
                                                    <input type="text" name="option_a" class="option-input" id="option_first"
                                                           placeholder="Enter Option A" value="<?php echo $row->option_a; ?>"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="first_option_err"><?php echo $this->session->flashdata('a_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Option B<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" name="option_b" class="option-input" id="option_second"
                                                           placeholder="Enter Option B" value="<?php echo $row->option_b; ?>"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">

                                                </div>
                                                <br />
                                                <span class="span-game-error" id="second_option_err"><?php echo $this->session->flashdata('b_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Option C<span
                                                            style="color: red;">*</span></label>
                                                            <input type="text" name="option_c" class="option-input" id="option_third"
                                                           placeholder="Enter Option C" value="<?php echo $row->option_c; ?>"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="third_option_err"><?php echo $this->session->flashdata('c_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Option D<span
                                                            style="color: red;">*</span></label>
                                                            <input type="text" name="option_d" class="option-input" id="option_fourth"
                                                           placeholder="Enter Option D" value="<?php echo $row->option_d; ?>"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="fourth_option_err"><?php echo $this->session->flashdata('d_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="divpassword">
                                                    <?php $corrAns = $row->correct_answer; ?>
                                                    <label id="lblPass">Correct Option<span
                                                            style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radiograde" id="option_one" value="A"
                                                               <?php echo ($corrAns == 'A') ? 'checked' : '' ?>> <span
                                                               class="size">A</span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radiograde" id="option_two" value="B"
                                                               <?php echo ($corrAns == 'B') ? 'checked' : '' ?>> <span
                                                               class="size">B</span><span id="grdRerr"></span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radiograde" id="option_three" value="C"
                                                               <?php echo ($corrAns == 'C') ? 'checked' : '' ?>> <span
                                                               class="size">C</span><span id="grdRerr"></span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radiograde" id="option_four" value="D"
                                                               <?php echo ($corrAns == 'D') ? 'checked' : '' ?>> <span
                                                               class="size">D</span><span id="grdRerr"></span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="correct_option_err"><?php echo $this->session->flashdata('radio_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblLname">Answer Explanation<span
                                                            style="color: red;">*</span></label>
                                                            <textarea name="txt_desc" class="txtar-ans-exp" id="option_description"
                                                              placeholder="Enter Answer Explanation"><?php echo $row->answer_explaination; ?></textarea>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="option_desc_err"><?php echo $this->session->flashdata('exp_message'); ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <div>
                                                <input type="submit" class="update-button" name="btn_update" value="Update" onclick="return editQuestion();">
                                                <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>  
                    </div>
                </div>
                <?php echo form_close(); ?>
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
