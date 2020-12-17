<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email_knowledge_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
     /* fetch quiz attempt  */
    
    public function fetch_quiz_attempt($game_id){
        try {
            $this->db->select('q.trans_id,q.mission_id,q.userident,u.first_name,u.last_name,u.email');
            $this->db->from('quiz_attempt_g' . $game_id. ' q ');
            $this->db->join('user_list_g' . $game_id. ' u ','q.userident = u.userident');
            $this->db->where('email_status',0);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
            
    }

    /* Fetch rank by user knowledge */

    public function fetch_mission_knowledge_user($game_id, $mission_id, $userident) {
        try {
            $this->db->select('rnk.rank_no, rnk.know_completion_count, rnk.sum_all_mission, rnk.percent_m' . $mission_id . ' as percentage , rnk.mission' . $mission_id . ' as mission, rnk.points' . $mission_id . ' as points , m.city_name');
            $this->db->from('rank_knowledge_g' . $game_id . ' rnk ');
            $this->db->join('mission_g' . $game_id . ' m ', ' m.mission_id = ' . $mission_id);
            $this->db->where('rnk.userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* Fetch email data for knowledge activity */

    public function fetch_knowledge_data($game_id, $rank) {
        try {
            $this->db->select('*');
            $this->db->from('activity_notification_g' . $game_id);
            $this->db->where('from_rank <=', $rank);
            $this->db->where('to_rank >=', $rank);
            $this->db->where('type', 'knowledge');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* update knowledge email status */
    public function update_email_status($game_id, $mission_id,$trans_id){
        try {
            $this->db->where('trans_id',$trans_id);
            $this->db->where('mission_id',$mission_id);
            $array = array(
                'email_status' => 1,
            );
            if($this->db->update('quiz_attempt_g'.$game_id , $array)){
                return 1;
            }else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());

        }
    }
    
}

