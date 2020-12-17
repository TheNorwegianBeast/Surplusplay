<html>
    <?php
    $last_completed_mission = $mission_compl_count;
    if($last_completed_mission!="")
    {
      $last_completed_mission;  
    }  else {
        //  decode for redirect
      $last_completed_mission = rawurldecode($this->encrypt->decode($last_completed_mission));
    }

    $last_mission = $last_completed_mission + 1;
    $status = $budget_status;
    $curr_mission = $mission_compl_count;
    $m1 = 1;
    $m2 = 2;
    $m3 = 3;
    $m4 = 4;
    $last_mission = $this->encrypt->encode($last_mission);
    $enc1 = $this->encrypt->encode($m1);
    $enc2 = $this->encrypt->encode($m2);
    $enc3 = $this->encrypt->encode($m3);
    $enc4 = $this->encrypt->encode($m4);
    ?>
    <head>
        <meta charset="UTF-8">
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <script src="<?php echo base_url(); ?>/application/views/app/asset/js/jquery3.4.1.js"></script>
        <script src="<?php echo base_url(); ?>/application/views/app/asset/js/fontawesome5.js"></script>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/map_one.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/player_dashboard_resultlist.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/user_header.css" rel="stylesheet" type="text/css"/>
        <script>
            function gotoMainDashboard() {
                window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home";
            }


               function gotoDashboard1() {
                window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc1; ?>/<?php echo $last_mission; ?>";
                    }

                    function gotoDashboard2() {
                        window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc2; ?>/<?php echo $last_mission; ?>";
                            }

                            function gotoDashboard3() {
                                window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc3; ?>/<?php echo $last_mission; ?>";
                                    }

                                    function gotoDashboard4() {
                                        window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc4; ?>/<?php echo $last_mission; ?>";
                                            }



                                            function nextLevel() {
                                                var frthMission = document.getElementById("cityFourComp").value;

                                                if (frthMission == 1) {
                                                    window.location = "<?php echo base_url(); ?>app_controller/Dashboard/show_map2_redirect/completed/<?php echo  $this->encrypt->encode($curr_mission); ?>";
                                                            }
                                                        }


        </script>
    </head>
    <body onload="preloader();">
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <div class="division">
            <div class="container"> 
                <div class="header">

                </div>
                <div class="navigation">
                    <?php
                    if ($this->session->userdata('role_id') == 5) {
                        include_once APPPATH . 'views/app/asset/header/map_header.php';
                    } else {
                        include_once APPPATH . 'views/app/asset/header/player_dashboard_map.php';
                    }
                    ?>
                </div>
                <div class="section">
                    <div class="left-section">

                        <!--partition-left-->
                        <div id="img-map1-div1"></div>
                        <!--partition-left ends-->
                    </div>
                    <div class="middle-section">
                        <!--central-partitions-->
                        <div id="img-map2-div2-wrapper">
                            <div id="mapcontainer">
                                <?php
                                /* mission one started */
                                if ($m1 == $last_completed_mission && $status != "completed") {
                                    ?>
                                    <!--first city-->
                                    <div id="box1">
                                        <img class="bergen-icon" onClick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERGEN_1.png"
                                             alt=""/>
                                    </div>

                                    <?php
                                }

                                /* mission one completed */
                                if ($m1 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- first city -->

                                    <div id="box1">
                                        <img class="bergen-icon" onClick="gotoDashboard1();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERGEN_1.png"
                                             alt=""/>
                                    </div>


                                    <!-- 2nd city -->

                                    <div id="box2">
                                        <img class="berlin-icon" onClick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERLIN_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- Arrow bergen to berlin -->
                                    <div class="arrow-area">
                                        <img class="top-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/top.png" alt=""/>
                                    </div>
                                    <?php
                                }

                                /* mission two completed */
                                if ($m2 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- first city -->

                                    <div id="box1">
                                        <img class="bergen-icon" onClick="gotoDashboard1();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERGEN_1.png"
                                             alt=""/>
                                    </div>


                                    <!-- 2nd city -->
                                    <div class="rowsecond">
                                        <div id="box2">
                                            <img class="berlin-icon" onClick="gotoDashboard2();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERLIN_1.png"
                                                 alt=""/>
                                        </div>
                                    </div>
                                    <!-- Arrow bergen to berlin -->
                                    <div class="arrow-area">
                                        <img class="top-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/top.png" alt=""/>
                                    </div>

                                    <!-- Arrow berlin to milan -->

                                    <div class="innerbox">
                                        <img class="center-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/center.png" alt=""/>
                                    </div>


                                    <!-- 3rd city -->
                                    <div id="box3">
                                        <img class="milan-icon" onClick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/MILAN_1.png"
                                             alt=""/>
                                    </div>

                                    <?php
                                }
                                /* mission three completed */
                                if ($m3 == $last_completed_mission && $status == "completed") {
                                    ?>

                                    <input type="hidden" id="cityFourComp" value="0">
                                    <!-- first city -->

                                    <div id="box1">
                                        <img class="bergen-icon" onClick="gotoDashboard1();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERGEN_1.png"
                                             alt=""/>
                                    </div>


                                    <!-- 2nd city -->
                                    <div class="rowsecond">
                                        <div id="box2">
                                            <img class="berlin-icon" onClick="gotoDashboard2();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERLIN_1.png"
                                                 alt=""/>
                                        </div>
                                    </div>
                                    <!-- Arrow bergen to berlin -->
                                    <div class="arrow-area">
                                        <img class="top-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/top.png" alt=""/>
                                    </div>

                                    <!-- Arrow berlin to milan -->
                                    <div class="innerbox">
                                        <img class="center-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/center.png" alt=""/>
                                    </div>

                                    <!-- 3rd city -->
                                    <div id="box3">
                                        <img class="milan-icon" onClick="gotoDashboard3();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/MILAN_1.png" alt=""/>
                                    </div>

                                    <!-- Arrow Milan to Istanbul -->
                                    <div class="milan2istanbul">
                                        <img class="bottom-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/bottom.png" alt=""/>
                                    </div>

                                    <!-- 4th city -->
                                    <div class="box4">
                                        <img class="istanbul-icon" onClick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/ISTANBUL_1.png"
                                             alt=""/>
                                    </div>
                                    <?php
                                }
                                /* mission 4th started */
                                if ($m4 <= $last_completed_mission && $status == "completed") {
                                    ?>
                                    <input type="hidden" id="cityFourComp" value="1">
                                    <!--first city-->

                                    <div id="box1">
                                        <img class="bergen-icon" onClick="gotoDashboard1();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERGEN_1.png" alt=""
                                             style="pointer-events: auto;cursor: pointer;position: relative;"/>
                                    </div>


                                    <!-- 2nd city -->
                                    <div class="rowSecond">
                                        <div id="box2">
                                            <img class="berlin-icon" onClick="gotoDashboard2();"
                                                 src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BERLIN_1.png" alt="" style="pointer-events: auto;cursor:
                                                 pointer;position: relative;"/>
                                        </div>
                                    </div>
                                    <!-- Arrow bergen to berlin -->
                                    <div class="arrow-area">
                                        <img class="top-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/top.png" alt=""/>
                                    </div>

                                    <!-- Arrow berlin to milan -->
                                    <div class='row-intermediate'>
                                        <div class="innerbox">
                                            <img class="center-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/center.png" alt=""/>
                                        </div>
                                    </div>

                                    <!-- 3rd city -->
                                    <div class="rowthird">
                                        <div id="box3">
                                            <img class="milan-icon" onClick="gotoDashboard3();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/MILAN_1.png"
                                                 alt=""/>
                                        </div>
                                    </div>

                                    <!-- Arrow Milan to Istanbul -->
                                    <div class="milan2istanbul">
                                        <img class="bottom-arrow" src="<?php echo base_url(); ?>/application/views/asset/image/map/bottom.png" alt=""/>
                                    </div>

                                    <!-- 4th city -->
                                    <div class="box4">
                                        <img class="istanbul-icon" onClick="gotoDashboard4();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/ISTANBUL_1.png"
                                             alt=""/>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!--central-partitions-ends-->
                    </div>
                    <div class="right-section">
                        <div id="ImgMap3Div3">

                            <?php if ($m4 <= $last_completed_mission && $status == "completed") { ?>
                                <a href="#"><button class="NxtlvlbtnActive" onclick="nextLevel();" type="submit">Next Level&nbsp;&nbsp;<i
                                            class="fas fa-arrow-right"></i></button></a>

                            <?php } else { ?>
                                <button class="Nxtlvlbtn">Next Level&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
                            <?php } ?>
                            <div id="RowMap">
                                <div id="col_Half_Map">
                                    <div class="Mini_box"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="footer"></div>
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


