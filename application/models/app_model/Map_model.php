<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function fetch_last_completed_mission($game_id, $user) {
        try {
            $this->db->select('*');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('budget_status', 'completed');
            $this->db->where('userident', $user);
            $this->db->order_by('mission_dur_id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

}
