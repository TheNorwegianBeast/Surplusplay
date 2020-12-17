<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_level.css" rel="stylesheet"
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
                        <h5 id="viewGameId"><i class="fa fa-signal"></i> &nbsp;&nbsp;View Levels</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Level</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="main-cards">
                    <div class="card" style="height:auto;">
                        <div class="row-inside">
                            <div class="add-alert-row">
                                <h6 class="h6-add-game">&nbsp;View Level</h6>
                            </div>

                            <!--alert boxes section starts-->
                            <?php 
                            if ($this->session->flashdata('add_message') == 'true') { ?>
                                <div class="add-alert-row2" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Level </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div>
                            <?php   } else if ($this->session->flashdata('add_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                            <?php } else if ($this->session->flashdata('add_message') == 'delete') { ?>
                                <div class="add-alert-row5" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Level </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                            </div>
                            <?php   }
                            ?>
                        </div>
                        <br />

                        <div class="TblDiv">
                             <?php echo form_open('admin_controller/Level/get_level'); ?>
                                <div >
                                    <label id="loginLabel">Select Game<span
                                            style="color: red;">*</span></label>
                                    <select name="select_game" class="txt-level-step select-txt-box" id="select_level" required="" onchange="this.form.submit();">
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
                                        <th>Level</th>
                                        <th>from Date</th>
                                        <th>To Date</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serial_no = 0;
                                    if (!empty($level)) {


                                        foreach ($level as $row_level) {
                                            $serial_no = $serial_no + 1;
                                            ?>

                                            <tr>
                                                <td><?php echo $serial_no ?></td>
                                                <td><?php
                                                    echo $row_level->game_name;
                                                ?></td>
                                                <td><?php echo $row_level->title; ?></td>
                                                <td><?php echo $row_level->from_date; ?></td>
                                                <td><?php echo $row_level->to_date; ?></td>
                                                <td>
                                                    <?php
                                                    $g_id = $row_level->level_id; 
                                                    $enc_key = $this->encrypt->encode($g_id);
                                                    ?>
                                                    <a
                                                        href="<?php echo base_url(); ?>admin_controller/Level/get_level_by_id/<?php echo $enc_key; ?>"><i
                                                            class="fa fa-eye"
                                                            style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a
                                                        href="<?php echo base_url(); ?>admin_controller/Level/edit_level/<?php echo $enc_key; ?>"><i
                                                            class="fa fa-edit"
                                                            style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a onclick="return confirm('Are you sure want to delete level?');"
                                                       href="<?php echo base_url(); ?>admin_controller/Level/delete_level/<?php echo $enc_key; ?>"><i
                                                            class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>
                                                </td>
                                            </tr>

                                            <?php
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
