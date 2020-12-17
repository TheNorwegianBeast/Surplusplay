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
                        <h5 id="viewGameId"><i class="fas fa-shopping-cart"></i> &nbsp;&nbsp;Inventory</h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Inventory</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <?php if ($this->session->flashdata('suc_message') == 'true') { ?>
                                <div class="add-alert-row2" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Inventory</span><span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                <div class="add-alert-row4" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Oops</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                </div>
                            <?php } else if ($this->session->flashdata('suc_message') == 'delete') { ?>
                                <div class="add-alert-row5" id="alert_box">
                                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                    <strong><span class="strong-alert-msg">Inventory</span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                                </div>
                            <?php }
                            ?>                            
                            <div class="div_row">
                                <h6 class="h5txt-lbl">Add Inventory</h6>
                            </div><br />
                            <?php echo form_open('admin_controller/Inventory/insert_inventory'); ?>
                            <div class="form-elements">
                                <table class="mytabledata">
                                    <tr>

                                        <td colspan="2">
                                            <div>
                                                <label class="loginLabel1 translateY1">Game <span
                                                        style="color: red;">*</span></label>
                                                <select name="select_game" type="text" class="txt-level-name flex1" id="select_game"
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
                                            <span class="span-game-error-sel1" id="gameselct_err"><?php echo $this->session->flashdata('select_game'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdp_no">
                                            <div>
                                                <label class="loginLabel" style="transform: translateY(5px);">Product number<span
                                                        style="color: red;">*</span></label>
                                                        <input type="text" id="productnum_id" name = 'product_no' autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false" class="txt-login-name" placeholder="Enter product number">
                                            </div>
                                            <br />
                                            <span class="span-game-error" id="productnum_id_err"><?php echo $this->session->flashdata('product_no_message'); ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="UseridentLabel" style="transform: translateY(5px);">Brand Name<span
                                                        style="color: red;">*</span></label>
                                                <select class="txt-userident" id="show_other_brand" name="select_brand" onchange="showOtherInput();">
                                                    <option value="">Select Brand</option>
                                                </select>
                                            </div>
                                            <span class="span-game-error1" id="brndname_err"><?php echo $this->session->flashdata('select_brand'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div id="other_brand_type" style="display: none;">
                                                <label class="loginLabel" style="transform: translateY(5px);">Other Brand Name</label>
                                                <input type="text"  value="" name="new_brand" autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false" class="txt-login-name03" id="oherbrndname_inp" placeholder="Enter Brand Name">
                                            </div>
                                            <span class="span-game-error1" id="oherbrnd_inp_err"><?php echo $this->session->flashdata('new_brand'); ?></span>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <label class="lblFname" style="transform: translateY(6px);">Type<span
                                                        style="color: red;">*</span></label>
                                                        <input type="text" name="type" class="F-name txt-first-name" id="carstypeinp" placeholder="Enter type"
                                                       value="" autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false">
                                            </div>
                                            <span class="span-game-error" id="carstypeinp_err"><?php echo $this->session->flashdata('type'); ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="lblLname" style="transform: translateY(4px);">Car Model<span
                                                        style="color: red;">*</span></label>
                                                <select class="txt-userident" id="show_other_model" value ='' name="select_car_model" onchange="showOtherInputModel();">
                                                    <option value="">Select Model...</option>
                                                    <option value="Other_model">Add Other</option>

                                                </select>
                                            </div>
                                            <span class="span-game-error1" id="selctcar_err"><?php echo $this->session->flashdata('select_car_model'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>

                                        </td>
                                        <td>
                                            <div id="other_model_type" style="display: none;">
                                                <label class="loginLabel" style="transform: translateY(4px);">Other Car Model Name</label>
                                                <input type="text"  value="" id="otheraddedmodel" name="new_model" autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false" class="txt-login-name03" placeholder="Enter Model Name">
                                            </div>
                                            <span class="span-game-error1" id="otheraddedmodel_err"><?php echo $this->session->flashdata('new_model'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="divemail">
                                                <label class="lblEmail" style="transform: translateY(6px);">Cost<span
                                                        style="color: red;">*</span></label>
                                                <input type="number" name="cost" id="inpCost" class="user-email" placeholder="Enter Cost"
                                                       autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false">
                                            </div>
                                            <span class="span-game-error" id="inpcost_err"><?php echo $this->session->flashdata('cost'); ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="LblRoleId" style="transform: translateY(3px);">Quantity<span
                                                        style="color: red;">*</span></label>
                                                        <input class="input-LblRoleId" id="inpquantity"  type="number" name="quantity" placeholder="Enter Quantity"
                                                       autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false">
                                            </div>
                                            <span class="span-game-error1" id="inpquantity_err"><?php echo $this->session->flashdata('quantity'); ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="divemail">
                                                <label class="lblEmail" style="transform: translateY(6px);">Year</label>
                                                <input type="number" id="inputyear" name="year" class="user-email" placeholder="Enter Year"
                                                       autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false">
                                            </div>
                                            <span class="span-game-error" id="inputyear_err"><?php echo $this->session->flashdata('year'); ?></span>

                                        </td>
                                        <td>
                                            <div>
                                                <label class="LblRoleId" style="transform: translateY(-6px);">Is New<span
                                                        style="color: red;">*</span></label>
                                                <div class="Parent_Radiogroup1">
                                                    <input type="radio" name="radio_is_new" id="result_radio_on"
                                                           value="1"><label class="size" for="result_radio_on" style="cursor:pointer">Yes</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="radio_is_new" id="result_radio_off"
                                                            value="0"><label for="result_radio_off" class="size" style="cursor:pointer">No</label>
                                                </div>
                                                <span class="span-game-error" id="radio_group_err"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="save-button" onclick="return addInventoryvali();" type="submit" name="btn_save" value="Save">
                                            <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

                <div class="main-cards2">
                    <div class="card">
                        <div class="div_row" style="background-color: inherit">  
                            <h6 class="h5txt-lbl">View Inventory</h6>
                        </div><br/>
                        <div style="width: 100%; background-color: transparent; ">
                            <form method="post" action="">
                                <div>
                                    <label id="lbl-game">Select Game<span
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
                            </form>
                            <br><br>
                            <table id="myTable" class="display dataTable" align="center">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Product no.</th>
                                        <th>Brand Name</th>
                                        <th>Car Model</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $Sr_no = 0;
                                    foreach ($get_all_inventory as $value) {
                                        $Sr_no = 1 + $Sr_no;
                                        ?>
                                        <tr>
                                            <td> <?php echo $Sr_no ?></td>
                                            <td><?php echo $value->product_no; ?></td>
                                            <td><?php echo $value->brand_name; ?></td>
                                            <td><?php echo $value->car_model; ?></td>
                                            <td>
                                                <?php
                                                $g_id = $value->id;
                                                $enc_key = $this->encrypt->encode($g_id);
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin_controller/Inventory/get_inventory_by_id/<?php echo $enc_key; ?>"><i class="fa fa-eye" style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a href="<?php echo base_url(); ?>admin_controller/Inventory/edit_inventory/<?php echo $enc_key; ?>"><i class="fa fa-edit" style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a onclick="return confirm('Are you sure want to delete inventory?');" href="<?php echo base_url(); ?>admin_controller/Inventory/delete_inventory/<?php echo $enc_key; ?>"><i class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>

                                </tbody>

                            </table>
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
