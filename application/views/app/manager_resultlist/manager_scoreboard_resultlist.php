<?php
foreach ($scoreboard_report as $scores) {
    ?>
    <div class="tbl-row">
        <div class="tbl-user">
            <label><?php echo $scores->rank_no. '. '.$scores->first_name;?></label>
        </div>
        <div class="data-one">
            <label>
                <?php
                if ($scores->mission1 == 0) {
                    echo '';
                } else {
                    echo $scores->mission1;
                }
                ?>
            </label>
        </div>
        <div class="data-two">
            <label>
                <?php
                if ($scores->mission2 == 0) {
                    echo '';
                } else {
                    echo $scores->mission2;
                }
                ?>
            </label>
        </div>
        <div class="data-three">
            <label>
                <?php
                if ($scores->mission3 == 0) {
                    echo '';
                } else {
                    echo $scores->mission3;
                }
                ?>
            </label>
        </div>
        <div class="data-four">
            <label>
                <?php
                if ($scores->mission4 == 0) {
                    echo '';
                } else {
                    echo $scores->mission4;
                }
                ?>
            </label>
        </div>
        <div class="data-five">
            <label>
                <?php
                if ($scores->mission5 == 0) {
                    echo '';
                } else {
                    echo $scores->mission5;
                }
                ?>
            </label>
        </div>
        <div class="data-six">
            <label>
                <?php
                if ($scores->mission6 == 0) {
                    echo '';
                } else {
                    echo $scores->mission6;
                }
                ?>
            </label>
        </div>
        <div class="data-seven">
            <label>
                <?php
                if ($scores->mission7 == 0) {
                    echo '';
                } else {
                    echo $scores->mission7;
                }
                ?>
            </label>
        </div>
        <div class="data-eight">
            <label>
                <?php
                if ($scores->mission8 == 0) {
                    echo '';
                } else {
                    echo $scores->mission8;
                }
                ?>
            </label>
        </div>
        <div class="data-nine">
            <label>
                <?php
                if ($scores->mission9 == 0) {
                    echo '';
                } else {
                    echo $scores->mission9;
                }
                ?>
            </label>
        </div>
        <div class="data-ten">
            <label>
                <?php
                if ($scores->mission10 == 0) {
                    echo '';
                } else {
                    echo $scores->mission10;
                }
                ?>
            </label>
        </div>
        <div class="data-eleven">
            <label>
                <?php
                if ($scores->mission11 == 0) {
                    echo '';
                } else {
                    echo $scores->mission11;
                }
                ?>
            </label>
        </div>
        <div class="data-twelve">
            <label>
                <?php
                if ($scores->mission12 == 0) {
                    echo '';
                } else {
                    echo $scores->mission12;
                }
                ?>
            </label>
        </div>

    </div>
<?php } ?>