<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pricelist_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
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

    /* select brand */

    public function select_brand($game_id)
    {
        try {
            $this->db->select('brand');
            $this->db->from('pricelist_g' . $game_id);
            $this->db->distinct();
            $this->db->group_by('brand', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
       
    }
    
    /* select car model */
    
    public function select_model($game_id)
    {
        try {
            $this->db->select('car_model');
            $this->db->from('pricelist_g' . $game_id);
            $this->db->distinct();
            $this->db->group_by('car_model', 'asc');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
       
    }

    /* Insert Pricelist */

    public function add_pricelist($insert_pricelist, $game_id)
    {
        try {
            if ($this->db->insert('pricelist_g' . $game_id, $insert_pricelist)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    public function get_pricelist($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('pricelist_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    public function get_pricelist_by_id($id, $game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('pricelist_g' . $game_id);
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

     /* Game Name by id */
    
    public function get_game_name($game_id)
    {
        try {
            $this->db->select('game_name');
            $this->db->from('game');
            $this->db->where('game_id', $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    public function update_pricelist($update_pricelist, $game_id,$id)
    {
        try {
            $this->db->where('id', $id);
            if ($this->db->update('pricelist_g' . $game_id, $update_pricelist)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete pricelist */

    public function delete_pricelist($id, $game_id)
    {
        try {
            $this->db->where('id', $id);
            if ($this->db->delete('pricelist_g' . $game_id)) {
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
