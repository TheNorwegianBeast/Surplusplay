<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Grade_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

    /* add grade */

    public function add_grade($insert_grade, $game_id) {
        try {
            if ($this->db->insert('grade_g' . $game_id, $insert_grade)) {
                return 1;
            } else {
                return 0;
            }
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view grade */

    public function view_grade($game_id) {
        try {
           
            $this->db->select('*');
            $this->db->from('grade_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view grade by id */

    public function view_grade_by_id($grade_id, $game_id) {
        try {
            $this->db->select('*');
            $this->db->from('grade_g' . $game_id);
            $this->db->where('grade_id', $grade_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /*  update grade */

    public function update_grade($update_grade, $game_id, $grade_id) {
        try {
            $this->db->where('grade_id', $grade_id);
            if ($this->db->update('grade_g' . $game_id, $update_grade)) {
                return 1;
            } else {
                return 0;
            }
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete grade */

    public function delete_grade($grade_id, $game_id) {
        try {
            $this->db->where('grade_id', $grade_id);
            if ($this->db->delete('grade_g' . $game_id)) {
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
