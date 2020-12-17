<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_resultlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
        $this->load->model('app_model/Manager_resultlist_model');
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
            log_message($ex->getTraceAsString());
            return;
        }
    }

    /*  Manager result list */
    public function manager_resultlist() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');

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
                $this->load->model('app_model/Manager_resultlist_model');
                $data['manager_result'] = $this->Manager_resultlist_model->fetch_all_user($game_id, '');
                $this->load->view('app/manager_resultlist/manager_resultlist', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

     /* fetch manager test drive result list */
    public function manager_test_drive_resultlist() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');
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
                $userident = $this->input->get('tm');
                if ($userident == '') {
                    $data['testdrive_report'] = $this->Manager_resultlist_model->fetch_report_testdrive($game_id);
                } else {
                    $data['testdrive_report'] = $this->Manager_resultlist_model->fetch_report_testdrive_user($game_id, $userident);
                }


                $this->load->view('app/manager_resultlist/manager_test_drive_resultlist', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

     /* fetch mamager knowledge result list */
    public function manager_knowledge_resultlist() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');
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
                $userident = $this->input->get('tm');
                if ($userident == '') {
                    $data['report'] = $this->Manager_resultlist_model->fetch_report_data_knowledge($game_id);
                } else {
                    $data['report'] = $this->Manager_resultlist_model->fetch_report_data_knowledge_user($game_id, $userident);
                }

                $this->load->view('app/manager_resultlist/manager_knowledge_resultlist', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }
    
     /* fetch manager sales result list  */
    public function manager_sales_resultlist() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');
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
                $userident = $this->input->get('tm');
                if ($userident == '') {
                    $data['sales_report'] = $this->Manager_resultlist_model->fetch_report_sales($game_id);
                } else {
                    $data['sales_report'] = $this->Manager_resultlist_model->fetch_report_sales_user($game_id, $userident);
                }
                $this->load->view('app/manager_resultlist/manager_sales_resultlist', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

     /* fetch manager scoreboard result list  */
    public function manager_scoreboard_resultlist() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');
                $userident = $this->input->get('tm');
                if ($userident == '') {
                    $data['scoreboard_report'] = $this->Manager_resultlist_model->fetch_report_scoreboard($game_id);
                } else {
                    $data['scoreboard_report'] = $this->Manager_resultlist_model->fetch_report_scoreboard_user($game_id, $userident);
                }
                $this->load->view('app/manager_resultlist/manager_scoreboard_resultlist', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

     /* fetch knowledge rank data */
    public function fetch_knowledge_rank_data($game_id) {
        $this->load->model('app_model/Manager_resultlist_model');
        $data['knowledge_result'] = $this->Manager_resultlist_model->fetch_all_user_kwg($game_id);
    }

     /* fetch attempted mission badge */
    public function fetch_attempted_mission_badge($game_id, $user, $m) {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->model('app_model/Manager_resultlist_model');
                $data['knowledge_result1'] = $this->Manager_resultlist_model->fetch_attempted_mission_badge($game_id, $user, $m);
                $this->load->view('app/manager_resultlist/manager_resultlist', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }
    
    /* update each mission percentage */
    public function update_per_mission_percentage($game_id, $m_num, $percentage, $userident) {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->model('app_model/Manager_resultlist_model');
                $data['knowledge_result2'] = $this->Manager_resultlist_model->update_per_mission_percentage($game_id, $m_num, $percentage, $userident);
                $this->load->view('app/manager_resultlist/manager_resultlist', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
