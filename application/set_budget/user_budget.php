             <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
              <style>
.btn-report {
    background: #263544;
    padding: 10px 10px;
    border-radius: 5px;
    font-size: 18px;
    color: #fff;
    cursor: pointer;
    outline:none;
}
button:hover {
    background: #1b2926;
}
</style>

<?php
              $CI = & get_instance();
              $CI->load->model('Mission_model');
              $CI2 = & get_instance();
              $CI2->load->model('User_model');
              echo '<br><br>';
              echo '<br><br>';
              echo 'userident:  '.$userident;
              echo '<br><br>';
?>



<table align="center">
<thead>
    <tr>
        <th>Sr No.</th>
        <th>Mission</th>
        <th>City</th>
        <th>Budget</th>
        <th>Budget status</th>
        <th>Test Drive Ranking</th>
        <th>Sales Ranking</th>
        <th>Mission Ranking</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $serial_no = 1;
    for ($i = 1; $i <=12; $i++) {
        $enc_key = $this->encrypt->encode($i);
        $result = $CI->Mission_model->get_mission_by_id($game_id, $i);
        foreach ($result as $row2) { 
             $result2 = $CI->Mission_model->get_user_budget($game_id, $row2->mission_id, $userident);
            foreach ($result2 as $row3) { 
                ?>
        <tr>
            <td>&nbsp;<?php echo $serial_no; ?></td>
            <td>&nbsp;<?php echo 'Mission '.$i; ?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2->city_name; ?></td>
            <td>&nbsp;&nbsp;<?php 
            if ($row3->BCount == 1) {
                echo 'Assigned';
            } else {
                echo 'Not Assigned';
            }
            ?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php 
                 $result3 = $CI->Mission_model->get_mission_dur($game_id, $row2->mission_id, $userident);
            foreach ($result3 as $row4) {
                if ($row4->budget_status == 'assigned') {
                    echo '';
                } else {
                     echo $row4->budget_status; 
                }
            }

            ?>
            </td>
            <td>&nbsp;&nbsp;
                <?php 
                $result4 = $CI2->User_model->get_rank_testdrive($game_id, $userident);
                foreach ($result4 as $row5) {
                    $ms = 'mission'.$i; 
                    if ($row5->$ms == 0) {
                        echo '';
                    } else {
                        echo $row5->$ms; 
                    }
                    
                }
                ?></td>
            <td>&nbsp;&nbsp;<?php 
             $result5 = $CI2->User_model->get_rank_sale($game_id, $userident);
            foreach ($result5 as $row6) {
                $ms = 'mission'.$i; 
                if ($row6->$ms == 0) {
                        echo '';
                } else {
                    echo $row5->$ms; 
                }
            }
            ?></td>
            <td>&nbsp;&nbsp;<?php 
             $result6 = $CI2->User_model->get_rank_scoreboard($game_id, $userident);
            foreach ($result6 as $row7) {
                $ms = 'mission'.$i; 
                if ($row7->$ms == 0) {
                        echo '';
                } else {
                    echo $row5->$ms; 
                } 
            }
            ?></td>
            <td>&nbsp;&nbsp;
                <a href="<?php echo base_url(); ?>admin_controller/Mission/view_budget/<?php echo $enc_key; ?>">
                <button class="btn-report"><i class="fa fa-check-square-o" style="color: #c99c47;"></i>&nbsp;&nbsp;Set Budget</button></a>

        </td>
            </tr>
                    <?php 
                    $serial_no++;

            }
        }
    }
    ?>
</tbody>
</table>
