<?php

$user = $this->session->userdata('user');
$game_id = $this->session->userdata('game_id');
$location_img = "is_null";
$location_name = "is_null";
$first_time_video = "is_null";
$mission_status = "is_null";
$mission_status2 = "is_null";
$budget_id = "is_null";
$allow_day = 0;
$date_start = "is_null";
$fetch_last_mission_status = "is_null";
$video = "is_null";
$cqz_count = 0;
$fetch_last_mission_id = 0;
$mission_id=1;
$avaibility="is_null";
/* Fetch mission count */
$inventory = $this->Dashboard_model->count_mission($game_id);
foreach ($inventory as $value) {
    $cqz_count++;
}

/* Fetch Last Mission Id */

$res_last_mission = $this->Dashboard_model->fetch_last_completed_mission($user, $game_id);
foreach ($res_last_mission as $row_last_mission) {
    $fetch_last_mission_id = $row_last_mission->mission_id;
    $fetch_last_mission_status = $row_last_mission->budget_status;
}


if ($fetch_last_mission_id == 1) {
    $mission_id = $fetch_last_mission_id;
}

if ($fetch_last_mission_id > 0 && $fetch_last_mission_status == "completed") {
    /* Fetch Last Mission Id */
    $res_last_mission = $this->Dashboard_model->fetch_last_completed_mission($user, $game_id);
    foreach ($res_last_mission as $row_last_mission) {
        $fetch_last_mission_id = $row_last_mission->mission_id;
    }

    /* Fetch Next mission */
    $res_next_mission = $this->Dashboard_model->fetch_last_completed_mission($user, $game_id);
    foreach ($res_next_mission as $row_next_mission) {
        $mission_id = $row_next_mission->mission_id + 1;
    }
}
//echo $mission_id;
if ($fetch_last_mission_id == $cqz_count) {
    $mission_id = $cqz_count;
    $avaibility="AllCompleted";
}

if ($mission_id > $cqz_count) {
  echo  $mission_id = $cqz_count;
    $avaibility="AllCompleted";
}

$check_start_status2 = $this->Dashboard_model->fetch_start_mission_status_test($user, $game_id,$mission_id);
 if (empty($check_start_status2)) {
     
     if($mission_id>1){
         $mission_id=$mission_id-1;
         $avaibility="NoNextMission";
     }
 }

$check_start_status2 = $this->Dashboard_model->fetch_start_mission_status_test($user, $game_id,$mission_id);
foreach ($check_start_status2 as $row_check_mission2) {
    
     if($avaibility != "AllCompleted" && $avaibility != "NoNextMission")
    {
        $avaibility=1;
    }

$check_start_status = $this->Dashboard_model->fetch_start_mission_status($user, $game_id);
foreach ($check_start_status as $row_check_mission) {

    $budget_id = $row_check_mission->budget_id;
    if ($row_check_mission->budget_status === "assigned") {
//        /* Check condition  for video */
        $first_time_video = "yes";
        $mission_status2 = "started";
        $date_start = gmdate("Y-m-d H:i:s");

        $update_status = array(
            'car_budget_status' => $mission_status2,
            'testdrive_budget_status' => $mission_status2,
            'mission_start_datetime' => $date_start,
        );
        $check_start_status = $this->Dashboard_model->update_budget_status($update_status, $budget_id, $game_id);
        $update_status2 = array(
            'start_datetime' => $date_start,
            'budget_status' => $mission_status2,
        );
        $check_start_status3 = $this->Dashboard_model->update_budget_duration($update_status2, $budget_id, $game_id);
        break;
    }

    if ($row_check_mission->budget_status === "started") {
        $first_time_video = "no";
        $mission_status = "started";
        $date_start = $row_check_mission->start_datetime;
        break;
    }

    if ($row_check_mission->budget_status === "completed") {
        $date_start = $row_check_mission->start_datetime;
    }
}

$check_day = $this->Dashboard_model->fetch_budget_status($budget_id, $game_id);
foreach ($check_day as $check_day_budget) {
    $allow_day = $check_day_budget->day_to_complete;
}


if ($first_time_video == "yes") {
    $video_res = $this->Dashboard_model->fetch_video($mission_id, $game_id);
    foreach ($video_res as $video_row) {
        $video = trim($video_row->know_file_name);
    }
}

$res_quiz = $this->Dashboard_model->fetch_mission($mission_id, $game_id);
foreach ($res_quiz as $row_quiz) {
    $location_img = $row_quiz->city_image;
    $location_name = $row_quiz->city_name;
}

$location_name = trim($mission_id . "/" . $cqz_count . "-" . $location_name);

}
$dummy = "is_null";
$res = $avaibility . "~" .$dummy . "~" . $video . "~" . $fetch_last_mission_status . "~" . $game_id . "~" . $mission_id . "~" . $location_img . "~" . $date_start . "~" . $first_time_video . "~" . $allow_day;
echo($res);


?>