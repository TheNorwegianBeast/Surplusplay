
<html>
    <head>
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/manager_resultlist.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/header/css/player_manager_header.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/application/views/app/asset/header/css/manager_header.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" type="text/javascript">

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

            function ajaxResultlist() {
                var resultlistType = document.getElementById("select_resultlist").value;
                var selectTeam = document.getElementById("select_team").value;

                if (resultlistType == "scoreboard")
                {
                    document.getElementById("head_title").innerHTML = "Scoreboard";
                    http1.open('get', '<?php echo base_url(); ?>app_controller/Manager_resultlist/manager_scoreboard_resultlist?tm=' + selectTeam);
                } else if (resultlistType == "sales")
                {
                    document.getElementById("head_title").innerHTML = "Sales";
                    http1.open('get', '<?php echo base_url(); ?>app_controller/Manager_resultlist/manager_sales_resultlist?tm=' + selectTeam);
                } else if (resultlistType == "testDrive")
                {
                    document.getElementById("head_title").innerHTML = "Test Drive";
                    http1.open('get', '<?php echo base_url(); ?>app_controller/Manager_resultlist/manager_test_drive_resultlist?tm=' + selectTeam);
                } else if (resultlistType == "knowledge")
                {
                    document.getElementById("head_title").innerHTML = "Knowledge";
                    http1.open('get', '<?php echo base_url(); ?>app_controller/Manager_resultlist/manager_knowledge_resultlist?tm=' + selectTeam);
                }
                http1.onreadystatechange = processResponseajax;
                http1.send(null);
            }
            function processResponseajax()
            {
                if (http1.readyState == 4)
                {
                    var response = http1.responseText;
                    document.getElementById("divtable").innerHTML = response;
                }

            }
            ;
        </script>
    </head>
    <body onload="preloader();ajaxResultlist();">
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <div class="division">
            <div class="container">
                <!-- Top red border -->
                <div class="header">

                </div>
                <!-- Top red border End -->


                <div class="section">
                    <div class="line-div">
                        <div class="m-left-side">
                            <div class="nav-header">
                                <div class="porsche-logo">
                                    <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/porsche-logo.png" alt="" height="100%" width="100%"/>
                                </div>
                            </div>

                            <div class="dashboard-section">
                               <div class="icon-section">
                                    <!--header-left-->
                                    <?php if ($role_id == 4) {
                                        include_once APPPATH . 'views/app/asset/header/manager_resultlist.php';
                                    } else {
                                        include_once APPPATH . 'views/app/asset/header/user_manager_resultlist.php';
                                    }
                                    ?>
                                    <!--header-left-->
                                </div>
                                <div class="data-section">
                                    <div class="dropdown-data">
                                        <div class="drop-result">
                                            <select class="select-resultlist" id="select_resultlist" onchange="ajaxResultlist();">
                                                <option class="opt-result" value="scoreboard">Scoreboard</option>
                                                <option  value="sales">Sales</option>
                                                <option  value="testDrive">Test Drive</option>
                                                <option  value="knowledge">Knowledge</option>
                                            </select>
                                        </div>


                                        <div class="drop-team">
                                            <select class="select-resultlist" id="select_team" onchange="ajaxResultlist();">
                                                <option value="">Select User</option>
<?php
foreach ($manager_result as $value) {
    ?> 
                                                    <option value="<?php echo $value->userident; ?>"><?php echo $value->first_name . " " . $value->last_name; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>

                                        <label class="rl-title" id="head_title">Scoreboard</label>
                                    </div>
                                    <div class="reg-data">
                                        <div class="level-div">
                                            <div class="level-one">
                                                <label class="level-txt">Level 1</label>
                                            </div>
                                            <div class="level-two">
                                                <label class="level-txt">Level 2</label>
                                            </div>
                                            <div class="level-three">
                                                <label class="level-txt">Level 3</label>
                                            </div>
                                        </div>
                                        <div class="result-city">
                                            <div class="r-bergen-div">
                                                <div class="r-city-one">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BANGKOK_1.png" 
                                                         alt="" width="100%" height="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>BERGEN</label>
                                                </div>
                                            </div>
                                            <div class="r-berlin-div">
                                                <div class="r-city-two">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BERLIN_1.png"
                                                         alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>BERLIN</label>
                                                </div>
                                            </div>
                                            <div class="r-milan-div">
                                                <div class="r-city-three">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/MILAN_1.png" alt="" height="100%" width="100%"/>

                                                </div>
                                                <div class="r-city-name">
                                                    <label>MILAN</label>
                                                </div>
                                            </div>
                                            <div class="r-istanbul-div">
                                                <div class="r-city-four">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/ISTANBUL_1.png" 
                                                         alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>ISTANBUL</label>
                                                </div>
                                            </div>
                                            <div class="r-dubai-div">
                                                <div class="r-city-one">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/DUBAI_1.png"
                                                         alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>DUBAI</label>
                                                </div>
                                            </div>
                                            <div class="r-taskkent-div">
                                                <div class="r-city-two">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/TASKKENT_1.png" alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>TASKKENT</label>
                                                </div>
                                            </div>
                                            <div class="r-islamabad-div">
                                                <div class="r-city-three">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/ISLAMABAD_1.png" alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>ISLAMABAD</label>
                                                </div>
                                            </div>
                                            <div class="r-delhi-div">
                                                <div class="r-city-four">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/NEW_DELHI_1.png" 
                                                         alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>NEW DELHI</label>
                                                </div>
                                            </div>
                                            <div class="r-bangkok-div">
                                                <div class="r-city-one">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BANGKOK_1.png" alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>BANGKOK</label>
                                                </div>
                                            </div>
                                            <div class="r-singapore-div">
                                                <div class="r-city-two">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/SINGAPORE_1.png" alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>SINGAPORE</label>
                                                </div>
                                            </div>
                                            <div class="r-beijing-div">
                                                <div class="r-city-three">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BEIJING_1.png" alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>BEIJING</label>
                                                </div>
                                            </div>
                                            <div class="r-tokyo-div">
                                                <div class="r-city-four">
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/TOKYO.jpg" alt="" height="100%" width="100%"/>
                                                </div>
                                                <div class="r-city-name">
                                                    <label>TOKYO</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="resultlist-table" id="divtable">
                                        </div>
                                    </div>
                                    <div class="journey-data">
                                        <img src="<?php echo base_url(); ?>application/views/app/asset/image/resultlist-img.png" alt="" height="100%" width="100%"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-right-side"></div>
                    </div>
                </div>


                <!-- Footer --> 
                <div class="footer"></div>

            </div>
        </div>

        <script>
            function openLogout(){
              document.getElementById("alert-logout").style.display = "block";  
            }
            function closeLogout(){
              document.getElementById("alert-logout").style.display = "none";  
            }

            var spinner = document.getElementById('ftco-loader');
            function preloader() {
                spinner.style.display = 'none';
            }
        </script>
    </body>
</html>
