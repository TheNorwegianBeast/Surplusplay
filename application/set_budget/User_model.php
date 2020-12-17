<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class User_model extends CI_Model
{
    /* Calling Constructer */

    public function __construct()
    {
        $this->load->database();
    }

    /* get user role */

    function get_role($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('role_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    // function get_role_test($postData=array())
    // {
    //     try {
    //         $response = array();
    //         if(isset($postData['game_id']) ) { 
    //             $this->db->select('*');
    //             $this->db->from('role_g' . $postData['game_id']);
    //             $records = $this->db->get();
    //             $response = $records->result_array();
    //         }
 
    //         return $response;
    //     } catch (Exception $e) {
    //         log_message('error', $e->getMessage());
    //         return;
    //     }
    // }

    /* insert user data */

    public function insert_user_data($data, $game_id)
    {
        try {
            return ($this->db->insert('user_list_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* fetch last user */
    
    function fetch_last_user($game_id)
    {
        try {
            $this->db->select('current_count');
            $this->db->from('userident_count_g'.$game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* check user email */
    
    function check_user_email($game_id, $email)
    {
        try {
            $this->db->select('COUNT(*) as ECount');
            $this->db->from('user_list_g'.$game_id);
            $this->db->where("email", $email);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
    /* fetch all user */

    function fetch_user($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* fetch all user */

    function fetch_player($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id);
            $this->db->where("role_id", 5)->or_where("role_id", '4,5,');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
    /* fetch single user */

    function fetch_one_user($game_id, $id)
    {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id);
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
        /* fetch single user */

    function fetch_user_ident($game_id, $id)
    {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id);
            $this->db->where('userident', $id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    

    /* fetch user from rank_knowledge */

    function fetch_is_user_present_knowledge($game_id, $userident)
    {
        try {
            $this->db->select('COUNT(*) AS is_present');
            $this->db->from('rank_knowledge_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert user in rank_knowledge */

    public function insert_in_know_rank($data, $game_id)
    {
        try {
            return ($this->db->insert('rank_knowledge_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* fetch user from rank_sale */

    function fetch_is_user_present_sales($game_id, $userident)
    {
        try {
            $this->db->select('COUNT(*) AS is_present');
            $this->db->from('rank_sale_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* finsert user in rank_sale */

    public function insert_in_rank_table_sales($data, $game_id)
    {
        try {
            return ($this->db->insert('rank_sale_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* fetch user from rank_scoreboard */

    function fetch_is_user_present_scoreboard($game_id, $userident)
    {
        try {
            $this->db->select('COUNT(*) AS is_present');
            $this->db->from('rank_scoreboard_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert user in rank_scoreboard */

    public function insert_in_rank_table_scorebored($data, $game_id)
    {
        try {
            return ($this->db->insert('rank_scoreboard_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /**
     * Fetch user from rank_test_drive
     */
    function fetch_is_user_present_test_drive($game_id, $userident)
    {
        try {
            $this->db->select('COUNT(*) AS is_present');
            $this->db->from('rank_test_drive_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

     /* fetch user from mission duration */

    function fetch_is_user_present_knowledge_badge($game_id, $userident)
    {
        try {
            $this->db->select('COUNT(*) AS is_present');
            $this->db->from('knowledge_badge_mapping_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

       /* fetch user from sale transaction */

    function fetch_is_user_present_sale_trans($userident)
    {
        try {
            $this->db->select('COUNT(*) AS is_present');
            $this->db->from('sale_transaction');
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

       /* fetch user from bud car test */

    function fetch_is_user_present_bud_car_test($game_id, $userident)
    {
        try {
            $this->db->select('COUNT(*) AS is_present');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert user in rank_test_drive */

    public function insert_in_rank_table_test_drive($data, $game_id)
    {
        try {
            return ($this->db->insert('rank_test_drive_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* insert user in mission duration */

    public function insert_in_badge_mapping($data, $game_id)
    {
        try {
            return ($this->db->insert('knowledge_badge_mapping_g' . $game_id, $data)) ? $this->db->insert_id() : false;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* fetch multiple user role */

    function fetch_multiple_user_role($game_id, $role_id1, $role_id2)
    {
        try {
            $this->db->select('*');
            $this->db->from('role_g' . $game_id);
            $role = array($role_id1, $role_id2);
            $this->db->where_in('role_id', $role);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* fetch single user role */

    function fetch_user_role($game_id, $role_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('role_g' . $game_id);
            $this->db->where('role_id', $role_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update user record */

    public function update_user_record($game_id, $userident, $data)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->update('user_list_g' . $game_id, $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* update userident count */

    public function update_userident_count($game_id, $data)
    {
        try {
            $this->db->update('userident_count_g' . $game_id, $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete user record */

    function delete_user_record($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $delete_status = $this->db->delete('user_list_g' . $game_id);
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

    /* delete user record from knowledge */

    function delete_user_from_knowledge($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('rank_knowledge_g' . $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete user record from rank */

    function delete_user_from_rank($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('rank_sale_g' . $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete user record from scoreboard */

    function delete_user_from_scoreboard($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('rank_scoreboard_g' . $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete user record from test_drive */

    function delete_user_from_test_drive($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('rank_test_drive_g' . $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

        /* delete user record from bud car test */

    function delete_user_from_bud_car_test($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('budget_car_test_g' . $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

                /* delete user record from sale transaction */

    function delete_user_from_sale_trans($userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('sale_transaction');
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
        /* delete user record from mission duration */

    function delete_user_from_mission_dur($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('mission_duration_g'. $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

            /* delete user record from question trans */

    function delete_user_from_question_trans($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('question_trans_g'. $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

            /* delete user record from quiz attempt */

    function delete_user_from_quiz_attempt($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('quiz_attempt_g'. $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

            /* delete user record from knowledge badge */

    function delete_user_from_badge_map($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('knowledge_badge_mapping_g'. $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

                /* delete user record from game transaction */

    function delete_user_from_game_trans($game_id, $userident)
    {
        try {
            $this->db->where('userident', $userident);
            $this->db->delete('game_trans_g'. $game_id);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* user report */

    function user_report($game_id, $userident)
    {
        try {
            $this->db->select('q.*, m.mission_step, g.description');
            $this->db->from('quiz_attempt_g' . $game_id . ' q');
            $this->db->join('mission_g' . $game_id . ' m', 'q.mission_id = m.mission_id');
            $this->db->join('grade_g' . $game_id . ' g', 'q.grade_id = g.grade_id');
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    
    /* Fetch User with budget */

    function fetch_user_with_budget($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id);
             $this->db->where("role_id", 5)->or_where("role_id", '4,5,');
            $this->db->group_by('first_name'); 
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
    
                /* get mission rank testdrive */

    public function get_rank_testdrive($game_id, $userident)
    {
        try {
            $this->db->select('*');
            $this->db->from('rank_test_drive_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

                 /* get mission rank sale */

    public function get_rank_sale($game_id, $userident)
    {
        try {
            $this->db->select('*');
            $this->db->from('rank_sale_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

                 /* get mission rank scoreboard */

    public function get_rank_scoreboard($game_id, $userident)
    {
        try {
            $this->db->select('*');
            $this->db->from('rank_scoreboard_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }
}

