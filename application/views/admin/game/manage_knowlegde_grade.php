<!DOCTYPE html>
<html>
    <head>
        <?php require APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/manage_grade.css" rel="stylesheet"
              type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
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
                        <h5 id="viewGameId"><i class="fas fa-graduation-cap"></i> &nbsp;&nbsp;Knowledge Grade</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" ><a id="listGame"
                                                     href="<?php echo base_url(); ?>admin_controller/Game/manage_game">&nbsp;&nbsp;Game</a>
                            </li>
                            <li class="homelist" ><a id="listGame" href="#">&nbsp;&nbsp;Knowledge Grade</a>
                            </li>
                        </ul>
                    </div>
                </div>

                      <?php echo form_open_multipart('admin_controller/Knowledge_grade/insert_Knowldge_grade'); ?>

                    <div class="main-cards">
                        <div class="card">
                            <div class="CardIn" style="">
                                <div class="row-inside">
                                    <div class="add-alert-row">
                                        <h6 class="h6-add-game-grade">Add Knowledge Grade</h6>
                                    </div>

                                    <!--alert boxes section starts-->
                                     <?php 
                                        if ($this->session->flashdata('add_message') == 'true') { ?>
                                <div class="add-alert-row2" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Knowledge Grade </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div>
                                        <?php   } else if ($this->session->flashdata('add_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                                        <?php } else if ($this->session->flashdata('add_message') == 'delete') { 
                                            ?>
                                    <div class="add-alert-row5" id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                        <strong><span class="strong-alert-msg">Knowledge Grade </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                                    </div>
                                            <?php
                                        }
                                        ?>
                                </div>
                                <br />

                                <div id="form-elements1">
                                    <table id="mytabledata">
                                       
                                        <tr>
                                            <td width="50%">
                                                <div>
                                                    <label class="UseridentLabel">From Percentage
                                                        <span class="star-color">*</span></label>
                                                    <input type="number" name="txt_from_percent" id="txtpercent"
                                                           class="txt-from-perc" placeholder="Enter From Percentage"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" >

                                                </div>
                                                <br/>
                                                <span class="span-game-error" id="from_percent_err"><?php echo $this->session->flashdata('from_message'); ?></span>
                                            </td>

                                            <td>
                                                <div>
                                                    <label class="UseridentLabel">To Percentage
                                                        <span class="star-color">*</span></label>
                                                        <input type="number" name="txt_to_percent"  class="txt-to-perc" id="to_percent"
                                                           placeholder="Enter To Percentage" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false" >

                                                </div>
                                                <br/>
                                                <span class="span-game-error" id="to_percent_err"><?php echo $this->session->flashdata('to_message'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="UseridentLabel">Knowledge Level Image
                                                        <span class="star-color">*</span></label>
                                                    <input type="file" name="filelevel" id="know-img" class="img-badge"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" accept="image/*">
                                                </div>
                                                <br/>
                                                <span class="span-game-error" id="know-img_err"><?php echo $this->session->flashdata('level_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="UseridentLabel">Knowledge Quiz Image
                                                        <span class="star-color">*</span></label>
                                                    <input type="file" name="filequiz" id="quiz-img" class="img-badge"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" accept="image/*">

                                                </div>
                                                <br/>
                                                <span class="span-game-error" id="quiz-img-err"><?php echo $this->session->flashdata('quiz_message'); ?></span>
                                            </td>


                                        </tr>
                                        <tr>

                                            <td>
                                                <div>
                                                    <label class="UseridentLabel">Grade
                                                        <span class="star-color">*</span></label>
                                                        <input type="text" name="grade"  class="txt-to-perc" id="add-grade"
                                                           placeholder="Enter Grade" autocomplete="off"
                                                           oncopy="return false" onpaste="return false" oncut="return false">

                                                </div>
                                                <br/>
                                                <span class="span-game-error" id="add-grade_err"><?php echo $this->session->flashdata('g_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="UseridentLabel">Description
                                                        <span class="star-color">*</span></label>
                                                        <textarea rows="2" cols="5" class="txtdesc" name="txt_desc" id="add_desc"
                                                              autocomplete="off" oncopy="return false" onpaste="return false"
                                                              oncut="return false"
                                                              placeholder="Enter Description"></textarea><span
                                                              id="descErr"></span>
                                                </div>
                                                <br/>
                                                <span class="span-game-error" id="add_desc_err"><?php echo $this->session->flashdata('desc_message'); ?></span>
                                            </td>
                                            </tr>
                                             <tr>
                                            
                                        
                                           <td>
                                            <div>
                                                <label class="UseridentLabel participate-lbl">Participation<span
                                                        style="color: red;">*</span></label>
                                                <div class="Parent_Radiogroup1">
                                                    <input class="Child_Radiogroup1" type="radio" name="radio_grade"
                                                        id="radio_grade_on" value="y"> <span class="size">Yes</span>

                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input class="Child_Radiogroup2" type="radio" name="radio_grade"
                                                        id="radio_grade_off" value="n" checked=""> <span class="size">No</span>
                                                </div>
                                            </div>
                                               <span class="span-game-error" id="participate_err"><?php echo $this->session->flashdata('rd_message'); ?></span>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="btn-div">
                                                    <input type="submit" name="btn_save" value="Save" class="save-button" onclick="return manageKnowledgeGrade();">
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

                <br><br>
                <div class="card" style="height:auto;">
                    <div class="div_row">
                        <h6 class="h4txt-know ">View Knowledge Grade</h6>
                    </div><br />

                    <div class="tablediv">
                        <table id="myTable" class="display dataTable" align="center">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>From Percentage</th>
                                    <th>To Percentage</th>
                                    <th>Grade</th>
                                    <th>Description</th>
                                    <th>Level Image</th>
                                    <th>Quiz Image</th>
                                    <!--<th>Congratulation Image</th>-->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $srno = 0;
                            foreach ($know_grade as $row) {
                                $srno = $srno + 1;
                                ?>
                                <input type="hidden" name="avg_know_grade_id" value="<?php echo $row->avg_know_grade_id; ?>">
                                <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->avg_frm_percent . "%"; ?></td>
                                    <td><?php echo $row->avg_to_percent . "%"; ?></td>
                                    <td><?php echo $row->avg_grade; ?></td>
                                    <td><?php echo $row->avg_grade_desc; ?></td>
                                    <td>
                                        <div>
                                            <img src="<?php echo base_url(); ?>application/views/asset/image/knowledge_level/<?php echo $row->know_level_img; ?>"
                                                 alt="user image" style="height: 30px;width: 50px;">
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="<?php echo base_url(); ?>application/views/asset/image/knowledge_level/<?php echo $row->know_qz_img; ?>"
                                                 alt="user image" style="height: 30px;width: 50px;">
                                        </div>
                                    </td>
<!--                                    <td>
                                        <div>
                                            <img src="<?php echo base_url(); ?>application/views/asset/image/congrats_img/<?php echo $row->congrats_img; ?>"
                                                 alt="user image" style="height: 30px;width: 50px;">
                                        </div>
                                    </td>-->
                                    <td>
                                    <?php
                                                $g_id = $row->avg_know_grade_id; 
                                                $enc_key = $this->encrypt->encode($g_id);
                                    ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin_controller/Knowledge_grade/edit_knowledge_grade/<?php echo $enc_key; ?>">
                                            <i class="fa fa-edit" style="font-size:16px;color:green;"></i></a>
                                        &nbsp;&nbsp;&nbsp;<a onclick="return confirm('Are you sure want to delete knowledge grade?');"
                                            href="<?php echo base_url(); ?>admin_controller/Knowledge_grade/delete_knowledge_grade/<?php echo $enc_key; ?>"><i
                                                class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>
                                    </td>
                                </tr>
                                <?php
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
