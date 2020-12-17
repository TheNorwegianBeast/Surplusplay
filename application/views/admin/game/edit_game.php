<!DOCTYPE html>
<html>

<head>
    <?php require APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_game.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>application/views/admin/game/js/game_page_validation.js" type="text/javascript"></script>
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
                    <h5 id="viewGameId"><i class="fa fa-gamepad" style="font-size:25px;"></i> &nbsp;&nbsp; Game</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href=".<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="<?php echo base_url(); ?>admin_controller/Game/manage_game">&nbsp;&nbsp;Game</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit Game</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--add game section starts-->
            <?php echo form_open('admin_controller/Game/update_game'); ?>
                <div class="add-game-card">
                    <div class="row-inside">
                        <div class="add-alert-row">
                            <h6 class="h6-add-game">Edit Game</h6>
                        </div>
                        <!--alert boxes section starts-->
                        <?php 
                        if ($this->session->flashdata('add_message') == 'update') { ?>
                         <div class="add-alert-row3" id="alert_box">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                            <strong><span class="strong-alert-msg">Game </span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                        </div>
                        <?php   } else if ($this->session->flashdata('add_message') == 'false') { ?>
                        <div class="add-alert-row4" id="alert_box">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                            <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something
                                    went wrong, Please try again!</span></strong>
                        </div>
                        <?php }
                        ?>
                    </div>
                    <br />
                    <?php
                    foreach ($edit_game as $value) {
                        ?>
                        <div class="add-form-element">
                            <table class="add-game-table">
                                <tr id="tbl-add-game">
                                    <td>
                                        <div>
                                            <label id="lblGame">Game Name<span style="color: red;">*</span></label>
                                            <input type="text" class="txt-title title-game" id="txt_game_name" placeholder="Enter Course Title" name="txt_game_name" value="<?php echo $value->game_name ?>" pattern="[A-Za-z0-9 ]{1,25}" maxlength="35" autocomplete="off" oncopy="return false" onpaste="return false"
                                                oncut="return false">
                                        </div>
                                        <br />
                                        <span class="span-game-error" id="edit_game_err"><?php echo $this->session->flashdata('game_name'); ?></span>
                                    </td>
                                    <td>
                                        <div>
                                            <label class="lblSubName">Subscription Name<span
                                                style="color: red;">*</span></label>
                                            <select name="select_subsc" id="select_subsc" class="sel-subscription">
                                            <option value="<?php echo $value->sub_id; ?>" selected='selected'>
                                                <?php echo $value->category_name ?></option>
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
                                        <span class="span-sub-error" id="game_subs_err"><?php echo $this->session->flashdata('sel_message'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <input type="submit" class="update-button" name="update_btn" value="Update" onclick="return editGame();">
                                            <input type="submit" id="btn-cancel" class="back-button" name="btn_cancel" value="Back">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                    }
                    ?>
                            </table>
                        </div>
                </div>
            <?php echo form_close();?>
            <!--add game section ends-->
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
