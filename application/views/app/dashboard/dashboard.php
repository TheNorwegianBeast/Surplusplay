
<html>
    <head>
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/datatable.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo base_url(); ?>application/views/app/asset/js/jquery3.5.0.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>application/views/app/asset/js/datatable.min.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/dashboard_header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/user_manager_header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/progress_media.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/video.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/error_span.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/registration_model.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/tool_tip.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>application/views/app/asset/js/dashboard.js" type="text/javascript"></script>   
        <script src="<?php echo base_url(); ?>application/views/app/dashboard/dashboard.js"  type="text/javascript"></script>  
    </head>
    <body onload="preloader();
            startBudgetDash();">
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <?php
        $game_id = $this->session->userdata('game_id');
        $userident = $this->session->userdata('user');
        ?>
        <input type="hidden" id="fetch_last_mission_status">
        <input type="hidden" id="date_start" value="">
        <input type="hidden" id="first_time_video">
        <input type="hidden" id="user" value="">
        <input type="hidden" id="game_id" value="<?php echo $game_id; ?>">
        <input type="hidden" id="mission_id" value="">
        <input type="hidden" id="allow_day" name="allow_day">
        <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
        <div class="division">
            <div class="container">
                <!-- Top red border -->
                <div class="header">
                    <button id="model_button_video"  style="display: none;"> Modal</button>

                    <!-- Video Modal --> 
                    <div id="modal-video" class="video-modal">

                        <!-- Modal content -->
                        <div class="video-content">

                            <div class="left-v-section">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/image/side_img.png" alt="" height="100%" width="100%"/>
                            </div>
                            <div class="v-section">
                                <div class="video-c">
                                    <span class="v-close" onclick="videoClose();">&times;</span>
                                </div>
                                <!--<div class="video-p">-->
                                <video id="addiction_video" width="100%" height="100%" controls>
                                    <source src="<?php echo base_url(); ?>application/views/asset/knowledge_media/" type="video/mp4">
                                </video>

                                <!--</div>-->
                                <div class="video-re">
                                    <button class="replay-btn" onclick="replayVideo();">Replay</button>
                                </div>
                            </div>
                            <div class="right-v-section">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/image/side_img.png" alt="" height="100%" width="100%"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Top red border End -->

                <div class="dash-section">
                    <div class="line-div">
                        <!-- Header navigation start -->
                        <div class="nav-header">
                            <?php
                            if ($role_id == 5) {
                                include_once APPPATH . 'views/app/asset/header/dashboard_header.php';
                            } else {
                                include_once APPPATH . 'views/app/asset/header/manager_dashboard_header.php';
                            }
                            ?>
                        </div>

                        <!-- Grid section for trophy progress and target -->
                        <div class="section">
                            <div class="left-section">
                                <!--main div of knowledge trophy label-->
                                <div class="knowledge-label">
                                    <div class="txt-know-trophy">
                                        <label>Knowledge Trophies</label>
                                    </div>
                                    <div class="que-know-trophy">
                                        <!--Right tooltip-->
                                        <div class="tooltip">

                                            <!-- Tooltip image -->
                                            <div class="quiz-notify-sec">
                                                <img class="trophy-que-img" src="<?php echo base_url(); ?>application/views/app/asset/icon/question_mark.png" alt="" height="100%" width="120%"/>
                                            </div>
                                            <!-- Tooltip explaination -->
                                            <div class="right">
                                                <div class="text-contentr">
                                                    <span>
                                                       Knowledge Quiz Trophies.
                                                    </span>
                                                </div>
                                                <i></i>
                                            </div>
                                        </div>
                                        <!--Right tooltip-->

                                    </div>
                                </div>

                                <!-- Trophy section start -->
                                <div class="knowledge-trophy">
                                    <div id='trophy'>
                                        <?php
                                        $city_name = '';
                                        for ($i = 1; $i <= 3; $i++) {
                                            ?>

                                            <div class="level-one">
                                                <?php
                                                for ($m = 1; $m <= 4; $m++) {
                                                    //  fetch mission by id 
                                                    $data_mission_city = $this->Dashboard_model->fetch_mission($m, $game_id);
                                                    foreach ($data_mission_city as $row_city) {
                                                        $city_name = $row_city->city_name;
                                                    }
                                                    ?>
                                                    <div class="city-box">
                                                        <div class="trophy-car">
                                                            <div class="trophy-car-div">
                                                                <img src="<?php echo base_url(); ?>application/views/asset/image/badge/scrab.png" alt="" width="100%"
                                                                     height="100%" />
                                                            </div>
                                                        </div>
                                                        <div class="trophy-label" style="background: #333333;">
                                                            <text><?php echo $city_name; ?></text>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="level-gap"></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- Trophy section End -->

                                <!-- Knowledge level label main div -->
                                <div class="knowledge-level">
                                    <div class="know-img">
                                        <img src="<?php echo base_url(); ?>application/views/app/asset/icon/know-level-icon.png" alt="" height="100%" width="100%" />
                                    </div>
                                    <div class="txt-know-level">
                                        <label>Knowledge Level</label>
                                    </div>
                                    <div class="que-know-level">
                                        <!-- Tooltip start -->
                                        <div class="tooltip4">

                                            <!-- Tooltip image -->
                                            <div class="congtrats-notify">
                                                <img class="knowledge-lvl-que-img" src="<?php echo base_url(); ?>application/views/app/asset/icon/question_mark.png" alt="" height="100%" width="120%"/>
                                            </div>

                                            <!-- Tooltip explaination -->
                                            <div class="right4">
                                                <div class="text-content4">
                                                    <span>Knowledge Level Trophy.</span>
                                                </div>
                                                <i></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Label div -->

                                <!-- knowledge car main div -->
                                <div class="knowledge-car">
                                    <div class="quiz-car">

                                        <?php
                                        $game_id = $this->session->userdata('game_id');
                                        $userident = $this->session->userdata('user');
                                        $data_count = $this->Dashboard_model->fetch_knowledge_badge_mapping_count($game_id, $userident);
                                        foreach ($data_count as $row_data) {
                                            $count = $row_data->count;

                                            if ($count == 0) {
                                                ?>
                                                <img src="<?php echo base_url(); ?>application/views/asset/image/knowledge_level/F1.png" alt=""
                                                     height="100%" width="100%" />
                                                     <?php
                                                 } else {
                                                     $data_fetch_knowledge_badge = $this->Dashboard_model->fetch_knowledge_badge_mapping($game_id, $userident);
                                                     foreach ($data_fetch_knowledge_badge as $row_badge_image) {
                                                         $fetch_badge_img = $row_badge_image->badge_knowlevel_image;
                                                         if ($fetch_badge_img != "") {
                                                             ?>
                                                        <img src="<?php echo base_url(); ?>application/views/asset/image/knowledge_level/<?php echo $fetch_badge_img; ?>" alt=""
                                                             height="100%" width="100%" />
                                                             <?php
                                                         }
                                                     }
                                                 }
                                             }
                                             ?>
                                    </div>
                                </div>

                            </div>

                            <!-- Progress bar section start --> 
                            <div class="middle-section" id="progress_bar">
                                <div class="sales-div">

                                    <!-- Left side Progress Bar Start -->
                                    <svg class="left-outer-svg">
                                    <!--Sales outer ellipse-->
                                    <ellipse class="left-outer-ellipse"/>
                                    </svg>

                                    <svg id="left-svg-progress" style="" viewBox="0 0 36 36" class="circular-chart-left orange">
                                    <!-- Color combination for progress circle -->
                                    <defs>
                                    <radialGradient id="grad1" cx="50%" cy="50%" fx="50%" fy="50%">
                                    <stop offset="90%" stop-color="red" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="white" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="red" stop-opacity="1"/>
                                    </radialGradient>
                                    </defs>

                                    <!--Background circle for progress circle-->
                                    <path class="bg-circle"
                                          d="M18 2.0845
                                          a 20.9155 15.9155 0 0 1 0 31.831
                                          a 20.9155 15.9155 0 0 1 0 -31.831"
                                          />
                                    <!-- Sales progress path -->
                                    <path class="progress-path" stroke="url('#grad1')"
                                          stroke-dasharray="0, 100" transform="scale(-1,-1)"
                                          stroke-linecap="round"
                                          d="M18 2.0845
                                          a 20.9155 15.9155 0 0 1 0 31.831
                                          a 20.9155 15.9155 0 0 1 0 -31.831"
                                          />

                                    <!-- Percentage for Sales -->
                                    <text class="left-percentage" x="50%" y="55%">
                                    0%
                                    </text>

                                    </svg>

                                    <!-- Progress bar label -->
                                    <text id="sale-progress-label">Sales</text>
                                    <!--Sales progress bar end here-->
                                </div>

                                <div class="mission-div">

                                    <!--Mission progress bar-->
                                    <svg class="middle-outer-svg">
                                    <!-- Outer ellipse for mission progress -->
                                    <ellipse class="middle-outer-ellipse"/>
                                    </svg>

                                    <!-- Viewbox for Mission -->
                                    <svg id="middle-svg-progress" viewBox="0 0 36 36" class="circular-chart_middle orange">

                                    <!-- Background circle for Mission -->
                                    <path class="bg-circle"
                                          d="M19 2.0845
                                          a 20.9155 15.9155 0 0 1 0 31.831
                                          a 20.9155 15.9155 0 0 1 0 -31.831"
                                          />
                                    <!-- Mission progress circle path -->
                                    <path class="progress-path" stroke="url('#grad1')"
                                          stroke-dasharray="0, 100" transform="scale(-1,-1)"
                                          stroke-linecap="round"
                                          d="M17 2.0845
                                          a 20.9155 15.9155 0 0 1 0 31.831
                                          a 20.9155 15.9155 0 0 1 0 -31.831"
                                          />
                                    <!-- Dotted circle for mission circle -->
                                    <ellipse class="dotted-ellipse"/>
                                    <!-- Mission percentage -->
                                    <text class="middle-percent" x="55%" y="57%">
                                    0%
                                    </text>

                                    </svg>

                                    <!-- Progress bar label -->
                                    <text id="mission-progress-label">Mission</text>

                                    <!-- Mission Progress bar End here -->
                                </div>
                                <div class="test-div">

                                    <!-- Right progress bar start here -->
                                    <svg class="right-outer-svg">
                                    <!-- Test drive outer ellipse -->
                                    <ellipse class="right-outer-ellipse"/>
                                    </svg>

                                    <svg id="right-svg-progress" viewBox="0 0 36 36" class="circular-chart_right orange">
                                    <!--Test drive Background circle -->
                                    <path class="bg-circle"
                                          d="M18 2.0845
                                          a 20.9155 15.9155 0 0 1 0 31.831
                                          a 20.9155 15.9155 0 0 1 0 -31.831"
                                          />
                                    <!--Test drive progress circle -->
                                    <path class="progress-path" stroke="url('#grad1')"
                                          stroke-dasharray="0, 100" stroke-linecap="round"
                                          transform="scale(-1,-1)"
                                          d="M18 2.0845
                                          a 20.9155 15.9155 0 0 1 0 31.831
                                          a 20.9155 15.9155 0 0 1 0 -31.831"
                                          />
                                    <!-- Test drive percentage -->
                                    <text class="right-percentage" x="50%" y="55%">
                                    0%
                                    </text>
                                    </svg>

                                    <!-- Progress bar label -->
                                    <text id="test-progress-label">Test drive</text>

                                </div>
                            </div>
                            <!-- Progress bar section end --> 


                            <!-- Right side section start --> 
                            <div class="right-section">

                                <!-- knowledge city main div start -->
                                <div class="target-city">
                                    <div class="que-city">
                                        <div class="timer-city">
                                            <div class="tooltip">
                                                <div class="city-notify">
                                                    <img class="city-que-img" src="<?php echo base_url(); ?>application/views/app/asset/icon/question_mark.png" alt="" height="100%" width="130%"/>
                                                </div>

                                                <!-- Tooltip explaination -->
                                                <div class="left">
                                                    <div class="text-content">
                                                        <span>Mission City and Spend Time.</span>
                                                    </div>
                                                    <i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="city-cover">
                                        <div class="city-circle">

                                            <div class="city-div">
                                                <img id="my_img" src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BERGEN_1.png" alt="" height="100%" width="100%"/>
                                            </div>
                                        </div>
                                        <div class="city-time" id="clock_div">
                                            <label id="clock">00D 00H 00M 00S</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- knowledge city main div end -->

                                <!-- Target label section -->
                                <div class="target-section">
                                    <div class="target-label">
                                        <div class="target-text">
                                            <label>Target</label>
                                        </div>
                                        <div class="target-que">
                                            <div class="tooltip">

                                                <!-- Tooltip image -->
                                                <div class="transaction-notify">
                                                    <img class="transaction-que-img" src="<?php echo base_url(); ?>application/views/app/asset/icon/question_mark.png" alt="" height="100%" width="130%"/>
                                                </div>

                                                <!-- Tooltip explaination -->
                                                <div class="top">
                                                    <span class="tooltip-head">Achieved Target</span><br/>
                                                    <span class="tooltip-text">Sales sold car </span> <span id="car_quantity">0</span><br>
                                                    <span>Test Drive sold car </span><span id="test_quantity">0</span>
                                                    <i></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Target circle -->
                                    <div class="target-circle">
                                        <div class="sale-tar-c">
                                            <div class="sales-circle">
                                                <text id="car_quantity_budget">0</text>
                                            </div>
                                        </div>
                                        <div class="test-tar-c">
                                            <div class="test-circle">
                                                <text id="test_quantity_budget">0</text>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Text of circle -->
                                    <div class="txt-circle">
                                        <div class="txt-sale-t">
                                            <label class="sale-q-txt">Sales Quantity</label>
                                        </div>
                                        <div class="txt-test-t">
                                            <label class="sale-q-txt">Test drive Quantity</label>
                                        </div>
                                    </div>

                                </div>

                                <!-- registration form start -->
                                <div class="target-form">
                                    <div class="gap-target"></div>
                                    <div class="reg-target">
                                        <div class="car-reg">
                                            <button class="car-reg-btn" id="registration_button" onclick="regShow();" disabled="">Car Registration</button>
                                        </div>
                                        <div class="test-reg">
                                            <button class="test-reg-btn" id="test_drive_button" onclick="testShow();" disabled="">Test Drive</button>
                                        </div>
                                    </div>
                                    <div class="gap-target"></div>
                                    <?php echo form_open(); ?>
                                    <input type="hidden" name="updated_time" id="updated_time" value=""/>
                                    <input type="hidden" placeholder="The Car" id="product_id" name="product_id" class="form-control "
                                           required="" readonly="" size="30"
                                           style="border-radius:1px; border:solid 1px #bfbfbf; background-color:#ffffff;height: 52px;">
                                    <input type="hidden" id="car_test_txt" name="car_test_txt" value="Reg">
                                    <input type="hidden" id="product_type" name="product_type" value="">
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $userident ?>">
                                    <input type="hidden" id="car_type" name="car_type" value="">
                                    <input type="hidden" id="quantity" name="quantity" readonly="">
                                    <input type="hidden" id="car_model" name="car_model" readonly="">
                                    <input type="hidden" id="txt_mission_id" name="txt_mission_id" value="1">
                                    <input type="hidden" id="txt_budget_started" name="txt_budget_started" value="0">
                                    <input type="hidden" id="user_id2" name="user_id2" value="<?php echo $userident ?>">
                                    <input type="hidden" id="year" required="" name="year">    
                                    <div class="model-target">
                                        <input class="model-reg" type="text" placeholder="Model" id="model" name="model" required=""
                                               readonly="" value="" autocomplete="off" oncopy="return false" onpaste="return false"
                                               oncut="return false">
                                    </div>
                                    <div class="gap-target"></div>

                                    <div class="new-used-target">
                                        <div class="amount-reg">
                                            <input type="number" class="amount-input" placeholder="Amount" type="text" id="amount" name="amount" placeholder="Amount"
                                                   required=""
                                                   value="" autocomplete="off" oncopy="return false" onpaste="return false"
                                                   oncut="return false">
                                        </div>
                                        <div class="btn-reg">
                                            <button type="button" class="new-btn" id="new_btn" onclick="priceListOpen();" disabled="">New</button>
                                            <button type="button" class="used-btn" id="used_btn" onclick="inventoryOpen();" disabled="">Used</button>
                                        </div>
                                    </div>
                                    <div class="gap-target"></div>
                                    <div class="submit-target">
                                        <button type="button" class="submit-btn" id="submit" onclick="sendRequestSalesDash();" disabled="">
                                            Submit
                                        </button>
                                    </div>
                                    <div class="form-error" >
                                        <span id="err_msg_car" style="color: #ffffff"></span>
                                    </div>

                                    <!--Error span alert box for budget completed-->
                                    <div class="budget-alert">
                                        <div class="quiz-modal" id="notify-modal" >
                                            <div class="quiz-notify">
                                                <!-- Modal content -->
                                                <div class="modal-content">
                                                    <p align="center">Budget not assigned</p>
                                                    <button id="start-quiz" class="start" onclick="quizClose();">OK</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                                <div id="sales_transaction"></div>
                                <!-- registration form end -->

                            </div>
                            <!-- Right side section end --> 

                        </div>
                        <!-- Grid section End -->

                        <!-- Footer --> 
                        <div class="footer"></div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Model for pricelist open -->
        <div id="model_new_button" class="modal-price">

            <!-- Modal content -->
            <div class="reg-content">
                <div class="reg-header" >
                    <span class="close" onclick="priceListClose();">&times;</span>
                    <label>Price List</label>
                </div>
                <div class="modal-body">
                    <table cellspacing="0" id="price_list_table" class="display cell-border" style="width:100%">
                        <thead>
                        <td class="price-head">Product Id &nbsp;&nbsp;</td>
                        <td class="price-head">Brand &nbsp;&nbsp;</td>
                        <td class="price-head">Type &nbsp;&nbsp;</td>
                        <td class="price-head">Model &nbsp;&nbsp;</td>
                        <td class="price-head">Amount &nbsp;&nbsp;</td>
                        <td class="price-head">Year &nbsp;&nbsp;</td>
                        </thead>
                        <?php
                        foreach ($price_list as $value) {
                            ?>

                            <tr>
                                <td class="price-data"><?php echo $value->product_no; ?></td>
                                <td class="price-data"><?php echo $value->brand; ?></td>
                                <td class="price-data"><?php echo $value->type; ?></td>
                                <td class="price-data"><?php echo $value->car_model; ?></td>
                                <td class="price-data"><?php echo $value->price; ?></td>
                                <td class="price-data"><?php echo $value->year; ?></td>
                            </tr>

                            <?php
                        }
                        ?>
                    </table>

                </div>
                <div class="pricelist-footer">
                    <h3>
                        <button id="close_new_btn_model" class="btn-close" onclick="priceListClose();" style="font-family:Flama-Basic;">Close</button>
                    </h3>
                </div>
            </div>
        </div>
        <!-- Model for pricelist close -->

        <!-- Model for Inventory open -->
        <div id="modal_used_button" class="modal-invent">

            <!-- Modal content -->
            <div class="reg-content">
                <div class="reg-header" >
                    <span class="close" onclick="inventoryClose();">&times;</span>
                    <label>Inventory</label>
                </div>
                <div class="modal-body">
                    <table id="inventory_table" class="display cell-border" style="width:100%">
                        <thead>
                            <th class="price-head">Pro No.</th>
                            <td class="price-head">Brand</td>
                            <td class="price-head">Model</td>
                            <td class="price-head">Cost</td>
                            <td class="price-head">Quantity</td>
                            <td class="price-head">Type</td>
                            <td class="price-head">Car Model</td>
                            <td class="price-head">Year</td>
                        </thead>
                        <?php
                        foreach ($inventory as $value) {
                            ?>
                            <tr>
                                <td class="price-data"><?php echo $value->product_no; ?></td>
                                <td class="price-data"><?php echo $value->brand_name; ?></td>
                                <td class="price-data"><?php echo $value->car_model; ?></td>
                                <td class="price-data"><?php echo $value->cost; ?></td>
                                <td class="price-data"><?php echo $value->quanity; ?></td>
                                <td class="price-data"><?php echo $value->type; ?></td>
                                <td class="price-data"><?php
                                    if ($value->is_new == 0) {
                                        echo "Used";
                                    } else {
                                        echo "New";
                                    }
                                    ?></td>
                                <td class="price-data"><?php echo $value->year; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    
                
                </div>
                <div class="pricelist-footer">
                    <button id="close_used_btn_model" onclick="inventoryClose();" class="btn-close" style="font-family:Flama-Basic;">Close</button>
                </div>
            </div>

        </div>
        <!-- Model for Inventory closed -->

        <script>
            /* Data table for new car model onclick event.. */
            var tableNew = document.getElementById('price_list_table');

            for (var i = 1; i < tableNew.rows.length; i++) {

                tableNew.rows[i].onclick = function () {
                    document.getElementById("product_id").value = this.cells[1].innerHTML;
                    document.getElementById("amount").value = this.cells[4].innerHTML;
                    document.getElementById("user_id").value = document.getElementById("user_id2").value;
                    document.getElementById("car_type").value = "1";
                    document.getElementById("model").value = this.cells[2].innerHTML;
                    document.getElementById("year").value = this.cells[5].innerHTML;
                    document.getElementById("car_model").value = this.cells[3].innerHTML;
                    document.getElementById("quantity").value = 1;
                    document.getElementById("product_type").value = "Price List";
                    document.getElementById("err_msg_car").innerHTML = "";
                    priceListClose();

                };
            }

            /* Data table for Used car model onclick event.. */
            var tableUsed = document.getElementById('inventory_table');

            for (var i = 1; i < tableUsed.rows.length; i++) {

                tableUsed.rows[i].onclick = function () {
                    document.getElementById("product_id").value = this.cells[1].innerHTML;
                    document.getElementById("amount").value = this.cells[3].innerHTML;
                    document.getElementById("user_id").value = document.getElementById("user_id2").value;
//                    alert(this.cells[6].innerHTML);
                    if (this.cells[6].innerHTML == "Used")
                    {
                        document.getElementById("car_type").value = "2";
                    } else {
                        document.getElementById("car_type").value = "1";
                    }
                    //  document.getElementById("car_type").value = "2";
                    document.getElementById("model").value = this.cells[2].innerHTML;
                    document.getElementById("year").value = this.cells[7].innerHTML;
                    document.getElementById("car_model").value = this.cells[2].innerHTML;
                    document.getElementById("quantity").value = 1;
                    document.getElementById("product_type").value = "Inventory";

                    document.getElementById("err_msg_car").innerHTML = "";
                    inventoryClose();

                };
            }

             /* data table JS */
           $(document).ready(function () {
               $('#price_list_table').DataTable({
                   "lengthChange": false
               });
           });
           $(document).ready(function () {
               $('#inventory_table').DataTable({
                   "lengthChange": false
               });
           });
           
           /* preloader code */
            var spinner = document.getElementById('ftco-loader');
            function preloader() {
                spinner.style.display = 'none';
            }
        </script>
        
    </body>
</html>
