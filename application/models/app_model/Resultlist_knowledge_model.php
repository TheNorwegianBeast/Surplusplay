<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist_knowledge_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /* Fetch Data for Report */

    public function fetch_report_data_knowledge($game_id, $userident) {
        try {
            if ($userident != "") {
                 $this->db->select('first_name,last_name, game_id, level_id, rank_no, know_completion_count, sum_all_mission, percentage, mission1, mission2, mission3, mission4, mission5, mission6, mission7, mission8, mission9, mission10, mission11, mission12');
                $this->db->from('rank_knowledge_g' . $game_id . ' rnk ');
               $this->db->join(' user_list_g' . $game_id . ' ulist ', 'rnk.userident=ulist.userident');
                $this->db->where('rnk.userident', $userident);
                $this->db->Order_by('rank_no', ' asc');
                $query = $this->db->get();
                $result = $query->result();
            } else {
                $this->db->select('first_name,last_name, game_id, level_id, rank_no, know_completion_count, sum_all_mission, percentage, mission1, mission2, mission3, mission4, mission5, mission6, mission7, mission8, mission9, mission10, mission11, mission12');
                $this->db->from('rank_knowledge_g' . $game_id . ' rnk ');
                $this->db->join(' user_list_g' . $game_id . ' ulist ', 'rnk.userident=ulist.userident');
                $this->db->Order_by('rank_no', ' asc');
                $query = $this->db->get();
                $result = $query->result();
            }
            return $result;
            
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
    
    /* Knowledge report  */

    public function fetch_knowledge_rank_data($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_knowledge_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* Select Attempted mission last achieve Badge from attempts table */

    public function fetch_attempted_mission_badge($game_id, $userident, $mission_id) {
        try {
            $this->db->select('*');
            $this->db->from('quiz_attempt_g' . $game_id);
            $this->db->where('mission_id',$mission_id);
            $this->db->where('userident',$userident);
            $this->db->Order_by('quiz_attmp_id', 'desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*  update each mission percentage   */

    public function update_per_mission_percentage($game_id, $m_id, $percentage, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'percent_m' . $m_id => $percentage
               
            );
            if ($this->db->update('rank_knowledge_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
           
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
     /* Fetch All data from rank knowledge table ORDER BY desc Mission */

    public function select_rank_mission_desc($game_id, $m) {
        try {
            $this->db->select('level_id, userident, percent_m' . $m . ' as `percentage`');
            $this->db->from('rank_knowledge_g' . $game_id);
            $this->db->Order_by('percent_m'.$m, 'desc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* Select Attempted mission count */

    public function fetch_attempted_mission_count($game_id, $mission_id, $userident) {
        try {
            $this->db->select('count(*) as mission_attempt_cnt');
            $this->db->from('quiz_attempt_g' . $game_id);
            $this->db->where('mission_id',$mission_id);
            $this->db->where('userident',$userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());

        }
    }
    
     /*  update each mission rank percentage   */

    public function update_per_mission_rank_percentage($game_id, $m, $m_num, $points, $userident) {
        try {
             $this->db->where('userident', $userident);
            $array = array(
                'mission'. $m => $m_num,
                'points'. $m => $points
               
            );
            if ($this->db->update('rank_knowledge_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* Fetch All Data from Rank Knowledge Table  */

    public function fetch_knowledge_rank($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_knowledge_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* Fetch Sum all mission knowledge table */

    public function fetch_sum_mission($game_id, $userident) {
        try {
             $this->db->select('(mission1+mission2+mission3+mission4+mission5+mission6+mission7+mission8+mission9+mission10+mission11+mission12) as sum_all_mission');
            $this->db->from('rank_knowledge_g'.$game_id);
            $this->db->where('userident',$userident);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* Update Sum all mission knowledge table */

    public function update_sum_all_mission($game_id, $sum_mission, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'sum_all_mission' => $sum_mission
            );
            if ($this->db->update('rank_knowledge_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
            
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
     /* Fetch Distinct course quiz count */

    public function fetch_disctinct_attempt_quiz($game_id, $userident) {
        try {
            $this->db->select('count(mission_id) as quizcount');
            $this->db->distinct();
            
            $this->db->from('quiz_attempt_g' . $game_id);
            $this->db->where('userident',$userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
            
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
    
    /* Update number of quiz attempted count */

    public function update_attempted_quiz_count($game_id, $quiz_count, $userident) {
        try {
             $this->db->where('userident', $userident);
            $array = array(
                'know_completion_count' => $quiz_count
            );
            if ($this->db->update('rank_knowledge_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    
    /* Comparision knowlege between number of attempted quiz and sum of all mission rank */

    public function comparision_knowledge_rank($game_id) {
        try {
            $this->db->select('`userident,know_completion_count,sum_all_mission');
            $this->db->from('rank_knowledge_g' . $game_id);
           
            $this->db->Order_by('know_completion_count','desc');
            $this->db->Order_by('sum_all_mission', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
    
    /* Update Knowledge Rank */

    public function update_knowledge_rank($game_id, $rank, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'rank_no' => $rank
            );
            if ($this->db->update('rank_knowledge_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
           
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    /* fetch mission id */
    
    public function fetch_mission_id($game_id){
        try {
            $this->db->select('mission_id');
            $this->db->from('mission_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }



}

