<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Game_rule extends CI_Controller {

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

    /*  Show game rule */
    public function game_rule() {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/game_rule/game_rule');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
