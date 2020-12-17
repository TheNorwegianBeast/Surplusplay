<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Map_nav extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('app_model/Map_model');
    }

    /* fetch last mission */
    public function last_mission() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');
                $user = $this->session->userdata('user');
                $mission_compl_count = 1;
                $budget_status = "test";

                $data['last_mission'] = $this->Map_model->fetch_last_completed_mission($game_id, $user);
                if (!empty($data['last_mission'])) {
                    foreach ($data['last_mission'] as $row_msn_completed_count) {

                        $mission_compl_count = $row_msn_completed_count->mission_id;
                        $budget_status = $row_msn_completed_count->budget_status;
                    }
                }


                $data = array(
                    'mission_compl_count' => $mission_compl_count,
                    'budget_status' => $budget_status,
                    'curr_mission' => "",
                );

                if ($mission_compl_count == "") {
                    $mission_id = 1;
                } else {
                    $mission_id = $mission_compl_count;
                }

                /*  Mission from 1 to 4 */
                if ($mission_id >= 1 && $mission_id <= 4) {
                    if ($mission_id >= 1 && $mission_id <= 3) {
                        $this->load->view('app/map/map_one', $data);
                    } else {
                        if ($mission_id == 4 && $budget_status == "completed") {
                            $this->load->view('app/map/map_two', $data);
                        } else {
                            $this->load->view('app/map/map_one', $data);
                        }
                    }
                }


                /*  Mission from 4 completed , from 5 to 8 */
                if ($mission_id >= 5 && $mission_id <= 8) {
                    if ($mission_id >= 5 && $mission_id <= 7) {
                        $this->load->view('app/map/map_two', $data);
                    } else {
                        if ($mission_id == 8 && $budget_status == "completed") {
                            $this->load->view('app/map/map_three', $data);
                        } else {
                            $this->load->view('app/map/map_two', $data);
                        }
                    }
                }

                /*  Mission from 8 completed , from 9 to 12 */
                if ($mission_id >= 9 && $mission_id <= 12) {
                    $this->load->view('app/map/map_three', $data);
                }
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
