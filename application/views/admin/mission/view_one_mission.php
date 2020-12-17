<!DOCTYPE html>
<html>

<head>
    <?php include (APPPATH . 'views/admin/asset/common/common-cdns.php'); ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_one_mission.css" rel="stylesheet"
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
        <?php require_once (APPPATH . 'views/admin/asset/common/common_header.php'); ?>
        <!--header ends-->
        <?php require_once APPPATH . 'views/admin/asset/common/dialoge.php'; ?>
        <?php include (APPPATH . 'views/admin/asset/common/common-sidenav.php'); ?>
        <!--This is the main section beneath header admin and dropdowns starts-->
        <main class="main">
            <div class="main-header">
                <div class="main-header__heading" id="Vgameid">
                    <h5 id="viewGameId"><i class="fa fa-flag"></i> &nbsp;&nbsp;View Mission</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View
                                Mission</a></li>
                    </ul>
                </div>
            </div>

            <div class="main-cards">
                <div class="card">
                    <div class="CardIn" style="">
                        <div class="div_row">
                            <h6 class="h4txt">View Mission</h6>
                        </div><br />

                        <div id="form-elements">
                            <?php
                                foreach ($get_single_mission as $value) {
                                    ?>
                            <table id="mytabledata">
                                <tr>
                                    <td width="50%">
                                        <div>
                                            <label id="lbl-bg-img" style="">City Image</label>
                                            <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/<?php echo $value->city_image; ?>"
                                                alt="" class="txtloginname" />
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label id="lbl-bg-img" style="">City Name</label>
                                            <input type="text" class="f-name" value="<?php echo $value->city_name; ?>"
                                                disabled="">
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <label id="lbl-level-step">Mission Step</label>
                                            <input type="text" class="f-name" value="<?php echo $value->mission_step; ?>"
                                                disabled="">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label id="lbl-total-que">Total Question</label>
                                            <input type="text" class="l-name" value="<?php echo $value->total_question; ?>"
                                                disabled="">
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <label id="lbl-corr-ans">Each Correct Answer Point</label>
                                            <input type="text" class="inp-corr-ans" disabled=""
                                                value="<?php echo $value->per_correct_question_point; ?>"
                                                name="emailaddress">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label id="lbl-time-limit">Time Limit</label>
                                            <input class="inpPass" value="<?php echo $value->time_limit; ?>" disabled=""
                                                name="Lname">
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <label id="lbl-from-date">From Date</label>
                                            <input type="text" class="inp-from-date" disabled=""
                                                value="<?php echo $value->from_date; ?>" name="emailaddress">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label id="lbl-to-date">To Date</label>
                                            <input class="input-to-date" value="<?php echo $value->to_date; ?>" disabled=""
                                                name="Lname">
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <label id="lbl-result">Result</label>
                                            <input class="inp-result" disabled="" value="<?php echo $value->result; ?>"
                                                name="emailaddress">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                    ?>
                                <tr>
                                    <td>
                                        <div class="btn-div">
                                            <a href="<?php echo base_url(); ?>admin_controller/Mission/get_mission"><input
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
    <script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
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
