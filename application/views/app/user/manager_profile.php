<html>

    <head>
        <?php require_once APPPATH . 'views/app/asset/header/links.php'; ?>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/manager_profile.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/manager_journey.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/application/views/app/asset/header/css/player_manager_header.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/application/views/app/asset/header/css/manager_header.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/asset/js/jquery.min-3.3.1.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>application/views/asset/js/jquery-1.12.3.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>application/views/asset/js/jquery.min.js" type="text/javascript"></script>
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


                <div class="section">
                    <div class="m-left-side">
                        <div class="nav-header">
                            <div class="porsche-logo">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/porsche-logo.png" alt="" height="100%" width="100%" />
                            </div>
                            <div class="profile-lbl">
                                <label>Manager Profile</label>
                            </div>
                        </div>

                        <div class="dashboard-section">

                            <div class="icon-section">
                                <?php
                                /* Replace , with space */
                               $role_user = str_replace(',', '', $this->session->userdata('role_id'));
                               if ($role_user == 45 || $role_user == 54) {
                                    include_once APPPATH . 'views/app/asset/header/manager_player_profile.php';
                               } else {
                                   include_once APPPATH . 'views/app/asset/header/manager_profile_header.php';
                               }

                                ?>
                            </div>
                            <div class="data-section">
                                <div class="data-profile">
                                    <div class="profile_details">
                                        <div class="game-row">
                                            <?php
                                            foreach ($game_name as $row) {
                                                ?>   
                                                <label>Game Name </label>
                                                <input class="select-game" value="<?php echo $row->game_name ?>" readonly="" >
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="login-row">
                                            <?php
                                            foreach ($user_data as $value) {
                                                ?>
                                                <label>Login Name </label>
                                                <input class="select-game" value="<?php echo $value->login_name ?>"readonly="">
                                            </div>
                                            <div class="userident-row">
                                                <label>Userident </label>
                                                <input class="select-game" value="<?php echo $value->userident ?>" readonly="">
                                            </div>
                                            <div class="first-name-row">
                                                <label>First Name </label>
                                                <input class="select-game" value="<?php echo $value->first_name ?>" readonly="">
                                            </div>
                                            <div class="last-name-row">
                                                <label>Last Name </label>
                                                <input class="select-game" value="<?php echo $value->last_name ?>" readonly="">
                                            </div>
                                            <div class="email-row">
                                                <label>Email </label>
                                                <input class="select-game" value="<?php echo $value->email ?>" readonly="">
                                            </div>
                                            <div class="role-row">
                                                <label>Game Role </label>
                                                <?php
                                                   $role_name = "";
                                                if ($role_user == 4) {
                                                    $role_name = "Manager";
                                                } elseif ($role_user == 45 || $role_user == 54) {
                                                    $role_name = "Player, Manager";
                                                }

                                                ?>
                                                <input class="select-game" value="<?php echo $role_name ?>" readonly="">
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-right-side">

                    </div>
                </div>


                <!-- Footer -->
                <div class="footer"></div>

            </div>
        </div>


        <script>
            function NewCars()
            {
                var new_btn = document.getElementById("new_btn");
                var used_btn = document.getElementById("used_btn");
                var both_btn = document.getElementById("both_btn");
                new_btn.style.background = '#cc0000';
                used_btn.style.background = '#ccc';
                new_btn.style.color = '#fff';
                used_btn.style.color = '#000';
                both_btn.style.color = '#000';
                both_btn.style.background = '#ccc';
                /* Toggle Button code */
                var carType = document.getElementById("car_type");
                carType.value = "new";
            }

            function UsedCars()
            {
                var new_btn = document.getElementById("new_btn");
                var used_btn = document.getElementById("used_btn");
                var both_btn = document.getElementById("both_btn");
                new_btn.style.background = '#ccc';
                used_btn.style.background = '#cc0000';
                used_btn.style.color = '#fff';
                new_btn.style.color = '#000';
                both_btn.style.color = '#000';
                both_btn.style.background = '#ccc';
                /* Toggle Button code */
                var carType = document.getElementById("car_type");
                carType.value = "used";
            }

            function BothCars()
            {
                var new_btn = document.getElementById("new_btn");
                var used_btn = document.getElementById("used_btn");
                var both_btn = document.getElementById("both_btn");
                new_btn.style.background = '#ccc';
                used_btn.style.background = '#ccc';
                both_btn.style.color = '#fff';
                new_btn.style.color = '#000';
                used_btn.style.color = '#000';
                both_btn.style.background = '#cc0000';
                /* Toggle Button code */
                var carType = document.getElementById("car_type");
                carType.value = "all";
            }
        </script>
        <!-- search box suggestion -->
        <script>
            function searchList() {
                var input, filter, ul, li, a, i, txtValue;

                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }

            }
        </script>
        <!-- close search list -->
        <script>
            function show() {
                document.getElementById("myUL").style.display = "block";
            }

            function hide() {
                document.getElementById("myUL").style.display = "none";
            }
        </script>




        <script>
            /*  Object Request                */
            function createRequestObject() {
                var tmpXmlHttpObject;
                if (window.XMLHttpRequest) {
                    tmpXmlHttpObject = new XMLHttpRequest();
                } else if (window.ActiveXObject) {
                    tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
                }
                return tmpXmlHttpObject;
            }
            var http2 = createRequestObject();

            /* get journey data */

            function getJourney() {

                selectedValue = document.getElementById("dropdown_result_list").value;
                http2.open('get', '<?php echo base_url() ?>app_controller/Dashboard_manager/game_journey?s=' + selectedValue);
                http2.onreadystatechange = responseGetjourney;
                http2.send(null);

            }

            function responseGetjourney() {
                if (http2.readyState == 4) {
                    var response = http2.responseText;
                    // alert(response);
                    document.getElementById('tbody_team_journey').innerHTML = response;
                    tableReload();
                    document.getElementById("sort_journey").value = "rank";
                    checkSort();
                    alterImage();
                }
            }
        </script>

        <script>
            /* sorting function for journey table*/

            function checkSort() {
                var sortValue = document.getElementById("sort_journey").value;
                if (sortValue == "rank") {
                    sortTableRank();
                }
                if (sortValue == "mission") {
                    sortTableMission();
                }
                if (sortValue == "level") {
                    sortTableLevel();
                }
            }

            function sortTableRank() {
                var table, rows, switching, i, x, y, shouldSwitch;
                table = document.getElementById("journey_tbl");

                switching = true;
                while (switching) {

                    switching = false;
                    rows = table.rows;

                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;

                        x = rows[i].getElementsByTagName("TD")[0];
                        y = rows[i + 1].getElementsByTagName("TD")[0];


                        if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {

                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }

            function sortTableMission() {
                var table, rows, switching, i, x, y, shouldSwitch;
                var frstArr, scndArr;
                table = document.getElementById("journey_tbl");

                switching = true;
                while (switching) {

                    switching = false;
                    rows = table.rows;

                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;

                        x = rows[i].getElementsByTagName("TD")[2];
                        y = rows[i + 1].getElementsByTagName("TD")[2];

                        x = x.innerHTML;
                        y = y.innerHTML;
                        frstArr = x.split(">");
                        frstArr = frstArr[1];
                        frstArr = frstArr.split("<");
                        x = parseInt(frstArr[0]);

                        scndArr = y.split(">");
                        scndArr = scndArr[1];
                        scndArr = scndArr.split("<");
                        y = parseInt(scndArr[0]);

                        if (x > y) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {

                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }

            function sortTableLevel() {
                var table, rows, switching, i, x, y, shouldSwitch;
                table = document.getElementById("journey_tbl");

                switching = true;
                while (switching) {

                    switching = false;
                    rows = table.rows;

                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;

                        x = rows[i].getElementsByTagName("TD")[3];
                        y = rows[i + 1].getElementsByTagName("TD")[3];


                        if (x.innerHTML > y.innerHTML) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {

                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }
        </script>
        <script>
            var tableNew = document.getElementById('journey_tbl');

            for (var i = 1; i < tableNew.rows.length; i++) {
                var userRank, userName, userId, mission;
                tableNew.rows[i].onclick = function () {
                    if (this.cells[3].innerHTML == 1) {
                        document.getElementById("map_img1").style.display = "block";
                        document.getElementById("map_img2").style.display = "none";
                        document.getElementById("map_img3").style.display = "none";

                    } else if (this.cells[3].innerHTML == 2) {
                        document.getElementById("map_img2").style.display = "block";
                        document.getElementById("map_img1").style.display = "none";
                        document.getElementById("map_img3").style.display = "none";
                    }
                    if (this.cells[3].innerHTML == 3) {
                        document.getElementById("map_img3").style.display = "block";
                        document.getElementById("map_img1").style.display = "none";
                        document.getElementById("map_img2").style.display = "none";
                    }

                    userRank = this.cells[0].innerHTML;
                    userName = this.cells[1].innerHTML;
                    userId = $(this.cells[1]).attr('name');
                    mission = $(this.cells[2]).attr('name');
                    resultListType = document.getElementById("dropdown_result_list").value;
                    getUserJourneyDetails(userRank, userName, userId, mission, resultListType);

                };
            }

            function tableReload() {
                var userRank, userName, userId, mission;
                for (var i = 1; i < tableNew.rows.length; i++) {
                    tableNew.rows[i].onclick = function () {
                        if (this.cells[3].innerHTML == 1) {
                            document.getElementById("map_img1").style.display = "block";
                            document.getElementById("map_img2").style.display = "none";
                            document.getElementById("map_img3").style.display = "none";

                        } else if (this.cells[3].innerHTML == 2) {
                            document.getElementById("map_img2").style.display = "block";
                            document.getElementById("map_img1").style.display = "none";
                            document.getElementById("map_img3").style.display = "none";

                        }
                        if (this.cells[3].innerHTML == 3) {
                            document.getElementById("map_img3").style.display = "block";
                            document.getElementById("map_img1").style.display = "none";
                            document.getElementById("map_img2").style.display = "none";
                        }

                        userRank = this.cells[0].innerHTML;
                        userName = this.cells[1].innerHTML;
                        userId = $(this.cells[1]).attr('name');
                        mission = $(this.cells[2]).attr('name');
                        resultListType = document.getElementById("dropdown_result_list").value;
                        getUserJourneyDetails(userRank, userName, userId, mission, resultListType);
                    };
                }
            }



            /* get journey data */

            function getUserJourneyDetails(userRank, userName, userId, mission, resultListType) {
                http2.open('get', '<?php echo base_url() ?>app_controller/Dashboard_manager/user_journey?userName=' + userName + '&userRank=' + userRank + '&userId=' + userId + '&mission=' + mission + '&resultListType=' + resultListType);
                http2.onreadystatechange = responseUserJourneyDetails;
                http2.send(null);
            }

            function responseUserJourneyDetails() {
                if (http2.readyState == 4) {
                    var response = http2.responseText;
                    document.getElementById('table_map').innerHTML = response;
                }
            }

            function reply_click(clicked_id) {

                // alert(clicked_id);
                var imageR, imageG;
                imageR = clicked_id;
                var res = clicked_id.split("G");

                imageG = "alter_imgR" + res[1];
                document.getElementById(imageR).style.display = "none";
                document.getElementById(imageG).style.display = "block";

            }

            function reply_click2(clicked_id) {
                var currentOpenEye = document.getElementById("current_row").value;
                var currentClosedEye = currentOpenEye;
                if (currentOpenEye != 0) {
                    currentOpenEye = "alter_imgR" + currentOpenEye;
                    currentClosedEye = "alter_imgG" + currentClosedEye;
                    document.getElementById(currentOpenEye).style.display = "block";
                    document.getElementById(currentClosedEye).style.display = "none";
                }
                var imageR, imageG;
                imageG = clicked_id;
                var res = clicked_id.split("R");

                imageR = "alter_imgG" + res[1];
                document.getElementById(imageG).style.display = "none";
                document.getElementById(imageR).style.display = "block";
                document.getElementById("current_row").value = res[1];
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

            function preloader()
            {
                spinner.style.display = 'none';
            }
        </script>
    </body>

</html>
