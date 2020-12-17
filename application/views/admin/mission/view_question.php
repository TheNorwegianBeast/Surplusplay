<!DOCTYPE html>
<html>

<head>
    <?php require_once(APPPATH . 'views/admin/asset/common/common-cdns.php'); ?>
    <link href="<?php echo base_url(); ?>application/views/admin/asset/css/view_question.css" rel="stylesheet"
        type="text/css" />
</head>

      <body onload="spinner();">
    <div class="spinner-wrapper" id="spin_div">
           <div class="spinner"></div>
       </div>
    <div class="grid-container">
        <div class="menu-icon" onclick="addToggleEffect();">
            <i class="fas fa-bars header__menu"></i>
        </div>
        <!--header starts-->
     <?php require_once (APPPATH . 'views/admin/asset/common/common_header.php'); ?>
        <!--header ends-->
        <?php require_once APPPATH . 'views/admin/asset/common/dialoge.php'; ?>
        <?php require_once (APPPATH . 'views/admin/asset/common/common-sidenav.php'); ?>
        <!--This is the main section beneath header admin and dropdowns starts-->
        <?php
        foreach ($question as $row) {
            ?>
        <main class="main">
            <div class="main-header">
                <div class="main-header__heading" id="Vgameid">
                    <h5 id="viewGameId"><i class="fa fa-inbox t_th"></i> &nbsp;&nbsp; View Question</h5>
                </div>
                <div class="main-header__updates" id="headerUpdates" style="">
                    <ul>
                        <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home" style="color: #000;"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                href="<?php echo base_url(); ?>admin_controller/Mission/get_mission">&nbsp;&nbsp;Missions</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame"
                                href="<?php echo base_url(); ?>admin_controller/Mission/manage_question">&nbsp;&nbsp;Question</a>
                        </li>
                        <li class="homelist" style="font-size:13px;"><a id="listGame" href="#">&nbsp;&nbsp;View
                                Question</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-cards">
                <div class="card">
                    <div class="CardIn" style="">
                        <div class="div_row">
                            <h6 class="h4txt">View Question</h6>
                        </div><br />

                        <div id="form-elements1">
                            <table id="mytabledata">

                                <tr>
                                    <td>
                                        <div>
                                            <label id="UseridentLabel">Question</label>
                                            <textarea class="txtquestion"
                                                disabled=""><?php echo $row->question_label; ?></textarea>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label id="lblLname">Option A</label>
                                            <input type="text" class="option-input" disabled=""
                                                value="<?php echo $row->option_a; ?>">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label id="UseridentLabel">Option B</label>
                                            <input type="text" class="option-input" disabled=""
                                                value="<?php echo $row->option_b; ?>">

                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label id="UseridentLabel">Option C</label>
                                            <input type="text" class="option-input" disabled=""
                                                value="<?php echo $row->option_c; ?>">

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <label id="UseridentLabel">Option D</label>
                                            <input type="text" class="option-input" disabled=""
                                                value="<?php echo $row->option_d; ?>">

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="divpassword">
                                            <label id="lblPass">Correct Option</label>
                                            <input type="text" class="option-input" disabled=""
                                                value="<?php echo $row->correct_answer; ?>">

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <label id="lblLname">Answer Explanation</label>
                                            <textarea class="ans-explaination"
                                                disabled=""><?php echo $row->answer_explaination; ?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <a
                                                href="<?php echo base_url(); ?>admin_controller/Mission/manage_question"><input
                                                    type="submit" class="back-button" name="btn_cancel" value="Back"></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--This is the main section beneath header admin and dropdowns ends-->
    </div>
    <script>
function spinner()
{
    var spin = document.getElementById('spin_div');
    spin.style.display = 'none';
}
        </script>
</body>

</html>
