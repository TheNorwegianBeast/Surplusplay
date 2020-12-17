<?php


 $this =& get_instance();
//    $CI->test();


$game_id =1;

date_default_timezone_set('Asia/Calcutta');
$today_date = date("Y-m-d");
$today_time = date("H:i");
$address = 'satyamkuril143@gmail.com';
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
        echo 'KKKKKKKK';
        if ($row->notification_date == $today_date) {
            if ($row->notification_time == $today_time) {
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
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                $db_notify = $this->Notification_model->update_trigger($game_id, $today_date, $date, $time, $interval);
            }
        }
    }
}


