<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist_scoreboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* fetch scoreboard report */

    public function fetch_report_scoreboard($game_id, $userident) {
        try {
            if ($userident != '') {
                $this->db->select('first_name,`scoreboard_id`, `game_id`, `rank_no`, `mission_completion_count`, `sum_all_mission_count`, `mission1`, `mission2`, `mission3`, `mission4`, `mission5`, `mission6`, `mission7`, `mission8`, `mission9`, `mission10`, `mission11`, `mission12`');
                $this->db->from('rank_scoreboard_g' . $game_id . ' rnk ');
                $this->db->join('user_list_g' . $game_id . ' ulist ', 'rnk.userident = ulist.userident');
                $this->db->where('rnk.userident', $userident);
                $this->db->order_by('rank_no', 'asc');
                $query = $this->db->get();
                $result = $query->result();
            } else {
                $this->db->select('first_name,`scoreboard_id`, `game_id`, `rank_no`, `mission_completion_count`, `sum_all_mission_count`, `mission1`, `mission2`, `mission3`, `mission4`, `mission5`, `mission6`, `mission7`, `mission8`, `mission9`, `mission10`, `mission11`, `mission12`');
                $this->db->from('rank_scoreboard_g' . $game_id . ' rnk ');
                $this->db->join('user_list_g' . $game_id . ' ulist ', 'rnk.userident = ulist.userident');
                $this->db->order_by('rank_no', 'asc');
                $query = $this->db->get();
                $result = $query->result();
            }
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* select scoreboard mission and rank data  */

    public function fetch_scoreboard_data($game_id, $ms) {
        try {
            $this->db->select('scoreboard_id, rank_no,mission' . $ms . ' as `mission_rank`');
            $this->db->from('rank_scoreboard_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();


            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* update mission previous rank  */

    public function update_previous_mission_rank_scoreboard($game_id, $m, $mission_rank, $scoreboard_id) {
        try {
            $this->db->where('scoreboard_id', $scoreboard_id);
            $array = array(
                'previous_rank_no' => $mission_rank
            );

            if ($this->db->update('rank_scoreboard_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /*  fetch mission from Mission duration table once mission completed scoreboard  */

    public function fetch_mission_spendtime_scoreboard($game_id, $m_num) {
        try {
            $this->db->select('*');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('mission_id', $m_num);
            $this->db->where('budget_status', 'completed');
            $this->db->Order_by('spend_time_minutes', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /*  update mission per Rank scoreboard  */

    public function update_mission_rank_scoreboard($game_id, $mission_rank, $rank, $points, $userident, $m) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'mission' . $m => $rank,
                'points' . $m => $points
            );
            if ($this->db->update('rank_scoreboard_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* Fetch All Rank from Rank scoreboard */

    public function fetch_all_user_rank_scoreboard($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_scoreboard_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* Fetch total mission clear by user from mission duration  */

    public function fetch_total_clear_mission_scoreboard($game_id, $userident) {
        try {
            $this->db->select('count(*) as total_mission_clear');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('userident', $userident);
            $this->db->where('budget_status', 'completed');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
          
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* Update Clear Misson Count scoreboard */

    public function update_clear_mission_count_scoreboard($game_id, $total_mission_count, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'mission_completion_count' => $total_mission_count
            );
           
            if ($this->db->update('rank_scoreboard_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* Sum of all mission rank count by userident scoreboard  */

    public function fetch_all_mission_count_scoreboard($game_id, $userident) {
        try {
            $this->db->select('(mission1 + mission2 + mission3 + mission4 + mission5 + mission6 + mission7 +  mission8 + mission9 + mission10 + mission11 + mission12)  as sum_all_mission_rank');
            $this->db->from('rank_scoreboard_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* Updated all mission count scoreboard  */

    public function update_all_mission_count_scoreboard($game_id, $sum_all_mission, $userident) {
        try {

            $this->db->where('userident', $userident);
            $array = array(
                'sum_all_mission_count' => $sum_all_mission
            );
            if ($this->db->update('rank_scoreboard_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* update previous rank  */

    public function update_previou_rank_scoreboard($game_id, $rank_no, $scoreboard_id) {
        try {
            $this->db->where('scoreboard_id', $scoreboard_id);
            $array = array(
                'previous_rank_no' => $rank_no
            );
            if ($this->db->update('rank_scoreboard_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* Comparision between total mission and rank of user */

    public function comparision_mission_rank_scoreboard($game_id) {
        try {
            $this->db->select('userident , mission_completion_count,sum_all_mission_count');
            $this->db->from('rank_scoreboard_g' . $game_id);
            $this->db->Order_by('mission_completion_count', 'desc');
            $this->db->Order_by('sum_all_mission_count', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

    /* Update User Rank scoreboard */

    public function update_final_rank_scoreboard($game_id, $rank, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'rank_no' => $rank
            );
            if ($this->db->update('rank_scoreboard_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return false;
        }
    }

}
