<?php

$data = $_GET['data'];
$arr = explode("~", $data);
 $game_id = $this->session->userdata('game_id');
$user=$arr[0];
$mission_id = $arr[1];
$location_img = "";
$fetch_last_mission_status = "b";
$video = "a";
$cqz_count = 0;
$fetch_last_mission_id = 0;


/* Fetch Last Mission Id */

$res_last_mission = $this->Dashboard_model->fetch_last_completed_mission($user, $game_id);
foreach ($res_last_mission as $row_last_mission) {
    $fetch_last_mission_id = $row_last_mission->mission_id;
    $fetch_last_mission_status = $row_last_mission->budget_status;
}

/* Fetch mission count */
$inventory = $this->Dashboard_model->count_mission($game_id);
foreach ($inventory as $value) {
    $cqz_count++;
}



$res_quiz = $this->Dashboard_model->fetch_mission($mission_id, $game_id);
foreach ($res_quiz as $row_quiz) {
    $location_img = $row_quiz->city_image;
}


$res_date_time = $this->Dashboard_model->fetch_completion_time($user,$mission_id, $game_id);
foreach ($res_date_time as $row_date_time) {
    $date_time = $row_date_time->last_completion_day;
}


$dummy = "A";
$res = $dummy . "~" . $date_time . "~" . $fetch_last_mission_status . "~" . $game_id . "~" . $mission_id . "~" . $location_img;
echo($res);
?>