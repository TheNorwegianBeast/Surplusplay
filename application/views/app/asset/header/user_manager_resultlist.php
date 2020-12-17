<div class="mp-dash-logo">
    <a class="tooltips" href="<?php echo base_url(); ?>app_controller/Dashboard_manager/dash_manager">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/dash-logo.png" alt="" height="100%" width="100%"/>
        <span>Dashboard</span>
    </a>
</div>
<div class="mp-menu-logo">
    <a class="tooltips" href="<?php echo base_url(); ?>app_controller/Manager_resultlist/manager_resultlist">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/resultlist-active.PNG" alt="" height="100%" width="100%" />
        <span>Result List</span>
    </a>
</div>
<div class="mp-play-logo">
    <a href="<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/play.png" alt="" height="100%" width="100%" />
    </a>
</div>
<div class="play-txt">
    <a class="tooltips tooltip-playnow" style="text-decoration: none;" href="<?php echo base_url(); ?>app_controller/Dashboard/dashboard_home">
        <label style="text-decoration: none; font-family: Flama-Basic; color: #000; cursor: pointer;">&nbsp;&nbsp;&nbsp;Play Now !</label>
       <span class="playnow-tooltip">Play Now !</span>
   </a>`
</div>
<div class="mp-user-logo">
    <a href="<?php echo base_url(); ?>app_controller/User_profile/manager_profile">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/User_Icon.png" alt="" height="100%" width="100%" />
    </a>
</div>
<div class="mp-user-txt"> 
    <label><?php echo $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'); ?></label>
</div>
<div class="mp-logout-logo">
    <img onclick="openLogout();" src="<?php echo base_url(); ?>application/views/app/asset/header/icons/logout_icon.png" alt="" height="100%" width="100%"/>
</div>

<div class="logout-alert" id="alert-logout">
    <label class="alert-msg">Do you want to Logout ?</label>
    <a href='<?php echo base_url(); ?>App/logout'>
        <button class="logout-ok">OK</button>
    </a>
    <button onclick="closeLogout();" class="logout-cncl">Cancel</button>
</div>
