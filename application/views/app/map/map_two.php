<html>
    <head>
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <script src="<?php echo base_url(); ?>/application/views/app/asset/js/jquery3.4.1.js"></script>
        <script src="<?php echo base_url(); ?>/application/views/app/asset/js/fontawesome5.js"></script>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/map_two.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/map_media_file.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/player_dashboard_resultlist.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/user_header.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php
    $last_completed_mission = $mission_compl_count;
//    if($last_completed_mission!=""){
//        echo "First entered";
//        
//    }else {
//        echo "First Nooooooooooooot entered";
//    }
    $last_completed_mission2 = $last_completed_mission;
    if ($last_completed_mission2 > 8) {
        $last_completed_mission2 = 8;
    }

    $curr_mission = $curr_mission;
    if ($curr_mission == "") {
        $curr_mission = $last_completed_mission2;
    }
    $last_mission_cnt = $this->encrypt->encode($last_completed_mission);
    $last_mission = $last_completed_mission + 1;
    $last_mission = $this->encrypt->encode($last_mission);
    $status = $budget_status;
    $m4 = 4;
    $m5 = 5;
    $m6 = 6;
    $m7 = 7;
    $m8 = 8;
    $enc5 = $this->encrypt->encode($m5);
    $enc6 = $this->encrypt->encode($m6);
    $enc7 = $this->encrypt->encode($m7);
    $enc8 = $this->encrypt->encode($m8);
    ?>
    <script>


        function gotoMainDashboard() {
            window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home";
        }

   function gotoDashboard5() {
            window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc5; ?>/<?php echo $last_mission; ?>";
                }

                function gotoDashboard6() {
                    window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc6; ?>/<?php echo $last_mission; ?>";
                        }

                        function gotoDashboard7() {
                            window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc7; ?>/<?php echo $last_mission; ?>";
                                }

                                function gotoDashboard8() {
                                    window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc8; ?>/<?php echo $last_mission; ?>";
                                        }

    </script>
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
                        <div id="img-map1-div1">
                            <button class="bcklvl-btn" onclick="PrevLevel();"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back
                                Level
                            </button>
                        </div>
                        <!--partition-left ends-->
                    </div>
                    <div class="middle-section">
                        <!--central-partitions-->
                        <div id="img-map2-div2_wrapper">
                            <div id="mapcontainer">

                                <?php
                                //.... mission 4 completed, mission 5 started
                                if ($m4 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- City 5 -->
                                    <div class="division2-obj3">
                                        <img class="dubai-city1" onClick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/DUBAI_1.png" alt="" width="100%" height="100%"/>
                                    </div>

                                    <?php
                                }
                                // mission 5 completed
                                if ($m5 == $last_completed_mission && $status == "completed") {
                                    ?>


                                    <!-- City 5 -->
                                    <div class="rowr1">
                                        <div class="division5-r1">
                                            <a href="#"><img class="TaskCity" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/TASKKENT_1.png" onClick="gotoMainDashboard();" alt=""/></a>
                                        </div>
                                    </div>

                                    <!--Arrow Dubai to taskkent -->
                                    <div class="division2-r2">
                                        <img class="arrow-dubai2task" src="<?php echo base_url(); ?>/application/views/asset/image/map/Dubai2Taskent.png" alt=""/>
                                    </div>
                                    <!--City 6 -->
                                    <div class="division2-obj3">
                                        <img class="dubai-city1" onClick="gotoDashboard5();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/DUBAI_1.png" alt=""/>
                                    </div>


                                    <?php
                                }
                                // mission 6 completed
                                if ($m6 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- City 5 -->
                                    <div class="rowr1">
                                        <div class="division5-r1">
                                            <a href="#"><img class="TaskCity" onClick="gotoDashboard6();"
                                                             src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/TASKKENT_1.png" alt=""/> </a>
                                        </div>
                                    </div>


                                    <!-- Arrow Dubai to taskkent -->
                                    <div class="division2-r2">
                                        <img class="arrow-dubai2task" src="<?php echo base_url(); ?>/application/views/asset/image/map/Dubai2Taskent.png" alt=""/>
                                    </div>
                                    <!--                                    City 6 -->
                                    <div class="division2-obj3">
                                        <img class="dubai-city1" onClick="gotoDashboard5();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/DUBAI_1.png" alt=""/>
                                    </div>


                                    <!-- Arrow  taskkent to Isalamabad-->
                                    <div class="arrr-task2-islam">
                                        <img class="task2-islamimg" src="<?php echo base_url(); ?>/application/views/asset/image/map/Task2Islam.png" style="" alt=""/>
                                    </div><!--

                                                     City 6-->
                                    <div class="division4-r4">
                                        <img class="islamabad-city" onClick="gotoMainDashboard();"
                                             src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/ISLAMABAD_1.png" alt=""/>
                                    </div>

                                    <?php
                                }
