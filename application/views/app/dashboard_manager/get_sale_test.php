<?php
$data = $_GET['data'];
$arr = explode("~", $data);

  $model = $arr[0];
  $car_type = $arr[1];
  $curr_date = $arr[2];
  $user = $arr[3];
?>


<div class="section-count1">
    <div class="sale-row1">
        <div class="heading1"><span class="heading1-txt">Sale amount</span></div>
        <div class="heading2"><span class="heading2-txt">Quantity</span></div>
    </div>
    <div class="sale-row2">
        <div class="heading3"><span class="heading3-txt" id="sale_amt">
            <?php
            $res_tot_sum_sale = $this->Dashboard_manager_model->get_tot_sale_user_car($car_type, $user, $model);
            $total_sale_amt2=0;
            $total_sale_qty2=0;
            foreach ($res_tot_sum_sale as $row_tot_sum_sale) {
            $total_sale_amt2 = $total_sale_amt2 + $row_tot_sum_sale->aarspremie;
            $total_sale_qty2 = $total_sale_qty2 + $row_tot_sum_sale->quantity;
            }
            echo $total_sale_amt = number_format($total_sale_amt2);
            ?>
                </span></div>
            <div class="heading4"><span class="heading4-txt" id="quantity_amt">
            <?php        
            echo $total_sale_qty = number_format($total_sale_qty2);
            ?>
            </span></div>
    </div>
    <div class="sale-row3">
        <div class="heading5"><span class="heading5-txt" id="income_amt">
            <?php
            $res_tot_sum_sale_per_day = $this->Dashboard_manager_model->get_tot_sale_user_car_per_day($car_type, $user, $model,$curr_date);
            $total_sale_amt2_per_day=0;
            foreach ($res_tot_sum_sale_per_day as $row_tot_sum_sale_per_day) {
            $total_sale_amt2_per_day = $total_sale_amt2_per_day + $row_tot_sum_sale_per_day->aarspremie;
            }
            echo $total_sale_amt_per_day = number_format($total_sale_amt2_per_day);
            ?>
            
            
            </span></div>
        <div class="heading6"><span class="heading6-txt">Income this months</span></div>
    </div>
</div>

<div class="section-count-c2">
    <div class="sale-row1">
        <div class="heading1"><span class="heading1-txt">Test Drive</span></div>
        <div class="heading2"><span class="heading2-txt">Quantity</span></div>
    </div>
    <div class="sale-row2">
        <div class="heading3"><span class="heading3-txt" id="test_amt">
             <?php
            $res_tot_sum_test = $this->Dashboard_manager_model->get_tot_test_user_car($car_type, $user, $model);
            $total_test_amt2=0;
            $total_test_qty2=0;
            foreach ($res_tot_sum_test as $row_tot_sum_test) {
            $total_test_amt2 = $total_test_amt2 + $row_tot_sum_test->aarspremie;
            $total_test_qty2 = $total_test_qty2 + $row_tot_sum_test->quantity;
            }
            echo $total_test_amt = number_format($total_test_amt2);
            ?>
            
            
            
            </span></div>
        <div class="heading4"><span class="heading4-txt" id="quantity_test">
            <?php        
            echo $total_test_qty = number_format($total_test_qty2);
            ?></span></div>
    </div>
    <div class="sale-row3">
        <div class="heading5"><span class="heading5-txt" id="income_test">
             <?php
            $res_tot_sum_test_per_day = $this->Dashboard_manager_model->get_tot_test_user_car_per_day($car_type, $user, $model,$curr_date);
            $total_test_amt2_per_day=0;
            foreach ($res_tot_sum_test_per_day as $row_tot_sum_test_per_day) {
            $total_test_amt2_per_day = $total_test_amt2_per_day + $row_tot_sum_test_per_day->aarspremie;
            }
            echo $total_test_amt_per_day = number_format($total_test_amt2_per_day);
            ?>
            </span></div>
        <div class="heading6"><span class="heading6-txt">Income this months</span></div>
    </div>
</div>