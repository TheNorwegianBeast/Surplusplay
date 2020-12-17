
<html>
    <head>
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/overview.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/quiz_start.css" rel="stylesheet" type="text/css"/>
    </head>
    <body onload="preloader();quizNotify();">
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <div class="division">
            <div class="container">

                <!-- Top red border -->
                <div class="header"></div>
                <!-- Top red border End -->


                <div class="dash-section">
                    <div class="line-div">
                        <div class="logo-row">
                            <div class="logo-div">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/porsche-logo.png" alt="" height="100%" width="100%"/>
                            </div>
                        </div>
                        <div class="page-row">
                            <div class="page-section">
                                <div class="porsche-page">
                            <div class="dash-row">
                                <div class="first-label">
                                    <a style="text-decoration: none;" href="<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home">
                                        <label class="lbl-overview">Dashboard</label>
                                    </a>
                                </div>
                            </div>
                            <div class="result-cover" id="result" style="display: block">
                                <div class="result-row">
                                    <div class="second-label" onclick="openToggle();">
                                       
                                            <label class="lbl-overview">Result lists</label>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="resultlist-cover" id="resultlist">
                                <div class="resulylist-row">
                                    <div class="third-label">
                                        <a style="text-decoration: none;" href="<?php echo base_url(); ?>app_controller/Resultlist/resultlist_test_drive">
                                        <label class="lbl-overview">Test Drive</label>
                                        </a>
                                    </div>
                                    <div class="fourth-label">
                                        <a style="text-decoration: none;" href="<?php echo base_url(); ?>app_controller/Resultlist/resultlist_sale">
                                            <label class="lbl-overview">Sales</label>
                                        </a>
                                    </div>
                                    <div class="fifth-label">
                                        <a style="text-decoration: none;" href="<?php echo base_url(); ?>app_controller/Resultlist/resultlist_knowledge">
                                        <label class="lbl-overview">Knowledge</label>
                                        </a>
                                    </div>
                                    <div class="sixth-label">
                                        <a style="text-decoration: none;" href="<?php echo base_url(); ?>app_controller/Resultlist/resultlist_scoreboard">
                                        <label class="lbl-overview">Scoreboard</label>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="map-row">
                                <div class="seventh-label">
                                    <a style="text-decoration: none;" href="<?php echo base_url(); ?>app_controller/Map_nav/last_mission">
                                        <label class="lbl-overview">Map</label>
                                    </a>
                                </div>
                            </div>
                            <div class="rule-row">
                                <div class="eighth-label">
                                    <a style="text-decoration: none;" href="<?php echo base_url(); ?>app_controller/Game_rule/game_rule">
                                        <label class="lbl-overview">Game Rules</label>
                                    </a>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="cars-row">
                            <div class="car-one">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/image/overview_car_1.png" alt="" height="100%" width="100%"/>
                            </div>
                            <div class="car-two">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/image/overview_car_2.png" alt="" height="100%" width="100%"/>
                            </div>
                            <div class="car-three">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/image/overview_car_3.png" alt="" height="100%" width="100%"/>
                            </div>
                            <div class="car-four">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/image/overview_car_4.png" alt="" height="100%" width="100%"/>
                            </div>
                            <div class="car-five">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/image/overview_car_5.png" alt="" height="100%" width="100%"/>
                            </div>
                            <div class="car-six">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/image/overview_car_6.png" alt="" height="100%" width="100%"/>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="footer"></div>
            </div>
        </div>
        <script>
            function openToggle() {
                var Result = document.getElementById("result");
                var data = document.getElementById("resultlist");
                
                    if (Result.style.display === "block") {
                        Result.style.display = "none";
                        data.style.display = "block";
                    }
                
            }

            function closeToggle() {
                var Result = document.getElementById("result");
                var data = document.getElementById("resultlist");
                if (data.style.display === "block") {
                    Result.style.display = "block";
                    data.style.display = "none";
                }
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



