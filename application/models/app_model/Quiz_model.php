<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * fetch mission quiz by mission id
     */
    public function fetch_mission_quiz($game_id, $mission_id) {
        try {
            $this->db->select('*');
            $this->db->from('mission_g' . $game_id);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return FALSE;
        }
    }

    /*
     *   Fetch score Sumation 
     */

    public function sum_score($game_id, $trans_id, $userident) {
        try {
            $this->db->select('sum(answer_point)as collect_points');
            $this->db->from('question_trans_g' . $game_id);
            $this->db->where('trans_id', $trans_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /* check is user attempted quiz or not */

    public function is_quiz_attempted($game_id, $trans_id) {
        try {
            $this->db->select('count(*) AS is_answer_count');
            $this->db->from('question_trans_g' . $game_id);
            $this->db->where('trans_id', $trans_id);
            $this->db->where('given_answer !=', '');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*
     * Fetch Badges 
     */

    public function fetch_grade($game_id, $percentage, $is_attempt_flag) {
        try {
            $this->db->select('*');
            $this->db->from('grade_g' . $game_id);
            $this->db->where('from_percentage <=', $percentage);
            $this->db->where('to_percentage >= ', $percentage);
            $this->db->where('is_attempt', $is_attempt_flag);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   Insert In table attemps 
     */

    public function insert_attemps($trans_id, $game_id, $mission_id, $userident, $total_score_points, $percentage, $grade_id, $badge_image, $congrats_img, $is_attempt) {
        try {
            $insert_attemps = array(
                'trans_id' => $trans_id,
                'game_id' => $game_id,
                'mission_id' => $mission_id,
                'userident' => $userident,
                'total_score_points' => $total_score_points,
                'percentage' => $percentage,
                'grade_id' => $grade_id,
                'badge_image' => $badge_image,
                'congrats_img' => $congrats_img,
                'is_attempt' => $is_attempt
            );
            if ($this->db->insert('quiz_attempt_g' . $game_id, $insert_attemps)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   insert data in game quiz data in trnasaction table 
     */

    public function insert_quiz_game_trans($game_id, $mission_id, $game_trans_date, $trans_type, $userident) {
        try {
            $insert_attemps = array(
                'game_id' => $game_id,
                'mission_id' => $mission_id,
                'game_trans_date' => $game_trans_date,
                'trans_type' => $trans_type,
                'userident' => $userident,
                'is_new_noti' => 1
            );
            if ($this->db->insert('game_trans_g' . $game_id, $insert_attemps)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   fetch distinct quiz by user 
     */

    public function fetch_disctinct_quiz_by_user($game_id, $userident) {
        try {
            $this->db->select('distinct(mission_id) as mission_id');
            $this->db->from('quiz_attempt_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());

        }
    }

    /*
     *   Select Attempted mission last achieve Badge from attempts table 
     */

    public function fetch_attempted_mission_badge($game_id, $userident, $mission_id) {
        try {
            $this->db->select('*');
            $this->db->from('quiz_attempt_g' . $game_id);
            $this->db->where('userident', $userident);
            $this->db->where('mission_id', $mission_id);
            $this->db->Order_by('quiz_attmp_id', 'desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   Fetch Distinct course quiz count 
     */

    public function fetch_disctinct_quiz_attempt($game_id, $userident) {
        try {
            $this->db->select('count(distinct(mission_id)) as quiz_count');
          //  $this->db->distinct();
            $this->db->from('quiz_attempt_g' . $game_id);
            $this->db->where('userident', $userident);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   Fetch Knowledge Level Badges 
     */

    public function fetch_knowledge_avg_grade($game_id, $percentage, $is_attempt) {
        try {
            $this->db->select('*');
            $this->db->from('avg_know_grade_g' . $game_id);
            $this->db->where('game_id', $game_id);
            $this->db->where('avg_frm_percent <= ', $percentage);
            $this->db->where('avg_to_percent`>=', $percentage);
            $this->db->where('is_attempt', $is_attempt);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   Update knowledge badge mapping table 
     */

    public function check_user_exist_badge_mapping($game_id, $user) {
        try {
            $this->db->select('count(*) as user_exist_count');
            $this->db->from('knowledge_badge_mapping_g' . $game_id);
            $this->db->where('userident', $user);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   Update knowledge badge mapping table 
     */

    public function updateknowledgeBadgeMapping($game_id, $userident, $all_percentage, $grade, $grade_id, $badge_knowlevel_image, $badge_qz_img) {
        try {
            $this->db->where('userident', $userident);
            $update_mapping = array(
                'all_percentage' => $all_percentage,
                'grade' => $grade,
                'grade_id' => $grade_id,
                'badge_knowlevel_image' => $badge_knowlevel_image,
                'badge_qz_img' => $badge_qz_img
            );
            if ($this->db->update('knowledge_badge_mapping_g' . $game_id, $update_mapping)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   Insert in knowledge badge mapping table 
     */

    public function insert_knowledge_badge_mapping($game_id, $userident, $all_percentage, $grade, $grade_id, $badge_knowlevel_image, $badge_qz_img) {
        try {
            $insert_mapping = array(
                'game_id' => $game_id,
                'all_percentage' => $all_percentage,
                'grade' => $grade,
                'userident' => $userident,
                'grade_id' => $grade_id,
                'badge_knowlevel_image' => $badge_knowlevel_image,
                'badge_qz_img' => $badge_qz_img,
            );
            if ($this->db->insert('knowledge_badge_mapping_g' . $game_id, $insert_mapping)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
        }
    }

    /*
     *   fetch Question to show result 
     */

    function fetch_count_correct_incorrect($game_id, $trans_id, $status) {
        try {
            $this->db->select('count(*) AS counts');
            $this->db->from('question_trans_g' . $game_id);
            $this->db->where('trans_id', $trans_id);
            $this->db->where('answer_status', $status);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /*
     *   fetch Question to show result 
     */

    function fetch_ques_transaction_data($game_id, $trans_id, $mission_id, $userident, $status) {
        try {
            $this->db->select('*');
            $this->db->from('question_trans_g' . $game_id);
            $this->db->where('trans_id', $trans_id);
            $this->db->where('mission_id', $mission_id);
            $this->db->where('userident', $userident);
            $this->db->where('answer_status', $status);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /*
     *   fetch Question to show result  
     */

    function fetch_solved_question($game_id, $mission_id, $que_id, $chosen_option) {
        try {
            $this->db->select('question_label, ' . $chosen_option . ' AS givenanswer');
            $this->db->from('question_g' . $game_id . '_m' . $mission_id);
            $this->db->where('question_id', $que_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /*
     *   Select Question 
     */

    function fetch_question_by_id($game_id, $mission_id, $que_id) {
        try {
            $this->db->select('*');
            $this->db->from('question_g' . $game_id . '_m' . $mission_id);
            $this->db->where('question_id', $que_id);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /**
     *  fetch question
     */
    function fech_question($game_id, $mission_id) {
        try {
            $this->db->select('*');
            $this->db->from('question_g' . $game_id . '_m' . $mission_id);
            $this->db->where('mission_id', $mission_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /**
     *  Fetch last transaction counter number
     */
    function fetch_last_transc_count($game_id) {
        try {
            $this->db->select('trans_id');
            $this->db->from('quiz_trans_count_g' . $game_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }

    /**
     *  update last transaction counter number 
     */
    function update_transaction_count($game_id, $trans_id) {
        try {
            $data = array(
            'trans_id' => $trans_id
        );
            if ($this->db->update('quiz_trans_count_g' . $game_id, $data)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }
        
      
    /**
     * Insert in Question Transaction Table
     */
    function insert_score($trans_id, $game_id, $mission_id, $userident, $ques_trans_date, $question_no, $given_answer, $answer_status, $answer_point) {
        try {
            $insert_game_transc = array(
                'trans_id' => $trans_id,
                'game_id' => $game_id,
                'mission_id' => $mission_id,
                'userident' => $userident,
                'ques_trans_date' => $ques_trans_date,
                'question_no' => $question_no,
                'given_answer' => $given_answer,
                'answer_status' => $answer_status,
                'answer_point' => $answer_point
            );
            if ($this->db->insert('question_trans_g' . $game_id, $insert_game_transc)) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
           log_message('Error ', $e->getMessage());
        }
    }

	    /**
     *  Fetch knowlege grade data count
     */
    function fetch_badge_map_user_count($game_id, $user) {
        try {
            $this->db->select('count(*) as map_count');
            $this->db->from('knowledge_badge_mapping_g' . $game_id);
            $this->db->where('userident', $user);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
    }
    
     /**
     *  Fetch knowlege badge mapping 
     */
    function fetch_knowledge_badge_mapping($game_id, $user) {
        try {
            $this->db->select('*');
            $this->db->from('knowledge_badge_mapping_g' . $game_id);
            $this->db->where('userident', $user);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } catch (Exception $e) {
            log_message('SQL Error ', $e->getTraceAsString());
            return;
        }
	}
	
}

?>

