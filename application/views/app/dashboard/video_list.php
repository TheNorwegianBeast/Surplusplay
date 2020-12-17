<?php

$mission_id = $_GET['m'];
$game_id = $this->session->userdata('game_id');
$mission_name="";


$videos = $this->Dashboard_model->fetch_videos($game_id,$mission_id);
foreach ($videos as $value) {
     $video = $value->know_file_name;
     
     
     $mission = $this->Dashboard_model->fetch_mission($value->mission_id, $game_id);
    foreach ($mission as $value2) {
     $mission_name = "Video ".$value2->city_name;
    }
//     $ui_name="Mission-".$value->mission_id;
?>


 <div class="v-drop-row">
        <div class="v-name">
            <label id="<?php echo $video ?>" onclick="selectVideo(this.id);"><?php echo $mission_name; ?></label>
        </div>
    </div>
<?php } ?>