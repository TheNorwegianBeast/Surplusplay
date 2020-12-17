<!DOCTYPE html>
<html>
    <head>
        <?php
        require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/edit_budget.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/mission/js/mission_validation.js" type="text/javascript"></script>
    </head>
    <body onload="showBudtxt();spinner();">
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

            <?php
            $mission_name = '';
            $city_name = "";
            foreach ($mission as $row2) {
                $mission_name = $row2->mission_step;
                $city_name = $row2->city_name;
            }
            ?>
            <!--This is the main section beneath header admin and dropdowns starts-->  
            <main class="main">
                <div class="main-header">
                    <div class="main-header-heading" id="Vgameid"><h5 class="h5-view-game" id="viewGameId"><i class="fas fa-money-bill-alt"></i> &nbsp;&nbsp;Edit Budget</h5></div>
                    <div class="main-header__updates" id="headerUpdates">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="<?php echo base_url(); ?>admin_controller/Mission/view_budget">&nbsp;&nbsp;Budget</a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Edit
                                    Budget</a></li>
                        </ul>
                    </div>
                </div>

                <?php echo form_open('admin_controller/Mission/update_budget'); ?>
                    <div class="main-cards">
                        <div class="card">
                            <div class="CardIn">
                                <div class="row-inside">
                                    <div class="add-alert-row">
                                        <h6 class="h6-add-game">Edit Budget</h6>
                                    </div>
                                    <!--alert boxes section starts-->
                                   <?php 
                                    if ($this->session->flashdata('suc_message') == 'update') { ?>
                         <div class="add-alert-row3" id="alert_box">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                            <strong><span class="strong-alert-msg">Budget </span><span class="msg-alert"> &nbsp;record is updated successfully.</span></strong>
                        </div>
                                    <?php   } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                        <div class="add-alert-row4" id="alert_box">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                            <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something
                                    went wrong, Please try again!</span></strong>
                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <br/>

                                <div id="form-elements1">
                                    <table id="mytabledata">
                                        <?php
                                        foreach ($budget as $row_c) {
                                            ?>
                                            <input type="hidden" name="budget_id" value="<?php echo $row_c->budget_id; ?>">
                                            <tr>
                                                <td width="50%">
                                                    <div>
                                                        <label id="UseridentLabel">User Name</label>
                                                        <input class="inp-userident" disabled="" value="<?php echo $row_c->username; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label id="UseridentLabel">Userident</label>
                                                        <input class="txt-userident" value="<?php echo $row_c->userident; ?>" disabled="">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >
                                                    <div>
                                                        <label id="UseridentLabel">Mission Level</label>
                                                        <input type="text" name="txt_game_lvl" class="txt-game-level" value="<?php echo $mission_name; ?>" disabled="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label id="UseridentLabel">Mission City</label>
                                                        <input class="txt-userident" value="<?php echo $city_name; ?>" disabled="">
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label id="UseridentLabel">Year<span style="color: red;">*</span></label>
                                                        <input type="number" name="txt_year" value="<?php echo $row_c->year; ?>" class="txt-year" id="txt_year" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" onkeypress="" placeholder="Enter Year">
                                                    </div>
                                                    <span class="span-game-error" id="budget_year_err"><?php echo $this->session->flashdata('year_message'); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label id="UseridentLabel">Period</label>
                                                        <select name="txt_period" class="txt-period" id="txt_period">
                                                            <option value="<?php echo $row_c->period; ?>"><?php echo $row_c->period; ?></option>
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label id="UseridentLabel">From Date</label>
                                                        <input type="date" name="from_date" value="<?php echo $row_c->date_from; ?>" class="txt-from-date" id="from_date" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label id="UseridentLabel">To Date</label>
                                                        <input type="date" name="to_date" value="<?php echo $row_c->date_to; ?>" class="txt-to-date" id="to_date"  autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label id="UseridentLabel">Day to Complete<span style="color: red;">*</span></label>
                                                        <input type="number" name="txt_day_to_comp" value="<?php echo $row_c->day_to_complete; ?>" class="txt-from-date" id="txt_day_To_Comp" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false">

                                                    </div>
                                                    <span class="span-game-error" id="day_complete_err"><?php echo $this->session->flashdata('day_message'); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label id="UseridentLabel">Budget On<span style="color: red;">*</span></label>
                                                        <select name="txt_budget_type" id="txt_budget_type" class="txt-budtype" onchange="showBudtxt()">
                                                            <option value="<?php echo $row_c->budget_on; ?>"><?php echo $row_c->budget_on; ?></option>
                                                            <!--<option value="Amount">Amount</option>-->
                                                            <!--<option value="Quantity">Quantity</option>-->
                                                            <!--<option value="Amount And Quantity">Amount And Quantity</option>-->
                                                            <!--<option value="Amount Or Quantity">Amount Or Quantity</option>-->
                                                        </select>
                                                    </div>
						 <span class="span-game-err" id="budget_type_err"><?php echo $this->session->flashdata('bud_message'); ?></span>
                                                </td>

                                            </tr>
                                            
                                            <tr>
                                                <td>   
                                                    <div>
                                                        <label class="label-budget" id="label-amt-reg">Amount For Registration<span style="color: red;">*</span></label>
                                                        <input type="number" name="txt_amt_reg" value="<?php echo $row_c->amount_car_regi; ?>" class="txt-inp-reg" id="txt_amt_reg" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" onkeypress="" placeholder="Enter Amount For Registration" >
                                                    </div>
                                                    <span class="span-game-error" id="err_game_id"><?php echo $this->session->flashdata('amt_Rmessage'); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label class="label-budget" id="label-amt-test">Amount For Test Drive<span style="color: red;">*</span></label>
                                                        <input type="number" name="txt_amt_drive" value="<?php echo $row_c->amount_test_drive; ?>" class="txt-inp-drive" id="txt_amt_drive" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" onkeypress="" placeholder="Enter Amount For Test Drive" >
                                                    </div>
                                                    <span class="span-game-err" id="err_game_id"><?php echo $this->session->flashdata('amt_Tmessage'); ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label class="label-budget" id="label-qty-reg">Quantity For Registration<span style="color: red;">*</span></label>
                                                        <input type="number" name="txt_quan_reg" value="<?php echo $row_c->quantity_car_regi; ?>" class="txt-inp-quantity" id="txt_quan_reg"
                                                               " autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" onkeypress="" placeholder="Enter Quantity For Registration" >
                                                    </div>
                                                    <span class="span-game-error" id="quantity_reg_err"><?php echo $this->session->flashdata('qty_Rmessage'); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label class="label-budget" id="label-qty-test">Quantity For Test Drive<span style="color: red;">*</span></label>
                                                        <input type="number" name="txt_quan_drive" value="<?php echo $row_c->quantity_test_drive; ?>" class="txt-quan-drive" id="txt_quan_drive" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" onkeypress="" placeholder="Enter Quantity For Test Drive" >
                                                    </div>
                                                    <span class="span-game-err" id="quantity_test_err"><?php echo $this->session->flashdata('qty_Tmessage'); ?></span>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <div>
                                                    <input type="submit" class="update-button" onclick="return editBudget();showAlltxt();" name="btn_update" value="Update">
                                                    <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
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
            function  showBudtxt() {
                var amt = document.getElementById("txt_amt_reg");
                var qua = document.getElementById("txt_quan_reg");
                var amt2 = document.getElementById("txt_amt_drive");
                var qua2 = document.getElementById("txt_quan_drive");
                var amtReg = document.getElementById("label-amt-reg");
                var amtTest = document.getElementById("label-amt-test");
                var qtyReg = document.getElementById("label-qty-reg");
                var qtyTest = document.getElementById("label-qty-test");
                var dd = document.getElementById("txt_budget_type").value;
                if (dd === "Amount") {
                    amt.style.display = "block";
                    amt2.style.display = "block";
                    qua.style.display = "none";
                    qua2.style.display = "none";
                    amtReg.style.display = "block";
                    amtTest.style.display = "block";
                    qtyReg.style.display = "none";
                    qtyTest.style.display = "none";
                } else if (dd === "Quantity") {
                    amt.style.display = "none";
                    amt2.style.display = "none";
                    qua.style.display = "block";
                    qua2.style.display = "block";
                    amtReg.style.display = "none";
                    amtTest.style.display = "none";
                    qtyReg.style.display = "block";
                    qtyTest.style.display = "block";
                } else if (dd === "Amount And Quantity" || dd === "Amount Or Quantity") {
                    qua.style.display = "block";
                    amt.style.display = "block";
                    qua2.style.display = "block";
                    amt2.style.display = "block";
                    amtReg.style.display = "block";
                    amtTest.style.display = "block";
                    qtyReg.style.display = "block";
                    qtyTest.style.display = "block";
                } else {
                    amt.style.display = "none";
                    amt2.style.display = "none";
                    qua.style.display = "none";
                    qua2.style.display = "none";
                    qtyReg.style.display = "none";
                    qtyTest.style.display = "none";
                    amtReg.style.display = "none";
                    amtTest.style.display = "none";
                }
            }

            function showAlltxt()
            {

                document.getElementById("txt_amt").style.display = "block";
                document.getElementById("txt_quan").style.display = "block";
                document.getElementById('txt_amtQ1').style.display = "block";
                document.getElementById('txt_amtQ2').style.display = "block";
                var amt = document.getElementById("txt_amt").value;
                var qua = document.getElementById("txt_quan").value;
                var amt2 = document.getElementById("txt_amt").value;
                var qua2 = document.getElementById("txt_quan").value;

                if (amt == "")
                {
                    amt = 0;
                }
                if (qua == "")
                {
                    qua = 0;
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
    <!--body-ends-->

</html>
