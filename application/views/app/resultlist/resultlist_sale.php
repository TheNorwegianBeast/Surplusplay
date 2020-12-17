<html>
    <head>
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/resultlist.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/resultlist_data.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/quiz_start.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/player_dashboard_resultlist.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/user_header.css" rel="stylesheet" type="text/css"/>
    </head>
    <body onload="preloader();">
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <div class="division">
            <div class="container">

                <!-- Top red border -->
                <div class="header"> </div>
                <!-- Top red border End -->


                <div class="section">
                    <div class="line-div">
                        <div class="nav-header">
                            <?php
                            if ($role_id == 5) {
                                include_once APPPATH . 'views/app/asset/header/resultlist_header.php';
                            } else {
                                include_once APPPATH . 'views/app/asset/header/player_dashboard_resultlist.php';
                            }
                            ?>
                        </div>
                        <div class="resultlist-title">
                            <label>SALES</label>
                        </div>
                        <div class="resultlist-data">
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
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BERGEN_1.png" alt="Bergen city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>BERGEN</label>
                                </div>
                            </div>
                            <div class="r-berlin-div">
                                <div class="r-city-two">
                                   <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BERLIN_1.png" alt="Berlin city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>BERLIN</label>
                                </div>
                            </div>
                            <div class="r-milan-div">
                                <div class="r-city-three">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/MILAN_1.png" alt="Milan city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>MILAN</label>
                                </div>
                            </div>
                            <div class="r-istanbul-div">
                                <div class="r-city-four">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/ISTANBUL_1.png" alt="Istanbul city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>ISTANBUL</label>
                                </div>
                            </div>
                            <div class="r-dubai-div">
                                <div class="r-city-one">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/DUBAI_1.png" alt="Dubai city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>DUBAI</label>
                                </div>
                            </div>
                            <div class="r-taskkent-div">
                                <div class="r-city-two">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/TASKKENT_1.png" alt="Taskkent city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>TASKKENT</label>
                                </div>
                            </div>
                            <div class="r-islamabad-div">
                                <div class="r-city-three">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/ISLAMABAD_1.png" alt="Islamabad city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>ISLAMABAD</label>
                                </div>
                            </div>
                            <div class="r-delhi-div">
                                <div class="r-city-four">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/NEW_DELHI_1.png" alt="New Delhi city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>NEW DELHI</label>
                                </div>
                            </div>
                            <div class="r-bangkok-div">
                                <div class="r-city-one">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BANGKOK_1.png" alt="Bangkok city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>BANGKOK</label>
                                </div>
                            </div>
                            <div class="r-singapore-div">
                                <div class="r-city-two">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/SINGAPORE_1.png" alt="Singapore city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>SINGAPORE</label>
                                </div>
                            </div>
                            <div class="r-beijing-div">
                                <div class="r-city-three">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/BEIJING_1.png" alt="Beijing city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>BEIJING</label>
                                </div>
                            </div>
                            <div class="r-tokyo-div">
                                <div class="r-city-four">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/porsche_city/TOKYO.jpg" alt="Tokyo city" height="100%" width="100%"/>
                                </div>
                                <div class="r-city-name">
                                    <label>TOKYO</label>
                                </div>
                            </div>
                           
                        </div>
                        <div class="resultlist-table">
                            <?php
                                foreach ($res_report_data as $value) {
                                    ?>
                              <div class="tbl-row">
                                <div class="tbl-user">
                                    <label>
                                        <?php echo $value->rank_no .' '. $value->first_name ?>
                                    </label>
                                </div>
                                <div class="data-one">
                                    <label>
                                        <?php 
                                                    if( $value->mission1 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission1;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-two">
                                    <label>
                                        <?php 
                                                    if( $value->mission2 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission2;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-three">
                                    <label>
                                        <?php 
                                                    if( $value->mission3 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission3;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-four">
                                    <label>
                                        <?php 
                                                    if( $value->mission4 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission4;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-five">
                                    <label>
                                        <?php 
                                                    if( $value->mission5 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission5;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-six">
                                    <label>
                                        <?php 
                                                    if( $value->mission6 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission6;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-seven">
                                    <label>
                                        <?php 
                                                    if( $value->mission7 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission7;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-eight">
                                    <label>
                                        <?php 
                                                    if( $value->mission8 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission8;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-nine">
                                    <label>
                                        <?php 
                                                    if( $value->mission9 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission9;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-ten">
                                    <label>
                                        <?php 
                                                    if( $value->mission10 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission10;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-eleven">
                                    <label>
                                        <?php 
                                                    if( $value->mission11 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission11;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                <div class="data-twelve">
                                    <label>
                                        <?php 
                                                    if( $value->mission12 == 0){
                                                    echo ' ';
                                                    }else{
                                                      echo $value->mission12;
                                                    }
                                                    ?>
                                    </label>
                                </div>
                                
                            </div>
                            <?php
                                        }
                                        ?>
                        </div>
                    </div>
                    <div class="resultlist-img">
                        <img src="<?php echo base_url(); ?>application/views/app/asset/image/resultlist-img.png" alt="" height="100%" width="100%"/>
                    </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            /* Open result list dropdown */
            function openList() {
                document.getElementById("menu-icon").style.display = "none";
                document.getElementById("menu-close").style.display = "block";
                document.getElementById("dropdown-list").style.display = "block";
            }

            /* Close result list dropdown */
            function closeList() {
                document.getElementById("menu-icon").style.display = "block";
                document.getElementById("menu-close").style.display = "none";
                document.getElementById("dropdown-list").style.display = "none";
            }
            /* Close resultlist on outside click */
            $(document).mouseup(function (e) {
                var container = $("#dropdown-list");
                if (!container.is(e.target) &&
                        container.has(e.target).length === 0) {
                    container.hide();
                    document.getElementById('menu-icon').style.display = 'block';
                    document.getElementById('menu-close').style.display = 'none';
                }
            });
            
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
