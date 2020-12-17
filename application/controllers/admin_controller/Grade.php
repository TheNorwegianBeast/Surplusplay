<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Grade extends CI_Controller
{

    /**
     * Calling constructer
     */
    function __construct()
    {
        parent:: __construct();
        $this->load->model('admin_model/Grade_model');
        $this->load->model('admin_model/Level_model');
    }

    /* manage grade */

    public function manage_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                 $segment_url = $this->uri->segment(4); 
                 $segment_url == '' ? $segment_url = $this->session->userdata('grade_game_id') : null;
                $decrypt = rawurldecode($this->encrypt->decode($segment_url));
                    $this->session->set_userdata(
                        array
                        ('grade_game_id' => $segment_url)
                    );
                     $data['view_grade'] = $this->Grade_model->view_grade($decrypt);
                $this->load->view('admin/game/manage_grade', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /**
         * Check valid alpha name
         */
    public function grade_check($str)
    {
        if (! preg_match("/^([a-z0-9+])+$/i", $str)) {
            $this->form_validation->set_message('fullname_check', 'The %s field can only be alpha numeric');
            return false;
        } else {
            return true;
        }
    }

    /* Insert Grade */

    public function insert_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('txt_from_percent', 'From Percentage', 'required|trim|numeric|greater_than[-0.1]|less_than[100.1]');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("from_message", 'Please Enter Valid From Percentage');
                        redirect('admin_controller/Grade/manage_grade');
                    } else {
                        $this->form_validation->set_rules('txt_to_percent', 'To Percentage', 'required|trim|numeric|greater_than[-0.1]|less_than[100.1]');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("to_message", 'Please Enter Valid To Percentage');
                            redirect('admin_controller/Grade/manage_grade');
                        } else {
                            $this->form_validation->set_rules('txt_grade', 'Grade', 'required|trim|callback_grade_check');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("grade_message", 'Please Enter Valid Grade');
                                redirect('admin_controller/Grade/manage_grade');
                            } else {
                                if (empty($_FILES['filebadge']['name'])) {
                                    $this->form_validation->set_rules('filebadge', 'Badge Image', 'required');
                                }
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("file_message", 'Please Select Valid Badge Image');
                                    redirect('admin_controller/Grade/manage_grade');
                                } else {
                                    if (empty($_FILES['congo_file']['name'])) {
                                        $this->form_validation->set_rules('congo_file', 'Congratulation Image', 'trim|required');
                                    }
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("congo_message", 'Please Select Valid Congratulation Image');
                                        redirect('admin_controller/Grade/manage_grade');
                                    } else {
                                        $this->form_validation->set_rules('txt_desc', 'Description', 'required|trim');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("desc_message", 'Please Enter Badge Description');
                                            redirect('admin_controller/Grade/manage_grade');
                                        } else {
                                            $this->form_validation->set_rules('radio_grade', 'Participation', 'required');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("rd_message", 'Please Select Participation');
                                                redirect('admin_controller/Grade/manage_grade');
                                            } else {
                                                $segment_url = $this->session->userdata('grade_game_id');
                                                $game_id = rawurldecode($this->encrypt->decode($segment_url));
                                                $picture = "";
                                                $congo_knowledge = "";
                                                $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                                                $time_stamp = $date->format('YmdHis');
                                                if (!empty($_FILES['filebadge']['name'])) {
                                                    $config['upload_path'] = 'application/views/asset/image/badge/';
                                                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                                    $config['file_name'] = 'badge-'.$time_stamp;
                                                     $file_ext = pathinfo($_FILES['filebadge']['name'], PATHINFO_EXTENSION);
                                                    $this->load->library('upload', $config);
                                                    $this->upload->initialize($config);

                                                    if ($this->upload->do_upload('filebadge')) {
                                                        $uploadData = $this->upload->data();
                                                        $picture = 'badge-'.$time_stamp.'.'.$file_ext;
                                                    }
                                                }

                                                if (!empty($_FILES['congo_file']['name'])) {
                                                    $config['upload_path'] = 'application/views/asset/image/congrats_img/';
                                                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                                    $config['file_name'] = 'congrats-'.$time_stamp;
                                                     $file_ext = pathinfo($_FILES['congo_file']['name'], PATHINFO_EXTENSION);
                                                    $this->load->library('upload', $config);
                                                    $this->upload->initialize($config);

                                                    if ($this->upload->do_upload('congo_file')) {
                                                        $uploadData = $this->upload->data();
                                                        $congo_knowledge = 'congrats-'.$time_stamp.'.'.$file_ext;
                                                    }
                                                }

                                                $from_per = $this->input->post('txt_from_percent');
                                                $to_per = $this->input->post('txt_to_percent');
                                                $txt_grade = $this->input->post('txt_grade');
                                                $txt_desc = $this->input->post('txt_desc');
                                                $radio_grade = $this->input->post('radio_grade');

                                                $insert_grade = array(
                                                    'game_id' => $game_id,
                                                    'from_percentage' => $from_per,
                                                    'to_percentage' => $to_per,
                                                    'grade' => $txt_grade,
                                                    'description' => $txt_desc,
                                                    'is_attempt' => $radio_grade,
                                                    'badge_image' => $picture,
                                                    'congrats_img' => $congo_knowledge
                                                );

                                                $user_id = $this->Grade_model->add_grade($insert_grade, $game_id);
                                                ($user_id > 0) 
                                                ? ($this->session->set_flashdata("add_message", "true")) 
                                                : $this->session->set_flashdata("add_message", "false");
                                                redirect('admin_controller/Grade/manage_grade');
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

    /* edit grade */

    public function edit_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->session->userdata('grade_game_id');
                $new_game_id = rawurldecode($this->encrypt->decode($game_id));
                $segment_url = $this->uri->segment(4); 
                $segment_url == '' ? $segment_url = $this->session->userdata('grade_id') : null;
                $decrypt = rawurldecode($this->encrypt->decode($segment_url));
                $data['g_game_id'] = $new_game_id;
                $data['edit_grade'] = $this->Grade_model->view_grade_by_id($decrypt, $new_game_id);
                $this->session->set_userdata(
                    array
                        ('grade_id' => $segment_url)
                );
                $this->load->view('admin/game/edit_grade', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update grade */

   
    public function update_grade()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_update')) {
                    $this->form_validation->set_rules('txt_from_percent', 'From Percentage', 'required|trim|numeric|greater_than[-0.1]|less_than[100.1]');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("from_message", 'Please Enter Valid From Percentage');
                        redirect('admin_controller/Grade/edit_grade');
                    } else {
                        $this->form_validation->set_rules('txt_to_percent', 'To Percentage', 'required|trim|numeric|greater_than[-0.1]|less_than[100.1]');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("to_message", 'Please Enter Valid To Percentage');
                            redirect('admin_controller/Grade/edit_grade');
                        } else {
                            $this->form_validation->set_rules('txt_grade', 'Grade', 'required|trim|callback_grade_check');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("grade_message", 'Please Enter Valid Grade');
                                redirect('admin_controller/Grade/edit_grade');
                            } else {
                                $this->form_validation->set_rules('txt_desc', 'Description', 'required|trim');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("desc_message", 'Please Enter Badge Description');
                                    redirect('admin_controller/Grade/edit_grade');
                                } else {
                                    $this->form_validation->set_rules('radio_grade', 'Participation', 'required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("rd_message", 'Please Select Participation');
                                        redirect('admin_controller/Grade/edit_grade');
                                    } else {
                                        $segment_url = $this->session->userdata('grade_game_id');
                                        $game_id = rawurldecode($this->encrypt->decode($segment_url));
                                        $grade_id = $this->session->userdata('grade_id');
                                        $grade_id = rawurldecode($this->encrypt->decode($grade_id));
                                        $picture_badge = '';
                                        $picture_congrats = '';
                                        $badge_img = '';
                                        $congo_img = '';
                                        $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                                        $time_stamp = $date->format('YmdHis');
                                        $data['grade_data'] = $this->Grade_model->view_grade_by_id($grade_id, $game_id);
                                        foreach ($data['grade_data'] as $row) {
                                            $badge_img = $row->badge_image;
                                            $congo_img = $row->congrats_img;
                                        }

                                        if (!empty($_FILES['filebadge']['name'])) {
                                            $config['upload_path'] = 'application/views/asset/image/badge/';
                                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                            $config['file_name'] = 'badge-'.$time_stamp;
                                            $file_ext = pathinfo($_FILES['filebadge']['name'], PATHINFO_EXTENSION);

                                            /* Load upload library and initialize configuration */
                                            $this->load->library('upload', $config);
                                            $this->upload->initialize($config);

                                            if ($this->upload->do_upload('filebadge')) {
                                                $uploadData = $this->upload->data();
                                                $picture_badge = $badge_img;
                                                $badge_img = 'badge-'.$time_stamp.'.'.$file_ext;
                                            }
                                        }

                                        if (!empty($_FILES['file_congo']['name'])) {
                                            $config['upload_path'] = 'application/views/asset/image/congrats_img/';
                                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                            $config['file_name'] = 'congrats-'.$time_stamp;
                                            $file_ext = pathinfo($_FILES['file_congo']['name'], PATHINFO_EXTENSION);

                                            /* Load upload library and initialize configuration */
                                            $this->load->library('upload', $config);
                                            $this->upload->initialize($config);

                                            if ($this->upload->do_upload('file_congo')) {
                                                $uploadData = $this->upload->data();
                                                $picture_congrats = $congo_img;
                                                $congo_img = 'congrats-'.$time_stamp.'.'.$file_ext;
                                            }
                                        }
                                        $from_percentage = $this->input->post('txt_from_percent');
                                        $to_percentage = $this->input->post('txt_to_percent');
                                        $grade = $this->input->post('txt_grade');
                                        $description = $this->input->post('txt_desc');
                                        $is_attempt = $this->input->post('radio_grade');

                                        $update_grade = array(
                                            'game_id' => $game_id,
                                            'from_percentage' => $from_percentage,
                                            'to_percentage' => $to_percentage,
                                            'grade' => $grade,
                                            'description' => $description,
                                            'is_attempt' => $is_attempt,
                                            'badge_image' => $badge_img,
                                            'congrats_img' => $congo_img
                                        );
                                        $user_id = $this->Grade_model->update_grade($update_grade, $game_id, $grade_id);
                                        if ($user_id > 0) {
                                            $this->session->set_flashdata("add_message", "update");
                                            $path1 = 'application/views/asset/image/badge/' . $picture_badge;
                                            (file_exists($path1) ? unlink($path1) : null);
                                            $path2 = 'application/views/asset/image/congrats_img/' . $picture_congrats;
                                            file_exists($path2) ? unlink($path2) : null;
                                            redirect('admin_controller/Grade/edit_grade');
                                        } else {
                                            $this->session->set_flashdata("add_message", "false");
                                            redirect('admin_controller/Grade/edit_grade');
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Grade/manage_grade');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* Delete Grade */

    public function delete_grade($grade_id)
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                     $game_id = $this->session->userdata('grade_game_id');
                     $game_id = rawurldecode($this->encrypt->decode($game_id));
                     $grade_id = rawurldecode($this->encrypt->decode($grade_id));

                    $badge_img = '';
                    $congo_img = '';
                    $data['grade_data'] = $this->Grade_model->view_grade_by_id($grade_id, $game_id);
                foreach ($data['grade_data'] as $row) {
                    $badge_img = $row->badge_image;
                    $congo_img = $row->congrats_img;
                }

                if ($this->Grade_model->delete_grade($grade_id, $game_id)) {
                    $path1 = 'application/views/asset/image/badge/' . $badge_img;
                    (file_exists($path1) ? unlink($path1) : null);
                    $path2 = 'application/views/asset/image/congrats_img/' . $congo_img;
                    file_exists($path2) ? unlink($path2) : null;
                    $this->session->set_flashdata("add_message", "delete");
                    redirect('admin_controller/Grade/manage_grade');
                } else {
                    $this->session->set_flashdata("add_message", "false");
                    redirect('admin_controller/Grade/manage_grade');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

}
