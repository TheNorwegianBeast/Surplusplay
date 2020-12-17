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
                        <h5 id="viewGameId"><i class="fas fa-user"></i> &nbsp;&nbsp;Mission Report</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/User/manage_user">&nbsp;&nbsp;User</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Mission Report</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <?php
                $CI = & get_instance();
                $CI->load->model('Mission_model');
                $CI2 = & get_instance();
                $CI2->load->model('User_model');
                ?>
                <div class="main-cards">

                    <div class="card">
                        <div class="div_row">
                            <h6 class="h4txt">Mission Report</h6>
                        </div><br />
                        <div style="width: 100%; background-color: transparent; ">
                            <table id="myTable" class="display dataTable" align="center">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Mission</th>
                                        <th>Mission City</th>
                                        <th>Budget</th>
                                        <th>Budget Status</th>
                                        <th>Test Drive Rank</th>
                                        <th>Sales Rank</th>
                                        <th>Mission Rank</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serial_no = 1;
                                    for ($i = 1; $i <= 12; $i++) {
                                        $enc_key = $this->encrypt->encode($i);
                                        $result = $CI->Mission_model->get_mission_by_id($game_id, $i);
                                        foreach ($result as $row2) {
                                            $result2 = $CI->Mission_model->get_user_budget($game_id, $row2->mission_id, $userident);
                                            foreach ($result2 as $row3) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $serial_no; ?></td>
                                                    <td><?php echo 'Mission ' . $i; ?></td>
                                                    <td><?php echo $row2->city_name; ?></td>
                                                    <td><?php
                                                        if ($row3->BCount == 1) {
                                                            echo 'Assigned';
                                                        } else {
                                                            echo 'Not Assigned';
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        $result3 = $CI->Mission_model->get_mission_dur($game_id, $row2->mission_id, $userident);
                                                        foreach ($result3 as $row4) {
                                                            if ($row4->budget_status == 'assigned') {
                                                                echo '';
                                                            } else {
                                                                echo $row4->budget_status;
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $result4 = $CI2->User_model->get_rank_testdrive($game_id, $userident);
                                                        foreach ($result4 as $row5) {
                                                            $ms = 'mission' . $i;
                                                            if ($row5->$ms == 0) {
                                                                echo '';
                                                            } else {
                                                                echo $row5->$ms;
                                                            }
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        $result5 = $CI2->User_model->get_rank_sale($game_id, $userident);
                                                        foreach ($result5 as $row6) {
                                                            $ms = 'mission' . $i;
                                                            if ($row6->$ms == 0) {
                                                                echo '';
                                                            } else {
                                                                echo $row5->$ms;
                                                            }
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        $result6 = $CI2->User_model->get_rank_scoreboard($game_id, $userident);
                                                        foreach ($result6 as $row7) {
                                                            $ms = 'mission' . $i;
                                                            if ($row7->$ms == 0) {
                                                                echo '';
                                                            } else {
                                                                echo $row5->$ms;
                                                            }
                                                        }
                                                        ?></td>

                                                    <td><a href="<?php echo base_url(); ?>admin_controller/Mission/view_budget/<?php echo $enc_key; ?>">
                                                            <button class="btn-budget"><i  style="color: #c99c47;"></i>Set Budget &nbsp;</button></a></td>

                                                </tr>
                                                <?php
                                                $serial_no++;
                                            }
                                        }
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
            $(document).ready(function () {
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
