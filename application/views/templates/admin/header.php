<body class="<?php echo (isset($body_class)) ? $body_class : '' ?> id="<?php echo (isset($body_id)) ? $body_id : '' ?>>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="<?php echo site_url('/admin') ?>">iShop Admin Panel</a>
                <div class="nav-collapse collapse">
                    <?php if($this->session->userdata( 'admin_user_name' )){ ?>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> 
                                <i class="icon-user"></i>
                                <?php echo $this->session->userdata( 'admin_user_name' ) ?> 
                                <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="#">Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="<?php echo site_url('/admin/home/logout') ?>">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php } ?>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span3" id="sidebar">
                <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                    <?php foreach (shop_admin_getLeftMenu() as $menu){ ?>
                    <li <?php echo ($selected_menu == $menu['url'] )? 'class="active"' : '' ?>>
                        <a href="<?php echo site_url($menu['url']) ?>"><i class="icon-chevron-right"></i> <?php echo $menu['title'] ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <!--/span-->
            <div class="span9" id="content">
                <div class="row-fluid">
                    <?php 
                    if(isset($messages)){
                        foreach ($messages as $message){
                    ?>
                    <div class="alert alert-<?php echo $message['type'] ?>">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $message['message'] ?>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>