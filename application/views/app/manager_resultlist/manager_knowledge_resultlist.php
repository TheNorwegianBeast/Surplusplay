<?php

foreach($report as $report_data) {
//    print_r($report_data);

?>

<div class="tbl-row">
    <div class="tbl-user">
        <label><?php echo $report_data->rank_no. '. '.$report_data->first_name;?></label>
    </div>
    <div class="data-one">
        <label><?php 
        if($report_data->mission1 == 0) {
            echo '';
        } else {
            echo $report_data->mission1;
        }
            ?></label>
    </div>
    <div class="data-two">
        <label><?php 
        if($report_data->mission2 == 0) {
            echo '';
        } else {
            echo $report_data->mission2;
        }
            ?></label>
    </div>
    <div class="data-three">
        <label><?php 
        if($report_data->mission3 == 0) {
            echo '';
        } else {
            echo $report_data->mission3;
        }
            ?></label>
    </div>
    <div class="data-four">
        <label><?php 
        if($report_data->mission4 == 0) {
            echo '';
        } else {
            echo $report_data->mission4;
        }
            ?></label>
    </div>
    <div class="data-five">
        <label><?php 
        if($report_data->mission5 == 0) {
            echo '';
        } else {
            echo $report_data->mission5;
        }
            ?></label>
    </div>
    <div class="data-six">
        <label><?php 
        if($report_data->mission6 == 0) {
            echo '';
        } else {
            echo $report_data->mission6;
        }
            ?></label>
    </div>
    <div class="data-seven">
        <label><?php 
        if($report_data->mission7 == 0) {
            echo '';
        } else {
            echo $report_data->mission7;
        }
            ?></label>
    </div>
    <div class="data-eight">
        <label><?php 
        if($report_data->mission8 == 0) {
            echo '';
        } else {
            echo $report_data->mission8;
        }
            ?></label>
    </div>
    <div class="data-nine">
        <label><?php 
        if($report_data->mission9 == 0) {
            echo '';
        } else {
            echo $report_data->mission9;
        }
            ?></label>
    </div>
    <div class="data-ten">
        <label><?php 
        if($report_data->mission10 == 0) {
            echo '';
        } else {
            echo $report_data->mission10;
        }
            ?></label>
    </div>
    <div class="data-eleven">
        <label><?php 
        if($report_data->mission11 == 0) {
            echo '';
        } else {
            echo $report_data->mission11;
        }
            ?></label>
    </div>
    <div class="data-twelve">
        <label><?php 
        if($report_data->mission12 == 0) {
            echo '';
        } else {
            echo $report_data->mission12;
        }
            ?></label>
    </div>

</div>

<?php
}
?>