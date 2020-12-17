<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email_Knowledge extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Email_knowledge_model');
        $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }

    public function index() {
        $game_id = 1;
        /* fetch mission id  and email status */
        $data['knowledge_user'] = $this->Email_knowledge_model->fetch_quiz_attempt($game_id);
        foreach ($data['knowledge_user']as $value) {
            $mission_id = $value->mission_id;
            $trans_id = $value->trans_id;
            $user = $value->userident;
            $first_name = $value->first_name;
            $last_name = $value->last_name;
            $email = $value->email;


            /* fetch rank by user and mission */
            $data['res_knowlledge_user'] = $this->Email_knowledge_model->fetch_mission_knowledge_user($game_id, $mission_id, $user);
            foreach ($data['res_knowlledge_user'] as $row_knowlledge_user) {
                $rank_no = $row_knowlledge_user->rank_no;
                $know_completion_count = $row_knowlledge_user->know_completion_count;
                $sum_all_mission = $row_knowlledge_user->sum_all_mission;
                $mission_rank = $row_knowlledge_user->mission;
                $percentage = $row_knowlledge_user->percentage;
                $points = $row_knowlledge_user->points;
                $city_name = $row_knowlledge_user->city_name;

				
                if ($mission_rank > 0) {
					

                    /* fetch notification message */

                    $data['res_notification'] = $this->Email_knowledge_model->fetch_knowledge_data($game_id, $rank_no);
                    foreach ($data['res_notification'] as $row_notification) {
                        $subject = $row_notification->subject;
                        $message = $row_notification->message;

                        /* Email code. */
                        $content = "Hi " . $first_name . " " . $last_name . ",<br />" . $message . "<br />" . "Mission : " . $city_name . "<br />" . "Percentage : " . $percentage . " <br />" . "Knowledge Rank : " . $rank_no . "<br />" . "Mission Rank : " . $mission_rank . "<br />" . "Points : " . $points;
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
                            $this->email->subject($subject);
                            $this->email->message($content);


                            if ($this->email->send()) {
                            } else {
                                show_error($this->email->print_debugger());
                            }

                            /*  Update email sent status   */

                            $res = $this->Email_knowledge_model->update_email_status($game_id, $mission_id, $trans_id);
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                    }
                } else {
                    echo 'Mission is zero.';
                }
            }
        }
    }
	
	


}
