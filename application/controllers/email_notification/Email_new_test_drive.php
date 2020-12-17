<?php



class Email_new_test_drive extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model/Resultlist_test_drive_model');
         $this->load->model('app_model/Notification_model');
        $this->load->library('email');
         $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }
    
      public function index(){ 
          
        /* email_new test drive */

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
                
                  // check mission rank should be greater than zeroo
                    if ($test_drive_mission_rank > 0) {

                /* fetch notification message */

                $data['res_test_drive_notification'] = $this->Notification_model->fetch_test_drive_data($game_id, $test_drive_rank_no);
                foreach ($data['res_test_drive_notification'] as $row_test_drive_notification) {
                    $test_drive_subject = $row_test_drive_notification->subject;
                    $test_drive_message = $row_test_drive_notification->message;

                    /* Email code. */
                    $test_drive_content = "Hi " . $name . ",<br />" . $test_drive_message . "<br />" . "Mission : " . $test_drive_city_name . "<br />" . "Test Drive Rank : " . $test_drive_mission_rank . "<br />" . "Mission Rank : " . $test_drive_mission_rank . "<br />" . "Points : " . $test_drive_points;

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
                
            }else
                {
                    echo "Mission zero";
                }
            }
        }
    }

}