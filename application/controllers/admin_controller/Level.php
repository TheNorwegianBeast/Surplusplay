<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller
{

    /**
     * Calling constructer
     */
    function __construct()
    {
        parent:: __construct();
        $this->load->model('admin_model/Level_model');
    }

    /**
     * Add Level
     */
    public function add_level()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $data['level'] = $this->Level_model->select_game();
                $this->load->view('admin/level/add_level', $data);
            } else {
                redirect('Admin/inex');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /**
     * Check alpha
     */
    public function fullname_check($str)
    {
        if (!preg_match("/^([a-z0-9 ])+$/i", $str)) {
            $this->form_validation->set_message('fullname_check', 'The %s field can only be alpha numeric');
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check valid name
     */
    function alpha_dash($fullname)
    {
        if (!preg_match('/^[a-zA-Z]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only be alpha characters');
            return false;
        } else {
            return true;
        }
    }

    /* insert level */

    public function insert_level()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('select_game', 'Select Game', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("game_message", 'Please select game!');
                        redirect('admin_controller/Level/add_level');
                    } else {
                        $this->form_validation->set_rules('txt_level', 'Level Name', 'trim|required|callback_fullname_check');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("level_message", 'Please Enter Valid Level Name');
                            redirect('admin_controller/Level/add_level');
                        } else {
                            $this->form_validation->set_rules('radio_grade', 'Grade', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("grade_message", 'Please Select Grade!');
                                redirect('admin_controller/Level/add_level');
                            } else {
                                $this->form_validation->set_rules('radio_result', 'Result', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("result_message", 'Please Select Result!');
                                    redirect('admin_controller/Level/add_level');
                                } else {
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("att_message", 'Please Select Attendance!');
                                        redirect('admin_controller/Level/add_level');
                                    } else {
                                        $this->form_validation->set_rules('radio_certificate', 'Certificate', 'trim|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("crt_message", 'Please Select Certificate!');
                                            redirect('admin_controller/Level/add_level');
                                        } else {
                                            $this->form_validation->set_rules('radio_diploma', 'Diploma', 'trim|required');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("dip_message", 'Please Select Diploma!');
                                                redirect('admin_controller/Level/add_level');
                                            } else {
                                                $title = $this->input->post('txt_level');
                                                $game_id = $this->input->post('select_game');
                                                $from_date = $this->input->post('from_date');
                                                $to_date = $this->input->post('to_date');
                                                $grades = $this->input->post('radio_grade');
                                                $result = $this->input->post('radio_result');
                                                $attendance = $this->input->post('radio_attendance');
                                                $certifcate = $this->input->post('radio_certificate');
                                                $diploma = $this->input->post('radio_diploma');

                                                $insert_level = array(
                                                    'title' => $title,
                                                    'game_id' => $game_id,
                                                    'from_date' => $from_date,
                                                    'to_date' => $to_date,
                                                    'grades' => $grades,
                                                    'result' => $result,
                                                    'attendance' => $attendance,
                                                    'certifcate' => $certifcate,
                                                    'diploma' => $diploma
                                                );
                                                $user_id = $this->Level_model->add_level($insert_level, $game_id);
                                                if ($user_id > 0) {
                                                    $this->session->set_flashdata("add_message", 'true');
                                                    redirect('admin_controller/Level/get_level');
                                                } else {
                                                    $this->session->set_flashdata("suc_message", 'false');
                                                    redirect('admin_controller/Level/add_level');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('Admin/home');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get level */

    public function get_level()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->input->post('select_game');
                $user_game = '';
                $game_id == '' ? $game_id = 1 : null;
                $this->session->set_userdata(
                    array(
                            'level_game_id' => $game_id
                        )
                );
                $data['game'] = $this->Game_model->fetch_user_game($game_id);
                $data['level'] = $this->Level_model->get_level_list($game_id);
                $data['game_name'] = $this->Game_model->fetch_one_game($game_id);
                foreach ($data['game_name'] as $row) {
                    $user_game = $row->game_name;
                }
                $data['sel_game'] = $user_game;
                $this->load->view('admin/level/view_level', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get level by id */

    public function get_level_by_id()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('level_game_id');
                $segment_url = $this->uri->segment(4);
                $level_id = rawurldecode($this->encrypt->decode($segment_url));
                $data['level'] = $this->Level_model->get_level_by_id($level_id, $game_id);
                $this->load->view('admin/level/view_level_course', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* edit level */

    public function edit_level()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('level_game_id');
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('level_id') : null;
                $level_id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                    array
                            ('level_id' => $segment_url)
                );
                $data['level'] = $this->Level_model->get_level_by_level_id($level_id, $game_id);
                $this->load->view('admin/level/edit_level_course', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update level */

    public function update_level()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btnupdate')) {
                    $this->form_validation->set_rules('txt_level_name', 'Level Name', 'trim|required|callback_fullname_check');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("level_message", validation_errors());
                        redirect('admin_controller/Level/edit_level');
                    } else {
                        $this->form_validation->set_rules('level_from_date', 'From Date', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("from_message", 'Please Select From Date!');
                            redirect('admin_controller/Level/edit_level');
                        } else {
                            $this->form_validation->set_rules('level_to_date', 'To Date', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("to_message", 'Please Select To Date!');
                                redirect('admin_controller/Level/edit_level');
                            } else {
                                $this->form_validation->set_rules('radio_grade', 'Grade', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("grade_message", 'Please Select Grade!');
                                    redirect('admin_controller/Level/edit_level');
                                } else {
                                    $this->form_validation->set_rules('radio_result', 'Result', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("result_message", 'Please Select Result!');
                                        redirect('admin_controller/Level/edit_level');
                                    } else {
                                        $this->form_validation->set_rules('radio_attendance', 'Attendance', 'trim|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("att_message", 'Please Select Attendance!');
                                            redirect('admin_controller/Level/edit_level');
                                        } else {
                                            $this->form_validation->set_rules('radio_certificate', 'Certificate', 'trim|required');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("crt_message", 'Please Select Certificate!');
                                                redirect('admin_controller/Level/edit_level');
                                            } else {
                                                $this->form_validation->set_rules('radio_diploma', 'Diploma', 'trim|required');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("dip_message", 'Please Select Diploma!');
                                                    redirect('admin_controller/Level/edit_level');
                                                } else {
                                                    $game_id = $this->session->userdata('level_game_id');
                                                    $segment_url = $this->session->userdata('level_id');
                                                    $level_id = rawurldecode($this->encrypt->decode($segment_url));

                                                    $title = $this->input->post('txt_level_name');
                                                    $from_date = $this->input->post('level_from_date');
                                                    $to_date = $this->input->post('level_to_date');
                                                    $grades = $this->input->post('radio_grade');
                                                    $result = $this->input->post('radio_result');
                                                    $attendance = $this->input->post('radio_attendance');
                                                    $certifcate = $this->input->post('radio_certificate');
                                                    $diploma = $this->input->post('radio_diploma');

                                                    $insert_level = array(
                                                        'title' => $title,
                                                        'from_date' => $from_date,
                                                        'to_date' => $to_date,
                                                        'grades' => $grades,
                                                        'result' => $result,
                                                        'attendance' => $attendance,
                                                        'certifcate' => $certifcate,
                                                        'diploma' => $diploma
                                                    );
                                                    ($this->Level_model->update_level($insert_level, $game_id, $level_id)) 
                                                    ? ($this->session->set_flashdata("suc_message", "update")) 
                                                    : $this->session->set_flashdata("suc_message", "false");
                                                    redirect('admin_controller/Level/edit_level');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Level/get_level');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete level */

    public function delete_level($level_id)
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('level_game_id');
                $level_id = rawurldecode($this->encrypt->decode($level_id));
                ($this->Level_model->delete_level($level_id, $game_id)) 
                ? ($this->session->set_flashdata("add_message", "delete")) 
                : $this->session->set_flashdata("add_message", "false");
                redirect('admin_controller/Level/get_level');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $ex) {
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
        }
    }

}
