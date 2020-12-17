<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Notification_model');
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

    /* email controller to send score board report daily at 11: 30 am */

    public function email_scoreboard_dailly() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = 1;
                $m = 1;
                $mission_rank = 0;
                $mission_previous_rank = 0;
                $mission_back_rank = 0;
                $mission_back_previous_rank = 0;

                $data['res_data'] = $this->Notification_model->fetch_scoreboard($game_id);
                foreach ($data['res_data'] as $row_data) {
                    $first_name = $row_data->first_name;
                    $last_name = $row_data->last_name;
                    $email = $row_data->email;
                    $userident = $row_data->userident;
                    $rank_no = $row_data->rank_no;
                    $previous_rank_no = $row_data->previous_rank_no;
                    $complteted_mission_count = $row_data->mission_completion_count;
                    if ($complteted_mission_count == 0) {
                        $m = 1;
                    } else {
                        $m = $complteted_mission_count;
                    }

                    $data1 = 'mission' . $m;
                    $mission = $row_data->$data1;
                    $data2 = 'points' . $m;
                    $points = $row_data->$data2;
                    $data3 = 'previous_mission' . $m;
                    $previous_mission = $row_data->$data3;

                    $diff = $rank_no - $previous_rank_no;
                    $diff = str_replace("-", "", $diff);
                    $status = '';
                    $message = '';
                    $subject = "Mission Report.";
                    /* fetch mission name */

                    $data['res_mission'] = $this->Notification_model->fetch_mission_by_id($game_id, $m);
                    foreach ($data['res_mission'] as $row_mission) {

                        $mission_name = $row_mission->city_name;
                        if ($previous_rank_no > $rank_no) {
                            $status = "Move Up! to ";
                            $message = "Hi " . $first_name . " " . $last_name . ", <br />" . "Congratulations!  You have " . $status . "" . $diff . " position in Mission " . $mission_name . ".<br />";
                        }

                        if ($previous_rank_no < $rank_no) {
                            $status = "Move Down! to ";
                            $message = "Hi " . $first_name . " " . $last_name . ", <br />" . "Sorry, your performance is low. But I’m sure you can do better next time! <br />  You have " . $status . "" . $diff . " position in Mission " . $mission_name . ".<br />";
                        }

                        if ($previous_rank_no == $rank_no) {
                            $status = "On Same!";
                            $message = "Hi " . $first_name . " " . $last_name . ", <br />" . "Good Work! - very well ,  You have " . $status . "" . $mission . " position in Mission " . $mission_name . ".<br />";
                        }


                        try {
                            $this->load->library('email');

//SMTP & mail configuration
                            $config = array(
                                'protocol' => 'smtp',
                                'smtp_host' => 'dotnor.no',
                                'smtp_port' => 25,
                                'smtp_user' => 'testemail@palam.tempdom.site',
                                'smtp_pass' => 'loW1c#30',
                                'mailtype' => 'html',
                                'charset' => 'iso-8859-1'
                            );
                            $this->email->initialize($config);
                            $this->email->set_mailtype("html");
                            $this->email->set_newline("\r\n");
                            $this->email->to($email);
                            $this->email->from('testemail@palam.tempdom.site');
                            $this->email->subject($subject);
                            $this->email->message($message);


                            if ($this->email->send()) {
                                echo 'Your Email has successfully been sent.';
                            } else {
                                show_error($this->email->print_debugger());
                            }
                        } catch (Exception $ex) {
                            log_message('Error', $ex->getTraceAsString());
                        }
                    }
                }
                $this->load->view('app/email_notification/email_scoreboard_dailly', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* Test Drive email */
    public function email_new_test_drive() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = 1;
                $data['res_email_test_drive'] = $this->Notification_model->fetch_email_sent_status_test_drive($game_id);
                foreach ($data['res_email_test_drive'] as $row_email_test_drive) {
                    $budget_id = $row_email_test_drive->budget_id;
                    $userident = $row_email_test_drive->userident;
                    $name = $row_email_test_drive->username;
                    $mission_id = $row_email_test_drive->mission_id;
                    $email = $row_email_test_drive->email;


                    /* fetch rank test_drive by user and mission  */

                    $data['res_test_drive_user'] = $this->Notification_model->fetch_mission_test_drive_user($game_id, $mission_id, $userident);
                    foreach ($data['res_test_drive_user'] as $row_test_drive_user) {
                        $test_drive_rank_no = $row_test_drive_user->rank_no;
                        $test_drive_completion_count = $row_test_drive_user->test_drive_completion_count;
                        $test_drive_sum_all_mission = $row_test_drive_user->sum_all_test_drive_count;
                        $test_drive_mission_rank = $row_test_drive_user->mission;
                        $test_drive_points = $row_test_drive_user->points;
                        $test_drive_city_name = $row_test_drive_user->city_name;

                        /* fetch notification message */

                        $data['res_test_drive_notification'] = $this->Notification_model->fetch_test_drive_data($game_id, $test_drive_rank_no);
                        foreach ($data['res_test_drive_notification'] as $row_test_drive_notification) {
                            $test_drive_subject = $row_test_drive_notification->subject;
                            $test_drive_message = $row_test_drive_notification->message;

                            /* Email code. */
                            $test_drive_content = "Hi " . $name . ",<br />" . $test_drive_message . "<br />" . "Mission : " . $test_drive_city_name . "<br />" . "Test Drive Rank : " . $test_drive_mission_rank . "<br />" . "Mission Rank : " . $test_drive_mission_rank . "<br />" . "Points : " . $test_drive_points;

                            try {
                                $this->load->library('email');

                                //SMTP & mail configuration
                                $config = array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'dotnor.no',
                                    'smtp_port' => 25,
                                    'smtp_user' => 'testemail@palam.tempdom.site',
                                    'smtp_pass' => 'loW1c#30',
                                    'mailtype' => 'html',
                                    'charset' => 'iso-8859-1'
                                );
                                $this->email->initialize($config);
                                $this->email->set_mailtype("html");
                                $this->email->set_newline("\r\n");
                                $this->email->to($email);
                                $this->email->from('testemail@palam.tempdom.site');
                                $this->email->subject($test_drive_subject);
                                $this->email->message($test_drive_content);


                                if ($this->email->send()) {
                                    echo 'Your Email has successfully been sent.';
                                } else {
                                    show_error($this->email->print_debugger());
                                }
                                /*  Update email sent status   */

                                $res = $this->Notification_model->update_email_status_test_drive($game_id, $budget_id);
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                        }
                    }
                }
                $this->load->view('app/email_notification/email_new_test_drive', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* scoreboard email code */
    public function email_new_scoreboard() {
        try {
            if ($this->session->userdata('email') != '') {
                $game_id = 1;

                /*  Fetch All record mission status completed and email not sent */

                $data['res_email_mission'] = $this->Notification_model->fetch_email_sent_status_mission($game_id);
                print_r($data['res_email_mission']);
                foreach ($data['res_email_mission'] as $row_email_mission) {
                    $budget_id = $row_email_mission->budget_id;
                    $userident = $row_email_mission->userident;
                    $name = $row_email_mission->username;
                    $mission_id = $row_email_mission->mission_id;
                    $email = $row_email_mission->email;
                    /* fetch rank scoreboard by user and mission  */
                    $data['res_scoreboard_user'] = $this->Notification_model->fetch_mission_scoreboard_user($game_id, $mission_id, $userident);
                    foreach ($data['res_scoreboard_user'] as $row_scoreboard_user) {
                        $scoreboard_rank_no = $row_scoreboard_user->rank_no;
                        $scoreboard_completion_count = $row_scoreboard_user->mission_completion_count;
                        $scoreboard_sum_all_mission = $row_scoreboard_user->sum_all_mission_count;
                        $scoreboard_mission_rank = $row_scoreboard_user->mission;
                        $scoreboard_points = $row_scoreboard_user->points;
                        $scoreboard_city_name = $row_scoreboard_user->city_name;

                        /* fetch notification message */

                        $data['res_scoreboard_notification'] = $this->Notification_model->fetch_scoreboard_data($game_id, $scoreboard_rank_no);
                        foreach ($data['res_scoreboard_notification'] as $row_scoreboard_notification) {
                            $scoreboard_subject = $row_scoreboard_notification->subject;
                            $scoreboard_message = $row_scoreboard_notification->message;

                            /* Email code. */

                            $scoreboard_content = "Hi " . $name . ",<br />" . $scoreboard_message . "<br />" . "Mission : " . $scoreboard_city_name . "<br />" . "Scoreboard Rank : " . $scoreboard_mission_rank . "<br />" . "Mission Rank : " . $scoreboard_mission_rank . "<br />" . "Points : " . $scoreboard_points;


                            try {
                                $this->load->library('email');
                                $config = array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'dotnor.no',
                                    'smtp_port' => 25,
                                    'smtp_user' => 'testemail@palam.tempdom.site',
                                    'smtp_pass' => 'loW1c#30',
                                    'mailtype' => 'html',
                                    'charset' => 'iso-8859-1'
                                );
                                $this->email->initialize($config);
                                $this->email->set_mailtype("html");
                                $this->email->set_newline("\r\n");
                                $this->email->to($email);
                                $this->email->from('testemail@palam.tempdom.site');
                                $this->email->subject($scoreboard_subject);
                                $this->email->message($scoreboard_content);


                                if ($this->email->send()) {
                                    echo 'Your Email has successfully been sent.';
                                } else {
                                    show_error($this->email->print_debugger());
                                }
                                echo 'hi';
                                /*  Update email sent status   */

                                $res = $this->Notification_model->update_email_status_mission($game_id, $budget_id);
                                print_r($res);
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                        }
                    }
                }
                $this->load->view('app/email_notification/email_new_scoreboard', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

    /* New sales email */
    public function email_new_sales() {
        try {
            if ($this->session->userdata('email') != '') {

                $game_id = 1;

                /*  Fetch All record mission status completed and email not sent */

                $data['res_email_status'] = $this->Notification_model->fetch_email_sent_status_sales($game_id);
                foreach ($data['res_email_status'] as $row_email_status) {
                    $budget_id = $row_email_status->budget_id;
                    $userident = $row_email_status->userident;
                    $name = $row_email_status->username;
                    $mission_id = $row_email_status->mission_id;
                    $email = $row_email_status->email;

                    /* fetch rank sales by user and mission  */
                    $data['res_sales_user'] = $this->Notification_model->fetch_mission_sales_user($game_id, $mission_id, $userident);
                    foreach ($data['res_sales_user'] as $row_sales_user) {

                        $sales_rank_no = $row_sales_user->rank_no;
                        $sales_completion_count = $row_sales_user->sale_completion_count;
                        $sales_sum_all_mission = $row_sales_user->sum_all_mission_sales;
                        $sales_mission_rank = $row_sales_user->mission;
                        $sales_points = $row_sales_user->points;
                        $sales_city_name = $row_sales_user->city_name;


                        /* fetch notification message */

                        $data['res_sales_notification'] = $this->Notification_model->fetch_sales_data($game_id, $sales_rank_no);
                        foreach ($data['res_sales_notification'] as $row_sales_notification) {
                            $sales_subject = $row_sales_notification->subject;
                            $sales_message = $row_sales_notification->message;

                            /* Email code. */
                            $sales_content = "Hi " . $name . ",<br />" . $sales_message . "<br />" . "Mission : " . $sales_city_name . "<br />" . "Sales Rank : " . $sales_mission_rank . "<br />" . "Mission Rank : " . $sales_mission_rank . "<br />" . "Points : " . $sales_points;

                            try {
                                $this->load->library('email');

                                //SMTP & mail configuration
                                $config = array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'dotnor.no',
                                    'smtp_port' => 25,
                                    'smtp_user' => 'testemail@palam.tempdom.site',
                                    'smtp_pass' => 'loW1c#30',
                                    'mailtype' => 'html',
                                    'charset' => 'iso-8859-1'
                                );
                                $this->email->initialize($config);
                                $this->email->set_mailtype("html");
                                $this->email->set_newline("\r\n");
                                $this->email->to($email);
                                $this->email->from('testemail@palam.tempdom.site');
                                $this->email->subject($sales_subject);
                                $this->email->message($sales_content);


                                if ($this->email->send()) {
                                    echo 'Your Email has successfully been sent.';
                                } else {
                                    show_error($this->email->print_debugger());
                                }
                                /*  Update email sent status   */

                                $res = $this->Notification_model->update_email_status_sales($game_id, $budget_id);
                            } catch (Exception $e) {
                                log_message("Error. " . $exc->getMessage());
                            }
                        }
                    }
                }
                $this->load->view('app/email_notification/email_new_sales', $data);
            } else {
                redirect('App/index');
            }
        } catch (Exception $ex) {
            log_message('Error', $ex->getTraceAsString());
            return;
        }
    }

}
