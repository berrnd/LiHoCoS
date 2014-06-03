<?php $this->load->view('layout/header_head'); ?>
<?php $this->load->view('layout/header_body_default'); ?>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <?php $this->load->view('components/panels/sensors_temperature_chart'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php $this->load->view('components/panels/sensors_humidity_chart'); ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/footer_default'); ?>
<?php $this->load->view('layout/footer_footer'); ?>