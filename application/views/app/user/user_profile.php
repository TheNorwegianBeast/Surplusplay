<html>
    <head>
        <?php require_once APPPATH . 'views/app/asset/header/links.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/user_profile.css" rel="stylesheet" type="text/css"/>
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
                <div class="header">

                </div>
                <!-- Top red border End -->


                <div class="dash-section">
                    <div class="line-div">
                        <div class="nav-header">
                            <?php
                            //  include_once APPPATH . 'views/app/asset/header/player_profile_header.php';
                            if ($this->session->userdata('role_id') == 5) {
                                include_once APPPATH . 'views/app/asset/header/player_profile_header.php';
                            } else {
                                include_once APPPATH . 'views/app/asset/header/manager_profile_header.php';
                            }
                            ?>
                        </div>
                        <div class="section">
                            <div class="page-section">
                                <div class="porsche-page">
                                    <div class="user-profile-label">
                                        <label>User Profile</label>
                                    </div>
                                    <div class="profile_details">
                                        <?php
                                        foreach ($game_name as $row) {
                                            ?>
                                            <div class="game-row">
                                                <label class="text-lbl">Game Name </label>
                                                <input class="select-game" value="<?php echo $row->game_name; ?>"readonly="" >
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <!--                                        <div class="game-row">
                                                                                    <label>Game Name </label>
                                                                                    <input class="select-game" readonly="" >
                                                                                </div>-->
                                        <div class="login-row">
                                            <?php
                                            foreach ($user_data as $value) {
                                                $role_id = $value->role_id;
                                                if (($role_id == "4,5") || ($role_id == "5,4")) {
                                                    $role_name = 'Manager,Player';
                                                } else {
                                                    $role_name = $value->role_name;
                                                    ?>
                                                    <label class="text-lbl">Login Name </label>
                                                    <input class="select-game" value="<?php echo $value->login_name; ?>" readonly="">
                                                </div>
                                                <div class="userident-row">
                                                    <label class="text-lbl">Userident </label>
                                                    <input class="select-game" value="<?php echo $value->userident; ?>" readonly="">
                                                </div>
                                                <div class="first-name-row">
                                                    <label class="text-lbl">First Name </label>
                                                    <input class="select-game" value="<?php echo $value->first_name; ?>"readonly="">
                                                </div>
                                                <div class="last-name-row">
                                                    <label class="text-lbl">Last Name </label>
                                                    <input class="select-game" value="<?php echo $value->last_name; ?>" readonly="">
                                                </div>
                                                <div class="email-row">
                                                    <label class="text-lbl">Email </label>
                                                    <input class="select-game" value="<?php echo $value->email; ?>" readonly="">
                                                </div>
                                                <div class="role-row">
                                                    <label class="text-lbl">Game Role </label>
                                                    <input class="select-game" value="<?php echo $role_name; ?>"readonly="">
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="footer"></div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            function quizNotify() {
                document.getElementById("notify-modal").style.display = "block";
            }
            function quizClose() {
                document.getElementById("notify-modal").style.display = "none";
                timerStart();
                getQuiz();
            }
        </script>
        <script>
            /* Open result list dropdown */
            function openList()
            {
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
            function closeList()
            {
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

            $(document).mouseup(
                    function (e) {
                        var container = $("#dropdown-list");
                        if (!container.is(e.target)
                                && container.has(e.target).length === 0
                                ) {
                            container.hide();
                            document.getElementById('menu-icon').style.display = 'block';
                            document.getElementById('menu-close').style.display = 'none';
                        }
                    }
            );

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
