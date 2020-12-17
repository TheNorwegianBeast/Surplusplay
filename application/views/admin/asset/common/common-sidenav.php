<!--sidenav starts-->
<aside class="sidenav" id="sidebar">
    <div class="sidenav__close-icon" id="sidenavClose" onclick="removeToggleEffect();">
        <i class="fas fa-times sidenav__brand-close"></i>
    </div>
    <div class="sidebar_header">
        <center>
            <img class="sidenav_porsche_logo"
                 src="<?php echo base_url(); ?>application/views/admin/asset/image/logo.jpg" width="170px;"
                 height="90px;">
        </center>
    </div>
    <!--unordered lists elements on sidenav-->
    <ul id="accordion" class="accordion">
        <li>
            <div class="link"><i class="fa fa-home"></i>Home<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="list01"><a href="<?php echo base_url(); ?>Admin/home">&nbsp;Dashboard</a></li>
            </ul>
        </li>
        <li>
            <div class="link"><i class="fa fa-gamepad" style="font-size:20px;margin-top: -2px;"></i> Game<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="list02"><a href="<?php echo base_url(); ?>admin_controller/Game/manage_game">&nbsp;Manage Game</a></li>
            </ul>
        </li>
        <li>
            <div class="link"><i class="fa fa-signal" style="font-size:20px;margin-top: -5px;"></i>Level<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="list03"><a href="<?php echo base_url();?>admin_controller/Level/add_level">&nbsp;Add Level</a></li>
                <li class="list04"><a href="<?php echo base_url();?>admin_controller/Level/get_level">&nbsp;Manage Level</a></li>
            </ul>
        </li>
        <li>
            <div class="link"><i class="fa fa-flag"></i>Mission<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                  <!--<li class="list05"><a href="<?php // echo base_url();?>admin_controller/Mission/add_mission">&nbsp;Add Mission</a></li>-->
                <li class="list06"><a href="<?php echo base_url();?>admin_controller/Mission/get_mission">&nbsp;Manage Mission</a></li>
            </ul>
        </li>

        <li>
            <div class="link"><i class="fa fa-user-circle"></i>User<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="list07"><a href="<?php echo base_url();?>admin_controller/User/add_user">&nbsp;Add User</a></li>
                <li class="list08"><a href="<?php echo base_url();?>admin_controller/User/manage_user">&nbsp;Manage User</a></li>
            </ul>
        </li>

        <li>
            <div class="link"><i class="fa fa-bell"></i>Notification<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="list09"><a href="<?php echo base_url();?>admin_controller/Notification/add_inteval_notify">&nbsp;Interval Notification</a></li>
                <li class="list10"><a href="<?php echo base_url();?>admin_controller/Notification/add_activity_notify">&nbsp;Activity Notification</a></li>
            </ul>
        </li>

        <li>
            <div class="link"><i class="fa fa-shopping-cart"></i>Inventory<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="list11"><a href="<?php echo base_url(); ?>admin_controller/Pricelist/inventory_price_list">&nbsp;Price List</a></li>
                <li class="list12"><a href="<?php echo base_url(); ?>admin_controller/Inventory/manage_inventory">&nbsp;Inventory</a></li>
            </ul>
        </li>
        
         <li>
            <div class="link"><i class="fas fa-user-tie"></i>Manage Profile<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="list13"><a href="<?php echo base_url(); ?>Admin/password">&nbsp;Password</a></li>
                <li class="list14"><a href="<?php echo base_url(); ?>Admin/profile">&nbsp;Profile</a></li>
            </ul>
        </li>
        <li>
            <div class="link" style="color: #090d10; pointer-events: none;"></div>
            <ul class="submenu" style="pointer-events: none;">
            </ul>
        </li>

    </ul>
</aside>
<!--sidenav ends-->
