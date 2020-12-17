<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resultlist_test_drive_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* Fetch test drive data */

    public function fetch_report_testdrive($game_id, $userident) {
        try {
            if ($userident != "") {
                $this->db->select('first_name,test_drive_ranking_id, game_id, rank_no, test_drive_completion_count, sum_all_test_drive_count, mission1, mission2, mission3, mission4, mission5, mission6, mission7, mission8, mission9, mission10, mission11 ,mission12');
                $this->db->from('rank_test_drive_g' . $game_id . ' rnk ');
                $this->db->join(' user_list_g' . $game_id . ' ulist ', 'rnk.userident=ulist.userident');
                $this->db->where('rnk.userident', $userident);
                $this->db->Order_by('rank_no', ' asc');
                $query = $this->db->get();
                $result = $query->result();
            } else {
                $this->db->select('first_name,test_drive_ranking_id, game_id, rank_no, test_drive_completion_count, sum_all_test_drive_count, mission1, mission2, mission3, mission4, mission5, mission6, mission7, mission8, mission9, mission10, mission11 ,mission12');
                $this->db->from('rank_test_drive_g' . $game_id . ' rnk ');
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

    /*  fetch mission from Mission duration table once mission completed  */

    public function fetch_mission_spendtime_testdrive($game_id, $m) {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('mission_id', $m);
            $this->db->where('testdrive_budget_status', 'completed');
            $this->db->Order_by('test_drive_duration', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*  update each test drive mission  rank.  */

    public function update_each_mission_rank_testdrive($game_id, $m, $rank, $points, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'mission' . $m => $rank,
                'points' . $m => $points
            );
            if ($this->db->update('rank_test_drive_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }

    /* Fetch data from test drive */

    public function fetch_all_rank_testdrive($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_test_drive_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }

    /* Fetch total mission clear by user  */

    public function fetch_user_total_clear_mission_testdrive($game_id, $userident) {
        try {
            $this->db->select('count(*) as  total_mission_clear ');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('userident', $userident);
            $this->db->where('testdrive_budget_status', 'completed');
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* Update test drive clear misson count in Rank Table */

    public function update_clear_mission_count_testdrive($game_id, $misssion_count, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'test_drive_completion_count' => $misssion_count
            );

            if ($this->db->update('rank_test_drive_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* Sum of all mission rank count by userident  */

    public function fetch_all_mission_count_testdrive($game_id, $userident) {
        try {
            $this->db->select('(mission1+mission2+mission3+mission4+mission5+mission6+mission7+mission8+mission9+mission10+mission11+mission12) as sum_all_mission_rank');
            $this->db->from('rank_test_drive_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* Updated All Mission Count in Rank Table  */

    public function update_all_MissionCount_Test($game_id, $sum_all_mission, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'sum_all_test_drive_count' => $sum_all_mission
            );

            if ($this->db->update('rank_test_drive_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* Comparision between total mission and rank of user test drive */

    public function comparision_mission_rank_testdrive($game_id) {
        try {
            $this->db->select('userident,test_drive_completion_count,sum_all_test_drive_count');
            $this->db->from('rank_test_drive_g' . $game_id);
            $this->db->Order_by('test_drive_completion_count', 'desc');
            $this->db->Order_by('sum_all_test_drive_count', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* Update final Rank test drive */

    public function update_final_rank_testdrive($game_id, $rank, $userident) {
        try {
            $this->db->where('userident', $userident);
            $array = array(
                'rank_no' => $rank
            );

            if ($this->db->update('rank_test_drive_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

}
