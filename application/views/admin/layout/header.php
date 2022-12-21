<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $title; ?>
    </title>
    <!-- Favicons-->
    <link rel="icon" href="" sizes="32x32">
    <!-- CORE CSS-->
    <link href="<?php echo base_url();?>template/css//materialize.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/css/plugin/materialdesignicons.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/css/custom/custom.min.css" type="text/css" rel="stylesheet">
     <link href="<?php echo base_url();?>template/css/custom/style.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/css//style.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <!--plugin table -->
    <link href="<?php echo base_url();?>template/js/plugins/stepper/css/mstepper.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
   <link href="<?php echo base_url();?>template/js/plugins/dropify/css/dropify.min.css" type="text/css" rel="stylesheet">
</head>

<body class="grey lighten-4">
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <div class="navbar-fixed">
            <nav class="navbar-color fixed light-blue accent-2" role="navigation">
                <div class="nav-wrapper container">
                    <a href="<?php echo base_url('admin');?>" class="center"><img class="head-atas white-text hoverable" src="<?php echo base_url()?>template/images/logo/kemsos.png"></a>
                    <ul class="right">
                        <li>
                            <a class="btn-floating gradient-45deg-light-blue-cyan white-text  btn tooltipped" href="<?php echo base_url()?>welcome/logout" data-position="bottom" data-delay="50" data-tooltip="Keluar dari sistem"><i class="material-icons">exit_to_app</i></a>
                            <!-- <a data-activates="nav-mobile" class="btn btn-warning-confirm orange lighten-1 white-text" href="">Keluar</a> -->
                        </li>
                    </ul>
                    <a href="#" data-activates="nav-mobile" class="btn-medium button-collapse"><i class="material-icons white-text">menu</i></a>
                </div>
            </nav>
        </div>
    </header>
