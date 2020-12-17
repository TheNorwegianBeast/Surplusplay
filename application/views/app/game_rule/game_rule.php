<html>
    <head>
        <?php require_once(APPPATH . 'views/app/asset/header/links.php'); ?>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/game_rule.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/navigation_header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
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
                <div class="header">

                </div>
                <div class="navigation">
                    <?php
                    if ($this->session->userdata('role_id') == 5) {
                        include_once APPPATH . 'views/app/asset/header/congratulation_header.php';
                    } else {
                        include_once APPPATH . 'views/app/asset/header/player_dashboard_congrats.php';
                    }
                    ?>
                </div>

                <div class="section">
                    <div class="left-section">
                        <!--partition-left-->
                        <div class="nav-container">
                            <div class="divclass1">
                                <div class="wrapper-section1">
                                    <div class="wrapped-object1">
                                        <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/becar.png" alt="" width="100%" height="100%;"/>
                                    </div>
                                    <div class="line-bottom">
                                        <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/top_dashed_1.png" alt="" width="100%" height="100%;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="divclass2">
                                <div class="wrapper-section2"></div>
                                <div class="wrapped-object2">
                                    <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/bluecar.png" alt="" width="100%" height="100%;"/>
                                </div>
                            </div>
                            <div class="divclass3">
                                <div class="wrapper-section3"></div>
                                <div class="wrapped-object3">
                                    <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/yellowcar.png" alt="" width="100%" height="100%;"/>
                                </div>
                                <div class="Line-Bottom-Dashed3">
                                    <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/bottom_dashed_1.png" alt="" width="100%" height="100%;"/>
                                </div>
                            </div>
                        </div>
                        <!--partition-left ends-->
                    </div>

                    <div class="middle-section">
                        <!--central-partitions-->
                        <div class="main-wrapper-container">
                            <div id="game-heading"><strong id="noteheading">Game Rules</strong></div>
                            <div class="Notes-wrapper-scrollbar">
                                <div class="Notes">
                                    <p>lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sit amet ipsum
                                        tempor arcu iaculis ornare. Mauris purus risus, maximus vel mollis sed,
                                        bibendum in erat. Nunc bibendum dolor venenatis diam congue, at maximus nibh
                                        auctor. Aenean in orci ac augue posuere commodo vel nec odio. Sed molestie
                                        cursus dictum. Pellentesque suscipit libero quis odio tempor sagittis. Aliquam
                                        metus odio, scelerisque id dolor eu, venenatis ullamcorper quam.
                                        Vivamus egestas fringilla hendrerit. Sed nec ante venenatis, euismod leo nec, tempor
                                        augue.</p>

                                    <p>Etiam pellentesque nunc nec ultricies imperdiet. Nunc luctus urna purus, eget
                                        vulputate quam condimentum vitae. Pellentesque lectus elit, pretium id maximus
                                        quis, volutpat eu mi. Donec sit amet tincidunt nisl, id suscipit dolor. Sed lacinia
                                        augue nec libero tincidunt venenatis. Nulla interdum eget diam vel sodales.
                                        Suspendisse condimentum ullamcorper mauris, aliquet condimentum sapien
                                        ullamcorper sit amet. Donec mattis eget mi ac luctus. Vestibulum placerat felis ut
                                        augue sollicitudin, non fringilla ligula condimentum. Morbi porttitor leo orci, et
                                        volutpat ipsum lacinia a. Aliquam et sem a neque congue faucibus. Sed et mauris
                                        elit. Mauris mauris nisl, interdum id ornare vitae, eleifend vitae velit.
                                        Suspendisse nibh mauris, pharetra id ullamcorper a, hendrerit at risus. Interdum et malesuada
                                        fames ac ante ipsum primis in faucibus.</p>

                                    <p>Etiam pellentesque nunc nec ultricies imperdiet. Nunc luctus urna purus, eget
                                        vulputate quam condimentum vitae. Pellentesque lectus elit, pretium id maximus
                                        quis, volutpat eu mi. Donec sit amet tincidunt nisl, id suscipit dolor. Sed lacinia
                                        augue nec libero tincidunt venenatis. Nulla interdum eget diam vel sodales.
                                        Suspendisse condimentum ullamcorper mauris, aliquet condimentum sapien
                                        ullamcorper sit amet. Donec mattis eget mi ac luctus. Vestibulum placerat felis ut
                                        augue sollicitudin, non fringilla ligula condimentum. Morbi porttitor leo orci, et
                                        volutpat ipsum lacinia a. Aliquam et sem a neque congue faucibus. Sed et mauris
                                        elit. Mauris mauris nisl, interdum id ornare vitae, eleifend vitae velit.
                                        Suspendisse nibh mauris, pharetra id ullamcorper a, hendrerit at risus. Interdum et malesuada
                                        fames ac ante ipsum primis in faucibus.</p>
                                </div>
                            </div>
                        </div>
                        <!--central-partitions-ends-->
                    </div>
                    <div class="right-section">
                        <div class="aside-container">
                            <div class="divclass4">
                                <div class="wrapper-section4"></div>
                                <div class="wrapped-object4">
                                    <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/silvercar.png" alt="" width="100%" height="100%;"/>
                                </div>
                                <div class="Line_Bottom_Dashed4">
                                    <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/right_top_dashed_2.png" alt="" width="100%" height="100%;"/>
                                </div>
                            </div>
                            <div class="divclass5">
                                <div class="wrapper-section5"></div>
                                <div class="wrapped-object5">
                                    <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/whitecar.png" alt="" width="100%" height="100%;"/>
                                </div>
                            </div>
                            <div class="divclass6">
                                <div class="wrapper-section6"></div>
                                <div class="wrapped-object6">
                                    <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/cyancar.png" alt="" width="100%" height="100%;"/>
                                </div>
                                <div class="line-bottom-dashed6">
                                    <img src="<?php echo base_url(); ?>/application/views/asset/image/cars/right_bottom_dashed2.png" alt="" width="100%" height="100%;"/>
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
                var menu = document.getElementById("menu-icon");
                var menuClose = document.getElementById("menu-close");
                var dropdown = document.getElementById("dropdown-list");
                if (menu.style.display == "block") {
                    menu.style.display = "none";
                    menuClose.style.display = "block";
                    dropdown.style.display = "block";
                } else {
                    menuClose.style.display = "none";
                    dropdown.style.display = "none";
                    menu.style.display = "block";
                }
            }

            /* Close result list dropdown */
            function closeList() {
                var menu = document.getElementById("menu-icon");
                var menuClose = document.getElementById("menu-close");
                var dropdown = document.getElementById("dropdown-list");
                if (menuClose.style.display === "block") {
                    menu.style.display = "block";
                    menuClose.style.display = "none";
                    dropdown.style.display = "none";
                } else {
                    menuClose.style.display = "block";
                    dropdown.style.display = "block";
                    menu.style.display = "none";
                }
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
