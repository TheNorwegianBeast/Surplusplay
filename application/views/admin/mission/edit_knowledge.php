<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/edit_knowledge.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/mission/js/mission_validation.js" type="text/javascript"></script>
    </script>
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

        <main class="main">
            <div class="main-header">
                <div class="main-header__heading" id="Vgameid">
                    <h5 id="viewGameId"><i class="fa fa-edit"></i> &nbsp;&nbsp;Edit Knowledge</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                        href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                        href="<?php echo base_url(); ?>admin_controller/Mission/manage_knowledge">&nbsp;&nbsp;Knowledge</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit
                                Knowledge</a></li>
                    </ul>
                </div>
            </div>

            <?php echo form_open_multipart('admin_controller/Mission/update_knowledge_media'); ?>
            <input type="hidden" value="pdf" name="pdf">
            <div class="main-cards">
                <div class="card">
                    <div class="CardIn">
                        <div class="row-inside">
                            <div class="add-alert-row">
                                <h6 class="h6-add-game">Edit Knowledge</h6>
                            </div>
                            <!--alert boxes section starts-->
                            <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                                <div class="add-alert-row3" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                    <strong><span class="strong-alert-msg">Knowledge Media </span><span class="msg-alert"> &nbsp;is updated successfully.</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                                    <strong><span class="strong-alert-msg"></span><span class="msg-alert"> &nbsp;Something
                                            went wrong, Please try again.</span></strong>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <br />

                        <div id="form-elements">
                            <table id="mytabledata">
                                <?php
                                foreach ($knowledge as $row) {
                                    ?>
                                    <tr>
                                    <input type="hidden" name="txt_know_id"
                                           value="<?php echo $row->knowledge_id; ?>">
                                    <td id="tbl-contents" class="disp-tbl">
                                        <?php
                                        $type = $row->knowledge_type;
                                        if ($type == "pdf") {
                                            ?>

                                            <div id="tbl-data">
                                                <label id="loginLabel" style="">Upload PDF<span
                                                        style="color: red;">*</span></label>
                                                <input type="file" class="file-update-vid" placeholder="No file chosen"
                                                       id="media_file" name="media_file" accept="application/pdf">
                                            </div>
                                        <?php } else if ($type == "video") {
                                            ?>
                                            <video width="400" controls="controls" preload="metadata">
                                                <source
                                                    src="<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>"
                                                    type="video/mp4">
                                            </video>

                                            <div id="tbl-data">
                                                <label id="loginLabel" style="">Upload Video<span
                                                        style="color: red;">*</span></label>
                                                <input type="file" class="file-update-vid" placeholder="No file chosen"
                                                       id="media_file" name="media_file"
                                                       accept="video/mp4,video/x-m4v,video/*">
                                            </div>
                                        
                                        <?php }
                                        ?>
                                        <span class="span-game-error" id="video_edit_err"><?php echo $this->session->flashdata('message'); ?></span>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            
                                            <input type="submit" class="update-button" name="btn_update" value="Update" onclick="return editKnowledge();">
                                            <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </main>
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
