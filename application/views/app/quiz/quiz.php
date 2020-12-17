<html>
    <head>
        <?php require_once APPPATH . 'views/app/asset/header/links.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/quiz.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/quiz_start.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/player_dashboard_resultlist.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/header/css/user_header.css" rel="stylesheet" type="text/css"/>
        <?php
        $userident = $this->session->userdata('user');
        $game_id = $this->session->userdata('game_id');
        $mission_id = $mis_id;
        $start = 1;
        $end = '';
        $background_image = '';
        $trans_id = 0;
        $time_limit = '';


        $data_quiz = $this->Quiz_model->fetch_mission_quiz($game_id, $mission_id);
        foreach ($data_quiz as $row_quiz) {

            $background_image = $row_quiz->city_name;
            $end = $row_quiz->total_question;
            $time_limit = $row_quiz->time_limit;
        }


        // fetch questions 
        $data_question = $this->Quiz_model->fech_question($game_id, $mission_id);
        $question_array = array();
        foreach ($data_question as $row_question) {
            array_push($question_array, $row_question->question_id);
        }
        shuffle($question_array);
        ?>
        <script>
            var myArray = [];
            var newArray = [];
        </script>
        <?php
        for ($j = 0; $j <= $end; $j++) {
            ?>
            <script>
                var item =<?php echo $question_array[$j]; ?>;
                myArray.push(item);
            </script>
            <?php
        }

        for ($i = 0; $i <= $end; $i++) {
            ?>
            <script>
                var item =<?php echo $question_array[$i]; ?>;
                newArray.push(item);
            </script>
            <?php
        }
        ?> 
        <script>

            //This two global Variable is used for validations, please dont Remove it.
            var val = 0;
            var fstQue = 0;

            /*Ajax Request Object */
            function createRequestObject() {
                var tmpXmlHttpObject;
                if (window.XMLHttpRequest) {
                    tmpXmlHttpObject = new XMLHttpRequest();
                } else if (window.ActiveXObject) {
                    tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
                }
                return tmpXmlHttpObject;
            }

            var http = createRequestObject();

            var idvalue = 0;
            var tcount = 0;
            var counter = 0;
            var clicks = 0;
            var cancelOk = 0;
            var missionId =<?php echo $mission_id; ?>;
            newArray.unshift(0);  // add zero in first index

            /* Ajax page for quiz */
            function getQuiz() {
                clicks += 1;
                sendCounter = idvalue;
                questionId = myArray[sendCounter];
                questionAnswerId = newArray[sendCounter];

                tcount = document.getElementById("txttranscnt").value;


                // user_ans = document.getElementById("user_ans").value;
                if (cancelOk === 0) {
                    user_ans = document.getElementById("user_ans").value;
                } else {
                    user_ans = "";
                }

                http.open('get', '<?php echo base_url(); ?>app_controller/Quiz/quiz_ajax?m=' + missionId + '&q=' + questionId + '&qans=' + questionAnswerId + '&ans=' + user_ans + '&tc=' + tcount + '&c=' + counter);
                idvalue = idvalue + 1;
                http.onreadystatechange = processResponseQuiz;
                http.send(null);

                // test finish condiion 
                if (counter > <?php echo $end; ?>) {
                    // alert("Test Finished!");
                    window.location.href = '<?php echo base_url(); ?>app_controller/Quiz/quiz_cal_res?tc=' + tcount + '&m=' + missionId;
                } else {
                }
                counter++;
                // quiz end condition
                if (clicks > <?php echo $end; ?>) {
                    // alert("===click=="+clicks);
                    window.location.href = '<?php echo base_url(); ?>app_controller/Quiz/gquiz/' + tcount + '/' + missionId;
                }

            }

            function processResponseQuiz() {
                if (http.readyState == 4) {
                    var response = http.responseText;
                    document.getElementById('quizDiv').innerHTML = response;
                }
            }

            /* radio button event and given answer */
            function myvalue(control) {
                document.getElementById("user_ans").value = control.value;
            }

            /* Timer Code */
            var seconds = 60 *<?php echo $time_limit; ?>;
            function secondPassed() {

                var minutes = Math.round((seconds - 30) / 60);
                var remainingSeconds = seconds % 60;
                if (remainingSeconds < 10) {
                    remainingSeconds = "0" + remainingSeconds;
                }
                document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;

                if (seconds == 0) {
                    window.location.href = "<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home";

                } else {
                    seconds--;
                }
            }

            function timerStart() {
                var countdownTimer = setInterval('secondPassed()', 1000);
            }

            /* Function for Cancel button flag */
            function cancelFlag() {
                cancelOk = 1;
            }

            /* Function for Submit button flag  */
            function submitFlag() {
                cancelOk = 0;
            }

            /* Cancel Button Function  */
            function cancelButton(form) {
                cancelFlag();
                getQuiz();
            }

            /* Radion button option should chekced */
            function radioValidate(form) {
                ErrorText = "";
                if ((form.options[0].checked == false) && (form.options[1].checked == false) && (form.options[2].checked == false) && (form.options[3].checked == false)) {
                    document.getElementById('err-msg').innerHTML = "Please select option.";
                    return false;
                } else {
                    getQuiz();
                    return true;
                }
                if (ErrorText = "") {
                    getQuiz();
                    form.submit();
                }
            }

        </script>
    </head>
    <body onload="preloader();quizNotify();">
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="100px" height="100px"><circle class="path-bg" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="50" cy="50" r="30" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cc0000"/></svg>
        </div>
        <?php
        // update transaction count 
        try {
            $transaction_count = $this->Quiz_model->fetch_last_transc_count($game_id);
            foreach ($transaction_count as $row_transc) {
                $trans_id = $row_transc->trans_id;
                $trans_id = $trans_id + 1;
                // update transaction count.
                $this->Quiz_model->update_transaction_count($game_id, $trans_id);
            }


            // Get updated count of quiz transaction id
            $transaction_count = $this->Quiz_model->fetch_last_transc_count($game_id);
            foreach ($transaction_count as $row_transc) {
                $trans_id = $row_transc->trans_id;
            }
        } catch (Exception $ex) {
            log_message($ex->getTraceAsString());
            return;
        }
        ?>

        <input type="hidden" value="<?php echo $trans_id; ?>" name="txttranscnt" id="txttranscnt">
        <input type="hidden" id="user_ans">

        <div class="division">
            <div class="container">

                <!-- Top red border -->
                <div class="header">
                    <!-- Modal for notification -->
                    <div class="quiz-modal" id="notify-modal" >
                        <div class="quiz-notify">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <p align="center">Do you want to start Quiz?</p>
                                <button id="start-quiz" class="start" onclick="quizClose();">Start</button>
                                <a href="<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home">
                                    <button class="close" style="float:right">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Top red border End -->


                <div class="dash-section">
                    <div class="line-div">
                        <div class="nav-header">
                            <?php
                            if ($this->session->userdata('role_id') == 5) {
                                include_once APPPATH . 'views/app/asset/header/quiz_header.php';
                            } else {
                                include_once APPPATH . 'views/app/asset/header/player_dashboard_quiz.php';
                            }
                            ?>
                        </div>
                        <div class="section">
                            <div class="car-timer">
                                <div class="quiz-car">

                                    <?php
                                    //Get updated count of quiz transaction id
                                    try {
                                        $knowledge_count = $this->Quiz_model->fetch_badge_map_user_count($game_id, $userident);
                                        foreach ($knowledge_count as $res_know_count) {
                                            $map_count = $res_know_count->map_count;
                                            if ($map_count == 0) {
                                                ?>
                                                <img src="<?php echo base_url(); ?>application/views/asset/image/knowledge_level/F.gif" alt="" height="100%" width="100%"/>
                                                <?php
                                            } else {
                                                $knowledge_image = $this->Quiz_model->fetch_knowledge_badge_mapping($game_id, $userident);
                                                foreach ($knowledge_image as $res_know) {
                                                    $image_map = $res_know->badge_qz_img;
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>application/views/asset/image/knowledge_level/<?php echo $image_map; ?>" alt="" height="100%" width="100%"/>
                                                    <?php
                                                }
                                            }
                                        }
                                    } catch (Exception $ex) {
                                        log_message($ex->getTraceAsString());
                                        return;
                                    }
                                    ?>
                                </div>
                                <div class="quiz-timer">
                                    <label id="countdown">2:00</label>
                                </div>
                            </div>
                            <!-- ajax call -->
                            <div id="quizDiv">

                            </div>
                            <!-- ajax call end -->
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
