    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('resources/img/apple-icon.png'); ?>">
        <link rel="icon" type="image/png" href="<?= base_url('resources/img/favicon.png'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            <?= (isset($page_title) ? (lang($page_title) ? lang($page_title) : $page_title) : 'Welcome') . ' - ' . $this->my_config->item('site_name'); ?>
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="<?= base_url('resources/fontawesome/css/all.css'); ?>">
        <!-- CSS Files -->
        <link href="<?= base_url('resources/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('resources/css/plugins/croppie.css'); ?>" rel="stylesheet" />
        <?php if (isset($section) && $section == 'dashboard'): ?>
        <link href="<?= base_url('resources/css/now-ui-dashboard.min.css?v=1.5.0'); ?>" rel="stylesheet" />
        <?php else: ?>
        <link href="<?= base_url('resources/css/now-ui-kit.css?v=1.3.0'); ?>" rel="stylesheet" />
        <link href="<?= base_url('resources/css/now-ui-kit.min.css?v=1.3.0'); ?>" rel="stylesheet" />
        <?php endif ?>
        <?php if (isset($use_datatables) && $use_datatables): ?>
        <!-- Datatables -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
        <?php endif ?>
        <link href="<?= base_url('resources/pass/css/passcontest-v2.0.css'); ?>" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="<?= base_url('resources/demo/demo.css'); ?>" rel="stylesheet" />
        <!-- JQuery and other scripts -->
        <script src="<?= base_url('resources/js/core/jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('resources/pass/js/pass-notifications.js'); ?>" type="text/javascript"></script>
    </head>
