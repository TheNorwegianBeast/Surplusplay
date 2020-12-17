<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist_sale_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* Fetch Data for sale Report */

    public function fetch_report_sales($game_id, $userident) {
        try {
            if ($userident != "") {
                $this->db->select('first_name,sale_ranking_id, game_id, rank_no, sale_completion_count, sum_all_mission_sales, mission1, mission2, mission3, mission4, mission5, mission6, mission7, mission8, mission9, mission10, mission11, mission12');
                $this->db->from('rank_sale_g' . $game_id . ' rnk ');
                $this->db->join(' user_list_g' . $game_id . ' ulist ', 'rnk.userident=ulist.userident');
                $this->db->where('rnk.userident', $userident);
                $this->db->Order_by('rank_no', ' asc');
                $query = $this->db->get();
                $result = $query->result();
            } else {
                $this->db->select('first_name,sale_ranking_id, game_id, rank_no, sale_completion_count, sum_all_mission_sales, mission1, mission2, mission3, mission4, mission5, mission6, mission7, mission8, mission9, mission10, mission11, mission12');
                $this->db->from('rank_sale_g' . $game_id . ' rnk ');
                $this->db->join(' user_list_g' . $game_id . ' ulist ', 'rnk.userident=ulist.userident');
                $this->db->Order_by('rank_no', ' asc');
                $query = $this->db->get();
                $result = $query->result();
            }
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /*  update mission duration table once mission completed  */

    public function fetch_mission_spend_time_sale($game_id, $m) {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('mission_id', $m);
            $this->db->where('car_budget_status', 'completed');
            $this->db->Order_by('car_reg_duration', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /*  update mission per Rank   */

    public function update_per_mission_rank_sale($game_id, $m, $rank, $points, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'mission' . $m => $rank,
                'points' . $m => $points
            );
            if ($this->db->update('rank_sale_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /* Fetch All Rank from Rank Table */

    public function fetch_all_user_rank_sale($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_sale_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /* Fetch total mission clear by user from mission duration table */

    public function fetch_total_clear_mission_by_user_sale($game_id, $userident_rnk) {
        try {
            $this->db->select('count(*) as  total_mission_clear ');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('userident', $userident_rnk);
            $this->db->where('car_budget_status', 'completed');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /* Update completed Misson Count in Rank Table */

    public function update_completed_mission_count_sale($game_id, $misssion_count, $userident_rnk) {
        try {
            $this->db->where('userident', $userident_rnk);
            $array = array(
                'sale_completion_count' => $misssion_count
            );

            if ($this->db->update('rank_sale_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /* Sum of all mission rank count by userident  */

    public function fetch_all_mission_count_sale($game_id, $userident_from_rnk) {
        try {
            $this->db->select('(mission1+mission2+mission3+mission4+mission5+mission6+mission7+mission8+mission9+mission10+mission11+mission12) as sum_all_mission_rank');
            $this->db->from('rank_sale_g' . $game_id);
            $this->db->where('userident', $userident_from_rnk);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /* Updated All Mission Count in Rank Table  */

    public function update_all_mission_count_sale($game_id, $sum_all_mission, $userident_from_rnk) {
        try {
            $this->db->where('userident', $userident_from_rnk);
            $array = array(
                'sum_all_mission_sales' => $sum_all_mission
            );

            if ($this->db->update('rank_sale_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /* Comparision between total mission and rank of user */

    public function comparision_mission_rank_sale($game_id) {
        try {
            $this->db->select('userident,sale_completion_count,sum_all_mission_sales');
            $this->db->from('rank_sale_g' . $game_id);
            $this->db->Order_by('sale_completion_count', 'desc');
            $this->db->Order_by('sum_all_mission_sales', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /* Update Users final Rank  of sales report */

    public function update_final_rank_sales($game_id, $rank, $userident_mission_rank) {
        try {
            $this->db->where('userident', $userident_mission_rank);
            $array = array(
                'rank_no' => $rank
            );

            if ($this->db->update('rank_sale_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

}
