<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* admin login */

    function user_login($username) {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g1');
            $this->db->where('email', $username);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    public function fetch_price_list($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('pricelist_g' . $game_id);
            $query = $this->db->get();

            $result = $query->result();

            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return False;
        }
    }

    public function fetch_inventory($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('inventory_g' . $game_id);
            $query = $this->db->get();

            $result = $query->result();

            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return False;
        }
    }

    public function insert_sale($array) {
        try {
            if ($this->db->insert('sale_transaction', $array)) {
                return $this->db->insert_id();
            } else {
                return 0;
            }
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }
    
      public function insert_sale_game_transaction($array,$game_id) {
        try {
            if ($this->db->insert('game_trans_g' . $game_id, $array)) {
                return $this->db->insert_id();
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /* Fetch  Course Quiz id from tbl_course_quizz */

    public function count_mission($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return False;
        }
    }
    
     /* Fetch  Course Quiz id from tbl_course_quizz */

    public function fetch_videos($game_id,$mission_id) {
        try {
            
            $this->db->select('*');
            $this->db->from('level_knowledge_g' . $game_id);
            $this->db->where('mission_id <=', $mission_id);
            $this->db->where('knowledge_type ', 'video');
            $this->db->order_by('mission_id', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return False;
        }
    }

    /* Fetch last attempted mission */
    
    function fetch_last_completed_mission($user,$game_id) {
        try {
        $this->db->select('*');
        $this->db->from('mission_duration_g' . $game_id);
        $this->db->where('budget_status', 'completed');
        $this->db->where('userident', $user);
        $this->db->order_by('mission_dur_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->result();
         return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return False;
        }
    }
    
     /* select budget table Test Drive mission completed record */

    public function fetch_start_mission_status($user, $game_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('game_id', $game_id);
//            $this->db->where('mission_id', $mission_id);
            $this->db->where('userident', $user);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
    
     
      /* select budget table Test Drive mission completed record */

    public function fetch_start_mission_status_test($user, $game_id,$mission_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('userident', $user);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
      /* update mission */

    public function update_budget_status($update_status, $budget_id, $game_id) {
        try {
            $this->db->where('budget_id', $budget_id);
            if ($this->db->update('budget_car_test_g' . $game_id, $update_status)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }
    
      /* update mission */

    public function update_budget_duration($update_status, $budget_id, $game_id) {
        try {
            $this->db->where('budget_id', $budget_id);
            if ($this->db->update('mission_duration_g' . $game_id, $update_status)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
          log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }
    
    
         /* fetch Allow days */

    public function fetch_budget_status($budgetid, $game_id) {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('budget_id', $budgetid);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
          log_message('Error ', $e->getMessage());
        }
    }
    
    
       /* fetch Video */

    public function fetch_video($mission_id, $game_id) {
        try {
            $this->db->select('*');
            $this->db->from('level_knowledge_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
           /* fetch Mission */

    public function fetch_mission($mission_id, $game_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }
    
    
          /* fetch Mission */

    public function fetch_completion_time($user,$mission_id, $game_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
             $this->db->where('game_id', $game_id);
              $this->db->where('userident', $user);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
//    SELECT * FROM `mission_duration$str` WHERE `userident`='$user' and `game_id`='$game_id' and `mission_id`='$mission_id' ";
               /* fetch Assigned budget */

    public function fetch_assign_budget($game_id, $mission_id, $user) {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('userident', $user);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    
    function fetch_user_sale_test_sumQty($game_id, $mission_id, $userident) {
       try {
           $this->db->select('sum(quantity) as test_qty');
           $this->db->from('sale_transaction');
           $this->db->where('game_id', $game_id);
           $this->db->where('mission_id', $mission_id);
           $this->db->where('reg_type', 2);
           $this->db->where('userident', $userident);
           $query = $this->db->get();
           $result = $query->result();
           return $result;
       } catch (Exception $e) {
           log_message('SQL Error ', $e->getMessage());
           return;
       }
   }
    
        /* update budget status */

    public function update_test_budget_status($update_status, $mission_id, $game_id,$user) {
        try {
            $this->db->where('mission_id', $mission_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('userident', $user);
            if ($this->db->update('budget_car_test_g' . $game_id, $update_status)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }
    
    
     function fetch_user_sale_car_sum_qty($game_id, $mission_id, $userident) {
       try {
           $this->db->select('sum(quantity) as sale_car_qty');
           $this->db->from('sale_transaction');
           $this->db->where('game_id', $game_id);
           $this->db->where('mission_id', $mission_id);
           $this->db->where('reg_type', 1);
           $this->db->where('userident', $userident);
           $query = $this->db->get();
           $result = $query->result();
           return $result;
       } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
           return;
       }
   }

     /* update budget status */

    public function update_car_budget_status($update_status, $mission_id, $game_id,$user) {
        try {
            $this->db->where('mission_id', $mission_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('userident', $user);
            if ($this->db->update('budget_car_test_g' . $game_id, $update_status)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }
    
    
        /* fetch Assigned budget */

    public function fetch_mission_completed($game_id, $mission_id, $user) {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('userident', $user);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }
    
    
     /* update budget status */

    public function update_mission_status($update_status, $mission_id, $game_id,$user) {
        try {
            $this->db->where('mission_id', $mission_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('userident', $user);
            if ($this->db->update('mission_duration_g' . $game_id, $update_status)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }
    
    
    /**
     * Select Attempted mission last achieve Badge from attempts table .
     */ 

    public function fetch_attempted_mission_badge($game_id, $mission_id, $userident) 
    {
        try {
            $this->db->select('badge_image');
            $this->db->from('quiz_attempt_g'. $game_id );
            $this->db->where('userident', $userident);
            $this->db->where('mission_id', $mission_id);
             //  $this->db->order_by("quiz_attmp_id", "desc");
          //  $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /**
     * Select Attempted mission count.
     */ 
 
    public function fetch_attempted_mission($game_id, $mission_id, $userident) 
    {
        try {
            $this->db->select('count(*) as mission_attempt_count');
            $this->db->from('quiz_attempt_g'. $game_id );
            $this->db->where('userident', $userident);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /**
     * Select is player completed mission
     */ 
  
    public function fetch_is_mission_complete($game_id, $mission_id, $userident) 
    {
        try {
            $this->db->select('budget_status');
            $this->db->from('mission_duration_g' . $game_id );
            $this->db->where('userident', $userident);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }
    
    
     /**
     * Fetch Data from knowledge badge mapping table
     */ 
  
    public function fetch_knowledge_badge_mapping($game_id, $userident) 
    {
        try {
            $this->db->select('*');
            $this->db->from('knowledge_badge_mapping_g' . $game_id );
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }
   
    
    /**
     * Fetch Data from knowledge badge mapping table record count
     */ 
  
    public function fetch_knowledge_badge_mapping_count($game_id, $userident) 
    {
        try {
            $this->db->select('count(*) as count');
            $this->db->from('knowledge_badge_mapping_g' . $game_id );
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }


}
