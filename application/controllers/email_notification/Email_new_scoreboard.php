<?php

class Email_new_scoreboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Resultlist_scoreboard_model');
        $this->load->model('app_model/Notification_model');
        $this->load->library('email');
        $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }

    public function index() {

        /* Email New Scoreboard */

        $game_id = 1;

        /*  Fetch All record mission status completed and email not sent */

        $data['res_email_mission'] = $this->Notification_model->fetch_email_sent_status_mission($game_id);
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
                
                // check mission rank should be greater than zeroo
                    if ($scoreboard_mission_rank > 0) {

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
                        $this->email->to($email);
                        $this->email->from('atg.emailnotification@gmail.com');
                        $this->email->subject($scoreboard_subject);
                        $this->email->message($scoreboard_content);


                        if ($this->email->send()) {
                            echo 'Your Email has successfully been sent.';
                        } else {
                            show_error($this->email->print_debugger());
                        }

                        /*  Update email sent status   */

                        $res = $this->Notification_model->update_email_status_mission($game_id, $budget_id);
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                
                }else
                
                {
                    echo "Mission zero";
                }
            }
        }
    }

}
