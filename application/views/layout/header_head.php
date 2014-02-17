<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex">

        <meta name="description" content="Life and Home Controlling System">
        <meta name="author" content="Bernd Bestel (http://berrnd.de)">
        <link rel="shortcut icon" href="<?php echo img_url('lihocos.ico'); ?>">

        <title><?php echo $title; ?> | LiHoCoS</title>

        <!-- Core CSS -->
        <?php echo css('bootstrap.min'); ?>
        <?php echo third_party_css('font-awesome/css/font-awesome.min'); ?>
        <?php echo css('//fonts.googleapis.com/css?family=Open+Sans|Roboto'); ?>
        <?php echo css('lihocos'); ?>
        <?php echo css('sb-admin'); ?>

        <!-- Page-Level CSS -->
        <?php echo third_party_css('jquery-ui/themes/delta/jquery-ui'); ?>
        <?php echo third_party_css('jtable/themes/jqueryui/jtable_jqueryui.min'); ?>
        <?php echo third_party_css('toastr/toastr.min'); ?>
        <?php echo third_party_css('morris/morris-0.4.3.min'); ?>

        <!-- Core JS -->
        <?php echo third_party_js('jquery/jquery-1.10.2.min'); ?>
        <?php echo js('bootstrap.min'); ?>
        <?php echo third_party_js('metisMenu/jquery.metisMenu'); ?>
        <?php echo js('sb-admin'); ?>
        <?php echo js('lihocos'); ?>

        <!-- Page-Level JS -->
        <?php echo third_party_js('jquery-ui/jquery-ui.min'); ?>
        <?php echo third_party_js('jtable/jquery.jtable.min'); ?>
        <?php echo third_party_js('jquery-form/jquery.form.min'); ?>
        <?php echo third_party_js('moment-js/moment-with-langs.min'); ?>
        <?php echo third_party_js('toastr/toastr.min'); ?>
        <?php echo third_party_js('morris/raphael-2.1.0.min'); ?>
        <?php echo third_party_js('morris/morris'); ?>

        <?php if (!lang('jTable_lang') === 'en') : ?>
            <?php echo third_party_js('jtable/localization/jquery.jtable.' . lang('jTable_lang')); ?>
        <?php endif; ?>

    </head>
