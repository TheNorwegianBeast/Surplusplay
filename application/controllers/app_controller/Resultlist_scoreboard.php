<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist_scoreboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
        $this->load->model('app_model/Resultlist_scoreboard_model');
        $this->load->model('app_model/Resultlist_knowledge_model');
    }

     /* Scoreboard result list */
    public function index() {
        try {
            $game_id = 1;
            $data['role_id'] = $this->session->userdata('role_id');
            /* fetch data from scoreboard rank table  */
             $data['mission_id'] = $this->Resultlist_knowledge_model->fetch_mission_id($game_id);
            foreach ($data['mission_id'] as $id){
            $ms = $id->mission_id;
                $data['res_mission_data'] = $this->Resultlist_scoreboard_model->fetch_scoreboard_data($game_id, $ms);
                foreach ($data['res_mission_data'] as $row_mission_data) {
                    $scoreboard_id = $row_mission_data->scoreboard_id;
                    $rank_no = $row_mission_data->rank_no;
                    $mission_rank = $row_mission_data->mission_rank;

                    /*  Update previous mission ranking  */

                    $res_update_previous_rank = $this->Resultlist_scoreboard_model->update_previous_mission_rank_scoreboard($game_id, $ms, $mission_rank, $scoreboard_id);
                }
            }

            /* Fetch Mission Completion time in seconds from mission diration table and update rank   */

           foreach ($data['mission_id'] as $id){
            $m = $id->mission_id; 
                $data['res_per_mission'] = $this->Resultlist_scoreboard_model->fetch_mission_spendtime_scoreboard($game_id, $m);
                $rank = 1;
                $points = 100;

                foreach ($data['res_per_mission'] as $row_per_mission) {

                    $mission_rank = $row_per_mission->mission_id;
                    $userident = $row_per_mission->userident;
                    $res_update_mission_rank = $this->Resultlist_scoreboard_model->update_mission_rank_scoreboard($game_id, $mission_rank, $rank, $points, $userident, $m);
                    $rank++;
                    $points = $points - 2;
                }
            }

            /* Fetch All User from Rank Table and Update mission completion count in Rank Table */
            $data['res_fetch_all_user_from_rank'] = $this->Resultlist_scoreboard_model->fetch_all_user_rank_scoreboard($game_id);
            foreach ($data['res_fetch_all_user_from_rank'] as $row_fetch_all_user_from_rank) {
                $userident_rnk = $row_fetch_all_user_from_rank->userident;
                $data['fetch_total_mission_done'] = $this->Resultlist_scoreboard_model->fetch_total_clear_mission_scoreboard($game_id, $userident_rnk);
                foreach ($data['fetch_total_mission_done'] as $row_total_mission_done) {
                    $total_mission_count = $row_total_mission_done->total_mission_clear;

                    $res_update_mission_count = $this->Resultlist_scoreboard_model->update_clear_mission_count_scoreboard($game_id, $total_mission_count, $userident_rnk);
                }
            }

            /* Fetch All User from Rank Table and Update Sum of All Mission Count in Rank Table */
            $data['res_fetch_all_user_frm_rank'] = $this->Resultlist_scoreboard_model->fetch_all_user_rank_scoreboard($game_id);
            foreach ($data['res_fetch_all_user_frm_rank'] as $row_fetch_all_user_from_rnk) {
                $userident_from_rnk = $row_fetch_all_user_from_rnk->userident;
                $data['fetch_all_mission_cnt'] = $this->Resultlist_scoreboard_model->fetch_all_mission_count_scoreboard($game_id, $userident_from_rnk);
                foreach ($data['fetch_all_mission_cnt'] as $row_all_mission_cnt) {
                    $all_mission_count = $row_all_mission_cnt->sum_all_mission_rank;

                    $res_update_all_mission_count = $this->Resultlist_scoreboard_model->update_all_mission_count_scoreboard($game_id, $all_mission_count, $userident_from_rnk);
                }
            }

            /*  update previous ranking  */
            $data['res_data'] = $this->Resultlist_scoreboard_model->fetch_all_user_rank_scoreboard($game_id);
            foreach ($data['res_data'] as $row_data) {
                $scoreboard_id = $row_data->scoreboard_id;
                $rank_no = $row_data->rank_no;

                /* Update previous rank */
                $res_update = $this->Resultlist_scoreboard_model->update_previou_rank_scoreboard($game_id, $rank_no, $scoreboard_id);
            }

            /* Comparision between Mission and Rank  */
            $data['res_compare_mission_rank'] = $this->Resultlist_scoreboard_model->comparision_mission_rank_scoreboard($game_id);
            $rank = 1;

            foreach ($data['res_compare_mission_rank'] as $row_compare_mission_rank) {
                $row_compare_mission_rank->mission_completion_count;
                $row_compare_mission_rank->sum_all_mission_count;
                $userident_mission_rank = $row_compare_mission_rank->userident;
                $this->Resultlist_scoreboard_model->update_final_rank_scoreboard($game_id, $rank, $userident_mission_rank);
                $rank++;
            }
            
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
