<?php

$data = $_GET['data'];
$arr = explode("~", $data);

$user = $this->session->userdata('user');
$game_id = $this->session->userdata('game_id');
$mission_id = 1;
$updated_time = $arr[3];
$last_completed_time = $arr[4];
$user_testdrive_quantity = 0;
$user_car_registration_quantity = 0;
$test_drive_prog = 0;
$car_registration_prog = 0;
$user_budget_car_reg = 0;
$user_budget_test_drive = 0;
$final_percentage = 0;
$user_budget_testdrive_duration = "";
$user_car_reg_duration = "";
$cqz_count = 0;
$fetch_last_mission_id = 0;
$fetch_last_mission_status="";
$mission_compl_status="is_null";
//sleep(1);
if(is_numeric($mission_id))
{

///* Start Logic For progress bar Test drive and Car Registration, completed mission */

    /* Fetch mission count */
$inventory = $this->Dashboard_model->count_mission($game_id);
foreach ($inventory as $value) {
    $cqz_count++;
}
    
    
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
    //print_r($res_next_mission);
    foreach ($res_next_mission as $row_next_mission) {
        $mission_id = $row_next_mission->mission_id + 1;
    }
}
//echo $mission_id;
if ($fetch_last_mission_id == $cqz_count) {
    $mission_id = $cqz_count;
  $mission_compl_status="AllComplete";
}



$check_start_status2 = $this->Dashboard_model->fetch_start_mission_status_test($user, $game_id,$mission_id);
 if (empty($check_start_status2)) {
     
     if($mission_id>1){
         $mission_id=$mission_id-1;
        $mission_compl_status="AllComplete";
     }
 }

/* fetch Assigned  Test Drive and Car Sales Registration for the current mission */

$res_user_budget = $this->Dashboard_model->fetch_assign_budget($game_id, $mission_id, $user);
foreach ($res_user_budget as $row_user_budget) {
    $user_budget_car_reg = $row_user_budget->quantity_car_regi;
    $user_budget_test_drive = $row_user_budget->quantity_test_drive;
    $user_car_reg_duration = $row_user_budget->car_reg_duration;
    $user_budget_testdrive_duration = $row_user_budget->test_drive_duration;
}


/* fetch totoal for Test Sales Transaction */
$res_sale_test_sum_qty = $this->Dashboard_model->fetch_user_sale_test_sumQty($game_id, $mission_id, $user);
foreach ($res_sale_test_sum_qty as $row_sale_test_sum_qty) {
    $user_testdrive_quantity = $row_sale_test_sum_qty->test_qty;
}

if ($user_testdrive_quantity == NULL && $user_testdrive_quantity == 0) {
    $user_testdrive_quantity = 0;
} else {
    $user_testdrive_quantity;
}

/* update Test completion status */
if ($user_budget_test_drive <= $user_testdrive_quantity) {
    $status = "completed";
    if ($user_budget_testdrive_duration == "") {
        $time = $updated_time;

        try {
            $pieces = explode(" ", $time);
            $string = $pieces[0];
            $int_day = intval(preg_replace('/[^0-9]+/', '', $string), 10);

            $string = $pieces[1];
            $int_hr = intval(preg_replace('/[^0-9]+/', '', $string), 10);

            $string = $pieces[2];
            $int_min = intval(preg_replace('/[^0-9]+/', '', $string), 10);

            $string = $pieces[3];
            $int_sec = intval(preg_replace('/[^0-9]+/', '', $string), 10);

            $int_day = $int_day * 86400;
            $int_hr = $int_hr * 3600;
            $int_min = $int_min * 60;

            $total = $int_day + $int_hr + $int_min + $int_sec;
            $date = gmdate("Y-m-d H:i:s");

            $update_status = array(
                'testdrive_budget_complete_datetime' => $date,
                'testdrive_budget_status' => $status,
                'test_drive_duration' => $total,
                'testdrive_budget_complete_duration' => $updated_time,
            );
            $db_dashboard = $this->Dashboard_model->update_test_budget_status($update_status, $mission_id, $game_id, $user);
        } catch (Exception $ex) {
            error_log("Update Tast status error. " . $ex->getMessage());
        }
    }
}

/* fetch total qty for Car Registration for current mission Transaction */

$res_user_test_sum_qty = $this->Dashboard_model->fetch_user_sale_car_sum_qty($game_id, $mission_id, $user);
foreach ($res_user_test_sum_qty as $row_user_test_sum_qty) {
    $user_car_registration_quantity = $row_user_test_sum_qty->sale_car_qty;
}



