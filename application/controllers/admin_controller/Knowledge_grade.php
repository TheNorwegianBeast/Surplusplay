<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Knowledge_grade extends CI_Controller
{

    /**
     * Calling constructer
     */
    function __construct()
    {
        parent:: __construct();
        $this->load->model('admin_model/Knowledge_grade_model');
        $this->load->model('admin_model/Level_model');
    }

    /* manage knowledge grade */

    public function manage_knowledge_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('knowledge_game_id') : null;
                $decrypt = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                    array
                            ('knowledge_game_id' => $segment_url)
                );

                $data['level'] = $this->Level_model->select_game();
                $data['know_grade'] = $this->Knowledge_grade_model->view_knowledge_grade($decrypt);
                $this->load->view('admin/game/manage_knowlegde_grade', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /**
     * Check valid name 
     */
    function alpha_dash($fullname)
    {
        if (!preg_match('/^[a-zA-Z]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only contain alpha characters');
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check valid alpha name
     */
    public function grade_check($str)
    {
        if (!preg_match("/^([a-z0-9+])+$/i", $str)) {
            $this->form_validation->set_message('fullname_check', 'The %s field can only be alpha numeric');
            return false;
        } else {
            return true;
        }
    }

    /* insert knowledge grade */

    public function insert_Knowldge_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('txt_from_percent', 'From Percentage', 'required|trim|numeric|greater_than[-0.1]|less_than[100.1]');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("from_message", 'Please Enter Valid From Percentage');
                        redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                    } else {
                        $this->form_validation->set_rules('txt_to_percent', 'To Percentage', 'required|trim|numeric|greater_than[-0.1]|less_than[100.1]');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("to_message", 'Please Enter Valid To Percentage');
                            redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                        } else {
                            if (empty($_FILES['filelevel']['name'])) {
                                $this->form_validation->set_rules('filelevel', 'Level Image', 'trim|required');
                            }
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("level_message", 'Please Select Valid Level Image');
                                redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                            } else {
                                if (empty($_FILES['filequiz']['name'])) {
                                    $this->form_validation->set_rules('filequiz', 'Quiz Image', 'trim|required');
                                }
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("quiz_message", 'Please Select Valid Quiz Image');
                                    redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                                } else {
                                    $this->form_validation->set_rules('grade', 'Grade', 'required|trim|callback_grade_check');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("g_message", 'Please Enter Valid Grade');
                                        redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                                    } else {
                                        $this->form_validation->set_rules('txt_desc', 'Description', 'required|trim');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("desc_message", 'Please Enter Knowledge Grade Description');
                                            redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                                        } else {
                                            $this->form_validation->set_rules('radio_grade', 'Participation', 'required');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("rd_message", 'Please Select Participation');
                                                redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                                            } else {
                                                $k_game_id = $this->session->userdata('knowledge_game_id');
                                                $game_id = rawurldecode($this->encrypt->decode($k_game_id));
                                                $picture_level = '';
                                                $picture_quiz = '';
                                                $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                                                $time_stamp = $date->format('YmdHis');
                                                if (!empty($_FILES['filelevel']['name'])) {
                                                    $config['upload_path'] = 'application/views/asset/image/knowledge_level/';
                                                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                                    $config['file_name'] = 'level-'.$time_stamp;
                                                    $file_ext = pathinfo($_FILES['filelevel']['name'], PATHINFO_EXTENSION);
                                                    $this->load->library('upload', $config);
                                                    $this->upload->initialize($config);

                                                    if ($this->upload->do_upload('filelevel')) {
                                                        $uploadData = $this->upload->data();
                                                        $picture_level = 'level-'.$time_stamp.'.'.$file_ext;
                                                    }
                                                }
                                                if (!empty($_FILES['filequiz']['name'])) {
                                                    $config['upload_path'] = 'application/views/asset/image/knowledge_level/';
                                                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                                    $config['file_name'] = 'quiz-'.$time_stamp;
                                                    $file_ext = pathinfo($_FILES['filequiz']['name'], PATHINFO_EXTENSION);
                                                    $this->load->library('upload', $config);
                                                    $this->upload->initialize($config);

                                                    if ($this->upload->do_upload('filequiz')) {
                                                        $uploadData = $this->upload->data();
                                                        $picture_quiz = 'quiz-'.$time_stamp.'.'.$file_ext;
                                                    }
                                                }

                                                $avg_grade = $this->input->post('grade');
                                                $avg_frm_percent = $this->input->post('txt_from_percent');
                                                $avg_to_percent = $this->input->post('txt_to_percent');
                                                $avg_grade_desc = $this->input->post('txt_desc');
                                                $is_attempt = $this->input->post('radio_grade');

                                                $insert_know_grade = array(
                                                    'game_id' => $game_id,
                                                    'avg_grade' => $avg_grade,
                                                    'avg_frm_percent' => $avg_frm_percent,
                                                    'avg_to_percent' => $avg_to_percent,
                                                    'know_level_img' => $picture_level,
                                                    'know_qz_img' => $picture_quiz,
                                                    'avg_grade_desc' => $avg_grade_desc,
                                                    'is_attempt' => $is_attempt
                                                );
                                                $user_id = $this->Knowledge_grade_model->add_knowledge_grade($insert_know_grade, $game_id);
                                                 ($user_id > 0) 
                                                    ? ($this->session->set_flashdata("add_message", "true")) 
                                                    : $this->session->set_flashdata("add_message", "false");
                                                    redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Game/manage_game');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* edit knowledge grade */

    public function edit_knowledge_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('avg_know_grade_id') : null;
                $avg_know_grade_id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                    array
                            ('avg_know_grade_id' => $segment_url)
                );
                $game_id = $this->session->userdata('knowledge_game_id');
                $game_id = rawurldecode($this->encrypt->decode($game_id));
                $data['k_game_id'] = $game_id;
                $data['know_grade_view'] = $this->Knowledge_grade_model->get_know_grade_by_id($avg_know_grade_id, $game_id);
                $this->load->view('admin/game/edit_knowledge_grade', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update knowledge grade */

    public function update_knowledge_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_update')) {
                    $this->form_validation->set_rules('txt_from_percent', 'From Percentage', 'required|trim|numeric|greater_than[-0.1]|less_than[100.1]');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("from_message", 'Please Enter Valid From Percentage');
                        redirect('admin_controller/Knowledge_grade/edit_knowledge_grade');
                    } else {
                        $this->form_validation->set_rules('txt_to_percent', 'To Percentage', 'required|trim|numeric|greater_than[-0.1]|less_than[100.1]');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("to_message", 'Please Enter Valid To Percentage');
                            redirect('admin_controller/Knowledge_grade/edit_knowledge_grade');
                        } else {
                            $this->form_validation->set_rules('grade', 'Grade', 'required|trim|callback_grade_check');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("g_message", 'Please Enter Valid Grade');
                                redirect('admin_controller/Knowledge_grade/edit_knowledge_grade');
                            } else {
                                $this->form_validation->set_rules('txt_desc', 'Description', 'required|trim');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("desc_message", 'Please Enter Knowledge Grade Description');
                                    redirect('admin_controller/Knowledge_grade/edit_knowledge_grade');
                                } else {
                                    $this->form_validation->set_rules('radio_grade', 'Participation', 'required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("rd_message", 'Please Select Participation');
                                        redirect('admin_controller/Knowledge_grade/edit_knowledge_grade');
                                    } else {
                                        $game_id = $this->session->userdata('knowledge_game_id');
                                        $game_id = rawurldecode($this->encrypt->decode($game_id));
                                        $segment_url = $this->session->userdata('avg_know_grade_id');
                                        $avg_know_grade_id = rawurldecode($this->encrypt->decode($segment_url));
                                        $picture_level = '';
                                        $picture_quiz = '';
                                        $level_img = '';
                                        $quiz_img = '';
                                        $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                                        $time_stamp = $date->format('YmdHis');
                                        $data['grade_data'] = $this->Knowledge_grade_model->get_know_grade_by_id($avg_know_grade_id, $game_id);
                                        foreach ($data['grade_data'] as $row) {
                                            $level_img = $row->know_level_img;
                                            $quiz_img = $row->know_qz_img;
                                        }

                                        if (!empty($_FILES['filelevel']['name'])) {
                                            $config['upload_path'] = 'application/views/asset/image/knowledge_level/';
                                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                            $config['file_name'] = 'level-'.$time_stamp;
                                            $file_ext = pathinfo($_FILES['filelevel']['name'], PATHINFO_EXTENSION);
                                            $this->load->library('upload', $config);
                                            $this->upload->initialize($config);
                                            if ($this->upload->do_upload('filelevel')) {
                                                $uploadData = $this->upload->data();
                                                $picture_level = $level_img;
                                                $level_img = 'level-'.$time_stamp.'.'.$file_ext;
                                            }
                                        }

                                        if (!empty($_FILES['filequiz']['name'])) {
                                            $config['upload_path'] = 'application/views/asset/image/knowledge_level/';
                                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                            $config['file_name'] = 'quiz-'.$time_stamp;
                                            $file_ext = pathinfo($_FILES['filequiz']['name'], PATHINFO_EXTENSION);

                                            $this->load->library('upload', $config);
                                            $this->upload->initialize($config);

                                            if ($this->upload->do_upload('filequiz')) {
                                                $uploadData = $this->upload->data();
                                                $picture_quiz = $quiz_img;
                                                $quiz_img = 'quiz-'.$time_stamp.'.'.$file_ext;
                                            }
                                        }

                                        $avg_frm_percent = $this->input->post('txt_from_percent');
                                        $avg_to_percent = $this->input->post('txt_to_percent');
                                        $avg_grade = $this->input->post('grade');
                                        $avg_grade_desc = $this->input->post('txt_desc');
                                        $is_attempt = $this->input->post('radio_grade');

                                        $update_know_grade = array(
                                            'avg_frm_percent' => $avg_frm_percent,
                                            'avg_to_percent' => $avg_to_percent,
                                            'avg_grade' => $avg_grade,
                                            'avg_grade_desc' => $avg_grade_desc,
                                            'know_level_img' => $level_img,
                                            'know_qz_img' => $quiz_img,
                                            'is_attempt' => $is_attempt
                                        );
                                        $user_id = $this->Knowledge_grade_model->update_knowledge_grade($update_know_grade, $game_id, $avg_know_grade_id);
                                        if ($user_id > 0) {
                                            $this->session->set_flashdata("add_message", 'update');
                                            $path1 = 'application/views/asset/image/knowledge_level/' . $picture_level;
                                            file_exists($path1) ? unlink($path1) : null;
                                            $path2 = 'application/views/asset/image/knowledge_level/' . $picture_quiz;
                                            file_exists($path2) ? unlink($path2) : null;
                                        } else {
                                            $this->session->set_flashdata("add_message", 'false');
                                        }
                                        redirect('admin_controller/Knowledge_grade/edit_knowledge_grade');
                                    }
                                }
                            }
                        }
                    }
                } elseif ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* Delete Knowledge Grade */

    public function delete_knowledge_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('knowledge_game_id');
                $game_id = rawurldecode($this->encrypt->decode($game_id));
                $segment_url = $this->session->userdata('avg_know_grade_id');
                $avg_know_grade_id = rawurldecode($this->encrypt->decode($segment_url));
                $picture_level = '';
                $picture_quiz = '';
                $data['grade_data'] = $this->Knowledge_grade_model->get_know_grade_by_id($avg_know_grade_id, $game_id);
                foreach ($data['grade_data'] as $row) {
                    $picture_level = $row->know_level_img;
                    $picture_quiz = $row->know_qz_img;
                }

                if ($this->Knowledge_grade_model->delete_knowledge_grade($avg_know_grade_id, $game_id)) {
                    $path1 = 'application/views/asset/image/knowledge_level/' . $picture_level;
                    file_exists($path1) ? unlink($path1) : null;
                    $path2 = 'application/views/asset/image/knowledge_level/' . $picture_quiz;
                    file_exists($path2) ? unlink($path2) : null;
                    $this->session->set_flashdata("add_message", 'delete');
                } else {
                    $this->session->set_flashdata("add_message", 'false');
                }
                redirect('admin_controller/Knowledge_grade/manage_knowledge_grade');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

}
