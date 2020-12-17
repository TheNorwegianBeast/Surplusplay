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
            http1.open('get', '<?php echo base_url(); ?>admin_controller/Inventory/select_brand?game_id=' + gameId);
            http1.onreadystatechange = processGameId;
            http1.send(null);
            http2.open('get', '<?php echo base_url(); ?>admin_controller/Inventory/select_car_model?game_id=' + gameId);
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
                        <h5 id="viewGameId"><i class="fas fa-shopping-cart"></i> &nbsp;&nbsp;Edit Inventory</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/User/manage_user">&nbsp;&nbsp;Inventory</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit Inventory</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <?php if ($this->session->flashdata('suc_message') == 'update') { ?>
                                <div class="add-alert-row3" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Inventory</span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Oops</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                </div>
                            <?php } ?>

                            <div class="div_row">
                                <h6 class="h4txt">Edit Inventory</h6>
                            </div><br />

                            <div class="form-elements">
                                <?php echo form_open('admin_controller/Inventory/update_inventory'); ?>
                                <table class="mytabledata">
                                    <tr>
                                        <td colspan="2">
                                            <div>
                                                <label class="loginLabel1" class="translateY1">Select Game <span
                                                        style="color: red;">*</span></label>
                                                <select name="select_game" type="text" class="txt-level-name flex1" id="select_game"
                                                        placeholder="Enter Level Name" name="txt_level" autocomplete="off"
                                                        oncopy="return false" onpaste="return false" oncut="return false" onchange="getGameId();">
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
                                            <span class="span-game-error-sel1" id="selctedit_err"><?php echo $this->session->flashdata('select_game'); ?></span>

                                        </td>
                                    </tr>
                                    <?php
                                    foreach ($get_inventory_by_id as $value) {
                                        ?>
                                        <input type="hidden" value="<?php echo $value->is_new; ?>" id="is_new"
                                               name="is_new">
                                        <tr>
                                            <td class="tdp_no">
                                                <div>
                                                    <label class="loginLabel" style="transform: translateY(6px);">Product number<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" id="input_product" name="product_no" value="<?php echo $value->product_no; ?>" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" class="txt-login-name" placeholder="Enter product number">
                                                </div>
                                                <br />
                                                <span class="span-game-error" id="input_product_err"><?php echo $this->session->flashdata('product_no'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="UseridentLabel" style="transform: translateY(5px);">Brand Name<span
                                                            style="color: red;">*</span></label>
                                                    <select class="txt-userident" id="show_other_brand" value ='' name="select_brand" onchange="showOtherInput();">
                                                        <option value="<?php echo $value->brand_name; ?>"><?php echo $value->brand_name; ?></option>
                                                        <?php
                                                        foreach ($select_brand as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->brand_name; ?>"><?php echo $row->brand_name; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        <option value="Others">Add Other</option>
                                                    </select>
                                                </div>
                                                <span class="span-game-error1" id="sobinp_err"><?php echo $this->session->flashdata('select_brand'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div id="other_brand_type" style="display: none;">
                                                    <label class="loginLabel" style="transform: translateY(5px);">Other Brands</label>
                                                    <input type="text"  value="" id="other_brand_input" name="new_brand" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" class="txt-login-name03" placeholder="Enter Brand Name">
                                                </div>
                                                <span class="span-game-error1" id="obinp_err"></span>
                                            </td> 
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="lblFname" style="transform: translateY(6px);">Type<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" name="type" id="cr_type" class="txt-first-name" placeholder="Enter type"
                                                           value="<?php echo $value->type; ?>" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                                <span class="span-game-error" id="cr_type_err"><?php echo $this->session->flashdata('type'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="lblLname" style="transform: translateY(4px);">Car Model<span
                                                            style="color: red;">*</span></label>
                                                    <select class="txt-userident" id="show_other_model" name="select_car_model" onchange="showOtherInputModel();">
                                                        <option value="<?php echo $value->car_model; ?>"><?php echo $value->car_model; ?></option>
                                                        <?php
                                                        foreach ($select_model as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->car_model; ?>"><?php echo $row->car_model; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        <option value="Other_model">Add Other</option>
                                                    </select>
                                                </div>
                                                <span class="span-game-error" id="txtmodel_err"><?php echo $this->session->flashdata('car_model'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div id="other_model_type" style="display: none;">
                                                    <label class="loginLabel" style="transform: translateY(4px);">Other Model</label>
                                                    <input type="text" id="other_model_show"  value="" name="new_model" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" class="txt-login-name03" placeholder="Enter Model Name">
                                                </div>
                                                <span class="span-game-error1" id="other_model_err"><?php echo $this->session->flashdata('new_model'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="divemail">
                                                    <label class="lblEmail" style="transform: translateY(6px);">Cost<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" name="cost" id="inpcost_edit" class="user-email" placeholder="Enter Price"
                                                           value="<?php echo $value->cost; ?>" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                                <span class="span-game-error" id="inpcost_edit_err"><?php echo $this->session->flashdata('cost'); ?></span>


                                            </td>
                                            <td>
                                                <div>
                                                    <label class="LblRoleId" style="transform: translateY(3px);">Quantity<span
                                                            style="color: red;">*</span></label>
                                                    <input class="input-LblRoleId" id="edit_inpquantity" name="quantity" type="text" placeholder="Enter Year"
                                                           value="<?php echo $value->quanity; ?>" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                                <span class="span-game-error1" id="edit_inpquantity_err"><?php echo $this->session->flashdata('quantity'); ?></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="divemail">
                                                    <label class="lblEmail" style="transform: translateY(5px);">Year</label>
                                                    <?php
                                                    if($value->year == 0)
                                                    {
                                                        $value->year = '';
                                                        ?>
                                                     <input type="number" name="year" class="user-email" id="input_year" 
                                                           value="<?php echo $value->year; ?>" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                    <?php
                                                    }else
                                                    {
                                                        ?>
                                                      <input type="number" name="year" class="user-email" id="input_year" 
                                                           value="<?php echo $value->year; ?>" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                    <?php
                                                    }
                                                    ?>
                                                   
                                                </div>
                                                <span class="span-game-error" id="input_year_err"><?php echo $this->session->flashdata('year'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="LblRoleId" style="transform: translateY(-7px);">Is new<span
                                                            style="color: red;">*</span></label>
                                                    <div class="Parent_Radiogroup1">
                                                        <input type="radio" name="radio_is_new" id="result_radio_on"
                                                               value="1"> <label for="result_radio_on" class="size" style="cursor: pointer;">Yes</label>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="radio_is_new" id="result_radio_off"
                                                               value="0"><label for="result_radio_off" class="size" style="cursor: pointer;">No</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <input class="update-button" type="submit" onclick="return editInventoryvali();" name="btn_update" value="Update">
                                            <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                        </td>
                                    </tr>
                                </table>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
            <!--This is the main section beneath header admin and dropdowns ends-->
        </div>
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
            var box = document.getElementById("alert_box");
            setTimeout(
                    function () {
                        box.style.display = 'none';
                    }, 3000
                    );
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
