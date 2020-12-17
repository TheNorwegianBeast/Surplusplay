<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    /* Calling Constructer */

    public function __construct() {
        $this->load->database();
    }

    /* admin login */

    function admin_login($username) {
        try {
            $this->db->select('id, admin_name, admin_email, admin_username, admin_password, profile_img');
            $this->db->from('admin');
            $this->db->where('admin_username', $username);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* admin login email */

    function admin_login_email($admin_email) {
        try {
            $this->db->select('password_recover_otp');
            $this->db->from('admin');
            $this->db->where('admin_email', $admin_email);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update admin record */

    public function update_admin_record($id, $data) {
        try {
            $this->db->where('id', $id);
            $this->db->update('admin', $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* admin Fetch */

    function admin_fetch($admin_email) {
        try {
            $this->db->select('COUNT(*) as ACount');
            $this->db->from('admin');
            $this->db->where('admin_email', $admin_email);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* Update otp and otp expire time */
    public function update_Otp($admin_email, $OTP)
    {
        try {
            $time = 5 * 60;
            $time_stamp =  date('Y-m-d h:i:s', time() + $time);
            $this->db->where('admin_email', $admin_email);
            $array = array(
                'password_recover_otp' => $OTP,
                'otp_date_time' => $time_stamp,
            );
            if ($this->db->update('admin', $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update_Password for user */

    public function update_password($admin_email, $password) {
        try {
            $this->db->where('admin_email', $admin_email);
            $array = array(
                'admin_password' => $password,
            );
            if ($this->db->update('admin', $array)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* fetch admin details */

    function admin_fetch_otp($admin_email) {
        try {
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('admin_email', $admin_email);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
    

}
