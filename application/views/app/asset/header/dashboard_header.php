
<!-- Porsche logo -->
<div class="porsche-logo">
    <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/porsche-logo.png" alt="" height="100%"
         width="100%" />
</div>

<div id="mission-span" class="mission-complete">
    <label id="MissionCompleted"></label>
    <span onclick="closeError();" id="error-close">&times;</span>
</div>


<!-- Dashboard icon -->
<div class="dash-logo">
    <a class="tooltips" href="<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/dashboard-active.png" alt="" height="100%"
             width="100%" />
        <span>Dashboard</span>
    </a>
</div>

<!-- Video icon -->
<div class="video-logo">
    <img id="v-list-open" style="display:block;" onclick="videoList();" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/video-icon.png" alt="" height="100%"
         width="100%" />
    <img id="v-list-close" onclick="closeVlist();" style="display: none;"
         src="<?php echo base_url(); ?>application/views/app/asset/header/icons/Cross_icon.PNG" alt="" height="100%"
         width="100%" />
</div>
<div class="video-dropdown" id="video-list" >
    <div class="v-drop-row">
        <div class="v-name">
            <label>No Video</label>
        </div>
    </div>
</div>
<!-- Menu icon -->
<div class="menu-logo">
    <img id="menu-icon" onclick="openList();"
         src="<?php echo base_url(); ?>application/views/app/asset/header/icons/chinese-bar.png" alt="" height="100%"
         width="100%" />
    <img id="menu-close" onclick="closeList();"
         src="<?php echo base_url(); ?>application/views/app/asset/header/icons/Cross_icon.PNG" alt="" height="100%"
         width="100%" />
</div>
<!-- Dropdown list of result -->
<div class="drop-down" id="dropdown-list">
    <a class="test-link" href="<?php echo base_url(); ?>app_controller/Resultlist/resultlist_test_drive">
        <div class="list-test-div">
            <div class="test-result-l">
                <label class="dropdown-text">Test drive</label>
            </div>
            <div class="test-result-img">
                <img class="test-off" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/test-off.png" />
                <img class="test-on" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/test-on.png" />
            </div>
        </div>
    </a>

    <a href="<?php echo base_url(); ?>app_controller/Resultlist/resultlist_sale">
        <div class="list-sales-div">
            <div class="sales-result-l">
                <label class="dropdown-text">Sales</label>
            </div>
            <div class="sales-result-img">
                <img class="sale-off" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/sale-off.png" />
                <img class="sale-on" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/sale-on.png" />
            </div>
        </div>
    </a>

    <a href="<?php echo base_url(); ?>app_controller/Resultlist/resultlist_knowledge">
        <div class="list-know-div">
            <div class="know-result-l">
                <label class="dropdown-text">Knowledge</label>
            </div>
            <div class="know-result-img">
                <img class="know-off" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/know-off.png" />
                <img class="know-on" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/know-on.png" />
            </div>
        </div>
    </a>

    <a href="<?php echo base_url(); ?>app_controller/Resultlist/resultlist_scoreboard">
        <div class="list-score-div">
            <div class="score-result-l">
                <label class="dropdown-text">Scoreboard</label>
            </div>
            <div class="score-result-img">
                <img class="score-off" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/score-off.png" />
                <img class="score-on" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/score-on.png" />
            </div>
        </div>
    </a>

</div>

<!-- Location icon -->
<div class="location-logo">
    <a class="tooltips" href="<?php echo base_url(); ?>app_controller/Map_nav/last_mission">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/location-logo.png" alt="" height="100%"
             width="100%" />
        <span>Map Level</span>
    </a>
</a>
</div>

<!-- User icon -->
<div class="user-logo">
    <a href="<?php echo base_url(); ?>app_controller/User_profile/user_profile">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/User_Icon.png" alt="" height="100%"
             width="100%" />
    </a>
</div>

<!-- Logout icon -->
<div class="logout-logo">
    <img onclick="openLogout();" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/logout_icon.png" alt="" height="100%"
         width="100%" />
</div>

<div class="user-name">
    <label><?php echo $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'); ?></label>
</div>

<div class="logout-alert" id="alert-logout">
    <label class="alert-msg">Do you want to Logout ?</label>
    <a href='<?php echo base_url(); ?>App/logout'>
        <button class="logout-ok">OK</button>
    </a>
    <button onclick="closeLogout();" class="logout-cncl">Cancel</button>
</div>
