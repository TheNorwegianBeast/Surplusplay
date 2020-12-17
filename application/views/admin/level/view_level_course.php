<!DOCTYPE html>
<html>

<head>
    <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_level_course.css" rel="stylesheet"
        type="text/css" />
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
                    <h5 id="viewGameId"><i class="fa fa-signal"></i> &nbsp;&nbsp;View Level</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="<?php echo base_url(); ?>admin_controller/Level/get_level">&nbsp;&nbsp;Level</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View
                                Level</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-cards">
                <div class="card">
                    <div class="CardIn" style="">
                        <div class="div_row">
                            <h6 class="h4txt">View Level</h6>
                        </div><br />

                        <div id="form-elements">
                            <table id="mytabledata">
                                <?php
                                    $game_id = 1;
                                if (!empty($level)) {
                                    foreach ($level as $row_value) {
                                        ?>
                                <tr>
                                    <td >
                                        <div>
                                            <label id="loginLabel" style="">Level Title</label>
                                            <input type="text" class="txtloginname"
                                                value="<?php echo $row_value->title; ?>" disabled=""
                                                name="txtloginname">
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <label id="lblFname">From Date</label>
                                            <input type="text" class="f-name" value="<?php echo $row_value->from_date; ?>"
                                                disabled="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                        <div>
                                            <label id="lblLname">To Date</label>
                                            <input type="text" class="l-name" value="<?php echo $row_value->to_date; ?> "
                                                disabled="">
                                        </div>
                                    </td>
                                    <td>
                                        <div id="divemail" style="">
                                            <label id="lblEmail">Grade</label>
                                            <input type="text" class="txt-grade" disabled=""
                                                value="<?php echo $row_value->grades; ?>" name="emailaddress">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    
                                    <td>
                                        <div id="divpassword">
                                            <label id="lblPass">Result</label>
                                            <input class="txt-result" value="<?php echo $row_value->result; ?>" disabled=""
                                                name="Lname">
                                        </div>
                                    </td>
                                    <td>
                                        <div id="divemail">
                                            <label id="lblEmail">Attendance</label>
                                            <input type="text" class="txt-attendance" disabled=""
                                                value="<?php echo $row_value->attendance; ?>" name="emailaddress">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    
                                    <td>
                                        <div id="divpassword">
                                            <label id="lblPass">Certificate</label>
                                            <input class="txt-certi" value="<?php echo $row_value->certifcate; ?>"
                                                disabled="" name="Lname">
                                        </div>
                                    </td>
                                    <td>
                                        <div id="divemail" >
                                            <label id="lblEmail">Diploma</label>
                                            <input class="txt-diploma" disabled=""
                                                value="<?php echo $row_value->diploma; ?>" name="emailaddress">
                                        </div>
                                    </td>
                                </tr>
                                
                                        <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td>
                                        <div class="btn-div">
                                            <a href="<?php echo base_url() ?>admin_controller/Level/get_level"><input
                                                    type="submit" class="back-button" name="btn_cancel" value="Back"></a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
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
