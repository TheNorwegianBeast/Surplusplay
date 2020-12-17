
<!-- Porsche logo -->
<div class="porsche-logo">
    <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/porsche-logo.png" alt="" height="100%"
         width="100%" />
</div>

<!-- Dashboard icon -->
<div class="dash-logo">
    <a class="tooltips" href="#" style="text-decoration: none;">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/dash-logo.png" alt="" height="100%"
             width="100%" />
        <span>Dashboard</span>
    </a>
</div>


<!-- Menu icon -->
<div class="menu-logo">
    <img 
        src="<?php echo base_url(); ?>application/views/app/asset/header/icons/chinese-bar.png" alt="" height="100%"
        width="100%" />
</div>


<!-- Location icon -->
<div class="location-logo">
    <a class="tooltips">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/location-logo.png" alt="" height="100%"
             width="100%" />
        <span>Map Level</span>
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
    <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/logout_icon.png" alt="" height="100%"
         width="100%" />
</div>

<div class="user-name">
    <label><?php echo $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'); ?></label>
</div>

