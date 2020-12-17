<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist_knowledge extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
        $this->load->model('app_model/Resultlist_knowledge_model');
    }

  
    /* Knowledge result list */
    public function index() {
        try {
            $game_id = 1;

            $data['role_id'] = $this->session->userdata('role_id');
            /*  Updated Percentage  */

            $data['mission_id'] = $this->Resultlist_knowledge_model->fetch_mission_id($game_id);
            foreach ($data['mission_id'] as $id) {
                $m = $id->mission_id;
                $data['res_know'] = $this->Resultlist_knowledge_model->fetch_knowledge_rank_data($game_id);
                foreach ($data['res_know'] as $row) {
                    $user = $row->userident;
                    $data['res_fetch_last_quiz_percent'] = $this->Resultlist_knowledge_model->fetch_attempted_mission_badge($game_id, $user, $m);

                    /*  Fetch Quiz by percentage for by course quiz id and updated percenage in knowledge table    */

                    foreach ($data['res_fetch_last_quiz_percent'] as $row_fetch_last_quiz_percent) {
                        $m_id = $row_fetch_last_quiz_percent->mission_id;
                        $percent = $row_fetch_last_quiz_percent->percentage;
                        $uident = $row_fetch_last_quiz_percent->userident;
                        $res_update_mission_rank = $this->Resultlist_knowledge_model->update_per_mission_percentage($game_id, $m_id, $percent, $user);
                    }
                }
            }

            /* Mission Ranking   */

           $data['mission_id'] = $this->Resultlist_knowledge_model->fetch_mission_id($game_id);
            foreach ($data['mission_id'] as $id) {
                $m = $id->mission_id;
                /* Logic for update mission rank   */
                $data['res_fetch_miss'] = $this->Resultlist_knowledge_model->select_rank_mission_desc($game_id, $m);
                $m_rank = 1;
                $points = 100;
                foreach ($data['res_fetch_miss'] as $row_fetch_all_miss) {
                    $know_userident = $row_fetch_all_miss->userident;
                    $know_percentage = $row_fetch_all_miss->percentage;
                    $data['res_att_count'] = $this->Resultlist_knowledge_model->fetch_attempted_mission_count($game_id, $m, $know_userident);
                    foreach ($data['res_att_count'] as $row_att_count) {

                        $is_attempted = $row_att_count->mission_attempt_cnt;
                        if ($is_attempted > 0) {
                            $res_update_rank_mission = $this->Resultlist_knowledge_model->update_per_mission_rank_percentage($game_id, $m, $m_rank, $points, $know_userident);
                            $m_rank = $m_rank + 1;
                            $points = $points - 2;
                        }
                    }
                }
            }

            /* Fetch All user from ranking table and update sum of all mission rank  */

            $res_fetch_know_rank = $this->Resultlist_knowledge_model->fetch_knowledge_rank($game_id);
            foreach ($res_fetch_know_rank as $row_fetch_know_rank) {
                $userident_sum = $row_fetch_know_rank->userident;
                $crs_id_sum = $row_fetch_know_rank->level_id;

                $data['res_sum_all_mission'] = $this->Resultlist_knowledge_model->fetch_sum_mission($game_id, $userident_sum);
                foreach ($data['res_sum_all_mission'] as $row_sum_all_mission) {
                    $sum_all_mission = $row_sum_all_mission->sum_all_mission;
                    $this->Resultlist_knowledge_model->update_sum_all_mission($game_id, $sum_all_mission, $userident_sum);  // update sum of all mission

                    $data['res_sum_att_count'] = $this->Resultlist_knowledge_model->fetch_disctinct_attempt_quiz($game_id, $userident_sum);

                    foreach ($data['res_sum_att_count'] as $row_sum_att_count) {
                        $sum_quiz_attemp_count = $row_sum_att_count->quizcount;
                        $this->Resultlist_knowledge_model->update_attempted_quiz_count($game_id, $sum_quiz_attemp_count, $userident_sum);  //  updated number of quiz completed
                    }
                }
            }


            /* Comparision between knowledge completion count and sum of all mission  */

            $data['res_compare_for_rank'] = $this->Resultlist_knowledge_model->comparision_knowledge_rank($game_id);
            $rank = 1;
            foreach ($data['res_compare_for_rank'] as $row_compare_for_rank) {
                $know_completed_count_Rank = $row_compare_for_rank->know_completion_count;
                $sum_all_mission_Rank = $row_compare_for_rank->sum_all_mission;
                $userident_Rank = $row_compare_for_rank->userident;

                $this->Resultlist_knowledge_model->update_knowledge_rank($game_id, $rank, $userident_Rank);
                $rank++;
            }
            
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
