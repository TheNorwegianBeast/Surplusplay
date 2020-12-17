<!DOCTYPE html>
<html>

    <head>
        <?php require APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_mission.css" rel="stylesheet"
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
            <?php require APPPATH . 'views/admin/asset/common/common-sidenav.php'; ?>
            <!--This is the main section beneath header admin and dropdowns starts-->
            <main class="main">
                <div class="main-header">
                    <div class="main-header__heading" id="Vgameid">
                        <h5 id="viewGameId"><i class="fa fa-flag-checkered"></i> &nbsp;&nbsp;View Missions</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card" style="height:auto;">
                        <div class="row-inside">
                            <div class="add-alert-row">
                                <h6 class="h6-add-game">View Mission</h6>
                            </div>

                            <!--alert boxes section starts-->
                            <?php 
                            if ($this->session->flashdata('suc_message') == 'true') { ?>
                                <div class="add-alert-row2" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Mission </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div>
                            <?php   } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                            <?php } else if ($this->session->flashdata('suc_message') == 'delete') { ?>
                                <div class="add-alert-row5" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Mission </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                            </div>
                            <?php   }
                            ?>
                        </div>
                        <br />


                        <div style="width: 100%; background-color: transparent; ">
                        <?php echo form_open('admin_controller/Mission/get_mission'); ?>
                                <div>
                                    <label id="loginLabel">Select Game<span
                                            style="color: red;">*</span></label>
                                    <select name="select_game" id="select_game" class="sel-subscription" required="" onchange="this.form.submit();">
                                        <option value=""><?php echo $sel_game; ?> </option>
                                        <?php
                                        foreach ($game as $row):
                                            ?>
                                            <option value="<?php echo $row->game_id; ?>"><?php echo $row->game_name; ?> </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            <?php echo form_close();?>
                            <br><br>
                            <table id="myTable" class="display dataTable" align="center">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Game</th>
                                        <th>Mission</th>
                                        <th>Action</th>
                                        <th>Question</th>
                                        <th>Knowledge</th>
                                        <th>Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $srno = 0;
                                    ?>
                                    <?php
                                    foreach ($get_mission as $value) {
                                        $srno = $srno + 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $srno; ?></td>
                                            <td>
                                                <?php echo $value->game_name; ?>
                                            </td>

                                            <td><?php echo $value->mission_step; ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $g_id = $value->mission_id; 
                                                    $enc_key = $this->encrypt->encode($g_id);
                                                ?>
                                                <a
                                                    href="<?php echo base_url(); ?>admin_controller/Mission/get_mission_by_id/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-eye"
                                                        style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a
                                                    href="<?php echo base_url(); ?>admin_controller/Mission/edit_mission/<?php echo $enc_key; ?>"><i
                                                        class="fa fa-edit"
                                                        style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <!--                                                <a onclick="return confirm('Are you sure want to delete mission?');"
                                                   href="<?php// echo base_url() ?>admin_controller/Mission/delete_mission/<?php// echo $enc_key; ?> "><i
                                                        class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>-->
                                            </td>
                                            <td><a href="<?php echo base_url(); ?>admin_controller/Mission/manage_question/<?php echo $enc_key; ?>"
                                                   class="button7">Manage Question</a></td>
                                            <td><a href="<?php echo base_url(); ?>admin_controller/Mission/manage_knowledge/<?php echo $enc_key; ?>"
                                                   class="button7">Manage Knowledge</a></td>
                                            <td><a href="<?php echo base_url(); ?>admin_controller/Mission/view_budget/<?php echo $enc_key; ?>"
                                                   class="btn-add-budget">Add Budget</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </main>
            <!--</form>-->
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
