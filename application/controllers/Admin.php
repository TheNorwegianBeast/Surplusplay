<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    /* Calling Constructer */

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }

    /**
     * Index page calling 
     */
    public function index()
    {
        try {
            $this->load->view('admin/index');
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* home page calling */

    public function home()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $this->load->view('admin/dashboard/home');
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
        if (!preg_match("/^([a-z0-9])+$/i", $str)) {
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
        if (!preg_match('/^[a-zA-Z ]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only contain alpha characters');
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check valid name 
     */
    function alpha($fullname)
    {
        if (!preg_match('/^[a-zA-Z]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only contain alpha characters');
            return false;
        } else {
            return true;
        }
    }

    /* admin login validation */

    public function login_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('txt_email', 'text', 'trim|required|callback_fullname_check');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata("f_message", 'Please Enter Valid Username');
                redirect('Admin/index');
            } else {
                $this->form_validation->set_rules('txt_password', 'Password', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata("p_message", 'Please Enter Valid Password');
                    redirect('Admin/index');
                } else {
                    $username = $this->input->post('txt_email');
                    $password = $this->input->post('txt_password');
                    $admin_username = '';
                    $admin_pass = '';
                    $id = '';
                    $picture = '';
                    $admin_nm = '';
                    $result = $this->Admin_model->admin_login($username);
                    foreach ($result as $value) {
                        $admin_username = trim($value->admin_username);
                        $admin_pass = trim($value->admin_password);
                        $admin_nm = trim($value->admin_name);
                        $picture = trim($value->profile_img);
                        $id = trim($value->id);
                    }
                    $status = password_verify($password, $admin_pass);

                    if ($username == $admin_username && $status != "") {
                        $this->session->set_userdata(
                            array(
                                    'admin_name' => $username,
                                    'profile_img' => $picture,
                                    'admin_nm' => $admin_nm,
                                    'id' => $id
                                )
                        );
                        redirect('Admin/home');
                    } else {
                        $this->session->set_flashdata("l_message", 'false');
                        redirect('Admin/index');
                    }
                }
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* logout admin */

    public function logout()
    {
        try {
            $array_items = array('admin_name', 'id', 'profile_img', 'admin_nm', 'game_id', 'grade_game_id', 'grade_id',
                'inventory_game_id', 'inven_id', 'knowledge_game_id', 'avg_know_grade_id', 'level_game_id', 'level_id',
                'mission_game_id', 'url_mission_id', 'que_mission_id', 'que_question_id', 'know_mission_id', 'know_knowledge_id', 'bud_mission_id',
                'bud_budget_id', 'act_notify_id', 'notify_game_id', 'notify_id', 'act_notify_game_id', 'pricelist_game_id', 'price_id', 'user_id',
                'userident', 'user_game_id');
            $this->session->unset_userdata($array_items);
            redirect('Admin/index');
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* admin profile */

    public function profile()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $username = $this->session->userdata('admin_name');
                $data['admin'] = $this->Admin_model->admin_login($username);
                $this->load->view('admin/dashboard/profile', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* admin password */

    public function password()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $this->load->view('admin/dashboard/password');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* update admin profile */

    public function update_profile()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('update_profile')) {
                    $this->form_validation->set_rules('txt_name', 'Name', 'trim|required|callback_alpha_dash');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("name_message", 'Please Enter Valid Name');
                        redirect('Admin/profile');
                    } else {
                        $this->form_validation->set_rules('txt_username', 'Username', 'trim|required|callback_alpha');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("user_message", 'Please Enter Valid Username');
                            redirect('Admin/profile');
                        } else {
                            $this->form_validation->set_rules('txt_email', 'Email', 'trim|required|valid_email');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("mail_message", 'Please Enter Valid Email');
                                redirect('Admin/profile');
                            } else {
                                $id = $this->session->userdata('id');
                                $admin_name = $this->input->post('txt_name');
                                $email = $this->input->post('txt_email');
                                $username = $this->input->post('txt_username');
                                $picture = $this->session->userdata('profile_img');

                                if (!empty($_FILES['file_profile']['name'])) {
                                    $config['upload_path'] = 'application/views/admin/asset/image/profile_pic';
                                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                    $config['file_name'] = $_FILES['file_profile']['name'];
                                    /* Load upload library and initialize configuration */
                                    $this->load->library('upload', $config);
                                    $this->upload->initialize($config);

                                    if ($this->upload->do_upload('file_profile')) {
                                        $uploadData = $this->upload->data();
                                        $path = 'application/views/admin/asset/image/profile_pic/' . $picture;
                                        file_exists($path) ? unlink($path) : null;
                                        $picture = $uploadData['file_name'];
                                    }
                                }
                                $data = array(
                                    'admin_name' => $admin_name,
                                    'admin_email' => $email,
                                    'admin_username' => $username,
                                    'profile_img' => $picture
                                );
                                if ($this->Admin_model->update_admin_record($id, $data)) {
                                    $this->session->set_userdata(
                                        array(
                                                'admin_name' => $username,
                                                'admin_nm' => $admin_name,
                                                'profile_img' => $picture
                                            )
                                    );
                                    $this->session->set_flashdata("suc_message", 'update');
                                } else {
                                    $this->session->set_flashdata("suc_message", 'false');
                                }
                                redirect('Admin/profile');
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

    /* change admin password */

    public function update_password()
    {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('change_password')) {
                    $this->form_validation->set_rules('txt_old_pass', 'Old Password', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("old_message", 'Please Enter Old Password');
                        redirect('Admin/password');
                    } else {
                        $this->form_validation->set_rules('txt_new_pass', 'New Password', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("new_message", 'Please Enter New Password');
                            redirect('Admin/password');
                        } else {
                            $this->form_validation->set_rules('txt_con_pass', 'Confirm Password', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("con_message", 'Please Enter Confirm Password');
                                redirect('Admin/password');
                            } else {
                                $user_name = $this->session->userdata('admin_name');
                                $id = $this->session->userdata('id');
                                $old_pass = $this->input->post('txt_old_pass');
                                $new_pass = $this->input->post('txt_new_pass');
                                $con_pass = $this->input->post('txt_con_pass');
                                $admin_pass = '';

                                if ($old_pass != '') {
                                    $result = $this->Admin_model->admin_login($user_name);
                                    foreach ($result as $value) {
                                        $admin_pass = trim($value->admin_password);
                                    }
                                    $status = password_verify($old_pass, $admin_pass);

                                    if ($status == 1) {
                                        if ($new_pass == $con_pass) {
                                            $hash_variable_salt = password_hash($new_pass, PASSWORD_BCRYPT, array('cost' => 12));
                                            $data = array(
                                                'admin_password' => $hash_variable_salt,
                                            );
                                            if ($this->Admin_model->update_admin_record($id, $data)) {
                                                $this->session->set_flashdata("suc_message", 'update');
                                                redirect('Admin/password');
                                            } else {
                                                $this->session->set_flashdata("suc_message", 'false');
                                                redirect('Admin/password');
                                            }
                                        } else {
                                            $this->session->set_flashdata("con_message", 'Confirm Password Does Not Matched.');
                                            redirect('Admin/password');
                                        }
                                    } else {
                                        $this->session->set_flashdata("old_message", 'Current Password Does Not Matched.');
                                        redirect('Admin/password');
                                    }
                                } else {
                                    $this->session->set_flashdata("old_message", 'Please Enter Old Password');
                                    redirect('Admin/password');
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

    function forgot_pass()
    {
        try {
            $this->load->view('admin/forgot/forgot_password');
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    function reset_pass()
    {
        try {
            if ($this->input->post('btn_forgot')) {
                $this->form_validation->set_rules('txt_email', 'Email Address', 'trim|required|valid_email');
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata("email_message", 'Please Enter Valid Email Address!');
                    redirect('Admin/forgot_pass');
                } else {
                    $admin_email = $this->input->post('txt_email');
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $OTP = substr(str_shuffle($permitted_chars), 0, 6);
                    $email_count = 0;
                    $data['result_admin'] = $this->Admin_model->admin_fetch($admin_email);
                    foreach ($data['result_admin'] as $row) {
                        $email_count = $row->ACount;
                    }
                    if ($email_count == 1) {
                        $this->session->set_userdata(
                            array(
                                    'email' => $admin_email,
                                )
                        );

                        $config = array(
                            'protocol' => 'smtp',
                            'smtp_host' => 'smtp.googlemail.com',
                            'smtp_port' => '587',
                            'smtp_user' => 'sspemail.notification@gmail.com',
                            'smtp_pass' => 'Ssptestmail123',
                            'mailtype' => 'html',
                            'charset' => 'iso-8859-1'
                        );
                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
                        $this->email->set_mailtype("html");

                        $subject = "OTP";
                        $message = "OTP is " . $OTP . "";
                        $this->email->to($admin_email);
                        $this->email->from('sspemail.notification@gmail.com');
                        $this->email->subject($subject);
                        $this->email->message($message);
                        $this->email->send();

                        $otp_update = $this->Admin_model->update_Otp($admin_email, $OTP);
                        $this->session->set_flashdata('suc_message', 'true');
                        redirect('Admin/reset_otp_pass');
                    } else {
                        $this->session->set_flashdata('suc_message', 'false');
                        redirect('Admin/forgot_pass');
                    }
                }
            } else if ($this->input->post('btn_cancel')) {
                redirect('Admin/index');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    function reset_otp_pass()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $this->load->view('admin/forgot/reset_password');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    function resend_otp()
    {
        try {
            if ($this->session->userdata('email') != '') {
                $admin_email = $this->session->userdata('email');
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                $OTP = substr(str_shuffle($permitted_chars), 0, 6);
                $email_count = 0;
                $data['result_admin'] = $this->Admin_model->admin_fetch($admin_email);
                foreach ($data['result_admin'] as $row) {
                    $email_count = $row->ACount;
                }
                if ($email_count == 1) {
                    $this->session->set_userdata(
                        array(
                                'email' => $admin_email,
                            )
                    );

                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.googlemail.com',
                        'smtp_port' => '587',
                        'smtp_user' => 'sspemail.notification@gmail.com',
                        'smtp_pass' => 'Ssptestmail123',
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1'
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->set_mailtype("html");

                    $subject = "OTP";
                    $message = "OTP is " . $OTP . "";
                    $this->email->from('sspemail.notification@gmail.com');
                    $this->email->to($admin_email);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $this->email->send();

                    $otp_update = $this->Admin_model->update_Otp($admin_email, $OTP);
                    $this->session->set_flashdata('suc_message', 'true');
                    redirect('Admin/reset_otp_pass');
                } else {
                    $this->session->set_flashdata('suc_message', 'false');
                    redirect('Admin/forgot_pass');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    function reset_new_pass()
    {
        try {
            if ($this->session->userdata('email') != '') {
                if ($this->input->post('btn_reset')) {
                    $this->form_validation->set_rules('txt_otp', 'Enter OTP', 'trim|required|callback_fullname_check');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("otp_message", 'Please Enter Valid OTP');
                        redirect('Admin/reset_otp_pass');
                    } else {
                        $this->form_validation->set_rules('new_pass', 'Enter New Password', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("pass_message", 'Please Enter Valid New Password');
                            redirect('Admin/reset_otp_pass');
                        } else {
                            $this->form_validation->set_rules('confirm_pass', 'Enter Confirm Password', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("con_message", 'Please Enter Valid Confirm Password');
                                redirect('Admin/reset_otp_pass');
                            } else {
                                $admin_email = $this->session->userdata('email');
                                $txt_otp = $this->input->post('txt_otp');
                                $password = $this->input->post('new_pass');
                                $con_password = $this->input->post('confirm_pass');
                                $admin_otp = '';
                                $data['result_admin'] = $this->Admin_model->admin_login_email($admin_email);
                                foreach ($data['result_admin'] as $row_data) {
                                    $admin_otp = $row_data->password_recover_otp;
                                }
                                if ($admin_otp == $txt_otp) {
                                    if ($password == $con_password) {
                                        $hash_variable_salt1 = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                                        $password = $hash_variable_salt1;
                                        $password_update = $this->Admin_model->update_password($admin_email, $password);
                                        $this->session->set_flashdata('suc_message', 'pass_true');
                                        $this->session->unset_userdata('email');
                                        redirect('Admin/index');
                                    } else {
                                        $this->session->set_flashdata('pass_fmessage', 'pass_false');
                                        redirect('Admin/reset_otp_pass');
                                    }
                                } else {
                                    $this->session->set_flashdata('otp_fmessage', 'false');
                                    redirect('Admin/reset_otp_pass');
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('Admin/index');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Redirect when call from ajax OTP */
    public function chaeck_otp()
    {
        try {
            $this->load->view('admin/forgot/check_otp');
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

}
