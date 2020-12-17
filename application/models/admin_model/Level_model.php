<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Level_model extends CI_Model
{

    function __construct()
    {
        $this->load->database();
    }

    /* Add level */

    public function add_level($insert_level, $game_id)
    {
        try {
            if ($this->db->insert('level_g' . $game_id, $insert_level)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* select game */

    public function select_game()
    {
        try {
            $this->db->select('*');
            $this->db->from('game');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get level list */

    public function get_level_list($game_id)
    {
        try {
            $this->db->select('lv.level_id, lv.game_id, lv.title, lv.from_date, lv.to_date, lv.grades, lv.result, lv.attendance, lv.certifcate, lv.diploma, lv.create_date_time, g.game_name');
            $this->db->from('level_g' . $game_id . ' lv ');
            $this->db->join('game g', 'lv.game_id =g.game_id');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get level by id for view */

    public function get_level_by_id($level_id, $game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('level_g' . $game_id);
            $this->db->where('level_id', $level_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $ex) {
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
        }
    }

    /* get level by id for update */

    public function get_level_by_level_id($level_id, $game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('level_g' . $game_id);
            $this->db->where('level_id', $level_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $ex) {
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
        }
    }

    /* update level */

    public function update_level($insert_level, $game_id, $level_id)
    {
        try {
            $this->db->where('level_id', $level_id);
            if ($this->db->update('level_g' . $game_id, $insert_level)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete level */

    public function delete_level($level_id, $game_id)
    {
        try {
            $this->db->where('level_id', $level_id);
            if ($this->db->delete('level_g' . $game_id)) {
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
