<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/price_list.css" rel="stylesheet"
              type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/inventory/JS_validation.js" type="text/javascript"></script>
    </head>
    <script type="text/javascript">
        function createdRequestObject() {
            var tmpXmlHttpObject;
            if (window.XMLHttpRequest)
            {
                tmpXmlHttpObject = new XMLHttpRequest();
            } else if (window.ActiveXObject)
            {
                tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
            }
            return tmpXmlHttpObject;
        }
        var http1 = createdRequestObject();
        var http2 = createdRequestObject();

        /* Ajax call for select brand..*/
        function getGameId() {
            var gameId = document.getElementById("select_game").value;
            http1.open('get', '<?php echo base_url(); ?>admin_controller/Pricelist/select_brand?game_id=' + gameId);
            http1.onreadystatechange = processGameId;
            http1.send(null);
            http2.open('get', '<?php echo base_url(); ?>admin_controller/Pricelist/select_car_model?game_id=' + gameId);
            http2.onreadystatechange = processCarModel;
            http2.send(null);
        }

        function processGameId() {
            if (http1.readyState == 4) {
                var response = http1.responseText;
                document.getElementById('show_other_brand').innerHTML = response;

            }
        }

        function processCarModel() {
            if (http2.readyState == 4) {
                var response = http2.responseText;
                document.getElementById('show_other_model').innerHTML = response;

            }
        }
    </script>
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
                        <h5 id="viewGameId"><i class="fas fa-money-check-alt"></i> &nbsp;&nbsp;Pricelist</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Pricelist</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <?php if ($this->session->flashdata('add_message') == 'true') { ?>
                                <div class="add-alert-row2" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Pricelist</span><span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('add_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Oops</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('add_message') == 'delete') { ?>
                                <div class="add-alert-row5" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Pricelist</span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                                </div>
                            <?php }
                            ?>

                            <div class="div_row">
                                <h6 class="h4txt">Add Pricelist</h6>
                            </div><br />

                            <div class="form-elements">
                                <?php echo form_open('admin_controller/Pricelist/insert_pricelist'); ?>
                                <table class="mytabledata">
                                    <tr>
                                        <td colspan="2">
                                            <div>
                                                <label class="loginLabel1">Select Game <span
                                                        style="color: red;">*</span></label>
                                                <select name="select_game" type="text" class="txt-level-name sel-bx1" id="select_game"
                                                        placeholder="Enter Level Name" name="txt_level" autocomplete="off"
                                                        oncopy="return false" onpaste="return false" oncut="return false" onchange="getGameId();">
                                                    <option value="">Select Game...</option>
                                                    <?php
                                                    foreach ($select_game as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->game_id; ?>">
                                                            <?php echo $value->game_name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <span class="span-game-error-sel1" id="selctinp_err"><?php echo $this->session->flashdata('select_game'); ?></span>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdp_no">
                                            <div>
                                                <label class="loginLabel" style="transform: translateY(4px);">Product number<span
                                                        style="color: red;">*</span></label>
                                                        <input type="text" value="" name="product_no" id="inp_products" autocomplete="off" oncopy="return false" onpaste="return false"
                                                               oncut="return false" class="txt-login-name" placeholder="Enter product number" maxlength="40">
                                            </div>
                                            <span class="span-game-error" id="inp_products_err"><?php echo $this->session->flashdata('product_no'); ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="UseridentLabel" style="transform: translateY(4px);">Brand<span
                                                        style="color: red;">*</span></label>
                                                <select class="txt-userident" id="show_other_brand" name="select_brand" onchange="showOtherInput();">
                                                    <option value="">Select Brand...</option>
                                                </select>
                                            </div>
                                            <span class="span-game-error1" id="show_other_brand_err"><?php echo $this->session->flashdata('select_brand'); ?></span>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div id="other_brand_type" style="display: none;">
                                                <label class="loginLabel" style="transform: translateY(5px);">Other Brand Name</label>
                                                <input type="text" name="new_brand" autocomplete="off" id="otherbrandhidden" oncopy="return false" onpaste="return false"
                                                       oncut="return false" class="txt-login-name2" placeholder="Enter Brand Name" maxlength="40" required="">
                                            </div>
                                            <span class="span-game-error1" id="otherbr_err"><?php echo $this->session->flashdata('new_brand'); ?></span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <label class="lblFname" style="transform: translateY(6px);">Type<span
                                                        style="color: red;">*</span></label>
                                                        <input type="text" name="type"class="txt-first-name F-name" id="brndtype" placeholder="Enter type"
                                                       autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" maxlength="40">
                                            </div>
                                            <span class="span-game-error" id="brndtype_err"><?php echo $this->session->flashdata('type'); ?></span>

                                        </td>
                                        <td>
                                            <div>
                                                <label class="lblLname" style="transform: translateY(4px);">Car Model<span
                                                        style="color: red;">*</span></label>
                                                <select class="txt-userident" id="show_other_model" value ='' name="select_car_model" onchange="showOtherInputModel();">
                                                    <option>Select Model...</option>
                                                </select>
                                            </div>
                                            <span class="span-game-error1" id="othermodel_err"><?php echo $this->session->flashdata('select_car_model'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div id="other_model_type" style="display: none;">
                                                <label class="loginLabel" style="transform: translateY(5px);">Other Car Model Name</label>
                                                <input type="text" id="otherCarsModel" name="new_model" autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false" class="txt-login-name2" placeholder="Enter Model Name" maxlength="40">
                                            </div>
                                            <span class="span-game-error1" id="carmodel_err"><?php echo $this->session->flashdata('new_model'); ?></span>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="divemail">
                                                <label id="lblEmail" style="transform: translateY(6px);">Price<span
                                                        style="color: red;">*</span></label>
                                                        <input type="number" name="price" class="user-email"  id="model_price" placeholder="Enter Price"
                                                        min="1" max="99999999999999" step="1" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" maxlength="40">
                                            </div>
                                            <span class="span-game-error" id="modelprice_err"><?php echo $this->session->flashdata('price'); ?></span>

                                        </td>
                                        <td>
                                            <div>
                                                <label class="LblRoleId" style="transform: translateY(5px);">Year</label>
                                                <input class="input-LblRoleId" id="priceyear" name="year" onKeyPress="if(this.value.length==4) return false;" value="" type="number" min="1" max="9999" step="1" placeholder="Enter Year"
                                                       autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false" maxlength="20">
                                            </div>
                                            <span class="span-game-error1" id="priceyear_err"><?php echo $this->session->flashdata('year'); ?></span>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="save-button" onclick="return addPricelistvali();" type="submit" name="btn_save" value="Save">
                                            <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                        </td>
                                    </tr>
                                </table>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="main-cards2">
                    <div class="card">
                        <div class="div_row" style="background-color: inherit">  
                            <h6 class="h4txt">View Pricelist</h6>
                        </div><br/>
                        <div style="width: 100%; background-color: transparent; ">
                            <?php echo form_open('admin_controller/Pricelist/inventory_price_list'); ?>
                            <div>
                                <label class="lbl-game">Select Game<span
                                        style="color: red;">*</span></label>
                                <select name="select_game" id="select_game" class="sel-game" onchange="this.form.submit();">
                                    <option value=""><?php echo $sel_game; ?> </option>
                                    <?php
                                    foreach ($user_game as $row_one) {
                                        ?>
                                        <option value="<?php echo $row_one->game_id; ?>"><?php echo $row_one->game_name; ?> </option>

                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <?php echo form_close(); ?>
                            <br><br>
                            <table id="table_price" class="display dataTable cell-border" align="center">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Product no.</th>
                                        <th>Brand</th>
                                        <th>Car Model</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sr_no = 0;
                                    foreach ($get_pricelist as $value) {
                                        $sr_no = $sr_no + 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $sr_no ?></td>
                                            <td><?php echo $value->product_no; ?></td>
                                            <td><?php echo $value->brand; ?></td>
                                            <td><?php echo $value->car_model; ?></td>
                                            <td>
                                                <?php
                                                $g_id = $value->id;
                                                $enc_key = $this->encrypt->encode($g_id);
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin_controller/Pricelist/get_pricelist_by_id/<?php echo $enc_key; ?>"><i class="fa fa-eye" style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a href="<?php echo base_url(); ?>admin_controller/Pricelist/edit_pricelist/<?php echo $enc_key; ?>"><i class="fa fa-edit" style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a onclick="return confirm('Are you sure want to delete pricelist ?');" href="<?php echo base_url(); ?>admin_controller/Pricelist/delete_pricelist/<?php echo $enc_key; ?>"><i class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>
                                            </td>
                                        </tr>  
                                    <?php }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </main>
</div>
<script type="text/javascript">
    var box = document.getElementById("alert_box");
    setTimeout(
            function () {
                box.style.display = 'none';
            }, 3000
            );

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#table_price').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    });
</script>
<script>
    function showOtherInput() {
        var optionSelected = document.getElementById("other_brand_type");
        var selectedOption = document.getElementById("show_other_brand").value;
        if (selectedOption === "Others") {
            optionSelected.style.display = "block";
        } else {
            optionSelected.style.display = "none";
        }
    }
</script>
<script>
    function showOtherInputModel() {
        var optionSelected = document.getElementById("other_model_type");
        var selectedOption = document.getElementById("show_other_model").value;
        if (selectedOption === "Other_model") {
            optionSelected.style.display = "block";
        } else {
            optionSelected.style.display = "none";
        }
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
