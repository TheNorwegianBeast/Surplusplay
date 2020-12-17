<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /* User Data */
    
    public function fetch_user_data($game_id,$user){
        try {
            $this->db->select('u.login_name,u.userident,u.first_name,u.last_name,u.email,r.role_name,u.role_id');
            $this->db->from('user_list_g'.$game_id . ' u ');
            $this->db->join('role_g'.$game_id . ' r ','u.role_id = r.role_id');
            $this->db->where('u.userident',$user);
            $query =  $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
        }
        
        /* game name */
        
        public function fetch_game_name($game_id){
            try {
                $this->db->select('game_name');
                $this->db->from('game');
                $this->db->where('game_id',$game_id);
                $query =  $this->db->get();
            $result = $query->result();
            return $result;
            } catch (Exception $e) {
                log_message('Error ', $e->getMessage());
            }
                }
}