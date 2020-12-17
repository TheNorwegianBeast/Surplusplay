<!DOCTYPE html>
<html>
    <head>
        <?php require APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_game.css" rel="stylesheet"
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
                        <h5 id="viewGameId"><i class="fa fa-gamepad" style="font-size: 25px"></i> &nbsp;&nbsp; Game</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" ><a id="listGame" href="#">&nbsp;&nbsp;Game</a></li>
                        </ul>
                    </div>
                </div>

                <!--add game section starts-->
                <!-- <form method="post" action="<?php echo base_url() ?>admin_controller/Game/add_game"
                      onsubmit="return addGame();">
                    <div class="add-game-card">
                        <div class="row-inside">
                            <div class="add-alert-row">
                                <h6 class="h6-add-game">Add Game</h6>
                                <hr class="hr-line">
                            </div> -->

                            <!--alert boxes section starts-->
                            <?php 
                            // if ($this->session->flashdata('add_message') == 'true') { 
                            ?>
                                <!-- <div class="add-alert-row2">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Game !</span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div> -->
                            <?php //  } else if ($this->session->flashdata('add_message') == 'false') { 
                            ?>
                                <!-- <div class="add-alert-row4">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div> -->
                            <?php 
                            //}
                            ?>
                        <!-- </div> -->
                        <!--ends alert boxes section-->
                        <!-- <br />

                        <div class="add-form-element">
                            <table class="add-game-table">
                                <tr>
                                    <td>
                                        <div>
                                            <label id="lblGame">Game Name<span class="start-clr" style="color: red;">*</span></label>
                                            <input type="text" class="txt-title" id="txt_game_name"
                                                   placeholder="Enter Game Name" name="txt_game_name" pattern="[A-Za-z0-9]{1,15}" maxlength="35" autocomplete="off"
                                                   oncopy="return false" onpaste="return false" oncut="return false">
                                        </div>
                                        <br />
                                        <span class="span-game-error" id="game_name_err"><?php echo $this->session->flashdata('message'); ?></span>
                                    </td>
                                    <td>
                                        <div>
                                            <label class="lblSubName">Subscription Name
                                                <span class="start-clr">*</span></label>
                                            <select name="select_subsc" id="select_subsc" class="sel-subscription">
                                                <option value="">Select Subscription...</option>
                                                <?php
                                                foreach ($select_subscription as $row_subsc) {
                                                    ?>
                                                    <option value="<?php echo $row_subsc->sub_id; ?>">
                                                        <?php echo $row_subsc->category_name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <br />
                                        <span class="span-sub-error" id="game_subs_err"><?php echo $this->session->flashdata('sub_message'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="redirect-buttons">
                                            <input type="submit" id="btnsave" class="save-button" name="btn_save" value="Save">
                                            <input type="submit" id="btn-cancel" class="back-button" name="btn_cancel" value="Back">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form> -->
                <!--add game section ends-->
                <div class="main-cards">
                    <div class="card">
                     <div class="row-inside">
                        <div class="div_row" style="background-color: inherit">
                            <h6 class="h4txt">View Game</h6>
                            <hr width="5%" align="left">
                        </div>
                        <?php 
                        if ($this->session->flashdata('add_message') == 'true') { ?>
                                <div class="add-alert-row2" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Game !</span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                            </div>
                        <?php   } else if ($this->session->flashdata('add_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                            </div>
                        <?php }
                        ?>
                            </div>
                            <br />

                        <div class="main-tbl-div">
                            <table id="myTable" class="display dataTable" align="center">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Subscription Id</th>
                                        <th>Game</th>
                                        <th>Action</th>
                                        <th>Grade</th>
                                        <th>Knowledge Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serial_no = 0;
                                    foreach ($fetch_game as $row_game) {
                                        $serial_no = $serial_no + 1;
                                        ?>
                                        <tr>
                                    <input type="hidden" name="game_id" value="<?php echo $row_game->game_id ?>">
                                    <td><?php echo $serial_no ?></td>
                                    <td><?php echo $row_game->subs_id; ?></td>
                                    <td><?php echo $row_game->game_name; ?></td>
                                    <td>
                                        <?php
                                         $g_id = $row_game->game_id; 
                                                $enc_key = $this->encrypt->encode($g_id);
                                        ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin_controller/Game/edit_game/<?php echo $enc_key; ?>">
                                            <i class="fa fa-edit edit-icon" ></i></a>
                                    </td>
                                    <td><a href="<?php echo base_url(); ?>admin_controller/Grade/manage_grade/<?php echo $enc_key; ?>"
                                           class="button7">manage Grade</a></td>
                                    <td><a href="<?php echo base_url(); ?>admin_controller/Knowledge_grade/manage_knowledge_grade/<?php echo $enc_key; ?>"
                                           class="button7">manage Knowledge Grade</a></td>
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
            <!--This is the main section beneath header admin and dropdowns ends-->
        </div>
        <script type="text/javascript">
function spinner()
{
    var spin = document.getElementById('spin_div');
    spin.style.display = 'none';
}
        </script>
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
        
    </body>

</html>
