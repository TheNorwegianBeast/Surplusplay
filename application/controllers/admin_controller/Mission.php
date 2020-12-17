<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mission extends CI_Controller {

    /**
     * Calling Constructer
     */
    function __construct() {
        parent:: __construct();
        $this->load->model('admin_model/Mission_model');
        $this->load->model('admin_model/User_model');
        $this->load->model('admin_model/Level_model');
    }

    /**
     * Add mission
     */
    public function add_mission() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $data['level'] = $this->Level_model->select_game();
                $this->load->view('admin/mission/add_mission', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert mission */

    public function insert_mission() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('select_game', 'Select Game', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("game_message", 'Please select game!');
                        redirect('admin_controller/Mission/add_mission');
                    } else {
                        $this->form_validation->set_rules('select_level', 'Level Name', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("level_message", 'Please select level!');
                            redirect('admin_controller/Mission/add_mission');
                        } else {
                            if (empty($_FILES['file_image']['name'])) {
                                $this->form_validation->set_rules('file_image', 'City Image', 'trim|required');
                                $this->session->set_flashdata("file_message", 'Please Select City Image!');
                                redirect('admin_controller/Mission/add_mission');
                            } else {
                                $this->form_validation->set_rules('txt_city', 'City name', 'trim|required|callback_alpha_dash_space');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("city_message", 'Please Enter valid City name!');
                                    redirect('admin_controller/Mission/add_mission');
                                } else {
                                    $this->form_validation->set_rules('txt_step', 'Mission step', 'trim|required|callback_fullname_check');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("step_message", 'Please Enter valid Mission step!');
                                        redirect('admin_controller/Mission/add_mission');
                                    } else {
                                        $this->form_validation->set_rules('txt_total_question', 'Total Question', 'trim|required|numeric|greater_than[0.99]');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("que_message", 'Please Enter valid Total Question number!');
                                            redirect('admin_controller/Mission/add_mission');
                                        } else {
                                            $this->form_validation->set_rules('txt_correct_answer', 'Correct Answer', 'trim|required|numeric|greater_than[0.99]');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("ans_message", 'Please Enter valid Correct Answer Point!');
                                                redirect('admin_controller/Mission/add_mission');
                                            } else {
                                                $this->form_validation->set_rules('txt_time', 'Time Limit', 'trim|required|numeric|greater_than[0.99]');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("time_message", 'Please Enter valid Time Limit!');
                                                    redirect('admin_controller/Mission/add_mission');
                                                } else {
                                                    $this->form_validation->set_rules('radio_result', 'Result', 'trim|required');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("res_message", 'Please Select Any Result!');
                                                        redirect('admin_controller/Mission/add_mission');
                                                    } else {
                                                        $picture = '';
                                                        $city_name = $this->input->post('txt_city');
                                                        $mission_step = $this->input->post('txt_step');
                                                        $level_id = $this->input->post('select_level');
                                                        $time_limit = $this->input->post('txt_time');
                                                        $from_date = $this->input->post('txt_from_date');
                                                        $to_date = $this->input->post('txt_to_date');
                                                        $result = $this->input->post('radio_result');
                                                        $correct_answer = $this->input->post('txt_correct_answer');
                                                        $total_question = $this->input->post('txt_total_question');
                                                        $game_id = $this->input->post('select_game');
                                                        if (!empty($_FILES['file_image']['name'])) {
                                                            $config['upload_path'] = 'application/views/asset/image/porsche_city/';
                                                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                                            $config['file_name'] = $_FILES['file_image']['name'];

                                                            /* Load upload library and initialize configuration */
                                                            $this->load->library('upload', $config);
                                                            $this->upload->initialize($config);

                                                            if ($this->upload->do_upload('file_image')) {
                                                                $uploadData = $this->upload->data();
                                                                $picture = $uploadData['file_name'];
                                                            }
                                                        }

                                                        $insert_mission = array(
                                                            'game_id' => $game_id,
                                                            'city_image' => $picture,
                                                            'city_name' => $city_name,
                                                            'mission_step' => $mission_step,
                                                            'level_id' => $level_id,
                                                            'per_correct_question_point' => $correct_answer,
                                                            'total_question' => $total_question,
                                                            'time_limit' => $time_limit,
                                                            'from_date' => $from_date,
                                                            'to_date' => $to_date,
                                                            'result' => $result,
                                                            'total_points' => $total_question * $correct_answer,
                                                        );
                                                        $user_id = $this->Mission_model->add_mission($insert_mission, $game_id);
                                                        if ($user_id > 0) {
                                                            $this->session->set_flashdata("suc_message", 'true');
                                                            redirect('admin_controller/Mission/get_mission');
                                                        } else {
                                                            $this->session->set_flashdata("suc_message", 'false');
                                                            redirect('admin_controller/Mission/add_mission');
                                                        }
                                                    }
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

    /* get all mission */

    public function get_mission() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->input->post('select_game');
                $user_game = '';
                $game_id == '' ? $game_id = 1 : null;
                $this->session->set_userdata(
                        array(
                            'mission_game_id' => $game_id
                        )
                );
                $data['game'] = $this->Game_model->fetch_user_game($game_id);
                $data['get_mission'] = $this->Mission_model->get_all_mission($game_id);
                $data['game_name'] = $this->Game_model->fetch_one_game($game_id);
                foreach ($data['game_name'] as $row) {
                    $user_game = $row->game_name;
                }
                $data['sel_game'] = $user_game;
                $this->load->view('admin/mission/view_mission', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get mission by id */

    public function get_mission_by_id() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->uri->segment(4);
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $data['get_single_mission'] = $this->Mission_model->get_mission_by_id($game_id, $mission_id);
                $this->load->view('admin/mission/view_one_mission', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* edit mission by id */

    public function edit_mission() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('url_mission_id') : null;
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                        array
                            ('url_mission_id' => $segment_url)
                );
                $data['get_single_mission'] = $this->Mission_model->get_mission_by_id($game_id, $mission_id);
                $this->load->view('admin/mission/edit_mission', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update mission */

    public function update_mission() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('update_mission')) {
                    $this->form_validation->set_rules('txt_city', 'City name', 'trim|required|callback_alpha_dash_space');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("city_message", 'Please Enter valid City name!');
                        redirect('admin_controller/Mission/edit_mission');
                    } else {
                        $this->form_validation->set_rules('txt_step', 'Mission step', 'trim|required|callback_fullname_check');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("step_message", 'Please Enter valid Mission step.');
                            redirect('admin_controller/Mission/edit_mission');
                        } else {
                            $this->form_validation->set_rules('txt_total_question', 'Total Question', 'trim|required|numeric|greater_than[0.99]');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("que_message", 'Please Enter valid Total Question number!');
                                redirect('admin_controller/Mission/edit_mission');
                            } else {
                                $this->form_validation->set_rules('txt_correct_answer', 'Correct Answer', 'trim|required|numeric|greater_than[0.99]');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("ans_message", 'Please Enter valid Correct Answer Point!');
                                    redirect('admin_controller/Mission/edit_mission');
                                } else {
                                    $this->form_validation->set_rules('txt_time', 'Time Limit', 'trim|required|numeric|greater_than[0.99]');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("time_message", 'Please Enter valid Time Limit!');
                                        redirect('admin_controller/Mission/edit_mission');
                                    } else {
                                        $this->form_validation->set_rules('radio_result', 'Result', 'trim|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("res_message", 'Please Select Any Result!');
                                            redirect('admin_controller/Mission/edit_mission');
                                        } else {
                                            $segment_url = $this->session->userdata('url_mission_id');
                                            $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                                            $correct_answer = $this->input->post('txt_correct_answer');
                                            $total_question = $this->input->post('txt_total_question');
                                            $game_id = $this->session->userdata('mission_game_id');
                                            $picture = '';
                                            $data['image'] = $this->Mission_model->get_mission_by_id($game_id, $mission_id);
                                            $img = '';
                                            foreach ($data['image'] as $row) {
                                                $img = $row->city_image;
                                            }
                                            if (!empty($_FILES['file_city']['name'])) {
                                                $config['upload_path'] = 'application/views/asset/image/porsche_city/';
                                                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                                $config['file_name'] = $_FILES['file_city']['name'];

                                                /* Load upload library and initialize configuration */
                                                $this->load->library('upload', $config);
                                                $this->upload->initialize($config);

                                                if ($this->upload->do_upload('file_city')) {
                                                    $uploadData = $this->upload->data();
                                                    $picture = $uploadData['file_name'];
                                                }
                                                $update_mission = array(
                                                    'game_id' => $game_id,
                                                    'city_image' => $picture,
                                                    'city_name' => $this->input->post('txt_city'),
                                                    'mission_step' => $this->input->post('txt_step'),
                                                    'per_correct_question_point' => $this->input->post('txt_correct_answer'),
                                                    'total_question' => $this->input->post('txt_total_question'),
                                                    'time_limit' => $this->input->post('txt_time'),
                                                    'from_date' => $this->input->post('txt_from_date'),
                                                    'to_date' => $this->input->post('txt_to_date'),
                                                    'result' => $this->input->post('radio_result'),
                                                    'total_points' => $total_question * $correct_answer
                                                );
                                                if ($this->Mission_model->update_mission($update_mission, $game_id, $mission_id)) {
                                                    $path = 'application/views/asset/image/porsche_city/' . $img;
                                                    file_exists($path) ? unlink($path) : null;
                                                    $this->session->set_flashdata("suc_message", 'update');
                                                    redirect('admin_controller/Mission/edit_mission');
                                                } else {
                                                    $this->session->set_flashdata("suc_message", 'false');
                                                    redirect('admin_controller/Mission/edit_mission');
                                                }
                                            } else {
                                                $update_mission = array(
                                                    'game_id' => $game_id,
                                                    'city_name' => $this->input->post('txt_city'),
                                                    'mission_step' => $this->input->post('txt_step'),
                                                    'per_correct_question_point' => $this->input->post('txt_correct_answer'),
                                                    'total_question' => $this->input->post('txt_total_question'),
                                                    'time_limit' => $this->input->post('txt_time'),
                                                    'from_date' => $this->input->post('txt_from_date'),
                                                    'to_date' => $this->input->post('txt_to_date'),
                                                    'result' => $this->input->post('radio_result'),
                                                    'total_points' => $total_question * $correct_answer
                                                );
                                                ($this->Mission_model->update_mission($update_mission, $game_id, $mission_id)) ? ($this->session->set_flashdata("suc_message", "update")) : $this->session->set_flashdata("suc_message", "false");
                                                redirect('admin_controller/Mission/edit_mission');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Mission/get_mission');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* Delete Mission */

    public function delete_mission() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->uri->segment(4);
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $data['image'] = $this->Mission_model->get_mission_by_id($game_id, $mission_id);
                $img = '';
                foreach ($data['image'] as $row) {
                    $img = $row->city_image;
                }
                if ($this->Mission_model->delete_mission($mission_id, $game_id)) {
                    $path = 'application/views/asset/image/porsche_city/' . $img;
                    file_exists($path) ? unlink($path) : null;
                    $this->session->set_flashdata("suc_message", 'delete');
                    redirect('admin_controller/Mission/get_mission');
                } else {
                    $this->session->set_flashdata("suc_message", 'false');
                    redirect('admin_controller/Mission/get_mission');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $ex) {
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
        }
    }

    /* insert question */

    public function insert_question() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_save')) {
                    $game_id = $this->session->userdata('mission_game_id');
                    $segment_url = $this->session->userdata('que_mission_id');
                    $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                    $count = $this->Mission_model->get_question_count($game_id, $mission_id);
                    $total_count = $count[0]->QCount;
                    $que_count = $this->Mission_model->get_mission_by_id($game_id, $mission_id);
                    $mission_que = $que_count[0]->total_question;

                    if ($total_count >= $mission_que) {
                        $this->session->set_flashdata("count_message", 'count');
                        redirect('admin_controller/Mission/manage_question');
                    } else {
                        $this->form_validation->set_rules('txt_question', 'Question', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("message", 'Please enter question title!');
                            redirect('admin_controller/Mission/manage_question');
                        } else {
                            $this->form_validation->set_rules('txt_op_a', 'Option A', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("a_message", 'Please enter option A!');
                                redirect('admin_controller/Mission/manage_question');
                            } else {
                                $this->form_validation->set_rules('txt_op_b', 'Option B', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("b_message", 'Please enter option B!');
                                    redirect('admin_controller/Mission/manage_question');
                                } else {
                                    $this->form_validation->set_rules('txt_op_c', 'Option C', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("c_message", 'Please enter option C!');
                                        redirect('admin_controller/Mission/manage_question');
                                    } else {
                                        $this->form_validation->set_rules('txt_op_d', 'Option D', 'trim|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("d_message", 'Please enter option D!');
                                            redirect('admin_controller/Mission/manage_question');
                                        } else {
                                            $this->form_validation->set_rules('radiograde', 'Correct Option', 'trim|required');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("radio_message", 'Please select one correct option!');
                                                redirect('admin_controller/Mission/manage_question');
                                            } else {
                                                $this->form_validation->set_rules('txt_desc', 'Answer desc', 'trim|required');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("exp_message", 'Please enter asnwer description!');
                                                    redirect('admin_controller/Mission/manage_question');
                                                } else {
                                                    $question_lbl = $this->input->post('txt_question');
                                                    $option_a = $this->input->post('txt_op_a');
                                                    $option_b = $this->input->post('txt_op_b');
                                                    $option_c = $this->input->post('txt_op_c');
                                                    $option_d = $this->input->post('txt_op_d');
                                                    $correct_opt = $this->input->post('radiograde');
                                                    $correct_desc = $this->input->post('txt_desc');

                                                    $data = array(
                                                        'game_id' => $game_id,
                                                        'mission_id' => $mission_id,
                                                        'question_label' => $question_lbl,
                                                        'option_a' => $option_a,
                                                        'option_b' => $option_b,
                                                        'option_c' => $option_c,
                                                        'option_d' => $option_d,
                                                        'correct_answer' => $correct_opt,
                                                        'answer_explaination' => $correct_desc
                                                    );
                                                    $res = $this->Mission_model->insert_question($data, $game_id, $mission_id);
                                                    ($res == true) ? ($this->session->set_flashdata("suc_message", "true")) : $this->session->set_flashdata("suc_message", "false");
                                                    redirect('admin_controller/Mission/manage_question');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Mission/get_mission');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* manage question */

    public function manage_question() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('que_mission_id') : null;
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                        array(
                            'que_mission_id' => $segment_url
                        )
                );
                $data['question'] = $this->Mission_model->get_question_by_id($game_id, $mission_id);
                $this->load->view('admin/mission/manage_question', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view question */

    public function view_one_question() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->session->userdata('que_mission_id');
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $question_id = $this->uri->segment(4);
                $question_id = rawurldecode($this->encrypt->decode($question_id));
                $data['question'] = $this->Mission_model->get_question($game_id, $mission_id, $question_id);
                $this->load->view('admin/mission/view_question', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* edit question */

    public function edit_question() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->session->userdata('que_mission_id');
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $segment_que_url = $this->uri->segment(4);
                $segment_que_url == '' ? $segment_que_url = $this->session->userdata('que_question_id') : null;
                $this->session->set_userdata(
                        array(
                            'que_question_id' => $segment_que_url
                        )
                );
                $question_id = rawurldecode($this->encrypt->decode($segment_que_url));
                $data['question'] = $this->Mission_model->get_question($game_id, $mission_id, $question_id);
                $this->load->view('admin/mission/edit_question', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update question */

    public function update_question() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_update')) {
                    $this->form_validation->set_rules('txt_question', 'Question', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("message", 'Please enter question title!');
                        redirect('admin_controller/Mission/edit_question');
                    } else {
                        $this->form_validation->set_rules('option_a', 'Option A', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("a_message", 'Please enter option A!');
                            redirect('admin_controller/Mission/edit_question');
                        } else {
                            $this->form_validation->set_rules('option_b', 'Option B', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("b_message", 'Please enter option B!');
                                redirect('admin_controller/Mission/edit_question');
                            } else {
                                $this->form_validation->set_rules('option_c', 'Option C', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("c_message", 'Please enter option C!');
                                    redirect('admin_controller/Mission/edit_question');
                                } else {
                                    $this->form_validation->set_rules('option_d', 'Option D', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("d_message", 'Please enter option D!');
                                        redirect('admin_controller/Mission/edit_question');
                                    } else {
                                        $this->form_validation->set_rules('radiograde', 'Correct Option', 'trim|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("radio_message", 'Please select one correct option!');
                                            redirect('admin_controller/Mission/edit_question');
                                        } else {
                                            $this->form_validation->set_rules('txt_desc', 'Answer desc', 'trim|required');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("exp_message", 'Please enter asnwer description!');
                                                redirect('admin_controller/Mission/edit_question');
                                            } else {
                                                $game_id = $this->session->userdata('mission_game_id');
                                                $segment_url = $this->session->userdata('que_mission_id');
                                                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                                                $que_id = $this->session->userdata('que_question_id');
                                                $que_id = rawurldecode($this->encrypt->decode($que_id));
                                                $question_lbl = $this->input->post('txt_question');
                                                $option_a = $this->input->post('option_a');
                                                $option_b = $this->input->post('option_b');
                                                $option_c = $this->input->post('option_c');
                                                $option_d = $this->input->post('option_d');
                                                $correct_opt = $this->input->post('radiograde');
                                                $correct_desc = $this->input->post('txt_desc');

                                                $data = array(
                                                    'question_label' => $question_lbl,
                                                    'option_a' => $option_a,
                                                    'option_b' => $option_b,
                                                    'option_c' => $option_c,
                                                    'option_d' => $option_d,
                                                    'correct_answer' => $correct_opt,
                                                    'answer_explaination' => $correct_desc
                                                );
                                                $res = $this->Mission_model->update_question($game_id, $mission_id, $que_id, $data);
                                                ($res == true) ? ($this->session->set_flashdata("suc_message", "update")) : $this->session->set_flashdata("suc_message", "false");
                                                redirect('admin_controller/Mission/edit_question');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Mission/manage_question');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete question */

    public function delete_question() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->session->userdata('que_mission_id');
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $que_id = $this->uri->segment(4);
                $question_id = rawurldecode($this->encrypt->decode($que_id));
                ($this->Mission_model->delete_question($game_id, $mission_id, $question_id)) ? ($this->session->set_flashdata("suc_message", "delete")) : $this->session->set_flashdata("suc_message", "false");
                redirect('admin_controller/Mission/manage_question');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* manage knowledge */

    public function manage_knowledge() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('know_mission_id') : null;
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $data['knowledge'] = $this->Mission_model->get_knowledge($game_id, $mission_id);
                $this->session->set_userdata(
                        array(
                            'know_mission_id' => $segment_url
                        )
                );
                $this->load->view('admin/mission/add_knowledge', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* add knowledge pdf */

    public function add_knowledge_pdf() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->session->userdata('know_mission_id');
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                if ($this->input->post('btn_upload')) {
                    if (empty($_FILES['fileknow']['name'])) {
                        $this->form_validation->set_rules('fileknow', 'PDF File', 'trim|required');
                        $this->session->set_flashdata("message", 'Please select Pdf file');
                        redirect('admin_controller/Mission/manage_knowledge');
                    } else {
                        if (!empty($_FILES['fileknow']['name'])) {
                            $configpdf['upload_path'] = 'application/views/asset/knowledge_media/';
                            $configpdf['max_size'] = '1024000';
                            $configpdf['allowed_types'] = 'application/pdf|pdf';
                            $configpdf['overwrite'] = true;
                            $configpdf['remove_spaces'] = false;
                            $pdf_name = $_FILES['fileknow']['name'];
                            $this->load->library('upload', $configpdf);
                            $this->upload->initialize($configpdf);

                            if (!$this->upload->do_upload('fileknow')) {
                                $this->session->set_flashdata('message', $this->upload->display_errors());
                                redirect('admin_controller/Mission/manage_knowledge');
                            } else {
                                $data = array(
                                    'game_id' => $game_id,
                                    'mission_id' => $mission_id,
                                    'knowledge_type' => 'pdf',
                                    'know_file_name' => $pdf_name
                                );
                                $res = $this->Mission_model->insert_knowledge_video($data, $game_id);
                                ($res) ? ($this->session->set_flashdata("suc_message", "true")) : $this->session->set_flashdata("suc_message", "false");
                                redirect('admin_controller/Mission/manage_knowledge');
                            }
                        }
                    }
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* add knowledge video */

    public function add_knowledge_video() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->session->userdata('know_mission_id');
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                if ($this->input->post('btn_upload')) {
                    if (empty($_FILES['fileknow']['name'])) {
                        $this->form_validation->set_rules('fileknow', 'Video File', 'trim|required');
                        $this->session->set_flashdata("vid_message", 'Please select Video Media');
                        redirect('admin_controller/Mission/manage_knowledge');
                    } else {
                        if (!empty($_FILES['fileknow']['name'])) {
                            $configVideo['upload_path'] = 'application/views/asset/knowledge_media/';
                            $configVideo['max_size'] = '1024000';
                            $configVideo['allowed_types'] = 'avi|flv|wmv|mkv|mp4';
                            $configVideo['overwrite'] = true;
                            $configVideo['remove_spaces'] = false;
                            $video_name = $_FILES['fileknow']['name'];
                            $this->load->library('upload', $configVideo);
                            $this->upload->initialize($configVideo);

                            if (!$this->upload->do_upload('fileknow')) {
                                $this->session->set_flashdata('vid_message', $this->upload->display_errors());
                                redirect('admin_controller/Mission/manage_knowledge');
                            } else {
                                $data = array(
                                    'game_id' => $game_id,
                                    'mission_id' => $mission_id,
                                    'knowledge_type' => 'video',
                                    'know_file_name' => $video_name
                                );

                                ($this->Mission_model->insert_knowledge_video($data, $game_id)) ? ($this->session->set_flashdata("suc_message", "true")) : $this->session->set_flashdata("suc_message", "false");
                                redirect('admin_controller/Mission/manage_knowledge');
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Mission/get_mission');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view knowledge */

    public function view_knowledge($segment_url) {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $knowledge_id = rawurldecode($this->encrypt->decode($segment_url));
                $data['knowledge'] = $this->Mission_model->get_one_knowledge($game_id, $knowledge_id);
                $this->load->view('admin/mission/view_knowledge', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* edit knowledge */

    public function edit_knowledge() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('know_knowledge_id') : null;
                $this->session->set_userdata(
                        array(
                            'know_knowledge_id' => $segment_url
                        )
                );
                $knowledge_id = rawurldecode($this->encrypt->decode($segment_url));
                $data['knowledge'] = $this->Mission_model->get_one_knowledge($game_id, $knowledge_id);
                $this->load->view('admin/mission/edit_knowledge', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update knowledge media */

    public function update_knowledge_media() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                if ($this->input->post('btn_update')) {
                    if (empty($_FILES['media_file']['name'])) {
                        $this->form_validation->set_rules('media_file', 'Media File', 'trim|required');
                        $this->session->set_flashdata("message", 'Please select Knowledge Media file');
                        redirect('admin_controller/Mission/edit_knowledge');
                    } else {
                        $segment_url = $this->session->userdata('know_knowledge_id');
                        $knowledge_id = rawurldecode($this->encrypt->decode($segment_url));
                        if (!empty($_FILES['media_file']['name'])) {
                            $configVideo['upload_path'] = 'application/views/asset/knowledge_media/';
                            $configVideo['max_size'] = '1024000';
                            $configVideo['allowed_types'] = 'avi|flv|wmv|mkv|mp4|application/pdf|pdf';
                            $configVideo['overwrite'] = true;
                            $configVideo['remove_spaces'] = false;
                            $video_name = $_FILES['media_file']['name'];
                            $this->load->library('upload', $configVideo);
                            $this->upload->initialize($configVideo);

                            if (!$this->upload->do_upload('media_file')) {
                                $this->session->set_flashdata("message", $this->upload->display_errors());
                                redirect('admin_controller/Mission/edit_knowledge');
                            } else {
                                $media_data = '';
                                $data = array(
                                    'know_file_name' => $video_name
                                );
                                $media['knowledge'] = $this->Mission_model->get_one_knowledge($game_id, $knowledge_id);
                                foreach ($media['knowledge'] as $row) {
                                    $media_data = $row->know_file_name;
                                }
                                if ($this->Mission_model->update_knowledge($game_id, $knowledge_id, $data)) {
                                    $path = 'application/views/asset/knowledge_media/' . $media_data;
                                    file_exists($path) ? unlink($path) : null;
                                    $this->session->set_flashdata('suc_message', 'update');
                                    redirect('admin_controller/Mission/edit_knowledge');
                                } else {
                                    $this->session->set_flashdata('suc_message', 'false');
                                    redirect('admin_controller/Mission/edit_knowledge');
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Mission/manage_knowledge');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* deletes knowledge */

    public function delete_knowledge() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $segment_url = $this->uri->segment(4);
                $knowledge_id = rawurldecode($this->encrypt->decode($segment_url));
                $picture = '';
                $data['knowledge'] = $this->Mission_model->get_one_knowledge($game_id, $knowledge_id);
                foreach ($data['knowledge'] as $row) {
                    $picture = $row->know_file_name;
                }
                if ($this->Mission_model->delete_knowledge($game_id, $knowledge_id)) {
                    $path = 'application/views/asset/knowledge_media/' . $picture;
                    file_exists($path) ? unlink($path) : null;
                    $this->session->set_flashdata('suc_message', 'delete');
                    redirect('admin_controller/Mission/manage_knowledge');
                } else {
                    $this->session->set_flashdata('suc_message', 'false');
                    redirect('admin_controller/Mission/manage_knowledge');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /*   View Budget */

    public function view_budget() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $game_id == '' ? $game_id = $this->session->userdata('user_game_id') : null;
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('bud_mission_id') : null;
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                        array(
                            'bud_mission_id' => $segment_url,
                        )
                );
                $data['budget'] = $this->Mission_model->get_budget($game_id, $mission_id);
                $data['mission'] = $this->Mission_model->get_mission_by_id($game_id, $mission_id);
                $data['user'] = $this->User_model->fetch_player($game_id);
                $this->load->view('admin/mission/add_budget', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /**
     * Check email
     */
    public function check_user_bugdet() {
        $new_token = $this->security->get_csrf_hash();
        $response = false;
        $game_id = $this->session->userdata('mission_game_id');
        $game_id == '' ? $game_id = $this->session->userdata('user_game_id') : null;
        $segment_url = $this->session->userdata('bud_mission_id');
        $mission_id = rawurldecode($this->encrypt->decode($segment_url));
        $userident = $this->input->post('userident');
        if ($this->input->post('userident') != '') {
            $response = $this->Mission_model->get_user_budget($game_id, $mission_id, $userident);
        }
        echo json_encode(array('token' => $new_token, 'response' => $response));
        exit();
    }

    /**
     * Check alpha numric data
     */
    public function fullname_check($str) {
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
    function alpha_dash($fullname) {
        if (!preg_match('/^[a-zA-Z]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only be alpha characters');
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check valid name
     */
    function alpha_dash_space($fullname) {
        if (!preg_match('/^[a-zA-Z ]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only be alpha characters');
            return false;
        } else {
            return true;
        }
    }

    /* insert budget */

    public function insert_budget() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("u_message", 'Please Select Valid User Name');
                        redirect('admin_controller/Mission/view_budget');
                    } else {
                        $this->form_validation->set_rules('txt_user', 'Userident', 'trim|required|callback_fullname_check');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("uid_message", 'Please Select Valid User Name');
                            redirect('admin_controller/Mission/view_budget');
                        } else {
                            $this->form_validation->set_rules('txt_budget_type', 'Budget On', 'required|trim|callback_alpha_dash');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("bud_message", 'Please Select Valid Budget Type');
                                redirect('admin_controller/Mission/view_budget');
                            } else {
                                $this->form_validation->set_rules('txt_year', 'Year', 'required|trim|numeric|exact_length[04]');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("year_message", 'Please Enter Valid Year');
                                    redirect('admin_controller/Mission/view_budget');
                                } else {
                                    $this->form_validation->set_rules('txt_day_to_comp', 'Day to Complete', 'trim|required|numeric|greater_than[0.99]');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("day_message", 'Please Enter Valid Days to Complete');
                                        redirect('admin_controller/Mission/view_budget');
                                    } else {
                                        $game_id = $this->session->userdata('mission_game_id');
                                        $game_id == '' ? $game_id = $this->session->userdata('user_game_id') : null;
                                        $segment_url = $this->session->userdata('bud_mission_id');
                                        $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                                        $user_id = $this->input->post('txt_user');
                                        $bud_count = 0;
                                        $data['budgt'] = $this->Mission_model->get_user_budget($game_id, $mission_id, $user_id);
                                        foreach ($data['budgt'] as $row) {
                                            $bud_count = $row->BCount;
                                        }
                                        if ($bud_count > 0) {
                                            $this->session->set_flashdata("userbud_message", "budget");
                                            redirect('admin_controller/Mission/view_budget');
                                        } else {
                                            $bud_type = $this->input->post('txt_budget_type');
                                            $user_name = "";

                                            $data['user'] = $this->User_model->fetch_user_ident($game_id, $user_id);
                                            foreach ($data['user'] as $row) {
                                                $user_name = $row->first_name . " " . $row->last_name;
                                            }
                                            if ($bud_type == "Amount") {
                                                $this->form_validation->set_rules('txt_amt_reg', 'Amount for Registration', 'trim|required|greater_than[0.99]');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("amt_Rmessage", 'Please Enter Valid Amount for Registration');
                                                    redirect('admin_controller/Mission/view_budget');
                                                } else {
                                                    $this->form_validation->set_rules('txt_amt_drive', 'Amount for Testdrive', 'trim|required|greater_than[0.99]');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("amt_Tmessage", 'Please Enter Valid Amount for Testdrive');
                                                        redirect('admin_controller/Mission/view_budget');
                                                    } else {
                                                        $amount = $this->input->post('txt_amt_reg');
                                                        $quant = 0;
                                                        $amount_test = $this->input->post('txt_amt_drive');
                                                        $quant_test = 0;
                                                    }
                                                }
                                            }

                                            if ($bud_type == "Quantity") {
                                                $this->form_validation->set_rules('txt_quan_reg', 'Quantity for Registration', 'trim|required|greater_than[0.99]');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("qty_Rmessage", 'Please Enter Valid Quantity for Registration');
                                                    redirect('admin_controller/Mission/view_budget');
                                                } else {
                                                    $this->form_validation->set_rules('txt_quan_drive', 'Quantity for Testdrive', 'trim|required|greater_than[0.99]');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("qty_Tmessage", 'Please Enter Valid Quantity for Testdrive');
                                                        redirect('admin_controller/Mission/view_budget');
                                                    } else {
                                                        $quant = $this->input->post('txt_quan_reg');
                                                        $amount = 0;
                                                        $quant_test = $this->input->post('txt_quan_drive');
                                                        $amount_test = 0;
                                                    }
                                                }
                                            }

                                            if ($bud_type == "Amount And Quantity" || $bud_type == "Amount Or Quantity") {
                                                $this->form_validation->set_rules('txt_amt_reg', 'Amount for Registration', 'trim|required|greater_than[0.99]');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("amt_Rmessage", 'Please Enter Valid Amount for Registration');
                                                    redirect('admin_controller/Mission/view_budget');
                                                } else {
                                                    $this->form_validation->set_rules('txt_amt_drive', 'Amount for Testdrive', 'trim|required|greater_than[0.99]');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("amt_Tmessage", 'Please Enter Valid Amount for Testdrive');
                                                        redirect('admin_controller/Mission/view_budget');
                                                    } else {
                                                        $this->form_validation->set_rules('txt_quan_reg', 'Quantity for Registration', 'trim|required|greater_than[0.99]');
                                                        if ($this->form_validation->run() == false) {
                                                            $this->session->set_flashdata("qty_Rmessage", 'Please Enter Valid Quantity for Registration');
                                                            redirect('admin_controller/Mission/view_budget');
                                                        } else {
                                                            $this->form_validation->set_rules('txt_quan_drive', 'Quantity for Testdrive', 'trim|required|greater_than[0.99]');
                                                            if ($this->form_validation->run() == false) {
                                                                $this->session->set_flashdata("qty_Tmessage", 'Please Enter Valid Quantity for Testdrive');
                                                                redirect('admin_controller/Mission/view_budget');
                                                            } else {
                                                                $quant = $this->input->post('txt_quan_reg');
                                                                $amount = $this->input->post('txt_amt_reg');
                                                                $quant_test = $this->input->post('txt_quan_drive');
                                                                $amount_test = $this->input->post('txt_amt_drive');
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            $year = $this->input->post('txt_year');
                                            $period = $this->input->post('txt_period');
                                            $from_date = $this->input->post('from_date');
                                            $to_date = $this->input->post('to_date');
                                            $txt_day_to_comp = $this->input->post('txt_day_to_comp');
                                            $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                                            $time_stamp = $date->format('m/d/Y h:i:s a');

                                            $data = array(
                                                'timestamp' => $time_stamp,
                                                'username' => $user_name,
                                                'userident' => $user_id,
                                                'game_id' => $game_id,
                                                'mission_id' => $mission_id,
                                                'year' => $year,
                                                'period' => $period,
                                                'date_from' => $from_date,
                                                'date_to' => $to_date,
                                                'amount_car_regi' => $amount,
                                                'quantity_car_regi' => $quant,
                                                'amount_test_drive' => $amount_test,
                                                'quantity_test_drive' => $quant_test,
                                                'budget_on' => $bud_type,
                                                'day_to_complete' => $txt_day_to_comp
                                            );

                                            $res = $this->Mission_model->insert_budget($data, $game_id);
                                            if ($res == true) {
                                                $bud_id = 0;
                                                $user = '';
                                                $miss_id = 0;
                                                $gm_id = 0;
                                                $data1['last_budget'] = $this->Mission_model->fetch_last_budget_id($game_id);
                                                foreach ($data1['last_budget'] as $row) {
                                                    $bud_id = $row->budget_id;
                                                    $user = $row->userident;
                                                    $gm_id = $row->game_id;
                                                    $miss_id = $row->mission_id;
                                                }
                                                $data2 = array(
                                                    'game_id' => $gm_id,
                                                    'userident' => $user,
                                                    'mission_id' => $miss_id,
                                                    'budget_id' => $bud_id,
                                                    'budget_status' => 'assigned',
                                                    'spend_time_minutes' => 0
                                                );
                                                $this->Mission_model->insert_mission_duration($data2, $gm_id);
                                                $this->session->set_flashdata("suc_message", "true");
                                                redirect('admin_controller/Mission/view_budget');
                                            } else {
                                                $this->session->set_flashdata("suc_message", "false");
                                                redirect('admin_controller/Mission/view_budget');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Mission/get_mission');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view one budget */

    public function view_one_budget($segment_bud_url) {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $game_id == '' ? $game_id = $this->session->userdata('user_game_id') : null;
                $segment_url = $this->session->userdata('bud_mission_id');
                $mission_id = rawurldecode($this->encrypt->decode($segment_url));
                $budget_id = rawurldecode($this->encrypt->decode($segment_bud_url));
                $data['budget'] = $this->Mission_model->get_one_budget($game_id, $budget_id);
                $data['mission'] = $this->Mission_model->get_mission_by_id($game_id, $mission_id);
                $this->load->view('admin/mission/view_budget', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* edit budget */

    public function edit_budget() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('mission_game_id');
                $game_id == '' ? $game_id = $this->session->userdata('user_game_id') : null;
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('bud_budget_id') : null;
                $budget_id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                        array(
                            'bud_budget_id' => $segment_url
                        )
                );
                $mission_id = $this->session->userdata('bud_mission_id');
                $mission_id = rawurldecode($this->encrypt->decode($mission_id));
                $data['budget'] = $this->Mission_model->get_one_budget($game_id, $budget_id);
                $data['mission'] = $this->Mission_model->get_mission_by_id($game_id, $mission_id);
                $this->load->view('admin/mission/edit_budget', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update budget */

    public function update_budget() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_update')) {

                    $this->form_validation->set_rules('txt_budget_type', 'Budget On', 'required|trim|callback_alpha_dash');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("bud_message", 'Please Select Valid Budget Type');
                        redirect('admin_controller/Mission/edit_budget');
                    } else {
                        $this->form_validation->set_rules('txt_year', 'Year', 'required|trim|numeric|exact_length[04]');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("year_message", 'Please Enter Valid Year');
                            redirect('admin_controller/Mission/edit_budget');
                        } else {
                            $this->form_validation->set_rules('txt_day_to_comp', 'Day to Complete', 'trim|required|numeric|greater_than[0.99]');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("day_message", 'Please Enter Valid Days to Complete');
                                redirect('admin_controller/Mission/edit_budget');
                            } else {
                                $bud_type = $this->input->post('txt_budget_type');

                                if ($bud_type == "Amount") {
                                    $this->form_validation->set_rules('txt_amt_reg', 'Amount for Registration', 'trim|required|greater_than[0.99]');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("amt_Rmessage", 'Please Enter Valid Amount for Registration');
                                        redirect('admin_controller/Mission/edit_budget');
                                    } else {
                                        $this->form_validation->set_rules('txt_amt_drive', 'Amount for Testdrive', 'trim|required|greater_than[0.99]');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("amt_Tmessage", 'Please Enter Valid Amount for Testdrive');
                                            redirect('admin_controller/Mission/edit_budget');
                                        } else {
                                            $amount = $this->input->post('txt_amt_reg');
                                            $quant = 0;
                                            $amount_test = $this->input->post('txt_amt_drive');
                                            $quant_test = 0;
                                        }
                                    }
                                }

                                if ($bud_type == "Quantity") {
                                    $this->form_validation->set_rules('txt_quan_reg', 'Quantity for Registration', 'trim|required|greater_than[0.99]');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("qty_Rmessage", 'Please Enter Valid Quantity for Registration');
                                        redirect('admin_controller/Mission/edit_budget');
                                    } else {
                                        $this->form_validation->set_rules('txt_quan_drive', 'Quantity for Testdrive', 'trim|required|greater_than[0.99]');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("qty_Tmessage", 'Please Enter Valid Quantity for Testdrive');
                                            redirect('admin_controller/Mission/edit_budget');
                                        } else {
                                            $quant = $this->input->post('txt_quan_reg');
                                            $amount = 0;
                                            $quant_test = $this->input->post('txt_quan_drive');
                                            $amount_test = 0;
                                        }
                                    }
                                }

                                if ($bud_type == "Amount And Quantity" || $bud_type == "Amount Or Quantity") {
                                    $this->form_validation->set_rules('txt_amt_reg', 'Amount for Registration', 'trim|required|greater_than[0.99]');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("amt_Rmessage", 'Please Enter Valid Amount for Registration');
                                        redirect('admin_controller/Mission/edit_budget');
                                    } else {
                                        $this->form_validation->set_rules('txt_amt_drive', 'Amount for Testdrive', 'trim|required|greater_than[0.99]');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("amt_Tmessage", 'Please Enter Valid Amount for Testdrive');
                                            redirect('admin_controller/Mission/edit_budget');
                                        } else {
                                            $this->form_validation->set_rules('txt_quan_reg', 'Quantity for Registration', 'trim|required|greater_than[0.99]');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("qty_Rmessage", 'Please Enter Valid Quantity for Registration');
                                                redirect('admin_controller/Mission/edit_budget');
                                            } else {
                                                $this->form_validation->set_rules('txt_quan_drive', 'Quantity for Testdrive', 'trim|required|greater_than[0.99]');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("qty_Tmessage", 'Please Enter Valid Quantity for Testdrive');
                                                    redirect('admin_controller/Mission/edit_budget');
                                                } else {
                                                    $quant = $this->input->post('txt_quan_reg');
                                                    $amount = $this->input->post('txt_amt_reg');
                                                    $quant_test = $this->input->post('txt_quan_drive');
                                                    $amount_test = $this->input->post('txt_amt_drive');
                                                }
                                            }
                                        }
                                    }
                                }
                                $game_id = $this->session->userdata('mission_game_id');
                                $game_id == '' ? $game_id = $this->session->userdata('user_game_id') : null;
                                $year = $this->input->post('txt_year');
                                $period = $this->input->post('txt_period');
                                $from_date = $this->input->post('from_date');
                                $to_date = $this->input->post('to_date');
                                $txt_day_to_comp = $this->input->post('txt_day_to_comp');
                                $segment_url = $this->session->userdata('bud_budget_id');
                                $budget_id = rawurldecode($this->encrypt->decode($segment_url));
                                $data = array(
                                    'year' => $year,
                                    'period' => $period,
                                    'date_from' => $from_date,
                                    'date_to' => $to_date,
                                    'amount_car_regi' => $amount,
                                    'quantity_car_regi' => $quant,
                                    'amount_test_drive' => $amount_test,
                                    'quantity_test_drive' => $quant_test,
                                    'budget_on' => $bud_type,
                                    'day_to_complete' => $txt_day_to_comp
                                );
                                $res = $this->Mission_model->update_budget($game_id, $budget_id, $data);
                                if ($res == true) {
                                    $this->session->set_flashdata("suc_message", "update");
                                    redirect('admin_controller/Mission/edit_budget');
                                } else {
                                    $this->session->set_flashdata("suc_message", "false");
                                    redirect('admin_controller/Mission/edit_budget');
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Mission/view_budget');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete budget */

    public function delete_budget($segment_url)
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $budget_id = rawurldecode($this->encrypt->decode($segment_url));
                $game_id = $this->session->userdata('mission_game_id');
                $game_id == '' ? $game_id = $this->session->userdata('user_game_id') : null;
                $res = $this->Mission_model->delete_budget($game_id, $budget_id);
                ($res) 
                ? ($this->session->set_flashdata("suc_message", "delete")) 
                : $this->session->set_flashdata("suc_message", "false");
                redirect('admin_controller/Mission/view_budget');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

}
