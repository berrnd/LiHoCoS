<?php $this->load->view('layout/header_head'); ?>
<?php $this->load->view('layout/header_body_default'); ?>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <?php $this->load->view('components/panels/blinds'); ?>
            <?php $this->load->view('components/panels/lights'); ?>
            <?php $this->load->view('components/panels/sensors'); ?>
            <?php $this->load->view('components/panels/windows'); ?>
            <?php $this->load->view('components/panels/doors'); ?>
            <?php $this->load->view('components/panels/computers'); ?>
        </div>
        <div class="col-lg-12">
            <?php $this->load->view('components/panels/cameras'); ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/footer_default'); ?>
<?php $this->load->view('layout/footer_footer'); ?>