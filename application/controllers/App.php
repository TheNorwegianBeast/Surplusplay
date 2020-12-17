<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/App_model');
        $this->load->library('form_validation');
        $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }

    public function index() {
        $this->load->view('index');
    }

    /* user login validation */

    public function login_validation() {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('txt_email', 'email', 'trim|required|valid_email');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('email_message', 'Please Enter Valid Email Address');
                redirect('App/index');
            } else {
                $this->form_validation->set_rules('txt_password', 'Password', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('pass_message', 'Please Enter Valid Password');
                    redirect('App/index');
                } else {
                    $username = $this->input->post('txt_email');
                    $password = $this->input->post('txt_password');
                    $user_email = '';
                    $user_pass = '';
                    $p_userident = '';
                    $p_first_name = '';
                    $p_last_name = '';
                    $p_role_id = '';
                    $game_id = 1;
                    $status = '';
                    $role_user = '';

                    $result = $this->App_model->user_login($game_id, $username);
                    foreach ($result as $value) {
                        $user_email = trim($value->email);
                        $user_pass = trim($value->password);
                        $p_userident = trim($value->userident);
                        $p_first_name = trim($value->first_name);
                        $p_last_name = trim($value->last_name);
                        $p_role_id = trim($value->role_id);

                        /* Replace , with space */
                        $role_user = str_replace(',', '', $p_role_id);
                    }

                    /* Verify password */

                    $status = password_verify($password, $user_pass);

                    if ($username == $user_email && $status != "") {

                        $this->session->set_userdata(
                                array(
                                    'game_id' => $game_id,
                                    'email' => $user_email,
                                    'user' => $p_userident,
                                    'first_name' => $p_first_name,
                                    'last_name' => $p_last_name,
                                    'role_id' => $role_user
                                )
                        );

                        /*  Role based login */
                        if (($role_user == "45") || ($role_user == "54" || $role_user == "4")) {
                            redirect('app_controller/Dashboard_manager/dash_manager');
                        } elseif ($role_user == "5") {
                            redirect('app_controller/Overview/game_overview');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid Login Credentials!');
                        redirect('App/index');
                    }
                }
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /**
     * Logout function 
     */
    function logout() {
        try {
            $this->session->unset_userdata('game_id');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('user');
            $this->session->unset_userdata('first_name');
            $this->session->unset_userdata('last_name');
            $this->session->unset_userdata('role_id');
            redirect('App/index');
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    function app_forgot() {
        $this->load->view('app/app_forgot');
    }

    public function send_email() {

        try {
            $this->load->view('app/send_mail_password');
        } catch (Exception $ex) {
            log_message($ex->getTraceAsString());
            return;
        }
    }

    function verify_password() {
        if ($this->input->post('btn_send')) {
            $this->form_validation->set_rules('txt_email', 'email', 'trim|required|valid_email');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('email_message', 'Please Enter Valid Email Address');
                redirect('App/app_forgot');
            } else {
                $game_id = 1;
                $user_email = $this->input->post('txt_email');
                $this->load->library('email');
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                $OTP = substr(str_shuffle($permitted_chars), 0, 6);
                $email = '';
                $data['result_user'] = $this->App_model->fetch_user_ident($game_id, $user_email);
                foreach ($data['result_user'] as $row) {
                    $email = $row->email;
                }
                if ($user_email == $email) {
                    $this->session->set_userdata(
                            array(
                                'email' => $user_email,
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
                    $this->email->to($user_email);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $this->email->send();

                    $otp_update = $this->App_model->update_Otp($game_id, $user_email, $OTP);
                    $this->session->set_flashdata('suc_message', 'OTP sent Successfully');
                    redirect('App/reset_pass');
                } else {
                    $this->session->set_flashdata('message', 'Entered Email is not found in Database');
                    redirect('App/app_forgot');
                }
                // $data['result_user'] = $result_user;
                //print_r($result_user);
                // if (!empty($result_user)) {
                // 
                // 
                // } else {
                //      $this->session->set_flashdata('message', 'Invalid Email!');    
                //      redirect('App/app_forgot');
                // }
            }
        } else if ($this->input->post('btn_cancel')) {
            redirect('App/index');
        }
    }

    public function reset_pass() {
        try {
            $this->load->view('app/user/verify_password');
        } catch (Exception $ex) {
            log_message($ex->getTraceAsString());
            return;
        }
    }

    public function resend_otp() {
        try {
            $game_id = 1;
            $user_email = $this->session->userdata('email');
            $this->load->library('email');
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $OTP = substr(str_shuffle($permitted_chars), 0, 6);

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
            $this->email->to($user_email);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();

            $otp_update = $this->App_model->update_Otp($game_id, $user_email, $OTP);
            $this->session->set_flashdata('suc_message', 'OTP sent Successfully');
            redirect('App/reset_pass');
        } catch (Exception $ex) {
            log_message($ex->getTraceAsString());
            return;
        }
    }

    function update_password() {
        if ($this->input->post('reset_pass')) {
            $this->form_validation->set_rules('txt_otp', 'otp', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('otp_message', 'Please Enter Valid OTP');
                redirect('App/reset_pass');
            } else {
                $this->form_validation->set_rules('password', 'password', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('pass_message', 'Please Enter Valid Password');
                    redirect('App/reset_pass');
                } else {
                    $this->form_validation->set_rules('confirm_password', 'password', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata('con_message', 'Please Enter Valid Confirm Password');
                        redirect('App/reset_pass');
                    } else {
                        $game_id = 1;
                        $user_email = $this->session->userdata('email');
                        $txt_otp = $this->input->post('txt_otp');
                        $password = $this->input->post('password');
                        $con_password = $this->input->post('confirm_password');
                        $otp = '';
                        $data['result_user'] = $this->App_model->fetch_user_ident($game_id, $user_email);
                        foreach ($data['result_user'] as $row) {
                            $otp = $row->password_recover_otp;
                        }

                        if ($otp == $txt_otp) {
                            if ($password == $con_password) {
                                $hash_variable_salt1 = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                                $password = $hash_variable_salt1;
                                $password_update = $this->App_model->update_password($game_id, $user_email, $password);
                                $this->session->set_flashdata('message', 'Password Updated Successfully!');
                                $this->session->unset_userdata('email');
                                redirect('App/index');
                            } else {
                                $this->session->set_flashdata('message', 'Password Does not matched');
                                redirect('App/reset_pass');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'You have Entered invalid OTP!');
                            // $data['result_user'] = $result_user;
                            redirect('App/reset_pass');
                        }
                    }
                }
            }
        }
    }

    /* Ajax call for otp comparision */
    public function chaeck_otp() {
        try {
            $this->load->view('app/user/check_otp');
        } catch (Exception $ex) {
            log_message($ex->getTraceAsString());
            return;
        }
    }

}
