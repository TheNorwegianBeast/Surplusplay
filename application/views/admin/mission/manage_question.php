<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/manage_question.css" rel="stylesheet"
              type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
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
            <main class="main">
                <div class="main-header">
                    <div class="main-header__heading" id="Vgameid">
                        <h5 id="viewGameId"><i class="fa fa-question-circle"></i> &nbsp;&nbsp;Question</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Question</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <?php echo form_open('admin_controller/Mission/insert_question'); ?>
                    <div class="main-cards">
                        <div class="card">
                            <div class="CardIn" style="">
                                <div class="row-inside">
                                    <div class="add-alert-row">
                                        <h6 class="h6-add-game">Add Question</h6>
                                    </div>

                                    <!--alert boxes section starts-->
                                    <?php 
                                    if ($this->session->flashdata('suc_message') == 'true') { ?>
                                <div class="add-alert-row2" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Question </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div>
                                    <?php   } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                                    <?php } else if ($this->session->flashdata('suc_message') == 'delete') { ?>
                                <div class="add-alert-row5" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Question </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                            </div>
                                    <?php   }else if ($this->session->flashdata('count_message') == 'count') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Question </span><span class="msg-alert"> &nbsp; Limit exceeded.</span></strong>
                            </div>
                                    <?php   }
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
                                                            <textarea class="txtar-que" name="txt_question" id="add_question"
                                                              placeholder="Enter Question" autocomplete="off" oncopy="return false" onpaste="return false"
                                                    oncut="return false"></textarea>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="add_question_err"><?php echo $this->session->flashdata('message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblLname">Option A<span style="color: red;">*</span></label>
                                                    <input type="text" name="txt_op_a" class="txt-opt-a" id="option_first"
                                                           placeholder="Enter Option A" autocomplete="off" oncopy="return false" onpaste="return false"
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
                                                    <input type="text" name="txt_op_b" class="txt-opt-b" id="option_second"
                                                           placeholder="Enter Option B" autocomplete="off" oncopy="return false" onpaste="return false"
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
                                                    <input type="text" name="txt_op_c" class="txt-opt-c" id="option_third"
                                                           placeholder="Enter Option C" autocomplete="off" oncopy="return false" onpaste="return false"
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
                                                    <input type="text" name="txt_op_d" class="txt-opt-d" id="option_fourth"
                                                           placeholder="Enter Option D" autocomplete="off" oncopy="return false" onpaste="return false"
                                                    oncut="return false">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="fourth_option_err"><?php echo $this->session->flashdata('d_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="divpassword">
                                                    <label id="lblPass">Correct Option<span
                                                            style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radiograde" id="radiograde_a" value="A">
                                                        <span class="size">A</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radiograde" id="radiograde_b" value="B">
                                                        <span class="size">B</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radiograde" id="radiograde_c" value="C">
                                                        <span class="size">C</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radiograde" id="radiograde_d" value="D">
                                                        <span class="size">D</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="select_option_err"><?php echo $this->session->flashdata('radio_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblansexp">Answer Explanation<span
                                                            style="color: red;">*</span></label>
                                                            <textarea name="txt_desc" class="txtar-ans-exp" id="option_description"
                                                              placeholder="Enter Answer Explanation" autocomplete="off" oncopy="return false" onpaste="return false"
                                                    oncut="return false"></textarea>
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="option_desc_err"><?php echo $this->session->flashdata('exp_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <input type="submit" class="save-button" name="btn_save" value="Save" onclick="return managerQuestion();">
                                                    <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
                <br>
                <div class="card" style="height:auto;">
                    <div class="div_row">
                        <h6 class="h4txt">View Question</h6>
                    </div><br />

                    <div style="width: 98%; background-color: transparent; ">
                        <table id="myTable" class="display dataTable" align="center">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Game</th>
                                    <th>Mission</th>
                                    <th>Question No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                foreach ($question as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $srno; ?></td>
                                        <td> <?php echo $row->game_name; ?> </td>
                                        <td><?php echo $row->mission_step; ?></td>
                                        <td><?php echo $row->question_id; ?></td>
                                        <td>
                                            <?php
                                                    $g_id = $row->question_id; 
                                                    $enc_key = $this->encrypt->encode($g_id);
                                            ?>
                                            <a
                                                href="<?php echo base_url(); ?>admin_controller/Mission/view_one_question/<?php echo $enc_key; ?>"><i
                                                    class="fa fa-eye"
                                                    style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a
                                                href="<?php echo base_url(); ?>admin_controller/Mission/edit_question/<?php echo $enc_key; ?>"><i
                                                    class="fa fa-edit"
                                                    style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a onclick="return confirm('Are you sure want to delete question?');"
                                               href="<?php echo base_url(); ?>admin_controller/Mission/delete_question/<?php echo $enc_key; ?>"><i
                                                    class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>
                                        </td>
                                    </tr>

                                    <?php
                                    $srno++;
                                }
                                ?>
                            </tbody>
                        </table>
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
