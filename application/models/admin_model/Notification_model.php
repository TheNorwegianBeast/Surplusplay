<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model
{
    /* Calling Constructer */

    public function __construct()
    {
        $this->load->database();
    }

    /* fetch notification interval */

    function fetch_notification_interval($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('interval_notification_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert notification interval */

    public function insert_notify_interval($data, $game_id)
    {
        try {
            return ($this->db->insert('interval_notification_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view notification interval */

    function view_notification_interval($game_id, $notify_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('interval_notification_g' . $game_id);
            $this->db->where('interval_notification_id', $notify_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update notification interval */

    public function update_notify_interval($game_id, $notify_id, $data)
    {
        try {
            $this->db->where('interval_notification_id', $notify_id);
            $this->db->update('interval_notification_g' . $game_id, $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete notification interval */

    function delete_notify_interval($game_id, $notify_id)
    {
        try {
            $this->db->where('interval_notification_id', $notify_id);
            $delete_status = $this->db->delete('interval_notification_g' . $game_id);
            if ($delete_status) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert activity interval */

    public function insert_activity_interval($data, $game_id)
    {
        try {
            return ($this->db->insert('activity_notification_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* fetch notification interval */

    function fetch_activity_notification($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('activity_notification_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view notification interval */

    function view_activity_notification($game_id, $notify_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('activity_notification_g' . $game_id);
            $this->db->where('activity_notification_id', $notify_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update notification activity */

    public function update_notify_activity($game_id, $notify_id, $data)
    {
        try {
            $this->db->where('activity_notification_id', $notify_id);
            $this->db->update('activity_notification_g' . $game_id, $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete notification activity */

    public function delete_notify_activity($game_id, $notify_id)
    {
        try {
            $this->db->where('activity_notification_id', $notify_id);
            if ($this->db->delete('activity_notification_g' . $game_id)) {
                 return 1;
            } else {
                 return 0;
            }
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return;
        }
    }

}
