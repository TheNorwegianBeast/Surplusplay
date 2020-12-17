<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
              type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_user.css" rel="stylesheet"
              type="text/css" />
        <style>
        </style>
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
                        <h5 id="viewGameId"><i class="fa fa-user" style="font-size: 23px;"></i> &nbsp;&nbsp;View User</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/User/manage_user">&nbsp;&nbsp;User</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="row-inside">
                            <div class="add-alert-row">
                                <h6 class="h6-add-game">View User</h6>
                            </div>

                            <!--alert boxes section starts-->
                            <?php if ($this->session->flashdata('suc_message') == 'true') { ?>
                                <div class="add-alert-row2"  id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">User </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                <div class="add-alert-row4"  id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('suc_message') == 'delete') { ?>
                                <div class="add-alert-row5" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">User </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                                </div>
                            <?php }
                            ?>

                        </div>
                        <br />
                        <div style="width: 100%; background-color: transparent; ">
                            <?php echo form_open('admin_controller/User/manage_user'); ?>
                            <!-- <form method="post" action="<?php echo base_url(); ?>admin_controller/User/manage_user"> -->
                            <div>
                                <label id="loginLabel">Select Game<span
                                        style="color: red;">*</span></label>
                                <select name="select_game" id="select_game" class="sel-subscription" required="" onchange="this.form.submit();">
                                    <option value="<?php echo $sel_game; ?>"><?php echo $sel_game; ?> </option>
                                    <?php
                                    foreach ($game as $row):
                                        ?>
                                        <option value="<?php echo $row->game_id; ?>"><?php echo $row->game_name; ?> </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <?php echo form_close(); ?>
                            <!-- </form> -->
                            <br><br>

                            <table id="myTable" class="display dataTable ui celled table" align="center">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Login Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                        <th>Knowledge Report</th>
                                        <th>Mission Report</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serial_no = 1;
                                    foreach ($user as $row_user):
                                        ?>
                                        <tr>
                                            <td><?php echo $serial_no; ?></td>
                                            <td><?php echo $row_user->first_name . " " . $row_user->last_name; ?></td>
                                            <td><?php echo $row_user->userident; ?></td>
                                            <td><?php echo $row_user->email; ?> </td>
                                            <td>
                                                <?php
                                                $game_id = 1;
                                                $role_id = $row_user->role_id;
                                                $role_array = explode(',', $role_id);
                                                $cnt_role = count($role_array);
                                                $role_data = '';

                                                if ($cnt_role >= 2) {
                                                    $p_user_role_id1 = (int) $role_array['0'];
                                                    $p_user_role_id2 = (int) $role_array['1'];
                                                    $CI = & get_instance();
                                                    $CI->load->model('User_model');
                                                    $result = $CI->User_model->fetch_multiple_user_role($game_id, $p_user_role_id1, $p_user_role_id2);
                                                    foreach ($result as $row) {

                                                        $role_data = $role_data . $row->role_name . ', ';
                                                    }
                                                    echo substr($role_data, 0, -2);
                                                } else {
                                                    $p_user_role_id1 = $role_array[0];
                                                    $CI = & get_instance();
                                                    $CI->load->model('User_model');
                                                    $result = $CI->User_model->fetch_user_role($game_id, $p_user_role_id1);
                                                    foreach ($result as $row) {
                                                        echo $row->role_name;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $g_id = $row_user->id;
                                                $enc_key = $this->encrypt->encode($g_id);
                                                $u_key = $row_user->userident;
                                                $enc_uid_key = $this->encrypt->encode($u_key);
                                                ?>
                                                <a
                                                    href="<?php echo base_url(); ?>admin_controller/User/view_one_user/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-eye"
                                                        style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a
                                                    href="<?php echo base_url(); ?>admin_controller/User/edit_user/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-edit"
                                                        style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a onclick="return confirm('Do you want to delete this user? All sales and test drive data will also get delete from the records.');"
                                                   href="<?php echo base_url(); ?>admin_controller/User/delete_user/<?php echo $enc_uid_key; ?>"><i
                                                        class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>
                                            </td>
                                            <td>
                                                <!-- <a href="<?php echo base_url(); ?>admin_controller/User/view_user_budget/<?php echo $enc_uid_key; ?>"
                                                   class="button6">Report</a> -->

                                                <a href="<?php echo base_url(); ?>admin_controller/User/view_user_budget/<?php echo $enc_uid_key; ?>">
                                                    <button class="btn-report"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;&nbsp;Knowledge </button></a>

                                            </td>
                                            <td>
                                            <!-- <a href="<?php echo base_url(); ?>admin_controller/User/view_user_budget/<?php echo $enc_uid_key; ?>"
                                               class="button6">Report</a> -->

                                                <a href="<?php echo base_url(); ?>admin_controller/User/view_mission_budget/<?php echo $enc_uid_key; ?>">
                                                    <button class="btn-report"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp;&nbsp;Mission</button></a>

                                            </td>
                                        </tr>
                                        <?php
                                        $serial_no++;
                                    endforeach;
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
