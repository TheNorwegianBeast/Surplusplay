<?php

class Email_scoreboard_dailly extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->model('app_model/Notification_model');
        $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }

    public function index() {
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
                    $this->email->message($message);


                    if ($this->email->send()) {
                        echo 'Your Email has successfully been sent.';
                    } else {
                        show_error($this->email->print_debugger());
                    }
                } catch (Exception $e) {
                    error_log("Email Error" . $e);
                }
            }
        }
    }

}
