<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
        $this->load->model('app_model/Dashboard_manager_model');
        $this->load->model('app_model/Quiz_model');
    }

    public function index() {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('index');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    public function quiz($m) {
        try {
            if ($this->session->userdata('email') != '') {
                $dec_miss_id = rawurldecode($this->encrypt->decode($m));
                $data['mis_id'] = $dec_miss_id;
                $this->load->view('app/quiz/quiz', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /**
     * Ajax call controller                
     */
    public function quiz_ajax() {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/quiz/quiz_controller');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /**
     * Call to calculate result                 
     */
    public function quiz_cal_res($count, $mission_id) {
        $data['cnt'] = $count;
        $data['ms_id'] = $mission_id;
        redirect('app_controller/Quiz/congratulation/' . $count . '/' . $mission_id);
    }

    public function gquiz($transaction_count, $mission_id) {
        // $user = $this->session->userdata('userident');
        $user = $this->session->userdata('user');
        $first_name = $this->session->userdata('first_name');
        $last_name = $this->session->userdata('last_name');
        $role_id = $this->session->userdata('role_id');
        $game_id = $this->session->userdata('game_id');
        $email = $this->session->userdata('email');
        $last_mission_id = 5;
        $quiz_total = 0;
        $total = 0;
        $percentage = 0;
        $grade_id = 0;
        $all_total = 0;
        $all_percentage = 0;
        $total_attempt_quiz = 0;
        $is_participate_flag = "";
        $count_no = 0;
        $count_yes = 0;
        $count_total = 0;
        $know_is_attempt_flag = '';
        $current_date = date("Y/m/d");
        $transaction_type = "knowledge test";
        $sum_quiz_total = 0;
        $sum_percentage = 0;
        $sum_mission_quiz = 0;

        /* fetch course quiz */

        $res_total = $this->Quiz_model->fetch_mission_quiz($game_id, $mission_id);
        foreach ($res_total as $row_quiz_id) {
            $quiz_total = $row_quiz_id->total_points;
        }

        /* fetch score */

        $res_sum_quiz = $this->Quiz_model->sum_score($game_id, $transaction_count, $user);
        foreach ($res_sum_quiz as $row_score) {
            $total = $row_score->collect_points;
        }

        /* calculate percenage by mission */
        $percentage = round(($total / $quiz_total) * 100);
        $data['res_is_no_participate'] = $this->Quiz_model->is_quiz_attempted($game_id, $transaction_count);
        foreach ($data['res_is_no_participate'] as $row_is_no_participate) {
            $is_no_participated = $row_is_no_participate->is_answer_count;
            if ($is_no_participated == 0) {
                $is_participate_flag = "n";
            } else {
                $is_participate_flag = "y";
            }
        }

        $bdge_img = "";
        // $grade_is_attempt = "";
        $res_grade = $this->Quiz_model->fetch_grade($game_id, $percentage, $is_participate_flag);
        foreach ($res_grade as $row_grade) {
            $grade_id = $row_grade->grade_id;
            $bdge_img = $row_grade->badge_image;
            $congrats_img = $row_grade->congrats_img;
            $is_participate_flag = $row_grade->is_attempt;
        }

        /* Insert in attempted table */
        $res = $this->Quiz_model->insert_attemps($transaction_count, $game_id, $mission_id, $user, $total, $percentage, $grade_id, $bdge_img, $congrats_img, $is_participate_flag);
        $res_game_trans = $this->Quiz_model->insert_quiz_game_trans($game_id, $mission_id, $current_date, $transaction_type, $user);

        /* Logic start to Fetch Badge of All Solved Quiz Start  */

        /* fetch Distinct attempted quiz last   */
        $data['res_Last_attempted_by_user'] = $this->Quiz_model->fetch_disctinct_quiz_by_user($game_id, $user);
        foreach ($data['res_Last_attempted_by_user'] as $row_Last_attempted_by_user) {
            $mission_quiz_id = $row_Last_attempted_by_user->mission_id;

            $res_all_total = $this->Quiz_model->fetch_attempted_mission_badge($game_id, $user, $mission_quiz_id);
            foreach ($res_all_total as $row_all_total) {
                $attempt_id = $row_all_total->quiz_attmp_id;
                $cqz_id = $row_all_total->mission_id;

                $is_attempted_flag = $row_all_total->is_attempt;
                $total_score = $row_all_total->total_score_points;
                $all_total = ($all_total + $total_score);

                if ($is_attempted_flag == 'n') {
                    $count_no++;
                } elseif ($is_attempted_flag == 'y') {
                    $count_yes++;
                }
                //  sum of total points by distinct mission 
                $res_sum_total = $this->Quiz_model->fetch_mission_quiz($game_id, $cqz_id);
                foreach ($res_sum_total as $row_sum) {
                    $sum_mission_quiz = $row_sum->total_points;
                    $sum_quiz_total = ($sum_quiz_total + $sum_mission_quiz);
                }
            }
            $count_total++;
        }


        /* check if total attempted quiz attempted status n */
        if ($count_total == $count_no) {
            $know_is_attempt_flag = 'n';
        } else {
            $know_is_attempt_flag = 'y';
        }

        $res_total_qz = $this->Quiz_model->fetch_disctinct_quiz_attempt($game_id, $user);
        foreach ($res_total_qz as $row_qz_count) {
            $total_attempt_quiz = $row_qz_count->quiz_count;
            $sum_percentage = round(($all_total / $sum_quiz_total) * 100);
            $res_fetch_knowledge_level = $this->Quiz_model->fetch_knowledge_avg_grade($game_id, $sum_percentage, $know_is_attempt_flag);
            foreach ($res_fetch_knowledge_level as $row_fetch_knowledge_level) {

                $per_know_grade_id = $row_fetch_knowledge_level->avg_know_grade_id;
                $per_know_grade = $row_fetch_knowledge_level->avg_grade;
                $per_know_level_image = $row_fetch_knowledge_level->know_level_img;
                $per_know_qz_image = $row_fetch_knowledge_level->know_qz_img;

                $resUserCount = $this->Quiz_model->check_user_exist_badge_mapping($game_id, $user);
                foreach ($resUserCount as $rowUserCount) {
                    $user_exist_count = $rowUserCount->user_exist_count;
                    if ($user_exist_count > 0) {
                        $res_update_badge_mapping = $this->Quiz_model->updateknowledgeBadgeMapping($game_id, $user, $sum_percentage, $per_know_grade, $per_know_grade_id, $per_know_level_image, $per_know_qz_image);
                    } else {
                        $res_insert_badge_mapping = $this->Quiz_model->insert_knowledge_badge_mapping($game_id, $user, $sum_percentage, $per_know_grade, $per_know_grade_id, $per_know_level_image, $per_know_qz_image);
                    }
                }
            }
        }
        $mission_key = $this->encrypt->encode($mission_id);
        $trans_key = $this->encrypt->encode($transaction_count);
        redirect('app_controller/Quiz/congratulation/' . $trans_key . '/' . $mission_key);
    }

    public function congratulation($dec_trans_id, $dec_miss_id) {
        try {
            if ($this->session->userdata('email') != '') {
                $mission_id = rawurldecode($this->encrypt->decode($dec_miss_id));
                $trans_id = rawurldecode($this->encrypt->decode($dec_trans_id));
                $data['game_id'] = $game_id = $this->session->userdata('game_id');
                $userident = $this->session->userdata('user');
                $data['mission_id'] = $mission_id;
                $status = 'correct';
                $in_status = 'InCorrect';
                $data['attempt_mission'] = $this->Quiz_model->fetch_attempted_mission_badge($game_id, $userident, $mission_id);
                $data['que_count'] = $this->Dashboard_manager_model->fetch_total_question_count($game_id, $mission_id);
                $data['ans_count'] = $this->Quiz_model->fetch_count_correct_incorrect($game_id, $trans_id, $status);
                $data['in_count'] = $this->Quiz_model->fetch_count_correct_incorrect($game_id, $trans_id, $in_status);
                $data['trans_data'] = $this->Quiz_model->fetch_ques_transaction_data($game_id, $trans_id, $mission_id, $userident, $status);
                $data['in_trans_data'] = $this->Quiz_model->fetch_ques_transaction_data($game_id, $trans_id, $mission_id, $userident, $in_status);
                $this->load->view('app/quiz/congratulation', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
