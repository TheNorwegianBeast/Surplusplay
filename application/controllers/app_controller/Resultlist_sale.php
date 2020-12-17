<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist_sale extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
        $this->load->model('app_model/Resultlist_sale_model');
        $this->load->model('app_model/Resultlist_knowledge_model');
    }
    
     /* Knowledge result list */
    public function index() {
        try {
            $game_id = 1;
            $data['role_id'] = $this->session->userdata('role_id');
            /* Fetch Mission Completion time in seconds from mission duration table and update rank   */
            $data['mission_id'] = $this->Resultlist_knowledge_model->fetch_mission_id($game_id);
            foreach ($data['mission_id'] as $id) {
                $m = $id->mission_id;
                $data['res_per_mission'] = $this->Resultlist_sale_model->fetch_mission_spend_time_sale($game_id, $m);
                $rank = 1;
                $points = 100;
                foreach ($data['res_per_mission'] as $row_per_mission) {
                    $mission_rank = $row_per_mission->mission_id;
                    $userident = $row_per_mission->userident;
                    $res_update_mission_rank = $this->Resultlist_sale_model->update_per_mission_rank_sale($game_id, $mission_rank, $rank, $points, $userident);
                    $rank++;
                    $points = $points - 2;
                }
            }

            /* Fetch All User from Rank Table and Update mission completion count in Rank Table */

            $data['res_fetch_all_user_from_rank'] = $this->Resultlist_sale_model->fetch_all_user_rank_sale($game_id);
            foreach ($data['res_fetch_all_user_from_rank'] as $row_fetch_all_user_from_rank) {
                $userident_rnk = $row_fetch_all_user_from_rank->userident;
                $data['fetch_total_mission_done'] = $this->Resultlist_sale_model->fetch_total_clear_mission_by_user_sale($game_id, $userident_rnk);
                foreach ($data['fetch_total_mission_done'] as $row_total_mission_done) {
                    $total_mission_count = $row_total_mission_done->total_mission_clear;
                    $res_update_mission_count = $this->Resultlist_sale_model->update_completed_mission_count_sale($game_id, $total_mission_count, $userident_rnk);
                }
            }

            /* Fetch All User from Rank Table and Update Sum of All Mission Count in Rank Table */

            $data['res_fetch_all_user_from_rnk'] = $this->Resultlist_sale_model->fetch_all_user_rank_sale($game_id);
            foreach ($data['res_fetch_all_user_from_rnk'] as $row_fetch_all_user_from_rnk) {
                $userident_from_rnk = $row_fetch_all_user_from_rnk->userident;
                $data['fetch_all_mission_cnt'] = $this->Resultlist_sale_model->fetch_all_mission_count_sale($game_id, $userident_from_rnk);
                foreach ($data['fetch_all_mission_cnt'] as $row_all_mission_cnt) {

                    $all_mission_count = $row_all_mission_cnt->sum_all_mission_rank;

                    $res_update_all_mission_count_sales = $this->Resultlist_sale_model->update_all_mission_count_sale($game_id, $all_mission_count, $userident_from_rnk);
                }
            }


            /* Comparision between Mission and Rank  */

            $data['res_compare_mission_rank'] = $this->Resultlist_sale_model->comparision_mission_rank_sale($game_id);
            $rank = 1;
            foreach ($data['res_compare_mission_rank'] as $row_compare_mission_rank) {
                $row_compare_mission_rank->sale_completion_count;
                $row_compare_mission_rank->sum_all_mission_sales;
                $userident_mission_rank = $row_compare_mission_rank->userident;

                $this->Resultlist_sale_model->update_final_rank_sales($game_id, $rank, $userident_mission_rank);
                $rank++;
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }
}
