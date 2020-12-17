
<!-- Porsche logo -->
<div class="porsche-logo">
    <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/porsche-logo.png" alt="" height="100%"
         width="100%" />
</div>
<!--
<div class="mission-complete">
    <label id="MissionCompleted"></label>
</div>-->

<div id="mission-span" class="mission-complete">
    <label id="MissionCompleted">Mission Completed</label>
    <span onclick="closeError();" id="error-close">&times;</span>
</div>

<!-- Dashboard icon -->
<div class="m-dash-logo">
    <a  class="tooltips" href="<?php echo base_url(); ?>app_controller/Dashboard_manager/dash_manager">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/dash-logo.png" alt="" height="100%"
             width="100%" />
        <span>Dashboard</span>
    </a>
</div>

<div class="m-play-logo">
    <a href="<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/play-active.png" alt="" height="100%"
             width="100%" />
    </a>
</div>

<!-- Video icon -->
<div class="m-video-logo">
    <img id="v-list-open" style="display:block;" onclick="videoList();" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/video-icon.png" alt="" height="100%"
         width="100%" />
    <img id="v-list-close" onclick="closeVlist();" style="display: none;"
         src="<?php echo base_url(); ?>application/views/app/asset/header/icons/Cross_icon.PNG" alt="" height="100%"
         width="100%" />
</div>
<div class="video-dropdown" id="video-list">
    <div class="v-drop-row">
        <div class="v-name">
            <label>No Video</label>
        </div>
    </div>
<!--    <div class="v-drop-row">
        <div class="v-name">
            <label>The video name</label>
        </div>
    </div>-->

</div>
<!-- Menu icon -->
<div class="m-menu-logo">
    <a class="tooltips" class="test-link" href="<?php echo base_url(); ?>app_controller/Manager_resultlist/manager_resultlist">
        <img  src="<?php echo base_url(); ?>application/views/app/asset/header/icons/chinese-bar.png"
              height="100%" width="100%" />
        <span>Result Lists</span>
    </a>
</div>


<!-- Location icon -->
<div class="m-location-logo">
    <a class="tooltips" href="<?php echo base_url(); ?>app_controller/Map_nav/last_mission">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/location-logo.png" height="100%" width="100%" />
        <span>Map Level</span>
    </a>
</div>

<!-- User icon -->
<div class="m-user-logo">
    <a href="<?php echo base_url(); ?>app_controller/User_profile/manager_profile">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/User_Icon.png" alt="" height="100%"
             width="100%" />
    </a>
</div>

<!-- Logout icon -->
<div class="m-logout-logo">
    <img onclick="openLogout();" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/logout_icon.png" alt="" height="100%"
         width="100%" />
</div>

<div class="m-user-name">
    <label><?php echo $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'); ?></label>
</div>

<div class="mu-play-now">
    <label>Play Now!</label>
</div>

<div class="logout-alert" id="alert-logout">
    <label class="alert-msg">Do you want to Logout ?</label>
    <a href='<?php echo base_url(); ?>App/logout'>
        <button class="logout-ok">OK</button>
    </a>
    <button onclick="closeLogout();" class="logout-cncl">Cancel</button>
</div>