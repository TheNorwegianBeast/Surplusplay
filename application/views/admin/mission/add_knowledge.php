<!DOCTYPE html>
<html>
<head>
    <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/common.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_knowledge.css" rel="stylesheet" type="text/css" />
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
                    <h5 id="viewGameId"><i class='fas fa-book-medical'></i>&nbsp;&nbsp;Knowledge</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Knowledge</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main-cards1">
                <div class="card1">
                  <div class="row-inside">
                                <div class="add-alert-row">
                                    <h6 class="h6-add-game">Add Knowledge</h6>
                                </div>

                                <!--alert boxes section starts-->
                                 <?php 
                                    if ($this->session->flashdata('suc_message') == 'true') { ?>
                                <div class="add-alert-row2" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Knowledge Media </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div>
                                    <?php   } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                                    <?php } else if ($this->session->flashdata('suc_message') == 'delete') { ?>
                                <div class="add-alert-row5" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Knowledge Media </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                            </div>
                                    <?php   }
                                    ?>

                            </div>

                    <div class="TblWrapper">
                        <?php // echo form_open_multipart('admin_controller/Mission/add_knowledge_pdf'); ?>
                            <!-- <table id="mytabledata" style="border:2px solid transparent; border-collapse: collapse;  border-collapse: separate;border-spacing: 10 15px; ">
                                <tr class="tbl-rowlabel1">
                                    <td>
                                        <div>
                                            <label id="loginLabel" style="font-size: 13px;font-weight: normal;">Upload
                                                PDF</label>
                                        </div>
                                        
                                    </td>
                                    <td id="td1">
                                        <div class="">
                                            <input type="file" accept="application/pdf" class="file-type-pdf" id="fType" name="fileknow">
                                        </div>
                                        <span class="span-game-error" id="file_image_err"><?php echo $this->session->flashdata('message'); ?></span>
                                    </td>
                                    <td id="td2">
                                        <div>
                                            <input type="submit" name="btn_upload" class="save-button" value="Upload">
                                        </div>
                                    </td>
                                </tr>
                            </table> -->
                        <?php //echo form_close();?>

                        <?php echo form_open_multipart('admin_controller/Mission/add_knowledge_video'); ?>
                            <table id="mytabledata" style="border:2px solid transparent; border-collapse: collapse;  border-collapse: separate;border-spacing: 10 15px; ">
                                <tr class="tbl-data-video">
                                    <td>
                                        <div>
                                            <label id="loginLabel" style="font-size: 13px;font-weight: normal;">Upload
                                                Video</label>
                                        </div>
                                    </td>
                                    <td class="td1">
                                        <div  class="fileTypeData">
                                            <input type="file" accept="video/mp4,video/x-m4v,video/*" class="file-typ-vid" id="video_select" name="fileknow">
                                        </div>
                                        <span class="span-game-error transvert" id="video_select_err"><?php echo $this->session->flashdata('vid_message'); ?></span>
                                    </td>
                                    <td class="td2">
                                        <div>
                                            <input type="submit" name="btn_upload" class="save-button" value="Upload" onclick="return addKnowledge();">
                                            <input type="submit" name="btn_cancel" class="back-button" value="Back">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        <?php echo form_close();?>
                    </div>
                    
                </div>
            </div>

            <div class="main-cards">
                <div class="card" style="height:auto;">
                    <div class="view_row">
                        <h6 class="h4txt">View knowledge</h6>
                    </div>
                    <br />

                    <!-- Data-table -->
                    <div style="width: 100%; background-color: transparent; ">
                        <table id="myTable" class="display dataTable" align="center">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Type</th>
                                    <th>Knowledge File Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $cnt = 1;
                                foreach ($knowledge as $row) {
                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo $cnt; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->knowledge_type; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->know_file_name; ?>
                                        </td>
                                        <td>
                                        <?php
                                                    $g_id = $row->knowledge_id; 
                                                    $enc_key = $this->encrypt->encode($g_id);
                                        ?>
                                            <a href="<?php echo base_url(); ?>admin_controller/Mission/view_knowledge/<?php echo $enc_key; ?>"><i
                                        class="fa fa-eye" style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a href="<?php echo base_url(); ?>admin_controller/Mission/edit_knowledge/<?php echo $enc_key; ?>"><i
                                        class="fa fa-edit"
                                        style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a onclick="return confirm('Are you sure want to delete knowledge media?');" href="<?php echo base_url(); ?>admin_controller/Mission/delete_knowledge/<?php echo $enc_key; ?>"><i
                                        class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--=======================================================Table End=================================================================-->
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
        $(document).ready(function() {
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
