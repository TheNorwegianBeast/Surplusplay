<?php
$mission_id = $_GET['m'];
$question_id = $_GET['q'];
$question_answ_id = $_GET['qans'];
$user_answer = $_GET['ans'];
$transaction_count = $_GET['tc'];
$end_counter = $_GET['c'];
$userident = $this->session->userdata('user');
$game_id = $this->session->userdata('game_id');

//echo "end count=".$end_counter." Question answer id= ".$question_answ_id." question id=".$question_id;
// echo "====count ===" . $transaction_count;
// echo "====mision " . $mission_id . "==q=" . $question_id . "===a ans ==" . $question_answ_id . "==cc answ=" . $user_answer;
$end = 0;
$correct_point = 0;
$data_quiz = $this->Quiz_model->fetch_mission_quiz($game_id, $mission_id);
foreach ($data_quiz as $row_quiz) {

    $end = $row_quiz->total_question;
    $correct_point = $row_quiz->per_correct_question_point;
}
$cnt = $end_counter + 1;
if ($end_counter > $end - 1) {
    
} else {
    $data_questions = $this->Quiz_model->fetch_question_by_id($game_id, $mission_id, $question_id);
    foreach ($data_questions as $row_question) {
        ?>

         <?php echo form_open(); ?>
            <?php
            $data_questions = $this->Quiz_model->fetch_question_by_id($game_id, $mission_id, $question_id);
            foreach ($data_questions as $row_question) {
                ?>



                <div class="quiz-section">
                    <div class="que-ans">
                        <div class="quiz-que">
                            <label><?php echo $row_question->question_label; ?></label>
                        </div>
                        <div class="quiz-ans">
                            <div class="input-group-one">
                                <label class="first-ans" tabindex="0">
                                    <input class="radio-btn" type="radio" id="opt1" name="options" onclick="myvalue(this);" value="A">
                                    <span><?php echo $row_question->option_a; ?></span>
                                </label>
                                <label class="second-ans" tabindex="0">
                                    <input class="radio-btn" type="radio" id="opt2" name="options" onclick="myvalue(this);" value="B">
                                    <span><?php echo $row_question->option_b; ?></span>
                                </label>
                            </div>
                            <div class="input-group-two">
                                <label class="third-ans" tabindex="0">
                                    <input class="radio-btn" type="radio" id="opt3" name="options" onclick="myvalue(this);" value="C">
                                    <span><?php echo $row_question->option_c; ?></span>
                                </label>
                                <label class="fourth-ans" tabindex="0">
                                    <input class="radio-btn" type="radio" id="opt4" name="options" onclick="myvalue(this);" value="D">
                                    <span><?php echo $row_question->option_d; ?></span>
                                </label>
                            </div>
                        </div>
                        <div class="quiz-btn">
                            <div class="atmp-que">
                                <text><?php echo $cnt . "/" . $end; ?></text>
                            </div>
                            <div class="select-opt">
                                <label id="err-msg"></label>
                            </div>
                            <input type="button" value="Cancel" class="cncl-btn" onclick="cancelButton(this.form);">
                            <!-- <button class="next-btn" onclick="getQuiz();>Next</button> -->
                            <input  type="button" name="Next" value="Next" class="next-btn" onclick="submitFlag();radioValidate(this.form);">
                        </div>
                    </div>
                </div>

                <!--<label id="err-msg"></label>-->
                <input type="hidden" name="user_ans" id="user_ans"/>
                <input type="hidden" name="txt_courseid" value="<?php echo $mission_id; ?>">
                <input type="hidden" name="txt_correctansw" value="<?php echo $row_question->correct_answer; ?>">
                <input type="hidden" name="txt_q" value="<?php echo $question_id; ?>">
                <input type="hidden" name="txt_useransw" value="<?php echo $user_answer; ?>">
                <input type="hidden" name="txt_a" value="<?php echo $question_answ_id; ?>">
                <?php
            }
            ?>

        <?php echo form_close();?>


        <?php
    }
}

try {


    if ($question_answ_id > 0 && $end_counter != 0) {

        $data_res = $this->Quiz_model->fetch_question_by_id($game_id, $mission_id, $question_answ_id);
        foreach ($data_res as $row_res) {
            $get_time = date(" d-m-Y H.i.s ");
            $given_answer_user = $row_res->correct_answer;
            $que_id = $row_res->question_id;
            if ($given_answer_user == $user_answer) {
                $this->Quiz_model->insert_score($transaction_count, $game_id, $mission_id, $userident, $get_time, $que_id, $user_answer, "Correct ", $correct_point);
            } else {
                $this->Quiz_model->insert_score($transaction_count, $game_id, $mission_id, $userident, $get_time, $que_id, $user_answer, "InCorrect ", 0);
            }
        }
    }
} catch (Exception $ex) {
    log_message($ex->getTraceAsString());
    return;
}
?>
