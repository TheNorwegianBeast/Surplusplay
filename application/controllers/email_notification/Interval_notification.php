<?php

class interval_notification extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('app_model/Notification_model');
        $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }

    public function index() {
        $game_id = 1;

//date_default_timezone_set('Asia/Calcutta');
//$today_date = date("Y-m-d");
//$today_time = date("H:i");
        $i = 0;

        $result_user = $this->Notification_model->fetch_usera($game_id);
        foreach ($result_user as $row_user) {
            $i++;
            $address = $row_user->email;
            $this->load->library('email');

            $today_date = gmdate("Y-m-d");
            $today_time = gmdate("H:i");
//$address = 'satyamkuril143@gmail.com';
            $message = 'test17-04';
            $result = $this->Notification_model->fetch_interval($game_id);
            foreach ($result as $row) {
                $subject = $row->subject;
                $body = $row->message;
                $alt_body = $row->message;
                $date = $row->notification_date;
                $time = $row->notification_time;
                $interval = $row->notification_interval;
                $zone = $row->time_zone;
                $trigger_week = $row->trigger_date;

                if ($row->notification_interval == 'Only Once') {
                    if ($row->notification_date == $today_date) {
                        if ($row->notification_time == $today_time) {
                            try {

                                $this->load->library('email');

//SMTP & mail configuration
                                $config = array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'smtp.googlemail.com',
                                    'smtp_port' => '587',
                                    'smtp_user' => 'atg.emailnotification@gmail.com',
                                    'smtp_pass' => 'axiom123',
                                    'mailtype' => 'html',
                                    'charset' => 'iso-8859-1'
                                );
                                $this->load->library('email', $config);
                                $this->email->set_newline("\r\n");
                                $this->email->set_mailtype("html");
                                $this->email->to($address);
                                $this->email->from('atg.emailnotification@gmail.com');
                                $this->email->subject($subject);
                                $this->email->message($message);


                                if ($this->email->send()) {
                                    echo 'Your Email has successfully been sent.';
                                } else {
                                    show_error($this->email->print_debugger());
                                }
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                            $db_notify = $this->Notification_model->update_trigger($game_id, $today_date, $date, $time, $interval);
                        }
                    }
                } elseif ($row->notification_interval == 'Daily') {
                    if ($row->notification_time == $today_time) {
                        try {
                            $this->load->library('email');

//SMTP & mail configuration
                            $config = array(
                                'protocol' => 'smtp',
                                'smtp_host' => 'smtp.googlemail.com',
                                'smtp_port' => '587',
                                'smtp_user' => 'atg.emailnotification@gmail.com',
                                'smtp_pass' => 'axiom123',
                                'mailtype' => 'html',
                                'charset' => 'iso-8859-1'
                            );
                            $this->load->library('email', $config);
                            $this->email->set_newline("\r\n");
                            $this->email->set_mailtype("html");
                            $this->email->to($address);
                            $this->email->from('atg.emailnotification@gmail.com');
                            $this->email->subject($subject);
                            $this->email->message($message);


                            if ($this->email->send()) {
                                echo 'Your Email has successfully been sent.';
                            } else {
                                show_error($this->email->print_debugger());
                            }
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                        $db_notify = $this->Notification_model->update_trigger($game_id, $today_date, $date, $time, $interval);
                    }
                } elseif ($row->notification_interval == 'Weekly') {
                    $week_date = date('Y-m-d', strtotime('-1 week', strtotime($today_date)));
                    if ($row->notification_date == $today_date || $week_date == $today_date || $week_date == $trigger_week) {
                        if ($row->notification_time == $today_time) {
                            try {
                                $this->load->library('email');

//SMTP & mail configuration
                                $config = array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'smtp.googlemail.com',
                                    'smtp_port' => '587',
                                    'smtp_user' => 'atg.emailnotification@gmail.com',
                                    'smtp_pass' => 'axiom123',
                                    'mailtype' => 'html',
                                    'charset' => 'iso-8859-1'
                                );
                                $this->load->library('email', $config);
                                $this->email->set_newline("\r\n");
                                $this->email->set_mailtype("html");
                                $this->email->to($address);
                                $this->email->from('atg.emailnotification@gmail.com');
                                $this->email->subject($subject);
                                $this->email->message($message);


                                if ($this->email->send()) {
                                    echo 'Your Email has successfully been sent.';
                                } else {
                                    show_error($this->email->print_debugger());
                                }
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                            $db_notify = $this->Notification_model->update_trigger($game_id, $today_date, $date, $time, $interval);
                        }
                    }
                } elseif ($row->notification_interval == 'Monthly') {
                    $month_date = date('Y-m-d', strtotime('-1 month', strtotime($today_date)));
                    if ($row->notification_date == $today_date || $month_date == $today_date || $month_date == $trigger_week) {
                        if ($row->notification_time == $today_time) {
                            try {
                                $this->load->library('email');

//SMTP & mail configuration
                                $config = array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'smtp.googlemail.com',
                                    'smtp_port' => '587',
                                    'smtp_user' => 'atg.emailnotification@gmail.com',
                                    'smtp_pass' => 'axiom123',
                                    'mailtype' => 'html',
                                    'charset' => 'iso-8859-1'
                                );
                                $this->load->library('email', $config);
                                $this->email->set_newline("\r\n");
                                $this->email->set_mailtype("html");
                                $this->email->to($address);
                                $this->email->from('atg.emailnotification@gmail.com');
                                $this->email->subject($subject);
                                $this->email->message($message);


                                if ($this->email->send()) {
                                    echo 'Your Email has successfully been sent.';
                                } else {
                                    show_error($this->email->print_debugger());
                                }
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                            $db_notify = $this->Notification_model->update_trigger($game_id, $today_date, $date, $time, $interval);
                        }
                    }
                } elseif ($row->notification_interval == 'Yearly') {

                    $year_date = date('Y-m-d', strtotime('-1 year', strtotime($today_date)));

                    if ($row->notification_date == $today_date || $year_date == $today_date || $year_date == $trigger_week) {
                        if ($row->notification_time == $today_time) {
                            try {
                                $this->load->library('email');

//SMTP & mail configuration
                                $config = array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'smtp.googlemail.com',
                                    'smtp_port' => '587',
                                    'smtp_user' => 'atg.emailnotification@gmail.com',
                                    'smtp_pass' => 'axiom123',
                                    'mailtype' => 'html',
                                    'charset' => 'iso-8859-1'
                                );
                                $this->load->library('email', $config);
                                $this->email->set_newline("\r\n");
                                $this->email->set_mailtype("html");
                                $this->email->to($address);
                                $this->email->from('atg.emailnotification@gmail.com');
                                $this->email->subject($subject);
                                $this->email->message($message);


                                if ($this->email->send()) {
                                    echo 'Your Email has successfully been sent.';
                                } else {
                                    show_error($this->email->print_debugger());
                                }
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                            $db_notify = $this->Notification_model->update_trigger($game_id, $today_date, $date, $time, $interval);
                        }
                    }
                }
            }
        }
    }

}
