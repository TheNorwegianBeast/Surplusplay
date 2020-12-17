
<?php
foreach ($sales_report as $sales) {
    ?>
    <div class="tbl-row">
        <div class="tbl-user">
            <label><?php echo $sales->rank_no . '. ' . $sales->first_name; ?></label>
        </div>
        <div class="data-one">
            <label>
                <?php
                if ($sales->mission1 == 0) {
                    echo '';
                } else {
                    echo $sales->mission1;
                }
                ?>
            </label>
        </div>
        <div class="data-two">
            <label>
                <?php
                if ($sales->mission2 == 0) {
                    echo '';
                } else {
                    echo $sales->mission2;
                }
                ?>
            </label>
        </div>
        <div class="data-three">
            <label>
                <?php
                if ($sales->mission3 == 0) {
                    echo '';
                } else {
                    echo $sales->mission3;
                }
                ?>
            </label>
        </div>
        <div class="data-four">
            <label>
                <?php
                if ($sales->mission4 == 0) {
                    echo '';
                } else {
                    echo $sales->mission4;
                }
                ?>
            </label>
        </div>
        <div class="data-five">
            <label>
                <?php
                if ($sales->mission5 == 0) {
                    echo '';
                } else {
                    echo $sales->mission5;
                }
                ?>
            </label>
        </div>
        <div class="data-six">
            <label>
                <?php
                if ($sales->mission6 == 0) {
                    echo '';
                } else {
                    echo $sales->mission6;
                }
                ?>
            </label>
        </div>
        <div class="data-seven">
            <label>
                <?php
                if ($sales->mission7 == 0) {
                    echo '';
                } else {
                    echo $sales->mission7;
                }
                ?>
            </label>
        </div>
        <div class="data-eight">
            <label>
                <?php
                if ($sales->mission8 == 0) {
                    echo '';
                } else {
                    echo $sales->mission8;
                }
                ?>
            </label>
        </div>
        <div class="data-nine">
            <label>
                <?php
                if ($sales->mission9 == 0) {
                    echo '';
                } else {
                    echo $sales->mission9;
                }
                ?>
            </label>
        </div>
        <div class="data-ten">
            <label>
                <?php
                if ($sales->mission10 == 0) {
                    echo '';
                } else {
                    echo $sales->mission10;
                }
                ?>
            </label>
        </div>
        <div class="data-eleven">
            <label>
                <?php
                if ($sales->mission11 == 0) {
                    echo '';
                } else {
                    echo $sales->mission11;
                }
                ?>
            </label>
        </div>
        <div class="data-twelve">
            <label> 
                <?php
                if ($sales->mission12 == 0) {
                    echo '';
                } else {
                    echo $sales->mission12;
                }
                ?>
            </label>
        </div>

    </div>
<?php } ?>