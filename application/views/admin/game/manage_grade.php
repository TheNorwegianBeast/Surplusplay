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
                        <h5 id="viewGameId"><i class="fa fa-graduation-cap"></i> &nbsp;&nbsp;Grade</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist"><a id="listGame"
                                                    href="<?php echo base_url(); ?>admin_controller/Game/manage_game">&nbsp;&nbsp;Game</a>
                            </li>
                            <li class="homelist"><a id="listGame" href="#">&nbsp;&nbsp;Grade</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <?php echo form_open_multipart('admin_controller/Grade/insert_grade'); ?>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn" style="">
                            <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h6-add-game">&nbsp;Add Grade</h6>
                                </div>

                                <!--alert boxes section starts-->
                                <?php if ($this->session->flashdata('add_message') == 'true') { ?>
                                    <div class="add-alert-row2"  id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                        <strong><span class="strong-alert-msg">Grade </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                                    </div>
                                <?php } else if ($this->session->flashdata('add_message') == 'false') { ?>
                                    <div class="add-alert-row4"  id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                        <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                    </div>
                                <?php } else if ($this->session->flashdata('add_message') == 'delete') {
                                    ?>
                                    <div class="add-alert-row5"  id="alert_box">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                        <strong><span class="strong-alert-msg">Grade </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
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
                                                       oncut="return false">
                                            </div>
                                            <span class="span-game-error" id="from_percent_err"><?php echo $this->session->flashdata('from_message'); ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="UseridentLabel">To Percentage
                                                    <span class="star-color">*</span></label>
                                                    <input type="number" name="txt_to_percent"  class="txt-to-perc" id="to_percent"
                                                       placeholder="Enter To Percentage" autocomplete="off"
                                                       oncopy="return false" onpaste="return false" oncut="return false">
                                            </div>
                                            <span class="span-game-error" id="to_percent_err"><?php echo $this->session->flashdata('to_message'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <label class="UseridentLabel">Grade
                                                    <span class="star-color">*</span></label>
                                                    <input type="text" name="txt_grade" class="txt-grade" id="add_grade"
                                                       placeholder="Enter Grade" autocomplete="off" oncopy="return false"
                                                       onpaste="return false" oncut="return false" >
                                            </div>
                                            <span class="span-game-error" id="add_grade_err"><?php echo $this->session->flashdata('grade_message'); ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="UseridentLabel">Badge Image
                                                    <span class="star-color">*</span></label>
                                                <input type="file" name="filebadge" id="badge_img" class="img-badge"
                                                       autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false" accept="image/*">
                                            </div>
                                            <span class="span-game-error" id="badge_img_err"><?php echo $this->session->flashdata('file_message'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                    <label class="UseridentLabel">Congrats Image
                                                        <span class="star-color">*</span></label>
                                                    <input type="file" name="congo_file" id="congrat_img" class="img-badge"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" accept="image/*">

                                                </div>
                                                <br/>
                                                <span class="span-game-error" id="congrats_img_err"><?php echo $this->session->flashdata('congo_message'); ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="UseridentLabel">Description
                                                    <span class="star-color">*</span></label>
                                                    <textarea rows="2" cols="5" class="txtdesc" name="txt_desc" id="add_desc"
                                                          autocomplete="off" oncopy="return false" onpaste="return false"
                                                          oncut="return false"
                                                          placeholder="Enter Description"></textarea>
                                            </div>
                                            <span class="span-game-error" id="desc_err"><?php echo $this->session->flashdata('desc_message'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>
                                            <div>
                                                <label class="UseridentLabel participate-lbl" >Participation
                                                    <span class="star-color">*</span></label>
                                                <div class="Parent_Radiogroup1">
                                                    <input class="Child_Radiogroup1" type="radio" name="radio_grade"
                                                           id="radio_grade_on" value="y"> <span  class="radio-y">Yes</span>

                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input class="Child_Radiogroup2" type="radio" name="radio_grade"
                                                           id="radio_grade_off" value="n" > <span class="radio-n">No</span>
                                                </div>
                                            </div>
                                            <span class="span-game-error" id="participate_err"><?php echo $this->session->flashdata('rd_message'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="btn-div">
                                                <input type="submit" id="btnsave" name="btn_save" value="Save" class="save-button" onclick="return manageGrade();">
                                                <input type="submit" name="btn_cancel" value="Back" class="back-button">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>

                <br><br>
                <div class="card">
                    <div class="div_row">
                        <h6 class="h4txt">View Grade</h6>
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
                                    <th>Grade Image</th>
                                    <th>Congrats Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $srno = 0;
                            foreach ($view_grade as $row) {
                                $srno = $srno + 1;
                                ?>
                                <input type="hidden" name="grade_id" value="<?php echo $row->grade_id; ?>">
                                <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row->from_percentage . "%"; ?></td>
                                    <td><?php echo $row->to_percentage . "%"; ?></td>
                                    <td><?php echo $row->grade; ?></td>
                                    <td><?php echo $row->description; ?></td>
                                    <td>
                                        <div>
                                            <img class="grade-img" src="<?php echo base_url(); ?>application/views/asset/image/badge/<?php echo $row->badge_image; ?>"
                                                 alt="user image" >
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="<?php echo base_url(); ?>application/views/asset/image/congrats_img/<?php echo $row->congrats_img; ?>"
                                                 alt="user image" style="height: 40px;width: 50px;">
                                        </div>
                                    </td>
                                    <td>
                                    <?php
                                        $g_id = $row->grade_id; 
                                        $enc_key = $this->encrypt->encode($g_id);
                                    ?>
                                        <a href="<?php echo base_url(); ?>admin_controller/Grade/edit_grade/<?php echo $enc_key; ?>">
                                            <i class="fa fa-edit edit-icon" ></i></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo base_url(); ?>admin_controller/Grade/delete_grade/<?php echo $enc_key; ?>" onclick="return confirm('Are you sure want to delete grade?');">
                                            <i class="fa fa-trash-o delete-icon" ></i></a>
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
