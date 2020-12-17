<html>
    <head>
        <?php require_once APPPATH . 'views/app/asset/header/links.php'; ?>
        <script src="<?php echo base_url(); ?>/application/views/app/asset/js/jquery3.4.1.js"></script>
        <link href="<?php echo base_url(); ?>/application/views/app/asset/css/congratulation.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/application/views/asset/css/fonts_styling.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>application/views/app/asset/css/dropdown.css" rel="stylesheet" type="text/css"/>
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
                <!--navigation header-->
                <div class="navigation">
                    <?php
                    if ($this->session->userdata('role_id') == 5) {
                        include_once APPPATH . 'views/app/asset/header/congratulation_header.php';
                    } else {
                        include_once APPPATH . 'views/app/asset/header/player_dashboard_congrats.php';
                    }
                    ?>
                </div>

                <!--navigation header ends-->
                <?php
                $total_que = 0;
                $correct_ans = 0;
                $wrong_ans = 0;
                $image = '';
                $que_no = 0;
                $given_ans = '';
                $ans_status = '';
                $points = 0;

                $in_que_no = 0;
                $in_given_ans = '';
                $in_ans_status = '';
                $in_points = 0;
                $in_que_lbl = '';
                $in_que_ans = '';
                $CI = & get_instance();
                $CI->load->model('Quiz_model');
                foreach ($que_count as $row3) {
                    $total_que = $row3->question_count;
                }
                foreach ($ans_count as $row4) {
                    $correct_ans = $row4->counts;
                }
                foreach ($in_count as $row5) {
                    $wrong_ans = $row5->counts;
                }
                foreach ($attempt_mission as $row) {
                    $image = $row->congrats_img;
                }
                ?>
                <div class="section">
                    <div class="left-section">
                        <!--partition-left-->
                        <div class="knowledge-title"><span class="title-text">Knowledge car achievement</span></div>
                        <div class="knowledge-image"><img src="<?php echo base_url(); ?>/application/views/asset/image/congrats_img/<?php echo $image; ?>" width="100%" height="100%"/></div>
                        <!--partition-left ends-->
                    </div>

                    <div class="middle-section">
                        <!--central-partitions-->
                        <div class="r-div01">
                            <div class="inside01">
                                <div class="div-text01"><?php echo $correct_ans; ?>/<?php echo $total_que; ?></div>
                            </div>
                        </div>

                        <div class="r-div1-inside01">
                            <div class="div-text02">Correct Answers</div>
                        </div>

                        <div id="quiz-result1">

                            <?php
                            foreach ($trans_data as $row6) {
                                $que_no = $row6->question_no;
                                $given_ans = $row6->given_answer;
                                $ans_status = $row6->answer_status;
                                $points = $row6->answer_point;


                                $agiven_answer = "Option_" . strtolower($given_ans);

                                $result = $CI->Quiz_model->fetch_solved_question($game_id, $mission_id, $que_no, $agiven_answer);
                                foreach ($result as $row8) {
                                    ?>

                                    <div class="correct-que-Label">
                                        <label><?php echo $row8->question_label; ?></label>
                                    </div>
                                    <div class="correct-ans-Label">
                                        <label><?php echo $row8->givenanswer; ?></label>
                                    </div>
                                    <br>

                                    <?php
                                }
                            }
                            ?>

                        </div>
                        <!--central-partitions-ends-->
                    </div>

                    <div class="right-section">
                        <div class="R-div1">
                            <div class="inside1">
                                <div class="div-text"><?php echo $wrong_ans; ?>/<?php echo $total_que; ?></div>
                            </div>
                        </div>

                        <div class="R-div1-inside2">
                            <div class="div-text2">Wrong answers</div>

                        </div>

                        <div id="quiz-result" style="overflow-y: auto;">
                            <?php
                            foreach ($in_trans_data as $row7) {
                                $in_que_no = $row7->question_no;
                                $in_given_ans = $row7->given_answer;
                                $in_ans_status = $row7->answer_status;
                                $in_points = $row7->answer_point;

                                if ($in_given_ans != '') {
                                    $in_given_answer = "Option_" . strtolower($in_given_ans);
                                    $result2 = $CI->Quiz_model->fetch_solved_question($game_id, $mission_id, $in_que_no, $in_given_answer);
                                    foreach ($result2 as $row9) {
                                        ?>
                                        <div class="wrong-que-label">
                                            <label><?php echo $row9->question_label; ?></label>
                                        </div>

                                        <div class="wrong-ans-label" style="width:87%;">
                                            <label><?php echo $row9->givenanswer; ?></label>
                                        </div>
                                        <br>
                                        <?php
                                    }
                                } else {
                                    $result3 = $CI->Quiz_model->fetch_question_by_id($game_id, $mission_id, $in_que_no);
                                    foreach ($result3 as $row1) {
                                        ?>
                                        <div class="wrong-que-label">
                                            <label><?php echo $row1->question_label; ?></label>
                                        </div>
                                        <div class="wrong-ans-label" style="width:87%;">
                                            <label><?php echo "Not Answered"; ?></label>
                                        </div>
                                        <br>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <a href="<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home">
                            <button class="btn-dashboard">Back to Dashboard</button>
                        </a>
                    </div>
                </div>
                <div class="footer"></div>
            </div>
        </div>
        <!-- Script for dropdown -->
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
