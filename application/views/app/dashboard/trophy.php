

<?php
$game_id = $this->session->userdata('game_id');
$userident = $this->session->userdata('user');

$last_mission_id = $_GET['m'];
?>

<?php
$e = 0;
$s = 0;
for ($i = 1; $i <= 3; $i++) {
    if ($i == 1) {
        $s = 1;
        $e = 4;
    } elseif ($i == 2) {
        $s = 5;
        $e = 8;
    } elseif ($i = 3) {
        $s = 9;
        $e = 12;
    }
    ?>
    <div class="level-one">
        <?php
        for ($m = $s; $m <= $e; $m++) {
            ?>
            <div class="city-box">
                <?php
                $mission_status = '';
                $count_attempt = '';
                $badge_image = '';
                $city_name = '';
                $mission_id = $m;
                //  Mission completed status
                $data_mission_completed = $this->Dashboard_model->fetch_is_mission_complete($game_id, $mission_id, $userident);
                foreach ($data_mission_completed as $row_completed) {
                    $mission_status = $row_completed->budget_status;
                }

                //  Mission attempted count
                $data_attempted_mission = $this->Dashboard_model->fetch_attempted_mission($game_id, $mission_id, $userident);
                foreach ($data_attempted_mission as $row_attempted) {
                    $count_attempt = $row_attempted->mission_attempt_count;
                }

                //  Mission attempted badge
                $data_mission_badge = $this->Dashboard_model->fetch_attempted_mission_badge($game_id, $mission_id, $userident);
                foreach ($data_mission_badge as $row_badge) {
                    $badge_image = $row_badge->badge_image;
                }

                //  fetch mission by id 
                $data_mission_city = $this->Dashboard_model->fetch_mission($mission_id, $game_id);
                foreach ($data_mission_city as $row_city) {
                    $city_name = $row_city->city_name;
                }

                //  Mission id encryption for url 
                $enc_key = $this->encrypt->encode($m);
                if ($mission_id == $last_mission_id) {
                    switch ($mission_id) {
                        case ($mission_status != 'completed' && $count_attempt > 0) :
                            // "Mission status blank and attempted count >0 show in red color with car.";
                            ?>
                            <a href="<?php echo base_url(); ?>app_controller/Quiz/quiz/<?php echo $enc_key; ?>">
                                <div class="trophy-car">
                                    <div class="trophy-car-div">
                                        <img src="<?php echo base_url(); ?>application/views/asset/image/badge/<?php echo $badge_image; ?>" alt="" width="100%"
                                             height="100%" />
                                    </div>
                                </div>
                                <div class="trophy-label" style="background: #cc0000;">
                                    <text><?php echo $city_name; ?></text>
                                </div>
                            </a>
                            <?php
                            break;
                        case ( $mission_status != 'completed' && $count_attempt == 0) :
                            // "Mission status blank and attempted count ==0 show in red color with scrab car without link.";
                            ?>
                            <a href="<?php echo base_url(); ?>app_controller/Quiz/quiz/<?php echo $enc_key; ?>">
                                <div class="trophy-car">
                                    <div class="trophy-car-div">
                                        <img src="<?php echo base_url(); ?>application/views/asset/image/badge/scrab.png" alt="" width="100%"
                                             height="100%" />
                                    </div>
                                </div>
                                <div class="trophy-label" style="background: #cc0000;">
                                    <text><?php echo $city_name; ?></text>
                                </div>
                            </a>
                            <?php
                            break;
                        case ($mission_status == 'completed' && $count_attempt > 0):
                            // "Mission status completed and attempted count ==0 show in red color with car.";
                            ?>
                            <a href="<?php echo base_url(); ?>app_controller/Quiz/quiz/<?php echo $enc_key; ?>">
                                <div class="trophy-car">
                                    <div class="trophy-car-div">
                                        <img src="<?php echo base_url(); ?>application/views/asset/image/badge/<?php echo $badge_image; ?>" alt="" width="100%"
                                             height="100%" />
                                    </div>
                                </div>
                                <div class="trophy-label" style="background: #cc0000;">
                                    <text><?php echo $city_name; ?></text>
                                </div>
                            </a>

                            <?php
                            break;
                        case ( $mission_status == 'completed' && $count_attempt == 0):
                            // "Mission status completed and attempted count ==0 show in red color with scrab car.";
                            ?>
                            <a href="<?php echo base_url(); ?>app_controller/Quiz/quiz/<?php echo $enc_key; ?>">
                                <div class="trophy-car">
                                    <div class="trophy-car-div">
                                        <img src="<?php echo base_url(); ?>application/views/asset/image/badge/scrab.png" alt="" width="100%"
                                             height="100%" />
                                    </div>
                                </div>
                                <div class="trophy-label" style="background: #cc0000;">
                                    <text><?php echo $city_name; ?></text>
                                </div>
                            </a>
                            <?php
                            break;
                    }
                } else {
                    switch ($mission_id) {
                        case ($mission_status != 'completed' && $count_attempt > 0) :
                            // "Mission status blank and attempted count >0 show in gray color with car.";
                            ?>
                            <a href="<?php echo base_url(); ?>app_controller/Quiz/quiz/<?php echo $enc_key; ?>">
                                <div class="trophy-car">
                                    <div class="trophy-car-div">
                                        <img src="<?php echo base_url(); ?>application/views/asset/image/badge/<?php echo $badge_image; ?>" alt="" width="100%"
                                             height="100%" />
                                    </div>
                                </div>
                                <div class="trophy-label" style="background: #333333;">
                                    <text><?php echo $city_name; ?></text>
                                </div>
                            </a>
                            <?php
                            break;
                        case ($mission_status != 'completed' && $count_attempt == 0) :
                            //  "Mission status blank and attempted count ==0 show in gray color with scrab car without link.";
                            ?>
                            <div class="trophy-car">
                                <div class="trophy-car-div">
                                    <img src="<?php echo base_url(); ?>application/views/asset/image/badge/scrab.png" alt="" width="100%"
                                         height="100%" />
                                </div>
                            </div>
                            <div class="trophy-label" style="background: #333333;">
                                <text><?php echo $city_name; ?></text>
                            </div>
                            <?php
                            break;
                        case ($mission_status == 'completed' && $count_attempt > 0):
                            // "Mission status completed and attempted count ==0 show in gray color with car.";
                            ?>
                            <a href="<?php echo base_url(); ?>app_controller/Quiz/quiz/<?php echo $enc_key; ?>">
                                <div class="trophy-car">
                                    <div class="trophy-car-div">
                                        <img src="<?php echo base_url(); ?>application/views/asset/image/badge/<?php echo $badge_image; ?>" alt="" width="100%"
                                             height="100%" />
                                    </div>
                                </div>
                                <div class="trophy-label" style="background: #333333;">
                                    <text><?php echo $city_name; ?></text>
                                </div>
                            </a>
                            <?php
                            break;
                        case ($mission_status == 'completed' && $count_attempt == 0):
                            // "Mission status completed and attempted count ==0 show in gray color with scrab car.";
                            ?>
                            <a href="<?php echo base_url(); ?>app_controller/Quiz/quiz/<?php echo $enc_key; ?>">
                                <div class="trophy-car">
                                    <div class="trophy-car-div">
                                        <img src="<?php echo base_url(); ?>application/views/asset/image/badge/scrab.png" alt="" width="100%"
                                             height="100%" />
                                    </div>
                                </div>
                                <div class="trophy-label" style="background: #333333;">
                                    <text><?php echo $city_name; ?></text>
                                </div>
                            </a>
                            <?php
                            break;
                    }
                }
                ?>
            </div>
            <?php
        }
        ?>

    </div>
    <div class="level-gap"></div>
    <?php
}
?>
