<!-- Porsche logo -->
<div class="porsche-logo">
    <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/porsche-logo.png" 
        alt="" height="100%" width="100%" />
</div>

<!-- Dashboard icon -->
<div class="m-dash-logo">
     <a class="tooltips" href="#">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/dash-logo.png"
            alt="" height="100%" width="100%" />
        <span>Dashboard</span>
    </a>
</div>

<!-- Video icon -->
<div class="m-play-logo">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/play.png" 
            alt="" height="100%" width="100%" />
</div>

<div class="mq-play-now">
    <label>Play Now!</label>
</div>

<!-- Menu icon -->
<div class="menu-logo">
    <a class="tooltips"><img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/chinese-bar.png" alt="" height="100%"
         width="100%" />
        <span>Result Lists</span>
    </a>
</div>

<!-- Location icon -->
<div class="m-location-logo">
    <a class="tooltips" href="#" style="text-decoration: none;">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/location-logo.png" 
            alt="" height="100%" width="100%" />
        <span>Map Level</span>
    </a>
</div>

<!-- User icon -->
<div class="m-user-logo">
    <a href="<?php echo base_url(); ?>app_controller/User_profile/user_profile">
    <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/User_Icon.png"
        alt="" height="100%" width="100%" />
    </a>
</div>

<!-- Logout icon -->
<div class="m-logout-logo">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/logout_icon.png" 
            alt="" height="100%" width="100%" />
</div>

<div class="m-user-name">
    <label><?php echo $this->session->userdata('first_name')." ".$this->session->userdata('last_name'); ?></label>
</div>


