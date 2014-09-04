<?php $this->load->view('layout/header_head'); ?>
<?php $this->load->view('layout/header_body_default'); ?>

<div id="page-content">
    <div class="row">
        <div class="col-md-3">
            <?php $this->load->view('components/panels/sensors_location_type_gauge'); ?>
        </div>
        <div class="col-md-5">
            <?php $this->load->view('components/panels/macros'); ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/footer_default'); ?>
<?php $this->load->view('layout/footer_footer'); ?>