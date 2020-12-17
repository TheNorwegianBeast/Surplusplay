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

        <div id="myDelModal" class="modal" style="display: none;">
            <!-- Modal content -->
            <div class="modal-content" id="dialogModal">
                <p style="margin-bottom:35px;text-align: center; font-size: 1.6rem; letter-spacing: 0.2px;">Are you sure you want to Delete this data?</p>
                <div class="btn-area">
                    <a href="<?php echo base_url(); ?>Admin/logout" class="btn-yes1">Delete</a>
                    <a class="btn-no" id="hideModal" onclick="del_none();">Cancel</a>
                </div>
            </div>
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
                        <h5 id="viewGameId"><i class="fas fa-money-check-alt"></i> &nbsp;&nbsp;Edit Pricelist</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Pricelist/inventory_price_list">&nbsp;&nbsp;Pricelist</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit Pricelist</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <?php if ($this->session->flashdata('add_message') == 'update') { ?>
                                <div class="add-alert-row3" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Pricelist</span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('add_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Oops</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                </div>
                            <?php } ?>

                            <div class="div_row">
                                <h6 class="h4txt">Edit Pricelist</h6>
                            </div><br />
                            <div class="form-elements">
                                <?php echo form_open('admin_controller/Pricelist/update_pricelist'); ?>
                                <table class="mytabledata">
                                    <tr>

                                        <td colspan="2">
                                            <div>
                                                <label class="loginLabel1 translateY1">Select Game <span
                                                        style="color: red;">*</span></label>
                                                <select name="select_game" type="text" class="txt-level-name flex1" id="select_game"
                                                        placeholder="Enter Level Name" name="txt_level" autocomplete="off"
                                                        oncopy="return false" onpaste="return false" oncut="return false" onchange="getGameId();">

                                                    <?php
                                                    foreach ($select_game as $values) {
                                                        ?>
                                                        <option value="<?php echo $values->game_id; ?>">
                                                            <?php echo $values->game_name; ?></option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                            <span class="span-game-error-sel1" id="selctdd_err"><?php echo $this->session->flashdata('select_game'); ?></span>
                                        </td>
                                    </tr>
                                    <?php
                                    foreach ($get_pricelist_by_id as $value) {
                                        ?>
                                        <input type="hidden" value="<?php echo $value->id; ?>" id="id"
                                               name="id">
                                        <tr>
                                            <td class="tdp_no">
                                                <div>
                                                    <label class="loginLabel" style="transform: translateY(5px);">Product number<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" id="ip_prodnum" value="<?php echo $value->product_no ?>" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" class="txt-login-name" name="product_no"placeholder="Enter product number">
                                                </div>
                                                <span class="span-game-error" id="ip_prodnum_err"><?php echo $this->session->flashdata('product_no'); ?></span>

                                            </td>
                                            <td>
                                                <div>
                                                    <label class="UseridentLabel" style="transform: translateY(5px);">Brand<span
                                                            style="color: red;">*</span></label>
                                                    <select class="txt-userident" id="show_other_brand" value ='' name="select_brand" onchange="showOtherInput();">
                                                        <option value="<?php echo $value->brand; ?>"><?php echo $value->brand; ?></option>
                                                        <?php
                                                        foreach ($select_brand as $brand) {
                                                            ?>
                                                            <option value="<?php echo $brand->brand; ?>"><?php echo $brand->brand; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        <option value="Others">Add Other Brand</option>
                                                    </select>
                                                </div>
                                                <span class="span-game-error1" id="selct_err"><?php echo $this->session->flashdata('select_brand'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div id="other_brand_type" style="display: none;">
                                                    <label class="loginLabel" style="transform: translateY(5px);">Other Brand Name</label>
                                                    <input type="text"  value="" id="other_brnd" name="new_brand" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" class="txt-login-name2" placeholder="Enter Brand Name">
                                                </div>
                                                <span class="span-game-error1" id="other_brnd_err"><?php echo $this->session->flashdata('new_brand'); ?></span>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="lblFname" style="transform: translateY(6px);">Type<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" name="type" class="F-name txt-first-name" id="pricelist_type" placeholder="Enter type"
                                                           value="<?php echo $value->type; ?>" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                                <span class="span-game-error" id="typeip_err"><?php echo $this->session->flashdata('type'); ?></span>

                                            </td>
                                            <td>
                                                <div>
                                                    <label class="lblLname" style="transform: translateY(4px);">Car Model<span
                                                            style="color: red;">*</span></label>
                                                    <select class="txt-userident" id="show_other_model" value ='' name="select_car_model" onchange="showOtherInputModel();">
                                                      <option value="<?php echo $value->car_model; ?>"><?php echo $value->car_model; ?></option>
                                                        <?php
                                                        foreach ($select_model as $value_model) {
                                                            ?>
                                                            <option value="<?php echo $value_model->car_model; ?>"><?php echo $value_model->car_model; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        <option value="Other_model">Add Other Car Model</option>
                                                    </select>
                                                </div>
                                                <span class="span-game-error1" id="otherdd_err"><?php echo $this->session->flashdata('select_car_model'); ?></span>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div id="other_model_type" style="display: none;">
                                                    <label class="loginLabel" style="transform: translateY(5px);">Other Car Model Name</label>
                                                    <input type="text"  value="" id="othercarinput" name="new_model" autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" class="txt-login-name2" placeholder="Enter Model Name">
                                                </div>
                                                <span class="span-game-error1" id="othercarinput_err"><?php echo $this->session->flashdata('new_model'); ?></span>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="divemail">
                                                    <label class="lblEmail" style="transform: translateY(7px);">Price<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" name="price" id="carmodel_price" class="user-email" placeholder="Enter Price"
                                                           value="<?php echo $value->price; ?>" autocomplete="off" onKeyPress="if (this.value.length == 15)
                                                                       return false;" min="1" max="99999999999" step="1" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                                <span class="span-game-error" id="carmodel_price_err"><?php echo $this->session->flashdata('price'); ?></span>

                                            </td>
                                            <td>
                                                <div>
                                                    <label class="LblRoleId" style="transform: translateY(4px);">Year</label>
                                                    <?php
                                                        if($value->year==0)
                                                        {
                                                            $value->year = '';
                                                            ?>
                                                     <input class="input-LblRoleId" id="inp_year" name="year" type="number" 
                                                           value="<?php echo $value->year; ?>" autocomplete="off" onKeyPress="if (this.value.length == 4)
                                                                       return false;" min="1" max="99999" step="1" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                            <?php
                                                        }  else {
                                                            ?>
                                                      <input class="input-LblRoleId" id="inp_year" name="year" type="number" 
                                                           value="<?php echo $value->year; ?>" autocomplete="off" onKeyPress="if (this.value.length == 4)
                                                                       return false;" min="1" max="99999" step="1" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                     <?php
                                                            
                                                        }
                                                    ?>
                                                   
                                                </div>
                                                <span class="span-game-error1" id="inp_year_err"><?php echo $this->session->flashdata('year'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="update-button" type="submit" name="btn_update" value="Update" onclick="return editPricelistvali();">
                                                <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                            </td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                                ?>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
        <script type="text/javascript">
            var box = document.getElementById("alert_box");
            setTimeout(
                    function () {
                        box.style.display = 'none';
                    }, 3000
                    );
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
            function del_block() {
                var block = document.getElementById('myDelModal');
                block.style.display = 'block';
            }
            function del_none()
            {
                var block = document.getElementById('myDelModal');
                block.style.display = 'none';
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
