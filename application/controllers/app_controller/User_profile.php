<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
        $this->load->model('app_model/User_profile_model');
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

    public function user_profile() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');
                $user = $this->session->userdata('user');
                $data['game_name'] = $this->User_profile_model->fetch_game_name($game_id);
                $data['user_data'] = $this->User_profile_model->fetch_user_data($game_id,$user);
                $this->load->view('app/user/user_profile', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }
    
    public function manager_profile() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');
                $user = $this->session->userdata('user');
                $data['game_name'] = $this->User_profile_model->fetch_game_name($game_id);
                $data['user_data'] = $this->User_profile_model->fetch_user_data($game_id,$user);
               $this->load->view('app/user/manager_profile',$data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
