<?php

    $curr_mission = 0;
    $CI = & get_instance();
    $CI->load->model('Dashboard_manager_model');
    $CI2 = & get_instance();
    $CI2->load->model('Mission_model');
    $trans = "";
    
foreach ($mission as $value) {
    $curr_mission = $value->mission_id;
}

if ($result_list_type == 'scoreboard') { 
    ?>
    <div class="div-block-top">
        <div class="div-block-top-inside">
            <img id="close_crosslogo" onclick="alterImage();changeEyeFromCross();" src="<?php echo base_url(); ?>application/views/app/asset/icon/delete-icon.png" alt="" width="100%" height="100%">
        </div>
        <div class="player-name-class">
            <div class="player-name-label">
                <span>Scoreboard</span> &nbsp;&nbsp;
                <span>Player name :
        <?php echo $user_name; ?></span></div>
        </div>
    </div>

    <div class="inside-tbl-rside">
        <div class="table-rside">
            <table class="table-wrap-contents">
                <thead class="table-head-contents">
                    <tr></tr>
                    <tr>
                        <th class="tablewrap-head headpos">
                            <div class="tbl-headname2">
                                <span>Mission</span></div>
                        </th>
                        <th class="tablewrap-head headpos">

                            <div class="name-align">
                                <span>Rank</span></div>
                        </th>
                        <th class="tablewrap-head headpos">
                            <div class="name-align">
                                <span>Points</span></div>
                        </th>
                        <th class="tablewrap-head headpos">
                            <div class="name-align">
                                <span>Time</span></div>
                        </th>
                        <th class="tablewrap-head headpos">
                            <div class="name-align" style="margin-left:-5%;">
                                <span>New</span></div>
                        </th>
                        <th class="tablewrap-head headpos" style="margin:0;padding: 0;">

                            <div class="name-align-last2">
                                <span>Used</span></div>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-body-contents">
                    <?php for ($i = 1; $i <= $curr_mission; $i++) { 
                        $result = $CI->Dashboard_manager_model->fetch_current_mission_rank_score_by_id($game_id, $user_id);
                        $str_rank = "mission" . $i;
                        foreach ($result as $row2) {
                        
                            if ($row2->$str_rank > 0) { 
                                ?>
                    <tr>
                        <td>
                                <?php
                                $result2 = $CI2->Mission_model->get_mission_by_id($game_id, $i);
                                foreach ($result2 as $row3) { 
                                    echo $i. ' ' .$row3->city_name;
                                }
                                ?>
                        </td>
                        <td>
                                <?php echo $row2->$str_rank; ?>
                        </td>
                        <td>
                                <?php $str_points = "points" . $i;
                                echo $row2->$str_points;
                                ?>
                        </td>
                        <td id="time-adjust">
                                <?php
                                $result3 = $CI->Dashboard_manager_model->fetch_comple_mission_id_by_name($i, $game_id, $user_id);
                                foreach ($result3 as $row4) { 
                                    echo $row4->last_completion_day;
                                }
                                ?>
                        </td>
                        <td>
                                <?php
                                $result4 = $CI->Dashboard_manager_model->fetch_user_sale_car_sum_qty($game_id, $i, $user_id, 1);
                                foreach ($result4 as $row5) { 
                                    if ($row5->sale_car_qty == '') {
                                        echo '0';
                                    } else {
                                        echo $row5->sale_car_qty;
                                    }
                                }
                                ?>
                        </td>
                        <td>
                                <?php
                                $result5 = $CI->Dashboard_manager_model->fetch_user_sale_car_sum_qty($game_id, $i, $user_id, 2);
                                foreach ($result5 as $row6) { 
                                    if ($row6->sale_car_qty == '') {
                                        echo '0';
                                    } else {
                                        echo $row6->sale_car_qty;
                                    }
                                }
                                ?>
                        </td>
                    </tr>
                            <?php } 
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php

} else if ($result_list_type == 'sale') {  ?>

        <div class="div-block-top">
            <div class="div-block-top-inside">
                <img id="close_crosslogo" onclick="alterImage();changeEyeFromCross();" src="<?php echo base_url(); ?>application/views/app/asset/icon/delete-icon.png" alt="" width="100%" height="100%">
            </div>
            <div class="player-name-class">
                <div class="player-name-label">
                    <span>Sale</span> &nbsp;&nbsp;
                    <span>Player name :
        <?php echo $user_name; ?></span></div>
            </div>
        </div>

        <div class="inside-tbl-rside">
            <div class="table-rside">
                <table class="table-wrap-contents">
                    <thead class="table-head-contents">
                        <tr></tr>
                        <tr>
                            <th class="tablewrap-head headpos">
                                <div class="tbl-headname2">
                                    <span>Mission</span></div>
                            </th>
                            <th class="tablewrap-head headpos">

                                <div class="name-align">
                                    <span>Rank</span></div>
                            </th>
                            <th class="tablewrap-head headpos">
                                <div class="name-align">
                                    <span>Points</span></div>
                            </th>
                            <th class="tablewrap-head headpos">
                                <div class="name-align">
                                    <span>Time</span></div>
                            </th>
                            <th class="tablewrap-head headpos">
                                <div class="name-align" style="margin-left:-5%;">
                                    <span>New</span></div>
                            </th>
                            <th class="tablewrap-head headpos" style="margin:0;padding: 0;">

                                <div class="name-align-last2">
                                    <span>Used</span></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-body-contents">
                        <?php for ($i = 1; $i <= $curr_mission; $i++) { 
                                $result = $CI->Dashboard_manager_model->fetch_current_mission_rank_score_by_id($game_id, $user_id);
                                $str_rank = "mission" . $i;
                            foreach ($result as $row2) {
                        
                                if ($row2->$str_rank > 0) { 
                                    ?>
                        <tr>
                            <td>
                                    <?php
                                                      $result2 = $CI2->Mission_model->get_mission_by_id($game_id, $i);
                                    foreach ($result2 as $row3) { 
                                        echo $i. ' ' .$row3->city_name;
                                    }
                                    ?>
                            </td>
                            <td>
                                    <?php echo $row2->$str_rank; ?>
                            </td>
                            <td>
                                    <?php $str_points = "points" . $i;
                                                      echo $row2->$str_points;
                                    ?>
                            </td>
                            <td id="time-adjust">
                                    <?php
                                    $result3 = $CI->Dashboard_manager_model->fetch_comple_sale_mission_id($i, $game_id, $user_id);
                                    foreach ($result3 as $row4) { 
                                        echo $row4->car_budget_complete_duration;
                                    }
                                    ?>
                            </td>
                            <td>
                                    <?php
                                      $result4 = $CI->Dashboard_manager_model->sum_of_new_sale_qty(1, 1, $user_id, $i);
                                    foreach ($result4 as $row5) { 
                                            echo $row5->sale_qty_new;
                                    }
                                    ?>
                            </td>
                            <td>
                                    <?php
                                      $result5 = $CI->Dashboard_manager_model->sum_of_new_sale_qty(1, 2, $user_id, $i);
                                    foreach ($result5 as $row6) { 
                                            echo $row6->sale_qty_new;
                                    }
                                    ?>
                            </td>
                        </tr>
                                <?php } 
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
} else if ($result_list_type == 'testdrive') {  ?>
            <div class="div-block-top">
                <div class="div-block-top-inside">
                    <img id="close_crosslogo" onclick="alterImage();changeEyeFromCross();" src="<?php echo base_url(); ?>application/views/app/asset/icon/delete-icon.png" alt="" width="100%" height="100%">
                </div>
                <div class="player-name-class">
                    <div class="player-name-label">
                        <span>Test Drive</span> &nbsp;&nbsp;
                        <span>Player name :
        <?php echo $user_name; ?></span></div>
                </div>
            </div>

            <div class="inside-tbl-rside">
                <div class="table-rside">
                    <table class="table-wrap-contents">
                        <thead class="table-head-contents">
                            <tr></tr>
                            <tr>
                                <th class="tablewrap-head headpos">
                                    <div class="tbl-headname2">
                                        <span>Mission</span></div>
                                </th>
                                <th class="tablewrap-head headpos">

                                    <div class="name-align">
                                        <span>Rank</span></div>
                                </th>
                                <th class="tablewrap-head headpos">
                                    <div class="name-align">
                                        <span>Points</span></div>
                                </th>
                                <th class="tablewrap-head headpos">
                                    <div class="name-align">
                                        <span>Time</span></div>
                                </th>
                                <th class="tablewrap-head headpos">
                                    <div class="name-align" style="margin-left:-5%;">
                                        <span>New</span></div>
                                </th>
                                <th class="tablewrap-head headpos" style="margin:0;padding: 0;">

                                    <div class="name-align-last2">
                                        <span>Used</span></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-body-contents">
                            <?php for ($i = 1; $i <= $curr_mission; $i++) { 
                                    $result = $CI->Dashboard_manager_model->fetch_current_mission_rank_score_by_id($game_id, $user_id);
                                    $str_rank = "mission" . $i;
                                foreach ($result as $row2) {
                        
                                    if ($row2->$str_rank > 0) { 
                                        ?>
                            <tr>
                                <td>
                                        <?php
                                                          $result2 = $CI2->Mission_model->get_mission_by_id($game_id, $i);
                                        foreach ($result2 as $row3) { 
                                            echo $i. ' ' .$row3->city_name;
                                        }
                                        ?>
                                </td>
                                <td>
                                        <?php echo $row2->$str_rank; ?>
                                </td>
                                <td>
                                        <?php $str_points = "points" . $i;
                                                          echo $row2->$str_points;
                                        ?>
                                </td>
                                <td id="time-adjust">
                                        <?php
                                        $result3 = $CI->Dashboard_manager_model->fetch_comple_test_mission_id($i, $game_id, $user_id);
                                        foreach ($result3 as $row4) { 
                                            echo $row4->testdrive_budget_complete_duration;
                                        }
                                        ?>
                                </td>
                                <td>
                                        <?php
                                        $result4 = $CI->Dashboard_manager_model->sum_of_new_sale_qty(2, 1, $user_id, $i);
                                        foreach ($result4 as $row5) { 
                                            echo $row5->sale_qty_new;
                                        }
                                        ?>
                            </td>
                            <td>
                                        <?php
                                        $result5 = $CI->Dashboard_manager_model->sum_of_new_sale_qty(2, 2, $user_id, $i);
                                        foreach ($result5 as $row6) { 
                                            echo $row6->sale_qty_new;
                                        }
                                        ?>
                            </td>
                            </tr>
                                    <?php } 
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
} else if ($result_list_type == 'knowledge') {  ?>
                <div class="div-block-top">
                    <div class="div-block-top-inside">
                        <img id="close_crosslogo" onclick="alterImage();changeEyeFromCross();" src="<?php echo base_url(); ?>application/views/app/asset/icon/delete-icon.png" alt="" width="100%" height="100%">
                    </div>
                    <div class="player-name-class">
                        <div class="player-name-label">
                            <span>Knowledge</span> &nbsp;&nbsp;
                            <span>Player name :
        <?php echo $user_name; ?></span></div>
                    </div>
                </div>

                <div class="inside-tbl-rside">
                    <div class="table-rside">
                        <table class="table-wrap-contents">
                            <thead class="table-head-contents">
                                <tr></tr>
                                <tr>
                                    <th class="tablewrap-head headpos">
                                        <div class="tbl-headname2">
                                            <span>Mission</span></div>
                                    </th>
                                    <th class="tablewrap-head headpos">

                                        <div class="name-align">
                                            <span>Rank</span></div>
                                    </th>
                                    <th class="tablewrap-head headpos">
                                        <div class="name-align">
                                            <span>Points</span></div>
                                    </th>
                                    <th class="tablewrap-head headpos">
                                        <div class="name-align">
                                            <span>Attempts</span></div>
                                    </th>
                                    <th class="tablewrap-head headpos">
                                        <div class="name-align" style="margin-left:-5%;">
                                            <span>Points</span></div>
                                    </th>
                                    <!-- <th class="tablewrap-head headpos" style="margin:0;padding: 0;">

                                        <div class="name-align-last2">
                                            <span>Used</span></div>
                                    </!-->
                                </tr>
                            </thead>
                            <tbody class="table-body-contents">
                                <?php for ($i = 1; $i <= $curr_mission; $i++) { 
                                    $result = $CI->Dashboard_manager_model->fetch_current_mission_rank_score_by_id($game_id, $user_id);
                                    $str_rank = "mission" . $i;
                                    foreach ($result as $row2) {
                        
                                        if ($row2->$str_rank > 0) { 
                                            ?>
                                <tr>
                                    <td>
                                            <?php
                                            $result2 = $CI2->Mission_model->get_mission_by_id($game_id, $i);
                                            foreach ($result2 as $row3) { 
                                                echo $i. ' ' .$row3->city_name;
                                            }
                                            ?>
                                    </td>
                                    <td>
                                            <?php echo $row2->$str_rank; ?>
                                    </td>
                                    <td>
                                            <?php $str_points = "points" . $i;
                                            echo $row2->$str_points;
                                            ?>
                                    </td>
                                    <td id="attempt-adjust">
                                            <?php
                                            $result3 = $CI->Dashboard_manager_model->fetch_attempted_quiz_count($game_id, $user_id, $i);
                                            foreach ($result3 as $row4) { 
                                                echo $row4->attempted_count;
                                            }
                                            ?>
                                    </td>
                                    <td>
                                            <?php
                                            /*  Fetch last attempted quiz. */
                                            $result4 = $CI->Dashboard_manager_model->fetch_last_attempted_quiz($game_id, $user_id, $i);
                                            foreach ($result4 as $row5) { 
                                                $trans = $row5->trans_id;
                                            }

                                            /* fetch correct answers */
                                            $result5 = $CI->Dashboard_manager_model->fetch_count_correct_answer($game_id, $trans, $i);
                                            foreach ($result5 as $row6) { 
                                                echo $row6->answer_count;
                                            }
                                            ?>/
                                            <?php
                                            /*  Fetch total question */
                                            $result6 = $CI->Dashboard_manager_model->fetch_total_question_count($game_id, $i);
                                            foreach ($result6 as $row7) { 
                                                echo $row7->question_count;
                                            }
                                            ?>
                                    </td>
                                    <!-- <td>2</td> -->
                                </tr>
                                        <?php }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
}
?>
