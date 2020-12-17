<?php
    $i = 1;
    $u_name = '';
    $m_id = 0;
    $current_level = 0;
    $CI = & get_instance();
    $CI->load->model('User_model');
    $CI2 = & get_instance();
    $CI2->load->model('Dashboard_manager_model');
    $CI3 = & get_instance();
    $CI3->load->model('Mission_model');
   $row4="";
   $current_city="";
   $current_mission="";
foreach ($score as $row) {
    $result = $CI->User_model->fetch_user_ident($game_id, $row->userident);
    
    foreach ($result as $row2) {
        
        $u_name = $row2->first_name. ' '.$row2->last_name;
        
        $result2 = $CI2->Dashboard_manager_model->fetch_last_completed_mission($row->userident, $game_id);
        if(!empty($result2))
        {
        foreach ($result2 as $row3) { 
            $m_id = $row3->mission_id;
            $result3 = $CI3->Mission_model->get_mission_by_id($game_id, $m_id + 1);
            
            foreach ($result3 as $row4) {
               $current_mission= $row4->mission_id;
               $current_city =$row4->city_name;
                if ($row4->mission_id <= 4) {
                    $current_level = 1;
                } else if ($row4->mission_id >= 5 && $row4->mission_id <= 8) {
                    $current_level = 2;
                } else {
                    $current_level = 3;
                }
                 }
                  }
                  }else{
                      $current_level = 1;
                      $current_mission=1;
                      $m_id=1;
                      $result4 = $CI3->Mission_model->get_mission_by_id($game_id, $m_id);
                      foreach ($result4 as $row5) { 
                           $current_city=$row5->city_name;
                      }
                     
                  }
                ?>

    <tr class="tbl-grey-row">
        <td class="active-data">
                <?php echo $row->rank_no;?>
        </td>
        <td class="active-data" name="<?php echo $row->userident;?>">
                <?php echo $u_name; ?>
        </td>

        <td class="active-data" name="<?php echo $current_city; ?>"><span class="txt-left"><?php echo $current_mission;?>
        </span>
                <?php echo $current_city;?>
        </td>
        <td class="active-data">
                <?php echo $current_level;?>
        </td>
        <td class="active-data tbl-data-eye">
            <div class="div-eye" id="id_sales">
                <a id="red_eye">
                <img id="alter_img<?php echo "R".$i; ?>" name="alter_img1" onclick="alterImage2();reply_click2(this.id);"
                    class="red-eye-onn" src="<?php echo base_url(); ?>application/views/app/asset/icon/red-eye-onn.png"
                    alt="" width="100%" height="100%">
                <img id="alter_img<?php echo "G".$i; ?>" class="red-eye-off"
                    src="<?php echo base_url(); ?>application/views/app/asset/icon/red-eye-off.png" alt="" width="100%"
                    height="100%" onclick="alterImage();reply_click(this.id);">
            </a>
            </div>
        </td>
    </tr>
                <?php
           
       
    }
    $i++;
}
?>
