<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
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
    
    /* Game overview controller */
    public function game_overview() {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/game_overview/overview');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
