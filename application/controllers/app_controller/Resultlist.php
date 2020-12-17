<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
        $this->load->model('app_model/Resultlist_test_drive_model');
        $this->load->model('app_model/Resultlist_knowledge_model');
        $this->load->model('app_model/Resultlist_sale_model');
        $this->load->model('app_model/Resultlist_scoreboard_model');
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

    /* knowledge result list */

    public function resultlist_knowledge() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = 1;
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
                $data['role_id'] = $this->session->userdata('role_id');
                $userident = '';
                $data['knowledge'] = $this->Resultlist_knowledge_model->fetch_report_data_knowledge($game_id, $userident);
                if ($this->session->userdata('email') != '') {
                    $username = $this->session->userdata('email');
                    $data['user_list_g'] = $this->App_model->user_login($game_id, $username);
                    $this->load->view('app/resultlist/resultlist_knowledge', $data);
                } else {
                    redirect('App/index');
                }
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* Sales result list */

    public function resultlist_sale() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = 1;
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

                $data['role_id'] = $this->session->userdata('role_id');
                $userident = '';
                $data['res_report_data'] = $this->Resultlist_sale_model->fetch_report_sales($game_id, $userident);
                if ($this->session->userdata('email') != '') {
                    $username = $this->session->userdata('email');
                    $data['user_list_g'] = $this->App_model->user_login($game_id, $username);
                    $this->load->view('app/resultlist/resultlist_sale', $data);
                } else {
                    redirect('App/index');
                }
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* Test Drive result list */

    public function resultlist_test_drive() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = 1;
                /* Comparision between Mission and Rank  */

                $data['res_compare_mission_rank'] = $this->Resultlist_test_drive_model->comparision_mission_rank_testdrive($game_id);
                $rank = 1;
                foreach ($data['res_compare_mission_rank'] as $row_compare_mission_rank) {
                    $row_compare_mission_rank->test_drive_completion_count;
                    $row_compare_mission_rank->sum_all_test_drive_count;
                    $userident_mission_rank = $row_compare_mission_rank->userident;
                    $this->Resultlist_test_drive_model->update_final_rank_testdrive($game_id, $rank, $userident_mission_rank);
                    $rank++;
                }
                $data['role_id'] = $this->session->userdata('role_id');
                $userident = '';
                $data['result_test_drive'] = $this->Resultlist_test_drive_model->fetch_report_testdrive($game_id, $userident);
                if ($this->session->userdata('email') != '') {
                    $username = $this->session->userdata('email');
                    $data['user_list_g'] = $this->App_model->user_login($game_id, $username);
                    $this->load->view('app/resultlist/resultlist_test_drive', $data);
                } else {
                    redirect('App/index');
                }
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* Scoreboard result list */

    public function resultlist_scoreboard() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = 1;
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
                $data['role_id'] = $this->session->userdata('role_id');
                $userident = '';
                $data['scoreboard'] = $this->Resultlist_scoreboard_model->fetch_report_scoreboard($game_id, $userident);
                if ($this->session->userdata('email') != '') {
                    $username = $this->session->userdata('email');
                    $data['user_list_g'] = $this->App_model->user_login($game_id, $username);
                    $this->load->view('app/resultlist/resultlist_scoreboard', $data);
                } else {
                    redirect('App/index');
                }
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
