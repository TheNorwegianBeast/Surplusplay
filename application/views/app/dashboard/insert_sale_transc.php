<?php

$data = $_GET['data'];
$arr = explode("~", $data);
//print_r($arr);
$user = $arr[1];
$product_id_st = $arr[0];

$product_type_st = $arr[3];
$quantity_st = $arr[2];
$model_st = $arr[4];
$amount_st = $arr[5];
$year_st = $arr[6];
$txt_mission_id_st = $arr[7];
$car_type_st = $arr[8];
$car_test_st = $arr[10];
$car_model = $arr[9];



 $game_id = $this->session->userdata('game_id');

if ($car_test_st != "Test") {
    $registration_type = 1;
    $registration_type2 = "car registration";
} else {
    $registration_type = 2;
    $registration_type2 = "test drive";
}

$new_entry = 1;

$subscription_id = "SUB1002";
$time_stamp = gmdate("Y-m-d H:i:s");

$array = array(
    "userident" => $user,
    "sub_id" => $subscription_id,
    "product_id" => $product_id_st,
    "aarspremie" => $amount_st,
    "nysalg" => $car_type_st,
    "quantity" => $quantity_st,
    "dato_og_tid" => $time_stamp,
    "car_year" => $year_st,
    "reg_type" => $registration_type,
    "product_from" => $product_type_st,
    "game_id" => $game_id,
    "mission_id" => $txt_mission_id_st,
    "car_model" => $car_model
);
//$res_insert = $db_dashboard->insert_sale($user, $subscription_id, $product_id_st, $amount_st, $car_type_st, $quantity_st, $time_stamp, $year_st, $registration_type, $product_type_st, $game_id, $txt_mission_id_st, $car_model);

$insert = $this->Dashboard_model->insert_sale($array);
if ($insert > 0) {
    
    

$array_game = array(
    "game_id" => $game_id,
    "mission_id" => $txt_mission_id_st,
    "game_trans_date" => $time_stamp,
    "trans_type" => $registration_type2,
    "userident" => $user,
    "is_new_noti" => $new_entry,
);
$res_insert_game_trans = $this->Dashboard_model->insert_sale_game_transaction($array_game,$game_id);
//                redirect('');
    echo 'inserted';
} else {
    echo "Data not inserted";
}


?>