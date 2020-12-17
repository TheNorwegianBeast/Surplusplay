<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <?php require_once APPPATH . 'views/app/asset/header/links.php'; ?>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/dashboard_manager.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/manager_journey.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/application/views/app/asset/header/css/player_manager_header.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/application/views/app/asset/header/css/manager_header.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>application/views/asset/js/jquery.min-3.3.1.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>application/views/asset/js/jquery-1.12.3.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>application/views/asset/js/jquery.min.js" type="text/javascript"></script>
        <!-- <script src="<?php echo base_url(); ?>application/views/app/asset/js/dash_manager.js" type="text/javascript"></script> -->
         <script>
        var tokenValue = '<?php echo $this->security->get_csrf_hash(); ?>';
        function reset_count() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>app_controller/Dashboard_manager/update_count',
                  data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': tokenValue
                },
                dataType: "json",
                cache: false,
                success: function(data) {
                    tokenValue = data.token;
                    if (data.response === true) {
                        $("#count_label").text("0");
                    }

                }
            });
        }
        
   </script>

        <script>
            function alterImage2() {
                document.getElementById("map_visible").style.display = "none";
                document.getElementById("table_map").style.display = "block";
            }

            function alterImage() {
                document.getElementById("map_visible").style.display = "block";
                document.getElementById("table_map").style.display = "none";
            }

            function changeEyeFromCross() {
                var currentRow = document.getElementById("current_row").value;
                currentRow = "alter_imgG" + currentRow;
                reply_click2(currentRow);
            }
            
             /* Ajax object creation for Get sale and test amount  for new and used */
            function createdRequestObjectSaleTestAmt() {
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
            var httpSaleTestAmt = createdRequestObjectSaleTestAmt();

            /* Ajax request for Trophy */
            function getTotSaleTest() {
                var   model = document.getElementById("model").value;
                var   type = document.getElementById("car_type").value;
                var   currDate = document.getElementById("curr_date").value;
                 var   user = document.getElementById("user").value;
                 var data = model + "~" + type + "~" + currDate + "~" + user;
                httpSaleTestAmt.open('get', '<?php echo base_url(); ?>app_controller/Dashboard_manager/get_sale_test?data=' + data);
                httpSaleTestAmt.onreadystatechange = processResponseSaleTestAmt;
                httpSaleTestAmt.send(null);
            }
            /* Ajax response for Trophy */
            function processResponseSaleTestAmt() {
                if (httpSaleTestAmt.readyState == 4) {
                    var response = httpSaleTestAmt.responseText;
                    document.getElementById('sale_test_amt_div').innerHTML = response;
                }
            }
        </script>
    </head>
<?php
$current_date = date("Y-m-d");
?>
    <body onload="preloader();getTotSaleTest();getJourney();">
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <input type="hidden" id="curr_date" value="<?php echo $current_date; ?>" >
        <input type="hidden" id="car_type" value="new">
        <input type="hidden" id="current_row" value="0">
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
                        </div>

                        <div class="dashboard-section">

                            <div class="icon-section">
                                <!--header-left-->
<?php
if ($role_id == 4) {
    include_once APPPATH . 'views/app/asset/header/manager_header.php';
} else {
    include_once APPPATH . 'views/app/asset/header/player_manager_header.php';
}
?>
                                <!--header-left-->
                            </div>
                            <div class="data-section">
                                <div class="dropdown-data">
                                    <div class="drop-result">
                                        <select class="select-box-sort-by" id="user" onchange="getTotSaleTest();">
                                            <option value="all">All Players</option>
<?php
foreach ($user_budget as $row_budget) {
    ?>
                                                <option value="<?php echo $row_budget->userident; ?>"><?php echo $row_budget->first_name . " " . $row_budget->last_name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="drop-team">
                                        <select class="select-box-knowledge" id="model" onchange="getTotSaleTest();">
                                            <option value="all">All Models</option>
<?php
foreach ($car_model as $row_model) {
    ?>
                                                <option value="<?php echo $row_model->car_model; ?>"><?php echo $row_model->car_model; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="reg-data">
                                    <!--sales and quatity couter block -->
                                    <div class="quantity-sale-counts">
                                        <div class="counts-status" id="sale_test_amt_div">
                                            <div class="section-count1">
                                                <div class="sale-row1">
                                                    <div class="heading1"><span class="heading1-txt">Sale amount</span></div>
                                                    <div class="heading2"><span class="heading2-txt">Quantity</span></div>
                                                </div>
                                                <div class="sale-row2">
                                                    <div class="heading3"><span class="heading3-txt" id="sale_amt">0</span></div>
                                                    <div class="heading4"><span class="heading4-txt" id="quantity_amt">0</span></div>
                                                </div>
                                                <div class="sale-row3">
                                                    <div class="heading5"><span class="heading5-txt" id="income_amt">0</span></div>
                                                    <div class="heading6"><span class="heading6-txt">Income this months</span></div>
                                                </div>
                                            </div>

                                            <div class="section-count-c2">
                                                <div class="sale-row1">
                                                    <div class="heading1"><span class="heading1-txt">Test Drive</span></div>
                                                    <div class="heading2"><span class="heading2-txt">Quantity</span></div>
                                                </div>
                                                <div class="sale-row2">
                                                    <div class="heading3"><span class="heading3-txt" id="test_amt">0</span></div>
                                                    <div class="heading4"><span class="heading4-txt" id="quantity_test">0</span></div>
                                                </div>
                                                <div class="sale-row3">
                                                    <div class="heading5"><span class="heading5-txt" id="income_test">0</span></div>
                                                    <div class="heading6"><span class="heading6-txt">Income this months</span></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="change-btn">
                                            <button class="new-label-btn  active btn" id="new_btn" onclick="NewCars();
                                                    getTotSaleTest();"> New Cars</button>
                                            <button class="used-label-btn btn" id="used_btn" onclick="UsedCars();
                                                    getTotSaleTest();"> Used Cars</button>
                                            <button class="new-used-btn btn" id="both_btn" onclick="BothCars();
                                                    getTotSaleTest();"> New and Used Cars</button>
                                        </div>
                                    </div>
                                    <!--end sales and quatity couter block-->
                                </div>
                                <div class="journey-data">
                                    <!--lower-section-->
                                    <div class="MDivJourney">
                                        <div class="grid-row-1">Game Journey</div>
                                        <div class="grid-row-2">

                                            <div class="grid-row-2-column1">
                                                <!--search box grids divisions-->
                                                <div class="search-box-grid">
                                                    <div class="search-div1">
                                                        <select class="select-box-knowledge" id="dropdown_result_list" onchange="getJourney();">
                                                            <option value="scoreboard">Scoreboard</option>
                                                            <option value="sale">Sale</option>
                                                            <option value="testdrive">Test Drive</option>
                                                            <option value="knowledge">Knowledge</option>
                                                        </select>
                                                    </div>

                                                    <div class="search-div2">
                                                        <select class="select-box-sort-by" id="sort_journey" onchange="checkSort();">
                                                            <option value="">Sort by</option>
                                                            <option value="rank">Rank</option>
                                                            <option value="mission">Mission</option>
                                                            <option value="level">Level</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--search box ends-->
                                                <div class="table-box-grid">
                                                    <!--table section 1st-->
                                                    <div class="tbl-rank-scroll">
                                                        <table class="tbl-ranking" id="journey_tbl" style="overflow-y: scroll">
                                                            <thead class="tbl-rank-header">
                                                                <tr>
                                                                    <th>Rank</th>
                                                                    <th></th>
                                                                    <th>Mission</th>
                                                                    <th>Level</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody class="tbl-ranking-body" id="tbody_team_journey">

                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <!--table section 1st ends-->
                                                </div>
                                            </div>
                                            <div class="grid-row-2-column2">
                                                <!--current changes below-->

                                                <div class="maps-div-block" id="map_visible" style="display: none;">
                                                    <img id="map_img1" src="<?php echo base_url(); ?>application/views/app/asset/icon/level-1.png" alt="" width="100%" height="100%" style="display: none;">
                                                    <img id="map_img2" src="<?php echo base_url(); ?>application/views/app/asset/icon/level-2.png" alt="" width="100%" height="100%" style="display: block;">
                                                    <img id="map_img3" src="<?php echo base_url(); ?>application/views/app/asset/icon/level-3.png" alt="" width="100%" height="100%" style="display: none;">
                                                </div>
                                                <!-- Ajax call div for background table-->
                                                <div class="ranking-records-data" id="table_map" style="display: block;">

                                                </div>
                                                <!--current changes below-->

                                                <!--table section 2nd ends-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--ends-->
                            </div>
                        </div>
                    </div>
                    <div class="m-right-side">
<?php
$n_count = '';
foreach ($not_count as $row3) {
    $n_count = $row3->not_count;
}
?>
                        <div class="notify-row">
                            <!-- Notification -->
                            <div class="notify-img">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/icon/notify-bell.png" alt="" width="100%" height="100%" />
                            </div>
                            <div class="notify-circle">
                                <label onclick="reset_count();" id="count_label"><?php echo $n_count; ?></label>
                            </div>
                        </div>

                        <div class="top-team-div">
                            <div class="team-img">
                                <img src="<?php echo base_url(); ?>application/views/app/asset/icon/best-2.png" alt="" width="100%" height="100%" />
                            </div>
                            <div class="top-team-txt">
                                <label>Top Team</label>
                            </div>
                            <div class="top-team-name">
<?php
foreach ($rank_user as $row2) {
    ?>
                                    <label><?php echo $row2->first_name . ' ' . $row2->last_name; ?></label>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="activity-div">
                            <label>Activity Feed</label>
                        </div>
                        <div class="feed-div">
<?php foreach ($sale_trans as $row) {
    ?>
                                <div class="feed-row">
                                    <div class="user-feed-div">
                                        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/User_Icon.png" alt="" height="100%" width="100%" />
                                    </div>
                                    <div class="feed-txt-div">
                                        <label class="feed-txt-name"><?php echo $row->first_name . ' ' . $row->last_name; ?></label>
                                        <label class="feed-txt-report">added a new <?php echo $row->trans_type; ?></label>
                                    </div>
                                </div>

<?php } ?>
                        </div>
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
