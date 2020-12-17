<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mission_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
    }

    /* add mission */

    public function add_mission($insert_mission, $game_id)
    {
        try {
            if ($this->db->insert('mission_g' . $game_id, $insert_mission)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get all mission */

    public function get_all_mission($game_id)
    {
        try {
            $this->db->select('mg.mission_step,mg.level_id, mg.game_id, g.game_name,mg.mission_id');
            $this->db->from('mission_g' . $game_id . ' mg ');
            $this->db->join('game g', 'mg.game_id =g.game_id');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get mission by id */

    public function get_mission_by_id($game_id, $mission_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('mission_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
        /* get mission by id */

    public function get_mission_count($game_id)
    {
        try {
            $this->db->select('COUNT(*) as MCount');
            $this->db->from('mission_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* Fetch mission id by name */

    public function fetch_mission_id_by_name($user_mission, $game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('mission_g' . $game_id);
            $this->db->where('city_name', $user_mission);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
    /* update mission */

    public function update_mission($update_mission, $game_id, $mission_id)
    {
        try {
            $this->db->where('mission_id', $mission_id);
            if ($this->db->update('mission_g' . $game_id, $update_mission)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete mission */

    public function delete_mission($mission_id, $game_id)
    {
        try {
            $this->db->where('mission_id', $mission_id);
            if ($this->db->delete('mission_g' . $game_id)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get question by id */

    public function get_question_by_id($game_id, $mission_id)
    {
        try {
            $this->db->select('q.*, g.game_name, m.mission_step');
            $this->db->from('question_g' . $game_id . '_m' . $mission_id . ' q');
            $this->db->join('game g', 'q.game_id =g.game_id');
            $this->db->join('mission_g' . $game_id . ' m', 'm.mission_id = ' . $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert question */

    public function insert_question($data, $game_id, $mission_id)
    {
        try {
            return ($this->db->insert('question_g' . $game_id . '_m' . $mission_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

            /* get question count */

    public function get_question_count($game_id, $mission_id)
    {
        try {
            $this->db->select('COUNT(*) as QCount');
            $this->db->from('question_g' . $game_id . '_m' . $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get question */

    public function get_question($game_id, $mission_id, $question_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('question_g' . $game_id . '_m' . $mission_id);
            $this->db->where('question_id', $question_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update question */

    public function update_question($game_id, $mission_id, $question_id, $data)
    {
        try {
            $this->db->where('question_id', $question_id);
            $this->db->update('question_g' . $game_id . '_m' . $mission_id, $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete question */

    public function delete_question($game_id, $mission_id, $question_id)
    {
        try {
            $this->db->where('question_id', $question_id);
            if ($this->db->delete('question_g' . $game_id . '_m' . $mission_id)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get knowledge */

    public function get_knowledge($game_id, $mission_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('level_knowledge_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert knowledge video */

    public function insert_knowledge_video($data, $game_id)
    {
        try {
            return ($this->db->insert('level_knowledge_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* get one knowledge */

    public function get_one_knowledge($game_id, $knowledge_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('level_knowledge_g' . $game_id);
            $this->db->where('knowledge_id', $knowledge_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update question */

    public function update_knowledge($game_id, $knowledge_id, $data)
    {
        try {
            $this->db->where('knowledge_id', $knowledge_id);
            $this->db->update('level_knowledge_g' . $game_id, $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete knowledge */

    public function delete_knowledge($game_id, $knowledge_id)
    {
        try {
            $this->db->where('knowledge_id', $knowledge_id);
            if ($this->db->delete('level_knowledge_g' . $game_id)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* get budget */

    public function get_budget($game_id, $mission_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('game_id', $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
            /* get user budget */

    public function get_user_budget($game_id, $mission_id, $userident)
    {
        try {
            $this->db->select('COUNT(*) as BCount');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    

        /* insert budget */

    public function insert_budget($data, $game_id)
    {
        try {
            return ($this->db->insert('budget_car_test_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
            /* Fetch Last Inserted Budget id */

    public function fetch_last_budget_id($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->order_by('budget_id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
            /* Insert Data in Mission Duration table */

    public function insert_mission_duration($data, $game_id)
    {
        try {
            return ($this->db->insert('mission_duration_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    

        /* get one budget */

    public function get_one_budget($game_id, $budget_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('budget_id', $budget_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
            /* get mission budget status */

    public function get_mission_dur($game_id, $mission_id, $userident)
    {
        try {
            $this->db->select('budget_status');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* update budget */

    public function update_budget($game_id, $budget_id, $data)
    {
        try {
            $this->db->where('budget_id', $budget_id);
            $this->db->update('budget_car_test_g' . $game_id, $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
        /* delete budget */

    public function delete_budget($game_id, $budget_id)
    {
        try {
            $this->db->where('budget_id', $budget_id);
            if ($this->db->delete('budget_car_test_g' . $game_id)) {
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
