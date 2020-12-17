<!DOCTYPE html>
<html>
    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/add_budget.css" rel="stylesheet"
              type="text/css" />
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/data_table_custom.css" rel="stylesheet"
              type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/admin/mission/js/mission_validation.js" type="text/javascript"></script>
        <script type="text/javascript">
            function getUserID() {
                var uname = document.getElementById("user_name").value;
                document.getElementById("user").value = uname;
            }

            var tokenValue = '<?php echo $this->security->get_csrf_hash(); ?>';
            function sendRequest() {
                console.log('Token is ' + tokenValue);
                var userident = document.getElementById("user_name").value;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>admin_controller/Mission/check_user_bugdet',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': tokenValue,
                        userident: userident
                    },
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        console.log('The returned DATA is ' + JSON.stringify(data));
                        console.log('The returned token is ' + data.token);
                        tokenValue = data.token;
                        document.getElementById("<?php echo $this->security->get_csrf_token_name(); ?>").value = tokenValue;
                        var count = data.response[0].BCount;
                        if (count > 0) {
                            document.getElementById('warning-div').style.display = 'block';
                        } else {
                            document.getElementById('warning-div').style.display = 'none';
                        }
                    }
                });
            }
        </script>
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
                    <div class="main-header-heading" id="Vgameid">
                        <h5 class="h5-view-game" id="viewGameId"><i class="fas fa-money-check-alt"></i> &nbsp;&nbsp;Add Budget
                        </h5>
                    </div>
                    <div class="main-header__updates" id="headerUpdates" style="">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame"
                                                                            href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                            </li>
                            <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;Budget</a></li>
                        </ul>
                    </div>
                </div>
                <?php
                $mission_name = '';
                foreach ($mission as $row2) {
                    $mission_name = $row2->mission_step;
                    $city_name = $row2->city_name;
                    $curr_mission_id=$row2->mission_id;
                }
                ?>
                <form method="post" action="<?php echo base_url(); ?>admin_controller/Mission/insert_budget" autocomplete="off"> 
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <div class="main-cards">
                        <div class="card">
                            <div class="CardIn">
                                <div class="row-inside">
                                    <div class="add-alert-row">
                                        <h6 class="h6-add-game">Add Budget</h6>
                                    </div>
                                    <!--alert boxes section starts-->
                                    <!--alert boxes section starts-->
                                    <?php if ($this->session->flashdata('suc_message') == 'true') { ?>
                                        <div class="add-alert-row2" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                            <strong><span class="strong-alert-msg">Budget </span> <span class="msg-alert"> &nbsp;record is added successfully.</span></strong>
                                        </div>
                                    <?php } else if ($this->session->flashdata('suc_message') == 'false') { ?>
                                        <div class="add-alert-row4" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                            <strong><span class="strong-alert-msg">Oops !</span><span class="msg-alert"> &nbsp;Something went wrong, Please try again!</span></strong>
                                        </div>
                                    <?php } else if ($this->session->flashdata('suc_message') == 'delete') { ?>
                                        <div class="add-alert-row5" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                            <strong><span class="strong-alert-msg">Budget </span><span class="msg-alert"> &nbsp;record is deleted successfully.</span></strong>
                                        </div>
                                    <?php } else if ($this->session->flashdata('userbud_message') == 'budget') {
                                        ?>
                                        <div class="add-alert-row4" id="alert_box">
                                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                            <strong><span class="strong-alert-msg">Sorry </span><span class="msg-alert"> &nbsp;Selected user's budget is already set!</span></strong>
                                        </div>
                                    <?php } ?>
                                    <div class="add-alert-row4" id="warning-div" style="display:none;">
                                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                        <strong><span class="strong-alert-msg">Sorry </span><span class="msg-alert"> &nbsp;Selected user's budget is already set!</span></strong>
                                    </div>
                                </div>
                                <br />

                                <div id="form-elements1">
                                    <table id="mytabledata">
                                        <tr>
                                            <td width="50%">
                                                <div>
                                                    <label id="UseridentLabel">User Name <span
                                                            style="color: red;">*</span></label>
                                                    <select name="user_name" id="user_name" class="sel-username" onchange="getUserID();
                                                            sendRequest(this.value);">
                                                        <option value="">Select User...</option>

                                                        <?php
                                                        $game_id=1;
                                                        foreach ($user as $row) {
                                                            $res_last_mission = $this->Mission_model->fetch_last_added_mission($row->userident, $game_id);
                                                            $fetch_last_mission_id=0;
                                                            foreach ($res_last_mission as $row_last_mission) {
                                                                $fetch_last_mission_id = $row_last_mission->mission_id;
                                                            }
                                                            if($fetch_last_mission_id + 1== $curr_mission_id)
                                                            {
                                                            ?>
                                                            <option value="<?php echo $row->userident; ?>">
                                                                <?php echo $row->first_name . ' ' . $row->last_name; ?>
                                                            </option>
                                                        <?php }}
                                                        ?>
                                                    </select>
                                                </div>
                                               
                                                <span class="span-game-error" id="budget_user-err"><?php echo $this->session->flashdata('u_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel" class="userident-lbl">Userident<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" id="user" name="txt_user" class="txt-userident"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" onkeypress="" readonly="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Mission Level<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" name="txt_game_lvl" class="txt-game-level"
                                                           value="<?php echo $mission_name; ?>" disabled="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel" class="userident-lbl">Mission City<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" name="txt_game_lvl" class="txt-userident"
                                                           value="<?php echo $city_name; ?>" disabled="">
                                                </div>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Year<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" name="txt_year" class="txt-year" id="txt_year"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false" onkeypress="" placeholder="Enter Year">
                                                </div>
                                                <span class="span-game-error" id="budget_year_err"><?php echo $this->session->flashdata('year_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel" class="userident-lbl">Period</label>
                                                    <select name="txt_period" class="txt-period" id="txt_period">
                                                        <option value="">Select Period</option>
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
                                                    <input type="date" name="from_date" class="txt-from-date" id="from_date"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div> 
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel" class="userident-lbl">To Date</label>
                                                    <input type="date" name="to_date" class="txt-to-date" id="to_date"
                                                           autocomplete="off" oncopy="return false" onpaste="return false"
                                                           oncut="return false">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel">Days to Complete<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" name="txt_day_to_comp" class="txt-from-date"
                                                           id="txt_day_To_Comp" autocomplete="off" oncopy="return false" placeholder="Enter Days"
                                                           onpaste="return false" oncut="return false" value="">
                                                </div>
                                                <span class="span-game-error" id="days_err"><?php echo $this->session->flashdata('day_message'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label id="UseridentLabel" class="userident-lbl">Budget On<span
                                                            style="color: red;">*</span></label>
                                                    <select name="txt_budget_type" id="txt_budget_type" class="txt-budtype"
                                                            onchange="showBudtxt()">
                                                        <option value="">Select Budget</option>
                                                        <!--                                                        <option value="Amount">Amount</option>-->
                                                        <option value="Quantity">Quantity</option>
                                                        <!--<option value="Amount And Quantity">Amount And Quantity</option>-->
                                                        <!--<option value="Amount Or Quantity">Amount Or Quantity</option>-->
                                                    </select>
                                                </div>
                                                <span class="span-game-err" id="budget_on_err"><?php echo $this->session->flashdata('bud_message'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="amount-reg" id="label-amt-reg">Amount For
                                                        Registration<span style="color: red;">*</span></label>
                                                    <input type="number" name="txt_amt_reg" class="txt-inp-reg"
                                                           id="txt_amt_reg" autocomplete="off" oncopy="return false"
                                                           onpaste="return false" oncut="return false" onkeypress=""
                                                           placeholder="Enter Amount For Registration" value="1">
                                                </div>
                                                <span class="span-game-error" id="err_game_id"><?php echo $this->session->flashdata('amt_Rmessage'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="label-budget" id="label-amt-test">Amount For Test
                                                        Drive<span style="color: red;">*</span></label>
                                                    <input type="number" name="txt_a    mt_drive" class="txt-inp-drive"
                                                           id="txt_amt_drive" autocomplete="off" oncopy="return false"
                                                           onpaste="return false" oncut="return false" onkeypress=""
                                                           placeholder="Enter Amount For Test Drive" value="1">
                                                </div>
                                                <span class="span-game-err" id="err_game_id"><?php echo $this->session->flashdata('amt_Tmessage'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="amount-reg" id="label-qty-reg">Car Registration Quantity <span style="color: red;">*</span></label>
                                                    <input type="number" name="txt_quan_reg" class="txt-inp-quantity"
                                                           id="txt_quan_reg" autocomplete="off" oncopy="return false"
                                                           onpaste="return false" oncut="return false" onkeypress=""
                                                           placeholder="Quantity Car Registration" value="">
                                                </div>
                                                <span class="span-game-error" id="car_quantity_err"><?php echo $this->session->flashdata('qty_Rmessage'); ?></span>
                                            </td>
                                            <td>
                                                <div>
                                                    <label class="label-budget" id="label-qty-test">Test Drive Quantity<span style="color: red;">*</span></label>
                                                    <input type="number" name="txt_quan_drive" class="txt-quan-drive"
                                                           id="txt_quan_drive" autocomplete="off" oncopy="return false"
                                                           onpaste="return false" oncut="return false" onkeypress=""
                                                           placeholder="Quantity Test Drive" value="">
                                                </div>
                                                <span class="span-game-err" id="testdrive_err"><?php echo $this->session->flashdata('qty_Tmessage'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <input type="submit" class="save-button"  name="btn_save" onclick="return addBudget();showAlltxt();"
                                                           value="Save">
                                                    <input type="submit" class="back-button" name="btn_cancel" value="Back">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br><br>
                <div class="card" style="height:auto;">
                    <div class="div_row">
                        <h6 class="h4txt">View Budget</h6>
                    </div><br />

                    <div style="width: 98%; background-color: transparent; ">
                        <table id="myTable" class="display dataTable" align="center">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Time Stamp</th>
                                    <th>Username</th>
                                    <th>Userident</th>
                                    <th>Mission</th>
                                    <!--<th>Car Amount</th>-->
                                    <th>Car Quantity</th>
                                    <!--<th>Testdrive Amount</th>-->
                                    <th>Testdrive Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sr_no = 1;
                                foreach ($budget as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sr_no; ?></td>
                                        <td><?php echo $row->timestamp; ?></td>
                                        <td><?php echo $row->username; ?></td>
                                        <td><?php echo $row->userident; ?></td>
                                        <td><?php echo $mission_name; ?></td>
                                        <!--<td><?php echo $row->amount_car_regi; ?></td>-->
                                        <td><?php echo $row->quantity_car_regi; ?></td>
                                        <!--<td><?php echo $row->amount_test_drive; ?></td>-->
                                        <td><?php echo $row->quantity_test_drive; ?></td>
                                        <td>
                                            <?php
                                            $g_id = $row->budget_id;
                                            $enc_key = $this->encrypt->encode($g_id);
                                            ?>
                                            <a href="<?php echo base_url(); ?>admin_controller/Mission/view_one_budget/<?php echo $enc_key; ?>"><i class="fa fa-eye"
                                                                                                                                                   style="font-size:16px;color: blue;"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a href="<?php echo base_url(); ?>admin_controller/Mission/edit_budget/<?php echo $enc_key; ?>"><i class="fa fa-edit"
                                                                                                                                               style="font-size:16px;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
                                            <!--<a onclick="return confirm('Are you sure want to delete budeget?');" href="<?php// echo base_url(); ?>admin_controller/Mission/delete_budget/<?php// echo $enc_key; ?>"><i class="fa fa-trash-o" style="font-size:17px;color:red;"></i></a>-->
                                        </td>
                                    </tr>
                                    <?php
                                    $sr_no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
            function showBudtxt() {

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

            function showAlltxt() {

                document.getElementById("txt_amt").style.display = "block";
                document.getElementById("txt_quan").style.display = "block";
                document.getElementById('txt_amtQ1').style.display = "block";
                document.getElementById('txt_amtQ2').style.display = "block";
                var amt = document.getElementById("txt_amt").value;
                var qua = document.getElementById("txt_quan").value;
                var amt2 = document.getElementById("txt_amt").value;
                var qua2 = document.getElementById("txt_quan").value;
                if (amt == "") {
                    amt = 0;
                }
                if (qua == "") {
                    qua = 0;
                }
            }
        </script>
        <script type="text/javascript">
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
    <!--body-ends-->



</html>
