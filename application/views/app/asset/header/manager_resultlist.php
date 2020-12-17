<div class="m-dash-logo">
    <a class="tooltips" href="<?php echo base_url(); ?>app_controller/Dashboard_manager/dash_manager">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/dash-logo.png" alt="" height="100%" width="100%"/>
        <span>Dashboard</span>
    </a>
</div>
<div class="m-menu-logo">
    <a class="tooltips" href="<?php echo base_url(); ?>app_controller/Manager_resultlist/manager_resultlist">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/resultlist-active.PNG" alt="" height="100%" width="100%"/>
        <span>Result List</span>
    </a>
</div>
<div class="m-user-logo">
    <a href="<?php echo base_url(); ?>app_controller/User_profile/manager_profile">
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/User_Icon.png" alt="" height="100%" width="100%"/>
    </a>
</div>
<div class="m-user-txt">
    <a class="tooltips-userprofile">
        <label><?php echo $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'); ?></label>
        <span>User-profile</span>
    </a>
</div>
<div class="m-logout-logo">
    <a href='<?php echo base_url(); ?>App/logout'>
        <img src="<?php echo base_url(); ?>application/views/app/asset/header/icons/logout_icon.png" alt="" height="100%" width="100%"/>
    </a>
</div>
