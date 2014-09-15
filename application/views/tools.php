<?php $this->load->view('layout/header_head'); ?>
<?php $this->load->view('layout/header_body_default'); ?>

<div id="page-content">
    <div class="row">
        <div class="col-lg-6">
            <?php $this->load->view('components/panels/location_history_google_takeout_importer'); ?>
        </div>
        <div class="col-lg-6">
            <?php $this->load->view('components/panels/location_history_csv_importer'); ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/footer_default'); ?>
<?php $this->load->view('layout/footer_footer'); ?>