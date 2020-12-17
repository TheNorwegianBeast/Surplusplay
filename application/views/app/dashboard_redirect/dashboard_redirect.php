
<html>
    <head>
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dashboard_redirect.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/dashboard_header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/user_manager_header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/progress_media.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/video.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/registration_model.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>application/views/app/asset/js/dashboard.js" type="text/javascript"></script>   
        <script src="<?php echo base_url(); ?>application/views/app/dashboard/dashboard.js"  type="text/javascript"></script>  
         <link href="<?php echo base_url(); ?>application/views/app/asset/css/tool_tip.css" rel="stylesheet" type="text/css"/>
    </head>
    <body onload="preloader();startBudgetDash(); setTimeout(sendRequestShowProgress, 500);setTimeout(fatchCarTestBudget, 1500);">
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <?php
        $game_id = $this->session->userdata('game_id');
        $userident = $this->session->userdata('user');
        $role_id = $this->session->userdata('role_id');
        ?>
        <input type="hidden" id="fetch_last_mission_status">
        <input type="hidden" id="game_id" value="<?php echo $game_id ?>">
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
                            <?php if($role_id == 5) {
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
                                    
<!--                                    <div class="que-know-trophy">
                                        <img src="<?php echo base_url(); ?>application/views/app/asset/icon/question_mark.png" alt="" height="100%" width="100%"/>
                                    </div>-->
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
                                    </div>

                                    <div class="level-gap"></div>
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
                                                <img id="my_img" src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/NEW_DELHI_1.png" alt="" height="100%" width="100%"/>
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
                                                    <span class="tooltip-text">Sales sold car </span> <span id="car_quantity_budget_till">0</span><br>
                                                    <span>Test Drive sold car </span><span id="test_quantity_budget_till">0</span>
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
                                    <form>
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
                                        <input type="hidden" id="txt_mission_id" name="txt_mission_id" value="<?php echo $m; ?>">
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
                                                <input class="amount-input" placeholder="Amount" type="text" id="amount" name="amount" placeholder="Amount"
                                                       required=""
                                                       value="" autocomplete="off" oncopy="return false" onpaste="return false"
                                                       oncut="return false" readonly="">
                                            </div>
                                            <div class="btn-reg">
                                                <button type="button" class="new-btn" id="new_btn" onclick="priceListOpen();"  disabled="">New</button>
                                                <button type="button" class="used-btn" id="used_btn" onclick="inventoryOpen();" disabled="">Used</button>
                                            </div>
                                        </div>
                                        <div class="gap-target"></div>
                                        <div class="submit-target">
                                            <button type="button" class="submit-btn" disabled="">
                                                Submit
                                            </button>
                                        </div>
                                        <div class="form-error" >
                                            <span id="err_msg_car"></span>
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
                                    </form>
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

                    <table id="price_list_table" class="price-tbl" >
                        <tr>
                            <th class="price-head">Product Id &nbsp;&nbsp;</th>
                            <th class="price-head">Brand &nbsp;&nbsp;</th>
                            <th class="price-head">Type &nbsp;&nbsp;</th>
                            <th class="price-head">Model &nbsp;&nbsp;</th>
                            <th class="price-head">Amount &nbsp;&nbsp;</th>
                            <th class="price-head">Year &nbsp;&nbsp;</th>
                        </tr>
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
                    <table id="inventory_table" class="price-tbl">
                        <tr>
                            <th class="price-head">Pro No.</th>
                            <th class="price-head">Brand</th>
                            <th class="price-head">Model</th>
                            <th class="price-head">Cost</th>
                            <th class="price-head">Quantity</th>
                            <th class="price-head">Type</th>
                            <th class="price-head">Car Model</th>
                            <th class="price-head">Year</th>
                        </tr>
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
                                <td class="price-data"><?php echo $value->is_new; ?></td>
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
//                  document.getElementById("car_type").value = "1";
                    document.getElementById("model").value = this.cells[2].innerHTML;
                    document.getElementById("year").value = this.cells[5].innerHTML;
                    document.getElementById("car_model").value = this.cells[3].innerHTML;
                    document.getElementById("quantity").value = 1;
                    document.getElementById("product_type").value = "Price List";
//                    document.getElementById("err_msg_car").innerHTML = "";
                    priceListClose();

                };
            }

            var tableUsed = document.getElementById('inventory_table');

            for (var i = 1; i < tableUsed.rows.length; i++) {

                tableUsed.rows[i].onclick = function () {
                    document.getElementById("product_id").value = this.cells[1].innerHTML;
                    document.getElementById("amount").value = this.cells[3].innerHTML;
                    document.getElementById("user_id").value = document.getElementById("user_id2").value;
//                  document.getElementById("car_type").value = "2";
                    document.getElementById("model").value = this.cells[2].innerHTML;
                    document.getElementById("year").value = this.cells[7].innerHTML;
                    document.getElementById("car_model").value = this.cells[6].innerHTML;
                    document.getElementById("quantity").value = 1;
                    document.getElementById("product_type").value = "Inventory";

//                  document.getElementById("err_msg_car").innerHTML = "";
                    inventoryClose();

                };
            }

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

            /* Ajax call for progressbar..*/
            function sendRequestShowProgress() {
                var user = document.getElementById("user_id").value;
                var gameId = document.getElementById("game_id").value;
                var txtMissionId = document.getElementById("txt_mission_id").value;
                var updatedTime = document.getElementById("updated_time").value;
                var lastComTime = document.getElementById("clock").innerHTML;
                var data = user + "~" + gameId + "~" + txtMissionId + "~" + updatedTime + "~" + lastComTime;
                http1.open('get', '<?php echo base_url(); ?>app_controller/Dashboard/show_progress_redirect?data=' + data);
                http1.onreadystatechange = processResponseShowProgress;
                http1.send(null);

            }

            function processResponseShowProgress() {
                if (http1.readyState == 4) {
                    var response = http1.responseText;
                    document.getElementById('progress_bar').innerHTML = response;
                    getTrophy();
                  //   fatchCarTestBudgetTill();
                }
            }

            function startBudgetDash() {

                var user = document.getElementById("user_id").value;
                var txtMissionId = document.getElementById("txt_mission_id").value;
                var data = user + "~" + txtMissionId;
                http1.open('get', '<?php echo base_url(); ?>app_controller/Dashboard/start_budget_redirect?data=' + data);
                http1.onreadystatechange = processResponsestartBudget;
                http1.send(null);
            }

            function processResponsestartBudget() {
                if (http1.readyState == 4) {
                    var response = http1.responseText;
//                    alert(response);
                    var bits = response.split(/[\s~]+/);

                    document.getElementById("clock").innerHTML = bits[bits.length - 8] + " " + bits[bits.length - 7] + " " + bits[bits.length - 6] + " " + bits[bits.length - 5];
                    document.getElementById("fetch_last_mission_status").value = bits[bits.length - 4];
                    document.getElementById("game_id").value = bits[bits.length - 3];
                    document.getElementById("txt_mission_id").value = bits[bits.length - 2];
                    document.getElementById("my_img").src = "<?php echo base_url(); ?>application/views/asset/image/porsche_city/" + bits[bits.length - 1];
                }
            }


            /*Ajax Request Object */
            function createRequestObject() {
                var tmpXmlHttpObject;
                if (window.XMLHttpRequest) {
                    tmpXmlHttpObject = new XMLHttpRequest();
                } else if (window.ActiveXObject) {
                    tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
                }
                return tmpXmlHttpObject;
            }

            var http = createRequestObject();

            /* Ajax page for Trophy */
            function getTrophy() {
                var m = document.getElementById("txt_mission_id").value;
                http.open('get', '<?php echo base_url(); ?>app_controller/Dashboard/dashboard_tropy?m=' + m);
                http.onreadystatechange = processResponseTrophy;
                http.send(null);
            }

            function processResponseTrophy() {
                if (http.readyState == 4) {
                    var response = http.responseText;
                    document.getElementById('trophy').innerHTML = response;
                }
            }

            /*Fatching Car and test Qty budget from ajax page..*/
            function fatchCarTestBudgetTill() {
                document.getElementById("car_quantity_budget_till").innerText = document.getElementById("car_till_quantity").value;
                document.getElementById("test_quantity_budget_till").innerText = document.getElementById("test_till_quantity").value;
            }
            
            
                       
            /*Fatching Car and test Qty budget from ajax page..*/
            function fatchCarTestBudget() {
               
                document.getElementById("car_quantity_budget").innerText = document.getElementById("car_budget_qty").value;
                document.getElementById("test_quantity_budget").innerText = document.getElementById("test_budget_qty").value;
               fatchCarTestBudgetTill();
            }

        </script>
        <script>

            /* Open result list dropdown */
            function videoList() {
                var video = document.getElementById("v-list-open");
                var videoClose = document.getElementById("v-list-close");
                var videoList = document.getElementById("video-list");
                if (video.style.display === "block") {
                    video.style.display = "none";
                    videoClose.style.display = "block";
                    videoList.style.display = "block";
                    
                } else {
                    menuClose.style.display = "none";
                    videoList.style.display = "none";
                    menu.style.display = "block";
                }
            }

            /* Close result list dropdown */
            
            function closeVlist() {
                var video = document.getElementById("v-list-open");
                var videoClose = document.getElementById("v-list-close");
                var videoList = document.getElementById("video-list");
                if (videoClose.style.display === "block") {
                    video.style.display = "block";
                    videoClose.style.display = "none";
                    videoList.style.display = "none";
                } else {
                    menuClose.style.display = "block";
                    dropdown.style.display = "block";
                    menu.style.display = "none";
                }
            }
            
            function quizNotify() {
                document.getElementById("notify-modal").style.display = "block";
            }
            function quizClose() {
                document.getElementById("notify-modal").style.display = "none";
            }
            
            function openLogout(){
              document.getElementById("alert-logout").style.display = "block";  
            }
            function closeLogout(){
              document.getElementById("alert-logout").style.display = "none";  
            }
        </script>
        <script>
            var spinner = document.getElementById('ftco-loader');
            function preloader() {
                spinner.style.display = 'none';
            }
        </script>
    </body>
</html>
