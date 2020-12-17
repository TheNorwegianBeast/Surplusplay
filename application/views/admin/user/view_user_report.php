<!DOCTYPE html>
<html>

<head>
    <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_user_report.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
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
                    <h5 id="viewGameId"><i class="fas fa-user-check"></i> &nbsp;&nbsp;Knowledge Report</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                href="<?php echo base_url(); ?>admin_controller/User/manage_user">&nbsp;&nbsp;User</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Knowledge Report</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-cards">
                <div class="card">
                    <div class="div_row">
                        <h6 class="h4txt">Knowledge Report</h6>
                    </div><br />
                    <div style="width: 100%; background-color: transparent; ">
                        <table id="myTable" class="display dataTable" align="center">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Mission</th>
                                    <th>Mission City</th>
                                    <th>Total Score</th>
                                    <th>Percentage %</th>
                                    <th>Grade</th>
                                    <th>Badge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $cnt = 1;
                                foreach ($user_report as $row) {
                                    ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row->mission_step; ?></td>
                                     <td><?php echo $row->city_name; ?></td>
                                    <td> <?php echo $row->total_score_points; ?> </td>
                                    <td> <?php echo $row->percentage; ?> % </td>
                                    <td> <?php echo $row->description; ?> </td>
                                    <td> <?php
                                    if (!($row->badge_image)) {
                                        ?>
                                        <img class="img-car"
                                            src="<?php echo base_url(); ?>application/views/asset/image/badge/F.png"
                                            alt="user image">
                                        <?php
                                    } else {
                                        ?>
                                        <img class="img-car"
                                            src="<?php echo base_url(); ?>application/views/asset/image/badge/<?php echo $row->badge_image; ?>"
                                            alt="user image">
                                            <?php
                                    }
                                    ?>
                                    </td>
                                </tr>
                                    <?php
                                    $cnt++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <!--This is the main section beneath header admin and dropdowns ends-->
    </div>
    <script type="text/javascript">
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
