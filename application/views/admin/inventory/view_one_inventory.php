<!DOCTYPE html>
<html>

    <head>
        <?php require_once(APPPATH . 'views/admin/asset/common/common-cdns.php'); ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/price_list.css" rel="stylesheet"
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
                        <h5 id="viewGameId"><i class="fas fa-shopping-cart"></i> &nbsp;&nbsp;View Inventory</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/User/manage_user">&nbsp;&nbsp;Inventory</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View Inventory</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <div class="div_row">
                                <h6 class="h4txt">View Inventory</h6>
                            </div><br />

                            <div class="form-elements">
                                <table class="mytabledata">
                                    <?php
                                    foreach ($get_inventory_by_id as $value) {
                                        ?>
                                        <input type="hidden" value="<?php echo $value->is_new; ?>" id="is_new"
                                               name="is_new">
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="loginLabel" style="transform: translateY(4px);">Product number</label>
                                                    <input type="text" value="<?php echo $value->product_no; ?>"
                                                           class="txt-login-name" placeholder="Enter product number" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="UseridentLabel" style="transform: translateY(3px);">Brand Name</label>
                                                    <input type="text" class="txtuserident txt-userident" placeholder="Enter brand"
                                                           value="<?php echo $value->brand_name; ?>" disabled="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="lblFname" style="transform: translateY(5px);">Type</label>
                                                    <input type="text" class="F-name txt-first-name" placeholder="Enter type"
                                                           value="<?php echo $value->type; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="lblLname" style="transform: translateY(5px);">Car Model</label>
                                                    <input type="text" class="L-name txt-last-name" placeholder="Enter car model"
                                                           value="<?php echo $value->car_model; ?>" disabled="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="divemail">
                                                    <label class="lblEmail" style="transform: translateY(6px);">Cost</label>
                                                    <input type="number" class="user-email" placeholder="Enter Cost"
                                                           value="<?php echo $value->cost; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="LblRoleId" style="transform: translateY(3px);">Quantity</label>
                                                    <input class="input-LblRoleId" type="text" placeholder="Enter Quantity"
                                                           value="<?php echo $value->quanity; ?>" disabled="">
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="divemail">

                                                    <label class="lblEmail" style="transform: translateY(5px);">Year</label>
                                                    <?php
                                                    if ($value->year == 0) {
                                                        $value->year = '';
                                                        ?>
                                                        <input type="number" class="user-email" 
                                                               value="<?php echo $value->year; ?>" disabled="">
                                                               <?php
                                                           } else {
                                                               ?>
                                                        <input type="number" class="user-email" 
                                                               value="<?php echo $value->year; ?>" disabled="">
                                                               <?php
                                                           }
                                                           ?>

                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="LblRoleId" style="transform: translateY(-3px);">Is new</label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radio_is_new" id="result_radio_on"
                                                               value="1"> <label for="result_radio_on" class="size" style="cursor:pointer;">Yes</label>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radio_is_new" id="result_radio_off"
                                                               value="0"><label for="result_radio_off" class="size" style="cursor: pointer;">No</label> </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url(); ?>admin_controller/Inventory/manage_inventory"><input type="submit" class="back-button" name="btn_cancel" value="Back"></a>
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
            var is_new = document.getElementById('is_new').value;

            if (is_new === '1') {
                document.getElementById('result_radio_on').checked = 'true';
            } else {
                document.getElementById('result_radio_off').checked = 'true';
            }
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
