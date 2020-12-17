<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
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
                        <h5 id="viewGameId"><i class="fas fa-money-check-alt"></i> &nbsp;&nbsp;View Pricelist</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Pricelist/inventory_price_list">&nbsp;&nbsp;Pricelist</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View Pricelist</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn" style="">
                            <div class="div_row">
                                <h6 class="h4txt">View Pricelist</h6>
                            </div><br />

                            <div class="form-elements">
                                <table class="mytabledata">
                                    <?php
                                    foreach ($get_pricelist_by_id as $value) {
                                        ?>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="loginLabel" style="transform: translateY(2px);">Product number</label>
                                                    <input type="text" value="<?php echo $value->product_no; ?>"
                                                           class="txt-login-name" placeholder="Enter product number" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="UseridentLabel" style="transform: translateY(3px);">Brand</label>
                                                    <input type="text" id="txtuserident" class="txt-userident" placeholder="Enter brand"
                                                           value="<?php echo $value->brand; ?>" disabled="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="lblFname" style="transform: translateY(4px);">Type</label>
                                                    <input type="text" class="F-name txt-first-name" placeholder="Enter type"
                                                           value="<?php echo $value->type; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="lblLname" style="transform: translateY(4px);">Car Model</label>
                                                    <input type="text" id="L-name" class="txt-last-name" placeholder="Enter car model"
                                                           value="<?php echo $value->car_model; ?>" disabled="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="divemail">
                                                    <label id="lblEmail" style="transform: translateY(4px);">Price</label>
                                                    <input type="number" id="inpEmail" class="user-email" placeholder="Enter Price"
                                                           value="<?php echo $value->price; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="LblRoleId" style="transform: translateY(4px);">Year</label>
                                                    <?php
                                                    if ($value->year == 0) {
                                                        $value->year = '';
                                                        ?>
                                                        <input class="input-LblRoleId" type="number" 
                                                               value="<?php echo $value->year; ?>" disabled="">
                                                               <?php
                                                           } else {
                                                               ?>
                                                        <input class="input-LblRoleId" type="number" 
                                                               value="<?php echo $value->year; ?>" disabled="">

                                                        <?php
                                                    }
                                                    ?>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin_controller/Pricelist/inventory_price_list"><input type="submit" class="back-button" name="btn_cancel" value="Back"></a>
                                            </td>
                                        </tr>
                                    </table>
    <?php
}
?>
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
