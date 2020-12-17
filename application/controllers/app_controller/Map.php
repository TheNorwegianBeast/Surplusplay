<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

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

     /* show map one */
    public function map_one() {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/map/map_one');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

     /* show map two */
    public function map_two() {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/map/map_two');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* show map three */
    public function map_three() {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/map/map_three');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
