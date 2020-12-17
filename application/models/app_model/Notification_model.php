<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

/*  Fetch data from scoreboard table  */

    public function fetch_scoreboard($game_id) {
        try {
            $this->db->select('scoreboard_id, rnk.game_id, rnk.userident, rank_no, previous_rank_no, mission_completion_count, sum_all_mission_count, mission1, previous_mission1, points1, mission2, previous_mission2, points2, mission3, previous_mission3, points3, mission4, previous_mission4, points4, mission5, previous_mission5, points5, mission6, previous_mission6, points6, mission7, previous_mission7, points7, mission8, previous_mission8, points8, mission9, previous_mission9, points9, mission10, previous_mission10, points10, mission11, previous_mission11, points11, mission12, previous_mission12, points12, u.first_name, u.last_name, u.email');
            $this->db->from('rank_scoreboard_g'.$game_id . ' rnk ');
            $this->db->join('user_list_g' . $game_id . ' u ' ,  'rnk.userident = u.userident');
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
    
    /*  Fetch Mission name from mission table  */

    public function fetch_mission_by_id($game_id, $mission_id) {
        try {
            $this->db->select('city_name');
            $this->db->from('mission_g'.$game_id);
            $this->db->where('mission_id',$mission_id);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* fetch test drive email sent status */

    public function fetch_email_sent_status_test_drive($game_id) {
        try {
            $this->db->select('b.budget_id,b.username,b.userident,b.game_id,b.mission_id,b.testdrive_budget_status,b.email_test_drive_status, u.email');
            $this->db->from('budget_car_test_g'.$game_id . ' b ');
            $this->db->join('user_list_g' . $game_id . ' u ' ,  'b.userident = u.userident');
            $this->db->where('b.testdrive_budget_status','completed');
            $this->db->where('b.email_test_drive_status',0);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* Fetch rank by user test drive */

    public function fetch_mission_test_drive_user($game_id, $mission_id, $userident) {
        try {
             $this->db->select('rnk.rank_no, rnk.points'. $mission_id .',rnk.test_drive_completion_count, rnk.sum_all_test_drive_count,rnk.mission'.$mission_id . ' as mission, rnk.points'.$mission_id .' as points , m.city_name');
            $this->db->from('rank_test_drive_g'.$game_id . ' rnk ');
            $this->db->join('mission_g' . $game_id . ' m ' ,  'm.mission_id ='. $mission_id );
            $this->db->where('rnk.userident',$userident);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* Fetch email data for test drive activity */

    public function fetch_test_drive_data($game_id, $rank) {
        try {
            $this->db->select('*');
            $this->db->from('activity_notification_g'.$game_id);
            $this->db->where('from_rank <=',$rank);
             $this->db->where('to_rank >=',$rank);
             $this->db->where('type','test_drive');
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
   
    
    /* update Test Drive email status */

    public function update_email_status_test_drive($game_id, $bdget_id) {
        try {
            $this->db->where('budget_id',$bdget_id);
            $array = array(
                'email_test_drive_status' => 1,
            );
            if($this->db->update('budget_car_test_g'.$game_id , $array)){
                return 1;
            }else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* fetch test drive is completed and sales is completed email sent status */

    public function fetch_email_sent_status_mission($game_id) {
        try {
            $this->db->select('b.budget_id,b.username,b.userident,b.game_id,b.mission_id, u.email');
            $this->db->from('budget_car_test_g'.$game_id . ' b ');
            $this->db->join('user_list_g' . $game_id . ' u ' ,  'b.userident = u.userident' );
            $this->db->where('b.testdrive_budget_status','completed');
            $this->db->where('b.car_budget_status','completed');
            $this->db->where('b.mission_email_status',0);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
     /* Fetch rank by user test drive */

    public function fetch_mission_scoreboard_user($game_id, $mission_id, $userident) {
        try {
            $this->db->select('rnk.rank_no, rnk.mission_completion_count, rnk.sum_all_mission_count, rnk.mission'.$mission_id .'
                     as mission, rnk.points'.$mission_id. ' as points , m.city_name');
            $this->db->from('rank_scoreboard_g'.$game_id . ' rnk ');
            $this->db->join('mission_g'.$game_id. ' m ', 'm.mission_id ='. $mission_id);
            $this->db->where('rnk.userident',$userident);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* Fetch email data for scoreboard activity */

    public function fetch_scoreboard_data($game_id, $rank) {
        try {
            $this->db->select('*');
            $this->db->from('activity_notification_g'.$game_id);
            $this->db->where('from_rank <=',$rank);
             $this->db->where('to_rank >=',$rank);
             $this->db->where('type','scoreboard');
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
     /* update mission email status */

    public function update_email_status_mission($game_id, $bdget_id) {
        try {
            $this->db->where('budget_id',$bdget_id);
            $array = array(
                'mission_email_status' => 1,
            );
            if($this->db->update('budget_car_test_g'.$game_id , $array)){
                return 1;
            }else {
                return 0;
            }
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
    
    /* Fetch sales email sent status */

    public function fetch_email_sent_status_sales($game_id) {
        try {
              $this->db->select('b.budget_id,b.username,b.userident,b.game_id,b.mission_id,b.car_budget_status,b.email_sales_status, u.email');
            $this->db->from('budget_car_test_g'.$game_id . ' b ');
            $this->db->join('user_list_g'.$game_id .' u ','b.userident = u.userident' );
            $this->db->where('b.car_budget_status','completed');
            $this->db->where('b.email_sales_status',0);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* Fetch rank by user sales */

    public function fetch_mission_sales_user($game_id, $mission_id, $userident) {
        try {
            
            $this->db->select('rnk.rank_no, rnk.sale_completion_count, rnk.sum_all_mission_sales,rnk.mission'.$mission_id .' as mission, rnk.points'.$mission_id.' as points , m.city_name');
            $this->db->from('rank_sale_g'.$game_id . ' rnk ');
            $this->db->join('mission_g'.$game_id. ' m ','m.mission_id ='.$mission_id );
            $this->db->where('rnk.userident',$userident);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* Fetch email data for sales activity */

    public function fetch_sales_data($game_id, $rank) {
        try {
             $this->db->select('*');
            $this->db->from('activity_notification_g'.$game_id);
            $this->db->where('from_rank <=',$rank);
             $this->db->where('to_rank >=',$rank);
             $this->db->where('type','sales');
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
         /* update sales email status */
    public function update_email_status_sales($game_id, $bdget_id) {
        try {
            $this->db->where('budget_id',$bdget_id);
            $array = array(
                'email_sales_status' => 1,
            );
            if($this->db->update('budget_car_test_g'.$game_id , $array)){
                return 1;
            }else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
       /* fetch interval */
        public function fetch_interval($game_id) {
        try {
             $this->db->select('*');
            $this->db->from('interval_notification_g'.$game_id);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
    
          /* update_trigger */
            public function update_trigger($game_id, $trigger_date, $not_date, $not_time, $not_interval) {
        try {
            $this->db->where('notification_date',$not_date);
            $this->db->where('notification_time',$not_time);
            $this->db->where('notification_interval',$not_interval);
            $array = array(
                'trigger_date' => $trigger_date,
            );
            if($this->db->update('interval_notification_g'.$game_id , $array)){
                return 1;
            }else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
//       public function fetch_user($game_id) {
//        try {
//            $this->db->select('*');
//            $this->db->from('user_list_g'.$game_id);
//            $query = $this->db->get();
//            
//                return $query->result();
//           
//        } catch (Exception $ex) {
//            error_log($ex->getTraceAsString());
//            return;
//        }
//    }

     /* fetch interval */
        public function fetch_usera($game_id) {
        try {
             $this->db->select('*');
            $this->db->from('user_list_g'.$game_id);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
}

