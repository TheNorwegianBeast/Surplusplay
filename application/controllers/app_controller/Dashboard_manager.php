<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_manager extends CI_Controller {

    /*  Calling Constructer */ 
    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_manager_model');
        $this->load->model('admin_model/User_model');
        $this->load->model('admin_model/Mission_model');
        $this->load->model('app_model/Resultlist_sale_model');
        $this->load->model('app_model/Resultlist_knowledge_model');
        $this->load->model('app_model/Resultlist_test_drive_model');
        $this->load->model('app_model/Resultlist_scoreboard_model');
    }

    /* Calling index file */
    
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

    /* Dashboard manager page */
   
    public function dash_manager() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');

                $data['role_id'] = $this->session->userdata('role_id');


                $data['sale_trans'] = $this->Dashboard_manager_model->fetch_sales_trans_by_user($game_id);
                $data['rank_user'] = $this->Dashboard_manager_model->fetch_top_rank_user($game_id);
                $data['not_count'] = $this->Dashboard_manager_model->fetch_not_count($game_id);
                $data['scoreboard'] = $this->Dashboard_manager_model->fetch_by_scoreboard($game_id);
                $data['user_budget'] = $this->User_model->fetch_user_with_budget($game_id);
                $data['car_model'] = $this->Dashboard_manager_model->fetch_car_model($game_id);
                $this->load->view('app/dashboard_manager/dashboard_manager', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* update notification count */
    public function update_count() {
        try {
            $new_token = $this->security->get_csrf_hash();
            $response = false;
            $game_id = $this->session->userdata('game_id');
            $data = array(
                'is_new_noti' => 0
            );
            if ($game_id != 0) {
                $response = $this->Dashboard_manager_model->update_notify($game_id, $data);
            }

            echo json_encode(array('token' => $new_token, 'response' => $response));
            exit();
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* fetch game journey */
    public function game_journey() {
        try {
            if ($this->session->userdata('email') != '') {
                $data['game_id'] = $game_id = $this->session->userdata('game_id');
                $sel_value = $this->input->get('s');
                if ($sel_value == 'scoreboard') {
                    $data['score'] = $this->Dashboard_manager_model->fetch_by_scoreboard($game_id);
                    $this->load->view('app/dashboard_manager/journey_dropdown', $data);
                } else if ($sel_value == 'sale') {
                    $data['score'] = $this->Dashboard_manager_model->fetch_by_sale($game_id);
                    $this->load->view('app/dashboard_manager/journey_dropdown', $data);
                } else if ($sel_value == 'testdrive') {
                    $data['score'] = $this->Dashboard_manager_model->fetch_by_testdrive($game_id);
                    $this->load->view('app/dashboard_manager/journey_dropdown', $data);
                } else if ($sel_value == 'knowledge') {
                    $data['score'] = $this->Dashboard_manager_model->fetch_by_knowledge($game_id);
                    $this->load->view('app/dashboard_manager/journey_dropdown', $data);
                }
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* fetch user journey */
    public function user_journey() {
        try {
            if ($this->session->userdata('email') != '') {
                $data['game_id'] = $game_id = $this->session->userdata('game_id');
                $data['user_name'] = $this->input->get('userName');
                $data['user_rank'] = $this->input->get('userRank');
                $data['user_id'] = $this->input->get('userId');
                $user_mission = $this->input->get('mission');
                $data['result_list_type'] = $this->input->get('resultListType');
                $data['mission'] = $this->Mission_model->fetch_mission_id_by_name($user_mission, $game_id);
                $this->load->view('app/dashboard_manager/journey_detail', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* Get sales Test drive data */
    public function get_sale_test() {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/dashboard_manager/get_sale_test');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
