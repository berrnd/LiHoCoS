<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex">

        <meta name="description" content="Life and Home Controlling System">
        <meta name="author" content="Bernd Bestel (http://berrnd.de)">
        <link rel="shortcut icon" href="<?php echo img_url('lihocos_48x48.png'); ?>">

        <title><?php echo $title; ?> | LiHoCoS</title>

        <!-- Core CSS -->
        <?php echo css('bootstrap.min'); ?>
        <?php echo third_party_css('font-awesome/css/font-awesome.min'); ?>
        <?php echo third_party_css('google-font-open-sans/open-sans'); ?>
        <?php echo third_party_css('google-font-roboto/roboto'); ?>
        <?php echo css('lihocos'); ?>
        <?php echo css('sb-admin'); ?>

        <!-- Page-Level CSS -->
        <?php echo third_party_css('jquery-ui/themes/metro/jquery-ui'); ?>
        <?php echo third_party_css('jtable/themes/metro/blue/jtable.min'); ?>
        <?php echo third_party_css('toastr/toastr.min'); ?>
        <?php echo third_party_css('bootstrap-daterangepicker/daterangepicker-bs3'); ?>
        <?php echo third_party_css('leaflet/leaflet'); ?>
        <?php echo third_party_css('leaflet-label/leaflet.label'); ?>
        <?php echo third_party_css('bootstrap-callout/bootstrap-callout'); ?>
        <?php echo third_party_css('c3js/c3'); ?>

        <!-- Core JS -->
        <?php echo third_party_js('jquery/jquery-1.10.2.min'); ?>
        <?php echo js('bootstrap.min'); ?>
        <?php echo third_party_js('metisMenu/jquery.metisMenu'); ?>
        <?php echo js('sb-admin'); ?>

        <!-- Page-Level JS -->
        <?php echo third_party_js('jquery-ui/jquery-ui.min'); ?>
        <?php echo third_party_js('jtable/jquery.jtable.min'); ?>
        <?php echo third_party_js('jquery-form/jquery.form.min'); ?>
        <?php echo third_party_js('moment-js/moment-with-langs.min'); ?>
        <?php echo third_party_js('toastr/toastr.min'); ?>
        <?php echo third_party_js('jquery-deserialize/jquery.deserialize.min'); ?>
        <?php echo third_party_js('jQuery-fn-serializeObject/jquery-serialize-object'); ?>
        <?php echo third_party_js('bootstrap-daterangepicker/daterangepicker'); ?>
        <?php echo third_party_js('leaflet/leaflet'); ?>
        <?php echo third_party_js('leaflet-label/leaflet.label'); ?>
        <?php echo third_party_js('c3js/d3.min'); ?>
        <?php echo third_party_js('c3js/c3.min'); ?>

        <?php if (!lang('jTable_lang') === 'en') : ?>
            <?php echo third_party_js('jtable/localization/jquery.jtable.' . lang('jTable_lang')); ?>
        <?php endif; ?>

        <?php $this->load->view('js/lihocos-js-header'); ?>

    </head>