// mission 7 completed
                                if ($m7 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- City 5 -->
                                    <input type="hidden" id="cityEightComp" value="0">
                                    <div class="division2-obj3">
                                        <a href="#"><img class="dubai-city1" onClick="gotoDashboard5();"
                                                         src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/DUBAI_1.png" alt=""/></a>
                                    </div>

                                    <div class="division2-r2">
                                        <img class="arrow-dubai2task" src="<?php echo base_url(); ?>/application/views/asset/image/map/Dubai2Taskent.png" alt=""/>
                                    </div>
                                    <!--                                     City 6 -->
                                    <div class="rowr1">
                                        <div class="division5-r1">
                                            <a href="#"><img class="TaskCity" onClick="gotoDashboard6();"
                                                             src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/TASKKENT_1.png" alt=""/> </a>
                                        </div>
                                    </div>

                                    <!--City 6-->
                                    <div class="division4-r4">
                                        <img class="islamabad-city" onClick="gotoDashboard7();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/ISLAMABAD_1.png"
                                             alt=""/>
                                    </div>


                                    <!--                                 Arrow  taskkent to Isalamabad-->
                                    <div class="arrr-task2-islam">
                                        <img class="task2-islamimg" src="<?php echo base_url(); ?>/application/views/asset/image/map/Task2Islam.png" alt=""/>
                                    </div>

                                    <!-- City 6 -->
                                    <!--                                 Arrow   Isalamabad to Delhi-->
                                    <div class="division6-box1">
                                        <img class="arr-islam2-delhi" src="<?php echo base_url(); ?>/application/views/asset/image/map/Islam2Delhi.png" alt=""/>
                                    </div>

                                    <!--                                                                 City 8-->
                                    <div class="division7-box1">
                                        <img class="delhi-city1" onClick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/NEW_DELHI_1.png"
                                             alt=""/>
                                    </div>

                                    <?php
                                }
                                // mission 5 stated
                                if ($m8 <= $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- City 5 -->
                                    <input type="hidden" id="cityEightComp" value="1">
                                    <div class="division2-obj3">
                                        <a href="#"><img class="dubai-city1" onClick="gotoDashboard5();"
                                                         src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/DUBAI_1.png" alt=""/></a>
                                    </div>


                                    <div class="division2-r2">
                                        <img class="arrow-dubai2task" src="<?php echo base_url(); ?>/application/views/asset/image/map/Dubai2Taskent.png" alt=""/>
                                    </div>


                                    <div class="rowr1">
                                        <div class="division5-r1">
                                            <a href="#"><img onClick="gotoDashboard6();"
                                                             src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/TASKKENT_1.png" alt="" width="100%" height="100%"/> </a>
                                        </div>
                                    </div>

                                    <!-- Arrow  taskkent to Isalamabad-->
                                    <div class="division4-r4">
                                        <img class="islamabad-city" onClick="gotoDashboard7();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/ISLAMABAD_1.png"
                                             alt=""/>
                                    </div>


                                    <!--Arrow  taskkent to Isalamabad-->
                                    <div class="arrr-task2-islam">
                                        <img class="task2-islamimg" src="<?php echo base_url(); ?>/application/views/asset/image/map/Task2Islam.png" alt=""/>
                                    </div>

                                    <!-- City 6 -->
                                    <!--Arrow   Isalamabad to Delhi-->
                                    <div class="division6-box1">
                                        <img class="arr-islam2-delhi" src="<?php echo base_url(); ?>/application/views/asset/image/map/Islam2Delhi.png" alt=""/>
                                    </div>

                                    <!-- City 8-->
                                    <div class="division7-box1">
                                        <img class="delhi-city1" onClick="gotoDashboard8();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/NEW_DELHI_1.png"
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
                            <?php if ($m8 <= $last_completed_mission && $status == "completed") { ?>
                                <button class="NxtlvlbtnActive" onclick="NextLevelT();">Next Level&nbsp;&nbsp;<i
                                        class="fas fa-arrow-right"></i></button>
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


        </script>

        <script>
            function PrevLevel() {
                window.location = "<?php echo base_url(); ?>app_controller/Dashboard/show_map1_redirect/completed/<?php echo $this->encrypt->encode($last_completed_mission); ?>";
                    }
                    function NextLevelT() {
                        var frthMission = document.getElementById("cityEightComp").value;
                        if (frthMission == 1) {
                            window.location = "<?php echo base_url(); ?>app_controller/Dashboard/show_map3_redirect/completed/<?php echo $this->encrypt->encode($last_completed_mission);?>";
                                    }
                                }


                                function openLogout() {
                                    document.getElementById("alert-logout").style.display = "block";
                                }
                                function closeLogout() {
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
