<?php

class Email_new_sales extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('app_model/Resultlist_sale_model');
        $this->load->model('app_model/Notification_model');
        $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }

    public function index() {

        $this->load->library('email');

        /* email new sales */
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
                
                // check mission rank should be greater than zero
                 if ($sales_mission_rank > 0) {


                /* fetch notification message */

                $data['res_sales_notification'] = $this->Notification_model->fetch_sales_data($game_id, $sales_rank_no);
                foreach ($data['res_sales_notification'] as $row_sales_notification) {
                    $sales_subject = $row_sales_notification->subject;
                    $sales_message = $row_sales_notification->message;

                    /* Email code. */
                    $sales_content = "Hi " . $name . ",<br />" . $sales_message . "<br />" . "Mission : " . $sales_city_name . "<br />" . "Sales Rank : " . $sales_mission_rank . "<br />" . "Mission Rank : " . $sales_mission_rank . "<br />" . "Points : " . $sales_points;

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
                        error_log("Email error. " . $exc->getMessage());
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
