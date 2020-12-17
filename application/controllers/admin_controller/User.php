<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    /* Calling Constructer */

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model/User_model');
        $this->load->model('admin_model/Mission_model');
    }

    /* add_user paage calling */

    public function add_user()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = 1;
                $data['role'] = $this->User_model->get_role($game_id);
                $data['game'] = $this->Game_model->fetch_all_game();
                $this->load->view('admin/user/add_user', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /**
     * Get last id
     */
    public function get_last_id()
    {
        $new_token = $this->security->get_csrf_hash();
        $response = false;
        $game_id = $this->input->post('game_id');
        if ($this->input->post('game_id') != '') {
            $response = $this->User_model->fetch_last_user($game_id);
        }
        echo json_encode(array('token' => $new_token, 'response' => $response));
        exit();
    }

    /**
     * Check email
     */
    public function check_email()
    {
        $new_token = $this->security->get_csrf_hash();
        $response = false;
        $game_id = $this->input->post('game_id');
        $email = $this->input->post('email');
        if ($this->input->post('email') != '') {
            $response = $this->User_model->check_user_email($game_id, $email);
        }
        echo json_encode(array('token' => $new_token, 'response' => $response));
        exit();
    }

    /**
     * Check email
     */
    public function check_edit_email()
    {
        $new_token = $this->security->get_csrf_hash();
        $response = false;
        $game_id = $this->session->userdata('user_game_id');
        $email = $this->input->post('email');
        if ($this->input->post('email') != '') {
            $response = $this->User_model->check_user_email($game_id, $email);
        }
        echo json_encode(array('token' => $new_token, 'response' => $response));
        exit();
    }

    /* manage_user paage calling */

    public function manage_user()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->input->post('select_game');
                $user_game = '';
                $game_id == '' ? $game_id = 1 : null;
                $this->session->set_userdata(
                    array(
                            'user_game_id' => $game_id,
                        )
                );
                $data['game'] = $this->Game_model->fetch_user_game($game_id);
                $data['user'] = $this->User_model->fetch_user($game_id);
                $data['game_name'] = $this->Game_model->fetch_one_game($game_id);
                foreach ($data['game_name'] as $row) {
                    $user_game = $row->game_name;
                }
                $data['sel_game'] = $user_game;
                $this->load->view('admin/user/view_user', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /**
     * Check valid name 
     */
    function alpha_dash($fullname)
    {
        if (!preg_match('/^[a-zA-Z ]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only contain alpha characters');
            return false;
        } else {
            return true;
        }
    }

    /* inserting user */

    public function insert_user()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('select_game', 'Select Game', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("sel_message", 'Please Select Game Name');
                        redirect('admin_controller/User/add_user');
                    } else {
                        $this->form_validation->set_rules('txt_login_name', 'Login name', 'required|trim|callback_fullname_check');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("login_message", 'Please Select Valid Game name for Login Name');
                            redirect('admin_controller/User/add_user');
                        } else {
                            $this->form_validation->set_rules('txt_userident', 'Userident', 'required|trim|callback_fullname_check');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("user_message", 'Please Select Valid Game name for Userident');
                                redirect('admin_controller/User/add_user');
                            } else {
                                $this->form_validation->set_rules('txt_first_name', 'First Name', 'required|trim|callback_alpha_dash');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("f_message", 'Please Enter Valid First Name');
                                    redirect('admin_controller/User/add_user');
                                } else {
                                    $this->form_validation->set_rules('txt_last_name', 'Last Name', 'required|trim|callback_alpha_dash');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("l_message", 'Please Enter Valid Last Name');
                                        redirect('admin_controller/User/add_user');
                                    } else {
                                        $this->form_validation->set_rules('txt_email', 'Email', 'trim|valid_email|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("email_message", 'Please Enter Valid Email Address');
                                            redirect('admin_controller/User/add_user');
                                        } else {
                                            $this->form_validation->set_rules('txt_password', 'Password', 'trim|required');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("pass_message", 'Please Enter Valid Password');
                                                redirect('admin_controller/User/add_user');
                                            } else {
                                                $this->form_validation->set_rules('check_list[]', 'User Role', 'trim|required|greater_than[0]');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("role_message", 'Please Select Atleast One role');
                                                    redirect('admin_controller/User/add_user');
                                                } else {
                                                    $game_id = $this->input->post('select_game');
                                                    $email = $this->input->post('txt_email');
                                                    $email_count = 0;
                                                    $data['res1'] = $this->User_model->check_user_email($game_id, $email);
                                                    foreach ($data['res1'] as $row) {
                                                        $email_count = $row->ECount;
                                                    }
                                                    if ($email_count > 0) {
                                                        $this->session->set_flashdata("em_message", 'email');
                                                        redirect('admin_controller/User/add_user');
                                                    } else {
                                                        $login_name = $this->input->post('txt_login_name');
                                                        $userident = $this->input->post('txt_userident');
                                                        $first_name = $this->input->post('txt_first_name');
                                                        $last_name = $this->input->post('txt_last_name');
                                                        $password = $this->input->post('txt_password');
                                                        $role_id = $this->input->post('check_list');
                                                        $timestmp = date("Y-m-d-H.i.s");
                                                        $user_role = "";

                                                        if (count($role_id) > 1) {
                                                            for ($i = 0; $i < count($role_id); $i++) {
                                                                $user_role = $user_role . $role_id[$i] . ",";
                                                            }
                                                            $role_array = explode(',', $user_role);
                                                            $p_user_role_id1 = $role_array[0];
                                                            $p_user_role_id2 = $role_array[1];
                                                        } else {
                                                            for ($i = 0; $i < count($role_id); $i++) {
                                                                $user_role = $user_role . $role_id[$i];
                                                            }
                                                            $role_array = explode(',', $user_role);
                                                            $p_user_role_id1 = $role_array[0];
                                                        }
                                                        $hash_variable_salt1 = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                                                        $password = $hash_variable_salt1;

                                                        $data = array(
                                                            'date_time' => $timestmp,
                                                            'login_name' => $login_name,
                                                            'userident' => $userident,
                                                            'first_name' => $first_name,
                                                            'last_name' => $last_name,
                                                            'email' => $email,
                                                            'password' => $password,
                                                            'role_id' => $user_role
                                                        );
                                                        $res = $this->User_model->insert_user_data($data, $game_id);

                                                        if ($res == true) {
                                                            if (($p_user_role_id1 == 5) || ($p_user_role_id1 == 4 && $p_user_role_id2 == 5)) {
                                                                $data = array(
                                                                        'game_id' => $game_id,
                                                                        'userident' => $userident
                                                                    );
                                                                /* check if user present in knowledge Rank table, if not then insert into Rank table  */
                                                                $res_is_present_count_know = $this->User_model->fetch_is_user_present_knowledge($game_id, $userident);
                                                                $row_is_present_count_know = $res_is_present_count_know[0]->is_present;
                                                                if ($row_is_present_count_know == 0) {
                                                                    $this->User_model->insert_in_know_rank($data, $game_id);
                                                                }

                                                                /* check if user present in Sale table, if not then insert into Sale table  */
                                                                $res_is_present_count_rank_sale = $this->User_model->fetch_is_user_present_sales($game_id, $userident);
                                                                $is_present_count_rank_sale = $res_is_present_count_rank_sale[0]->is_present;
                                                                if ($is_present_count_rank_sale == 0) {
                                                                    $this->User_model->insert_in_rank_table_sales($data, $game_id);
                                                                }

                                                                /* check if user present in Scoreboard table, if not then insert into Scoreboard table  */
                                                                $res_is_present_count_rank_score = $this->User_model->fetch_is_user_present_scoreboard($game_id, $userident);
                                                                $is_present_count_rank_score = $res_is_present_count_rank_score[0]->is_present;
                                                                if ($is_present_count_rank_score == 0) {
                                                                    $this->User_model->insert_in_rank_table_scorebored($data, $game_id);
                                                                }

                                                                /* check if user present in Rank table, if not then insert into Rank table  */
                                                                $res_is_present_count_rank_test = $this->User_model->fetch_is_user_present_test_drive($game_id, $userident);
                                                                $is_present_count_rank_test = $res_is_present_count_rank_test[0]->is_present;
                                                                if ($is_present_count_rank_test == 0) {
                                                                    $this->User_model->insert_in_rank_table_test_drive($data, $game_id);
                                                                }

                                                                /* check if user present in knowledge badge table, if not then insert into knowledge badge table  */
                                                                $res_is_present_knowledge = $this->User_model->fetch_is_user_present_knowledge_badge($game_id, $userident);
                                                                $is_present_knowledge = $res_is_present_knowledge[0]->is_present;
                                                                if ($is_present_knowledge == 0) {
                                                                    $data = array(
                                                                        'game_id' => $game_id,
                                                                        'userident' => $userident,
                                                                        'badge_knowlevel_image' => 'F1.png',
                                                                        'badge_qz_img' => 'F.gif'
                                                                    );
                                                                    $this->User_model->insert_in_badge_mapping($data, $game_id);
                                                                }
                                                            }
                                                            $user_count = substr($userident, 3);
                                                            $data = array(
                                                                'current_count' => $user_count
                                                            );
                                                            $this->User_model->update_userident_count($game_id, $data);
                                                            $this->session->set_flashdata("suc_message", "true");
                                                            redirect('admin_controller/User/manage_user');
                                                        } else {
                                                            $this->session->set_flashdata("suc_message", "false");
                                                            redirect('admin_controller/User/add_user');
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
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /**
     * Checking alphanumrical value
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

    /* view one user */

    public function view_one_user()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $segment_url = $this->uri->segment(4);
                $decrypt = rawurldecode($this->encrypt->decode($segment_url));
                $game_id = $this->session->userdata('user_game_id');
                $role = '';
                $data['user'] = $this->User_model->fetch_one_user($game_id, $decrypt);
                foreach ($data['user'] as $row1) {
                    $role_id = $row1->role_id;
                    $role_array = explode(',', $role_id);
                    $cnt_role = count($role_array);

                    if ($cnt_role >= 2) {
                        $p_user_role_id1 = (int) $role_array['0'];
                        $p_user_role_id2 = (int) $role_array['1'];
                        $data['role'] = $this->User_model->fetch_multiple_user_role($game_id, $p_user_role_id1, $p_user_role_id2);
                        foreach ($data['role'] as $row2) {
                            $role = $role . $row2->role_name . ", ";
                        }
                        $data['user_role'] = $role;
                    } else {
                        $p_user_role_id1 = $role_array[0];
                        $data['role'] = $this->User_model->fetch_user_role($game_id, $p_user_role_id1);
                        foreach ($data['role'] as $row2) {
                            $role = $role . $row2->role_name . ", ";
                        }
                        $data['user_role'] = $role;
                    }
                    $this->load->view('admin/user/view_one_user', $data);
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* edit user */

    public function edit_user()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('user_id') : null;
                $id = rawurldecode($this->encrypt->decode($segment_url));

                $role_name = '';
                $game_id = $this->session->userdata('user_game_id');
                $p_user_role_id1 = 0;
                $p_user_role_id2 = 0;
                $userident = '';
                $data['role'] = $this->User_model->get_role($game_id);
                $data['user'] = $this->User_model->fetch_one_user($game_id, $id);
                foreach ($data['user'] as $row1) {
                    $userident = $row1->userident;
                    $user_role_id = $row1->role_id;
                    $role_array = explode(',', $user_role_id);
                    $cnt_role = count($role_array);

                    if ($cnt_role >= 2) {
                        $p_user_role_id1 = $role_array[0];
                        $p_user_role_id2 = $role_array[1];
                        $data['user_role'] = $this->User_model->fetch_multiple_user_role($game_id, $p_user_role_id1, $p_user_role_id2);
                        foreach ($data['role'] as $row2) {
                            $data['myrole'] = $role_name . $row2->role_name . ", ";
                        }
                    } else {
                        $p_user_role_id1 = $role_array[0];
                        $data['user_role'] = $this->User_model->fetch_user_role($game_id, $p_user_role_id1);
                        foreach ($data['role'] as $row2) {
                            $data['myrole'] = $role_name . $row2->role_name . ", ";
                        }
                    }
                    $data['p_user_role_id1'] = $p_user_role_id1;
                    $data['p_user_role_id2'] = $p_user_role_id2;
                }
                $this->session->set_userdata(
                    array(
                            'user_id' => $segment_url,
                            'userident' => $userident
                        )
                );
                $this->load->view('admin/user/edit_user', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* updating user */

    public function update_user()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_update')) {
                    $this->form_validation->set_rules('txt_first_name', 'First Name', 'required|trim|callback_alpha_dash');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("f_message", 'Please Enter Valid First Name');
                        redirect('admin_controller/User/edit_user');
                    } else {
                        $this->form_validation->set_rules('txt_last_name', 'Last Name', 'required|trim|callback_alpha_dash');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("l_message", 'Please Enter Valid Last Name');
                            redirect('admin_controller/User/edit_user');
                        } else {
                            $this->form_validation->set_rules('txt_email', 'Email', 'trim|valid_email|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("email_message", 'Please Enter Valid Email Address');
                                redirect('admin_controller/User/edit_user');
                            } else {
                                $this->form_validation->set_rules('check_list[]', 'User Role', 'trim|required|greater_than[0]');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("role_message", 'Please Select Atleast One role');
                                    redirect('admin_controller/User/edit_user');
                                } else {
                                    $email_count = 0;
                                    $game_id = $this->session->userdata('user_game_id');
                                    $email = $this->input->post('txt_email');
                                    $data['res1'] = $this->User_model->check_user_email($game_id, $email);
                                    foreach ($data['res1'] as $row) {
                                        $email_count = $row->ECount;
                                    }
                                    if ($email_count > 0) {
                                        $t_email = $this->input->post('t_email');
                                        if ($email != $t_email) {
                                            $this->session->set_flashdata("em_message", 'email');
                                            redirect('admin_controller/User/edit_user');
                                        } else {
                                            $userident = $this->session->userdata('userident');
                                            $first_name = $this->input->post('txt_first_name');
                                            $last_name = $this->input->post('txt_last_name');
                                            $role_id = $this->input->post('check_list');
                                            $user_role = "";

                                            if (count($role_id) > 1) {
                                                for ($i = 0; $i < count($role_id); $i++) {
                                                    $user_role = $user_role . $role_id[$i] . ",";
                                                }
                                            } else {
                                                for ($i = 0; $i < count($role_id); $i++) {
                                                    $user_role = $user_role . $role_id[$i];
                                                }
                                            }

                                            $role_array = explode(',', $user_role);
                                            $p_user_role_id1 = $role_array[0];
                                            $p_user_role_id2 = $role_array[1];

                                            $data = array(
                                                'first_name' => $first_name,
                                                'last_name' => $last_name,
                                                'email' => $email,
                                                'role_id' => $user_role
                                            );
                                            $name = $first_name. ' '.$last_name;
                                            $data2 = array(
                                                'username' => $name
                                            );
                                            $res = $this->User_model->update_user_record($game_id, $userident, $data);
                                            $this->Mission_model->update_user_budget($game_id, $userident, $data2);

                                            if ($res == true) {
                                                if (($p_user_role_id1 == 5) || ($p_user_role_id2 == 5)) {

                                                    /* check if user present in knowledge Rank table, if not then insert into Rank table  */
                                                    $res_is_present_count_know = $this->User_model->fetch_is_user_present_knowledge($game_id, $userident);
                                                    $row_is_present_count_know = $res_is_present_count_know[0]->is_present;
                                                    if ($row_is_present_count_know == 0) {
                                                        $data = array(
                                                            'game_id' => $game_id,
                                                            'userident' => $userident
                                                        );
                                                        $this->User_model->insert_in_know_rank($data, $game_id);
                                                    }

                                                    $res_is_present_count_rank_sale = $this->User_model->fetch_is_user_present_sales($game_id, $userident);
                                                    $is_present_count_rank_sale = $res_is_present_count_rank_sale[0]->is_present;
                                                    if ($is_present_count_rank_sale == 0) {
                                                        $data = array(
                                                            'game_id' => $game_id,
                                                            'userident' => $userident
                                                        );
                                                        $this->User_model->insert_in_rank_table_sales($data, $game_id);
                                                    }

                                                    $res_is_present_count_rank_score = $this->User_model->fetch_is_user_present_scoreboard($game_id, $userident);
                                                    $is_present_count_rank_score = $res_is_present_count_rank_score[0]->is_present;
                                                    if ($is_present_count_rank_score == 0) {
                                                        $data = array(
                                                            'game_id' => $game_id,
                                                            'userident' => $userident
                                                        );
                                                        $this->User_model->insert_in_rank_table_scorebored($data, $game_id);
                                                    }

                                                    /* check if user present in Rank table, if not then insert into Rank table  */
                                                    $res_is_present_count_rank_test = $this->User_model->fetch_is_user_present_test_drive($game_id, $userident);
                                                    $is_present_count_rank_test = $res_is_present_count_rank_test[0]->is_present;
                                                    if ($is_present_count_rank_test == 0) {
                                                        $data = array(
                                                            'game_id' => $game_id,
                                                            'userident' => $userident
                                                        );
                                                        $this->User_model->insert_in_rank_table_test_drive($data, $game_id);
                                                    }

                                                    /* check if user present in knowledge badge table, if not then insert into knowledge badge table  */
                                                    $res_is_present_knowledge = $this->User_model->fetch_is_user_present_knowledge_badge($game_id, $userident);
                                                    $is_present_knowledge = $res_is_present_knowledge[0]->is_present;
                                                    if ($is_present_knowledge == 0) {
                                                        $data = array(
                                                            'game_id' => $game_id,
                                                            'userident' => $userident,
                                                            'badge_knowlevel_image' => 'F1.png',
                                                            'badge_qz_img' => 'F.gif'
                                                        );
                                                        $this->User_model->insert_in_badge_mapping($data, $game_id);
                                                    }
                                                } else if (($p_user_role_id1 != 5) || ($p_user_role_id1 != 5 && $p_user_role_id2 != 5)) {
                                                    $res_is_present_count_know = $this->User_model->fetch_is_user_present_knowledge($game_id, $userident);
                                                    $row_is_present_count_know = $res_is_present_count_know[0]->is_present;
                                                    if ($row_is_present_count_know > 0) {
                                                        $this->User_model->delete_user_from_knowledge($game_id, $userident);
                                                    }
                                                    $res_is_present_count_rank_sale = $this->User_model->fetch_is_user_present_sales($game_id, $userident);
                                                    $is_present_count_rank_sale = $res_is_present_count_rank_sale[0]->is_present;
                                                    if ($is_present_count_rank_sale > 0) {
                                                        $this->User_model->delete_user_from_rank($game_id, $userident);
                                                    }
                                                    $res_is_present_count_rank_score = $this->User_model->fetch_is_user_present_scoreboard($game_id, $userident);
                                                    $is_present_count_rank_score = $res_is_present_count_rank_score[0]->is_present;
                                                    if ($is_present_count_rank_score > 0) {
                                                        $this->User_model->delete_user_from_scoreboard($game_id, $userident);
                                                    }
                                                    $res_is_present_count_rank_test = $this->User_model->fetch_is_user_present_test_drive($game_id, $userident);
                                                    $is_present_count_rank_test = $res_is_present_count_rank_test[0]->is_present;
                                                    if ($is_present_count_rank_test > 0) {
                                                        $this->User_model->delete_user_from_test_drive($game_id, $userident);
                                                    }

                                                    $res_is_present_count_bud_car = $this->User_model->fetch_is_user_present_bud_car_test($game_id, $userident);
                                                    $is_present_count_bud_car = $res_is_present_count_bud_car[0]->is_present;
                                                    if ($is_present_count_bud_car > 0) {
                                                        $this->User_model->delete_user_from_bud_car_test($game_id, $userident);
                                                    }

                                                    $res_is_present_count_sale_trans = $this->User_model->fetch_is_user_present_sale_trans($userident);
                                                    $is_present_count_sale_trans = $res_is_present_count_sale_trans[0]->is_present;
                                                    if ($is_present_count_sale_trans > 0) {
                                                        $this->User_model->delete_user_from_sale_trans($userident);
                                                    }
                                                    $this->User_model->delete_user_from_mission_dur($game_id, $userident);
                                                    $this->User_model->delete_user_from_question_trans($game_id, $userident);
                                                    $this->User_model->delete_user_from_quiz_attempt($game_id, $userident);
                                                    $this->User_model->delete_user_from_badge_map($game_id, $userident);
                                                    $this->User_model->delete_user_from_mission_dur($game_id, $userident);
                                                    $this->User_model->delete_user_from_game_trans($game_id, $userident);
                                                }
                                                $this->session->set_flashdata("suc_message", "update");
                                                redirect('admin_controller/User/edit_user');
                                            } else {
                                                $this->session->set_flashdata("suc_message", "false");
                                                redirect('admin_controller/User/edit_user');
                                            }
                                        }
                                    } else {
                                        $userident = $this->session->userdata('userident');
                                        $first_name = $this->input->post('txt_first_name');
                                        $last_name = $this->input->post('txt_last_name');
                                        $role_id = $this->input->post('check_list');
                                        $user_role = "";

                                        if (count($role_id) > 1) {
                                            for ($i = 0; $i < count($role_id); $i++) {
                                                $user_role = $user_role . $role_id[$i] . ",";
                                            }
                                        } else {
                                            for ($i = 0; $i < count($role_id); $i++) {
                                                $user_role = $user_role . $role_id[$i];
                                            }
                                        }

                                        $role_array = explode(',', $user_role);
                                        $p_user_role_id1 = $role_array[0];
                                        $p_user_role_id2 = $role_array[1];

                                        $data = array(
                                            'first_name' => $first_name,
                                            'last_name' => $last_name,
                                            'email' => $email,
                                            'role_id' => $user_role
                                        );
                                        $data2 = array(
                                                'username' => $name
                                            );
                                            $res = $this->User_model->update_user_record($game_id, $userident, $data);
                                            $this->Mission_model->update_user_budget($game_id, $userident, $data2);

                                        if ($res == true) {
                                            if (($p_user_role_id1 == 5) || ($p_user_role_id2 == 5)) {

                                                /* check if user present in knowledge Rank table, if not then insert into Rank table  */
                                                $res_is_present_count_know = $this->User_model->fetch_is_user_present_knowledge($game_id, $userident);
                                                $row_is_present_count_know = $res_is_present_count_know[0]->is_present;
                                                if ($row_is_present_count_know == 0) {
                                                    $data = array(
                                                        'game_id' => $game_id,
                                                        'userident' => $userident
                                                    );
                                                    $this->User_model->insert_in_know_rank($data, $game_id);
                                                }

                                                $res_is_present_count_rank_sale = $this->User_model->fetch_is_user_present_sales($game_id, $userident);
                                                $is_present_count_rank_sale = $res_is_present_count_rank_sale[0]->is_present;
                                                if ($is_present_count_rank_sale == 0) {
                                                    $data = array(
                                                        'game_id' => $game_id,
                                                        'userident' => $userident
                                                    );
                                                    $this->User_model->insert_in_rank_table_sales($data, $game_id);
                                                }

                                                $res_is_present_count_rank_score = $this->User_model->fetch_is_user_present_scoreboard($game_id, $userident);
                                                $is_present_count_rank_score = $res_is_present_count_rank_score[0]->is_present;
                                                if ($is_present_count_rank_score == 0) {
                                                    $data = array(
                                                        'game_id' => $game_id,
                                                        'userident' => $userident
                                                    );
                                                    $this->User_model->insert_in_rank_table_scorebored($data, $game_id);
                                                }

                                                $res_is_present_count_rank_test = $this->User_model->fetch_is_user_present_test_drive($game_id, $userident);
                                                $is_present_count_rank_test = $res_is_present_count_rank_test[0]->is_present;
                                                if ($is_present_count_rank_test == 0) {
                                                    $data = array(
                                                        'game_id' => $game_id,
                                                        'userident' => $userident
                                                    );
                                                    $this->User_model->insert_in_rank_table_test_drive($data, $game_id);
                                                }

                                                /* check if user present in knowledge badge table, if not then insert into knowledge badge table  */
                                                $res_is_present_knowledge = $this->User_model->fetch_is_user_present_knowledge_badge($game_id, $userident);
                                                $is_present_knowledge = $res_is_present_knowledge[0]->is_present;
                                                if ($is_present_knowledge == 0) {
                                                    $data = array(
                                                        'game_id' => $game_id,
                                                        'userident' => $userident,
                                                        'badge_knowlevel_image' => 'F1.png',
                                                        'badge_qz_img' => 'F.gif'
                                                    );
                                                    $this->User_model->insert_in_badge_mapping($data, $game_id);
                                                }
                                            } else if (($p_user_role_id1 != 5) || ($p_user_role_id1 != 5 && $p_user_role_id2 != 5)) {
                                                $res_is_present_count_know = $this->User_model->fetch_is_user_present_knowledge($game_id, $userident);
                                                $row_is_present_count_know = $res_is_present_count_know[0]->is_present;
                                                if ($row_is_present_count_know > 0) {
                                                    $this->User_model->delete_user_from_knowledge($game_id, $userident);
                                                }
                                                $res_is_present_count_rank_sale = $this->User_model->fetch_is_user_present_sales($game_id, $userident);
                                                $is_present_count_rank_sale = $res_is_present_count_rank_sale[0]->is_present;
                                                if ($is_present_count_rank_sale > 0) {
                                                    $this->User_model->delete_user_from_rank($game_id, $userident);
                                                }
                                                $res_is_present_count_rank_score = $this->User_model->fetch_is_user_present_scoreboard($game_id, $userident);
                                                $is_present_count_rank_score = $res_is_present_count_rank_score[0]->is_present;
                                                if ($is_present_count_rank_score > 0) {
                                                    $this->User_model->delete_user_from_scoreboard($game_id, $userident);
                                                }
                                                $res_is_present_count_rank_test = $this->User_model->fetch_is_user_present_test_drive($game_id, $userident);
                                                $is_present_count_rank_test = $res_is_present_count_rank_test[0]->is_present;
                                                if ($is_present_count_rank_test > 0) {
                                                    $this->User_model->delete_user_from_test_drive($game_id, $userident);
                                                }

                                                $res_is_present_count_bud_car = $this->User_model->fetch_is_user_present_bud_car_test($game_id, $userident);
                                                $is_present_count_bud_car = $res_is_present_count_bud_car[0]->is_present;
                                                if ($is_present_count_bud_car > 0) {
                                                    $this->User_model->delete_user_from_bud_car_test($game_id, $userident);
                                                }

                                                $res_is_present_count_sale_trans = $this->User_model->fetch_is_user_present_sale_trans($userident);
                                                $is_present_count_sale_trans = $res_is_present_count_sale_trans[0]->is_present;
                                                if ($is_present_count_sale_trans > 0) {
                                                    $this->User_model->delete_user_from_sale_trans($userident);
                                                }
                                                $this->User_model->delete_user_from_mission_dur($game_id, $userident);
                                                $this->User_model->delete_user_from_question_trans($game_id, $userident);
                                                $this->User_model->delete_user_from_quiz_attempt($game_id, $userident);
                                                $this->User_model->delete_user_from_badge_map($game_id, $userident);
                                                $this->User_model->delete_user_from_mission_dur($game_id, $userident);
                                                $this->User_model->delete_user_from_game_trans($game_id, $userident);
                                            }
                                            $this->session->set_flashdata("suc_message", "update");
                                            redirect('admin_controller/User/edit_user');
                                        } else {
                                            $this->session->set_flashdata("suc_message", "false");
                                            redirect('admin_controller/User/edit_user');
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/User/manage_user');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* deleting user */

    public function delete_user($segment_url)
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('user_game_id');
                $userident = rawurldecode($this->encrypt->decode($segment_url));
                $res = $this->User_model->delete_user_record($game_id, $userident);

                if ($res == true) {
                    $res_is_present_count_know = $this->User_model->fetch_is_user_present_knowledge($game_id, $userident);
                    $row_is_present_count_know = $res_is_present_count_know[0]->is_present;
                    if ($row_is_present_count_know > 0) {
                        $this->User_model->delete_user_from_knowledge($game_id, $userident);
                    }
                    $res_is_present_count_rank_sale = $this->User_model->fetch_is_user_present_sales($game_id, $userident);
                    $is_present_count_rank_sale = $res_is_present_count_rank_sale[0]->is_present;
                    if ($is_present_count_rank_sale > 0) {
                        $this->User_model->delete_user_from_rank($game_id, $userident);
                    }
                    $res_is_present_count_rank_score = $this->User_model->fetch_is_user_present_scoreboard($game_id, $userident);
                    $is_present_count_rank_score = $res_is_present_count_rank_score[0]->is_present;
                    if ($is_present_count_rank_score > 0) {
                        $this->User_model->delete_user_from_scoreboard($game_id, $userident);
                    }
                    $res_is_present_count_rank_test = $this->User_model->fetch_is_user_present_test_drive($game_id, $userident);
                    $is_present_count_rank_test = $res_is_present_count_rank_test[0]->is_present;
                    if ($is_present_count_rank_test > 0) {
                        $this->User_model->delete_user_from_test_drive($game_id, $userident);
                    }

                    $res_is_present_count_bud_car = $this->User_model->fetch_is_user_present_bud_car_test($game_id, $userident);
                    $is_present_count_bud_car = $res_is_present_count_bud_car[0]->is_present;
                    if ($is_present_count_bud_car > 0) {
                        $this->User_model->delete_user_from_bud_car_test($game_id, $userident);
                    }

                    $res_is_present_count_sale_trans = $this->User_model->fetch_is_user_present_sale_trans($userident);
                    $is_present_count_sale_trans = $res_is_present_count_sale_trans[0]->is_present;
                    if ($is_present_count_sale_trans > 0) {
                        $this->User_model->delete_user_from_sale_trans($userident);
                    }
                    $this->User_model->delete_user_from_mission_dur($game_id, $userident);
                    $this->User_model->delete_user_from_question_trans($game_id, $userident);
                    $this->User_model->delete_user_from_quiz_attempt($game_id, $userident);
                    $this->User_model->delete_user_from_badge_map($game_id, $userident);
                    $this->User_model->delete_user_from_mission_dur($game_id, $userident);
                    $this->User_model->delete_user_from_game_trans($game_id, $userident);

                    $this->session->set_flashdata("suc_message", "delete");
                    redirect('admin_controller/User/manage_user');
                } else {
                    $this->session->set_flashdata("suc_message", "false");
                    redirect('admin_controller/User/manage_user');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* view user budget calling */
    
    public function view_user_budget($segment_url)
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                     $game_id = $this->session->userdata('user_game_id');
                      $userident = rawurldecode($this->encrypt->decode($segment_url));
                     $data['user_report'] = $this->User_model->user_report($game_id, $userident);
                $this->load->view('admin/user/view_user_report', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* view mission budget calling */

    public function view_mission_budget($segment_url)
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $data['game_id'] = $game_id = $this->session->userdata('user_game_id');
                $data['userident'] = $userident = rawurldecode($this->encrypt->decode($segment_url));
                $data['user_budget'] = $this->Mission_model->get_mission_count($game_id);
                $this->load->view('admin/user/view_manager_report', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

}
