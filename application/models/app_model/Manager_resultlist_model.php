<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_resultlist_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* fetch scoreboard report */

    public function fetch_all_user($game_id, $userident) {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id . ' user ');
            $this->db->where("role_id", 5)->or_where("role_id", '4,5,');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $exc) {
            log_message('SQL Error ', $exc->getTraceAsString());
            return;
        }
    }

    public function fetch_all_user_kwg($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_knowledge_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $exc) {
            log_message('SQL Error ', $exc->getTraceAsString());
            return;
        }
    }

    public function fetch_attempted_mission_badge($game_id, $userident, $mission_id) {
        try {
            $this->db->select('*');
            $this->db->from('quiz_attempt_g' . $game_id . ' user ');
            $this->db->where('user.userident', $userident);
            $this->db->where('user.mission_id', $mission_id);
            $this->db->order_by('quiz_attmp_id', 'desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $exc) {
            log_message('SQL Error ', $exc->getTraceAsString());
            return;
        }
    }

    public function update_per_mission_percentage($game_id, $m_num, $percentage, $userident) {
        try {
            $this->db->update('rank_knowledge_g');
            $this->db->set('percent_m' . $m_num, $percentage, false);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $exc) {
            log_message('SQL Error ', $exc->getTraceAsString());
            return;
        }
    }

    function fetch_report_data_knowledge($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_knowledge_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->order_by('rank_no', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    public function fetch_report_data_knowledge_user($game_id, $userident) {
        try {
            $this->db->select('*');
            $this->db->from('rank_knowledge_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->where('tr.userident', $userident);
            $this->db->order_by('rank_no', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /* Fetch scoreboard report */

    public function fetch_report_scoreboard($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_scoreboard_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->order_by('rank_no', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    public function fetch_report_scoreboard_user($game_id, $userident) {
        try {
            $this->db->select('*');
            $this->db->from('rank_scoreboard_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->where('tr.userident', $userident);
            $this->db->order_by('rank_no', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /* Fetch Data for sale Report */

    public function fetch_report_sales($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_sale_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->order_by('rank_no', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    public function fetch_report_sales_user($game_id, $userident) {
        try {
            $this->db->select('*');
            $this->db->from('rank_sale_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->where('tr.userident', $userident);
            $this->db->order_by('rank_no', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /* Fetch test drive data */

    public function fetch_report_testdrive($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_test_drive_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->order_by('rank_no', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /* Fetch test drive data */

    public function fetch_report_testdrive_user($game_id, $userident) {
        try {
            $this->db->select('*');
            $this->db->from('rank_test_drive_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->where('tr.userident', $userident);
            $this->db->order_by('rank_no', 'ASC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

}
