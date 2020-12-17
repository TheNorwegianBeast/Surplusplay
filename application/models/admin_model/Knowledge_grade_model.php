<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Knowledge_grade_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

    /* manage knowledge grade */

    public function view_knowledge_grade($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('avg_know_grade_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* add knowledge grade */

    public function add_knowledge_grade($insert_know_grade, $game_id) {
        try {
            if ($this->db->insert('avg_know_grade_g' . $game_id, $insert_know_grade)) {
                return 1;
            } else {
                return 0;
            }
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* edit knowledge grade */

    public function get_know_grade_by_id($avg_know_grade_id,$game_id) {
        try {
           
            $this->db->where('avg_know_grade_id', $avg_know_grade_id);
            $this->db->select('*');
            $this->db->from('avg_know_grade_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update knowledge grade */

    public function update_knowledge_grade($update_know_grade, $game_id, $avg_know_grade_id) {
        try {
            $this->db->where('avg_know_grade_id', $avg_know_grade_id);
            if ($this->db->update('avg_know_grade_g' . $game_id, $update_know_grade)) {
                return 1;
            } else {
                return 0;
            }
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete knowledge grade */

    public function delete_knowledge_grade($avg_know_grade_id, $game_id) {
        try {
            $this->db->where('avg_know_grade_id', $avg_know_grade_id);
            if ($this->db->delete('avg_know_grade_g' . $game_id)) {
                return 1;
            } else {
                return 0;
            }
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

}
