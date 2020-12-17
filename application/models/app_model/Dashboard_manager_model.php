<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_manager_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* user sales transaction */

    function fetch_sales_trans_by_user($game_id) {
        try {
            $this->db->select('st.userident, u.first_name, u.last_name, st.trans_type');
            $this->db->from('game_trans_g' . $game_id . ' st');
            $this->db->join('user_list_g' . $game_id . ' u', 'st.userident = u.userident');
            $this->db->order_by('st.game_trans_id', 'DESC');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* user on top rank */

    function fetch_top_rank_user($game_id) {
        try {
            $this->db->select('tr.userident, rank_no, mission_completion_count, first_name, last_name');
            $this->db->from('rank_scoreboard_g' . $game_id . ' tr');
            $this->db->join('user_list_g' . $game_id . ' u', 'tr.userident = u.userident');
            $this->db->where('mission_completion_count >', 0);
            $this->db->order_by('rank_no', 'ASC');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* fetch count */

    function fetch_not_count($game_id) {
        try {
            $this->db->select('count(*) AS not_count');
            $this->db->from('game_trans_g' . $game_id);
            $this->db->where('is_new_noti', 1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* update user record */

    public function update_notify($game_id, $data) {
        try {
            $this->db->update('game_trans_g' . $game_id, $data);
            return (bool) ($this->db->affected_rows() > 0);
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* fetch scoreboard */

    function fetch_by_scoreboard($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_scoreboard_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* fetch sale */

    function fetch_by_sale($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_sale_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* fetch testdrive */

    function fetch_by_testdrive($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_test_drive_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* fetch knowledge */

    function fetch_by_knowledge($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_knowledge_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Fetch last attempted mission */

    function fetch_last_completed_mission($userident, $game_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('userident', $userident);
            $this->db->where('game_id', $game_id);
            $this->db->where('budget_status', 'completed');
            $this->db->order_by('mission_dur_id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Fetch  Course Quiz id from tbl_course_quizz */

    public function count_mission($game_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return False;
        }
    }
    /**
     *  Fetch Car Model 
     */
    function fetch_car_model($game_id) {
        try {
            $this->db->select('car_model');
            $this->db->from('pricelist_g' . $game_id);
            $this->db->group_by('car_model');
            $query1 = $this->db->get_compiled_select();
            $this->db->select('car_model');
            $this->db->from('inventory_g' . $game_id);
            $this->db->group_by('car_model');
            $query2 = $this->db->get_compiled_select();
            $query = $this->db->query($query1 . " UNION " . $query2);
            return $query->result();
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }
   


  
    /* Fetch last attempted mission */

    function fetch_current_mission_rank_score_by_id($game_id, $user_id) {
        try {
            $this->db->select('*');
            $this->db->from('rank_scoreboard_g' . $game_id);
            $this->db->where('userident', $user_id);
            $this->db->where('game_id', $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Fetch completed mission details by id */

    function fetch_comple_mission_id_by_name($mission_id, $game_id, $user_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_duration_g' . $game_id);
            $this->db->where('userident', $user_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('budget_status', 'completed');
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* quantity per mission from Sales Transaction for Car Regitration */

    function fetch_user_sale_car_sum_qty($game_id, $mission_id, $user_id, $type) {
        try {
            $this->db->select('sum(quantity) as sale_car_qty');
            $this->db->from('sale_transaction');
            $this->db->where('userident', $user_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('reg_type', $type);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Fetch Mission Attempted Count */

    function fetch_attempted_quiz_count($game_id, $userident, $mission_id) {
        try {
            $this->db->select('count(*) as attempted_count');
            $this->db->from('quiz_attempt_g' . $game_id);
            $this->db->where('userident', $userident);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Select Last attempted quiz by player */

    function fetch_last_attempted_quiz($game_id, $userident, $mission_id) {
        try {
            $this->db->select('*');
            $this->db->from('quiz_attempt_g' . $game_id);
            $this->db->where('userident', $userident);
            $this->db->where('mission_id', $mission_id);
            $this->db->order_by('quiz_attmp_id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* fetch Question to show result */

    function fetch_count_correct_answer($game_id, $trans_id, $mission_id) {
        try {
            $this->db->select('COUNT(*) AS answer_count');
            $this->db->from('question_trans_g' . $game_id);
            $this->db->where('trans_id', $trans_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('answer_status', 'Correct');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* fetch Question to show result */

    function fetch_total_question_count($game_id, $mission_id) {
        try {
            $this->db->select('count(*) AS question_count');
            $this->db->from('question_g' . $game_id . '_m' . $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Fetch completed sale mission details by id */

    function fetch_comple_sale_mission_id($mission_id, $game_id, $user_id) {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('userident', $user_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('car_budget_status', 'completed');
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Fetch sum  budget for sales qunatity new */

    function sum_of_new_sale_qty($reg_type, $nysalg, $user, $mission_id) {
        try {
            $this->db->select('count(*) as sale_qty_new');
            $this->db->from('sale_transaction');
            $this->db->where('reg_type', $reg_type);
            $this->db->where('nysalg', $nysalg);
            $this->db->where('userident', $user);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* Fetch completed sale mission details by id */

    function fetch_comple_test_mission_id($mission_id, $game_id, $user_id) {
        try {
            $this->db->select('*');
            $this->db->from('budget_car_test_g' . $game_id);
            $this->db->where('userident', $user_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('testdrive_budget_status', 'completed');
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());

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
            log_message('Error ', $e->getMessage());
            return;
        }
    }
    
    
        /* Fetch User with budget */

    function fetch_user_with_budget($game_id)
    {
        try {
            $this->db->select('*');
            $this->db->from('user_list_g' . $game_id);
            $this->db->where("role_id", 5)->or_where("role_id", '4,5,')->or_where("role_id", '4,5');
            $this->db->group_by('first_name'); 
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    
     /* Fetch total sale and quantity */

    function get_tot_sale_user_car($type, $user, $model) {
        try {
            $this->db->select('*');
            $this->db->from('sale_transaction');
            if (($type == "all") && ($user == "all") && ($model == "all")) {
                $this->db->where('reg_type', "1");
            }else if (($type != "all") && ($user == "all") && ($model == "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '1');
                }else if ($type == "used") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '2');
                }
            }else if (($type != "all") && ($user == "all") && ($model != "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '1');
                    $this->db->where('car_model', $model);
                }else if ($type == "used") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '2');
                    $this->db->where('car_model', $model);
                }
            }else if (($type != "all") && ($user != "all") && ($model == "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '1');
                    $this->db->where('userident', $user);
                } else if ($type == "used") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '2');
                    $this->db->where('userident', $user);
                }
            }else if (($type != "all") && ($user != "all") && ($model != "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '1');
                    $this->db->where('userident', $user);
                    $this->db->where('car_model', $model);
                } else if ($type == "used") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '2');
                    $this->db->where('userident', $user);
                    $this->db->where('car_model', $model);
                }
            }else if (($type == "all") && ($user != "all") && ($model == "all")) {
                $this->db->where('reg_type', '1');
                $this->db->where('userident', $user);
            } else if (($type == "all") && ($user != "all") && ($model != "all")) {
                $this->db->where('reg_type', '1');
                $this->db->where('userident', $user);
                $this->db->where('car_model', $model);
            } else if (($type == "all") && ($user == "all") && ($model != "all")) {
                 $this->db->where('reg_type', '1');
                 $this->db->where('car_model', $model);
            }
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
            return;
        }
    }

    
         /* Fetch total sale per day */

    function get_tot_sale_user_car_per_day($type, $user, $model,$curr_date) {
        try {
            $this->db->select('*');
            $this->db->from('sale_transaction');
            if (($type == "all") && ($user == "all") && ($model == "all")) {
                $this->db->where('reg_type', "1");
                $this->db->like('dato_og_tid', $curr_date);
            }else if (($type != "all") && ($user == "all") && ($model == "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '1');
                    $this->db->like('dato_og_tid', $curr_date);
                }else if ($type == "used") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '2');
                    $this->db->like('dato_og_tid', $curr_date);
                }
            }else if (($type != "all") && ($user == "all") && ($model != "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '1');
                    $this->db->where('car_model', $model);
                    $this->db->like('dato_og_tid', $curr_date);
                }else if ($type == "used") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '2');
                    $this->db->where('car_model', $model);
                    $this->db->like('dato_og_tid', $curr_date);
                }
            }else if (($type != "all") && ($user != "all") && ($model == "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '1');
                    $this->db->where('userident', $user);
                    $this->db->like('dato_og_tid', $curr_date);
                } else if ($type == "used") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '2');
                    $this->db->where('userident', $user);
                    $this->db->like('dato_og_tid', $curr_date);
                }
            }else if (($type != "all") && ($user != "all") && ($model != "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '1');
                    $this->db->where('userident', $user);
                    $this->db->where('car_model', $model);
                    $this->db->like('dato_og_tid', $curr_date);
                } else if ($type == "used") {
                    $this->db->where('reg_type', '1');
                    $this->db->where('nysalg', '2');
                    $this->db->where('userident', $user);
                    $this->db->where('car_model', $model);
                    $this->db->like('dato_og_tid', $curr_date);
                }
            }else if (($type == "all") && ($user != "all") && ($model == "all")) {
                $this->db->where('reg_type', '1');
                $this->db->where('userident', $user);
                $this->db->like('dato_og_tid', $curr_date);
            } else if (($type == "all") && ($user != "all") && ($model != "all")) {
                $this->db->where('reg_type', '1');
                $this->db->where('userident', $user);
                $this->db->where('car_model', $model);
                $this->db->like('dato_og_tid', $curr_date);
            } else if (($type == "all") && ($user == "all") && ($model != "all")) {
                 $this->db->where('reg_type', '1');
                 $this->db->where('car_model', $model);
                 $this->db->like('dato_og_tid', $curr_date);
            }
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }
    
    
    
     /* Fetch total sale and quantity */

    function get_tot_test_user_car($type, $user, $model) {
        try {
            $this->db->select('*');
            $this->db->from('sale_transaction');
            if (($type == "all") && ($user == "all") && ($model == "all")) {
                $this->db->where('reg_type', "2");
            }else if (($type != "all") && ($user == "all") && ($model == "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '1');
                }else if ($type == "used") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '2');
                }
            }else if (($type != "all") && ($user == "all") && ($model != "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '1');
                    $this->db->where('car_model', $model);
                }else if ($type == "used") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '2');
                    $this->db->where('car_model', $model);
                }
            }else if (($type != "all") && ($user != "all") && ($model == "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '1');
                    $this->db->where('userident', $user);
                } else if ($type == "used") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '2');
                    $this->db->where('userident', $user);
                }
            }else if (($type != "all") && ($user != "all") && ($model != "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '1');
                    $this->db->where('userident', $user);
                    $this->db->where('car_model', $model);
                } else if ($type == "used") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '2');
                    $this->db->where('userident', $user);
                    $this->db->where('car_model', $model);
                }
            }else if (($type == "all") && ($user != "all") && ($model == "all")) {
                $this->db->where('reg_type', '2');
                $this->db->where('userident', $user);
            } else if (($type == "all") && ($user != "all") && ($model != "all")) {
                $this->db->where('reg_type', '2');
                $this->db->where('userident', $user);
                $this->db->where('car_model', $model);
            } else if (($type == "all") && ($user == "all") && ($model != "all")) {
                 $this->db->where('reg_type', '2');
                 $this->db->where('car_model', $model);
            }
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    
         /* Fetch total sale per day */

    function get_tot_test_user_car_per_day($type, $user, $model,$curr_date) {
        try {
            $this->db->select('*');
            $this->db->from('sale_transaction');
            if (($type == "all") && ($user == "all") && ($model == "all")) {
                $this->db->where('reg_type', "2");
                $this->db->like('dato_og_tid', $curr_date);
            }else if (($type != "all") && ($user == "all") && ($model == "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '1');
                    $this->db->like('dato_og_tid', $curr_date);
                }else if ($type == "used") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '2');
                    $this->db->like('dato_og_tid', $curr_date);
                }
            }else if (($type != "all") && ($user == "all") && ($model != "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '1');
                    $this->db->where('car_model', $model);
                    $this->db->like('dato_og_tid', $curr_date);
                }else if ($type == "used") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '2');
                    $this->db->where('car_model', $model);
                    $this->db->like('dato_og_tid', $curr_date);
                }
            }else if (($type != "all") && ($user != "all") && ($model == "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '1');
                    $this->db->where('userident', $user);
                    $this->db->like('dato_og_tid', $curr_date);
                } else if ($type == "used") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '2');
                    $this->db->where('userident', $user);
                    $this->db->like('dato_og_tid', $curr_date);
                }
            }else if (($type != "all") && ($user != "all") && ($model != "all")) {
                if ($type == "new") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '1');
                    $this->db->where('userident', $user);
                    $this->db->where('car_model', $model);
                    $this->db->like('dato_og_tid', $curr_date);
                } else if ($type == "used") {
                    $this->db->where('reg_type', '2');
                    $this->db->where('nysalg', '2');
                    $this->db->where('userident', $user);
                    $this->db->where('car_model', $model);
                    $this->db->like('dato_og_tid', $curr_date);
                }
            }else if (($type == "all") && ($user != "all") && ($model == "all")) {
                $this->db->where('reg_type', '2');
                $this->db->where('userident', $user);
                $this->db->like('dato_og_tid', $curr_date);
            } else if (($type == "all") && ($user != "all") && ($model != "all")) {
                $this->db->where('reg_type', '2');
                $this->db->where('userident', $user);
                $this->db->where('car_model', $model);
                $this->db->like('dato_og_tid', $curr_date);
            } else if (($type == "all") && ($user == "all") && ($model != "all")) {
                 $this->db->where('reg_type', '2');
                 $this->db->where('car_model', $model);
                 $this->db->like('dato_og_tid', $curr_date);
            }
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }
     
}
