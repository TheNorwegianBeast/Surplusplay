<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Game_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
    }

    /* select game */

    public function fetch_all_game()
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
	
	    /* select game */

public function fetch_user_game($game_id)
{
    try {
        $this->db->select('*');
		$this->db->from('game');
		$this->db->where('game_id != ', $game_id); 
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    } catch (Exception $ex) {
        error_log($ex->getTraceAsString());
        echo $ex->getTraceAsString();
        return false;
    }
}

        /* select one game */

    public function fetch_one_game($game_id)
    {
        try {
            $this->db->select('*');
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
    
    /* select Subscription */

    public function fetch_all_subscription()
    {
        try {
            $this->db->select('*');
            $this->db->from('subscription');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* add game */

    public function insert_game($add_game)
    {
        try {
            if ($this->db->insert('game', $add_game)) {
                return 1;
            } else {
                return 0;
            }
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* fetch game */

    public function fetch_game()
    {
        try {
            $this->db->select('g.game_id, g.subs_id, g.game_name, s.category_name');
            $this->db->from('game g');
            $this->db->join('subscription s', 'g.subs_id = s.sub_id');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* fetch game by id */

    public function fetch_game_by_id($game_id)
    {
        try {
            $this->db->where('g.game_id', $game_id);
            $this->db->select('g.game_name,	s.category_name,g.game_id,s.sub_id');
            $this->db->from('game g');
            $this->db->join('subscription s', 'g.subs_id = s.sub_id');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
         } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update game */

    public function update_game($update_game, $game_id)
    {
        try {
            $this->db->where('game_id', $game_id);
            if ($this->db->update('game', $update_game)) {
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
