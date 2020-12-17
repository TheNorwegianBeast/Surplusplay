<?php
$data = $_GET['data'];

 $game_id = 1;
        $user_email =$this->session->userdata('email');
        $txt_otp =$data;
        $result_user = $this->App_model->fetch_user_ident($game_id,$user_email);
        foreach ($result_user as $row_data) {
                $user_otp = $row_data->password_recover_otp;
                $otp_time = $row_data->otp_date_time;
                $time_stamp =  date('Y-m-d h:i:s');
                
                if($user_otp==$txt_otp)
                {
                     if($otp_time<$time_stamp)
                    {
                        echo 'expired';
                    }else{
                        echo 'matched';
                    }
                }
        }