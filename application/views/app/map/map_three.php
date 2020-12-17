<html>
    <?php
    $last_completed_mission = $mission_compl_count;
    $status = $budget_status;

    $curr_mission = $curr_mission;
    if ($curr_mission == "") {
        $curr_mission = $last_completed_mission;
    }
    $curr_mission = $this->encrypt->encode($curr_mission);
    $last_mission = $last_completed_mission + 1;
    $last_mission = $this->encrypt->encode($last_mission);
    $m8 = 8;
    $m9 = 9;
    $m10 = 10;
    $m11 = 11;
    $m12 = 12;
    $enc9 = $this->encrypt->encode($m9);
    $enc10 = $this->encrypt->encode($m10);
    $enc11 = $this->encrypt->encode($m11);
    $enc12 = $this->encrypt->encode($m12);
    ?>
    <head>
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <script src="<?php echo base_url(); ?>/application/views/app/asset/js/jquery3.4.1.js"></script>
        <script src="<?php echo base_url(); ?>/application/views/app/asset/js/jquery3.4.1.js"></script>
        <script src="<?php echo base_url(); ?>/application/views/app/asset/js/fontawesome5.js"></script>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/map_three.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/player_dashboard_resultlist.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/user_header.css" rel="stylesheet" type="text/css"/>
        <script>
            function gotoMainDashboard() {
                window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home";
            }


            function gotoDashboard9() {
                window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc9; ?>/<?php echo $last_mission; ?>";
                    }

                    function gotoDashboard10() {
                        window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc10; ?>/<?php echo $last_mission; ?>";
                            }

                            function gotoDashboard11() {
                                window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc11; ?>/<?php echo $last_mission; ?>";
                                    }

                                    function gotoDashboard12() {
                                        window.location = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_rediect/<?php echo $enc12; ?>/<?php echo $last_mission; ?>";
                                            }


                                            function PrevLevel() {
                                                window.location = "<?php echo base_url(); ?>app_controller/Dashboard/show_map2_redirect/completed/<?php echo $curr_mission; ?>";
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
                        <div id="img-map1-div1">
                            <button class="bcklvl-btn" onclick="PrevLevel();"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back
                                Level
                            </button>
                        </div>

                        <!--partition-left ends-->
                    </div>
                    <div class="middle-section">
                        <!--central-partitions-->
                        <div id="imgmap2-div2_wrapper">
                            <div id="mapcontainer">
                                <?php
                                /* mission 8 completed, mission 9 started */
                                if ($m8 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- City 9 -->
                                    <div class="box1-bangkok">
                                        <img class="bangkok-img" onclick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BANGKOK_1.png"
                                             alt=""/>
                                    </div>

                                    <?php
                                }


                                /* mission 9 completed */
                                if ($m9 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- City 9 -->

                                    <div class="box1-bangkok">
                                        <img class="bangkok-img" onclick="gotoDashboard9();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BANGKOK_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- Arrow Bankok to singapure -->
                                    <div class="arr-bankok2sing">
                                        <img class="bang2sing" src="<?php echo base_url(); ?>/application/views/asset/image/map/Bang2Sing.png" alt=""/>
                                    </div>
                                    <!-- City 10 -->
                                    <div class="singaporediv">
                                        <img class="singapore-img" onclick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/SINGAPORE_1.png"
                                             alt=""/>
                                    </div>

                                    <?php
                                }

                                /* mission 10 completed */
                                if ($m10 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <div class="box1-bangkok">
                                        <img class="bangkok-img" onclick="gotoDashboard9();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BANGKOK_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- Arrow Bankok to singapure -->
                                    <div class="arr-bankok2sing">
                                        <img class="bang2sing" src="<?php echo base_url(); ?>/application/views/asset/image/map/Bang2Sing.png" alt=""/>
                                    </div>
                                    <!-- City 10 -->
                                    <div class="singaporediv">
                                        <img class="singapore-img" onclick="gotoDashboard10();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/SINGAPORE_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- Arrow singapure to Bejing -->
                                    <div class="box_sing2beijing">
                                        <img class="sing2bjing" src="<?php echo base_url(); ?>/application/views/asset/image/map/Sing2Beijing.png" alt=""/>
                                    </div>

                                    <div class="beijngbox">
                                        <img class="beijingimage" onclick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BEIJING_1.png"
                                             alt=""/>
                                    </div>

                                    <?php
                                }

                                /* mission 11 completed */
                                if ($m11 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- City 12 -->
                                    <div class="class-tokyo">
                                        <img class="tokyo-ico" onclick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/TOKYO.jpg" alt=""
                                             style="pointer-events: auto;cursor: pointer;position: relative;"/>
                                    </div>

                                    <!-- Arrow Bijing to tokyo -->
                                    <div class="bjing2tokyo">
                                        <img class="beijing2tokyo-ico" src="<?php echo base_url(); ?>/application/views/asset/image/map/Beijing2Tokyo.png" alt=""/>
                                    </div>

                                    <!-- City 11 -->
                                    <div class="beijngbox">
                                        <img class="beijingimage" onclick="gotoDashboard11();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BEIJING_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- City 9 -->
                                    <div class="box1-bangkok">
                                        <img class="bangkok-img" onclick="gotoDashboard9();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BANGKOK_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- Arrow Bankok to singapure -->
                                    <div class="arr-bankok2sing">
                                        <img class="bang2sing" src="<?php echo base_url(); ?>/application/views/asset/image/map/Bang2Sing.png" alt=""/>
                                    </div>

                                    <!-- City 10 -->
                                    <div class="singaporediv">
                                        <img class="singapore-img" onclick="gotoDashboard10();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/SINGAPORE_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- Arrow singapure to Bejing -->
                                    <div class="box_sing2beijing">
                                        <img class="sing2bjing" src="<?php echo base_url(); ?>/application/views/asset/image/map/Sing2Beijing.png" alt=""/>
                                    </div>
                                    <?php
                                }


                                /* mission 12 completed */
                                if ($m12 == $last_completed_mission && $status == "completed") {
                                    ?>
                                    <!-- City 12 -->
                                    <div class="class-tokyo">
                                        <img class="tokyo-ico" onclick="gotoMainDashboard();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/TOKYO.jpg" alt=""
                                             style="pointer-events: auto;cursor: pointer;position: relative;"/>
                                    </div>

                                    <!-- Arrow Bijing to tokyo -->
                                    <div class="bjing2tokyo">
                                        <img class="beijing2tokyo-ico" src="<?php echo base_url(); ?>/application/views/asset/image/map/Beijing2Tokyo.png" alt=""/>
                                    </div>

                                    <!-- City 11 -->
                                    <div class="beijngbox">
                                        <img class="beijingimage" onclick="gotoDashboard11();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BEIJING_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- City 9 -->
                                    <div class="box1-bangkok">
                                        <img class="bangkok-img" onclick="gotoDashboard9();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/BANGKOK_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- Arrow Bankok to singapure -->
                                    <div class="arr-bankok2sing">
                                        <img class="bang2sing" src="<?php echo base_url(); ?>/application/views/asset/image/map/Bang2Sing.png" alt=""/>
                                    </div>

                                    <!-- City 10 -->
                                    <div class="singaporediv">
                                        <img class="singapore-img" onclick="gotoDashboard10();" src="<?php echo base_url(); ?>/application/views/asset/image/porsche_city/SINGAPORE_1.png"
                                             alt=""/>
                                    </div>

                                    <!-- Arrow singapure to Bejing -->
                                    <div class="box_sing2beijing">
                                        <img class="sing2bjing" src="<?php echo base_url(); ?>/application/views/asset/image/map/Sing2Beijing.png" alt=""/>
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
