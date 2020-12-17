<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist_test_drive extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
        $this->load->model('app_model/Resultlist_test_drive_model');
        $this->load->model('app_model/Resultlist_knowledge_model');
    }

    public function index() {
        try{
        $game_id = 1;
        $data['role_id'] = $this->session->userdata('role_id');
        /* Fetch Mission Completion time in seconds from mission duration table and update rank   */
        $data['mission_id'] = $this->Resultlist_knowledge_model->fetch_mission_id($game_id);
       foreach ($data['mission_id'] as $id){
            $m = $id->mission_id; 
            $data['res_per_mission'] = $this->Resultlist_test_drive_model->fetch_mission_spendtime_testdrive($game_id, $m);
            $rank = 1;
            $points = 100;

            foreach ($data['res_per_mission'] as $row_per_mission) {
                $mission_rank = $row_per_mission->mission_id;
                $userident = $row_per_mission->userident;
                $res_update_mission_rank = $this->Resultlist_test_drive_model->update_each_mission_rank_testdrive($game_id, $mission_rank, $rank, $points, $userident);
                $rank++;
                $points = $points - 2;
            }
        }

        /* Fetch All User from Rank Table and Update mission completion count in Rank Table */

        $data['res_fetch_all_user_rank'] = $this->Resultlist_test_drive_model->fetch_all_rank_testdrive($game_id);
        foreach ($data['res_fetch_all_user_rank'] as $row_fetch_all_user_from_rank) {
            $userident_rnk = $row_fetch_all_user_from_rank->userident;
            $data['fetch_total_mission_done'] = $this->Resultlist_test_drive_model->fetch_user_total_clear_mission_testdrive($game_id, $userident_rnk);
            foreach ($data['fetch_total_mission_done'] as $row_total_mission_done) {
                $total_mission_count = $row_total_mission_done->total_mission_clear;

                $res_update_mission_count = $this->Resultlist_test_drive_model->update_clear_mission_count_testdrive($game_id, $total_mission_count, $userident_rnk);
            }
        }

        /* Fetch All User from Rank Table and Update Sum of All Mission Count in Rank Table */

        $data['res_fetch_all_user_frm_rank'] = $this->Resultlist_test_drive_model->fetch_all_rank_testdrive($game_id);
        foreach($data['res_fetch_all_user_frm_rank'] as $row_fetch_all_user_from_rank) {
            $userident_from_rnk = $row_fetch_all_user_from_rank->userident;
            $data['fetch_all_mission_cnt'] = $this->Resultlist_test_drive_model->fetch_all_mission_count_testdrive($game_id, $userident_from_rnk);
            foreach($data['fetch_all_mission_cnt'] as $row_all_mission_cnt ){
            $all_mission_count = $row_all_mission_cnt->sum_all_mission_rank;

            $res_update_all_mission_count_sales = $this->Resultlist_test_drive_model->update_all_MissionCount_Test($game_id, $all_mission_count, $userident_from_rnk);
        }
        }

        /* Comparision between Mission and Rank  */

        $data['res_compare_mission_rank'] = $this->Resultlist_test_drive_model->comparision_mission_rank_testdrive($game_id);
        $rank = 1;
        foreach ($data['res_compare_mission_rank'] as $row_compare_mission_rank ) {
            $row_compare_mission_rank->test_drive_completion_count;
            $row_compare_mission_rank->sum_all_test_drive_count;
            $userident_mission_rank = $row_compare_mission_rank->userident;
            $this->Resultlist_test_drive_model->update_final_rank_testdrive($game_id, $rank, $userident_mission_rank);
            $rank++;
        }

        
        } catch (Exception $ex) {
            log_message($ex->getTraceAsString());
            return;
        }
    }

}