if ($user_car_registration_quantity == NULL && $user_car_registration_quantity == 0) {
    $user_car_registration_quantity = 0;
} else {
    $user_car_registration_quantity;
}
/* update Car Registration completion status */
if ($user_budget_car_reg <= $user_car_registration_quantity) {
    $status_car = "completed";

    if ($user_car_reg_duration == "") {

        try {
            $time = $updated_time;
            $pieces = explode(" ", $time);
            $string = $pieces[0];
            $int_day = intval(preg_replace('/[^0-9]+/', '', $string), 10);

            $string = $pieces[1];
            $int_hr = intval(preg_replace('/[^0-9]+/', '', $string), 10);

            $string = $pieces[2];
            $int_min = intval(preg_replace('/[^0-9]+/', '', $string), 10);

            $string = $pieces[3];
            $int_sec = intval(preg_replace('/[^0-9]+/', '', $string), 10);

            $int_day = $int_day * 86400;
            $int_hr = $int_hr * 3600;
            $int_min = $int_min * 60;

            $total = $int_day + $int_hr + $int_min + $int_sec;
            $date = gmdate("Y-m-d H:i:s");

            $update_status = array(
                'car_budget_complete_datetime' => $date,
                'car_budget_status' => $status_car,
                'car_reg_duration' => $total,
                'car_budget_complete_duration' => $updated_time,
            );
            $db_dashboard = $this->Dashboard_model->update_car_budget_status($update_status, $mission_id, $game_id, $user);
        } catch (Exception $ex) {
            error_log("Update car status error. " . $ex->getMessage());
        }
    }
}

/* Calculate progress for Test Drive */
if ($user_budget_test_drive != 0) {
    $test_drive_prog = round(($user_testdrive_quantity / $user_budget_test_drive) * 100);
    if ($test_drive_prog > 100) {
        $test_drive_prog = 100;
    } else {
        $test_drive_prog;
    }
}

/* Calculate progress for Car Registration */
if ($user_budget_car_reg != 0) {
    $car_registration_prog = round(($user_car_registration_quantity / $user_budget_car_reg) * 100);
    if ($car_registration_prog > 100) {
        $car_registration_prog = 100;
    } else {
        $car_registration_prog;
    }
}

/* Calculate progress for Test Drive and Car Registration */
$final_percentage = round(($test_drive_prog + $car_registration_prog) / 2);
if ($final_percentage > 100) {
    $final_percentage = 100;
} else {
    $final_percentage;
}

/*  final mission status update */

$res_mission_final_status = $this->Dashboard_model->fetch_mission_completed($game_id, $mission_id, $user);
foreach ($res_mission_final_status as $row_mission_final_status) {
    $Mission_complete_game_id = $row_mission_final_status->game_id;
    $Mission_complete_mission_id = $row_mission_final_status->mission_id;
    $Mission_complete_userident = $row_mission_final_status->userident;
    $Mission_complete_TestD_status = $row_mission_final_status->testdrive_budget_status;
    $Mission_complete_CarReg_status = $row_mission_final_status->car_budget_status;
}


if ($Mission_complete_TestD_status == "completed" && $Mission_complete_CarReg_status == "completed") {
    $final_status = "completed";

    try {

        $date = gmdate("Y-m-d H:i:s");
        $time = $updated_time;
        $pieces = explode(" ", $time);
        $string = $pieces[0];
        $int_day = intval(preg_replace('/[^0-9]+/', '', $string), 10);

        $string = $pieces[1];
        $int_hr = intval(preg_replace('/[^0-9]+/', '', $string), 10);

        $string = $pieces[2];
        $int_min = intval(preg_replace('/[^0-9]+/', '', $string), 10);

        $string = $pieces[3];
        $int_sec = intval(preg_replace('/[^0-9]+/', '', $string), 10);

        $int_day = $int_day * 86400;
        $int_hr = $int_hr * 3600;
        $int_min = $int_min * 60;

        $total = $int_day + $int_hr + $int_min + $int_sec;
        /*  code for time calculation End */

        $update_status = array(
            'budget_status' => $final_status,
            'end_datetime' => $date,
            'spend_time_minutes' => $total,
            'last_completion_day' => $updated_time,
        );
        
        $res_update_final_mission_status = $this->Dashboard_model->update_mission_status($update_status, $mission_id, $game_id, $user);
    } catch (Exception $ex) {
        error_log("Update Final status error. " . $ex->getMessage());
    }
}

/* End Logic For Progress bar and complete mission */
?>

