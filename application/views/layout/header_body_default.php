<body data-page-id="<?php echo $pageId; ?>">

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only"><?php echo lang('Toggle navigation'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">LiHoCoS</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo current_user_display_name(); ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('/settings'); ?>"><i class="fa fa-gear fa-fw"></i> <?php echo lang('Settings'); ?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo lang('Logout'); ?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">

                <?php
                if (!isset($sidebar))
                    $sidebar = 'default';

                $this->load->view("components/menus/sidebar-$sidebar");
                ?>

            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><?php echo $title; ?>
                        <small>
                            <?php
                            if (!isset($subtitle))
                                $subtitle = '';

                            echo $subtitle;
                            ?>
                        </small>
                    </h1>
