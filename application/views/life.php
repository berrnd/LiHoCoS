<?php $this->load->view('layout/header_head'); ?>
<?php $this->load->view('layout/header_body_default'); ?>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <?php $this->load->view('components/panels/location_history_map'); ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/footer_default'); ?>
<?php $this->load->view('layout/footer_footer'); ?>