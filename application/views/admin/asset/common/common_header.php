        <header class="header">
            <div id="admin-dropdown">
                <div class="dropdown" id="dropdown-lists">
                    <button id="dropdown_btn_1" onclick="adminDropdown();"
                        class="dropbtn"><?php echo $this->session->userdata('admin_nm'); ?>&nbsp;&nbsp;&nbsp;<span
                            class="fa fa-caret-down"></span></button>
                    <div id="myDropdown" class="dropdown-content">
                       
                         <a onclick="d_block();" style="cursor: pointer;"><i class="fas fa-power-off" style="font-size:18px; color: #cc0000; margin-left: 10px;"></i>&nbsp;&nbsp;&nbsp;Logout</a>
                    </div>
                </div>
                <?php 
                if ($this->session->userdata('profile_img') != '') {  ?>
 <a href="<?php echo base_url(); ?>Admin/profile"><img id="admin-logo" src="<?php echo base_url(); ?>application/views/admin/asset/image/profile_pic/<?php echo $this->session->userdata('profile_img');?>"
                    style="border-radius: 50%;height: 50px;width: 50px; cursor: pointer;"></a>
                <?php	} else {  ?>
 <a href="<?php echo base_url(); ?>Admin/profile"><img id="admin-logo" src="<?php echo base_url(); ?>application/views/admin/asset/image/profile_pic/admin_logo.jpg"
                    style="border-radius: 50%;height: 50px;width: 50px; cursor: pointer;"></a>
                <?php	    }
                ?>
               
            </div>
        </header>



