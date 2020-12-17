<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* admin login */

    function user_login($game_id, $username) {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id);
            $this->db->where('email', $username);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $ex) {
            log_message('Error ', $ex->getMessage());
            return;
        }
    }

    /* fetch single user */

    function fetch_user_ident($game_id, $id) {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id);
            $this->db->where('email', $id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update_Otp and otp expire time for user */

    public function update_Otp($game_id, $user_email, $OTP) {
        try {
            $time = 5 * 60;
            $time_stamp = date('Y-m-d h:i:s', time() + $time);
            $this->db->where('email', $user_email);
            $array = array(
                'password_recover_otp' => $OTP,
                'otp_date_time' => $time_stamp,
            );
            if ($this->db->update('user_list_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());

        }
    }

    /* update_trigger */

    public function update_password($game_id, $user_email, $password) {
        try {

            $this->db->where('email', $user_email);
            $array = array(
                'password' => $password,
            );
            if ($this->db->update('user_list_g' . $game_id, $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());

        }
    }

}
