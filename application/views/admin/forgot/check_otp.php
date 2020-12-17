<?php

$data = $_GET['data'];

$game_id = 1;
$admin_email = $this->session->userdata('email');
$txt_otp = $data;
$result_admin = $this->Admin_model->admin_fetch_otp($admin_email);
foreach ($result_admin as $row_data) {
    $admin_otp = $row_data->password_recover_otp;
    $otp_time = $row_data->otp_date_time . " ";
    $time_stamp = date('Y-m-d h:i:s');

    if ($admin_otp == $txt_otp) {
        if ($otp_time < $time_stamp) {
            echo 'expired';
        } else {
            echo 'matched';
        }
    }
}