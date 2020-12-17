<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('app_model/Dashboard_model');
    }

    public function index()
    {
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

    /* Dashboard trophy ajax call*/
    public function dashboard_tropy()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/dashboard/trophy');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* fetch dashboard video list */
    public function dashboard_video_list()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/dashboard/video_list');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* fetch deails on dashboard home */
    public function dashboard_home()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = $this->session->userdata('game_id');
                $data['role_id'] = $this->session->userdata('role_id');
                $data['price_list'] = $this->Dashboard_model->fetch_price_list($game_id);
                $data['inventory'] = $this->Dashboard_model->fetch_inventory($game_id);
                $this->load->view('app/dashboard/dashboard', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* Dashboard redirect fetch mission details */
    public function dashboard_rediect($dec_miss_id, $dec_trans_id)
    {
        try {
            if ($this->session->userdata('email') != '') {
                $m = rawurldecode($this->encrypt->decode($dec_miss_id));
                $last_completed_mission = rawurldecode($this->encrypt->decode($dec_trans_id));
                $game_id = $this->session->userdata('game_id');
                $data['price_list'] = $this->Dashboard_model->fetch_price_list($game_id);
                $data['inventory'] = $this->Dashboard_model->fetch_inventory($game_id);
                $data['m'] = $m;
                $data['last_completed_mission'] = $last_completed_mission;
                $this->load->view('app/dashboard_redirect/dashboard_redirect', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* Insert sales and test drive registration data */
    public function insert_sale_test()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/dashboard/insert_sale_transc');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* show mission progress */
    public function show_progress()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/dashboard/show_progress');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* Satrt Budget */
    public function start_budget()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/dashboard/start_budget');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* start budget dashboard redirect  */
    public function start_budget_redirect()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/dashboard_redirect/start_budget');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* show mission progress redirect page */
    public function show_progress_redirect()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('app/dashboard_redirect/show_progress');
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* show progress redirect from show map 3 */
    public function show_map3_redirect($budget_status, $dec_miss_cnt)
    {
        try {
            if ($this->session->userdata('email') != '') {
                 $mission_compl_count = rawurldecode($this->encrypt->decode($dec_miss_cnt));
                $data = array(
                    'mission_compl_count' => $mission_compl_count,
                    'budget_status' => $budget_status,
                    'curr_mission' => "",
                );
                $this->load->view('app/map/map_three', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* show progress redirect from show map 1 */
    public function show_map1_redirect($budget_status, $dec_miss_cnt)
    {
        try {
            if ($this->session->userdata('email') != '') {
                $mission_compl_count = rawurldecode($this->encrypt->decode($dec_miss_cnt));
                $data = array(
                    'mission_compl_count' => $mission_compl_count,
                    'budget_status' => $budget_status,
                    'curr_mission' => "",
                );
                $this->load->view('app/map/map_one', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

    /* show progress redirect from show map 2*/
    public function show_map2_redirect($budget_status, $dec_miss_cnt)
    {
        try {
            if ($this->session->userdata('email') != '') {
                 $mission_compl_count = rawurldecode($this->encrypt->decode($dec_miss_cnt));
                $data = array(
                    'mission_compl_count' => $mission_compl_count,
                    'budget_status' => $budget_status,
                    'curr_mission' => "",
                );
                $this->load->view('app/map/map_two', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error',$ex->getTraceAsString());
            return;
        }
    }

}
