<!DOCTYPE html>
<html>

<head>
    <?php require_once(APPPATH . 'views/admin/asset/common/common-cdns.php'); ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_knowledge.css" rel="stylesheet"
        type="text/css" />
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
        <?php require_once (APPPATH . 'views/admin/asset/common/common_header.php'); ?>
        <!--header ends-->
        <?php require_once APPPATH . 'views/admin/asset/common/dialoge.php'; ?>
        <?php require_once (APPPATH . 'views/admin/asset/common/common-sidenav.php'); ?>

        <!--This is the main section beneath header admin and dropdowns starts-->
        <main class="main">
            <div class="main-header">
                <div class="main-header__heading" id="Vgameid">
                    <h5 id="viewGameId"><i class="fas fa-book-open"></i> &nbsp;&nbsp;View Knowledge</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                href="<?php echo base_url(); ?>admin_controller/Mission/manage_knowledge">&nbsp;&nbsp;Knowledge</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View
                                Knowledge</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-cards">
                <div class="card">
                    <div class="CardIn">
                        <div class="div_row">
                            <h6 class="h4txt">View Knowledge</h6>
                        </div><br />
                        <?php
                        foreach ($knowledge as $row) {
                            ?>
                        <div id="form-elements">
                            <table id="mytabledata">
                                <tr>
                                    <td id="tbl-contents">
                                        <div id="tbl-data">
                                            <label id="loginLabel" style="">Knowledge Title</label>
                                            <input type="text" id="txtloginname"
                                                value="<?php echo $row->know_file_name; ?>" name="txtloginname"
                                                disabled="">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="CardIn2">
                            <?php if ($row->knowledge_type == 'pdf') { ?>

                            <div>
                                <object
                                    data="<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>"
                                    style="width: 100%;height:550px;display: block;"></object>

                                <!--                                        <object data="<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>" type="application/pdf" width="300" height="200">
                                            alt : <a href="<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>">test.pdf</a>
                                        </object>-->
                            </div>
                            <!--<div class='embed-container'><iframe src='<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>' style='border:0'></iframe></div>-->
                            <!--<iframe src="https://docs.google.com/gview?url=<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>-->
                            <!--<iframe src="<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>" style="width: 100%;height: 100%;border: none;"></iframe>-->
                            <!--<embed src="<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>" width="800px" height="2100px" />-->
                            <?php
                                } else if ($row->knowledge_type == 'video') {
                                    ?>
                            <video id="addiction_video" width="100%" height="100%" controls>
                                <source
                                    src="<?php echo base_url(); ?>application/views/asset/knowledge_media/<?php echo $row->know_file_name; ?>"
                                    type="video/mp4">
                            </video>
                            <?php
                                }
                                ?>
                        </div>

                        <table id="mytabledata">
                            <tr>
                                <td>
                                    <div>
                                        <a href="<?php echo base_url(); ?>admin_controller/Mission/manage_knowledge"><input
                                                type="submit" class="back-button" name="btn_cancel" value="Back"></a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <!--This is the main section beneath header admin and dropdowns ends-->
    </div>
    <script>
function spinner()
{
    var spin = document.getElementById('spin_div');
    spin.style.display = 'none';
}
        </script>
</body>

</html>
