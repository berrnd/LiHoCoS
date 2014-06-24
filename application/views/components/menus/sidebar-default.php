<ul class="nav" id="side-menu">
    <li class="page-id-dashboard">
        <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo lang('Dashboard'); ?></a>
    </li>
    <li class="page-id-home">
        <a href="<?php echo base_url('home'); ?>"><i class="fa fa-home fa-fw"></i> <?php echo lang('Home'); ?></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="#"><i class="fa fa-desktop fa-fw"></i> <?php echo lang('Reporting'); ?></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="<?php echo base_url('home/sensor_history'); ?>"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo lang('Sensor History'); ?></a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="page-id-life">
        <a href="<?php echo base_url('life'); ?>"><i class="fa fa-eye fa-fw"></i> <?php echo lang('Life'); ?></a>
    </li>
</ul>
<!-- /#side-menu -->