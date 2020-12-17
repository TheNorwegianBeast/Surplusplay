<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_budget.css" rel="stylesheet"
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
            <?php
            $mission_name = '';
            foreach ($mission as $row2) {
                $mission_name = $row2->mission_step;
            }
            ?>
            <!--This is the main section beneath header admin and dropdowns starts-->  
            <main class="main">
                <div class="main-header">
                    <div class="main-header-heading" id="Vgameid"><h5 class="h5-view-budget" id="viewGameId"><i class="fas fa-money-check-alt"></i> &nbsp;&nbsp;View Budget</h5></div>
                    <div class="main-header__updates" id="headerUpdates">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="<?php echo base_url(); ?>admin_controller/Mission/view_budget">&nbsp;&nbsp;Budget</a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View
                                    Budget</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-cards">
                    <div class="card">
                        <div class="CardIn">
                            <div class="div_row">  
                                <h6 class="h4txt">View Budget</h6>
                            </div><br/>

                            <div id="form-elements1">
                                <table id="mytabledata">
                                    <?php
                                    foreach ($budget as $row_c) {
                                        ?>
                                        <tr>
                                            <td>
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
                                                    <input class="txt-game-level"  value="<?php echo $mission_name; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Mission City</label>
                                                    <input class="txt-userident" value="<?php echo $row_c->userident; ?>" disabled="">
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Year</label>
                                                    <input class="txt-year" value="<?php echo $row_c->year; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Period</label>
                                                    <input class="txt-to-date"  value="<?php echo $row_c->period; ?>" disabled="">
                                                </div>
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">From Date</label>
                                                    <input class="txt-from-date" value="<?php echo $row_c->date_from; ?>" disabled="">

                                                </div>
                                                <br>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">To Date</label>
                                                    <input class="txt-to-date" value="<?php echo $row_c->date_to; ?>" disabled="">
                                                </div>
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Day to Complete</label>
                                                    <input class="txt-from-date"  value="<?php echo $row_c->day_to_complete; ?>" disabled="">
                                                </div>
                                                <br>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Budget On</label>
                                                    <input class="inp-bud-on" id="inp-bud-on" value="<?php echo $row_c->budget_on; ?>" disabled="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>   
                                                <div>
                                                    <label class="label-budget" id="label-amt-reg">Amount For Registration</label>
                                                    <input class="txt-inp-reg" id="inp-bud-reg" value="<?php echo $row_c->amount_car_regi; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="label-budget" id="label-amt-test">Amount For Test Drive</label>
                                                    <input class="txt-inp-drive" id="inp-amt-test" value="<?php echo $row_c->amount_test_drive; ?>" disabled="">

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="label-budget" id="label-qty-reg">Quantity For Registration</label>
                                                    <input class="txt-inp-quantity" id="inp-qty-reg" value="<?php echo $row_c->quantity_car_regi; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="label-budget" id="label-qty-test">Quantity For Test Drive</label>
                                                    <input class="txt-quan-drive" id="inp-qty-drive" value="<?php echo $row_c->quantity_test_drive; ?>" disabled="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <a href="<?php echo base_url(); ?>admin_controller/Mission/view_budget"><input type="submit" class="back-button" name="btn_cancel" value="Back"></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!--This is the main section beneath header admin and dropdowns ends-->  
        </div>
        <script>
            var amt = document.getElementById("inp-bud-reg");
            var qua = document.getElementById("inp-qty-reg");
            var amt2 = document.getElementById("inp-amt-test");
            var qua2 = document.getElementById("inp-qty-drive");

            var lblAmtReg = document.getElementById("label-amt-reg");
            var lblAmtTest = document.getElementById("label-amt-test");
            var lblQtyReg = document.getElementById("label-qty-reg");
            var lblQtyTest = document.getElementById("label-qty-test");
            var budget = document.getElementById("inp-bud-on").value;

            if (budget === "Amount")
            {
                amt.style.display = "block";
                amt2.style.display = "block";
                qua.style.display = "none";
                qua2.style.display = "none";

                lblAmtReg.style.display = "block";
                lblAmtTest.style.display = "block";
                lblQtyReg.style.display = "none";
                lblQtyTest.style.display = "none";

            } else if (budget === "Quantity")
            {
                amt.style.display = "none";
                amt2.style.display = "none";
                qua.style.display = "block";
                qua2.style.display = "block";

                lblAmtReg.style.display = "none";
                lblAmtTest.style.display = "none";
                lblQtyReg.style.display = "block";
                lblQtyTest.style.display = "block";

            } else if (budget === "Amount And Quantity" || budget === "Amount Or Quantity")
            {
                qua.style.display = "block";
                amt.style.display = "block";
                qua2.style.display = "block";
                amt2.style.display = "block";
                lblQtyReg.style.display = "block";
                lblQtyTest.style.display = "block";
                lblAmtReg.style.display = "block";
                lblAmtTest.style.display = "block";

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