<div class="sales-div">

    <!-- Left side Progress Bar Start -->
    <svg class="left-outer-svg">
    <!--Sales outer ellipse-->
    <ellipse class="left-outer-ellipse"/>
    </svg>

    <svg id="left-svg-progress" style="" viewBox="0 0 36 36" class="circular-chart-left orange">
    <!-- Color combination for progress circle -->
    <defs>
    <radialGradient id="grad1" cx="50%" cy="50%" fx="50%" fy="50%">
    <stop offset="90%" stop-color="red" stop-opacity="1"/>
    <stop offset="100%" stop-color="white" stop-opacity="1"/>
    <stop offset="100%" stop-color="red" stop-opacity="1"/>
    </radialGradient>
    </defs>

    <!--Background circle for progress circle-->
    <path class="bg-circle"
          d="M18 2.0845
          a 20.9155 15.9155 0 0 1 0 31.831
          a 20.9155 15.9155 0 0 1 0 -31.831"
          />
    <!-- Sales progress path -->
    <path class="progress-path" stroke="url('#grad1')"
          stroke-dasharray="<?php echo $car_registration_prog * 1.16; ?>, 100" transform="scale(-1,-1)"
          stroke-linecap="round"
          d="M18 2.0845
          a 20.9155 15.9155 0 0 1 0 31.831
          a 20.9155 15.9155 0 0 1 0 -31.831"
          />

    <!-- Percentage for Sales -->
    <text class="left-percentage" x="50%" y="55%">
    <?php echo $car_registration_prog; ?>%
    </text>

    </svg>

    <!-- Progress bar label -->
    <text id="sale-progress-label">Sales</text>
    <!--Sales progress bar end here-->
</div>


<div class="mission-div">

    <!--Mission progress bar-->
    <svg class="middle-outer-svg">
    <!-- Outer ellipse for mission progress -->
    <ellipse class="middle-outer-ellipse"/>
    </svg>

    <!-- Viewbox for Mission -->
    <svg id="middle-svg-progress" viewBox="0 0 36 36" class="circular-chart_middle orange">

    <!-- Background circle for Mission -->
    <path class="bg-circle"
          d="M19 2.0845
          a 20.9155 15.9155 0 0 1 0 31.831
          a 20.9155 15.9155 0 0 1 0 -31.831"
          />
    <!-- Mission progress circle path -->
    <path class="progress-path" stroke="url('#grad1')"
          stroke-dasharray="<?php echo $final_percentage * 1.16; ?>, 100" transform="scale(-1,-1)"
          stroke-linecap="round"
          d="M17 2.0845
          a 20.9155 15.9155 0 0 1 0 31.831
          a 20.9155 15.9155 0 0 1 0 -31.831"
          />
    <!-- Dotted circle for mission circle -->
    <ellipse class="dotted-ellipse"/>
    <!-- Mission percentage -->
    <text class="middle-percent" x="55%" y="57%">
    <?php echo $final_percentage; ?>%
    </text>

    </svg>
    <input type="hidden" id="final_pro_bar" value="<?php echo $final_percentage; ?>">
    <!-- Progress bar label -->
    <text id="mission-progress-label">Mission</text>

    <!-- Mission Progress bar End here -->
</div>
<div class="test-div">

    <!-- Right progress bar start here -->
    <svg class="right-outer-svg">
    <!-- Test drive outer ellipse -->
    <ellipse class="right-outer-ellipse"/>
    </svg>

    <svg id="right-svg-progress" viewBox="0 0 36 36" class="circular-chart_right orange">
    <!--Test drive Background circle -->
    <path class="bg-circle"
          d="M18 2.0845
          a 20.9155 15.9155 0 0 1 0 31.831
          a 20.9155 15.9155 0 0 1 0 -31.831"
          />
    <!--Test drive progress circle -->
    <path class="progress-path" stroke="url('#grad1')"
          stroke-dasharray="<?php echo $test_drive_prog * 1.16; ?>, 100" stroke-linecap="round"
          transform="scale(-1,-1)"
          d="M18 2.0845
          a 20.9155 15.9155 0 0 1 0 31.831
          a 20.9155 15.9155 0 0 1 0 -31.831"
          />
    <!-- Test drive percentage -->
    <text class="right-percentage" x="50%" y="55%">
    <?php echo $test_drive_prog; ?>%
    </text>
    </svg>

    <!-- Progress bar label -->
    <text id="test-progress-label">Test drive</text>

</div>
<?php }else{
     echo 'Please try again';
}
?>
<input type="hidden" id="car_budget_qty" value="<?php echo $user_budget_car_reg; ?>">
<input type="hidden" id="test_budget_qty" value="<?php echo $user_budget_test_drive; ?>">
<input type="hidden" id="car_till_quantity" value="<?php echo $user_car_registration_quantity; ?>">
<input type="hidden" id="test_till_quantity" value="<?php echo $user_testdrive_quantity; ?>">
<input type="hidden" id="mission_compl_status" value="<?php echo $mission_compl_status; ?>">
<!-- Right Progress Bar End---------------->
