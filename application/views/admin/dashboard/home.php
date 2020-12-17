<!DOCTYPE html>
<html>

    <head>
        <?php require_once APPPATH . 'views/admin/asset/common/common-cdns.php'; ?>
        <link href="<?php echo base_url(); ?>application/views/admin/asset/css/home.css" rel="stylesheet" type="text/css" />
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
            <?php require_once APPPATH . 'views/admin/asset/common/common_header.php'; ?>
            <!--header ends-->
            <?php require_once APPPATH . 'views/admin/asset/common/dialoge.php'; ?>
            <?php require_once APPPATH . 'views/admin/asset/common/common-sidenav.php'; ?>
            <!--This is the main section beneath header admin and dropdowns starts-->
            <main class="main">
                <div class="main-header">
                    <div class="main-header__heading">
                        <h5 class="view-game"><i class="fa fa-dashboard"></i> &nbsp;&nbsp;Dashboard</h5>
                    </div>
                    <div class="main-header-updates">
                        <ul>
                            <li class="homelist"><a href="<?php echo base_url(); ?>Admin/home"><i class="fa fa-home"
                                                                                                  style="color: #000;"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="div-row">
                        <h6 class="h4txt">Surplusplay Dashboard</h6>
                    </div><br /><br>

                    <div class="form-div-logo">
                        <div class="img-div">
                            <img class="porshe-logo"
                                 src="<?php echo base_url(); ?>application/views/admin/asset/image/porsche-logo.jpg"
                                 alt="Porsche Logo">
                        </div>
                    </div>
                </div>
            </main>
            <!--main section ends-->
        </div>
        <script>
            function spinner() {
                var spin = document.getElementById('spin_div');
                spin.style.display = 'none';
            }
        </script>
    </body>

</html>
